/*

   CONEXÃO DO ESP8266 NODEMCU NO MQTT

   MODULO DO GUINCHO IP 192.168.2.209

   Conexão do modulo RS485
   RO = Pino D1
   DI = Pino D2
   DE = Pino D3
   RE = Pino D3

   Lampada Status  Pino D0

   Conexão Enc28j60
   SCK = Pino D5
    SO = Pino D6
    ST = Pino D7
    CS = Pino D8 porem passando pelos mosfets canal N
   RST = Reset
   VCC = 5V
   GND = GND

  CONEXOES DO ENCODER KY-040   
   
  +   -> 5V do Esp
  GND -> GND do Esp
  DT  -> GPIO09 - SD2
  CLK -> GPIO10 - SD3


  Lista de IPS do Sistema de Automação ************************************************************************************

  192.168.2.199 Central 1 Andar
  192.168.2.200 Central 3 Andar
  192.168.2.201 Supervisório
  192.168.2.202 Sala / Varanda / Acesso
  192.168.2.203 Quarto 1
  192.168.2.204 Quarto 2
  192.168.2.205 Cozinha / Banheiro Social / Corredor
  192.168.2.206 Quarto Casal / Closet / Banheiro
  192.168.2.207 Area Gourmet / Serviço
  192.168.2.208 Laboratorio
  192.168.2.209 Guincho

  ***************************************************************************************************************************

*/


#include <UIPEthernet.h>
#include "PubSubClient.h"
#include<SoftwareSerial.h>
#include <ArduinoOTA.h>
#include <Encoder.h>
Encoder myEnc(5, 6); //CLK , DT
long oldPosition  = -999;
int pulsosVol = 2; // inicia com pouco
int valorLidoAtual = 0;
int valorLidoAnteriormente = 0;
String readString;


int frequencia = 38; //FREQUÊNCIA DO SINAL IR(32KHz)

long UltimoMillis = 0;        // Variável de controle do tempo PADRAO PARA TODOS
unsigned long AtualMillis;

#define transmitir 0 // Pino DE e RE - Transmissao     PINO D3
#define pinRX 5 // Pino RO                             PINO D1
#define pinTX 4 // Pino DI                             PINO D2
SoftwareSerial RS485(pinRX, pinTX);

#define LedStatus 16 // LedStatus                      PINO D0
//209
#define MACADDRESS 0x00,0x01,0x02,0x03,0x04,0xD1
#define MYIPADDR 192,168,2,209
#define MYIPMASK 255,255,255,0
#define MYDNS 192,168,2,1
#define MYGW 192,168,2,1

// Dados para criar a conexão *******************************************************************************************************************************
uint8_t mac[6] = {MACADDRESS};
uint8_t myIP[4] = {MYIPADDR};
uint8_t myMASK[4] = {MYIPMASK};
uint8_t myDNS[4] = {MYDNS};
uint8_t myGW[4] = {MYGW};
//***********************************************************************************************************************************************************

String ValorIP = "192.168.2.209"; // Colocar o mesmo que ip, este serve para impressao via mqtt
String id = "guincho"; // SEMPRE em minusculo
bool conectado; // Variavel para armazenar se está conectado
String MensagemParaImprimir; // Usado para enviar os dados recebidos pelo MQTT para os modulos via RS485
bool primeira_mensagem = 0;

/*
  // DADOS DO SERVIDOR DO CLOUD MQTT
  #define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
  #define servidor_mqtt_porta       "10671"  //Porta do servidor MQTT
  #define servidor_mqtt_usuario     "qjuidpsd"  //Usuario
  #define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
  #define mqtt_topico_sub           "dev/test/minhacasa/sala" // Tópico do quarto1
  #define TOPICO_PUBLISH   "dev/test/minhacasa" // Tópico da central
*/


// DADOS DO SERVIDOR DO RASPBERRY MOSQUITO
#define servidor_mqtt             "192.168.2.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor MQTT
#define servidor_mqtt_usuario     "brunogon"  //Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/guincho" // Tópico do quarto1
#define TOPICO_PUBLISH   "dev/test/minhacasa" // Tópico da central

EthernetClient Esp8266_MQTT_guincho; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(Esp8266_MQTT_guincho); // Nome de cada Servidor UNICO para cada Arduino
char MensagemRecebida[30]; // Usado para criar a string de envio dos dados recebidos pelo MQTT


//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
  digitalWrite(LedStatus, LOW); //
  delay(200);
  digitalWrite(LedStatus, HIGH); //
  if (strMensagem == id )
  {
    String DadosDaMensagemRecebida = String(id) + String(" = ") + String(ValorIP);
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    client.publish("dev/test/minhacasa/guincho", MensagemRecebida);
    delay(250);
  }
  else
  {
     if (primeira_mensagem == 1)
    {
      MensagemParaImprimir = strMensagem;
      readString = strMensagem;
      imprimir(); //Chama o void para imprimir
    }
    if (primeira_mensagem == 0)
    {
      primeira_mensagem = 1;
    }
  }
}// Fecha o void atualizar_mensagem

