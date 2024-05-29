//Programa: Controle de motor brushless EMAX CF2822
//Autor : Arduino e Cia

#include <Servo.h>

Servo Motor1;
Servo Motor2;
Servo Motor3;
Servo Motor4;

//Pino do potenciometro
int pino_pot = A0;
//Pino de controle do motor
int pino_motor1 = 3;
int pino_motor2 = 5;
int pino_motor3 = 7;
int pino_motor4 = 9;

int valor = 0;

void setup()
{
  Serial.begin(9600);
  Motor1.attach(pino_motor1);
  Motor2.attach(pino_motor2);
  Motor3.attach(pino_motor3);
  Motor4.attach(pino_motor4);

}

void loop()
{
  valor = analogRead(pino_pot);
  valor = map(valor, 0, 1023, 0, 179);
  Serial.print("Potenciometro: ");
  Serial.println(valor);
  Motor1.write(valor);
  Motor2.write(valor);
  Motor3.write(valor);
  Motor4.write(valor);
}
