/*
 * 
 * 
 * CODIGO DO RECEPTOR DE LORA SEM REQUISIÇÃO, APENAS RECEBE CASO EXISTA ALGUM RADIO ENVIANDO E MOSTRA NO DISPLAY
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
#include "BluetoothSerial.h"

#if !defined(CONFIG_BT_ENABLED) || !defined(CONFIG_BLUEDROID_ENABLED)
#error Bluetooth is not enabled! Please run `make menuconfig` to and enable it
#endif

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
int packetSize = 0;
String dispositivo = "PC-02.001";

String Sinal = "RSSI -- "; // Para receber a intensidade do sinal
String Tamanho_do_Pacote = "--"; // Para receber o tamanho do pacote recebido
String readString ; // Para receber o pacote 
boolean conectado = 0;
boolean vezes = 0;
int incremento = 0;
String ultima_msg = "";

BluetoothSerial SerialBT;

void setup() 
{
 Serial.begin(9600);
 SerialBT.begin("Bluetooth"+dispositivo+"_LORA"); //Bluetooth device name
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
  if (!LoRa.begin(BAND)) {
    display.drawString(0, 0, "A inicializacao do radio LoRa falhou!");
    display.display();
    while (1);
  }
  else
  {
  //indica no display que inicilizou corretamente.
  display.drawString(0, 0, "LoRa Iniciado com Sucesso!");
  display.drawString(0, 15, "Aguardando por dados");
  conectado = 0;
  display.display();
  Escrever_Na_Tela();
  }
  
  LoRa.receive(); //habilita o Lora para receber dados
}
void Escrever_Na_Tela()
{
  if (conectado == 1) // Conectado
  {
   display.clear();
   String Placa = "";
   String Area = "";
   int posicao_string = 0;  //Monitora onde fica o ;
   
   readString.trim();
   posicao_string = readString.length()-1;
   Placa = readString.substring(0,8);
   Area = readString.substring(9,posicao_string);
   
   if ( Placa.length() == 8 && ((readString.substring(8,9))== ",") && (readString.substring(readString.length()-1,readString.length()) == ";"))
   {
   display.setTextAlignment(TEXT_ALIGN_LEFT); // Alinha o texto a esquerda
   display.setFont(ArialMT_Plain_16);
   display.drawString(0, 0, Sinal);  // Sinal : primeira linha
   display.drawString(0 , 18 , Placa);// Tamanho Byte recebido : segunda linha
   display.drawStringMaxWidth(0 , 39 , 128, Area);// Pacote recebido : terceira linha
   display.display();
   vezes = 1;
   Serial.println(Placa+","+Area+";");
   SerialBT.println(Placa+","+Area+";"); 
   delay(1000);
   packetSize = 0;
   }
   
   
  }
  else // Não esta conectado ou perdeu a conexão
  {
   if ( vezes == 0)
   {
   vezes = 1;
   display.clear();
   display.setTextAlignment(TEXT_ALIGN_LEFT); // Alinha o texto a esquerda
   display.setFont(ArialMT_Plain_10);
   display.drawString(0, 0, "Deteccao de Presenca!");
   display.drawString(0, 15, "Sem obstaculos por perto");
   Serial.println("00000000;0000000000,");
   SerialBT.println("00000000;0000000000,");
   display.display();
   
   }
  }
}
void loop() 
{
  packetSize = 0;
  
 packetSize = LoRa.parsePacket(); // Checa se chegou algum pacote Se for 0 nao recebeu nada, caso 1 recebeu
 if (packetSize)//caso tenha recebido pacote chama a função para configurar os dados que serão mostrados em tela
 { 
  cbk(packetSize);  // Chama o void cbk para tratar os dados do pacote packetSize
  
 }
 else
 {
  incremento++;
  if(incremento >= 55350) //Não mudar este valor, esta saindo para perca de sinal proximo a 3segundos
  {
   conectado = 0;
   incremento = 0;
   vezes = 0;
   Escrever_Na_Tela();
  }
 }
 
  
 
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

//função responsável por recuperar o conteúdo do pacote recebido
//parametro: tamanho do pacote (bytes)
void cbk(int packetSize) 
{
  readString ="";
  Tamanho_do_Pacote = String(packetSize,DEC); //transforma o tamanho do pacote em String para imprimirmos
  for (int i = 0; i < packetSize; i++) { 
    readString += (char) LoRa.read(); //recupera o dado recebido e concatena na variável "packet"
  }
  Sinal = "Sinal    " + String(LoRa.packetRssi(), DEC)+ " dB"; //Busca a intensidade da conecxao em "Lora.packetRssi(), transforma para DEC e converte em String para exibir na tela
  int valor = LoRa.packetRssi()*-1;
  
  if (valor <70)
  {
  conectado = 1;
  incremento = 0;
  Escrever_Na_Tela();
  vezes = 1;
  }
  else
  {
     display.display();
   incremento++;
   if(incremento >= 488000) //Não mudar este valor, esta saindo para perca de sinal proximo a 2segundos
   {
    display.clear();
    display.setTextAlignment(TEXT_ALIGN_LEFT); // Alinha o texto a esquerda
    display.setFont(ArialMT_Plain_10);
    display.drawString(0, 0, "Deteccao de Presenca!");
    display.drawString(0, 15, "Sem obstaculos por perto");
    Serial.println("00000000;0000000000,");
    SerialBT.println("00000000;0000000000,");
    display.display();
    incremento = 0;
   }
  }
} 
