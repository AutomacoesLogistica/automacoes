/****************************************************************
TESTE DO DISPLAY APDS-9960 RGB

DETECÇÃO DE MOVIMENTOS
 - ESQUERDA
 - DIREITA
 - CIMA
 - BAIXO
 - LONGE
 - PERTO
 - DESCONHECIDO 
  
 */
#include <Wire.h>
#include <SparkFun_APDS9960.h>
#define Pino_Interrupcao    2 // Definindo pino para interrupção
SparkFun_APDS9960 Sensor_APDS = SparkFun_APDS9960();
int Variavel_flag = 0;

void setup() {

  // Set interrupt pin as input
  pinMode(Pino_Interrupcao, INPUT);

  // Initialize Serial port
  Serial.begin(9600);
  Serial.println();
  Serial.println(F("--------------------------------"));
  Serial.println(F("SparkFun APDS-9960 - GestureTest"));
  Serial.println(F("--------------------------------"));
  
  // Initialize interrupt service routine
  attachInterrupt(0, Interrompe_rotina, FALLING);

  // Initialize APDS-9960 (configure I2C and initial values)
  if ( Sensor_APDS.init() ) {
    Serial.println(F("APDS-9960 initialization complete"));
  } else {
    Serial.println(F("Something went wrong during APDS-9960 init!"));
  }
  
  // Start running the APDS-9960 gesture sensor engine
  if ( Sensor_APDS.enableGestureSensor(true) ) {
    Serial.println(F("Gesture sensor is now running"));
  } else {
    Serial.println(F("Something went wrong during gesture sensor init!"));
  }
}

void loop() 
{
 
 if( Variavel_flag == 1 ) 
 {
  detachInterrupt(0);
  Detectar_Gestos();
  Variavel_flag = 0;
  attachInterrupt(0, Interrompe_rotina, FALLING);
 }
}

// *************************************************************************************************************************************************************************************

void Interrompe_rotina() 
{
  Variavel_flag = 1;
}


// void para detectar qual foi o gesto no sensor ****************************************************************************************************************************************
void Detectar_Gestos() 
{
    if ( Sensor_APDS.isGestureAvailable() ) 
    {
     switch ( Sensor_APDS.readGesture() ) 
     {
      case DIR_UP: //Comando baixo para cima
        Serial.println("Gesto para CIMA");
      break;
      case DIR_DOWN: //Comando cima para baixo
        Serial.println("Gesto para BAIXO");
      break;
      case DIR_LEFT:  //Comando direita para a esquerda
        Serial.println("Gesto para ESQUERDA");
      break;
      case DIR_RIGHT: //Comando esquerda para a direita
        Serial.println("Gesto para DIREITA");
      break;
      case DIR_NEAR: //Comando perto
        Serial.println("Gesto PERTO");
      break;
      case DIR_FAR: //Comando longe
        Serial.println("Gesto LONGE ");
      break;
      default: //Comando não reconhecido
        Serial.println("Gesto DESCONHECIDO");
        
    } // finaliza o case de qual foi o gesto
  } // Finaliza a verificação de gestos
} // Fecha o void

// *************************************************************************************************************************************************************************************

