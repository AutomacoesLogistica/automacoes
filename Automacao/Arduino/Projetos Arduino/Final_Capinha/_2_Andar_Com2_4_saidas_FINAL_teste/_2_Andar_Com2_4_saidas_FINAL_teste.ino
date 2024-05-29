/*
LOGICA DO SEGUNDO ANDAR

SINAIS[0] - VARANDA DO QUARTO DA JULIANA
SINAIS[1] - LUZ DO TETO DO QUARTO DA JULIANA
SINAIS[2] - LUZ AMBIENTE DO QUARTO JULIANA
SINAIS[3] - FITA DE LET DO QUARTO DA JULIANA
SINAIS[4] - LUZ DO TETO DO CLOSET 
SINAIS[5] - LUZ AMBIENTE DO CLOSET
SINAIS[6] - LUZ TETO SALA DE TV
SINAIS[7] - LUZ AMBIENTE SALA DE TV
SINAIS[8] - LUZ TETO ACESSO AO CORREDOR DO QUARTO DO CAPINHA
SINAIS[9] - LUZ DO TETO DO CORREDOR DO QUARTO DO CAPINHA
SINAIS[10] - LUZ DO TETO DO QUARTO DO CAPINHA
SINAIS[11] - LUZ AMBIENTE QUARTO CAPINHA
SINAIS[12] - LUZ DA VARANDA DO QUARTO DO CAPINHA
SINAIS[13] - LUZ DO TETO APOS ESCDADA DO PRIMEIRO PARA SEGUNDO ANDAR


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
int vezes0,vezes1,vezes2,vezes3,vezes4,vezes5,vezes6,vezes7,vezes8,vezes9,vezes10,vezes11,vezes12,vezes13,vezes14;
String readString;


// usado no timer do wireless
long valorTempo = 0; 
long intervalo = 1000; // DEFINE O TEMPO DO TIMER
int numero_vezes_loop;
int timer_ativo;

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  pinMode(8,OUTPUT);
  digitalWrite(8,0); // usado para atualizar o LED WIRELESS
  timer_ativo = 0;
  numero_vezes_loop = 0;

pinMode(A0,OUTPUT); //
pinMode(A1,OUTPUT); //
pinMode(A2,OUTPUT); //
pinMode(A3,OUTPUT); //
pinMode(A4,OUTPUT); //
pinMode(A5,OUTPUT); //
pinMode(2,OUTPUT); //
pinMode(3,OUTPUT); //
pinMode(4,OUTPUT); //
pinMode(5,OUTPUT); //
pinMode(6,OUTPUT); //
pinMode(7,OUTPUT); //

}



void loop()  
{
 // Mapeia algo recebido pela serial     
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString+=c; 
 }

     // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("100"))>=0)     
   {
   digitalWrite(A0,!digitalRead(A0));
   }
   
     // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("101"))>=0)     
   {
   digitalWrite(A1,!digitalRead(A1));
   }
   
     // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("102"))>=0)     
   {
   digitalWrite(A2,!digitalRead(A2));
   }
   
     // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("103"))>=0)     
   {
   digitalWrite(A3,!digitalRead(A3));
   }
       // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("104"))>=0)     
   {
   digitalWrite(A4,!digitalRead(A4));
   }
        // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("105"))>=0)     
   {
   digitalWrite(A5,!digitalRead(A5));
   }

        // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("106"))>=0)     
   {
   digitalWrite(2,!digitalRead(2));
   }
   
        // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("107"))>=0)     
   {
   digitalWrite(3,!digitalRead(3));
   }
   
        // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("108"))>=0)     
   {
   digitalWrite(4,!digitalRead(4));
   }
   
        // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("109"))>=0)     
   {
   digitalWrite(5,!digitalRead(5));
   }
   
        // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("110"))>=0)     
   {
   digitalWrite(6,!digitalRead(6));
   }
   
        // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("111"))>=0)     
   {
   digitalWrite(7,!digitalRead(7));
   }
   
  readString="";
 






// Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  if(radio.available()) 
  {
    radio.read( SINAIS, sizeof(SINAIS) );
  
  //  USADO PARA SINCRONIZAR ***************************************************************************************************************************************************************
  
   if( SINAIS[0]==129 && sinal_recebido==0 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
  
   digitalWrite(A0,0);  
   digitalWrite(A1,0);
   digitalWrite(A2,0);
   digitalWrite(A3,0);
   digitalWrite(A4,0);
   digitalWrite(A5,0);
   digitalWrite(2,0);
   digitalWrite(3,0);
   digitalWrite(4,0);
   digitalWrite(5,0);
   digitalWrite(6,0);
   digitalWrite(7,0);
   Serial.println(F("sin"));
   sinal_recebido=1;
   }

  
  //  ATUALIZA A SAIDA A0 ***************************************************************************************************************************************************************
  
   if(SINAIS[0]==100 && sinal_recebido==0 )
   {
   digitalWrite(A0,!digitalRead(A0));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA A1 ***************************************************************************************************************************************************************
  
   if(SINAIS[0]==101 && sinal_recebido==0 )
   {
   digitalWrite(A1,!digitalRead(A1));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA A2 ***************************************************************************************************************************************************************
 
   if(SINAIS[0]==102 && sinal_recebido==0 )
   {
   digitalWrite(A2,!digitalRead(A2));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA A3 ***************************************************************************************************************************************************************

   if(SINAIS[0]==103 && sinal_recebido==0 )
   {
   digitalWrite(A3,!digitalRead(A3));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA A4 ***************************************************************************************************************************************************************
  
   if(SINAIS[0]==104 && sinal_recebido==0 )
   {
   digitalWrite(A4,!digitalRead(A4));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA A5 ***************************************************************************************************************************************************************

   if(SINAIS[0]==105 && sinal_recebido==0 )
   {
   digitalWrite(A5,!digitalRead(A5));
   sinal_recebido=1;
   }
  
  //  ATUALIZA A SAIDA 2 ***************************************************************************************************************************************************************
 
   if(SINAIS[0]==106 && sinal_recebido==0 )
   {
    sinal_recebido=1;
   digitalWrite(2,!digitalRead(2)); 
   }

  //  ATUALIZA A SAIDA 3 ***************************************************************************************************************************************************************

   if(SINAIS[0]==107 && sinal_recebido==0 )
   {
   digitalWrite(3,!digitalRead(3));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA 4 ***************************************************************************************************************************************************************

   if(SINAIS[0]==108 && sinal_recebido==0 )
   {
   digitalWrite(4,!digitalRead(4));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA 5 ***************************************************************************************************************************************************************
 
   if(SINAIS[0]==109 && sinal_recebido==0 )
   {
   digitalWrite(5,!digitalRead(5));
   sinal_recebido=1;
   }
  

  //  ATUALIZA A SAIDA 6 ***************************************************************************************************************************************************************

   if(SINAIS[0]==110 && sinal_recebido==0 )
   {
   digitalWrite(6,!digitalRead(6));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA 7 ***************************************************************************************************************************************************************
 
  if(SINAIS[0]==111 && sinal_recebido==0 )
   {
   digitalWrite(7,!digitalRead(7));
   sinal_recebido=1;
   }

  //  ATUALIZA A SAIDA 8 ***************************************************************************************************************************************************************
  
   if(SINAIS[0]==112 && sinal_recebido==0 )
   {
   Serial.println(F("cen12"));
   sinal_recebido=1;
   }
   
 //  ATUALIZA A SAIDA 9 ***************************************************************************************************************************************************************
 
  if(SINAIS[0]==113 && sinal_recebido==0 )
  {
   Serial.println(F("cen13"));
   sinal_recebido=1;
   }
   
   
   // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[0]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }

  }
}









