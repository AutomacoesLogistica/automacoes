#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
// Variaveis e Pinos
#define CE_PIN   8
#define CSN_PIN 53
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal
int SINAIS[20];  // Numero de canais
int Vezes;
int modo;
String readString;

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
  pinMode(2,INPUT);
  Vezes=0;  
}
//******************************************************************************************************************************************************************************************

void loop()  
{

  if(digitalRead(2)==0&&Vezes==0) // 
  {
  SINAIS[0] = 5;
  radio.write(SINAIS,sizeof(SINAIS));
  Vezes=1;
  Serial.println(SINAIS[0]);  
  }
  if(digitalRead(2)==1&&Vezes==1) // 
  {
  SINAIS[0] = 5;
  radio.write(SINAIS ,sizeof(SINAIS)); 
  Vezes = 0;
  Serial.println(SINAIS[0]);  
  } 
  radio.write(SINAIS ,sizeof(SINAIS));   SINAIS[0] = 9;
}
//******************************************************************************************************************************************************************************************

