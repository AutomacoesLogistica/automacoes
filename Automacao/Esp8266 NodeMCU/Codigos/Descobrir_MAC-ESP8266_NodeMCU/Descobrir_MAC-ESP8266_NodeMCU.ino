#include <ESP8266WiFi.h>
String MyMAC = "";
void setup() 
{
 Serial.begin(115200);
 delay(500);
 MyMAC = WiFi.macAddress();
 Serial.println();
 
 Serial.print("MAC Adress e : ");
 Serial.println(MyMAC);

}

void loop() {
  // put your main code here, to run repeatedly:

}
