/*

   CONEXÃO DO ARDUINO ( NAO ESP8266 NODEMCU ) NO MQTT

   Conexão do modulo RS485
   RO = Pino 3
   DI = Pino 4
   DE = Pino 2
   RE = Pino 2

  */
 

String readString;

//Criando a Serial
#include<SoftwareSerial.h>
#define transmitir 2 // Pino DE e RE - Transmissao
#define pinRX 3 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);

//Button pin
#define Interruptor_1 5

void setup(){
 //Initialize SoftwareSerial
 Serial.begin(9600);
 RS485.begin(9600);
 //Digital pins PinMode
 pinMode(13,OUTPUT); 
 pinMode(transmitir, OUTPUT);
 pinMode(Interruptor_1, INPUT);
}
 
void loop(){
  //If button is pressed
  if(digitalRead(Interruptor_1) == LOW){
     digitalWrite(13,HIGH);             
     digitalWrite(transmitir, HIGH);    //Enable max485 transmission
     RS485.write("Sala_1");
     
     digitalWrite(transmitir,LOW);      //Disable max485 transmission mode
     delay(200);
     digitalWrite(13,LOW);
     delay(2000);
  }
 while (RS485.available())
  {
    delay(3);
    char c = RS485.read();
    readString += c;
    
  }

  if (readString.length() > 0)
  {
   
     Serial.println(readString);
    if (readString == "luz1")
    {
      digitalWrite(13,1);
    }
    if (readString == "luz0")
    {
      digitalWrite(13,0);
    }
    readString = "";
  }



  
}
