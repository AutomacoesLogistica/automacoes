/* Conexos do Modulo de 2.4Ghz
      
   1 - GND
   2 - VCC 3.3V ................Nao usar 5v , queima
   3 - CE to Arduino pin 9
   4 - CSN to Arduino pin 10
   5 - SCK to Arduino pin 13
   6 - MOSI to Arduino pin 11
   7 - MISO to Arduino pin 12
   8 - UNUSED
        
 - Produzido por: Bruno Gonçalves
 - Data : 05/06/14
*/


// Carrega as Bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   48
#define CSN_PIN 49


// SINAIS A ENVIAR .........................................................................................................................................................................

#define PHMETRO A0
#define TURBIDIMETRO A1


const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida


RF24 radio(CE_PIN, CSN_PIN); // Crea o Radio e ativa a transissão do sinal


int SINAIS[2];  // Array de 3 elementos

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
}



void loop()  
{
  SINAIS[0] = analogRead(PHMETRO); // Define que o array 0 sera o sinal da analogica A0
  SINAIS[1] = analogRead(TURBIDIMETRO); // Define que o array 0 sera o sinal da analogica A1
  SINAIS[2] = 0;
  
  radio.write( SINAIS, sizeof(SINAIS) ); // Comando para enviar o sinal e o sizeof(joystick),serve para enviar o sinal o numero de vezes que foi definido no array

}



