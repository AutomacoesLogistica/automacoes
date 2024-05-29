/*
 * 
 * CODIGO PARA ESP8266 NODEMCU - TRABALHA JUNTO COM O CODIGO RODANDO EM UM ARDUINO PRO MINI ATUALIZANDO DISPLAY E ENVIANDO OS DADOS VIA SERIAL
 * Codigo padrao para atualizar via ota - web service arquivo .bin
 * 
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 * 
 * 
 */



#include <PubSubClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>

int erro = 0;

//Tempo para publicação
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 1000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;

int mensagem_erro = 0;

const char *Usuario     = "AutomacaoLOG";
const char *Senha = "logistica2019@";
String local = "medidor_corrente_tensao"; // aqui é o local onde sera publicado

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/medidor_corrente_tensao/comando"    //  PARA TROCAR SELECIONAR "arvore_natal" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx


String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];

IPAddress staticIP(192, 168, 20, 173);
IPAddress gateway(192, 168, 20, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient medidor_corrente_tensao;                                 //Instância do WiFiClient
PubSubClient client(medidor_corrente_tensao);  

ESP8266HTTPUpdateServer atualizadorOTA_medidor_corrente_tensao; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_medidor_corrente_tensao(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Monitor de tensão e corrente";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";


String readString;

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
  // Serial.println(Enviar);
  if(Enviar == "erro")
  {
   mensagem_erro++;
   if (mensagem_erro >=5)
   { 
    client.publish("dev/test/minhacasa/cor_ten/comando2", "reiniciado");
    delay(1000);
    ESP.reset();
   }
  }
  
} //fecha recebe mensagem


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("medidor_corrente_tensao", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("medidor_corrente_tensao");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      
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

  
  servidorWeb_medidor_corrente_tensao.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_medidor_corrente_tensao.send(200, "text/html", paginaWeb);}



void setup()
{
 Serial.begin(115200);
 ConectarWIFI();
 
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);

 // Iniciar servidor atualizacao OTA
 atualizadorOTA_medidor_corrente_tensao.setup(&servidorWeb_medidor_corrente_tensao);
 servidorWeb_medidor_corrente_tensao.begin();
  
}//Fecha void setup



void Publica()
{
 int verifica = Mensagem_Enviar.length();
 if ( verifica >= 38)
 {
  erro = 0;
  Serial.println("OK!");
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/minhacasa/cor_ten", Funcoes);
 }
 else
 {
  erro++;
  Serial.println("Travado!");
  if( erro >=10 )
  {
   //reinicia o esp
   ESP.reset(); 
  }
 }
}

void loop() 
{

 if (!client.connected())
 {
  reconectar(); // Para MQTT
 }
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c;
 }
 AtualMillis = millis();    //Tempo atual em ms
 if (AtualMillis - UltimoMillis > intervalo) 
 { 
  UltimoMillis = AtualMillis;    // Salva o tempo atual
  Publica();
 }
 if (readString.length() >10)
 {
  Serial.println(readString);
  if (readString!="")
  {
   Mensagem_Enviar = readString;
   readString="";
  }
 }
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

 client.loop(); // Loop para mqtt rodar
}//Fecha Loop
