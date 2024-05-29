/* Projeto Receptor de 2.4 Ghz

   1 - GND
   2 - VCC 3.3V ............................Nao usar 5V, queima
   3 - CE no Arduino pino 9
   4 - CSN no Arduino pino 10
   5 - SCK no Arduino pino 13
   6 - MOSI no Arduino pino 11
   7 - MISO no Arduino pino 12
   8 - Nao usado
   
 - Produzido por: Bruno Gonçalves
 - Data: 05/06/2014
*/

// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   9
#define CSN_PIN 10

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089

RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

int SINAIS[20];  // 


String readString;

void setup()
{
  Serial.begin(9600);
  pinMode(3,OUTPUT);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
}


void loop()
{
  if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  {
   radio.read( SINAIS, sizeof(0) );
     
      
      
      if(SINAIS[0]==0)
      {
      digitalWrite(3,LOW);
      delay(20);
      }
      
      if(SINAIS[1]==1)
      {
      digitalWrite(3,HIGH);
      delay(20);
      }
      
    }
  
}// FECHA LOOP
