// ID CANCELA : 02 - Saida BH

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

#define entrada_pulso_totem     13 // Pino entrada_pulso_totem
#define entrada_condicao     17 // Pino entrada para monitorar aberto ou fechado!
#define entrada_sinal_vandalismo    23 // Pino entrada sinal vandalismo
#define saida_pulso     12 // Pino saida para led_verde

#define BAND    915000150  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true

int vezes_aberta = 0;
int vezes_fechada = 0;

boolean manter = false;

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
  pinMode(entrada_pulso_totem,INPUT);
  pinMode(entrada_condicao,INPUT);
  pinMode(entrada_sinal_vandalismo,INPUT);
  pinMode(saida_pulso,OUTPUT);
  digitalWrite(saida_pulso,LOW);
  
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
  display.display(); //mostra o conteúdo na tela
  delay(1000);
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
 if ( packet == "02_pulso" && manter == false)
 {
  digitalWrite(saida_pulso,HIGH);
  delay(1000);
  digitalWrite(saida_pulso,LOW);
 }

 if ( packet == "02_manter" && manter == false)
 {
  digitalWrite(saida_pulso,HIGH);
  manter = true;
 }
 if ( packet == "02_normalizar" && manter == true)
 {
  digitalWrite(saida_pulso,LOW);
  manter = false;
 } 
}

void loop()
{

 //parsePacket: checa se um pacote foi recebido
  //retorno: tamanho do pacote em bytes. Se retornar 0 (ZERO) nenhum pacote foi recebido
  int packetSize = LoRa.parsePacket();
  //caso tenha recebido pacote chama a função para configurar os dados que serão mostrados em tela
  if (packetSize) { 
    cbk(packetSize);  
  }
  delay(10);
  
// MONITORA O SINAL DE ABERTURA VINDAS PELO TOTEM **********************************************************************************************************
// MONITORA O SINAL DE ABERTURA VINDAS PELO TOTEM **********************************************************************************************************
// MONITORA O SINAL DE ABERTURA VINDAS PELO TOTEM **********************************************************************************************************
// MONITORA O SINAL DE ABERTURA VINDAS PELO TOTEM **********************************************************************************************************
  
 if(digitalRead(entrada_pulso_totem)==LOW)
 {
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.drawString(0, 26, "Comando recebido totem!");
  display.display(); //mostra o conteúdo na tela
  while(digitalRead(entrada_pulso_totem)==LOW)
  {
    delay(100);
  }
  for(int a = 0;a<3;a++)
  {
   LoRa.beginPacket();
   LoRa.print("02_totem");   // Envia que a cancela abriu via totem, para finalizar os dados no banco
   LoRa.endPacket();
   delay(30);
  }
  delay(2000);
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.display(); //mostra o conteúdo na tela
 } 

// MONTORA VANDALISMO *************************************************************************************************************************************
// MONTORA VANDALISMO *************************************************************************************************************************************
// MONTORA VANDALISMO *************************************************************************************************************************************
// MONTORA VANDALISMO *************************************************************************************************************************************
// MONTORA VANDALISMO *************************************************************************************************************************************
 if(digitalRead(entrada_sinal_vandalismo)==LOW)
  {
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.drawString(0, 26, "VANDALISMO!");
  display.display(); //mostra o conteúdo na tela
  while(digitalRead(entrada_sinal_vandalismo)==LOW)
  {
   for(int a = 0;a<3;a++)
   {
    LoRa.beginPacket();
    LoRa.print("02_Vandalismo");   // Envia que teve vandalismo
    LoRa.endPacket();
    delay(30);
   }
   delay(1000);
  }
  delay(200);
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.display(); //mostra o conteúdo na tela
 } 



// MONITORA A CONDICAO SE ABERTO OU FECHADO! **************************************************************************************************************
// MONITORA A CONDICAO SE ABERTO OU FECHADO! **************************************************************************************************************
// MONITORA A CONDICAO SE ABERTO OU FECHADO! **************************************************************************************************************
// MONITORA A CONDICAO SE ABERTO OU FECHADO! **************************************************************************************************************
// MONITORA A CONDICAO SE ABERTO OU FECHADO! **************************************************************************************************************

 if(digitalRead(entrada_condicao)==LOW && vezes_aberta == 0)
 {
  //Cancela Aberta
  vezes_aberta = 1;
  vezes_fechada = 0;
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.drawString(0, 26, "Cancela Aberta!");
  display.display(); //mostra o conteúdo na tela
  delay(100);
  
  for(int a = 0;a<3;a++)
  {
   LoRa.beginPacket();
   LoRa.print("02_Aberta");   // Envia que esta aberta
   LoRa.endPacket();
   delay(30);
  }
  delay(2000);
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.display(); //mostra o conteúdo na tela
 }
 else if(digitalRead(entrada_condicao)==HIGH && vezes_fechada == 0)
 {
  //Cancela Fechada
  vezes_aberta = 0;
  vezes_fechada = 1;
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.drawString(0, 26, "Cancela Fechada!");
  display.display(); //mostra o conteúdo na tela
  for(int a = 0;a<3;a++)
  {
   LoRa.beginPacket();
   LoRa.print("02_Fechada");   // Envia que esta fechada
   LoRa.endPacket();
   delay(30);
  }
  delay(2000);
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, ">Automacoes GERDAU<");
  display.display(); //mostra o conteúdo na tela
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
