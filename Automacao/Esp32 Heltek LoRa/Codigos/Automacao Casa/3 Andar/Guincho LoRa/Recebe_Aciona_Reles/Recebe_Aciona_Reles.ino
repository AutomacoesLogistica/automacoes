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
#define fc_subida  13
#define saida_verde     21 // Pino saida para led_verde IN2 DESCER
#define saida_vermelho     17 // Pino saida para led_vermelho IN1 SUBIR

#define BAND    915000185  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true
int counter = 0;
//parametros: address,SDA,SCL 
SSD1306 display(0x3c, 4, 15); //construtor do objeto que controlaremos o display

String rssi = "RSSI --";
String packSize = "--";
String packet ;

void setup() {
  Serial.begin(115200);
 //configura os pinos como saida
  pinMode(16,OUTPUT); //RST do oled
  digitalWrite(16, LOW);    // reseta o OLED
  pinMode(led,OUTPUT);
  digitalWrite(led,HIGH);// Lida led rodando
  pinMode(fc_subida,INPUT);
  pinMode(saida_verde,OUTPUT);
  pinMode(saida_vermelho,OUTPUT);
  digitalWrite(saida_verde,HIGH);
  digitalWrite(saida_vermelho,HIGH);
  
  
  digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH
  display.init();
  display.flipScreenVertically();  
  display.setFont(ArialMT_Plain_10);
  delay(1500);
  display.clear();

  SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação serial com o Lora
  LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados pela biblioteca (deve ser chamado antes do LoRa.begin)
  
  //inicializa o Lora com a frequencia específica.
  if (!LoRa.begin(BAND)) {
    display.drawString(0, 0, "Starting LoRa failed!");
    display.display();
    while (1);
  }

  //indica no display que inicilizou corretamente.
  display.drawString(0, 0, "LoRa Initial success!");
  display.drawString(0, 10, "Wait for incomm data...");
  display.display();
  delay(1000);

  //LoRa.onReceive(cbk);
  LoRa.receive(); //habilita o Lora para receber dados
}

void loop() {
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
void loraData(){
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_16);
  display.drawString(0 , 18 , "Rx "+ packSize + " bytes");
  display.drawStringMaxWidth(0 , 39 , 128, packet);
  display.drawString(0, 0, rssi);  
  display.display();
  Serial.println(packet);

 if ( packet=="sobe" && digitalRead(fc_subida)==LOW)
 {
 digitalWrite(saida_verde,HIGH);
 digitalWrite(saida_vermelho,LOW);
 delay(100);
 }

 else if( packet== "desce")
 {
 digitalWrite(saida_verde,LOW); 
 digitalWrite(saida_vermelho,HIGH); 
 delay(100);
 }
 else
 {//PARADO
  digitalWrite(saida_verde,HIGH); 
  digitalWrite(saida_vermelho,HIGH); 
  delay(40);
 }
  
}
