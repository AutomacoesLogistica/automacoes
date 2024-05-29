// Autor : FILIPEFLOP
 
#include <Wire.h>
#include <Adafruit_BMP085.h>
 
Adafruit_BMP085 bmp180;
 
int mostrador = 0;
  
void setup() 
{
  Serial.begin(9600);
  if (!bmp180.begin()) 
  {
    Serial.println("Sensor nao encontrado !!");
    while (1) {}
  }
}
  
void loop() 
{   
   Serial.print("Temperatura : ");
   if ( bmp180.readTemperature() < 10)
   {
     Serial.print(bmp180.readTemperature());
     Serial.println(" C");
   }
   else
   {
     Serial.print(bmp180.readTemperature(),1);
     Serial.println(" C");
   }
      
   if (mostrador == 0)
   {
     Serial.print("Altitude : ");
     Serial.print(bmp180.readAltitude());
     Serial.println(" m");
   }
   if (mostrador == 1)
   {
     Serial.print("Pressao : ");
     Serial.print(bmp180.readPressure());  
     Serial.println(" Pa");
   }
   
   delay(3000);
   mostrador = !mostrador;
}
