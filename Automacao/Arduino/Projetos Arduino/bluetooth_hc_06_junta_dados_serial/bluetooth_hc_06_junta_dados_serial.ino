#include <SoftwareSerial.h>

#define RX 13 // D7
#define TX 15  // D8
SoftwareSerial mySerial(RX, TX); // RX = D7, TX  = D8

String readString;

void setup() 
{
 Serial.begin(9600);
 mySerial.begin(9600);
 delay(5000);  

}

void loop() 
{
 
  while (mySerial.available()) {
    delay(3);  
    char c = mySerial.read();
    readString += c;
    mySerial.write(c); 
  }
 

}
