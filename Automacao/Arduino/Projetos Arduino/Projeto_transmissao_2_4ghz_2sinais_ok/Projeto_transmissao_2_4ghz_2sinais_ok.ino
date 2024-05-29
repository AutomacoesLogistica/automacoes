/* Conexos do Modulo de 2.4Ghz
      
   1 - GND
   2 - VCC 3.3V                 NAO USAR 5V POIS QUEIMA
   3 - CE to Arduino pino 9
   4 - CSN to Arduino pino 10
   5 - SCK to Arduino pino 13
   6 - MOSI to Arduino pino 11
   7 - MISO to Arduino pino 12
   8 - Nao usado
   - 
   
   Ligacao dos Joystick de 10K: ( POTENCIOMETROS)
   Arduino GND
   VCC do Arduino +5V
   Centro do 1 potenciometro vai a entrada A0 (x)
   Centro do 2 potenciometro vai a entrada A1 (y)
   
 - Produzido por: Bruno Gonçalves
 - Data : 05/06/14
*/



//Importa as livrarias

#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

// Variaveis e Pinos
#define CE_PIN   9    // Se for arduino mega 48
#define CSN_PIN 10    // Se for arduino mega 49
#define JOYSTICK_X A0
#define JOYSTICK_Y A1


const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida


RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal



int joystick[2];  // Array de 2 elementos , se for enviar 5 , seria joystick[5] e assim por diante

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
}



void loop()  
{
  joystick[0] = analogRead(JOYSTICK_X); // Define que o array 0 sera o sinal da analogica A0
  joystick[1] = analogRead(JOYSTICK_Y); // Define que o array 0 sera o sinal da analogica A1
  
  radio.write( joystick, sizeof(joystick) ); // Comando para enviar o sinal e o sizeof(joystick),serve para enviar o sinal o numero de vezes que foi definido no array

}


