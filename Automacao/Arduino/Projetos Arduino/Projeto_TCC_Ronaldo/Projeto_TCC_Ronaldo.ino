#include <Ultrasonic.h>

#define TRIGGER_PIN  4
#define ECHO_PIN     5


int atualiza = 0;
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 500;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
int pinoPWM = 6;
int cmDist;

Ultrasonic ultrasonic(TRIGGER_PIN, ECHO_PIN);

void setup() 
{
Serial.begin(9600);
pinoPWM = 0;
}

void loop()
{
 // executar se valor for menor que 130 cm
 if (cmDist >= 90 && cmDist <= 120)
 {
  analogWrite(pinoPWM,127);
  pinoPWM = 127;
 }
 if (cmDist >= 60 && cmDist < 90)
 {
 analogWrite(pinoPWM,197);
  pinoPWM = 197;
 }
 if (cmDist >= 30 && cmDist < 60)
 {
 analogWrite(pinoPWM,255);
  pinoPWM = 255;
 }
 
 if (((cmDist >=0)&&(cmDist <30 ))||(cmDist >120 ))
 {
 analogWrite(pinoPWM,0); 
   pinoPWM = 0;
 }


AtualMillis = millis();    //Tempo atual em ms
if (AtualMillis - UltimoMillis > intervalo) 
{
 UltimoMillis = AtualMillis;    // Salva o tempo atual
 ImprimeValores();
}

  analogWrite(6,255);
} // Fecha Loop


void ImprimeValores()
{
// long microsec = ultrasonic.timing(); //Lendo o sensor
// cmDist = ultrasonic.convert(microsec, Ultrasonic::CM); //Convertendo a distância em CM
 Serial.print("Centimetros: ");
 Serial.print(cmDist);
 Serial.print("            Valor PWM : ");
 Serial.println(pinoPWM);
 
}


