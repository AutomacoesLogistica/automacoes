// Mestre


#include "Wire.h"

#define buttonPin 2 // numero do pino onde o botao esta conectado
  
  
// endereco do modulo slave que pode ser um valor de 0 a 255
#define slaveAdress 0x08

void setup() {
  Wire.begin(); // ingressa ao barramento I2C
  
  // configura o pino do botao como entrada com resistor de pullup interno
  pinMode(buttonPin,INPUT);
}

void loop() 
{
  
if (digitalRead(2) == 0)
{
 while(digitalRead(2)==0)
 {
  delay(500);
 }
        // incia a transmissao para o endereco 0x08 (slaveAdress)
        Wire.beginTransmission(slaveAdress);
        Wire.write(ledState); 
        Wire.endTransmission(); // encerra a transmissao


}
}
