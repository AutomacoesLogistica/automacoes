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
int vezes0,vezes1,vezes2,vezes3,vezes4,vezes5,vezes6,vezes7,vezes8,vezes9,vezes10,vezes11,vezes12,vezes13,vezes14;
String readString;


void setup()
{
 Serial.begin(9600);

pinMode(A0,INPUT); //
pinMode(A1,INPUT); //
pinMode(A2,INPUT); //
pinMode(A3,INPUT); //
pinMode(A4,INPUT); //
pinMode(A5,INPUT); //
pinMode(2,INPUT); //
pinMode(3,INPUT); //
pinMode(4,INPUT); //
pinMode(5,INPUT); //
pinMode(6,INPUT); //
pinMode(7,INPUT); //
pinMode(8,INPUT); //
pinMode(9,INPUT); //
pinMode(10,INPUT); //
pinMode(11,OUTPUT); // 
pinMode(12,OUTPUT); // 
pinMode(13,OUTPUT); // 


// Define todas inicar em 0
digitalWrite(11,0); // referente a entrada 8
digitalWrite(12,0); // referente a entrada 9
digitalWrite(13,0); // referente a entrada 10

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

   // Sincronizar
   if(readString.indexOf(F("sin"))>=0)     
   {
    digitalWrite(11,0);
    digitalWrite(12,0);
    digitalWrite(13,0);
   }


   // ATUALIZA A SAIDA 11
   if(readString.indexOf(F("cen12"))>=0)     
   {
    digitalWrite(11,!digitalRead(11));
   }
   
   // ATUALIZA A SAIDA 12
   if(readString.indexOf(F("cen13"))>=0)     
   {
    digitalWrite(12,!digitalRead(12));
   }
   
  readString="";
 

 // MAPEIA A0 ****************************************************************************************************************************************************************
 if(digitalRead(A0)==1&&vezes0==0)
 {
  Serial.println(F("100"));
  vezes0=1; 
 }
  if(digitalRead(A0)==0&&vezes0==1)
 {
  Serial.println(F("100"));
  vezes0=0; 
 }

 // MAPEIA A1 ****************************************************************************************************************************************************************
 if(digitalRead(A1)==1&&vezes1==0)
 {
  Serial.println(F("101"));
  vezes1=1; 
 }
  if(digitalRead(A1)==0&&vezes1==1)
 {
  Serial.println(F("101"));
  vezes1=0; 
 }

 // MAPEIA A2 ****************************************************************************************************************************************************************
 if(digitalRead(A2)==1&&vezes2==0)
 {
  Serial.println(F("102"));
  vezes2=1; 
 }
  if(digitalRead(A2)==0&&vezes2==1)
 {
  Serial.println(F("102"));
  vezes2=0; 
 }

 // MAPEIA A3 ****************************************************************************************************************************************************************
 if(digitalRead(A3)==1&&vezes3==0)
 {
  Serial.println(F("103"));
  vezes3=1; 
 }
  if(digitalRead(A3)==0&&vezes3==1)
 {
  Serial.println(F("103"));
  vezes3=0; 
 }

 // MAPEIA A4 ****************************************************************************************************************************************************************
 if(digitalRead(A4)==1&&vezes4==0)
 {
  Serial.println(F("104"));
  vezes4=1; 
 }
  if(digitalRead(A4)==0&&vezes4==1)
 {
  Serial.println(F("104"));
  vezes4=0; 
 }

 // MAPEIA A5 ****************************************************************************************************************************************************************
 if(digitalRead(A5)==1&&vezes5==0)
 {
  Serial.println(F("105"));
  vezes5=1; 
 }
  if(digitalRead(A5)==0&&vezes5==1)
 {
  Serial.println(F("105"));
  vezes5=0; 
 }

// MAPEIA 2 ****************************************************************************************************************************************************************
 if(digitalRead(2)==1&&vezes6==0)
 {
  Serial.println(F("106"));
  vezes6=1; 
 }
  if(digitalRead(2)==0&&vezes6==1)
 {
  Serial.println(F("106"));
  vezes6=0; 
 }

// MAPEIA 3 ****************************************************************************************************************************************************************
 if(digitalRead(3)==1&&vezes7==0)
 {
  Serial.println(F("107"));
  vezes7=1; 
 }
  if(digitalRead(3)==0&&vezes7==1)
 {
  Serial.println(F("107"));
  vezes7=0; 
 }

// MAPEIA 4 ****************************************************************************************************************************************************************
 if(digitalRead(4)==1&&vezes8==0)
 {
  Serial.println(F("108"));
  vezes8=1; 
 }
  if(digitalRead(4)==0&&vezes8==1)
 {
  Serial.println(F("108"));
  vezes8=0; 
 }

// MAPEIA 5 ****************************************************************************************************************************************************************
 if(digitalRead(5)==1&&vezes9==0)
 {
  Serial.println(F("109"));
  vezes9=1; 
 }
  if(digitalRead(5)==0&&vezes9==1)
 {
  Serial.println(F("109"));
  vezes9=0; 
 }

// MAPEIA 6 ****************************************************************************************************************************************************************
 if(digitalRead(6)==1&&vezes10==0)
 {
  Serial.println(F("110"));
  vezes10=1; 
 }
  if(digitalRead(6)==0&&vezes10==1)
 {
  Serial.println(F("110"));
  vezes10=0; 
 }

// MAPEIA 7 ****************************************************************************************************************************************************************
 if(digitalRead(7)==1&&vezes11==0)
 {
  Serial.println(F("111"));
  vezes11=1; 
 }
  if(digitalRead(7)==0&&vezes11==1)
 {
  Serial.println(F("111"));
  vezes11=0; 
 }

// MAPEIA 8 ****************************************************************************************************************************************************************
 if(digitalRead(8)==1&&vezes12==0)
 {
 digitalWrite(11,!digitalRead(11));
  vezes12=1; 
 }
  if(digitalRead(8)==0&&vezes12==1)
 {
  digitalWrite(11,!digitalRead(11));
  vezes12=0; 
 }

// MAPEIA 9 ****************************************************************************************************************************************************************
 if(digitalRead(9)==1&&vezes13==0)
 {
  digitalWrite(12,!digitalRead(12));
  vezes13=1; 
 }
  if(digitalRead(9)==0&&vezes13==1)
 {
 digitalWrite(12,!digitalRead(12));
  vezes13=0; 
 }

}









