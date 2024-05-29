/*
ARDUINO UNO SEM MODULO 2.4 GHZ
SAO 
15 PINOS COMO ENTRADA 
3 PINOS COMO SAIDA
*/



int vezes1,vezes2,vezes3,vezes4,vezes5,vezes6,vezes7,vezes8,vezes9,vezes10,vezes11,vezes12,vezes13,vezes14,vezes15;
String readString;



void setup() 
{
Serial.begin(9600);

pinMode(A0,INPUT); // saida A0 no receptor
pinMode(A1,INPUT); // saida A1 no receptor
pinMode(A2,INPUT); // saida A2 no receptor
pinMode(A3,INPUT); // saida A3 no receptor
pinMode(A4,INPUT); // saida A4 no receptor
pinMode(A5,INPUT); // saida A5 no receptor
pinMode(2,INPUT); // saida 2 no receptor
pinMode(3,INPUT); // saida 3 no receptor
pinMode(4,INPUT); // saida 4 no receptor
pinMode(5,INPUT); // saida 5 no receptor
pinMode(6,INPUT); // saida 6 no receptor
pinMode(7,INPUT); // saida 7 no receptor
pinMode(8,INPUT); // saida 11 
pinMode(9,INPUT); // saida 12
pinMode(10,INPUT); // saida 13
pinMode(11,OUTPUT); // entrada 8
pinMode(12,OUTPUT); // entrada 9
pinMode(13,OUTPUT); // entrada 10

// Define todas inicar em 0
digitalWrite(11,0); // referente a entrada 8
digitalWrite(12,0); // referente a entrada 9
digitalWrite(13,0); // referente a entrada 10



vezes1,vezes2,vezes3,vezes4,vezes5,vezes6,vezes7,vezes8,vezes9,vezes10,vezes11,vezes12,vezes13,vezes14,vezes15 = 0;


}

