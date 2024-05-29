// Lendo EEPROM
#include <EEPROM.h>

int valor;

void setup() 
{
  
int hiByte1 = (EEPROM.read(0)* 255)+(EEPROM.read(0));
int loByte1 = EEPROM.read(1); 

valor = ((hiByte1)+(loByte1));
Serial.begin (9600);

}

void loop() 
{
Serial.println(valor);
}
