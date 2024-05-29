/****************************************************************



SENSOR DE COR UTILIZANDO O MODULO APDS-9960



IMPRIME O VALOR IDENTIFICADO NA SERIAL


*/

#include <Wire.h>
#include <SparkFun_APDS9960.h>

// Global Variables
SparkFun_APDS9960 apds = SparkFun_APDS9960();
uint16_t Luz_Ambiente = 0;
uint16_t Luz_Vermelha = 0;
uint16_t Luz_Verde = 0;
uint16_t Luz_Azul = 0;
int red;
int green;
int blue;

void setup() 
{
 Serial.begin(9600);
 apds.init(); // Inicia o módulo
 apds.enableLightSensor(); // Habilita o sensor
 delay(500); // Tempo necessario para inicialização completa do sensor
}

void loop() 
{
  
  // Read the light levels (ambient, red, green, blue)
  if (  !apds.readAmbientLight(Luz_Ambiente) ||!apds.readRedLight(Luz_Vermelha) || !apds.readGreenLight(Luz_Verde) || !apds.readBlueLight(Luz_Azul) ) 
  {
    Serial.println("Erro ao ler valores de iluminação! ");
  } 
  else 
  {

   red = map(Luz_Vermelha,0,3500,0,255);
   green = map(Luz_Verde,0,3500,0,255);
   blue = map(Luz_Azul,0,3500,0,255);

  
   Serial.print("Luz Ambiente: ");
   Serial.print(Luz_Ambiente);
   Serial.print("  Vermelho: ");
   Serial.print(Luz_Vermelha);
   Serial.print("  Verde: ");
   Serial.print(Luz_Verde);
   Serial.print("  Azul: ");
   Serial.println(Luz_Azul);
   analogWrite(3,red);
   analogWrite(5,green);
   analogWrite(6,blue);
  }
  
  // Wait 1 second before next reading
  delay(300);
}
