/*
 * 
 * CONEXÃO DO ARDUINO ( NAO ESP8266 NODEMCU ) NO MQTT
 * 
 * 
 * 
 */


#include <UIPEthernet.h>
#include "PubSubClient.h"

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };  
IPAddress ip(192, 168, 2, 125); // Define o IP do arduino CADA UM DEVE TER O SEU
byte gateway[] = { 192, 168, 2, 1 }; // IP do Modem Gatway padrao

// DADOS DO SERVIDOR DO MQTT
#define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
#define servidor_mqtt_porta       "10671"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "qjuidpsd"  //UsuÃ¡rio
#define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
#define mqtt_topico_sub           "dev/test/garagem/externa"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/garagem/externa/placa_automacao" 


EthernetClient ArduinoMQTT; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(ArduinoMQTT); // Nome de cada Servidor UNICO para cada Arduino


void setup()
{  
 Serial.begin(9600);
 Ethernet.begin(mac, ip); // Conecta através do mac e ip fixo
  
 //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
 Serial.println(Ethernet.localIP());
}


//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 Serial.print("Chegou do MQTT: ");
 Serial.println(strMensagem);
}

void loop() 
{
 if (!client.connected()) {reconectar();} // Caso perca a conexão entra em loop para reconectar ao MQTT
 client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT
 
}




//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    Serial.println("Tentando conectar ao servidor MQTT...");
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("ArduinoMQTT", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("ArduinoMQTT");

    if(conectado) {
      Serial.println("Conectado!");
      //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Falhou ao tentar conectar. Codigo: ");
      Serial.println(String(client.state()).c_str());
      Serial.println(" tentando novamente em 5 segundos");
      //Aguarda 5 segundos para tentar novamente
      delay(5000);
    }
  }
}
