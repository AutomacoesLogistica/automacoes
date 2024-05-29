//Incluindo biblioteca Ultrasonic.h
#include <Ultrasonic.h>

#define TRIGGER_PIN  6
#define ECHO_PIN     7

Ultrasonic ultrasonic(TRIGGER_PIN, ECHO_PIN);
//criando objeto ultrasonic e definindo as portas digitais do Trigger - 6 - e Echo - 7
//Ultrasonic ultrasonic(6,7);

//Declaração das constantes referentes aos pinos digitais.
int ledVerde = 13;
int ledAmarelo = 12;
int ledVermelho = 11;


float distanciaCM = 0;

void setup() {
  Serial.begin(9600); //Inicializando o serial monitor
  
  pinMode(ledVerde,OUTPUT); //Definindo pino digital 13 como saída.
  pinMode(ledAmarelo,OUTPUT); //Definindo pino digital 12 como saída.
  pinMode(ledVermelho,OUTPUT); //Definindo pino digital 11 como saída.
  digitalWrite(ledVerde,LOW);  
  digitalWrite(ledAmarelo,LOW);
  digitalWrite(ledVermelho,LOW);

}

void loop() {  
  
float distanciaCM = 0;
  
  
  
  long microsec = ultrasonic.timing(); //Lendo o sensor
  distanciaCM = ultrasonic.convert(microsec, Ultrasonic::CM); //Convertendo a distância em CM

  if (distanciaCM >99)
 {Serial.print(distanciaCM/100);
  Serial.println(" M");
  delay(1000);}
else if ( distanciaCM <=99)
{ Serial.print(distanciaCM);
  Serial.println("cm");
  delay(1000);}


//Método que centraliza o controle de acendimento dos leds.
  
  //Apagando todos os leds
  
  //Acendendo o led adequado para a distância lida no sensor
  if (distanciaCM >100) {
    digitalWrite(13,HIGH);  
  }
  else { digitalWrite(13,0);}

  if (distanciaCM <=99 && distanciaCM >= 10) {
    digitalWrite(ledAmarelo,HIGH);
  }
  else { digitalWrite(ledAmarelo,0);}  
  if (distanciaCM < 10) {
    digitalWrite(ledVermelho,HIGH);
  }
  else { digitalWrite(ledVermelho,0);}
}
