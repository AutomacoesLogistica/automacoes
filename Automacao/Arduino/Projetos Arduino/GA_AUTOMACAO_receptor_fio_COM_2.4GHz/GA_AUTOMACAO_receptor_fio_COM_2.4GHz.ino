/*
ARDUINO UNO MAIS MODULO 2.4GHZ + RECEBENDO DADOS DA SERIAL E ENVIANDO

* TRABALHA JUNTO AO >>>>> GA_AUTOMACAO_receptor_fio_SEM_2.4GHz <<<<<<

 Conexos do Modulo de 2.4Ghz
      
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




#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN  9  // se for arduino mega mudar para 8
#define CSN_PIN 10 // se for arduino mega mudar para 53

const uint64_t pipe = 0xE8E8F0F0E1LL;
RF24 radio(CE_PIN, CSN_PIN);

int SINAIS[15]; //referente as 15 entradas e/ou saidas
int x;
int sinal_recebido;
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


pinMode(A0,OUTPUT); // entrada A0 do RX
pinMode(A1,OUTPUT); // entrada A1 do RX
pinMode(A2,OUTPUT); // entrada A2 do RX
pinMode(A3,OUTPUT); // entrada A3 do RX
pinMode(A4,OUTPUT); // entrada A4 do RX
pinMode(A5,OUTPUT); // entrada A5 do RX
pinMode(2,OUTPUT); // entrada 2 do RX
pinMode(3,OUTPUT); // entrada 3 do RX
pinMode(4,OUTPUT); // entrada 4 do RX
pinMode(5,OUTPUT); // entrada 5 do RX
pinMode(6,OUTPUT); // entrada 6 do RX
pinMode(7,OUTPUT); // entrada 7 do RX

// Define todas inicar em 0
digitalWrite(A0,0); // referente a entrada A0
digitalWrite(A1,0); // referente a entrada A1
digitalWrite(A2,0); // referente a entrada A2
digitalWrite(A3,0); // referente a entrada A3
digitalWrite(A4,0); // referente a entrada A4
digitalWrite(A5,0); // referente a entrada A5
digitalWrite(2,0); // referente a entrada 2
digitalWrite(3,0); // referente a entrada 3
digitalWrite(4,0); // referente a entrada 4
digitalWrite(5,0); // referente a entrada 5
digitalWrite(6,0); // referente a entrada 6
digitalWrite(7,0); // referente a entrada 7


x = 0; // entrada para atualizar supervisorio
sinal_recebido = 0;
}



void loop()  
{
// usasdo no timer do LED do Wireless
 unsigned long tempo = millis();


if (timer_ativo == 1)
{
  if(tempo - valorTempo > intervalo) 
 {
  valorTempo = tempo;
  digitalWrite(8,1);
  numero_vezes_loop++;
 }
 if(numero_vezes_loop == 2 ) // aqui voce define o numero de vezes do loop do timer
 { 
  digitalWrite(8,0);
  timer_ativo = 0;
  numero_vezes_loop = 0;
 }
}

// ********************************************************************************************************************************************************************************

  
 // Mapeia algo recebido pela serial     
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString+=c; 
 }


   // ATUALIZA A SAIDA AO
   if(readString.indexOf("Entrada A0")>=0)     
   {
    x=1;
   }
   
    // ATUALIZA A SAIDA A1
   if(readString.indexOf("Entrada A1")>=0)     
   {
    x=2;
   }
   
    // ATUALIZA A SAIDA A2
   if(readString.indexOf("Entrada A2")>=0)     
   {
    x=3;  
   }
   
    // ATUALIZA A SAIDA A3
   if(readString.indexOf("Entrada A3")>=0)     
   {
    x=4; 
   }
   
    // ATUALIZA A SAIDA A4
   if(readString.indexOf("Entrada A4")>=0)     
   {
    x=5;  
   }
   
    // ATUALIZA A SAIDA A5
   if(readString.indexOf("Entrada A5")>=0)     
   {
    x=6;
   }
   
    // ATUALIZA A SAIDA 2
   if(readString.indexOf("Entrada 2")>=0)     
   {
   x=7;
   }
   
   // ATUALIZA A SAIDA 3
   if(readString.indexOf("Entrada 3")>=0)     
   {
    x=8;
   }
   
   // ATUALIZA A SAIDA 4
   if(readString.indexOf("Entrada 4")>=0)     
   {
    x=9;
   }
   
   // ATUALIZA A SAIDA 5
   if(readString.indexOf("Entrada 5")>=0)     
   {
    x=10;
   }
   
   // ATUALIZA A SAIDA 6
   if(readString.indexOf("Entrada 6")>=0)     
   {
    x=11;
   }
   
   // ATUALIZA A SAIDA 7
   if(readString.indexOf("Entrada 7")>=0)     
   {
    x=12;
   }
   
   // ATUALIZA A SAIDA 8
   if(readString.indexOf("Entrada 8")>=0)     
   {
    x=13;
   }
   
    // ATUALIZA A SAIDA 9
   if(readString.indexOf("Entrada 9")>=0)     
   {
    x=14;
   }
   
    // ATUALIZA A SAIDA 10
   if(readString.indexOf("Entrada 10")>=0)     
   {
    x=15;
   }
   
   
  readString="";
 


// Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  if(radio.available()|| (x>0 && x<16) ) 
  {
    radio.read( SINAIS, sizeof(SINAIS) );
    
  

//  USADO PARA SINCRONIZAR ***************************************************************************************************************************************************************

 if( SINAIS[0]==1111 && sinal_recebido==0 )
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
   Serial.println("Ssaida8");  
   Serial.println("Ssaida9");  
   Serial.println("Ssaida10");  

   x=0;
   sinal_recebido=1;
   }
  
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[0]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }
   
  









//  ATUALIZA A SAIDA A0 ***************************************************************************************************************************************************************

 if((SINAIS[0]==1023 && sinal_recebido==0 ) || x==1 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
  
   digitalWrite(A0,!digitalRead(A0));
   x=0;
   sinal_recebido=1;
   }
  
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[0]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }
   
   
//  ATUALIZA A SAIDA A1 ***************************************************************************************************************************************************************   

 if((SINAIS[1]==1023 && sinal_recebido==0 ) || x==2 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(A1,!digitalRead(A1));
   x=0;
   sinal_recebido=1;
  
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[1]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }
   
   }

//  ATUALIZA A SAIDA A2 ***************************************************************************************************************************************************************

 if((SINAIS[2]==1023 && sinal_recebido==0 ) || x==3 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(A2,!digitalRead(A2));
   x=0;
   sinal_recebido=1;
 
   // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[2]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA A3 ***************************************************************************************************************************************************************

 if((SINAIS[3]==1023 && sinal_recebido==0 ) || x==4 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(A3,!digitalRead(A3));
   x=0;
   sinal_recebido=1;
    
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
   if(SINAIS[3]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   } 
   }

//  ATUALIZA A SAIDA A4 ***************************************************************************************************************************************************************

  if((SINAIS[4]==1023 && sinal_recebido==0 ) || x==5 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(A4,!digitalRead(A4));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
   if(SINAIS[4]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA A5 ***************************************************************************************************************************************************************

 if((SINAIS[5]==1023 && sinal_recebido==0 ) || x==6 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(A5,!digitalRead(A5));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[5]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }
   
//  ATUALIZA A SAIDA 2 ***************************************************************************************************************************************************************

 if((SINAIS[6]==1023 && sinal_recebido==0 ) || x==7 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(2,!digitalRead(2));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[6]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA 3 ***************************************************************************************************************************************************************

 if((SINAIS[7]==1023 && sinal_recebido==0 ) || x==8 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(3,!digitalRead(3));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[7]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA 4 ***************************************************************************************************************************************************************

 if((SINAIS[8]==1023 && sinal_recebido==0 ) || x==9 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(4,!digitalRead(4));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[8]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA 5 ***************************************************************************************************************************************************************

 if((SINAIS[9]==1023 && sinal_recebido==0 ) || x==10 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(5,!digitalRead(5));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[9]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA 6 ***************************************************************************************************************************************************************

 if((SINAIS[10]==1023 && sinal_recebido==0 ) || x==11 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(6,!digitalRead(6));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[10]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA 7 ***************************************************************************************************************************************************************

 if((SINAIS[11]==1023 && sinal_recebido==0 ) || x==12 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   digitalWrite(7,!digitalRead(7));
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[11]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }


//  ATUALIZA A SAIDA 8 ***************************************************************************************************************************************************************

 if((SINAIS[12]==1023 && sinal_recebido==0 ) || x==13 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   Serial.println("saida 8");
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[12]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }

//  ATUALIZA A SAIDA 9 ***************************************************************************************************************************************************************

 if((SINAIS[13]==1023 && sinal_recebido==0 ) || x==14 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   Serial.println("saida 9");
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[13]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }


//  ATUALIZA A SAIDA 10 ***************************************************************************************************************************************************************

 if((SINAIS[14]==1023 && sinal_recebido==0 ) || x==15 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   Serial.println("saida 10");
   x=0;
   sinal_recebido=1;
   
  // Parte incluida para zerar e alterar realmente o status da saida apenas 1 vezes ,eliminando o for enviado
    if(SINAIS[14]==10 && sinal_recebido==1 )
   {
   sinal_recebido=0;
   }  
   }


  }
  
  else
  {
  }

}
















