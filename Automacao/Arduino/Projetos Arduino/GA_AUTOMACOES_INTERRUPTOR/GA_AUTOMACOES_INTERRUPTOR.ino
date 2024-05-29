#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal
int SINAIS[2];
int Vezes;
//******************************************************************************************************************************************************************************************

void setup()
{
  radio.begin();
  radio.openWritingPipe(pipe);
  pinMode(2,INPUT);
  Vezes=0;  
}
//******************************************************************************************************************************************************************************************

void loop()  
{
  if(digitalRead(2)==1&&Vezes<=2) // 
  {
  SINAIS[0] = 5;
  radio.write(SINAIS,sizeof(0));
  Vezes=3;
  delay(50);
  }
  if(digitalRead(2)==0&&Vezes>=3&&Vezes<=5) // 
  {
  SINAIS[0] = 5;
  radio.write(SINAIS ,sizeof(0)); 
  Vezes = 0;
  delay(50);
  } 
}
//******************************************************************************************************************************************************************************************

