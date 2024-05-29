// Libs
#include <ESP8266WiFi.h>


const char* SSID = "Bruno"; // rede wifi
const char* PASSWORD = "bruno268300"; // senha da rede wifi


// setup
void setup() 
{

  Serial.begin(115200);
  conectarWiFi();
  
}

void loop() 
{

  if (WiFi.status() != WL_CONNECTED)
  {
   reconectarWiFi();
  }
  
}




void conectarWiFi() 
{
  delay(200);
  Serial.println("Conectando-se em: " + String(SSID));

  WiFi.begin(SSID, PASSWORD);
  while (WiFi.status() != WL_CONNECTED) 
  {
    delay(250);
    Serial.print(".");
  }
  
  Serial.println();
  Serial.print("Conectado na Rede " + String(SSID) + " | IP => ");
  Serial.println(WiFi.localIP());
}


void reconectarWiFi()
{
  while (WiFi.status() != WL_CONNECTED) 
  {
   delay(250);
   Serial.print(".");
  }
}
