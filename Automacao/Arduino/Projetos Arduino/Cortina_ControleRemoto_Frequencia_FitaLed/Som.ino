void Som()
{
float valor = analogRead(A0);






if (corSom == 0)
{
if (valor>=10)
{
analogWrite(RED,255);
}
else
{
analogWrite(RED,0);
}
}

if (corSom == 1)
{
if (valor>=10)
{
analogWrite(GREEN,255);
}
else
{
analogWrite(GREEN,0);
}
}

if (corSom == 2)
{
if (valor>=10)
{
analogWrite(BLUE,255);
}
else
{
analogWrite(BLUE,0);
}
}

if (corSom == 3)
{
if (valor>=10)
{
analogWrite(RED,255);  
analogWrite(GREEN,255);
}
else
{
analogWrite(RED,0);
analogWrite(GREEN,0);
}
}

if (corSom == 4)
{
if (valor>=10)
{
analogWrite(RED,255);  
analogWrite(BLUE,255);
}
else
{
analogWrite(RED,0);
analogWrite(BLUE,0);
}
}

if (corSom == 5)
{
if (valor>=10)
{
analogWrite(BLUE,255);  
analogWrite(GREEN,255);
}
else
{
analogWrite(BLUE,0);
analogWrite(GREEN,0);
}
}

if (corSom == 6)
{
if (valor>=10)
{
analogWrite(RED,255);  
analogWrite(GREEN,255);
analogWrite(BLUE,255);
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}

if (corSom == 7)
{
if (valor>=10)
{
analogWrite(RED,100);  
analogWrite(GREEN,255);
analogWrite(BLUE,255);
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}

if (corSom == 8)
{
if (valor>=10)
{
analogWrite(RED,255);  
analogWrite(GREEN,100);
analogWrite(BLUE,255);
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}
if (corSom == 9)
{
if (valor>=10)
{
analogWrite(RED,255);  
analogWrite(GREEN,255);
analogWrite(BLUE,100);
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}


if (corSom == 10)
{
if (valor>=10)
{
analogWrite(RED,100);  
analogWrite(GREEN,100);
analogWrite(BLUE,255);
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}

if (corSom == 11)
{
if (valor>=10)
{
analogWrite(RED,100);  
analogWrite(GREEN,255);
analogWrite(BLUE,100);
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}

if (corSom == 12)
{
if (valor>=10)
{
analogWrite(RED,255);  
analogWrite(GREEN,100);
analogWrite(BLUE,100);
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}

if (corSom == 13)
{
if (valor>=10)
{
analogWrite(RED,random(A3));  
analogWrite(GREEN,random(A4));
analogWrite(BLUE,random(A5));
}
else
{
analogWrite(RED,0);  
analogWrite(GREEN,0);
analogWrite(BLUE,0);
}
}


if (corSom==14){corSom=0;}






}
