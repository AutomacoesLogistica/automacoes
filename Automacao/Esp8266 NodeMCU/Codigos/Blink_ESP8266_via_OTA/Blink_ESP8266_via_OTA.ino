/*
 * ATENÇÃO....  para este codigo funcinar é necessário ter instalado o Phyton em seu computador, e tambem colocar o código no ESP8266 que prepara-o para receber 
 * atualizações via over the air "OTA"
 * Nome do codigo >>>>>   Codigo para preparar ESP8266 receber OTA
 */

#include <ESP8266WiFi.h>
#include <ESP8266mDNS.h>
#include <WiFiUdp.h>
#include <ArduinoOTA.h>


 
const char* ssid = "AutomacaoLOG"; // Nome da rede wifi
const char* password = "logistica2019@"; // Senha da rede wifi
 
void setup() {
  //Colocamos o sinal D4 (GPIO02) do NodeMCU como saida 
  pinMode(D0, OUTPUT);
  Serial.begin(115200);
  Serial.println("Iniciando...");
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.waitForConnectResult() != WL_CONNECTED) {
    Serial.println("Conexao falhou! Reiniciando...");
    delay(5000);
    ESP.restart();
  }
 
  ArduinoOTA.onStart([]() {
    Serial.println("Inicio...");
  });
  ArduinoOTA.onEnd([]() {
    Serial.println("nFim!");
  });
  ArduinoOTA.onProgress([](unsigned int progress, unsigned int total) {
    Serial.printf("Progresso: %u%%r", (progress / (total / 100)));
  });
  ArduinoOTA.onError([](ota_error_t error) {
    Serial.printf("Erro [%u]: ", error);
    if (error == OTA_AUTH_ERROR) Serial.println("Autenticacao Falhou");
    else if (error == OTA_BEGIN_ERROR) Serial.println("Falha no Inicio");
    else if (error == OTA_CONNECT_ERROR) Serial.println("Falha na Conexao");
    else if (error == OTA_RECEIVE_ERROR) Serial.println("Falha na Recepcao");
    else if (error == OTA_END_ERROR) Serial.println("Falha no Fim");
  });
  ArduinoOTA.begin();
  Serial.println("Pronto");
  Serial.print("Endereco IP: ");
  Serial.println(WiFi.localIP());
}
 
void loop() {
  // Mantenha esse trecho no inicio do laço "loop" - verifica requisicoes OTA
  ArduinoOTA.handle();
  digitalWrite(D0, HIGH); // Aciona sinal 2
  delay(500); // Espera por 2 segundos
  digitalWrite(D0, LOW); // Apaga sinal 2
  delay(500);  // Espera por 2 segundos
  }
