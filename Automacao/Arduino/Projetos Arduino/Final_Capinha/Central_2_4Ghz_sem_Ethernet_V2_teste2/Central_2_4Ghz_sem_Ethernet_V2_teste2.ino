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

#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

// Variaveis e Pinos
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e ativa a transissão do sinal
int x;
int SINAIS[1];  // Numero de canais
int Vstatus;
int conectado;

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
  pinMode(6,OUTPUT); //verde
  pinMode(7,OUTPUT); // azul
  pinMode(8,OUTPUT); // vermelho
  
  pinMode(5,OUTPUT); //alimenta o bluetooth
  
  digitalWrite(6,0); // apaga o led verde
  digitalWrite(7,1); // apaga o led azul
  digitalWrite(8,1); // acende o led vermelho
  delay(1000);
  
  digitalWrite(6,1); // apaga o led verde
  digitalWrite(7,0); // apaga o led azul
  digitalWrite(8,1); // acende o led vermelho
  delay(1000);
  
  digitalWrite(6,1); // apaga o led verde
  digitalWrite(7,1); // apaga o led azul
  digitalWrite(8,0); // acende o led vermelho
  
  pinMode (A5,INPUT);
  
  x=0;
  timer_ativo = 0;
  numero_vezes_loop = 0;  
  Vstatus = 0;
  conectado = 0;
  digitalWrite(5,0); // Desliga alimentação do bluetooth
  delay(500);
  digitalWrite(5,1); // Liga alimentação do bluetooth

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
  digitalWrite(7,1); // apaga azul
  digitalWrite(6,0); // acende o verde
  numero_vezes_loop++;
 }
 if(numero_vezes_loop == 2 ) // aqui voce define o numero de vezes do loop do timer
 { 
  digitalWrite(7,0); // acende azul
  digitalWrite(6,1); // apaga verde
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


  // MAPEIA O ESTADO DE CONECTADO OU NÃO  
  if (analogRead(A5)>=224)
  {
   Vstatus = Vstatus+1;
   if (Vstatus>1000)
   {
    Vstatus = 1000;  
   }
  }
  
  if (analogRead(A5)<218)
  {
   Vstatus = 0;
  }
  
  if(Vstatus>=1000&&conectado==0)
  {
  conectado = 1;
  digitalWrite(8,1); // apaga o vermelho
  digitalWrite(7,0); // acende o azul 
  }
  
  if(Vstatus<10&&conectado==1)
  {
  setup();
  }
  
  
  /*
  // conectado
   if(readString.indexOf(F("conectado"))>=0)     
   {
   digitalWrite(8,1); // apaga o vermelho
   digitalWrite(7,0); // acende o azul 
   x=1;
   }
 
   // desconectado
   if(readString.indexOf(F("desconectado"))>=0)     
   {
   digitalWrite(8,0); // acende o vermelho
   digitalWrite(7,1); // apaga o azul 
   
   x=1;
   }


*/

   // ATUALIZA A SAIDA AO
   if(readString.indexOf(F("100"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=100;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
    // ATUALIZA A SAIDA A1
   if(readString.indexOf(F("101"))>=0)     
   {
    timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=101;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
    // ATUALIZA A SAIDA A2
   if(readString.indexOf(F("102"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=102;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
    // ATUALIZA A SAIDA A3
   if(readString.indexOf(F("103"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=103;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
    // ATUALIZA A SAIDA A4
   if(readString.indexOf(F("104"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=104;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;   
   }
   
    // ATUALIZA A SAIDA A5
   if(readString.indexOf(F("105"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=105;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
    // ATUALIZA A SAIDA 2
   if(readString.indexOf(F("106"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=106;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   // ATUALIZA A SAIDA 3
   if(readString.indexOf(F("107"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=107;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;   
   }
   
   // ATUALIZA A SAIDA 4
   if(readString.indexOf(F("108"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=108;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   // ATUALIZA A SAIDA 5
   if(readString.indexOf(F("109"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=109;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   // ATUALIZA A SAIDA 6
   if(readString.indexOf(F("110"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=110;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   // ATUALIZA A SAIDA 7
   if(readString.indexOf(F("111"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=111;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
 
   x=1;
   }
   
   // ATUALIZA A SAIDA 8
   if(readString.indexOf(F("112"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=112;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
 
   x=1;
   }
   
    // ATUALIZA A SAIDA 9
   if(readString.indexOf(F("113"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=113;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
 
   x=1;
   }
   
    // ATUALIZA A SAIDA 10
   if(readString.indexOf(F("114"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=114;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
 
   x=1;
   }
   
   if(readString.indexOf(F("115"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=115;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   if(readString.indexOf(F("116"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=116;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }

   if(readString.indexOf(F("117"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=117;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   if(readString.indexOf(F("118"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=118;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   if(readString.indexOf(F("119"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=119;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   if(readString.indexOf(F("120"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=120;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
   if(readString.indexOf(F("121"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=121;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
      if(readString.indexOf(F("122"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=122;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   if(readString.indexOf(F("123"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=123;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }

   if(readString.indexOf(F("124"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=124;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }
   
      if(readString.indexOf(F("125"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=125;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }

   if(readString.indexOf(F("126"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=126;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }

   if(readString.indexOf(F("127"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=127;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }

   if(readString.indexOf(F("128"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=128;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;

   x=1;
   }

   

   
   if(readString.indexOf(F("129"))>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[0]=129;
   radio.stopListening();;
   radio.openWritingPipe(pipe);
   for(int sinal = 0 ; sinal<5 ; sinal++)
   {
   radio.write(SINAIS ,sizeof(SINAIS));
   }
   radio.openReadingPipe(1,pipe);
   radio.startListening();;
 
   x=1;
   }
   
  readString="";
 
 
  
   
      
 // ***********************************************************************************     
   // USADO SEMPRE PARA SAIR DO LACO FOR DE ALTERACAO DE STATUS
    if(x==1)
    {    
    SINAIS[0]=10;
    radio.stopListening();;
    radio.openWritingPipe(pipe);
    for(int sinal = 0 ; sinal<5 ; sinal++)
    {
     radio.write(SINAIS ,sizeof(SINAIS));
    }
    radio.openReadingPipe(1,pipe);
    radio.startListening();;
    x=0;
    }

}
//******************************************************************************************************************************************************************************************

