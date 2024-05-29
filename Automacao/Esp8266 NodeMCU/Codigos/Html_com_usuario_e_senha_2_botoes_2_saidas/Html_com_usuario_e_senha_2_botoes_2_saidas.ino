#include <ESP8266WiFi.h>
#include <ESP8266mDNS.h>
#include <ArduinoOTA.h>
#include <ESP8266WebServer.h>

const char* ssid = "Bruno"; //Nome da sua rede Wifi
const char* password = "bruno268300"; //Senha da rede

IPAddress ip(192, 168, 2, 201); //IP do ESP (para voce acessar pelo browser - voce TEM que mudar este IP tambem)
IPAddress gateway(192, 168, 2, 1); //IP do roteador da sua rede wifi
IPAddress subnet(255, 255, 255, 0); //Mascara de rede da sua rede wifi
WiFiServer server(80); //Criando o servidor web na porta 80

const int pin1 = 16; //Equivalente ao D0 no NodeMCU 
const int pin2 = 5; //Equivalente ao D1 no NodeMCU 


ESP8266WebServer server(80);

const char* www_username = "casa";
const char* www_password = "268300";

void setup() 
{
  
  pinMode(pin1, OUTPUT);
  digitalWrite(pin1, HIGH);
  pinMode(pin2, OUTPUT);
  digitalWrite(pin2, HIGH);
  WiFi.mode(WIFI_STA);
  WiFi.config(ip, gateway, subnet);
  WiFi.begin(ssid, password);
  Serial.begin(115200);
   
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
      tela_principal(); // se logar corretamente
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
