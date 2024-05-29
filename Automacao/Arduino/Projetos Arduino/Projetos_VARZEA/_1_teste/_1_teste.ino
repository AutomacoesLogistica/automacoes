void setup()
{
Serial.begin(9600);
pinMode(2,OUTPUT);
}

void loop()
{

for(int a = 1; a<=255; a++)
{
analogWrite(2,a);
Serial.println(a);
delay(500);
}
  
}

