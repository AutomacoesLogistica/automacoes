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


#define BAND    915000400  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6
#define PABOOST true
int counter = 0;
//parametros: address,SDA,SCL 
SSD1306 display(0x3c, 4, 15); //construtor do objeto que controlaremos o display

String readString;
String rssi = "RSSI --";
String packSize = "--";
String packet ;



int saida_PWM = 12;
int entrada_Potenciometro = 13;
int valor_saida_PWM;

const int frequencia = 5000;
const int ledChannel = 0;
const int resolucao = 8;

void setup () 
{
 Serial.begin(115200);
 pinMode(entrada_Potenciometro, INPUT);
 ledcSetup(ledChannel, frequencia, resolucao);
 ledcAttachPin(saida_PWM, ledChannel);
  pinMode(16,OUTPUT); //RST do oled
  digitalWrite(16, LOW);    // reseta o OLED
  delay(2000);
  digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH
  display.init();
  display.flipScreenVertically();  
  display.setFont(ArialMT_Plain_10);
  delay(1500);
  

  SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação serial com o Lora
  LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados pela biblioteca (deve ser chamado antes do LoRa.begin)
  
  //inicializa o Lora com a frequencia específica.
  if (!LoRa.begin(BAND)) {
    display.drawString(0, 0, "Falhou iniciar o LoRa!");
    display.display();
    while (1);
  }

  //indica no display que inicilizou corretamente.
  display.drawString(0, 0, "LoRa iniciado!");
  display.drawString(0, 10, "Aguardando dados");
  display.display();
  delay(2000);

  //LoRa.onReceive(cbk);
  LoRa.receive(); //habilita o Lora para receber dados
  display.clear();


}

void loop () 
{
 valor_saida_PWM = analogRead(entrada_Potenciometro);
 valor_saida_PWM = map(valor_saida_PWM, 0, 4095, 0, 255);
 ledcWrite(ledChannel, valor_saida_PWM);
 Serial.println(valor_saida_PWM);
 }
