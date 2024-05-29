
String readString;

#include <PubSubClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)

const char *Usuario     = "AutomacaoLOG";
const char *Senha = "logistica2019@";
String local = "testes2"; // aqui é o local onde sera publicado

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/testes2"    //  PARA TROCAR SELECIONAR "arvore_natal" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx


String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];

IPAddress staticIP(192, 168, 20, 18);
IPAddress gateway(192, 168, 3, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient testes2;                                 //Instância do WiFiClient
PubSubClient client(testes2);  

bool primeira_mensagem = 0;

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
 
  if (primeira_mensagem == 1)
  {
   readString = Enviar;
   readString.trim();
   Serial.println(readString);
  } // Fecha primeira_mensagem = 1
  if (primeira_mensagem == 0)
  {
   primeira_mensagem = 1;
  }
  
  
  
 
  
} //fecha recebe mensagem


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("testes2", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("testes2");

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
 while (WiFi.status() != WL_CONNECTED)
 {
  delay(500);
  Serial.print(".");
 }
 Serial.println("Conectado");
 
}// Fecha void ConectarWIFI




void setup()
{
  Serial.begin(115200); //INICIALIZA A PORTA SERIAL

  ConectarWIFI();
   
  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta);
  client.setServer(servidor_mqtt, portaInt);
  client.setCallback(atualizar_mensagem);
}


void loop()
{
 if (!client.connected())
 {
  reconectar(); // Para MQTT
 }

 // VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 if(WiFi.status() != WL_CONNECTED) 
 {
  ConectarWIFI();
 }
 client.loop(); // Loop para mqtt rodar

} // Fecha Loop
