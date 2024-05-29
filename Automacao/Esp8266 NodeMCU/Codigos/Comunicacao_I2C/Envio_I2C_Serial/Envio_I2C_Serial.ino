/*
 * 
 * 
 *  PROJETO UTILIZANDO ESP8266 NODEMCU E SERIAL COMUNICANDO COM OUTRO DISPOSITIVO I2C
 *  Este esta sendo considerado o MASTER ( Mestre )  
 *  Os demais serão Slaves ( Escravos )
 *  Obs: So pode ter apenas um mestre
 *       Escravos podem ser varios
 * 
 *  SDA = D1
 *  SCL = D2
 */


String readString; // Usado para receber as mensagens da serial e em seguida passar as mesmas por I2C

#include "Wire.h"
#define Slave_01 0x08 // endereco do modulo slave que pode ser um valor de 0 a 255

void setup() 
{
  
  Serial.begin(115200);
  Wire.begin(D1,D2); // ingressa ao barramento I2C
  readString = ""; // Inicia a variavel da serial em vazio
  
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
  if (readString == "Liga")
  {
   Serial.print("Enviado o comando: ");
   Serial.println("Liga_lampada_teto");
   Wire.beginTransmission(Slave_01);
   Wire.write("Liga_lampada_teto"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  if (readString == "Desliga")
  {
   Serial.print("Enviado o comando: ");
   Serial.println("Desliga_lampada_teto");
   Wire.beginTransmission(Slave_01);
   Wire.write("Desliga_lampada_teto"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  if (readString == "Pisca")
  {
   Serial.print("Enviado o comando: ");
   Serial.println("Pisca_lampada_teto");
   Wire.beginTransmission(Slave_01);
   Wire.write("Pisca_lampada_teto"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  if (readString == "Sair_Pisca")
  {
   Serial.print("Enviado o comando: ");
   Serial.println("Sair_lampada_teto");
   Wire.beginTransmission(Slave_01);
   Wire.write("Sair_lampada_teto"); 
   Wire.endTransmission(); // encerra a transmissao
  }
  readString = "";
 } 
}
