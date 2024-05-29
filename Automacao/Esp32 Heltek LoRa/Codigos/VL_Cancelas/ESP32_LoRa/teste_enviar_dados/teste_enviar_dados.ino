#include <SPI.h> //responsável pela comunicação serial
#include <LoRa.h> //responsável pela comunicação com o WIFI Lora
#include <Wire.h>  //responsável pela comunicação i2c
#include "SSD1306.h" //responsável pela comunicação com o display
#include "images.h" //contém o logo para usarmos ao iniciar o display

String readString;

// Definição dos pinos 
#define SCK     5    // GPIO5  -- SX127x's SCK
#define MISO    19   // GPIO19 -- SX127x's MISO
#define MOSI    27   // GPIO27 -- SX127x's MOSI
#define SS      18   // GPIO18 -- SX127x's CS
#define RST     14   // GPIO14 -- SX127x's RESET
#define DI00    26   // GPIO26 -- SX127x's IRQ(Interrupt Request)

#define BAND    915000150  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true

//variável responsável por armazenar o valor do contador (enviaremos esse valor para o outro Lora)
unsigned int counter = 0;

//parametros: address,SDA,SCL ]
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
  
  digitalWrite(16, LOW);    // reseta o OLED
  delay(50); 
  digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH

  display.init(); //inicializa o display
  display.flipScreenVertically(); 
  display.setFont(ArialMT_Plain_10); //configura a fonte para um tamanho maior

  //imprime o logo na tela
  logo();

  delay(1500);
  display.clear(); //apaga todo o conteúdo da tela do display
  
  SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação serial com o Lora
  LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados pela biblioteca (deve ser chamado antes do LoRa.begin)

 //inicializa o Lora com a frequencia específica.
  if (!LoRa.begin(915E6)) {
    display.drawString(0, 0, "Starting LoRa failed!");
    display.display();
    while (1);
  }

  
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, "Esperando Mensagem");
  display.display(); //mostra o conteúdo na tela
  delay(1000);
}

void loop()
{
  
  while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   readString += c; 
  }
  if (readString.length() >0) 
  {
   Serial.println(readString);
   // Faz o envio!
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  
  display.drawString(0, 0, "Enviando Mensagem");
  display.drawString(0, 26, readString);
  display.display(); //mostra o conteúdo na tela
  
  for(int a = 0;a<3;a++)
  {
   LoRa.beginPacket();
   LoRa.print(readString);
   LoRa.endPacket();
   delay(30);
  }
  
  digitalWrite(25, HIGH);   // liga o LED indicativo
  delay(500);                       // aguarda 500ms
  digitalWrite(25, LOW);    // desliga o LED indicativo
  delay(2000);
  //Volta a tela ao normal esperando nova mensagem
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, "Esperando Mensagem");
  display.display(); //mostra o conteúdo na tela 
   readString="";
  } 
  
  
  
  
  
  
}// Fecha o void loop

//essa função apenas imprime o logo na tela do display
void logo()
{
  //apaga o conteúdo do display
  display.clear();
  //imprime o logo presente na biblioteca "images.h"
  display.drawXbm(0,5,logo_width,logo_height,logo_bits);
  display.display();
}
