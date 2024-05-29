#include <Servo.h>//Using servo library to control ESC
Servo motor1; //Creating a servo class with name as esc
Servo motor2; //Creating a servo class with name as esc
void setup()
{
motor1.attach(5); //Specify the esc signal pin,Here as D8
motor2.attach(6); //Specify the esc signal pin,Here as D8
motor1.writeMicroseconds(1000); //initialize the signal to 1000
motor2.writeMicroseconds(1000); //initialize the signal to 1000
delay(5000);
Serial.begin(9600);
}
void loop()
{
int val; //Creating a variable val
val= analogRead(A0); //Read input from analog pin a0 and store in val
val= map(val, 0, 1023,1000,2000); //mapping val to minimum and maximum(Change if needed) 
motor1.writeMicroseconds(val); //using val as the signal to esc
motor2.writeMicroseconds(val); //using val as the signal to esc
Serial.println(val);
}
