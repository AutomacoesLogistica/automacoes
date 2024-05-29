// Autor : FILIPEFLOP
 
#include <Wire.h>
#include <Adafruit_BMP085.h>
Adafruit_BMP085 bmp180;

// Valores para media movel **************************************************************

#define N 70 // Numero de amostas
float media; // Recebe a media
float valores[N]; // Array para armazenar os valores lidos
double soma; // Variavel para somar os valores 
float distanciaM = 0.0;

void setup() 
{
  Serial.begin(9600);
  if (!bmp180.begin())
  {
    Serial.println("Sensor nao encontrado !!");
    while (1) {}
  }
}
  
void loop() 
{   
   
  
   // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
  for(int i = N-1;i>0;i--)
  {
   valores[i] = valores[i-1];
  }
  
  valores[0] = bmp180.readAltitude(); // Coloca o valor mais atual em valores[0]
  soma = 0.0;  // Limpa a variavel de soma

   // For para calcular a media atualizada *************************************************************************************************
  for (int i=0;i<N;i++)
  {
    soma = soma+valores[i];
  }

  // ***************************************************************************************************************************************
  
  media = soma/N;

  distanciaM = media;  // atualiza distanciaCM com o valor ja estabilizado pela media movel

  Serial.println(distanciaM);
  
  
}
