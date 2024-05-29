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
  pinMode(6,OUTPUT); //verde
  pinMode(7,OUTPUT); // azul
  pinMode(8,OUTPUT); // vermelho
  digitalWrite(6,1); // usado para atualizar o LED WIRELESS
  digitalWrite(7,1); // usado para atualizar o LED WIRELESS
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

  // conectado
   if(readString.indexOf("conectado")>=0)     
   {
   digitalWrite(8,1); // apaga o vermelho
   digitalWrite(7,0); // acende o azul 
   x=1;
   }
 
   // desconectado
   if(readString.indexOf("desconectado")>=0)     
   {
   digitalWrite(8,0); // acende o vermelho
   digitalWrite(7,1); // apaga o azul 
   
   x=1;
   }

   // ATUALIZA A SAIDA AO
   if(readString.indexOf("100")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=100;
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
   if(readString.indexOf("101")>=0)     
   {
    timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=101;
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
   if(readString.indexOf("102")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=102;
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
   if(readString.indexOf("103")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=103;
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
   if(readString.indexOf("104")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=104;
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
   if(readString.indexOf("105")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=105;
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
   if(readString.indexOf("106")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=106;
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
   if(readString.indexOf("107")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=107;
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
   if(readString.indexOf("108")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=108;
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
   if(readString.indexOf("109")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=109;
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
   if(readString.indexOf("110")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=110;
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
   if(readString.indexOf("111")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=111;
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
   if(readString.indexOf("112")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=112;
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
   if(readString.indexOf("113")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=113;
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
   if(readString.indexOf("114")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[13]=114;
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
   
   if(readString.indexOf("115")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[13]=115;
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
   
   if(readString.indexOf("116")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[13]=116;
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

   if(readString.indexOf("117")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[13]=117;
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
   
   if(readString.indexOf("118")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[13]=118;
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
   
   if(readString.indexOf("119")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[13]=119;
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
   
   if(readString.indexOf("120")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=120;
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
   
   if(readString.indexOf("121")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=121;
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
   
      if(readString.indexOf("122")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=122;
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
   if(readString.indexOf("123")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=123;
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

   if(readString.indexOf("124")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=124;
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
   
      if(readString.indexOf("125")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=125;
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

   if(readString.indexOf("126")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=126;
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

   if(readString.indexOf("127")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=127;
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

   if(readString.indexOf("128")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=128;
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

   

   
   if(readString.indexOf("129")>=0)     
   {
   timer_ativo = 1;
   digitalWrite(8,1); // acende shield
   SINAIS[14]=129;
   SINAIS[13]=129; 
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
    SINAIS[13]=10;
    SINAIS[14]=10;

    radio.stopListening();;
    radio.openWritingPipe(pipe);
    for(int sinal = 0 ; sinal<3 ; sinal++)
    {
     radio.write(SINAIS ,sizeof(SINAIS));
    }
    radio.openReadingPipe(1,pipe);
    radio.startListening();;
    x=0;
    }

}
//******************************************************************************************************************************************************************************************

