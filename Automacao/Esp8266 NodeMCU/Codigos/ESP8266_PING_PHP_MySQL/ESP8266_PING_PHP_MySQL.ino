/*
 * This example show how to ping a remote machine using it's hostname
 */

#include <ESP8266WiFi.h>
#include <ESP8266Ping.h>


#define Led_Wifi 16
const char* ssid     = "GAGF";
const char* password = "logistica2019@";
const char* host = "10.10.25.229";
const int port = 8229;

// SALA LOGISTICA
const char* mqtt_php = "10.10.25.85";
const char* php_mqtt = "10.10.25.87";
const char* mqtt_php_monitor_tensao = "10.10.25.83";
const char* servidor_ping = "10.10.25.84";
const char* modem_gagf_logistica = "10.10.25.250";
const char* mikrotik_groove_automacao_utmi = "10.10.25.73";
const char* tablet_processador_tag = "10.10.25.91";
const char* nvr_cftv_logistica = "10.10.25.32";
const char* raspberry_servidor_automacao = "10.10.25.200";
const char* tablet_testes_logistica = "10.10.25.93";


// LINK PATIO DE EXCESSO
const char* mikrotik_patio_excesso = "10.10.25.97";
const char* camera_patio_excesso = "10.10.25.113";

// LINK UTMI
const char* mikrotik_utmi_automacao = "10.10.25.75";
const char* mikrotik_gagf_patio_utmi = "10.10.25.233";
const char* camera_patio_produto_utmi = "10.10.25.43";
const char* monitor_tensao_utmi = "10.10.25.82";

// LINK BALANÇA 02 MB
const char* mikrotik_balanca_02_mb = "10.10.25.139";
const char* dvr_balanca_02_mb = "10.10.25.227";
const char* camera_teste_parafusos_balanca_02_mb = "10.10.25.46";

// LINK PATRAG
const char* monitor_tensao_patrag = "10.10.25.202";


// LINK RECEBIMENTO DE ROM
const char* camera_superior_entrada_rec_rom = "10.10.25.110";
const char* camera_placa_entrada_rec_rom = "10.10.25.116";
const char* camera_superior_saida_rec_rom = "10.10.25.112";
const char* camera_placa_saida_rec_rom = "10.10.25.111";
const char* computador_sva_rec_rom = "10.10.25.117";
const char* raspberry_tv_rec_rom = "10.10.25.212";
const char* mikrotik_cria_link_cftv_rec_rom = "10.10.25.140";

// LINKS RECEBIMENTO ROM / SAIDA ALTERNATIVA



// UTMI - BALANÇA 01 - BALANÇA 02


IPAddress ip(10, 10, 25, 84); // IP do dispositivo STATIC
IPAddress gateway(10, 10, 25, 1); //Gateway Padrao da rede
IPAddress subnet(255, 255, 255, 0); //Máscara de Sub-Rede

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
void publicar_php_logistica(String dispositivo,String condicao)
{
 // Use WiFiClient class to create TCP connections
  WiFiClient cliente;
  if (!cliente.connect(host, port)) {
    Serial.println("Falha na conexao");
    delay(50);
    return;
  }

  String url = "/nodemcu/pings_mb.php?";
         url += "dispositivo=";
         url += (dispositivo);
         url += "&condicao=";
         url += (condicao);
  cliente.print(String("GET ")+ url+ " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");


  Serial.println ( "Publicou: Dispositivo = " + dispositivo + " - Condicao = " + condicao); 
}

