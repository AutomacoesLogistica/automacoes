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
int Vezes1,Vezes2,Vezes3;
String readString;
int MODO;

void setup()
{
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  pinMode(2,INPUT);
  pinMode(3,INPUT);
  pinMode(4,INPUT);
  pinMode(5,OUTPUT);
  pinMode(6,OUTPUT);
  pinMode(7,OUTPUT);

   MODO=-1;
  x=0;
  
  Vezes1=0;
  Vezes2=0;
  Vezes3=0;

}



void loop()  
{
     
  while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString+=c; 
 }
 

 if(readString!="")
 {
 Serial.println(readString);
 }


 if (readString.indexOf("SINAIS[0]")>=0)     
 {
   digitalWrite(5,!digitalRead(5));
  readString="";
 }
 if (readString.indexOf("SINAIS[1]")>=0)     
 {
   digitalWrite(6,!digitalRead(6));
   readString="";
 }
 if (readString.indexOf("SINAIS[2]")>=0)     
 {
   digitalWrite(7,!digitalRead(7));
  readString="";
 }

  
  
  if (x==0)
 {
   
  // MAPEIA O PRIMEIRO INTERRUPTOR 
  if(digitalRead(2)==1&&Vezes1==0) // 
  {

   Vezes1=1; 
   digitalWrite(5,!digitalRead(5));
  }
  if(digitalRead(2)==0&&Vezes1==1) // 
  {

   Vezes1=0; 
   digitalWrite(5,!digitalRead(5));
  } 


  // MAPEIA O SEGUNDO INTERRUPTOR 
  if(digitalRead(3)==1&&Vezes2==0) // 
  {

   Vezes2=1; 
   digitalWrite(6,!digitalRead(6));
  }
  if(digitalRead(3)==0&&Vezes2==1) // 
  {

   Vezes2=0; 
   digitalWrite(6,!digitalRead(6));
  } 


  // MAPEIA O TERCEIRO INTERRUPTOR 
  if(digitalRead(4)==1&&Vezes3==0) // 
  {
   Vezes3=1; 
   digitalWrite(7,!digitalRead(7));
  }
  if(digitalRead(4)==0&&Vezes3==1) // 
  {

   Vezes3=0; 
   digitalWrite(7,!digitalRead(7));
  } 


 }

if (x==1)
{


}


}

