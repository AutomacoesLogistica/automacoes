/*
 * 
 * CODIGO PARA SINALEIRO EXCESSO - ACIONADO VIA CONTROLE REMOTO
 * PAYLOAD VERMELHO - "ex_vermelho"
 * PAYLOAD VERDE - "ex_verde"
 * CONTATOS DO RELE - Vermelho NA e Verde NF
 */

#include <SPI.h> //responsável pela comunicação serial
#include <LoRa.h> //responsável pela comunicação com o WIFI Lora
#include <Wire.h>  //responsável pela comunicação i2c
#include "SSD1306.h" //responsável pela comunicação com o display

// Definição dos pinos 
#define SCK     5    // GPIO5  -- SX127x's SCK
#define MISO    19   // GPIO19 -- SX127x's MISO
#define MOSI    27   // GPIO27 -- SX127x's MOSI
#define SS      18   // GPIO18 -- SX127x's CS
#define RST     14   // GPIO14 -- SX127x's RESET
#define DI00    26   // GPIO26 -- SX127x's IRQ(Interrupt Request)

#define led  25
#define led1  21
#define led2  13
#define saida_rele_reversao  23
#define saida_verde     12 // Pino saida para led_verde
#define saida_vermelho     13 // Pino saida para led_vermelho

#define BAND    915000400  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true
int counter = 0;
//parametros: address,SDA,SCL 
SSD1306 display(0x3c, 4, 15); //construtor do objeto que controlaremos o display

String readString;
String rssi = "RSSI --";
String packSize = "--";
String packet ;



String sentido = "Frente"; //Por padrao vem sentido para frente

String velocidade = "0000";
String u_velocidade = "0000";

boolean ligar = false; // 0 false    1 true
boolean luz1 = false;
boolean luz2 = false;
int audio = 0;

String v_ligar = "";
String u_v_ligar = "";

String v_sentido = "";
String u_v_sentido = "";

String v_luz1 = "";
String u_v_luz1 = "";

String v_luz2 = "";
String u_v_luz2 = "";

String v_audio = "";
String u_v_audio = "";
  


void setup() {
  Serial.begin(115200);
 //configura os pinos como saida
  pinMode(16,OUTPUT); //RST do oled
  digitalWrite(16, LOW);    // reseta o OLED
  pinMode(led,OUTPUT);
  digitalWrite(led,HIGH);// Lida led rodando
  pinMode(saida_rele_reversao,OUTPUT);
  digitalWrite(saida_rele_reversao,HIGH);

  pinMode(led1,OUTPUT);
  pinMode(led2,OUTPUT);
  digitalWrite(led1,LOW);
  digitalWrite(led2,LOW);
  pinMode(saida_verde,OUTPUT);
  pinMode(saida_vermelho,OUTPUT);
  digitalWrite(saida_verde,LOW);
  digitalWrite(saida_vermelho,LOW);
  delay(50); 
  //INICIANDO TESTE DAS SAIDAS
  //LIGANDO VERMELHO
  digitalWrite(saida_vermelho,HIGH);
  digitalWrite(saida_verde,LOW);
  digitalWrite(saida_rele_reversao,HIGH);
  delay(2000);
  //LIGANDO VERDE
  digitalWrite(saida_vermelho,LOW);
  digitalWrite(saida_verde,HIGH);
  digitalWrite(saida_rele_reversao,LOW);
  delay(2000);
  digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH
  display.init();
  display.flipScreenVertically();  
  display.setFont(ArialMT_Plain_10);
  delay(1500);
  

  SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação serial com o Lora
  LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados pela biblioteca (deve ser chamado antes do LoRa.begin)
  
  //inicializa o Lora com a frequencia específica.
  if (!LoRa.begin(915E6)) {
    display.drawString(0, 0, "Falhou iniciar o LoRa!");
    display.display();
    while (1);
  }

  //indica no display que inicilizou corretamente.
  display.drawString(0, 0, "LoRa iniciado!");
  display.drawString(0, 10, "Aguardando dados");
  display.display();
  delay(2000);

  //LoRa.onReceive(cbk);
  LoRa.receive(); //habilita o Lora para receber dados
  display.clear();
}

void loop() {
   while (Serial.available()) {
    delay(3);  
    char c = Serial.read();
    readString += c;
   }
   if(readString != "")
   {
    loraData();
   }
  //parsePacket: checa se um pacote foi recebido
  //retorno: tamanho do pacote em bytes. Se retornar 0 (ZERO) nenhum pacote foi recebido
  int packetSize = LoRa.parsePacket();
  //caso tenha recebido pacote chama a função para configurar os dados que serão mostrados em tela
  if (packetSize) { 
    cbk(packetSize);  
  }
  delay(10);
  if(counter==0)
  {
   digitalWrite(led, HIGH);   // liga o LED indicativo
  }
  
  if(counter >=350)
  {
   digitalWrite(led, LOW);    // desliga o LED indicativo
   counter = -350;
  }
  counter++;
 
}


