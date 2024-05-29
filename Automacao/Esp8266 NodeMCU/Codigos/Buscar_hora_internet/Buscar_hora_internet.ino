#include <NTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiUdp.h>

const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";

IPAddress staticIP(10,10,25,98);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
IPAddress dns(8,8,8,8);
WiFiUDP ntpUDP;
uint32_t TempoAtual = 0;
uint32_t UltimoTempo = 0;
String segundo; 
String minuto;
String hora;
String tempo;
NTPClient TempoServidor(ntpUDP, "a.st1.ntp.br", -3*3600, 60000);

void setup()
{
 Serial.begin(115200);

  WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara, dns);  // (DNS not required)  
 while(WiFi.status() != WL_CONNECTED) 
 {
  delay(50);
  Serial.print(".");
 }
 TempoServidor.begin();
 delay(100);
 TempoServidor.forceUpdate();
 delay(100);
}


void VerificaTempo(void) 
{
 TempoAtual = millis();//Tempo atual em ms
 //Lógica de verificação do tempo
 if (TempoAtual - UltimoTempo > 1000) 
 {
  UltimoTempo = TempoAtual;    // Salva o tempo atual
  TempoServidor.forceUpdate();
      Serial.println(TempoServidor.getDay());
  String tempo = TempoServidor.getFormattedTime();
    
  hora = (tempo.substring(0, 2));
  minuto = (tempo.substring(3, 5));
  segundo = (tempo.substring(6, 8));
  Serial.println(tempo);
  Serial.println(hora.toInt());
  Serial.println(minuto);
  Serial.println(segundo);
 }
}

void loop() 
{
 VerificaTempo(); // Chama a verificacao de tempo
}
