const int ledPin = 13; // the number of the LED pin
int ledState = LOW; // ledState used to set the LED
long valorTempo_10_1,valorTempo_10_2,valorTempo_10_3,valorTempo_10_4,valorTempo_10_5;
long valorTempo_T_1,valorTempo_T_2,valorTempo_T_3,valorTempo_T_4,valorTempo_T_5;
int Numero_10,Numero_T;
int timer_ativo;
int timer_ativo1;
int resultado10_1,resultado10_2,resultado10_3,resultado10_4,resultado10_5;
void setup() 
{
  Serial.begin(9600);
pinMode(ledPin, OUTPUT); 
digitalWrite(ledPin, 0);
timer_ativo=0;
timer_ativo1=0;
Numero_10 =1;
Numero_T = 0;
valorTempo_10_1,valorTempo_10_2,valorTempo_10_3,valorTempo_10_4,valorTempo_10_5 = 0;//Recebe os tempos de 10 metros
valorTempo_T_1,valorTempo_T_2,valorTempo_T_3,valorTempo_T_4,valorTempo_T_5 = 0;// Recebe os tempos totais
resultado10_1,resultado10_2,resultado10_3,resultado10_4,resultado10_5 = 0; // Inicia os tempos em zero
}


void loop()
{

int sensor1 = analogRead(A0); // Le o primeiro sensor sentido fluxo
int sensor2 = analogRead(A1); // Le o segundo sensor sentido fluxo  
unsigned long tempo = millis();




if (sensor1 >1000)
{
 timer_ativo++; 
 
}










// LOGICA PARA TOMADA DO PRIMEIRO TEMPO de 10 M

if (Numero_10 == 1)
{  
  if (timer_ativo == 3)
  {
  timer_ativo = 0;  
  resultado10_1 = (valorTempo_10_2-valorTempo_10_1)/1000;
  Numero_10 = 1;
  Serial.println(resultado10_1);
  } 

  if (timer_ativo == 2 && sensor2 == 1023 )
  {   timer_ativo = 3; 
   valorTempo_10_2 = tempo;
  }
  
 
  if (timer_ativo == 1)
  {
   timer_ativo = 2; 
   valorTempo_10_1 = tempo;
   
  }
  
  
}
  // Fecha a tomada do primeiro tempo de 10 Metros
}


/*

// ***********************************************************************************

// LOGICA PARA TOMADA DO SEGUNDO TEMPO de 10 M
if (Numero_10 == 2)
{  
  if (timer_ativo == 1)
  {
   timer_ativo == 2; 
   valorTempo_10_1 = tempo;
  }
  
  if (timer_ativo == 2 && sensor2 >=350 )
  {
   timer_ativo == 3; 
   valorTempo_10_2 = tempo;
  }
  
  if (timer_ativo == 3)
  {
  timer_ativo = 4;  
  resultado10_2 = (valorTempo_10_2-valorTempo_10_1)/1000;
  Numero_10 = 3;
  Serial.println(resultado10_2);
  } 
} // Fecha a tomada do primeiro tempo de 10 Metros


// ***********************************************************************************

// LOGICA PARA TOMADA DO TERCEIRO TEMPO de 10 M
if (Numero_10 == 3)
{  
  if (timer_ativo == 1)
  {
   timer_ativo == 2; 
   valorTempo_10_1 = tempo;
  }
  
  if (timer_ativo == 2 && sensor2 >=350 )
  {
   timer_ativo == 3; 
   valorTempo_10_2 = tempo;
  }
  
  if (timer_ativo == 3)
  {
  timer_ativo = 4;  
  resultado10_3 = (valorTempo_10_2-valorTempo_10_1)/1000;
  Numero_10 = 4;
  Serial.println(resultado10_3);
  } 
}  // Fecha a tomada do primeiro tempo de 10 Metros


// ***********************************************************************************


// LOGICA PARA TOMADA DO QUARTO TEMPO de 10 M
if (Numero_10 == 4)
{  
  if (timer_ativo == 1)
  {
   timer_ativo == 2; 
   valorTempo_10_1 = tempo;
  }
  
  if (timer_ativo == 2 && sensor2 >=350 )
  {
   timer_ativo == 3; 
   valorTempo_10_2 = tempo;
  }
  
  if (timer_ativo == 3)
  {
  timer_ativo = 4;  
  resultado10_5 = (valorTempo_10_2-valorTempo_10_1)/1000;
  Serial.println(resultado10_4);
  } 
}  // Fecha a tomada do primeiro tempo de 10 Metros


// ***********************************************************************************

// LOGICA PARA TOMADA DO QUINTO TEMPO de 10 M
if (Numero_10 == 5)
{  
  if (timer_ativo == 1)
  {
   timer_ativo == 2; 
   valorTempo_10_1 = tempo;
  }
  
  if (timer_ativo == 2 && sensor2 >=350 )
  {
   timer_ativo == 3; 
   valorTempo_10_2 = tempo;
  }
  
  if (timer_ativo == 3)
  {
  timer_ativo = 4;  
  resultado10_5 = (valorTempo_10_2-valorTempo_10_1)/1000;
  Numero_10 = 6;
  Serial.println(resultado10_5);
  } 
}  // Fecha a tomada do primeiro tempo de 10 Metros


/*
if (timer_ativo == 4&& Numero_10 ==6)
{
Serial.println(resultado10_1);
Serial.println(resultado10_2);
Serial.println(resultado10_3);
Serial.println(resultado10_4);
Serial.println(resultado10_5);



}




*/


// **************************************************************************************************************************************************************************************









