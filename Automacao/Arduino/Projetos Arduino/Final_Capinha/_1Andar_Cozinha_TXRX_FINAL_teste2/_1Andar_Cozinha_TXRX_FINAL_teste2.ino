/*
LOGICA DO PRIMEIRO ANDAR, DO LADO DA COZINHA QUE UTILIZA RX/TX

SINAIS[26] - LUZ REFLETOR DA PISCINA
SINAIS[27] - LUZ TETO AREA CHURRASCO
SINAIS[28] - LUZ DO MURO PISCINA
SINAIS[24] - LUZ DO TETO DA AREA

*/
String readString;

void setup()
{
 Serial.begin(9600);
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
   if(readString.indexOf(F("126"))>=0)     
   {
    digitalWrite(2,!digitalRead(2));
   }
   
    // ATUALIZA A SAIDA A1
   if(readString.indexOf(F("127"))>=0)     
   {
    digitalWrite(3,!digitalRead(3));
   }
   
    // ATUALIZA A SAIDA A2
   if(readString.indexOf(F("128"))>=0)     
   {
    digitalWrite(4,!digitalRead(4));
   }
   
    // ATUALIZA A SAIDA A3
   if(readString.indexOf(F("124"))>=0)     
   {
    digitalWrite(7,!digitalRead(7));
   }
   
    // SINCRONIZAR  
   if(readString.indexOf(F("sin"))>=0)     
   {
    digitalWrite(2,0);
    digitalWrite(3,0);
    digitalWrite(4,0); 
    digitalWrite(7,0);  
   }
   readString = "";


} // fecha loop









