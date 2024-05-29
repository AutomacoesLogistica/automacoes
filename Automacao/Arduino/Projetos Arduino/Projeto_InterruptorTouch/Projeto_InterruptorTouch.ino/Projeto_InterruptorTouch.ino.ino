#include <CapacitiveSensor.h>

int led3 = 11;
int led2 = 10;
int led1 = 9;

CapacitiveSensor   Sensor1 = CapacitiveSensor(4,2); 
//CapacitiveSensor   Sensor2 = CapacitiveSensor(4,3); 
//CapacitiveSensor   Sensor3 = CapacitiveSensor(4,5); 

// Utilizar resistor 10M para mais

void setup()
{
   
   pinMode(led1, OUTPUT);
   digitalWrite(led1,HIGH);
   pinMode(led2, OUTPUT);
   digitalWrite(led2,HIGH);
   pinMode(led3, OUTPUT);
   digitalWrite(led3,HIGH);
   Sensor1.set_CS_AutocaL_Millis(0xFFFFFFFF);
}

void loop()                    
{
    long DadosSensor1 =  Sensor1.capacitiveSensor(290);
    //long DadosSensor2 =  Sensor2.capacitiveSensor(305);
    //long DadosSensor3 =  Sensor3.capacitiveSensor(305);
    
    if (DadosSensor1 > 60)
    {
    analogWrite(led1,0);
    delay(300);
    DadosSensor1 = 0;
    for(int a = 0;a<255;a++)
    {
    analogWrite(led1,a);
    delay(10);  
    }
    }
      
    else 
    {
      analogWrite(led1,255);
    }    
    
   
 
   
     
     

      
     


}
