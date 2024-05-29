#include <SoftwareSerial.h>

#define RX 13 // D7
#define TX 15  // D8
SoftwareSerial mySerial(RX, TX); // RX = D7, TX  = D8

String readString;

void setup() {
  Serial.begin(9600);
  mySerial.begin(9600); //Start mySerial
  delay(5000);  
  Serial.println("iniciou");
  pinMode(D0,OUTPUT);
}

void loop() {
  
  
  //delay(1000);
  //mySerial.write("bruno");
 
  while (mySerial.available()) {
    delay(3);  
    char c = mySerial.read();
    readString += c; 
  }
  
  if (readString.length() >0) {
    Serial.println(readString);
    if(readString == "bruno")
    {
      digitalWrite(D0,!digitalRead(D0));
      if(digitalRead(D0)==LOW)
      {
        mySerial.write("ligado");
      }
      else
      {
        mySerial.write("desligado");
      }
    }
    
    readString="";
  } 
}
