
#include <Wire.h>
#include <EEPROM.h>
#include <Encoder.h>
long int newPosition;
long int ValorInicial;
long int ValorCorrente;
long int oldPosition;
long int Valor;

Encoder myEnc(2, 3);

void setup() 
{
 Serial.begin(9600);
 Serial.println("Basic Encoder Test:");
 ValorInicial = 10;
 int hiByte1 = (EEPROM.read(0)* 255)+(EEPROM.read(0));
 int loByte1 = EEPROM.read(1); 
 ValorCorrente = ((hiByte1)+(loByte1));
 oldPosition  = -999;
}



void loop() 
{
  
  newPosition = myEnc.read();
 
  

  
 if (newPosition != oldPosition) 
 {
  oldPosition = newPosition;
  if(ValorCorrente<ValorInicial)
  {
    newPosition = -1 ;oldPosition = 0;
  }

   Valor = (ValorCorrente+newPosition);
  
  if ( Valor < ValorInicial)
  {
    Valor = ValorInicial;
    oldPosition = 0;
    newPosition = 0;
  }
  Serial.print(Valor);
  Serial.print(" , ");
  Serial.print(oldPosition);
  Serial.print(" , ");
  Serial.println(newPosition);
  Salva();
  

  
 }
}



void Salva()
{

// Armazena na serial
byte hiByte = highByte(Valor);
byte loByte = lowByte(Valor);
EEPROM.write(0,hiByte);
EEPROM.write(1,loByte);

  
}

