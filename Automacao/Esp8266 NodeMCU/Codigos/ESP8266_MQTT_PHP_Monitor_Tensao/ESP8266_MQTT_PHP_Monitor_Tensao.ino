/*
 * ACESSA A PLANILHA POR PHP E PUBLICA OS DADOS CONTIDO NO BANCO NODEMCU NA TABELA TBL_DADOS E PUBLICA NO TOPICO REFERENTE AO QUE ESTA SALVO NA MESMA.
 * USADA PARA EFETUAR OS COMANDO NAS CANCELAS COMO POR EXEMPLO A ABERTURA DAS CANCELAS
 * 
 * 
 */
#include <ESP8266WiFi.h>
#include <PubSubClient.h>

#define Led_Wifi 10
#define Led_Mqtt 16

const char* ssid     = "GAGF";
const char* password = "logistica2019@";
float sensor1 = 1.0;
const char* host = "10.10.25.229";

const int port = 80;
String topiico;

IPAddress ip(10, 10, 25, 83); // IP do dispositivo STATIC
IPAddress gateway(10, 10, 25, 1); //Gateway Padrao da rede
IPAddress subnet(255, 255, 255, 0); //Máscara de Sub-Rede

// SERVIDOR RAPSBERRY MOSQUITTO
#define servidor_mqtt             "10.10.25.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "logistica"  // Usuario
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/monitor_tensao/+"    


WiFiClient recebe_mqtt_salva_monitor_tensao;                                 //Instância do WiFiClient
PubSubClient client(recebe_mqtt_salva_monitor_tensao);                       //Passando a instância do WiFiClient para a instância do PubSubClient


void atualizar_mensagem(char* topico, byte* msg, unsigned int tamanho) 
{
 digitalWrite(Led_Mqtt,LOW);
 msg[tamanho] = '\0';
 String strMensagem = String((char*)msg);
 //strMensagem.toLowerCase();
 int barra = 0;
 topiico = String(topico);

 int tam = topiico.length();
 //Serial.println("Tamanho = " + tam);
 for ( int x = 0;x< tam ;x++)
 {
  if ( topiico.substring(x,x+1) == "/")
  {
   barra = x; // salva a ultima barra encontrada
  }
 }
 //Serial.println("Barra = " + barra);
 //Serial.println("Topico = " + topiico);
 //Serial.println("Cod = " + topiico.substring(barra+1, tam));
 //Serial.println("Topico = " + String(topico));
 //Serial.println("Mensagem = " + strMensagem);
 
  WiFiClient cliente;
  if (!cliente.connect(host, port)) {
    Serial.println("Falha na conexao");
    delay(500);
    return;
  }
 String url = "/nodemcu/monitor_tensao.php?";
        url += "dispositivo=";
        url += topiico.substring(barra+1, tam);
        url += "&mensagem=";
        url += strMensagem;// AC ou BAT
 
 // Serial.println(url);
 cliente.print(String("GET ")+ url+ " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");
 Serial.println("http://"+String(host)+String(url));
 delay(200);
 digitalWrite(Led_Mqtt,HIGH);
 

} //fecha recebe mensagem ***************************************************************************************************************************************************************

void setup() {
  Serial.begin(115200);
  pinMode(Led_Wifi,OUTPUT);
  digitalWrite(Led_Wifi,LOW);
  pinMode(Led_Wifi,OUTPUT);
  digitalWrite(Led_Wifi,LOW);
  pinMode(Led_Mqtt,OUTPUT);
  digitalWrite(Led_Mqtt,LOW);
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

 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
}

//Função que reconecta ao servidor MQTT
void reconectar() {
  
  //Repete até conectar
  while (!client.connected()) {
    digitalWrite(Led_Mqtt,LOW);
     //Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("recebe_mqtt_salva_monitor_tensao", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("recebe_mqtt_salva_monitor_tensao");

    if(conectado) {
      digitalWrite(Led_Mqtt,HIGH);
       Serial.println("Conectado_MQTT,");
       //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
     } else {
       //Serial.println("Falhou ao tentar conectar. Codigo: ");
       //Serial.println(String(client.state()).c_str());
       Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      //Aguarda 5 segundos para tentar novamente
      digitalWrite(Led_Mqtt,LOW);
      delay(200);
    }
  }
}

void loop() {
  if (!client.connected()) 
{
 reconectar();
}


client.loop();
}
