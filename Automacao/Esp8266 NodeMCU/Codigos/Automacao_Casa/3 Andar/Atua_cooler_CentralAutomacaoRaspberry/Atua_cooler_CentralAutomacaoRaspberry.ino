/* 
 * CODIGO PARA ESP8266 NODEMCU PARA ACIONAR RELE E ESFRIAR RASPBERRY CENTRAL AUTOMACAO HOME ASSISTANT  
 *
 * D5 - ENTRADA SENSOR TEMPERATURA E HUMIDADE
 * D6 - SAIDA RELE PARA ACIONAR COOLER
 *
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 *
 */

#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>
#include <PubSubClient.h>

#define led 10 // SD3
#define cooler 12 //D6
#define raspberry 13 //D7

#include "DHTesp.h"
DHTesp dht;


const char *Usuario     = "AutomacaoLOG";
const char *Senha = "logistica2019@";
unsigned int contador = 0;
String local = "cooler_ha";

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/ha/cooler_ha/temp"    //  PARA TROCAR SELECIONAR "arvore_natal" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx
#define TOPICO_PUBLISH   "dev/test/minhacasa/ha/status/cooler_ha"

String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];


IPAddress staticIP(192, 168, 20, 110);
IPAddress gateway(192, 168, 20, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient cooler_ha;                                 //Instância do WiFiClient
PubSubClient client(cooler_ha);                       //Passando a instância do WiFiClient para a instância do PubSubClient
ESP8266HTTPUpdateServer atualizadorOTA_cooler_ha; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_medidor_corrente_tensao(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Cooler Home Assistant";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;



void ConectarWIFI()
{
 WiFi.mode(WIFI_STA);
 WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara);
 if (WiFi.status() != WL_CONNECTED)
 {
  delay(500);
  Serial.print(".");
 }
 Serial.println("");
 Serial.println("WiFi conectado com");
 Serial.println("IP: ");
 Serial.println(WiFi.localIP());
 Serial.println("");
 valor_ip = WiFi.localIP().toString();
 mac = WiFi.macAddress();
 Pagina();
}// Fecha void ConectarWIFI

void Pagina()
{
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DADOS QUE SERAO EXIBIDOS NO SITE

  paginaWeb = ""
  "<!DOCTYPE html><html>"
  "<head>"
  "<title>OTA</title>"
  "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
  "<meta charset='UTF-8'>"
  "<meta http-equiv='X-UA-Compatible' content='IE=edge'>"
  "</head>"
  "<body style='margin: 20px; padding: 0px; background-color: #ADD8E6'>"
    "<h1 style='color: #00008B'>"+titulo+"</h1>"
    "<h3>IP: " + valor_ip + "</h3>"
    "<h3>MAC: " + mac + "</h3>"  
    "<h3>Para atualizar o sketch basta abrir <a href='http://"+valor_ip+"/update'>http://"+valor_ip+"/update</a> e pressionar enter!</h3>" 
    "<footer>Desenvolvido por Bruno Gonçalves </footer>"
  "</body>"
  "</html>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  servidorWeb_medidor_corrente_tensao.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_medidor_corrente_tensao.send(200, "text/html", paginaWeb);}



void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
  //Serial.print("Chegou do MQTT: ");
  String Enviar;

  Enviar = "";
  Enviar = strMensagem;
  Serial.println(Enviar);
  if(Enviar == "ligar")
  {
   digitalWrite(cooler,LOW); // Liga o cooler 
   client.publish("dev/test/minhacasa/ha/cooler_ha/status", "ligado");
   Serial.println("Ligando o cooler");
  }
  if(Enviar == "desligar")
  {
   digitalWrite(cooler,HIGH); // Desliga o cooler 
   client.publish("dev/test/minhacasa/ha/cooler_ha/status", "desligado");
   Serial.println("Desligando o cooler");
  }

  if(Enviar == "ligar2")
  {
   digitalWrite(raspberry,LOW); // Liga o cooler 
   client.publish("dev/test/minhacasa/ha/cooler_ha/status", "ligado2");
   Serial.println("Ligando o raspberry");
  }
  if(Enviar == "desligar2")
  {
   digitalWrite(raspberry,HIGH); // Desliga o cooler 
   client.publish("dev/test/minhacasa/ha/cooler_ha/status", "desligado2");
   Serial.println("Desligando o raspberry");
  }
  
  Enviar = "";

} //fecha recebe mensagem
 
 
void setup()
{
  dht.setup(14, DHTesp::DHT11); // D5
  pinMode(led,OUTPUT);
  digitalWrite(led,LOW);
  Serial.begin(115200);
  pinMode(cooler,OUTPUT);
  digitalWrite(cooler,HIGH); // Rele invertido, aciona com LOW
  pinMode(raspberry,OUTPUT);
  digitalWrite(raspberry,HIGH);//Inicia Desligado
  delay(200);
  ConectarWIFI();
  
  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta);
  client.setServer(servidor_mqtt, portaInt);
  client.setCallback(atualizar_mensagem);

  // Iniciar servidor atualizacao OTA
  atualizadorOTA_cooler_ha.setup(&servidorWeb_medidor_corrente_tensao);
  servidorWeb_medidor_corrente_tensao.begin();
  
}//Fecha void setup

//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  if (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("cooler_ha", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("cooler_ha");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
    }
  }
} 
void loop()
{
 contador++;
 //Serial.println(contador);
 if ( contador >=20000 ) // +/- 30 segundos 
 {
  digitalWrite(led,HIGH);
  // temperatura interna e umidade interna
  delay(dht.getMinimumSamplingPeriod());
  float uuii = dht.getHumidity();
  float tpii = dht.getTemperature();
  Mensagem_Enviar = tpii;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/minhacasa/ha/cooler_ha2/temp", Funcoes);
  delay(100);
  Mensagem_Enviar = uuii;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/minhacasa/ha/cooler_ha2/umidade", Funcoes);
  delay(1000);
  contador = 0;
  digitalWrite(led,LOW);
 } // Fecha contador
  
 if (!client.connected())
 {
  reconectar();
 }

 // VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 if(WiFi.status() != WL_CONNECTED) 
 {
  ConectarWIFI();
 }
 else
 {
  servidorWeb_medidor_corrente_tensao.handleClient();
 }

  client.loop();
}//Fecha void loop
