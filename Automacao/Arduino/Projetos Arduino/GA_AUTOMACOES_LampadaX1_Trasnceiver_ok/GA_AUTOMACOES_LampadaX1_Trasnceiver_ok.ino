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
 */



//Importa as livrarias

#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   9  // se for arduino mega mudar para 8
#define CSN_PIN 10 // se for arduino mega mudar para 53
const uint64_t pipe = 0xE8E8F0F0E1LL;
RF24 radio(CE_PIN, CSN_PIN);
int SINAIS[30];

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  }



void loop()  
{
   char c;
   if (Serial.available()>0)
   {
   c = (Serial.read());
   }
  
  if(c=='1') 
  {
  radio.stopListening();;  
  radio.openWritingPipe(pipe);
  SINAIS[1] = 1000;
  for(int i = 0; i < 5; i++){
  radio.write(SINAIS,sizeof(SINAIS));
  }
  SINAIS[1] = 9;
  radio.write(SINAIS,sizeof(SINAIS)); 
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  }
  
  if(c=='2')
  {
  radio.stopListening();;  
  radio.openWritingPipe(pipe);
  SINAIS[1] = 500;
  for(int i = 0; i < 5; i++){
  radio.write(SINAIS,sizeof(SINAIS)); 
  }
  SINAIS[1] = 9;
  radio.write(SINAIS,sizeof(SINAIS)); 
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  } 
    

  }


