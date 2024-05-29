/*
 * 
 * 
 * CODIGO DO EMISSOR DE LORA SEM REQUISIÇÃO, ENVIA A MENSAGEM E MOSTRA NO DISPLAY
 * ESP32 HELTEK 915 MHZ
 * 
 * 
 * 
 */


#include <SPI.h> //responsável pela comunicação serial
#include <LoRa.h> //responsável pela comunicação com o WIFI Lora
#include <Wire.h>  //responsável pela comunicação i2c
#include "SSD1306.h" //responsável pela comunicação com o display
#include "images.h" //contém o  WiFi_Logo para usarmos ao iniciar o display

// Definição dos pinos para o radio lora
#define SCK     5    // GPIO5  -- SX127x's SCK
#define MISO    19   // GPIO19 -- SX127x's MISO
#define MOSI    27   // GPIO27 -- SX127x's MOSI
#define SS      18   // GPIO18 -- SX127x's CS
#define RST     14   // GPIO14 -- SX127x's RESET
#define DI00    26   // GPIO26 -- SX127x's IRQ(Interrupt Request)

#define BAND    915E6  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6

//Display OLED: address,SDA,SCL 
SSD1306 display(0x3c, 4, 15); // Configura a porta do display OLED

String Sinal = "RSSI -- "; // Para receber a intensidade do sinal
String Tamanho_do_Pacote = "--"; // Para receber o tamanho do pacote recebido
String readString ; // Para receber o pacote 

int counter = 1;

void setup()
{
 pinMode(25,OUTPUT); // Define como saida o led builtin
 pinMode(16,OUTPUT); // Define a porta de alimentação do display OLED como saida
 digitalWrite(16, LOW); // Desliga para dar um reset em qualquer configuracao existente no display
 delay(50); 
 digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH
 display.init(); // Inicia o display OLED
 display.flipScreenVertically();  
 display.setFont(ArialMT_Plain_10);
 Logo(); // Chama o void para criar a logo na tela
 display.clear(); // Limpa o display
 LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados para o radio (deve ser chamado antes do LoRa.begin)
 SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação com o radio LORA
  
 //inicializa o Lora com a frequencia específica.
 if (!LoRa.begin(BAND)) 
 {
  display.drawString(0, 0, "A inicializacao do radio LoRa falhou!");
  display.display();
  while (1);
 }
 else
 {
 //indica no display que inicilizou corretamente.
  display.setFont(ArialMT_Plain_10);
  display.drawString(0, 0, "LoRa Iniciado com Sucesso!");
  display.display();
  delay(2000);
 }
}

void loop()
{
  //apaga o conteúdo do display
  display.clear();
  display.setTextAlignment(TEXT_ALIGN_LEFT);
  display.setFont(ArialMT_Plain_16);
  
  display.drawString(0, 0, "Enviando Pacote: ");
  display.drawString(0, 20, "Numero : ");
  display.drawString(70, 20, String(counter));
  display.drawString(0, 40, "Dados : Logistica");
  display.display(); //mostra o conteúdo na tela

  // Monta o conteudo do pacote *****************************************************
  LoRa.beginPacket(); // Abre o pacote para envio
  LoRa.print("Logistica_");
  LoRa.print(counter);
  LoRa.endPacket(); // Finaliza o pacote OBS : Se retorno = 1: Sucesso , 0: falha
  
  // ********************************************************************************
  
  counter++; //incrementa uma unidade no contador

  digitalWrite(25, HIGH);   // liga o LED indicativo
  delay(500);                       // aguarda 500ms
  digitalWrite(25, LOW);    // desliga o LED indicativo
  delay(500);                       // aguarda 500ms
}

void Logo()
{
 display.clear();
 display.drawXbm(0,0, LoRa_width, LoRa_height, LoRa_bits); // Cria a imagem
 display.display(); // Atualiza o display
 delay(3000);
 display.clear();// Limpa o display
 display.drawXbm(15,0, Imagem_IoT_width, Imagem_IoT_height, Imagem_IoT_bits); // Cria a imagem
 display.display(); // Atualiza o display
 delay(3000);
}
