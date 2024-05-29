/*
*/
#include <ESP8266WiFi.h>
#include <PubSubClient.h>

#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>
#define saida 12 //D6

const char *Usuario     = "Casa_Bruno2";
const char *Senha = "casabruno2@@";

String local = "arvore_natal"; // aqui é o local onde sera publicado
String condicao = ""; // aqui sera salvo ou AC para alimentado por rede eletrica ou BAT sendo alimentado por bateria


// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/arvore"    //  PARA TROCAR SELECIONAR "arvore_natal" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx
#define TOPICO_PUBLISH   "dev/test/minhacasa/status_arvore"

String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];


IPAddress staticIP(192, 168, 80, 202);
IPAddress gateway(192, 168, 80, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient arvore_natal2;                                 //Instância do WiFiClient
PubSubClient client(arvore_natal2);                       //Passando a instância do WiFiClient para a instância do PubSubClient


ESP8266HTTPUpdateServer atualizadorOTA_arvore_natal; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_arvore_natal(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Arvore de Natal";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";



bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;


void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  Serial.println("entrou");
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
    digitalWrite(saida,LOW);
    client.publish("dev/test/minhacasa/status_arvore", "ligada");
  }
  if(Enviar == "desligar")
  {
    digitalWrite(saida,HIGH);
    client.publish("dev/test/minhacasa/status_arvore", "desligada");
  }

} //fecha recebe mensagem


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("arvore_natal2", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("arvore_natal2");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
      

    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      delay(200);
    }
  }
}

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

  
  servidorWeb_arvore_natal.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_arvore_natal.send(200, "text/html", paginaWeb);}




void setup()
{
  Serial.begin(115200);

  pinMode(saida, OUTPUT);
  
  ConectarWIFI();
 
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
 digitalWrite(saida,HIGH);
 client.publish("dev/test/minhacasa/status_arvore", "desligada");
 Serial.println("Rodou");
 // Iniciar servidor atualizacao OTA
 atualizadorOTA_arvore_natal.setup(&servidorWeb_arvore_natal);
 servidorWeb_arvore_natal.begin();
}

void loop()
{
 client.loop(); // Loop para mqtt rodar
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
  servidorWeb_arvore_natal.handleClient();
 }
 
}
