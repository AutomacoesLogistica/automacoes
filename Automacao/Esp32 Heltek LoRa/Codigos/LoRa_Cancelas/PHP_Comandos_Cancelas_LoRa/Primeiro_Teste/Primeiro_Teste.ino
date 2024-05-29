/*
     Example of connection using Static IP
     by Evandro Luis Copercini
     Public domain - 2017
*/

#include <WiFi.h>
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

//parametros: address,SDA,SCL ]
SSD1306 display(0x3c, 4, 15); //construtor do objeto que controlaremos o display

String rssi = "RSSI --";
String packSize = "--";
String packet ;

const char* ssid     = "teste";
const char* password = "testeteste";
const char* host     = "192.168.2.131";
const uint16_t port = 8228;

IPAddress local_IP(192, 168, 2, 250);
IPAddress gateway(192, 168, 2, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress primaryDNS(8, 8, 8, 8); //optional
IPAddress secondaryDNS(8, 8, 4, 4); //optional
WiFiClient cliente84;


#define dispositivo "cancela_06"

void chama_atualizar_php(String dispositivo2,String condicao)
{
 // Use WiFiClient class to create TCP connections
  
  if (!cliente84.connect(host, port)) {
    Serial.println("Falha na conexao");
    delay(50);
    return;
  }

  String url = "/gagf/lora_cancelas_mb.php?";
         url += "dispositivo=";
         url += (dispositivo2);
         url += "&condicao=";
         url += (condicao);
  cliente84.print(String("GET ")+ url+ " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  
   // Tempo de aguardo para recepção de mensagens
  unsigned long timeout = millis();
  while (cliente84.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      cliente84.stop();
      delay(5000);
      return;
    }
  }
   String line;
  
  while (cliente84.available()) {
    line = cliente84.readStringUntil('\r');
    //Serial.print(line);
  }
 
  if(line.indexOf("mensagem:")!= -1){
    int tamanho = line.length();
    int posicao_a = 0;
    String c = "";
    for (int x = 0; x<tamanho;x++)
    {
      c = line.substring(x,x+1);
      if (c == ",")
      {
        posicao_a = x;
      }
    }
    
    String topico = line.substring(10,posicao_a);
    String mensagem = line.substring(posicao_a + 1,tamanho-1);
    Serial.print("Status: ");
    Serial.println(topico);
    Serial.print("Valor: ");
    Serial.println(mensagem);
    display.clear();
    display.setTextAlignment(TEXT_ALIGN_LEFT);
    display.setFont(ArialMT_Plain_10);
    display.drawString(0, 0, "Status: "+ topico);
    display.drawString(0, 26, "Mensagem: " + mensagem);
    display.display(); //mostra o conteúdo na tela 

    
  }
   
  
}



void logo()
{
  //apaga o conteúdo do display
  display.clear();
  //imprime o logo presente na biblioteca "images.h"
  display.drawXbm(0,5,logo_width,logo_height,logo_bits);
  display.display();
}





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

  if (!WiFi.config(local_IP, gateway, subnet, primaryDNS, secondaryDNS)) {
    Serial.println("STA Failed to configure");
  }

  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.print("ESP Mac Address: ");
  Serial.println(WiFi.macAddress());
  Serial.print("Subnet Mask: ");
  Serial.println(WiFi.subnetMask());
  Serial.print("Gateway IP: ");
  Serial.println(WiFi.gatewayIP());
  Serial.print("DNS: ");
  Serial.println(WiFi.dnsIP());
}

void loop()
{
  delay(5000);
 Serial.println("Solicitando!");
  chama_atualizar_php(dispositivo,"OK");
}
