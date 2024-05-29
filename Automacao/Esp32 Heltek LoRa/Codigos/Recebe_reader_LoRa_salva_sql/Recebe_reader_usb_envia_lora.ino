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


  delay(1500);
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
  display.drawString(0, 0, "Aguardando mensagem!");
  display.display(); //mostra o conteúdo na tela
  
  LoRa.receive(); //habilita o Lora para receber dados
}

void cbk(int packetSize) 
{
 packet ="";
 packSize = String(packetSize,DEC); //transforma o tamanho do pacote em String para imprimirmos
 for (int i = 0; i < packetSize; i++) 
 { 
  packet += (char) LoRa.read(); //recupera o dado recebido e concatena na variável "packet"
 }
 loraData(); // Tratar informacao
}


void loraData()
{
 //packet = "epc=442002000000000000001216,ant=0,host=PIRESTESTE,data=2020/05/06,hora=07:18:09.442";
 int tamanho_msg = packet.length();
 //Serial.println(tamanho_msg);
 if (tamanho_msg>=80)
 {
  int primeira_virgula = 0;
  int segunda_virgula = 0;
  int terceira_virgula = 0;
  int quarta_virgula = 0;
  int quinta_virgula = 0;
  String epc = "";
  String antena = "";
  String ca = "";
  String dia = "";
  String horario = "";
  int encontrado = 0;
  for(int x = 0; x<=tamanho_msg;x++)
  {
   if(packet.substring(x,x+1) == ",")
   {
    encontrado++;    
    if(encontrado == 1)
    {
     primeira_virgula = x;
     epc = packet.substring(0,primeira_virgula);
     Serial.println(epc);
    }
    if(encontrado == 2)
    {
     segunda_virgula = x;
     antena = packet.substring(primeira_virgula+1,segunda_virgula);
     Serial.println(antena);
    }

    // CA *************
    if(encontrado == 3)
    {
     terceira_virgula = x;
     ca = packet.substring(segunda_virgula+1,terceira_virgula);
     Serial.println(ca);
    }
    
    // data *************
    if(encontrado == 4)
    {
     quarta_virgula = x;
     dia = packet.substring(terceira_virgula+1,quarta_virgula);
     Serial.println(dia);
    }
    // horario *************
    if(encontrado == 4)
    {
     quinta_virgula = x;
     horario = packet.substring(quarta_virgula+1,tamanho_msg);
     Serial.println(horario);
    }
   } //Fecha ";"
  } // Fecha o for  
  // IMPRIME OS DADOS NA TELA
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_10);
  String tag = epc.substring(4,10);
  String tag2 = epc.substring(epc.length()-5,epc.length());
  String v_tag = "EPC = " + tag + " ... " + tag2;
  display.drawString(0 , 0 ,v_tag);
  String ca2 = "CA = " + ca.substring(5,ca.length());
  display.drawString(0 , 14 ,ca2);
  display.drawString(100 , 14 ,antena.substring(4,antena.length()));
  display.drawString(0 , 28 ,dia);
  display.drawString(0 , 42 ,horario.substring(0,horario.length()-1));
  display.display();
 }// Fecha tamanho 84 
}// Fecha loradata

void loop()
{
 int packetSize = LoRa.parsePacket();
 if (packetSize)
 { 
  cbk(packetSize);  
 }
} // Fecha o Loop
