int alarmeAtivo;
int atuado;
int vezes1,vezes2;

// usado no blink do led
long valorTempo = 0; 
long intervalo = 1000; // DEFINE O TEMPO DO TIMER
int numero_vezes_loop;
int timer_ativo;



void setup ( )
{
pinMode(2,INPUT ); // botao arma alarme
pinMode(3,INPUT ); // botao desarma alarme
//pinMode(A5,INPUT ); // sinal de entrada do alarme DVR


pinMode(13,OUTPUT ); // rele tira pulso
digitalWrite(13,0);
pinMode(12,OUTPUT ); // sirene
digitalWrite(12,0);
pinMode(11,OUTPUT ); // discadora
digitalWrite(11,0);
pinMode (10,OUTPUT); // led status
digitalWrite(10,0);
alarmeAtivo=0;
vezes1,vezes2 = 0;
timer_ativo = 0;
numero_vezes_loop = 0;  


}

void loop ( )
{

  
  // TIMER DO LED
  
  // usasdo no timer do LED do Wireless
 unsigned long tempo = millis();


if (timer_ativo == 1)
{
  if(millis()- valorTempo >1000) 
 {
  digitalWrite(10,!digitalRead(10));
  valorTempo = millis();
 }
}

  //*******************************************************
  
 
 if ( digitalRead(2)!=0 ) // ativa alarme
{
alarmeAtivo=1;
timer_ativo=1;
delay(1000);
}

 if ( digitalRead(3)!=0 ) // desativa alarme
{
alarmeAtivo=0;
timer_ativo=0;
delay(1000);
}

 if ( analogRead(A5)>=600 && alarmeAtivo==1 && atuado==0) // sinal movimento
{
atuado=1;
}



if ( alarmeAtivo==1)

{
digitalWrite(13,1); // ativa rele sinal

if ( vezes1==0)
{
 digitalWrite(12,1);
 delay(250);
 digitalWrite(12,0);
 vezes1=5;
 vezes2=0;
} 

if ( atuado==1)
{
digitalWrite(12,1); // ativa sirene
digitalWrite(11,1); // ativa discadora
}

}

// --------------------

if(alarmeAtivo==0)
{
digitalWrite(10,0); // apaga led
digitalWrite(13,0); // desliga rele sinal

if ( vezes2==0)
{
  if (atuado==1)
  {
   digitalWrite(12,0);
   atuado=0;
   digitalWrite(11,0);
   delay(500);
  }
  
  digitalWrite(12,1);
  delay(200);
  digitalWrite(12,0);
  delay(200);
  digitalWrite(12,1);
  delay(200);
  digitalWrite(12,0);
  vezes1=0;
  vezes2=5;
}
}
// desatuar fim



}
