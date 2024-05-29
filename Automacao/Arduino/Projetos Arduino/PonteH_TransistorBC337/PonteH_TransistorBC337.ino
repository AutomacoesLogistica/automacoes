int valor,valor1;

void setup() 
{
Serial.begin(9600);  

valor1 = 0;
valor = 0;



pinMode(4,OUTPUT); // OUT_1
pinMode(5,OUTPUT); // OUT_2
pinMode(6,OUTPUT); // PWM_A
pinMode(9,OUTPUT); // PWM_B
pinMode(2,INPUT);  // IN1
pinMode(3,INPUT);  // IN2
}

void loop() 
{
valor1 = analogRead(A0);
valor = map(valor1,0,1023,0,255);
// RODA SENTIDO HORARIO ******************************************************************************************************************************************************************
if(digitalRead(2)==1 && digitalRead(3)==0)
{
 analogWrite(6,valor); analogWrite(9,0); digitalWrite(4,1); digitalWrite(5,0);
}
// RODA SENTIDO ANTI HORÁRIO *************************************************************************************************************************************************************
if(digitalRead(2)==0 && digitalRead(3)==1)
{
 analogWrite(6,0);  analogWrite(9,valor); digitalWrite(4,0); digitalWrite(5,1);
}
// PROTEÇÃO ELÉTRICA **********************************************************************************************************************************************************************
if(digitalRead(2)==0 && digitalRead(3)==0)
{
  analogWrite(6,0);  analogWrite(9,0);  digitalWrite(4,0);  digitalWrite(5,0);
}
if(digitalRead(2)==1 && digitalRead(3)==1)
{
  analogWrite(6,0);  analogWrite(9,0);  digitalWrite(4,0);  digitalWrite(5,0);
}

delay(300);
}
