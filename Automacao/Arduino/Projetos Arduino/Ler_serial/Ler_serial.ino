String readString;
#include <SoftwareSerial.h>

#define RX 12 // D7
#define TX 11  // D8

SoftwareSerial mySerial(RX, TX); // RX = D7, TX  = D8

void setup() 
{
  Serial.begin(9600);
 mySerial.begin(9600); // NAO mudar, pois as outras trabalham em 9600

 }

void loop() 
{
  while (mySerial.available()) {
    delay(3);  
    char c = mySerial.read();
    readString += c; 
  }
  if (readString.length() >0) {
    Serial.println(readString);
    if ( readString=="descer")
    {
      Serial.println("Chegou DESCER");
      mySerial.write("descer");
    }
    readString="";
  } 
}
