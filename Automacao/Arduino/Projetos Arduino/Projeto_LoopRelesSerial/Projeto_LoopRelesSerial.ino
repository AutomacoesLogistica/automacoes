/*
      Exemplo rele serial (15/07/2018)

*/

#include <SerialRelayBruno.h>

const int NumeroModulos = 1;    // maximum of 10
const int TempoPausa = 50;  // [ms]

SerialRelayBruno reles(4,5,NumeroModulos); // (data, clock, number of modules)

// --------------------------------------------------------------

void setup(){
  Serial.begin(19200);
  reles.Info(&Serial,BIN);
  Serial.println();
  // For para desligar os reles 
  for(int i=1 ; i <= NumeroModulos ; i++)
  {
   for(int j=1 ; j <= 8 ; j++)
   {
    reles.SetRelay(j, DesligarRele, i);
    }
  }
  delay(3000);
  Serial.println("Desligado");
}

// --------------------------------------------------------------

void loop()
{
  // For para ligar os reles 
  for(int i=1 ; i <= NumeroModulos ; i++)
  {
   for(int j=1 ; j <= 8 ; j++)
   {
    Serial.print("Ligando rele : ");
    Serial.println(j);
    reles.SetRelay(j, LigarRele, i);
    delay(TempoPausa);
   }
  }
  
  // For para desligar os reles 
  for(int i=1 ; i <= NumeroModulos ; i++)
  {
   for(int j=1 ; j <=8 ; j++)
   {
    Serial.print("Desligando rele : ");
    Serial.println(j);
    reles.SetRelay(j, DesligarRele, i);
    delay(TempoPausa);
    }
  }
}

// --------------------------------------------------------------




