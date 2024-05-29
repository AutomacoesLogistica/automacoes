#include <Servo.h>

Servo myservo;

int potpin = 0;
int val;

void setup()
{
  myservo.attach(9);
}

void loop()
{
  Serial.begin(9600);Serial.println(val);
  val = analogRead(potpin);
  val = map(val, 0, 1023, 0, 185);
  myservo.write(val);
  delay(5);
}