void loop() 
{ 
  

  // PING DISPOSITIVOS SALA AUTOMACAO **************************************************************************************************************************************************
  
 if(Ping.ping(mqtt_php)) {Serial.println("mqtt-php = OK");publicar_php_logistica("mqtt_php","OK");} else {Serial.println("mqtt-php = Erro"); publicar_php_logistica("mqtt_php","Erro");}
 if(Ping.ping(php_mqtt)) {Serial.println("php_mqtt = OK");publicar_php_logistica("php_mqtt","OK");} else {Serial.println("php_mqtt = Erro");publicar_php_logistica("php_mqtt","Erro");}
 if(Ping.ping(mqtt_php_monitor_tensao)) {Serial.println("mqtt_php_monitor_tensao = OK");publicar_php_logistica("mqtt_php_monitor_tensao","OK");} else {Serial.println("mqtt_php_monitor_tensao = Erro");publicar_php_logistica("mqtt_php_monitor_tensao","Erro");}
 if(Ping.ping(servidor_ping)) {Serial.println("servidor_ping = OK");publicar_php_logistica("servidor_ping","OK");} else {Serial.println("servidor_ping = Erro");publicar_php_logistica("servidor_ping","Erro");}
 if(Ping.ping(modem_gagf_logistica)) {Serial.println("modem_gagf_logistica = OK");publicar_php_logistica("modem_gagf_logistica","OK");} else {Serial.println("modem_gagf_logistica = Erro");publicar_php_logistica("modem_gagf_logistica","Erro");}
 if(Ping.ping(mikrotik_groove_automacao_utmi)) {Serial.println("mikrotik_groove_automacao_utmi = OK");publicar_php_logistica("mikrotik_groove_automacao_utmi","OK");} else {Serial.println("mikrotik_groove_automacao_utmi = Erro");publicar_php_logistica("mikrotik_groove_automacao_utmi","Erro");}
 if(Ping.ping(tablet_processador_tag)) {Serial.println("tablet_processador_tag = OK");publicar_php_logistica("tablet_processador_tag","OK");} else {Serial.println("tablet_processador_tag = Erro");publicar_php_logistica("tablet_processador_tag","Erro");}
 if(Ping.ping(nvr_cftv_logistica)) {Serial.println("nvr_cftv_logistica = OK");publicar_php_logistica("nvr_cftv_logistica","OK");} else {Serial.println("nvr_cftv_logistica = Erro");publicar_php_logistica("nvr_cftv_logistica","Erro");}
 if(Ping.ping(raspberry_servidor_automacao)) {Serial.println("raspberry_servidor_automacao = OK");publicar_php_logistica("raspberry_servidor_automacao","OK");} else {Serial.println("raspberry_servidor_automacao = Erro");publicar_php_logistica("raspberry_servidor_automacao","Erro");}
 if(Ping.ping(tablet_testes_logistica)) {Serial.println("tablet_testes_logistica = OK");publicar_php_logistica("tablet_testes_logistica","OK");} else {Serial.println("tablet_testes_logistica = Erro");publicar_php_logistica("tablet_testes_logistica","Erro");}
 
 // LINK PATIO DE PRODUTO
 if(Ping.ping(mikrotik_patio_excesso)) {Serial.println("mikrotik_patio_excesso = OK");publicar_php_logistica("mikrotik_patio_excesso","OK");} else {Serial.println("mikrotik_patio_excesso = Erro");publicar_php_logistica("mikrotik_patio_excesso","Erro");}
 if(Ping.ping(camera_patio_excesso)) {Serial.println("camera_patio_excesso = OK");publicar_php_logistica("camera_patio_excesso","OK");} else {Serial.println("camera_patio_excesso = Erro");publicar_php_logistica("camera_patio_excesso","Erro");}
 
 // LINK UTMI
 if(Ping.ping(mikrotik_utmi_automacao)) {Serial.println("mikrotik_utmi_automacao = OK");publicar_php_logistica("mikrotik_utmi_automacao","OK");} else {Serial.println("mikrotik_utmi_automacao = Erro");publicar_php_logistica("mikrotik_utmi_automacao","Erro");}
 if(Ping.ping(mikrotik_gagf_patio_utmi)) {Serial.println("mikrotik_gagf_patio_utmi = OK");publicar_php_logistica("mikrotik_gagf_patio_utmi","OK");} else {Serial.println("mikrotik_gagf_patio_utmi = Erro");publicar_php_logistica("mikrotik_gagf_patio_utmi","Erro");}
 if(Ping.ping(camera_patio_produto_utmi)) {Serial.println("camera_patio_produto_utmi = OK");publicar_php_logistica("camera_patio_produto_utmi","OK");} else {Serial.println("camera_patio_produto_utmi = Erro");publicar_php_logistica("camera_patio_produto_utmi","Erro");}
 if(Ping.ping(monitor_tensao_utmi)) {Serial.println("monitor_tensao_utmi = OK");publicar_php_logistica("monitor_tensao_utmi","OK");} else {Serial.println("monitor_tensao_utmi = Erro");publicar_php_logistica("monitor_tensao_utmi","Erro");}

 // LINK BALANÇA 02 MB
 if(Ping.ping(mikrotik_balanca_02_mb)) {Serial.println("mikrotik_balanca_02_mb = OK");publicar_php_logistica("mikrotik_balanca_02_mb","OK");} else {Serial.println("mikrotik_balanca_02_mb = Erro");publicar_php_logistica("mikrotik_balanca_02_mb","Erro");}
 if(Ping.ping(dvr_balanca_02_mb)) {Serial.println("dvr_balanca_02_mb = OK");publicar_php_logistica("dvr_balanca_02_mb","OK");} else {Serial.println("dvr_balanca_02_mb = Erro");publicar_php_logistica("dvr_balanca_02_mb","Erro");}
 if(Ping.ping(camera_teste_parafusos_balanca_02_mb)) {Serial.println("camera_teste_parafusos_balanca_02_mb = OK");publicar_php_logistica("camera_teste_parafusos_balanca_02_mb","OK");} else {Serial.println("camera_teste_parafusos_balanca_02_mb = Erro");publicar_php_logistica("camera_teste_parafusos_balanca_02_mb","Erro");}

 // LINK PATRAG
 if(Ping.ping(monitor_tensao_patrag)) {Serial.println("monitor_tensao_patrag = OK");publicar_php_logistica("monitor_tensao_patrag","OK");} else {Serial.println("monitor_tensao_patrag = Erro");publicar_php_logistica("monitor_tensao_patrag","Erro");}




// LINK RECEBIMENTO DE ROM
if(Ping.ping(camera_superior_entrada_rec_rom)) {Serial.println("camera_superior_entrada_rec_rom = OK");publicar_php_logistica("camera_superior_entrada_rec_rom","OK");} else {Serial.println("camera_superior_entrada_rec_rom = Erro");publicar_php_logistica("camera_superior_entrada_rec_rom","Erro");}
if(Ping.ping(camera_placa_entrada_rec_rom)) {Serial.println("camera_placa_entrada_rec_rom = OK");publicar_php_logistica("camera_placa_entrada_rec_rom","OK");} else {Serial.println("camera_placa_entrada_rec_rom = Erro");publicar_php_logistica("camera_placa_entrada_rec_rom","Erro");}
if(Ping.ping(camera_superior_saida_rec_rom)) {Serial.println("camera_superior_saida_rec_rom = OK");publicar_php_logistica("camera_superior_saida_rec_rom","OK");} else {Serial.println("camera_superior_saida_rec_rom = Erro");publicar_php_logistica("camera_superior_saida_rec_rom","Erro");}
if(Ping.ping(camera_placa_saida_rec_rom)) {Serial.println("camera_placa_saida_rec_rom = OK");publicar_php_logistica("camera_placa_saida_rec_rom","OK");} else {Serial.println("camera_placa_saida_rec_rom = Erro");publicar_php_logistica("camera_placa_saida_rec_rom","Erro");}
if(Ping.ping(computador_sva_rec_rom)) {Serial.println("computador_sva_rec_rom = OK");publicar_php_logistica("computador_sva_rec_rom","OK");} else {Serial.println("computador_sva_rec_rom = Erro");publicar_php_logistica("computador_sva_rec_rom","Erro");}
if(Ping.ping(raspberry_tv_rec_rom)) {Serial.println("raspberry_tv_rec_rom = OK");publicar_php_logistica("raspberry_tv_rec_rom","OK");} else {Serial.println("raspberry_tv_rec_rom = Erro");publicar_php_logistica("raspberry_tv_rec_rom","Erro");}
if(Ping.ping(mikrotik_cria_link_cftv_rec_rom)) {Serial.println("mikrotik_cria_link_cftv_rec_rom = OK");publicar_php_logistica("mikrotik_cria_link_cftv_rec_rom","OK");} else {Serial.println("mikrotik_cria_link_cftv_rec_rom = Erro");publicar_php_logistica("mikrotik_cria_link_cftv_rec_rom","Erro");}





 
 Serial.println("");


  
  }
