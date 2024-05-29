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
/*
const char* ssid     = "Bruno";
const char* password = "bruno268300";
float sensor1 = 1.0;
const char* host = "192.168.2.240";
*/

const char* ssid     = "GAGF";
const char* password = "logistica2019@";
float sensor1 = 1.0;
const char* host = "10.10.25.229";

const int port = 80;
String topiico;

IPAddress ip(10, 10, 25, 85); // IP do dispositivo STATIC
IPAddress gateway(10, 10, 25, 1); //Gateway Padrao da rede
IPAddress subnet(255, 255, 255, 0); //Máscara de Sub-Rede

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
/*
#define servidor_mqtt             "192.168.2.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "brunogon"  // Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "gerdau/cancela/condicao/+"    
*/

#define servidor_mqtt             "10.10.25.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "logistica"  // Usuario
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/cancela/condicao/+"    


WiFiClient recebe_mqtt_salva_mysql_php;                                 //Instância do WiFiClient
PubSubClient client(recebe_mqtt_salva_mysql_php);                       //Passando a instância do WiFiClient para a instância do PubSubClient


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
 String url = "/nodemcu/inserir_banco.php?";
        url += "cod=";
        url += topiico.substring(barra+1, tam);
        url += "&mensagem=";
        url += strMensagem;
 
 // Serial.println(url);
 cliente.print(String("GET ")+ url+ " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");

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
                     client.connect("recebe_mqtt_salva_mysql_php", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("recebe_mqtt_salva_mysql_php");

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
