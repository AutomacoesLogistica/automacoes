/*
ARDUINO UNO MAIS MODULO 2.4GHZ + RECEBENDO DADOS DA SERIAL E ENVIANDO

* >>>>>> CENTRAL <<<<<<

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




int x;
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

// Variaveis e Pinos
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal
int SINAIS[15];  // Numero de canais
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
  x=0;
}
//******************************************************************************************************************************************************************************************

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
   if(readString.indexOf("Entrada A0")>=0||readString.indexOf("SINAIS[0]")>=0)     
   {
    x=1;
   }
   
    // ATUALIZA A SAIDA A1
   if(readString.indexOf("Entrada A1")>=0||readString.indexOf("SINAIS[1]")>=0)     
   {
    x=2;
   }
   
    // ATUALIZA A SAIDA A2
   if(readString.indexOf("Entrada A2")>=0||readString.indexOf("SINAIS[2]")>=0)     
   {
    x=3;  
   }
   
    // ATUALIZA A SAIDA A3
   if(readString.indexOf("Entrada A3")>=0||readString.indexOf("SINAIS[3]")>=0)     
   {
    x=4; 
   }
   
    // ATUALIZA A SAIDA A4
   if(readString.indexOf("Entrada A4")>=0||readString.indexOf("SINAIS[4]")>=0)     
   {
    x=5;  
   }
   
    // ATUALIZA A SAIDA A5
   if(readString.indexOf("Entrada A5")>=0||readString.indexOf("SINAIS[5]")>=0)     
   {
    x=6;
   }
   
    // ATUALIZA A SAIDA 2
   if(readString.indexOf("Entrada 2")>=0||readString.indexOf("SINAIS[6]")>=0)     
   {
   x=7;
   }
   
   // ATUALIZA A SAIDA 3
   if(readString.indexOf("Entrada 3")>=0||readString.indexOf("SINAIS[7]")>=0)     
   {
    x=8;
   }
   
   // ATUALIZA A SAIDA 4
   if(readString.indexOf("Entrada 4")>=0||readString.indexOf("SINAIS[8]")>=0)     
   {
    x=9;
   }
   
   // ATUALIZA A SAIDA 5
   if(readString.indexOf("Entrada 5")>=0||readString.indexOf("SINAIS[9]")>=0)     
   {
    x=10;
   }
   
   // ATUALIZA A SAIDA 6
   if(readString.indexOf("Entrada 6")>=0||readString.indexOf("SINAIS[10]")>=0)     
   {
    x=11;
   }
   
   // ATUALIZA A SAIDA 7
   if(readString.indexOf("Entrada 7")>=0||readString.indexOf("SINAIS[11]")>=0)     
   {
    x=12;
   }
   
   // ATUALIZA A SAIDA 8
   if(readString.indexOf("Entrada 8")>=0||readString.indexOf("SINAIS[12]")>=0)     
   {
    x=13;
   }
   
    // ATUALIZA A SAIDA 9
   if(readString.indexOf("Entrada 9")>=0||readString.indexOf("SINAIS[13]")>=0)     
   {
    x=14;
   }
   
    // ATUALIZA A SAIDA 10
   if(readString.indexOf("Entrada 10")>=0||readString.indexOf("SINAIS[14]")>=0)     
   {
    x=15;
   }
   
   if(readString.indexOf("sincronizar")>=0)     
   {
    x=1000;
   }
   
  readString="";
 
 
  
  // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  if(radio.available()||(x>0 && x<16)||x==1000) // x==1000 é para sincronizar
  {
    radio.read( SINAIS, sizeof(SINAIS) );
    
 
// USADO PARA SINCRONIZAR *************************************************************
  if( x==1000 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=1111;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Sincronizado");
   x=0;
   }
      
 // ***********************************************************************************     
 if( x==1 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A0");
   x=0;
   }
   
 if( x==2 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[1]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A1");
   x=0;
   }
  
 if( x==3 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[2]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A2");
   x=0;
   }

 if( x==4 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[3]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A3");
   x=0;
   }

 if( x==5 )
   {
   timer_ativo = 1;  
   digitalWrite(8,1); // acende shield
   SINAIS[4]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A4");
   x=0;
   }


 if( x==6 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[5]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada A5");
   x=0;
   }


 if( x==7 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[6]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 2");
   x=0;
   }

 if( x==8 )
   {
   timer_ativo = 1;  
   digitalWrite(8,1); // acende shield
   SINAIS[7]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 3");
   x=0;
   }


 if( x==9 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[8]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 4");
   x=0;
   }

 if( x==10 )
   {
   timer_ativo = 1;  
   digitalWrite(8,1); // acende shield
   SINAIS[9]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 5");
   x=0;
   }

 if( x==11 )
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[10]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 6");
   x=0;
   }

 if( x==12 )
   {
   timer_ativo = 1;  
   digitalWrite(8,1); // acende shield
   SINAIS[11]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 7");
   x=0;
   }

 if( x==13 )
   {
   timer_ativo = 1;  
   digitalWrite(8,1); // acende shield
   SINAIS[12]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 8");
   x=0;
   }

 if( x==14 )
   {
   timer_ativo = 1;  
   digitalWrite(8,1); // acende shield
   SINAIS[13]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 9");
   x=0;
   }

 if( x==15 )
   {
   timer_ativo = 1;  
   digitalWrite(8,1); // acende shield
   SINAIS[14]=1023;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
   Serial.println("Entrada 10");
   x=0;
   }

  }
  
  else
  {
   
  }
  
   // USADO SEMPRE PARA SAIR DO LACO FOR DE ALTERACAO DE STATUS
    SINAIS[0]=10;
    SINAIS[1]=10;
    SINAIS[2]=10;   
    SINAIS[3]=10;
    SINAIS[4]=10;
    SINAIS[5]=10;
    SINAIS[6]=10;
    SINAIS[7]=10;
    SINAIS[8]=10;
    SINAIS[9]=10;
    SINAIS[10]=10;
    SINAIS[11]=10;
    SINAIS[12]=10;
    SINAIS[13]=10;
    SINAIS[14]=10;
    
    radio.stopListening();;
    radio.openWritingPipe(pipe);
    radio.write(SINAIS ,sizeof(SINAIS));
    radio.openReadingPipe(1,pipe);
    radio.startListening();;

}
//******************************************************************************************************************************************************************************************

