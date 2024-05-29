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

#define CE_PIN   9
#define CSN_PIN 10


// SINAIS A ENVIAR .........................................................................................................................................................................

#define ROTACAO A0
#define CORRENTE A1
#define TORQUE A2
#define PHMETRO A3
#define RESERVA1 A4
#define RESERVA2 A5


const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida


RF24 radio(CE_PIN, CSN_PIN); // Crea o Radio e ativa a transissão do sinal


int SINAIS[6];  // Array de 6 elementos

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
}



void loop()  
{
  SINAIS[0] = analogRead(ROTACAO); // Define que o array 0 sera o sinal da analogica A0
  SINAIS[1] = analogRead(CORRENTE); // Define que o array 0 sera o sinal da analogica A1
  SINAIS[2] = analogRead(TORQUE); // Define que o array 0 sera o sinal da analogica A2
  SINAIS[3] = analogRead(PHMETRO); // Define que o array 0 sera o sinal da analogica A3
  SINAIS[4] = analogRead(RESERVA1); // Define que o array 0 sera o sinal da analogica A4
  SINAIS[5] = analogRead(RESERVA2); // Define que o array 0 sera o sinal da analogica A5  
  
  radio.write( SINAIS, sizeof(SINAIS) ); // Comando para enviar o sinal e o sizeof(joystick),serve para enviar o sinal o numero de vezes que foi definido no array

}



