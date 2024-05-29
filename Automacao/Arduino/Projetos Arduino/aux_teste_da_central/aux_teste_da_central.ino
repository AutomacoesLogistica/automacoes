#include <IRremote.h>
int abrir,fechar;
int ledPin = 13;
String readString;
int RECV_PIN = 11;
IRrecv irrecv(RECV_PIN);
decode_results results;

void setup() 
{
  Serial.begin(9600);
  pinMode(ledPin, OUTPUT); 
  pinMode(2, OUTPUT); 
  pinMode(3, OUTPUT); 
  pinMode(4, OUTPUT); 
  pinMode(8, OUTPUT); 
  pinMode(9, OUTPUT);
  digitalWrite(8,0);
  digitalWrite(9,0); 
 irrecv.enableIRIn(); // Start the receiver
abrir = 0;
fechar = 0;

 }

void loop() 
{

   if (irrecv.decode(&results)) 
   {
    Serial.println(results.value, HEX);
    
    if(results.value==0xFD52AD) // lampada
  {   
   digitalWrite(2, HIGH);
   delay(500);
   digitalWrite(2, LOW);   
   delay(1000);
   irrecv.resume(); // Receive the next value
  }
   
   
         //Comandos para abrir e fechar a cortina

      
      // fechar
      if(results.value == 0xFDA25D)// apertado botao para baixo 
      {
      fechar++;
     
     if (fechar==1)     
      {
      digitalWrite(8, HIGH);
      }
    
    // para
     if (fechar==2)     
      {
      digitalWrite(8, LOW);
      }
      if( fechar>=2)
      {fechar = 0;}
      delay(200);
      }  

      // abrir
      if(results.value == 0xFDB847)// apertado botao para cima 
      {
      abrir++;
      
      if (abrir==1)     
      {
      digitalWrite(9, HIGH);
      }
    
      // para
      if (abrir==2)     
      {
      digitalWrite(9, LOW);
      }      
      if( abrir>=2)
      {abrir = 0;}
      delay(200);
      }
      
    

     if (results.value==0xFD32CD)     // portao grande
      {
      digitalWrite(3, HIGH);
      delay(500);
      digitalWrite(3, LOW);   
      }
     
     if (results.value==0xFD926D)   // portao pequeno  
      {
      digitalWrite(4, HIGH);
      delay(500);
      digitalWrite(4, LOW);   
      }
   
   
   
   
    
    irrecv.resume(); // Receive the next value
   } 
  
  
  while (Serial.available()) {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  if (readString.length() >0) {
    
    
    if (readString == "on")     
    {
      digitalWrite(ledPin, HIGH);
    }
    if (readString == "off")
    {
      digitalWrite(ledPin, LOW);
    }
    
    
    
     if (readString == "LampG")     
    {
      digitalWrite(2, HIGH);
      delay(500);
      digitalWrite(2, LOW);   
  }
    
     if (readString == "portG")     
      {
      digitalWrite(3, HIGH);
      delay(500);
      digitalWrite(3, LOW);   
      }
     
     if (readString == "portP")     
      {
      digitalWrite(4, HIGH);
      delay(500);
      digitalWrite(4, LOW);   
      }
      
      
    
    // fecha    
     if (readString == "1"|| fechar==1)     
      {
      digitalWrite(8, HIGH);
      }
    
    // para
     if (readString == "2"|| fechar==2)     
      {
      digitalWrite(8, LOW);
      }
    
    // abre
     if (readString == "3"|| abrir==1)     
      {
      digitalWrite(9, HIGH);
      }
    
    // para
     if (readString == "4"|| abrir==2)     
      {
      digitalWrite(9, LOW);
      }
    
    for(int i=0;i<3;i++){
    Serial.println(readString);
    delay(250);
    }
    readString="";
  } 

}

