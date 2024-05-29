/*

   CONEXÃO DO ARDUINO ( NAO ESP8266 NODEMCU ) NO MQTT

   MODULO DA SALA IP 192.168.2.202
   
   Conexão do modulo RS485
   RO = Pino 8
   DI = Pino 9
   DE = Pino 7
   RE = Pino 7

   Conexão Enc28j60
   SCK = Pino 13
    SO = Pino 12
    ST = Pino 11
    CS = Pino 10
   RST = Reset
   VCC = 5V
   GND = GND
    
  Lista de IPS

  192.168.2.201 Supervisório
  192.168.2.202 Sala / Varanda
  192.168.2.203 Quarto 1
  192.168.2.204 Quarto 2
  192.168.2.205 Cozinha
  192.168.2.206 Banheiro Social
  192.168.2.207 Cozinha / Corredor
  192.168.2.208 Quarto Casal / Banheiro
  192.168.2.209 Area Gourmet / Serviço

  Lampada conexao
  Pino 2
*/


#include <UIPEthernet.h>
#include "PubSubClient.h"
/*

// Pinos para criação da SoftwareSerial
#define pinTX 9  // Conecta no pino DI do modulo RS485
#define pinRX 8  // Conecta no pino RO do modulo RS485
#define transmitir 7  // Pino para definir se envia ou recebe o modulo - Conecta aos pinos DE e RE do modulo RS485

SoftwareSerial RS485(pinRX, pinTX);  // Pinos da conexão para a serial virtual
*/

byte ip[] = { 192, 168, 2, 202 }; // Define o IP do arduino CADA UM DEVE TER O SEU
String ValorIP = "192.168.2.202"; // Colocar o mesmo que ip, este serve para impressao via mqtt
String id = "sala"; // SEMPRE em minusculo
bool conectado; // Variavel para armazenar se está conectado
String MensagemParaImprimir; // Usado para enviar os dados recebidos pelo MQTT para os modulos via RS485


// DADOS DO SERVIDOR DO MQTT
#define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
#define servidor_mqtt_porta       "10671"  //Porta do servidor MQTT
#define servidor_mqtt_usuario     "qjuidpsd"  //Usuario
#define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/sala"
#define TOPICO_PUBLISH   "dev/test/minhacasa"


EthernetClient ArduinoMQTT_sala; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(ArduinoMQTT_sala); // Nome de cada Servidor UNICO para cada Arduino
String readString; // Variavel pra concatenar dados da serial
char MensagemRecebida[30]; // Usado para criar a string de envio dos dados recebidos pelo MQTT














//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected())
  {
    conectado = strlen(servidor_mqtt_usuario) > 0 ?
                client.connect("ArduinoMQTT_sala", servidor_mqtt_usuario, servidor_mqtt_senha) :
                client.connect("ArduinoMQTT_sala");
    if (conectado)
    {
     client.subscribe(mqtt_topico_sub, 1); //QoS 1 Subscreve para monitorar os comandos recebidos
     Serial.println("Conectado!");
    }
    else
    {
     Serial.println("Tentando Reconectar!");
     delay(2000);
    }
  }
}

void imprimir()
{
  String DadosDaMensagemRecebida = String(MensagemParaImprimir);
  DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
  Serial.println(MensagemRecebida);
  
}

//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
  Serial.print("Chegou do MQTT: ");
  if (strMensagem == id )
  {
    String DadosDaMensagemRecebida = String(id) + String(" = ") + String(ValorIP);
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    client.publish("dev/test/minhacasa", MensagemRecebida);
    delay(100);
  }
  else
  {
   MensagemParaImprimir = strMensagem;
   imprimir(); //Chama o void para imprimir
  }

}



void setup()
{
  Serial.begin(9600);
  Ethernet.begin(ip); // Conecta através do ip fixo
  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
  Serial.println(Ethernet.localIP());
}


void loop()
{

  if (!client.connected())
  {
    reconectar(); // Caso perca a conexão entra em loop para reconectar ao MQTT
  }
  client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT
}


