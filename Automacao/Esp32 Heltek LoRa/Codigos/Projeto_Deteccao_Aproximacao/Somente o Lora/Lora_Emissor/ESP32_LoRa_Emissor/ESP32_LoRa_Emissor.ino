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

// Definição dos pinos para o radio lora
#define SCK     5    // GPIO5  -- SX127x's SCK
#define MISO    19   // GPIO19 -- SX127x's MISO
#define MOSI    27   // GPIO27 -- SX127x's MOSI
#define SS      18   // GPIO18 -- SX127x's CS
#define RST     14   // GPIO14 -- SX127x's RESET
#define DI00    26   // GPIO26 -- SX127x's IRQ(Interrupt Request)

#define BAND    915E6  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6

int packetSize = 0;
int incremento = 0;
boolean conectado = 0;
boolean vezes = 0;

long UltimoMillis = 0;        // Variável de controle do tempo

long intervalo = 1000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;

boolean timer_enable = false;

String Sinal = "RSSI -- "; // Para receber a intensidade do sinal
String Tamanho_do_Pacote = "--"; // Para receber o tamanho do pacote recebido
String readString ; // Para receber o pacote 

String Placa = "37063378"; // ATENÇÃO!!!!!   Não pode ser mais do que 8 caracteres
String Area = "Bruno_Goncalves";


void setup()
{
 Serial.begin(9600);
 LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados para o radio (deve ser chamado antes do LoRa.begin)
 SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação com o radio LORA
 pinMode(12,OUTPUT); 
 digitalWrite(12,0); 
  pinMode(13,OUTPUT); 
 digitalWrite(13,0);  
 //inicializa o Lora com a frequencia específica.
 if (!LoRa.begin(BAND)) 
 {
  Serial.println( "A inicializacao do radio LoRa falhou!");

  while (1);
 }
 else
 {
  Serial.println( "LoRa Iniciado com Sucesso!");

 }
 timer_enable = true;
}

void loop()
{

AtualMillis = millis();    //Tempo atual em ms

if ( timer_enable == true )
{
 if (AtualMillis - UltimoMillis > intervalo) 
 { 
  UltimoMillis = AtualMillis;    // Salva o tempo atual
  Tempo();
 }
}
else
{
 if (AtualMillis - UltimoMillis > intervalo/4) 
 { 
  UltimoMillis = AtualMillis;    // Salva o tempo atual
  Tempo2();
 }
}

 LoRa.receive(); //habilita o Lora para receber dados 
 packetSize = LoRa.parsePacket(); // Checa se chegou algum pacote Se for 0 nao recebeu nada, caso 1 recebeu
 if (packetSize)//caso tenha recebido pacote chama a função para configurar os dados que serão mostrados em tela
 { 
  cbk(packetSize);  // Chama o void cbk para tratar os dados do pacote packetSize
 }
 
  
 
}



//função responsável por recuperar o conteúdo do pacote recebido
//parametro: tamanho do pacote (bytes)
void cbk(int packetSize) 
{
  Serial.println("entrou");
  readString ="";
  Tamanho_do_Pacote = String(packetSize,DEC); //transforma o tamanho do pacote em String para imprimirmos
  for (int i = 0; i < packetSize; i++) { 
    readString += (char) LoRa.read(); //recupera o dado recebido e concatena na variável "packet"
  }
  Serial.println(readString);
  Sinal = "Sinal    " + String(LoRa.packetRssi(), DEC)+ " dB"; //Busca a intensidade da conecxao em "Lora.packetRssi(), transforma para DEC e converte em String para exibir na tela
  int valor = LoRa.packetRssi()*-1;
 
} 


void Tempo()
{
digitalWrite(12,!digitalRead(12));  // LED
digitalWrite(13,0);  // SIRENE

if ( digitalRead(12)==1)
{
 // Monta o conteudo do pacote *****************************************************
  LoRa.beginPacket(); // Abre o pacote para envio
  LoRa.print(Placa+","+Area+";");
  LoRa.endPacket(); // Finaliza o pacote OBS : Se retorno = 1: Sucesso , 0: falha
  
  // ******************************************************************************** 
}



}
void Tempo2()
{

digitalWrite(12,!digitalRead(12)); // LED
//digitalWrite(13,!digitalRead(13));   // SIRENE


}
