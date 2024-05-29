/*
 * This example show how to ping a remote machine using it's hostname
 */

#include <ESP8266WiFi.h>

#define Led_Wifi 16

#define botoeira_emergencia 5
#define saida_rele 4
#define dispositivo "lavador_bascula_mb"

const char* ssid     = "GAGF";
const char* password = "logistica2019@";
const char* host = "192.168.2.12"; // IP DO SERVIDOR PHP
const int port = 80;


IPAddress ip(192, 168, 2, 84); // IP do dispositivo STATIC
IPAddress gateway(192, 168, 2, 1); //Gateway Padrao da rede
IPAddress subnet(255, 255, 255, 0); //Máscara de Sub-Rede
WiFiClient cliente84; // colocar o final do IP junto ATENCAO - Dar control F e substituir o clienteXX pelo novo clienteXX para trocar em todo o codigo!

void setup() {
  Serial.begin(115200);
  delay(200);

  // We start by connecting to a WiFi network
  pinMode(Led_Wifi,OUTPUT);
  digitalWrite(Led_Wifi,LOW);
  pinMode(botoeira_emergencia,INPUT);
  pinMode(saida_rele,OUTPUT);
  digitalWrite(saida_rele,LOW);
  Serial.print("Conectando com ");
  Serial.println(ssid);
  
  WiFi.mode(WIFI_STA);
  WiFi.config(ip, gateway, subnet);
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(Led_Wifi,LOW);
    delay(500);
    Serial.print(".");
  }
  
  digitalWrite(Led_Wifi,HIGH); // Conectado!
  Serial.println("");
  Serial.println("WiFi conectado com");
  Serial.println("IP: ");
  Serial.println(WiFi.localIP());
  Serial.println("");

  

  
}

void chama_atualizar_php(String dispositivo2,String condicao)
{
 // Use WiFiClient class to create TCP connections
  
  if (!cliente84.connect(host, port)) {
    Serial.println("Falha na conexao");
    delay(50);
    return;
  }

  String url = "/gagf/alertas.php?";
         url += "dispositivo=";
         url += (dispositivo2);
         url += "&condicao=";
         url += (condicao);
  cliente84.print(String("GET ")+ url+ " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");

  
   
   
   
  
}

void loop() 
{ 
 

if(digitalRead(botoeira_emergencia)==LOW)
{
   chama_atualizar_php(dispositivo,"atuado");
   digitalWrite(saida_rele,HIGH); 
}
else
{
 chama_atualizar_php(dispositivo,"normal"); 
 digitalWrite(saida_rele,LOW);
}

delay(1000);
  
}// fecha loop
 
 


  
