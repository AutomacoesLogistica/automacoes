#include <ESP8266WiFi.h>
#include <ESP8266mDNS.h>
#include <ArduinoOTA.h>
#include <ESP8266WebServer.h>

const char* ssid = "Bruno";
const char* password = "bruno268300";

ESP8266WebServer server(80);

const char* www_username = "brunogon";
const char* www_password = "268300";

void setup() {
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  if(WiFi.waitForConnectResult() != WL_CONNECTED) 
  {
   Serial.println("Falha na conexão do WIFI! Reiniciando...");
   delay(1000);
   ESP.restart();
  }
  
  ArduinoOTA.begin();

  server.on("/", [](){
    if(!server.authenticate(www_username, www_password))
      return server.requestAuthentication();
      // Aqui dentro executará uma vez caso conecte   
      // Podemos chamar um void por exemplo
      //server.send(200, "text/plain", "Login");
      tela_principal();
  });
  server.begin();
  
  Serial.println("");
  Serial.print("Abra seu navegador e digite http://");
  Serial.print(WiFi.localIP());
  Serial.println("/ e de enter");
}

void loop() {
  ArduinoOTA.handle();
  server.handleClient();
}
