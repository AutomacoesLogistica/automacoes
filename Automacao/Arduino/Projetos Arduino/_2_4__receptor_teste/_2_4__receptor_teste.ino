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

int SINAIS[2];  // Define um array de 2 , ou seja, recebera duas vezes as informações, sendo uma no array [1]e uma no array [2], que no caso A0 e A1
  char c;
void setup()
{
  Serial.begin(9600);
  delay(1000);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  pinMode(2,OUTPUT);
  pinMode(3,OUTPUT);
  pinMode(4,OUTPUT);
  pinMode(5,OUTPUT);  
  pinMode(8,OUTPUT);

  digitalWrite(2,0);
  digitalWrite(3,0);
  digitalWrite(4,0);
  digitalWrite(5,0); // simula GND
  digitalWrite(8,0);  
  
}


void loop()
{

  
  if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  {

    bool done = false;
    while (!done)
    {

      done = radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 2 , mesmo numero do array do int joystick
      Serial.println(SINAIS[0]);// Imprime o valor do A0
      digitalWrite(5,1); // acende azul RGB
      digitalWrite(3,0); // apaga vermelho RGB
      digitalWrite(8,1); // acende shield
    }
  }
  else
  {    
   digitalWrite(5,0); // apaga azul RGB
   digitalWrite(3,1); // acende vermelho RGB
   digitalWrite(8,0); // apaga shield

  }

}
