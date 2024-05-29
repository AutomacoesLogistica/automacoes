#include <Servo.h>
int leitura = 0;
int saidaPWM = 0;
int SaidaMotor1 = 6;
Servo Motor1;

void setup() 
{
Serial.begin(9600);
Motor1.attach(SaidaMotor1);

}

void loop() 
{
leitura = analogRead(A0);
saidaPWM = map(leitura,0,1023,0,179);
Motor1.write(saidaPWM);
Serial.println(saidaPWM);

}
