/*

   CONEXÃO DO ARDUINO ( NAO ESP8266 NODEMCU ) NO MQTT

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

  192.168.3.200 Supervisório
  192.168.3.201 Tela Sala
  192.168.3.202 Sala / Varanda
  192.168.3.203 Quarto 1
  192.168.3.204 Quarto 2
  192.168.3.205 Cozinha
  192.168.3.206 Banheiro Social
  192.168.3.207 Cozinha / Corredor
  192.168.3.208 Quarto Casal / Banheiro
  192.168.2.209 Area Gourmet / Serviço

  Lampada conexao
  Pino 2
*/


#include <UIPEthernet.h>
#include "PubSubClient.h"
#include<SoftwareSerial.h>

// Pinos para criação da SoftwareSerial
#define pinTX 9  // Conecta no pino DI do modulo RS485
#define pinRX 8  // Conecta no pino RO do modulo RS485
#define transmitir 7  // Pino para definir se envia ou recebe o modulo - Conecta aos pinos DE e RE do modulo RS485

SoftwareSerial RS485(pinRX, pinTX);  // Pinos da conexão para a serial virtual

byte ip[] = { 192, 168, 3, 202 }; // Define o IP do arduino CADA UM DEVE TER O SEU
String ValorIP = "192.168.3.202"; // Colocar o mesmo que ip, este serve para impressao via mqtt
String id = "sala"; // SEMPRE em minusculo
bool conectado; // Variavel para armazenar se está conectado
String MensagemParaImprimir; // Usado para enviar os dados recebidos pelo MQTT para os modulos via RS485


// DADOS DO SERVIDOR DO MQTT RASPBERRY
#define servidor_mqtt             "192.168.3.186"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor MQTT
#define servidor_mqtt_usuario     "brunogon"  //Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/sala"
#define TOPICO_PUBLISH   "dev/test/automacoes/interruptores/sala"


EthernetClient ArduinoMQTT_Sala; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(ArduinoMQTT_Sala); // Nome de cada Servidor UNICO para cada Arduino
String readString; // Variavel pra concatenar dados da serial
char MensagemRecebida[30]; // Usado para criar a string de envio dos dados recebidos pelo MQTT

void setup()
{
  RS485.begin(9600);
  Serial.begin(9600);
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW);
  Conectar_rede();
  pinMode(2, OUTPUT); // Define o pino 2 como saida
  digitalWrite(2, 0); // Inicia desligado
  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
  //Serial.println(Ethernet.localIP());
}

void Conectar_rede()
{
   Ethernet.begin(ip); // Conecta através do ip fixo
 
}
//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
  //Serial.print("Chegou do MQTT: ");
  if (strMensagem == id )
  {
    String DadosDaMensagemRecebida = String(id) + String(" = ") + String(ValorIP);
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    client.publish(mqtt_topico_sub, MensagemRecebida);
    delay(100);
  }
  else
  {
   MensagemParaImprimir = strMensagem;
   imprimir(); //Chama o void para imprimir
  }

  digitalWrite(2, 0);
  delay(250);
  digitalWrite(2, 1);

}

void loop()
{
  while (RS485.available())
  {
    delay(3);
    char c = RS485.read();
    readString += c;
  }

  if (readString.length() > 0)
  {
    //Serial.print("Recebido : ");
    //Serial.println(readString);
    String DadosDaMensagemRecebida = {String(readString)};
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    //Serial.print("Tratado : ");
    //Serial.println(MensagemRecebida);
    client.publish(TOPICO_PUBLISH, MensagemRecebida);
    /*
    digitalWrite(2, 0);
    delay(150);
    digitalWrite(2, 1);
    delay(150);
    digitalWrite(2, 0);
    delay(150);
    digitalWrite(2, 1);
    */
    readString = "";
  }



  if (!client.connected())
  {
   Conectar_rede();
    reconectar(); // Caso perca a conexão entra em loop para reconectar ao MQTT
  
  }
    // VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 

  client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT
}


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected())
  {
    conectado = strlen(servidor_mqtt_usuario) > 0 ?
                client.connect("ArduinoMQTT_Sala", servidor_mqtt_usuario, servidor_mqtt_senha) :
                client.connect("ArduinoMQTT_Sala");
    if (conectado)
    {
      digitalWrite(2, 1);
      client.subscribe(mqtt_topico_sub, 1); //QoS 1 Subscreve para monitorar os comandos recebidos
    }
    else
    {
      digitalWrite(2, 0);
      delay(2000);
    }
  }
}

void imprimir()
{
  digitalWrite(transmitir, HIGH);    //Habilita a transmissão
  String DadosDaMensagemRecebida = String(MensagemParaImprimir);
  DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
  RS485.write(MensagemRecebida);
  Serial.println(MensagemRecebida);
  digitalWrite(transmitir,LOW);      //Desabilita a transmissão e volta a receber dados
}
