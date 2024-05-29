
#include <Servo.h>
char c;
Servo myservo;
int pos;

void setup() 
{
  Serial.begin(9600);
  myservo.attach(9);
  c = '0'; //parado
  pos = 90;
}

void loop() 
{
    while (Serial.available()>0)
    {
    c = Serial.read();  
    }
    
    
    if (c == '0'){pos = 90;Serial.println(pos);}
    if (c == '1'){pos = 0;Serial.println(pos);}
    if (c == '2'){pos = 85;Serial.println(pos);}
    if (c == '3'){pos = 180;Serial.println(pos);}
    if (c == '4'){pos = 95;Serial.println(pos);}
    c = 'x'; // Para limpar a serial
    
    myservo.write(pos);            
}

