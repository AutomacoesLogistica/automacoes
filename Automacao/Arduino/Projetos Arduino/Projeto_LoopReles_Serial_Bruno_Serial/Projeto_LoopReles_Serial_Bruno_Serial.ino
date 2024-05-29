/*
      Exemplo rele serial (15/07/2018)

*/

#include <SerialRelayBruno.h>

const int NumeroModulos = 5;    // maximum of 10
const int TempoPausa = 1000;  // [ms]

SerialRelayBruno reles(5,6,NumeroModulos); // (data, clock, number of modules)

// --------------------------------------------------------------

void setup(){
  Serial.begin(115200);

    // For para desligar os reles 
  for(int i=1 ; i <= NumeroModulos ; i++){
    for(int j=1 ; j <= 8 ; j++){
      reles.SetRelay(j, DesligarRele, i);
      delay(20);
    }
  }

}

// --------------------------------------------------------------

void loop()
{
  // For para ligar os reles 
  for(int i=1 ; i <= NumeroModulos ; i++){
    for(int j=1 ; j <= 8 ; j++){
      reles.SetRelay(j, LigarRele, i);
      Serial.print("Ligando rele : ");
      Serial.print(j);
      Serial.print(" do Modulo : ");
      Serial.println(i);
      delay(TempoPausa);
    }
  }
  
  // For para desligar os reles 
  for(int i=1 ; i <= NumeroModulos ; i++){
    for(int j=1 ; j <= 8 ; j++){
      reles.SetRelay(j, DesligarRele, i);
      Serial.print("Desligando rele : ");
      Serial.print(j);
      Serial.print(" do Modulo : ");
      Serial.println(i);
      
      delay(TempoPausa);
    }
  }
}

// --------------------------------------------------------------




