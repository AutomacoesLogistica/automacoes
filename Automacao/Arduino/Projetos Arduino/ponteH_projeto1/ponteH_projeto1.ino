int ENABLE = 3;
int IN1 = 8;
int IN2 = 9;
int A;
void setup()
{

pinMode(IN1,OUTPUT);
pinMode(IN2,OUTPUT);

}


void loop()
{
  
digitalWrite(ENABLE, 1000);

A = analogRead(A0);

if(A>=800)
{
digitalWrite(IN1,LOW);
digitalWrite(IN2, HIGH);
}
if(A<=450)
{
digitalWrite(IN1,HIGH);
digitalWrite(IN2, LOW);
}

if(A>450 && A<799)
{
digitalWrite(IN1,LOW);
digitalWrite(IN2, LOW);
}


}
