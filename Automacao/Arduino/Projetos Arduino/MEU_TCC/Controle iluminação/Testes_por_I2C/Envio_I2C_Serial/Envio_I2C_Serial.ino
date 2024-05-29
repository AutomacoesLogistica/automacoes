// Mestre
String readString;

#include "Wire.h"

#define buttonPin 2 // numero do pino onde o botao esta conectado
  
  
// endereco do modulo slave que pode ser um valor de 0 a 255
#define slaveAdress 0x08

void setup() 
{
  Serial.begin(9600);
  Wire.begin(); // ingressa ao barramento I2C
  readString = "";
}

void loop() 
{
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c; 
 }
 
 if (readString.length() >0) 
 {
  if (readString == "modo_0")
  {
   Serial.println("modo_0");
   Wire.beginTransmission(slaveAdress);
   Wire.write("modo_0"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  if (readString == "modo")
  {
   Serial.println("modo");
   Wire.beginTransmission(slaveAdress);
   Wire.write("modo"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  if (readString == "luz_on")
  {
   Serial.println("luz_on"); 
   Wire.beginTransmission(slaveAdress);
   Wire.write("luz_on"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  if (readString == "luz_off")
  {
   Serial.println("luz_off"); 
   Wire.beginTransmission(slaveAdress);
   Wire.write("luz_off"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  
  readString = "";
 } 
}
