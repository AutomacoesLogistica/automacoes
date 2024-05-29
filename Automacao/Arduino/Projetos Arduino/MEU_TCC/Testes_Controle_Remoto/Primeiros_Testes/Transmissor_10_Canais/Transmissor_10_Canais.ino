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
   
   Ligacao dos SINAIS de 10K: ( POTENCIOMETROS)
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
#define SINAIS_X A0
#define SINAIS_Y A1
#define SINAIS_Z A2
#define SINAIS_W A3
#define SINAIS_Q A4



const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida


RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal



int SINAIS[11];  // Array de 2 elementos , se for enviar 5 , seria SINAIS[5] e assim por diante
int mapSINAIS[11]; 

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openWritingPipe(pipe);
  pinMode(2,INPUT);
  pinMode(3,INPUT);
  pinMode(4,INPUT);
  pinMode(5,INPUT);
  pinMode(6,INPUT);  
  pinMode(7,OUTPUT);
  pinMode(8,OUTPUT); 
  digitalWrite(7,0);
  digitalWrite(8,0); 
  
}



void loop()  
{
  SINAIS[0] = analogRead(SINAIS_X); // Define que o array 0 sera o sinal da analogica A0
  SINAIS[1] = analogRead(SINAIS_Y); // Define que o array 0 sera o sinal da analogica A1
  SINAIS[2] = analogRead(SINAIS_Z); // Define que o array 0 sera o sinal da analogica A2
  SINAIS[3] = analogRead(SINAIS_W); // Define que o array 0 sera o sinal da analogica A3  
  SINAIS[4] = analogRead(SINAIS_Q); // Define que o array 0 sera o sinal da analogica A4
   
  mapSINAIS[0] = map(SINAIS[0],137,861,10,1023); // Aileron
  mapSINAIS[1] = map(SINAIS[1],137,904,10,1023); // Profundor
  mapSINAIS[2] = map(SINAIS[2],81,873,10,1023); // Leme
  mapSINAIS[3] = map(SINAIS[3],79,915,1023,10); // Acelerador - Invertido
  mapSINAIS[4] = map(SINAIS[4],0,1023,1023,10); // Luz - Invertido

  SINAIS[0] = mapSINAIS[0]; // Define que o array 0 sera o sinal da analogica A0
  SINAIS[1] = mapSINAIS[1]; // Define que o array 0 sera o sinal da analogica A1
  SINAIS[2] = mapSINAIS[2]; // Define que o array 0 sera o sinal da analogica A2
  SINAIS[3] = mapSINAIS[3]; // Define que o array 0 sera o sinal da analogica A3  
  SINAIS[4] = mapSINAIS[4]; // Define que o array 0 sera o sinal da analogica A4


  if (digitalRead(2)==0){SINAIS[5] = 1000;  digitalWrite(7,1);}
  if (digitalRead(2)==1){SINAIS[5] = 500;  digitalWrite(7,0);}

  if (digitalRead(3)==0){SINAIS[6] = 1000;}
  if (digitalRead(3)==1){SINAIS[6] = 500;}

  if (digitalRead(4)==0){SINAIS[7] = 1000;}
  if (digitalRead(4)==1){SINAIS[7] = 500;}

  if (digitalRead(5)==0){SINAIS[8] = 1000;digitalWrite(8,1);}
  if (digitalRead(5)==1){SINAIS[8] = 500;digitalWrite(8,0);}

  if (digitalRead(6)==0){SINAIS[9] = 1000;}
  if (digitalRead(6)==1){SINAIS[9] = 500;}


  radio.write( SINAIS, sizeof(SINAIS) ); // Comando para enviar o sinal e o sizeof(SINAIS),serve para enviar o sinal o numero de vezes que foi definido no array
  
}


