
/* PROJETO VASO EXAUSTOR AUTOMATICO









*/
int atuado;
int vezes;
int intermediario;
// usado no timer

long valorTempo = 0; 
long intervalo = 50000; // DEFINE O TEMPO DO TIMER
int timer_ativo;

//***************************************************************************




void setup()
{
  Serial.begin(9600);
  timer_ativo = 0;
  pinMode(13,OUTPUT); // usado para o led do exaustor
  digitalWrite(13,0);
  pinMode(11,OUTPUT); // usado para o rele do exaustor
  digitalWrite(11,0);
  
  pinMode(12,INPUT); // usado para mapear o vaso  
  digitalWrite(12,1);
  atuado = 0;
  vezes = 0;
  intermediario = 0;
}

//******************************************************************************************************************************************************************************************

void loop()  
{
// usasdo no timer
 unsigned long tempo = millis();

  if (timer_ativo == 1 && atuado == 0)
  {
    if ( vezes == 0 )
    {
    valorTempo = tempo;
    vezes = 1;
    
    }
    
    
    if(tempo - valorTempo > intervalo) 
   {
    valorTempo = tempo;
    timer_ativo = 0;
    digitalWrite(13,1);
    digitalWrite(11,1);
   intermediario = 1;
   }
   
  }

// ********************************************************************************************************************************************************************************

 if ( digitalRead(12)==0 && atuado == 0 && intermediario == 0) //Caso alguem sente no vaso iniciará a contagem do tempo
 {
 timer_ativo = 1;

 }
 
 if ( digitalRead(12)==1 && atuado == 0 && timer_ativo == 1 && intermediario == 0) //Caso alguem sente no vaso iniciará a contagem do tempo
 {
 timer_ativo = 0;
 vezes = 0;
 }
 
 if ( digitalRead(12)==1 && timer_ativo == 0 && atuado == 0 && intermediario == 0) // Se ninguem sentar no vaso ele permanece sem fazer nada
 {
  
  atuado = 0;
 }


 if ( intermediario == 1 )
 {
  delay(1000);
  if (digitalRead(12)==1)
  {
  delay(1000);
  
  if (digitalRead(12)==1)
  {
  intermediario = 2 ;
  atuado = 1;  
  }

 }
 } 



 if ( atuado == 1 && intermediario == 2 )
 {
   
   if (digitalRead(12)==0)
   {
    intermediario = 1;
    digitalWrite(13,1);
    digitalWrite(11,1);

   }  

   delay(60000);

   if (digitalRead(12)==0)
   {
    intermediario = 1;
    digitalWrite(13,1);
    digitalWrite(11,1);

   }
   
   if (digitalRead(12)==1 )
   {  
     delay(500);
     
   if (digitalRead(12)==0)
   {
    intermediario = 1;
    digitalWrite(13,1);
    digitalWrite(11,1);
   }
   else
   {  
   digitalWrite(13,0);
   digitalWrite(11,0);
   atuado = 0;
   vezes = 0;
   intermediario = 0;
   }
   delay(1000);
   }
   
   if (digitalRead(12)==0)
   {
    intermediario = 1;
    digitalWrite(13,1);
    digitalWrite(11,1);

   }

     
 } 
}
