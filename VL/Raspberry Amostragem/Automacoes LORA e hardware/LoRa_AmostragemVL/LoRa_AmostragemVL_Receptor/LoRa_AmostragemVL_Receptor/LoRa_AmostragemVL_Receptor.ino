/*
 * 
 * CODIGO PARA RECEBER COMANDOS CONTROLE DA AMOSTRAGEM DE VL
 
 
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

#define led  17 //25
#define saida_rele  13 //23

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
  pinMode(saida_rele,OUTPUT);
  digitalWrite(saida_rele,LOW); // Inicia desligado ( Rele comum, nao com modulo!) e tela sera a minha da amostragem
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
  
  if(counter >=150)
  {
   digitalWrite(led, LOW);    // desliga o LED indicativo
   counter = -150;
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

 if ( packet=="finalizado" || packet=="vermelho")
 {
  digitalWrite(saida_rele,LOW);// Rele desligado, a entrada digital do raspberry vai monitorar e colocar a tela em 1 ( Minha tela da Amostragem )
  delay(800);
 }

 else if( packet== "iniciado" || packet=="verde")
 {
  //muda tela para 0 e coloca o GAGF sendo exibido
  digitalWrite(saida_rele,HIGH);// Rele ligado, a entrada digital do raspberry vai monitorar e colocar a tela em 0 ( GAGF )
 delay(800);
 }
  
}
