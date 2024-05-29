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

int SINAIS[11];  // Define um array de 2 , ou seja, recebera duas vezes as informações, sendo uma no array [1]e uma no array [2], que no caso A0 e A1
int mapSINAIS[11];
int modoIluminacao = 6;
int randomico=0;

int dadosLUZ;

void setup()
{
  Serial.begin(9600);
  pinMode(4,OUTPUT); // Iluminação vermelha 1 frente
  pinMode(5,OUTPUT); // Iluminação vermelha 2 frente
  pinMode(6,OUTPUT); // Iluminação verde 1 cauda
  pinMode(7,OUTPUT); // Iluminação verde 2 cauda
  pinMode(8,OUTPUT); // Iluminação branca base
  digitalWrite(4,0);
  digitalWrite(5,0);
  digitalWrite(6,0);
  digitalWrite(7,0);
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


      Serial.println(modoIluminacao);
  if (randomico == 1 )
{
  modoIluminacao = random(7);
  
}




if (modoIluminacao == 0)
{
  for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
}


if (modoIluminacao == 1)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }

  digitalWrite(4,1);
  delay(200);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(6,1);
  delay(200);
  digitalWrite(7,1);
  delay(200);
  digitalWrite(4,0);
  delay(200);
  digitalWrite(5,0);
  delay(200);
  digitalWrite(6,0);
  delay(200);
  digitalWrite(7,0);
  delay(200);


  
}

if (modoIluminacao == 2)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }

  digitalWrite(4,1);
  delay(200);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(6,1);
  delay(200);
  digitalWrite(7,1);
  delay(200);
  digitalWrite(7,0);
  delay(200);
  digitalWrite(6,0);
  delay(200);
  digitalWrite(5,0);
  delay(200);
  digitalWrite(4,0);
  delay(200);


}


if (modoIluminacao == 3)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  digitalWrite(7,0);
  digitalWrite(4,1);
  delay(200);
  digitalWrite(4,0);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(5,0);
  digitalWrite(6,1);
  delay(200);
  digitalWrite(6,0);
  digitalWrite(7,1);
  delay(200);
  
  
}

if (modoIluminacao == 4)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
  digitalWrite(6,0);
  digitalWrite(4,1);
  delay(200);
  digitalWrite(4,0);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(5,0);
  digitalWrite(7,1);
  delay(200);
  digitalWrite(7,0);
  digitalWrite(6,1);
  delay(200);
}


if (modoIluminacao == 5)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(4,1);
   digitalWrite(5,1);
   delay(100);
   digitalWrite(4,0);
   digitalWrite(5,0);
   delay(100);

  }
   digitalWrite(4,0);
   digitalWrite(5,0);

   for(int x = 0;x<5;x++ )
  {
   digitalWrite(6,1);
   digitalWrite(7,1);
   delay(100);
   digitalWrite(6,0);
   digitalWrite(7,0);
   delay(100);
   
  }
}

if (modoIluminacao == 6)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(4,1);
   digitalWrite(7,1);
   delay(100);
   digitalWrite(4,0);
   digitalWrite(7,0);
   delay(100);

  }
   digitalWrite(4,0);
   digitalWrite(7,0);

   for(int x = 0;x<5;x++ )
  {
   digitalWrite(5,1);
   digitalWrite(6,1);
   delay(100);
   digitalWrite(5,0);
   digitalWrite(6,0);
   delay(100);
   
  }
}


if (modoIluminacao == 7)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(4,1);
   delay(100);
   digitalWrite(4,0);
   delay(100);

  }
   digitalWrite(4,0);

   for(int x = 0;x<5;x++ )
  {
   digitalWrite(5,1);
   delay(100);
   digitalWrite(5,0);
   delay(100);

  }
   digitalWrite(5,0);
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(6,1);
   delay(100);
   digitalWrite(6,0);
   delay(100);

  }
   digitalWrite(6,0);
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(7,1);
   delay(100);
   digitalWrite(7,0);
   delay(100);

  }
}








     
      radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 2 , mesmo numero do array do int SINAIS
      
     


if (SINAIS[9]==1) 
 {
  SINAIS[9] = 0;
  if (randomico == 0 )
  {
   modoIluminacao++;
   if (digitalRead(8)==0)
   {
    digitalWrite(8,1);
    delay(200);
    digitalWrite(8,0);
   }
  }
  
  if (randomico == 1)
  {
    modoIluminacao = 0;
    randomico = 0;
  }
  if (modoIluminacao == 8 && randomico == 0)
  {
   randomico = 1;
  }
 }

 //*************************************************************************************************************************************************************************************
 


 if (SINAIS[8] == 1000) 
 {
  digitalWrite(8,1);
 }

 //*************************************************************************************************************************************************************************************
 
 if (SINAIS[8]==500) 
 {
  digitalWrite(8,0);
 }







    }
  }
  else
  {    
  // Nao faz nada e fica parado esperando chegar sinal
    
  }

}
