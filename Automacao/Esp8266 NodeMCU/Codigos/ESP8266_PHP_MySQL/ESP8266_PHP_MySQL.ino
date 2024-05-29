/*
 * This example show how to ping a remote machine using it's hostname
 */

#include <ESP8266WiFi.h>

#define Led_Wifi 16
const char* ssid     = "GAGF";
const char* password = "logistica2019@";
const char* host = "192.168.2.12";
const int port = 80;

// UTMI - BALANÇA 01 - BALANÇA 02


IPAddress ip(192, 168, 2, 84); // IP do dispositivo STATIC
IPAddress gateway(192, 168, 2, 1); //Gateway Padrao da rede
IPAddress subnet(255, 255, 255, 0); //Máscara de Sub-Rede
WiFiClient cliente;

void setup() {
  Serial.begin(115200);
  delay(200);

  // We start by connecting to a WiFi network
  pinMode(Led_Wifi,OUTPUT);
  digitalWrite(Led_Wifi,LOW);
  Serial.println();
  Serial.println();
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
void chama_consulta_php(String dispositivo,String condicao)
{
 // Use WiFiClient class to create TCP connections
  
  if (!cliente.connect(host, port)) {
    Serial.println("Falha na conexao");
    delay(50);
    return;
  }

  String url = "/gagf/comando_cancelas_mb.php?";
         url += "dispositivo=";
         url += (dispositivo);
         url += "&condicao=";
         url += (condicao);
  cliente.print(String("GET ")+ url+ " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
  //Serial.println ( "Publicou: Dispositivo = " + dispositivo + " - Condicao = " + condicao); 
  
   
   
   
   
   // Tempo de aguardo para recepção de mensagens
  unsigned long timeout = millis();
  while (cliente.available() == 0) {
    if (millis() - timeout > 1000) {
      Serial.println(">>> Client Timeout !");
      cliente.stop();
      return;
    }
  }
   String line;
  // Read all the lines of the reply from server and print them to Serial
  //Serial.println("Mensagem recebida do servidor");
  // not testing 'client.connected()' since we do not need to send data here
  while (cliente.available()) {
    line = cliente.readStringUntil('\r');
    //Serial.println(line);
  }

  if(line.indexOf("mensagem:")!= -1){
    int tamanho = line.length();
    int posicao_a = 0;
    String c = "";
    for (int x = 0; x<tamanho;x++)
    {
      c = line.substring(x,x+1);
      if (c == ",")
      {
        posicao_a = x;
      }
    }
    
    String topico = line.substring(10,posicao_a);
    String mensagem = line.substring(posicao_a + 1,tamanho-1);
    Serial.print("Topico: ");
    Serial.println(topico);
    Serial.print("Mensagem: ");
    Serial.println(mensagem);
    
  }else if (line.indexOf("sem_solicitacoes")){
    Serial.println("Banco Vazio!");
  }else{
    Serial.println("Erro ao salvar");
  }
}

void loop() 
{ 
 

  // PING DISPOSITIVOS SALA AUTOMACAO **************************************************************************************************************************************************
  
 chama_consulta_php("mqtt_php","OK");
 


  
  }
