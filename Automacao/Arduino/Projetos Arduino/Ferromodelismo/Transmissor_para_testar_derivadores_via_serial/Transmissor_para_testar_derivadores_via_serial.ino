/*


8 (CE)
51 (MO)
50 (MI)
52 (SCK)
53 (CSN)



*/

#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
// Variaveis e Pinos
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal
int SINAIS[10];  // Numero de canais

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
}
//******************************************************************************************************************************************************************************************

void loop()  
{
  if(Serial.available() >0)
  {
    char c = Serial.read();
    if(c == '1')
    {
     SINAIS[8] = 100; 
    }
    else if(c == '2')
    {
     SINAIS[8] = 200; 
    }
  }
  
  radio.write(SINAIS ,sizeof(SINAIS));
}
//******************************************************************************************************************************************************************************************
