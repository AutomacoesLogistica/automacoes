/*
 * 
 * 
 * RECEBE OS DADOS DO MQTT E SALVA NA PLANILHA DA CANCELA DE CONDICAO DAS MESMAS EM CAMPO
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


IPAddress ip(10, 10, 25, 87); // IP do dispositivo STATIC
IPAddress gateway(10, 10, 25, 1); //Gateway Padrao da rede
IPAddress subnet(255, 255, 255, 0); //Máscara de Sub-Rede

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "10.10.25.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "logistica"  // Usuario
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/"    

WiFiClient precessador_mqtt_php;                                 //Instância do WiFiClient
PubSubClient client(precessador_mqtt_php);                       //Passando a instância do WiFiClient para a instância do PubSubClient





void atualizar_mensagem(char* topico, byte* msg, unsigned int tamanho) 
{
 digitalWrite(Led_Mqtt,LOW);
 msg[tamanho] = '\0';
 String strMensagem = String((char*)msg);
 strMensagem.toLowerCase();
 Serial.println(strMensagem);
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

  /* Explicitly set the ESP8266 to be a WiFi-client, otherwise, it by default,
     would try to act as both a client and an access-point and could cause
     network-issues with your other WiFi-devices on your WiFi-network. */
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
                     client.connect("precessador_mqtt_php", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("precessador_mqtt_php");

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


  // Use WiFiClient class to create TCP connections
  WiFiClient cliente;
  if (!cliente.connect(host, port)) {
    Serial.println("Falha na conexao");
    delay(500);
    return;
  }

  String url = "/nodemcu/salvar.php?";
         url += "sensor1=";
         url += ("1");

  cliente.print(String("GET ")+ url+ " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");

  // Tempo de aguardo para recepção de mensagens
  unsigned long timeout = millis();
  while (cliente.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      cliente.stop();
      delay(5000);
      return;
    }
  }
   String line;
  // Read all the lines of the reply from server and print them to Serial
  //Serial.println("Mensagem recebida do servidor");
  // not testing 'client.connected()' since we do not need to send data here
  while (cliente.available()) {
    line = cliente.readStringUntil('\r');
    //Serial.print(line);
  }
  if(line.indexOf("mensagem:")!= -1){
    int tamanho = line.length();
    int posicao_a = 0;
    String c = "";
    for (int x = 0; x<tamanho;x++)
    {
      c = line.substring(x,x+1);
      if (c == ",")
      {
        posicao_a = x;
      }
    }
    
    String topico = line.substring(10,posicao_a);
    String mensagem = line.substring(posicao_a + 1,tamanho-1);
    Serial.print("Topico: ");
    Serial.println(topico);
    Serial.print("Mensagem: ");
    Serial.println(mensagem);

    digitalWrite(Led_Mqtt,LOW);
    char Funcoes_topico[100];
    char Funcoes[30];
    mensagem.toCharArray(Funcoes, mensagem.length()+1); 
    topico.toCharArray(Funcoes_topico, topico.length()+1);
    client.publish(Funcoes_topico, Funcoes); // Publica a umidade
    delay(200);
    digitalWrite(Led_Mqtt,HIGH);

    
  }else if (line.indexOf("sem_solicitacoes")){
    Serial.println("Banco Vazio!");
  }else{
    Serial.println("Erro ao salvar");
  }
 

  //delay(500); // Espera 10 segundos

client.loop();
}
