
#define encoderPinA  2
#define encoderPinB  4

volatile unsigned int encoderPos = 0;

void setup() 
{ 
  pinMode(encoderPinA, INPUT); 
  digitalWrite(encoderPinA, HIGH);// Pull Up
  pinMode(encoderPinB, INPUT); 
  digitalWrite(encoderPinB, HIGH);// Pull Up
  attachInterrupt(0, Encoder, CHANGE);
  Serial.begin (9600);
} 

void loop()
{
  
}

void Encoder() 
{
  if (digitalRead(encoderPinA) == digitalRead(encoderPinB)) 
  {
   encoderPos++;
  } 
  else 
  {
   if(encoderPos==0){encoderPos = 0;}
   else{encoderPos--;}
   
  }
 
   Serial.println(encoderPos);
   


}



