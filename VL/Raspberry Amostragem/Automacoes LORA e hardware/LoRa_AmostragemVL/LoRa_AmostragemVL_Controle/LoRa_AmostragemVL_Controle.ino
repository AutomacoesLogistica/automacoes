/*



  CODIGO PARA CONTROLE REMOTO QUE ACIONA O GUINCHO EPS32 LORA TTGO

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

#define entrada_vermelho     17 // Pino entrada para botao
#define entrada_verde     13 // Pino saida para led_verde

#define BAND    915000185  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true

//variável responsável por armazenar o valor do contador (enviaremos esse valor para o outro Lora)
int counter = 0;

//parametros: address,SDA,SCL 
SSD1306 display(0x3c, 4, 15); //construtor do objeto que controlaremos o display

String rssi = "RSSI --";
String packSize = "--";
String packet ;


void setup()
{
  Serial.begin(115200);
  //configura os pinos como saida
  pinMode(16,OUTPUT); //RST do oled
  pinMode(25,OUTPUT);
  pinMode(entrada_vermelho,INPUT);
  pinMode(entrada_verde,INPUT);
  
  digitalWrite(16, LOW);    // reseta o OLED
  delay(50); 
  digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH

  display.init(); //inicializa o display
  display.flipScreenVertically(); 
  display.setFont(ArialMT_Plain_10); //configura a fonte para um tamanho maior

  delay(1500);
  display.clear(); //apaga todo o conteúdo da tela do display
  
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
  display.display(); //mostra o conteúdo na tela
  delay(1000);
}

void loop()
{
  //apaga o conteúdo do display
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_16);
  
  display.drawString(0, 0, "Sending packet: ");
  
  if(digitalRead(entrada_vermelho)==LOW && digitalRead(entrada_verde)==HIGH) // Pressionado o botao vermelho
  {
     display.clear();
   display.drawString(10, 26, "vermelho");
    display.display(); //mostra o conteúdo na tela

    LoRa.beginPacket();
    LoRa.print("vermelho");
    delay(30);
    LoRa.endPacket(); //retorno= 1:sucesso | 0: falha
    display.drawString(10, 26, "vermelho");
   delay(150);
  }
  
  
  if(digitalRead(entrada_verde)==LOW && digitalRead(entrada_vermelho)==HIGH) // Pressionado o botao verde
  {
     display.clear();
    display.drawString(10, 26, "verde");
    display.display(); //mostra o conteúdo na tela
   
    LoRa.beginPacket();
    LoRa.print("verde");
    delay(30);
    LoRa.endPacket(); //retorno= 1:sucesso | 0: falha
    display.drawString(10, 26, "verde");
    delay(150);
  }

  
  if(digitalRead(entrada_vermelho)==HIGH && digitalRead(entrada_verde)==HIGH) // Pressionado o botao verde
  {
     display.clear();
    display.drawString(10, 26, "Aguardando");
    display.display(); //mostra o conteúdo na tela
    LoRa.beginPacket();
    LoRa.print("parado");
    delay(30);
    LoRa.endPacket(); //retorno= 1:sucesso | 0: falha
    delay(150);
  }

  

  if(counter==0)
  {
   digitalWrite(25, HIGH);   // liga o LED indicativo
  }
  
  if(counter >=700)
  {
   digitalWrite(25, LOW);    // desliga o LED indicativo
   counter = -700;
  }
  counter++;
  
}