void loop()
{
 // Mapeia algo recebido pela serial 
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c; 
 }



 // atualiza a saida 11
  if(readString.indexOf("saida 8")>=0)     
 {
 digitalWrite(11,!digitalRead(11));
 }
  // atualiza a saida 11 para zero e sincronizar
  if(readString.indexOf("Ssaida 8")>=0)     
 {
 digitalWrite(11,0);
 }
 
 // atualiza a saida 12
 if(readString.indexOf("saida 9")>=0)       
 {
 digitalWrite(12,!digitalRead(12));
 }
  // atualiza a saida 12 para zero e sincronizar
 if(readString.indexOf("Ssaida 9")>=0)       
 {
 digitalWrite(12,0);
 }
 
 // atualiza a saida 13
 if(readString.indexOf("saida 10")>=0)          
 {
 digitalWrite(13,!digitalRead(13));
 }
  // atualiza a saida 13 para zero e sincronizar
 if(readString.indexOf("Ssaida 10")>=0)          
 {
 digitalWrite(13,0);
 }

 readString=""; // limpa a serial
 
    

  
 // MAPEIA A0 ****************************************************************************************************************************************************************
 if(digitalRead(A0)==1&&vezes1==0)
 {
  vezes1=1; 
  Serial.println("Entrada A0");
  Serial.println("");
 }
 if(digitalRead(A0)==0&&vezes1==1) 
 {
  vezes1=0; 
  Serial.println("Entrada A0");
  Serial.println("");
 } 



 // MAPEIA A1 ****************************************************************************************************************************************************************
 if(digitalRead(A1)==1&&vezes2==0)
 {
  vezes2=1; 
  Serial.println("Entrada A1");
  Serial.println("");
 }
 if(digitalRead(A1)==0&&vezes2==1) 
 {
  vezes2=0; 
  Serial.println("Entrada A1");
  Serial.println("");
 } 


 // MAPEIA A2 ****************************************************************************************************************************************************************
 if(digitalRead(A2)==1&&vezes3==0)
 {
  vezes3=1; 
  Serial.println("Entrada A2");
  Serial.println("");
 }
 if(digitalRead(A2)==0&&vezes3==1) 
 {
  vezes3=0; 
  Serial.println("Entrada A2");
  Serial.println("");
 } 


 // MAPEIA A3 ****************************************************************************************************************************************************************
 if(digitalRead(A3)==1&&vezes4==0)
 {
  vezes4=1; 
  Serial.println("Entrada A3");
  Serial.println("");
 }
 if(digitalRead(A3)==0&&vezes4==1) 
 {
  vezes4=0; 
  Serial.println("Entrada A3");
  Serial.println("");
 } 

 
 // MAPEIA A4 ****************************************************************************************************************************************************************
  if(digitalRead(A4)==1&&vezes5==0)
 {
  vezes5=1; 
  Serial.println("Entrada A4");
  Serial.println("");
 }
 if(digitalRead(A4)==0&&vezes5==1) 
 {
  vezes5=0; 
  Serial.println("Entrada A4");
  Serial.println("");
 } 
 

 // MAPEIA A5 ****************************************************************************************************************************************************************
 if(digitalRead(A5)==1&&vezes6==0)
 {
  vezes6=1; 
  Serial.println("Entrada A5");
  Serial.println("");
 }
 if(digitalRead(A5)==0&&vezes6==1) 
 {
  vezes6=0; 
  Serial.println("Entrada A5");
  Serial.println("");
 } 


 // MAPEIA 2 ****************************************************************************************************************************************************************
 if(digitalRead(2)==1&&vezes7==0)
 {
  vezes7=1; 
  Serial.println("Entrada 2");
  Serial.println("");
 }
 if(digitalRead(2)==0&&vezes7==1) 
 {
  vezes7=0; 
  Serial.println("Entrada 2");
  Serial.println("");
 } 

 
 // MAPEIA 3 ****************************************************************************************************************************************************************
  if(digitalRead(3)==1&&vezes8==0)
 {
  vezes8=1; 
  Serial.println("Entrada 3");
  Serial.println("");
 }
 if(digitalRead(3)==0&&vezes8==1) 
 {
  vezes8=0; 
  Serial.println("Entrada 3");
  Serial.println("");
 } 
 

 // MAPEIA 4 ****************************************************************************************************************************************************************
 if(digitalRead(4)==1&&vezes9==0)
 {
  vezes9=1; 
  Serial.println("Entrada 4");
  Serial.println(""); 
 }
 if(digitalRead(4)==0&&vezes9==1) 
 {
  vezes9=0; 
  Serial.println("Entrada 4");
  Serial.println("");
 } 
 

 // MAPEIA 5 ****************************************************************************************************************************************************************
 if(digitalRead(5)==1&&vezes10==0)
 {
  vezes10=1; 
  Serial.println("Entrada 5");
  Serial.println(""); 
 }
 if(digitalRead(5)==0&&vezes10==1) 
 {
  vezes10=0; 
  Serial.println("Entrada 5");
  Serial.println("");
 } 
 

 // MAPEIA 6 ****************************************************************************************************************************************************************
 if(digitalRead(6)==1&&vezes11==0)
 {
  vezes11=1; 
  Serial.println("Entrada 6");
  Serial.println(""); 
 }
 if(digitalRead(6)==0&&vezes11==1) 
 {
  vezes11=0; 
  Serial.println("Entrada 6");
  Serial.println(""); 
 } 


 // MAPEIA 7 ****************************************************************************************************************************************************************
 if(digitalRead(7)==1&&vezes12==0)
 {
  vezes12=1; 
  Serial.println("Entrada 7");
  Serial.println(""); 
 }
 if(digitalRead(7)==0&&vezes12==1) 
 {
  vezes12=0; 
  Serial.println("Entrada 7");
  Serial.println("");
 } 


 // MAPEIA 8 ****************************************************************************************************************************************************************
 if(digitalRead(8)==1&&vezes13==0)
 {
  vezes13=1; 
  Serial.println("Entrada 8");
  Serial.println("");
 }
 if(digitalRead(8)==0&&vezes13==1) 
 {
  vezes13=0; 
  Serial.println("Entrada 8");
  Serial.println(""); 
 } 


 // MAPEIA 9 ****************************************************************************************************************************************************************
 if(digitalRead(9)==1&&vezes14==0)
 {
  vezes14=1; 
  Serial.println("Entrada 9");
  Serial.println(""); 
 }
 if(digitalRead(9)==0&&vezes14==1) 
 {
  vezes14=0; 
  Serial.println("Entrada 9");
  Serial.println(""); 
 } 


 // MAPEIA 10 ****************************************************************************************************************************************************************
 if(digitalRead(10)==1&&vezes15==0)
 {
  vezes15=1; 
  Serial.println("Entrada 10");
  
 }
 if(digitalRead(10)==0&&vezes15==1) 
 {
  vezes15=0; 
  Serial.println("Entrada 10");
 } 
  
 
// **************************************************************************************************************************************************************************** 
 
 

 
}
