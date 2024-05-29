char c;
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   8  // se for arduino mega mudar para 8
#define CSN_PIN 53 // se for arduino mega mudar para 53
const uint64_t pipe = 0xE8E8F0F0E1LL;
RF24 radio(CE_PIN, CSN_PIN);
int SINAIS[30];
int x;
int Vezes1,Vezes2;
void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  pinMode(2,INPUT);
  pinMode(3,INPUT);
  pinMode(5,OUTPUT);
  pinMode(6,OUTPUT);


  x=0;
  Vezes1=0;
  Vezes2=0;

}



void loop()  
{
 if (x==0)
 {
  if(digitalRead(2)==1&&Vezes1==0) // 
  {
   digitalWrite(5,!digitalRead(5));
   Vezes1=1;
   radio.stopListening();;  // para o recebimento
   radio.openWritingPipe(pipe); // inicia envio
   SINAIS[0]=33;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
   radio.write(SINAIS,sizeof(SINAIS));
   SINAIS[0]=9;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
   radio.openReadingPipe(1,pipe);// abre o recebimento
   radio.startListening();; 
  }
      
 if(digitalRead(2)==0&&Vezes1==1) // 
 {
  digitalWrite(5,!digitalRead(5));
  Vezes1 = 0;
  radio.stopListening();;  // para o recebimento
  radio.openWritingPipe(pipe); // inicia envio
  SINAIS[0]=33;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
  radio.write(SINAIS,sizeof(SINAIS));
  SINAIS[0]=9;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
  radio.openReadingPipe(1,pipe);// abre o recebimento
  radio.startListening();;
 } 

 
 if(digitalRead(3)==1&&Vezes2==0) // 
  {
   digitalWrite(6,!digitalRead(6));
   Vezes2=1;
   radio.stopListening();;  // para o recebimento
   radio.openWritingPipe(pipe); // inicia envio
   SINAIS[0]=33;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
   radio.write(SINAIS,sizeof(SINAIS));
   SINAIS[0]=9;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
   radio.openReadingPipe(1,pipe);// abre o recebimento
   radio.startListening();; 
  }
      
 if(digitalRead(3)==0&&Vezes2==1) // 
 {
  digitalWrite(6,!digitalRead(6));
  Vezes2 = 0;
  radio.stopListening();;  // para o recebimento
  radio.openWritingPipe(pipe); // inicia envio
  SINAIS[0]=33;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
  radio.write(SINAIS,sizeof(SINAIS));
  SINAIS[0]=9;// ATRIBUI 1 PARA ENVIAR PARA A LAMPADA 
  radio.openReadingPipe(1,pipe);// abre o recebimento
  radio.startListening();;
 }
 

 if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {  
  // ABRE O RECEBIMENT0
  radio.read( SINAIS, sizeof(SINAIS) );
  // SE RECEBER O VALOR EM 10 ENVIADO DA CENTRAL, DESLIGA TODAS AS LAMPADAS
  // usado para sincronizar
  if(SINAIS[0]==10){digitalWrite(5,LOW);}
  if(SINAIS[1]==10){digitalWrite(6,LOW);}     

  // SE RECEBER O VALOR EM 1000 ENVIADO DA CENTRAL, ALTERA O STATUS DA LAMPADA
  if(SINAIS[0]==1000){digitalWrite(5,!digitalRead(5));}
  if(SINAIS[1]==1000){digitalWrite(6,!digitalRead(6));}

   
  SINAIS[0]=9;
  SINAIS[1]=9;

 }






 }

if (x==1)
{


}


}

