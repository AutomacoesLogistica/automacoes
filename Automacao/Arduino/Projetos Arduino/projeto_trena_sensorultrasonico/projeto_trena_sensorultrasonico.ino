//Incluindo biblioteca Ultrasonic.h
#include <Ultrasonic.h>

#define TRIGGER_PIN  9
#define ECHO_PIN     10

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
  pinMode(8,OUTPUT); // VCC
  pinMode(11,OUTPUT);// GND
  digitalWrite(8,1);
  digitalWrite(11,0);
  pinMode(ledVerde,OUTPUT); //Definindo pino digital 13 como saída.
  pinMode(ledAmarelo,OUTPUT); //Definindo pino digital 12 como saída.
  pinMode(ledVermelho,OUTPUT); //Definindo pino digital 11 como saída.
  digitalWrite(ledVerde,LOW);  
  digitalWrite(ledAmarelo,LOW);
  digitalWrite(ledVermelho,LOW);

}

void loop() {  
float cm;
long microsec = ultrasonic.timing();

  cm = ultrasonic.convert(microsec, Ultrasonic::CM);
  Serial.print(cm);
  Serial.println(", CM: ");
  delay(500);
}
