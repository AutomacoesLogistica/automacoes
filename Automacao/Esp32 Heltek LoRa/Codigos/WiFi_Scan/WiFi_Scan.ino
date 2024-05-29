/*
 *  This sketch demonstrates how to scan WiFi networks.
 *  The API is almost the same as with the WiFi Shield library,
 *  the most obvious difference being the different file you need to include:
 */
#include "WiFi.h"

void setup()
{
 Serial.begin(115200);
 WiFi.mode(WIFI_STA); // Seta o WIFI como Station
 WiFi.disconnect(); // Retira todos caso estejam algum conectado neles
 delay(2000);
 
}

void loop()
{
 Serial.println("Iniciando Pesquisa Wifi");
 // Inicia a pesquisa das redes visiveis
 int n = WiFi.scanNetworks(); // Chama a funcao do WIFI para scanear as redes visiveis
 
 if (n == 0) {Serial.println("Nao encontrado redes WIFI");} // Caso não encontre nenhuma rede disponivel
 else
 {
  Serial.print(n);
  Serial.println(" Redes WIFI descobertas");
  for (int i = 0; i < n; ++i) 
  {
   // Imprime na serial os dados das redes encontradas
   Serial.print(i + 1); //Imprime o numero da rede sempre incrementada para listar em numeros
   Serial.print(" : "); // Imprime o separador de :
   Serial.print(WiFi.SSID(i)); //Imprime o nome do SSID encontrado
   Serial.print("  -  ("); // Abre parenteses para mostrar o dB do sinal. Quanto mais proximo de 0 mais forte o sinal
   Serial.print(WiFi.RSSI(i)); // Imprime a intensidade do sinal
   Serial.print(" dB )  -  "); // Imprime Unidade dB e fecha o parenteses
   Serial.print((WiFi.encryptionType(i) == WIFI_AUTH_OPEN)?"Aberta":"Fechada"); // Imprime a condição da rede
   if ( WiFi.RSSI(i)<=0 && WiFi.RSSI(i)>-30 ){Serial.println("  -  Sinal Excelente");}
   else if ( WiFi.RSSI(i)<= -60 && WiFi.RSSI(i)>-31 ){Serial.println("  -  Sinal Forte");}
   else {Serial.println("  -  Sinal Fraco");}
   delay(10);
  } // Fecha o for
 }//Fecha o Else do if(n==0)
 Serial.println("");
 // Espera 5 segundos para uma nova pesquisa
 delay(5000);
}// Fecha o Loop
