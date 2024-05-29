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


#define saida_led_recebendo_dados     17 // Pino pisca quando recebe dados
#define saida_led_enviando_dados    23 // Pino quando enviar dados
#define saida_led_rodando     12 // Pino pisca led rodando


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
  pinMode(saida_led_recebendo_dados,OUTPUT);
  digitalWrite(saida_led_recebendo_dados,LOW);
  pinMode(saida_led_enviando_dados,OUTPUT);
  digitalWrite(saida_led_enviando_dados,LOW);
  pinMode(saida_led_rodando,OUTPUT);
  digitalWrite(saida_led_rodando,LOW);
  
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

   //LoRa.onReceive(cbk);
  LoRa.receive(); //habilita o Lora para receber dados
  
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, "Esperando Mensagem");
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
 packet.trim();
 String msg2 = "Recebido="+packet;
 Serial.println(msg2);  // Envia na serial para o python ler e salvar no banco de dados! 
 digitalWrite(saida_led_recebendo_dados,HIGH); 
 delay(200);
 digitalWrite(saida_led_recebendo_dados,LOW);
 delay(200);
}



void loop()
{
  
 //parsePacket: checa se um pacote foi recebido
 //retorno: tamanho do pacote em bytes. Se retornar 0 (ZERO) nenhum pacote foi recebido
 int packetSize = LoRa.parsePacket();
 //caso tenha recebido pacote chama a função para configurar os dados que serão mostrados em tela
 if (packetSize) 
 {
  cbk(packetSize);  
 }
 delay(10);
  while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   readString += c; 
  }
  if (readString.length() >0) 
  {
   String msg = "Lido_serial="+readString;
   Serial.println(msg);
   // Faz o envio!
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  
  display.drawString(0, 0, "Enviando Mensagem");
  display.drawString(0, 26, readString);
  display.display(); //mostra o conteúdo na tela
  
  for(int a = 0;a<3;a++)
  {
   readString.trim(); 
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
