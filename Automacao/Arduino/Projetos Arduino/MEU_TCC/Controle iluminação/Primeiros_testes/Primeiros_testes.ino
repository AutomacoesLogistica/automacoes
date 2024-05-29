// MODULO CONTROLE DE ILUMINAÇÃO
int modoIluminacao;
int iluminacao;
int luz;
int randomico;
void setup() 
{
  
pinMode(4,OUTPUT); // Iluminação vermelha 1 frente
pinMode(5,OUTPUT); // Iluminação vermelha 2 frente
pinMode(6,OUTPUT); // Iluminação verde 1 cauda
pinMode(7,OUTPUT); // Iluminação verde 2 cauda
pinMode(8,OUTPUT); // Iluminação branca base
pinMode(2,INPUT); // Interruptor trocar modo
attachInterrupt(0, Altera_modo_Iluminacao, FALLING);
pinMode(3,INPUT); // Interruptor trocar modo
attachInterrupt(1, modo_luz, FALLING);
digitalWrite(4,0);
digitalWrite(5,0);
digitalWrite(6,0);
digitalWrite(7,0);

modoIluminacao = 0;
luz = 0;
randomico = 0;
}

void loop() 
{

if (digitalRead(2) == 1 && iluminacao == 1 )
{
  iluminacao = 0;
  
  delay(100);
}




if (digitalRead(3) == 1 && luz == 1 )
{
  luz = 0;
  delay(100);
}





if (randomico == 1 )
{
  modoIluminacao = random(7);
  
}




if (modoIluminacao == 0)
{
  for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
}


if (modoIluminacao == 1)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }

  digitalWrite(4,1);
  delay(200);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(6,1);
  delay(200);
  digitalWrite(7,1);
  delay(200);
  digitalWrite(4,0);
  delay(200);
  digitalWrite(5,0);
  delay(200);
  digitalWrite(6,0);
  delay(200);
  digitalWrite(7,0);
  delay(200);


  
}

if (modoIluminacao == 2)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }

  digitalWrite(4,1);
  delay(200);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(6,1);
  delay(200);
  digitalWrite(7,1);
  delay(200);
  digitalWrite(7,0);
  delay(200);
  digitalWrite(6,0);
  delay(200);
  digitalWrite(5,0);
  delay(200);
  digitalWrite(4,0);
  delay(200);


}


if (modoIluminacao == 3)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  digitalWrite(7,0);
  digitalWrite(4,1);
  delay(200);
  digitalWrite(4,0);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(5,0);
  digitalWrite(6,1);
  delay(200);
  digitalWrite(6,0);
  digitalWrite(7,1);
  delay(200);
  
  
}

if (modoIluminacao == 4)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
  digitalWrite(6,0);
  digitalWrite(4,1);
  delay(200);
  digitalWrite(4,0);
  digitalWrite(5,1);
  delay(200);
  digitalWrite(5,0);
  digitalWrite(7,1);
  delay(200);
  digitalWrite(7,0);
  digitalWrite(6,1);
  delay(200);
}


if (modoIluminacao == 5)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(4,1);
   digitalWrite(5,1);
   delay(100);
   digitalWrite(4,0);
   digitalWrite(5,0);
   delay(100);

  }
   digitalWrite(4,0);
   digitalWrite(5,0);

   for(int x = 0;x<5;x++ )
  {
   digitalWrite(6,1);
   digitalWrite(7,1);
   delay(100);
   digitalWrite(6,0);
   digitalWrite(7,0);
   delay(100);
   
  }
}

if (modoIluminacao == 6)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(4,1);
   digitalWrite(7,1);
   delay(100);
   digitalWrite(4,0);
   digitalWrite(7,0);
   delay(100);

  }
   digitalWrite(4,0);
   digitalWrite(7,0);

   for(int x = 0;x<5;x++ )
  {
   digitalWrite(5,1);
   digitalWrite(6,1);
   delay(100);
   digitalWrite(5,0);
   digitalWrite(6,0);
   delay(100);
   
  }
}


if (modoIluminacao == 7)
{
   for(int x = 4;x<8;x++ )
  {
    digitalWrite(x,0);
  }
  
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(4,1);
   delay(100);
   digitalWrite(4,0);
   delay(100);

  }
   digitalWrite(4,0);

   for(int x = 0;x<5;x++ )
  {
   digitalWrite(5,1);
   delay(100);
   digitalWrite(5,0);
   delay(100);

  }
   digitalWrite(5,0);
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(6,1);
   delay(100);
   digitalWrite(6,0);
   delay(100);

  }
   digitalWrite(6,0);
   for(int x = 0;x<5;x++ )
  {
   digitalWrite(7,1);
   delay(100);
   digitalWrite(7,0);
   delay(100);

  }
}




}// fecha o loop




void Altera_modo_Iluminacao() 
{


if (digitalRead(2)==0 && iluminacao == 0)
{  
 if (randomico == 0 )
 {
  modoIluminacao++;
  iluminacao = 1;  

  if (digitalRead(8)==0)
  {
    digitalWrite(8,1);
    delay(200);
    digitalWrite(8,0);
  }
  
 }
  
 
  
  if (randomico == 1)
  {
    modoIluminacao = -1;
    randomico = 0;
  }
  if (modoIluminacao == 8 && randomico == 0)
  {
   randomico = 1;
  }
}

}
void modo_luz()
{
if (digitalRead(3)==0 && luz == 0)
{  
  digitalWrite(8,!digitalRead(8));luz = 1;
  
}

}

