#include <ESP8266WiFi.h>
#include <PubSubClient.h>
 
const char *Usuario     = "AutomacaoLogistica2.4Ghz";
const char *Senha = "logistica2019@";


// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "186.235.193.170"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/supervisorio"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/minhacasa/central" 


IPAddress staticIP(10,10,25,70);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
WiFiClient ESP_Central_Supervisorio;                                 //Instância do WiFiClient
PubSubClient client(ESP_Central_Supervisorio);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;
char Funcoes[50];
#define LedStatus 16


long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 5000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
int disjuntor = 0;

#define mqtt_topico_sub           "dev/test/minhacasa/supervisorio"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/minhacasa/central" 
//Função que será chamada ao receber mensagem do servidor MQTT

void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 //Serial.print("Chegou do MQTT: ");
 String Enviar;
 
 digitalWrite(LedStatus,HIGH);
 delay(500);
 digitalWrite(LedStatus,LOW);
  
 Enviar = "";
 Enviar = strMensagem += ",";
 Serial.println(Enviar);


} //fecha recebe mensagem


 
void setup()
{
 Serial.begin(115200);
 pinMode(LedStatus,OUTPUT);
 digitalWrite(LedStatus,LOW);
 WiFi.mode(WIFI_STA);
 WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara);  // (DNS not required)  
 while (WiFi.status() != WL_CONNECTED) 
 {
  delay(500);
  Serial.println("Connecting to WiFi..");
 }
 Serial.println("Connected to the WiFi network");
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
}







//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
     //Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("ESP_Central_Supervisorio", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("ESP_Central_Supervisorio");

    if(conectado) {
       Serial.println("Conectado_MQTT,");
       digitalWrite(LedStatus,LOW);
      //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
       //Serial.println("Falhou ao tentar conectar. Codigo: ");
       //Serial.println(String(client.state()).c_str());
       //Serial.println(" tentando novamente em 5 segundos");
      //Aguarda 5 segundos para tentar novamente
      digitalWrite(LedStatus,HIGH);
      delay(2000);
    }
  }
}





 
void loop() 
{
 
   if (!client.connected()) 
  {
   reconectar();
  }
  
  client.loop();
}
