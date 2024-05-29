#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção
int SINAIS[2];  // usada para receber os comandos enviados
int x;
void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  pinMode(3,OUTPUT);
  x=0;
}

void loop()
{
  if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  {
   radio.read( SINAIS, sizeof(0) );
     if(SINAIS[0]==1000)
     {
     digitalWrite(3,!digitalRead(3));
     }
     
     
  } // fecha se teve recebimento
} // fecha o loop
 
