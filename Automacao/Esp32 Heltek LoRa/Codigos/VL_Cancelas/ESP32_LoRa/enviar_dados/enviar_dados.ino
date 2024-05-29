#include <SPI.h> //responsável pela comunicação serial
#include <LoRa.h> //responsável pela comunicação com o WIFI Lora
#include <Wire.h>  //responsável pela comunicação i2c
#include "SSD1306.h" //responsável pela comunicação com o display
#include "images.h" //contém o logo para usarmos ao iniciar o display

// Definição dos pinos 
#define SCK     5    // GPIO5  -- SX127x's SCK
#define MISO    19   // GPIO19 -- SX127x's MISO
#define MOSI    27   // GPIO27 -- SX127x's MOSI
#define SS      18   // GPIO18 -- SX127x's CS
#define RST     14   // GPIO14 -- SX127x's RESET
#define DI00    26   // GPIO26 -- SX127x's IRQ(Interrupt Request)

#define BAND    915000150  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true

boolean manter = false;

//variável responsável por armazenar o valor do contador (enviaremos esse valor para o outro Lora)
unsigned int counter = 0;

//parametros: address,SDA,SCL ]
SSD1306 display(0x3c, 4, 15); //construtor do objeto que controlaremos o display

String rssi = "RSSI --";
String packSize = "--";
String packet ;


String readString;

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
  if (!LoRa.begin(915000150)) {
    display.drawString(0, 0, "LoRa nao iniciou!");
    display.display();
    while (1);
  }

   //LoRa.onReceive(cbk);
  LoRa.receive(); //habilita o Lora para receber dados
  
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.drawString(0, 20, ">Lê serial e envia!<");
  display.display(); //mostra o conteúdo na tela
  delay(1000);
}

//essa função apenas imprime o logo na tela do display
void logo()
{
  //apaga o conteúdo do display
  display.clear();
  //imprime o logo presente na biblioteca "images.h"
  display.drawXbm(0,5,logo_width,logo_height,logo_bits);
  display.display();
}

void loop() 
{
 while (Serial.available()>0)
 {
  char c = Serial.read();
  readString += c;
  delay(3);  
  }

  if(readString != "")
  {
   //Serial.print("Recebido = ");
   // Serial.println(readString);
   display.clear();
   display.setTextAlignment(TEXT_ALIGN_LEFT);
   display.setFont(ArialMT_Plain_10);
   display.drawString(0, 0, ">Automacoes GERDAU<");
   display.drawString(0, 20, ">Lê serial e envia!<");
   display.drawString(0, 40, readString);
   display.display(); //mostra o conteúdo na tela
   for(int a = 0;a<3;a++)
   {
    readString.trim();
    LoRa.beginPacket();
    LoRa.print(readString);   // Envia a mensagem recebida via serial pelo python
    LoRa.endPacket();
    delay(30);
   }
   delay(1000);
   display.clear();
   display.setTextAlignment(TEXT_ALIGN_LEFT);
   display.setFont(ArialMT_Plain_10);
   display.drawString(0, 0, ">Automacoes GERDAU<");
   display.drawString(0, 20, ">Lê serial e envia!<");
   display.display(); //mostra o conteúdo na tela
    
  }
 readString = "";

}
