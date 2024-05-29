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

#define BAND    915E6  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true

//variável responsável por armazenar o valor do contador (enviaremos esse valor para o outro Lora)
unsigned int counter = 0;

//parametros: address,SDA,SCL 
SSD1306 display(0x3c, 4, 15); //construtor do objeto que controlaremos o display

String rssi = "RSSI --";
String packSize = "--";
String packet ;


String epc = "";
String ultima_epc = "";
String cavalo = "";

String readString = "";
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

  display.clear(); //apaga todo o conteúdo da tela do display
  SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação serial com o Lora
  LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados pela biblioteca (deve ser chamado antes do LoRa.begin)
  
  //inicializa o Lora com a frequencia específica.
  if (!LoRa.begin(915E6))
  {
    display.drawString(0, 0, "LoRa falhou ao iniciar!");
    display.display(); //mostra o conteúdo na tela
    while (1);
  }
  //indica no display que inicilizou corretamente.
  display.drawString(0, 0, "LoRa iniciado!");
  display.display(); //mostra o conteúdo na tela
  delay(1000);
  display.clear(); //apaga todo o conteúdo da tela do display
  display.drawString(0, 0, "Aguardando USB!");
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
 
 if (readString.length() >=80) 
 {
  int tamanho_msg = readString.length();
  //Serial.println(tamanho_msg);
  if (tamanho_msg>=80)
  {
   int primeira_virgula = 0;
   int encontrado = 0;
   for(int x = 0; x<=tamanho_msg;x++)
   {
    if(readString.substring(x,x+1) == ",")
    {
     encontrado++;    
     if(encontrado == 1)
     {
      primeira_virgula = x;
      epc = readString.substring(0,primeira_virgula);
      cavalo = (readString.substring(4,10));
     }
    }
   }// Fecha for
   if(cavalo == "442002")
   {
    if( ultima_epc == epc)
    {
     Serial.println("Nao publica, e igual a ultima");
    }
    else
    {
     ultima_epc = epc;
     //Publica pacote completo
     LoRa.beginPacket();
     LoRa.print(readString);
     LoRa.endPacket(); //retorno= 1:sucesso | 0: falha
    }
   }//Fecha cavalo 
  }// Fecha tamanho >=80
 }// Fecha readString>=80
 readString="";
 cavalo = "";
} // Fecha Loop
