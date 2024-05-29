#include "DHT.h"
#define DHTTYPE DHT11 // DHT 11
 
// Conecte pino 1 do sensor (esquerda) ao +5V
// Conecte pino 2 do sensor ao pino de dados definido em seu Arduino
// Conecte pino 4 do sensor ao GND
// Conecte o resistor de 10K entre pin 2 (dados) 
// e ao pino 1 (VCC) do sensor

  DHT dht1(A0, DHTTYPE);
  DHT dht2(A1, DHTTYPE);

void setup() 
{
  Serial.begin(9600);
  dht1.begin();
  dht2.begin();
}
 
void loop() 
{
  
  // temperatura interna e umidade interna
  float uuii = dht1.readHumidity();
  float tpii = dht1.readTemperature();

  // temperatura externa e umidade externa
  float uuee = dht2.readHumidity();
  float tpee = dht2.readTemperature();
  
  char c = Serial.read();
  
  if (c=='1')
  {
    Serial.print("Umidade Interna: ");
    Serial.print(uuii);
    Serial.println(" %");
    
    Serial.print("Umidade Externa: ");
    Serial.print(uuee);
    Serial.println(" %");
  }
  
  if (c=='2')
  {
    Serial.print("Temperatura Interna: ");
    Serial.print(tpii);
    Serial.println(" *C");
    Serial.print("Temperatura Externa: ");
    Serial.print(tpee);
    Serial.println(" *C");


  }

 if (c=='3')
  {
    Serial.print("Umidade Interna: ");
    Serial.print(uuii);
    Serial.print(" %      ");
    Serial.print("Temperatura Interna: ");
    Serial.print(tpii);
    Serial.println(" *C");
      
    Serial.print("Umidade Externa: ");
    Serial.print(uuee);
    Serial.print(" %      ");
    Serial.print("Temperatura Externa: ");
    Serial.print(tpee);
    Serial.println(" *C");
    
    
    
  }

}
