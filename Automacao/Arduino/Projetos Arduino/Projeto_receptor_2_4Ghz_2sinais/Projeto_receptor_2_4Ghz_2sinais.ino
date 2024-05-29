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

#define CE_PIN   48
#define CSN_PIN 49

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089

RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

int joystick[2];  // Define um array de 2 , ou seja, recebera duas vezes as informações, sendo uma no array [1]e uma no array [2], que no caso A0 e A1

void setup()
{
  Serial.begin(9600);
  delay(1000);
  Serial.println("Nrf24L01 Receptor ativo");
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
}


void loop()
{
  if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  {

    bool done = false;
    while (!done)
    {

      done = radio.read( joystick, sizeof(joystick) ); // Recebe o sinal de Array em 2 , mesmo numero do array do int joystick
      Serial.print("X = ");
      Serial.print(joystick[0]);// Imprime o valor do A0
      Serial.print(" Y = ");      
      Serial.println(joystick[1]); // Imprime o valor do A1
    }
  }
  else
  {    
  // Nao faz nada e fica parado esperando chegar sinal
  }

}