void imprimir()
{
  digitalWrite(transmitir, HIGH);    //Habilita a transmissão
  String DadosDaMensagemRecebida = String(MensagemParaImprimir);
  DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
  RS485.write(MensagemRecebida);
  Serial.println(MensagemRecebida);
  digitalWrite(transmitir, LOW);     //Desabilita a transmissão e volta a receber dados


}

//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected())
  {
    conectado = strlen(servidor_mqtt_usuario) > 0 ?
                client.connect("Esp8266_MQTT_guincho", servidor_mqtt_usuario, servidor_mqtt_senha) :
                client.connect("Esp8266_MQTT_guincho");
    if (conectado)
    {
      digitalWrite(LedStatus, HIGH); // Ligado caso conecte no MQTT
      Serial.println("Conectado!");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1 Subscreve para monitorar os comandos recebidos
      primeira_mensagem = 0;readString == "";
    }
    else
    {
      Serial.println("Tentando Reconectar!");
      digitalWrite(LedStatus, LOW); // Mantem apagado caso nao realize conexao
      delay(2000);
    }
  }
}






void setup()
{
  Serial.begin(4800);
  Ethernet.begin(mac, myIP, myDNS, myGW, myMASK);
  RS485.begin(4800);
  
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW);
  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
  pinMode(LedStatus, OUTPUT); // Define LedMensagem como saida
  digitalWrite(LedStatus, LOW); // Inicia apagagado

  ArduinoOTA.setHostname("guincho"); // nome que ira aparecer na rede
  // No authentication by default
  ArduinoOTA.setPassword((const char *)"guincho_268300"); // Senha para permitir atualização

  ArduinoOTA.onStart([]() {
    Serial.println("Inicio...");
  });
  ArduinoOTA.onEnd([]() {
    Serial.println("nFim!");
  });
  ArduinoOTA.onProgress([](unsigned int progress, unsigned int total) {
    Serial.printf("Progresso: %u%%r", (progress / (total / 100)));
  });
  ArduinoOTA.onError([](ota_error_t error) {
    Serial.printf("Erro [%u]: ", error);
    if (error == OTA_AUTH_ERROR) Serial.println("Autenticacao Falhou");
    else if (error == OTA_BEGIN_ERROR) Serial.println("Falha no Inicio");
    else if (error == OTA_CONNECT_ERROR) Serial.println("Falha na Conexao");
    else if (error == OTA_RECEIVE_ERROR) Serial.println("Falha na Recepcao");
    else if (error == OTA_END_ERROR) Serial.println("Falha no Fim");
  });
  ArduinoOTA.begin();


}// Fecha o void setup


void loop()
{
  ArduinoOTA.handle();
  while (RS485.available())
  {
    delay(3);
    char c = RS485.read();
    readString += c;
  }

  if (readString.length() > 0 && primeira_mensagem == 1)
  {
    readString.trim(); // Não retirar esta parte, pois ela retira espaços providos a ruidos gerados
    String DadosDaMensagemRecebida = {String(readString)};
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    client.publish("dev/test/minhacasa", MensagemRecebida);

    //  AQUI FAZ AS FUNÇÕES
    
    
    // PISCA O LED DUAS VEZES CASO CHEGUE MENSAGEM PELA REDE RS485 **********************************************************************************
    digitalWrite(LedStatus, LOW); // Apaga o LED
    delay(150);
    digitalWrite(LedStatus, HIGH); // Liga o LED
    delay(150);
    digitalWrite(LedStatus, LOW); // Apaga o LED
    delay(150);
    digitalWrite(LedStatus, HIGH); // Liga o LED
    // **********************************************************************************************************************************************

    readString = "";
  } // Fecha se existe dados na serial


long newPosition = myEnc.read();
if (newPosition != oldPosition) 
{
 oldPosition = newPosition;
  //Serial.println(newPosition);
  //Serial.print("  -  ");
 valorLidoAtual = newPosition;
 if (valorLidoAtual>(valorLidoAnteriormente+3)) //Aumenta pulsos
 {
  valorLidoAnteriormente = valorLidoAtual;  
  // Serial.println("Aumentou");
    
 }
 if (valorLidoAtual<(valorLidoAnteriormente-3)) // Diminui volume
 {
  valorLidoAnteriormente = valorLidoAtual;
  //Serial.println("Diminuiu");
 }

 // Monitora os pulsos



 
} // Fecha análise de pulsos


if (!client.connected())
  {
    reconectar(); // Caso perca a conexão entra em loop para reconectar ao MQTT
  }
  client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT
}
