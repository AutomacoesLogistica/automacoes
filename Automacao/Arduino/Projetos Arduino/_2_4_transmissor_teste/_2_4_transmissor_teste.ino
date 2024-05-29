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
#define CE_PIN   9 // 8 no mega
#define CSN_PIN 10 // 53 no mega
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal
int SINAIS[2];  // Numero de canais

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
}
//******************************************************************************************************************************************************************************************

void loop()  
{
  SINAIS[0] = analogRead(A0);
  
  radio.write(SINAIS ,sizeof(SINAIS));
}
//******************************************************************************************************************************************************************************************

