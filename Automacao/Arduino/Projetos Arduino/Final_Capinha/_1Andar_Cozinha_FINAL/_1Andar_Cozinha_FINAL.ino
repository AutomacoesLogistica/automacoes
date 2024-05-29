/*
LOGICA DO PRIMEIRO ANDAR, DO LADO DA COZINHA

SINAIS[20] - LUZ TETO SALA TV
SINAIS[21] - LUZ AMBIENTE SALA TV
SINAIS[22] - LUZ TETO COZINHA
SINAIS[23] - LUZ AMBIENTE COZINHA
SINAIS[24] - LUZ TETO AREA
SINAIS[25] - LUZ DO MURO

RX/TX
SINAIS[26] - LUZ REFLETOR DA PISCINA
SINAIS[27] - LUZ TETO AREA CHURRASCO
SINAIS[28] - LUZ DO MURO PISCINA


*/
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN  9  // se for arduino mega mudar para 8
#define CSN_PIN 10 // se for arduino mega mudar para 53

const uint64_t pipe = 0xE8E8F0F0E1LL;
RF24 radio(CE_PIN, CSN_PIN);

int SINAIS[1]; 
int sinal_recebido;
int vezes1,vezes2,vezes3,vezes4,vezes5,vezes6;



void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;

pinMode(A0,INPUT); //
pinMode(A1,INPUT); //
pinMode(A2,INPUT); //
pinMode(A3,INPUT); //
pinMode(A4,INPUT); //
pinMode(A5,INPUT); //

pinMode(2,OUTPUT); // 
pinMode(3,OUTPUT); // 
pinMode(4,OUTPUT); // 
pinMode(5,OUTPUT); // 
pinMode(6,OUTPUT); //  
pinMode(7,OUTPUT); //  


// Define todas inicar em 0
digitalWrite(2,0); // referente a entrada A0
digitalWrite(3,0); // referente a entrada A1
digitalWrite(4,0); // referente a entrada A2
digitalWrite(5,0); // referente a entrada A3
digitalWrite(6,0); // referente a entrada A4
digitalWrite(7,0); // referente a entrada A5


sinal_recebido = 0;
}



void loop()  
{

 // MAPEIA 2 ****************************************************************************************************************************************************************
 if(digitalRead(A0)==1&&vezes1==0)
 {
  digitalWrite(2,!digitalRead(2));
  vezes1=1; 
 }
 if(digitalRead(A0)==0&&vezes1==1) 
 {
  digitalWrite(2,!digitalRead(2));
  vezes1=0; 
 } 

 // MAPEIA 3 ****************************************************************************************************************************************************************
 if(digitalRead(A1)==1&&vezes2==0)
 {
  digitalWrite(3,!digitalRead(3)); 
  vezes2=1; 
 }
 if(digitalRead(A1)==0&&vezes2==1) 
 {
  digitalWrite(3,!digitalRead(3)); 
  vezes2=0; 
 } 

 // MAPEIA 4 ****************************************************************************************************************************************************************
 if(digitalRead(A2)==1&&vezes3==0)
 {
  digitalWrite(4,!digitalRead(4)); 
  vezes3=1; 
 }
 if(digitalRead(A2)==0&&vezes3==1) 
 {
  digitalWrite(4,!digitalRead(4)); 
  vezes3=0; 
 } 

 // MAPEIA 5 ****************************************************************************************************************************************************************
 if(digitalRead(A3)==1&&vezes4==0)
 {
  digitalWrite(5,!digitalRead(5)); 
  vezes4=1; 
 }
 if(digitalRead(A3)==0&&vezes4==1) 
 {
  digitalWrite(5,!digitalRead(5)); 
  vezes4=0; 
 } 


 // MAPEIA 7 ****************************************************************************************************************************************************************
 if(digitalRead(A5)==1&&vezes6==0)
 {
  digitalWrite(7,!digitalRead(7)); 
  vezes6=1; 
 }
 if(digitalRead(A5)==0&&vezes6==1) 
 {
  digitalWrite(7,!digitalRead(7)); 
  vezes6=0; 
 } 








  if(radio.available()) 
  {
    radio.read( SINAIS, sizeof(SINAIS) );

//  USADO PARA SINCRONIZAR ***************************************************************************************************************************************************************

   if( SINAIS[0]==129 && sinal_recebido==0 )
   {
   digitalWrite(2,0);
   digitalWrite(3,0);
   digitalWrite(4,0);
   digitalWrite(5,0);
   digitalWrite(7,0);
   Serial.println("sin"); // PARA ZERAR AS 3 DIGITAIS QUE ESTAO ASSOCIADAS A ESSE PELA SERIAL
   sinal_recebido=1;
   }

  
  //  ATUALIZA A SAIDA 2 ***************************************************************************************************************************************************************

   if((SINAIS[0]==120 && sinal_recebido==0 ))
   {
   digitalWrite(2,!digitalRead(2));
   sinal_recebido=1;
   }
   
//  ATUALIZA A SAIDA 3 ***************************************************************************************************************************************************************   

   if((SINAIS[0]==121 && sinal_recebido==0 ))
   {
   digitalWrite(3,!digitalRead(3));
   sinal_recebido=1;
   }

//  ATUALIZA A SAIDA 4 ***************************************************************************************************************************************************************

   if((SINAIS[0]==122 && sinal_recebido==0 ))
   {
   digitalWrite(4,!digitalRead(4));
   sinal_recebido=1;
   }

//  ATUALIZA A SAIDA 5 ***************************************************************************************************************************************************************

   if((SINAIS[0]==123 && sinal_recebido==0 ))
   {
   digitalWrite(5,!digitalRead(5));
   sinal_recebido=1;
   }
   
//  ATUALIZA A SAIDA 6 ***************************************************************************************************************************************************************

   if((SINAIS[0]==124 && sinal_recebido==0 ))
   {
   Serial.println("124");  
   sinal_recebido=1;
   }

//  ATUALIZA A SAIDA 7 ***************************************************************************************************************************************************************

   if((SINAIS[0]==125 && sinal_recebido==0 ))
   {
   digitalWrite(7,!digitalRead(7));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA 2 pela serial *********************************************************************************************************************************************************

 if((SINAIS[0]==126 && sinal_recebido==0 ))
   {
   Serial.println("126");
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA 3 pela serial *********************************************************************************************************************************************************

   if((SINAIS[0]==127 && sinal_recebido==0 ))
   {
   Serial.println("127");
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA 4 pela serial *********************************************************************************************************************************************************

 if((SINAIS[0]==128 && sinal_recebido==0 ))
   {
   Serial.println("128");
   sinal_recebido=1;
   }
   
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[0]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
  }
}









