void setup()
{
pinMode(13, OUTPUT);
pinMode(7, INPUT);
pinMode(6, INPUT);
}
void loop()
{
  int sAlto = digitalRead(7);
  int sbaixo = digitalRead(6);

if (sAlto==1&&sbaixo==0)
{digitalWrite(13,1);delay(5000);digitalWrite(13,0);delay(5000);}
if (sAlto==0&&sbaixo==1)
{digitalWrite(13,1);}
if (sAlto==1&&sbaixo==1)
{digitalWrite(13,1);delay(1000);digitalWrite(13,0);delay(1000);}
if (sAlto==0&&sbaixo==0)
{digitalWrite(13,0);}
}


