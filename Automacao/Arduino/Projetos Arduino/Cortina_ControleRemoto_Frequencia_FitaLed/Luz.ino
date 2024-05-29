void Luz()
{
if (corLuz == 0)
{
analogWrite(RED,valor1);
}

if (corLuz == 1)
{
analogWrite(GREEN,valor1);
}

if (corLuz == 2)
{
analogWrite(BLUE,valor1);
}

if (corLuz == 3)
{
analogWrite(RED,valor1);  
analogWrite(GREEN,valor1);
}

if (corLuz == 4)
{
analogWrite(RED,valor1);  
analogWrite(BLUE,valor1);
}

if (corLuz == 5)
{
analogWrite(BLUE,valor1);  
analogWrite(GREEN,valor1);
}

if (corLuz == 6)
{
analogWrite(RED,valor1);  
analogWrite(GREEN,valor1);
analogWrite(BLUE,valor1);
}

if (corLuz == 7)
{
analogWrite(RED,valor1 - 155);  
analogWrite(GREEN,valor1);
analogWrite(BLUE,valor1);
}

if (corLuz == 8)
{
analogWrite(RED,valor1);  
analogWrite(GREEN,valor1 - 155);
analogWrite(BLUE,valor1);
}

if (corLuz == 9)
{
analogWrite(RED,valor1);  
analogWrite(GREEN,valor1);
analogWrite(BLUE,valor1-155);
}

if (corLuz == 10)
{
analogWrite(RED,valor1-155);  
analogWrite(GREEN,valor1-155);
analogWrite(BLUE,valor1);
}

if (corLuz == 11)
{
analogWrite(RED,valor1-155);  
analogWrite(GREEN,valor1);
analogWrite(BLUE,valor1-155);
}

if (corLuz == 12)
{
analogWrite(RED,valor1);  
analogWrite(GREEN,valor1-155);
analogWrite(BLUE,valor1-155);
}


if (corLuz==13)
{
 corLuz=0;
}
  
   
}
