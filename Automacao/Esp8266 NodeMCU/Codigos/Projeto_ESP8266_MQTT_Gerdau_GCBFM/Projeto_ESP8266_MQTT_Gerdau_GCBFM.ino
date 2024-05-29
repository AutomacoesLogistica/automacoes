/*
 * 
 * Equivalencia das saidas Digitais entre NodeMCU e ESP8266 (na IDE do Arduino)
NodeMCU - ESP8266
D0 = 16;
D1 = 5;
D2 = 4;
D3 = 0;
D4 = 2;
D5 = 14;
D6 = 12;
D7 = 13;
D8 = 15;
D9 = 3;
D10 = 1;
 * 
 * 
 */
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
 
const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";

#define LedStatus 16 // Led status mensagem recebida

String carregadeira = "pc01";

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "138.0.77.81"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "logistica"  //UsuÃ¡rio
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub1           "gerdau/banheiros"


IPAddress staticIP(10,10,25,90);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
WiFiClient ESP_Central_Supervisorio;                                 //Instância do WiFiClient
PubSubClient client(ESP_Central_Supervisorio);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;
char Funcoes[30];
char Funcoes_topico[60];
String Mensagem_Enviar;
String topico;
int tamanho = 0;
int a,b;
char d,e;
String ID_Tablet = "";
String msg = "";
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 5000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;


void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
  
 mensagem[tamanho] ='\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 //Serial.print("Chegou do MQTT: ");
 String Enviar;
 
 digitalWrite(LedStatus,HIGH);
 delay(200);
 digitalWrite(LedStatus,LOW);

 Enviar = strMensagem;
// Serial.print("Topico : ");
 //Serial.print(topico);

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
      client.subscribe(mqtt_topico_sub1, 1); //QoS 1
  
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
  
  while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   readString += c;
   tamanho++; 
   if ( c == ','){a = tamanho;d = c;}
   if ( c == ';'){b = tamanho;e = c;}
   
  }
 tamanho = 0;
 
  // Se existir dados na serial **********************************************************************************************************************************************************
  if (readString.length() >0 && d == ',' && e == ';' ) 
  {
    readString.toLowerCase();
    
     digitalWrite(LedStatus,HIGH);
     // protocolo      ok,01;
     msg = readString.substring(0,a-1);
     ID_Tablet = readString.substring(a,b-1);
     String Mensagem_Enviar;
     
     String topico;
     //umidade = String(humidity,1) + " %";
     Mensagem_Enviar = msg; 
     Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
     topico = "gerdau/status/banheiros/"+String(ID_Tablet);
     topico.toCharArray(Funcoes_topico, topico.length()+1);
     client.publish(Funcoes_topico, Funcoes); // Publica a umidade
     delay(200);
     digitalWrite(LedStatus,LOW);  
   
  } // Fecha se existe dados na serial
 
 d = 'a'; // Para limpar os dados
 e = 'a'; // Para limpar os dados
 readString ="";
 
   if (!client.connected()) 
  {
   reconectar();
  }
  
  client.loop();
}