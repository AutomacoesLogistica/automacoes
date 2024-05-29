/*
LOGICA DO PRIMEIRO ANDAR, DO LADO DA COZINHA QUE UTILIZA RX/TX

SINAIS[26] - LUZ REFLETOR DA PISCINA
SINAIS[27] - LUZ TETO AREA CHURRASCO
SINAIS[28] - LUZ DO MURO PISCINA
SINAIS[24] - LUZ DO TETO DA AREA

*/

int vezes1,vezes2,vezes3,vezes4;
String readString;

void setup()
{
  Serial.begin(115200);

pinMode(A0,INPUT); //
pinMode(A1,INPUT); //
pinMode(A2,INPUT); //
pinMode(A3,INPUT); //

pinMode(2,OUTPUT); // 
pinMode(3,OUTPUT); // 
pinMode(4,OUTPUT); // 
pinMode(7,OUTPUT); // 

// Define todas inicar em 0
digitalWrite(2,0); // referente a entrada A0
digitalWrite(3,0); // referente a entrada A1
digitalWrite(4,0); // referente a entrada A2
digitalWrite(7,0); // referente a entrada A3


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
   if(readString.indexOf("126")>=0)     
   {
    digitalWrite(2,!digitalRead(2));
//    if(digitalRead(2)==1){Serial.println("SINAIS[26]=100");}
  //  if(digitalRead(2)==0){Serial.println("SINAIS[26]=50");}
   }
   
    // ATUALIZA A SAIDA A1
   if(readString.indexOf("127")>=0)     
   {
    digitalWrite(3,!digitalRead(3));
//    if(digitalRead(3)==1){Serial.println("SINAIS[27]=100");}
  //  if(digitalRead(3)==0){Serial.println("SINAIS[27]=50");}
   }
   
    // ATUALIZA A SAIDA A2
   if(readString.indexOf("128")>=0)     
   {
    digitalWrite(4,!digitalRead(4));
//    if(digitalRead(4)==1){Serial.println("SINAIS[28]=100");}
  //  if(digitalRead(4)==0){Serial.println("SINAIS[28]=50");}
   }
   
    // ATUALIZA A SAIDA A3
   if(readString.indexOf("124")>=0)     
   {
    digitalWrite(7,!digitalRead(7));
//    if(digitalRead(7)==1){Serial.println("SINAIS[24]=100");}
  //  if(digitalRead(7)==0){Serial.println("SINAIS[24]=50");}
   }
   
    // SINCRONIZAR  
   if(readString.indexOf("sin")>=0)     
   {
    digitalWrite(2,0);
    digitalWrite(3,0);
    digitalWrite(4,0); 
    digitalWrite(7,0);  
   }
   
  readString="";
 
 
 // MAPEIA 2 ****************************************************************************************************************************************************************
 if(digitalRead(A0)==1&&vezes1==0)
 {
  digitalWrite(2,!digitalRead(2));
//  if(digitalRead(2)==1){Serial.println("SINAIS[26]=100");}
 // if(digitalRead(2)==0){Serial.println("SINAIS[26]=50");}
  vezes1=1; 
 }
 
 if(digitalRead(A0)==0&&vezes1==1) 
 {
  digitalWrite(2,!digitalRead(2));
 // if(digitalRead(2)==1){Serial.println("SINAIS[26]=100");}
 // if(digitalRead(2)==0){Serial.println("SINAIS[26]=50");}
  vezes1=0; 
 } 


 // MAPEIA 3 ****************************************************************************************************************************************************************
 if(digitalRead(A1)==1&&vezes2==0)
 {
  digitalWrite(3,!digitalRead(3)); 
//  if(digitalRead(3)==1){Serial.println("SINAIS[27]=100");}
 // if(digitalRead(3)==0){Serial.println("SINAIS[27]=50");}
  vezes2=1; 
 }
 
 if(digitalRead(A1)==0&&vezes2==1) 
 {
  digitalWrite(3,!digitalRead(3)); 
 // if(digitalRead(3)==1){Serial.println("SINAIS[27]=100");}
  //if(digitalRead(3)==0){Serial.println("SINAIS[27]=50");}
  vezes2=0; 
 } 

 // MAPEIA 4 ****************************************************************************************************************************************************************
 if(digitalRead(A2)==1&&vezes3==0)
 {
  digitalWrite(4,!digitalRead(4)); 
  //if(digitalRead(4)==1){Serial.println("SINAIS[28]=100");}
  //if(digitalRead(4)==0){Serial.println("SINAIS[28]=50");}
  vezes3=1; 
 }
 if(digitalRead(A2)==0&&vezes3==1) 
 {
  digitalWrite(4,!digitalRead(4)); 
  //if(digitalRead(4)==1){Serial.println("SINAIS[28]=100");}
  //if(digitalRead(4)==0){Serial.println("SINAIS[28]=50");}
  vezes3=0; 
 } 

 // MAPEIA 5 ****************************************************************************************************************************************************************
 if(digitalRead(A3)==1&&vezes4==0)
 {
  digitalWrite(7,!digitalRead(7)); 
  //if(digitalRead(7)==1){Serial.println("SINAIS[24]=100");}
  //if(digitalRead(7)==0){Serial.println("SINAIS[24]=50");}
  vezes4=1; 
 }
 if(digitalRead(A3)==0&&vezes4==1) 
 {
  digitalWrite(7,!digitalRead(7)); 
//  if(digitalRead(7)==1){Serial.println("SINAIS[24]=100");}
 // if(digitalRead(7)==0){Serial.println("SINAIS[24]=50");}
  vezes4=0; 
 } 




}









