#include <UIPEthernet.h>
#include "PubSubClient.h"


#define CLIENT_ID       "UnoMQTT"
#define INTERVAL        3000 // 3 sec delay between publishing
#define DHTPIN          3
#define DHTTYPE         DHT11

#define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
#define servidor_mqtt_porta       "10671"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "qjuidpsd"  //UsuÃ¡rio
#define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
#define mqtt_topico_sub           "dev/test/garagem/externa"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/garagem/externa/placa_automacao" 


bool statusKD=HIGH;//living room door
bool statusBD=HIGH;//front door
bool statusGD=HIGH;//garage door
int lichtstatus;
uint8_t mac[6] = {0x00,0x01,0x02,0x03,0x04,0x05};

EthernetClient ArduinoMQTT;
PubSubClient client(ArduinoMQTT);
   

long previousMillis;

void setup()
{
  // setup serial communication
  Serial.begin(57600);
   //setup ethernet communication using DHCP
  if(Ethernet.begin(mac) == 0)
  {
    Serial.println(F("Ethernet configuration using DHCP failed"));
    for(;;);
  }
  else
  {
    Serial.print("Conectado no ip: ");
    Serial.println(Ethernet.localIP());
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
