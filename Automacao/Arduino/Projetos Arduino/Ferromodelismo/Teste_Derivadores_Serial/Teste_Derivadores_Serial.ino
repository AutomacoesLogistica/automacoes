#include <SPI.h>
#include <Servo.h>//Inclusão da biblioteca Servo
Servo servomotor;//Criando objeto do tipo Servo
int pos_reto = 82;//Variável que armazena a posição do servo
int pos_derivado = 120;//Variável que armazena a posição do servo
int x = 82;
String posicao = "Reto";

#define servo 3 // Servo
#define led_reto 4 // Led indicando que esta na posicao reto
#define led_derivado 5 // Led indicando que esta na posicao derivado

void setup() 
{
 pinMode(servo,OUTPUT);
 servomotor.attach(3);//Atribui o pino digital 3 ao objeto servomotor
 servomotor.write(x);
 posicao = "Reto";
 Serial.begin(9600);
 Serial.println("Iniciado!");
 



}

void loop() 
{

   if(Serial.available()>0)
   {
    char c = Serial.read();
    if(c == 'a')
    {
     x++; //92; 
     servomotor.write(x);
     Serial.println(x); 
    }
    else if( c == 's')
    {
     x--; //92; 
     servomotor.write(x);
     Serial.println(x); 
    }
    else if(c == 'd')
    {
     x = pos_derivado; //120; 
     servomotor.write(x);
     Serial.println(x); 
    }
    else if(c == 'r')
    {
     x = pos_reto; //120; 
     servomotor.write(x);
     Serial.println(x); 
    }   
   }// Fecha Serial.available
 } //Fecha loop
