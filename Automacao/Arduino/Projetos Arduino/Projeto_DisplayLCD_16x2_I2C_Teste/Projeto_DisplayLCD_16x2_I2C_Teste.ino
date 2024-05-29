#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);

void setup() 
{ 
 lcd.begin(16,2);
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Ola Mundo!      ");
 lcd.setCursor(0,1);
 lcd.print ("Bruno Goncalves ");
 

} 

void loop()
{

}
