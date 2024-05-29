#include <Servo.h>

Servo myservo;

int potpin = 0;
int val;


void setup()
{
 

  pinMode(2,INPUT);
 digitalWrite(2,1);
 

  myservo.attach(9);
   Serial.begin(9600);
  delay(10);
 
}

void loop()
{int v1 = digitalRead(2);
  int valor1=('1023');
int valor2=('0');
    Serial.println(v1);
   
    if (v1==0)
  {
   myservo.write(valor1);

}
  else if (v1==1)
  {
   myservo.write(valor2);

}
}