//função responsável por recuperar o conteúdo do pacote recebido
//parametro: tamanho do pacote (bytes)
void cbk(int packetSize) {
  packet ="";
  packSize = String(packetSize,DEC); //transforma o tamanho do pacote em String para imprimirmos
  for (int i = 0; i < packetSize; i++) { 
    packet += (char) LoRa.read(); //recupera o dado recebido e concatena na variável "packet"
  }
  rssi = "RSSI=  " + String(LoRa.packetRssi(), DEC)+ "dB"; //configura a String de Intensidade de Sinal (RSSI)
  //mostrar dados em tela
  loraData();
}

//função responsável por configurar os dadosque serão exibidos em tela.
//RSSI : primeira linha
//RX packSize : segunda linha
//packet : terceira linha
void loraData()
{
  if(readString != "")
  {
    packet = readString;
  }
  //Protocolo
  /*
  
  >0000,0,0,0,0,0<   Velocidade , ligar , sentido , luz1 , luz2 , audio
  
  
  */
  velocidade = readString.substring(1,5); // Atribui o valor da velocidade
  String v_ligar = readString.substring(6,7); // Atribui o comando de ligar / desligar
  String v_sentido = readString.substring(8,9); // Atribui o sentido
  String v_luz1 = readString.substring(10,11); // Atribui luz1
  String v_luz2 = readString.substring(12,13); // Atribui luz2
  String v_audio = readString.substring(14,15); // Atribui audio
  
  
  if(v_ligar == "1" && ligar == false)
  {
    //Comando para ligar a maquina e chamar o audio de partida
    ligar = true;
    v_ligar = "Ligando";
  }
  else if(v_ligar == "0" && ligar == true)
  {
    //Comando para desligar a maquina
    ligar = false;
    v_ligar = "Desligando";
  }
  else
  {
    v_ligar = "Desligado";
    ligar = false;
  }


  if(v_sentido == "0")
  {
    v_sentido = "F";
    digitalWrite(saida_rele_reversao,HIGH);
  }
  else
  {
    v_sentido = "R";
    digitalWrite(saida_rele_reversao,LOW);
  }

  if(v_luz1 =="1")
  {
    v_luz1 = "Luz1 = on";
    digitalWrite(led1,HIGH);
  }
  else
  {
    v_luz1 = "Luz1 = off";
    digitalWrite(led1,LOW);
  }

  if(v_luz2 =="1")
  {
    v_luz2 = "Luz2 = on";
    digitalWrite(led2,HIGH);
  }
  else
  {
    v_luz2 = "Luz2 = off";
    digitalWrite(led2,LOW);
  }

  if(v_audio == "0")
  {
    v_audio = "Desativado!";
  }
  else
  {
    v_audio = "Audio = " + v_audio;
  }
  
  //Atualizo os dados
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0 ,0 , velocidade); 
  display.drawString(0 ,11 , v_ligar); 
  display.drawString(0 ,22 , v_sentido);
  display.drawString(0 ,33 , v_luz1);
  display.drawString(60 ,33 , v_luz2);
  display.drawString(0 ,44 , v_audio);
  
  
  
  if(velocidade != u_velocidade)
  {
   u_velocidade = velocidade;
  }
  
  if(v_ligar != u_v_ligar)
  {
   u_v_ligar = v_ligar;
  }
  
  if(v_sentido != u_v_sentido)
  {
    u_v_sentido = v_sentido;
  }

  if(v_luz1 != u_v_luz1)
  {
   u_v_luz1 = v_luz1;
  }

  if(v_luz2 != u_v_luz2)
  {
    u_v_luz2 = v_luz2;
  }

  if(v_audio != u_v_audio)
  {
    u_v_audio = v_audio;
  }

  

  
  
  
  
  
  
  display.display();
  Serial.println(packet);
  readString = "";


  
 if ( packet=="ex_vermelho")
 {
 digitalWrite(saida_verde,LOW);
 digitalWrite(saida_vermelho,HIGH);
 digitalWrite(saida_rele_reversao,HIGH);// Vermelho NA e Verde NF
 delay(1000);
 }

 if( packet== "ex_verde")
 {
 digitalWrite(saida_verde,HIGH); 
 digitalWrite(saida_vermelho,LOW); 
 digitalWrite(saida_rele_reversao,LOW);// Vermelho NA e Verde NF
 delay(1000);
 }
  
}
