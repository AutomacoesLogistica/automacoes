/*

CONEXÃO DO ESP8266 NODEMCU NO MQTT E REDE RS485 - ASSOCIADO AO PROMINI PARA LEITURA DOS RF E ACIONAMENTOS

   MODULO DO PORTAO ELETRONICO 1 ANDAR IP 192.168.2.196
   
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

   Data  = Pino SD2     9
   Clock = Pino SD3    10

  Lista de IPS
  192.168.2.199 Central Externa
  192.168.2.200 Raspberry
  192.168.2.201 Central 3 Andar
  192.168.2.202 Sala / Varanda
  192.168.2.203 Quarto 1
  192.168.2.204 Quarto 2
  192.168.2.205 Cozinha
  192.168.2.206 Banheiro Social
  192.168.2.207 Cozinha / Corredor
  192.168.2.208 Quarto Casal / Banheiro
  192.168.2.209 Area Gourmet / Serviço
  
  192.168.2.196 Portao Eletronico

 */


#include <UIPEthernet.h>
#include "PubSubClient.h"
#include <SoftwareSerial.h>
#define transmitir 0 // Pino DE e RE - Transmissao     PINO D3
#define pinRX 5 // Pino RO                             PINO D1
#define pinTX 4 // Pino DI                             PINO D2
SoftwareSerial RS485(pinRX, pinTX);
#define LedStatus 16 // LedStatus                      PINO D0

#define MACADDRESS 0x00,0x01,0x02,0x03,0x04,0x01
#define MYIPADDR 192,168,2,196
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

//byte ip[] = { 192, 168, 2, 201 }; // Define o IP do arduino CADA UM DEVE TER O SEU
String ValorIP = "192.168.2.196"; // Colocar o mesmo que ip, este serve para impressao via mqtt
String id = "portao_eletronico"; // SEMPRE em minusculo
bool conectado; // Variavel para armazenar se está conectado
String MensagemParaImprimir; // Usado para enviar os dados recebidos pelo MQTT para os modulos via RS485
bool primeira_mensagem = 0;


String readString; // Variavel pra concatenar dados da serial
char c;

// DADOS DO SERVIDOR DO MQTT RASPBERRY
#define servidor_mqtt             "192.168.2.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor MQTT
#define servidor_mqtt_usuario     "brunogon"  //Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/portao_eletronico"
#define TOPICO_PUBLISH   "dev/test/minhacasa/supervisorio" // Isso ira mudar de acordo com o ponto que a central ira enviar algum comando

EthernetClient PortaoEletronico; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(PortaoEletronico); // Nome de cada Servidor UNICO para cada Arduino

char MensagemRecebida[30]; // Usado para criar a string de envio dos dados recebidos pelo MQTT

void imprimir()
{
 digitalWrite(LedStatus, HIGH);
 digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
 RS485.print(readString);
 digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
 delay(100);
 digitalWrite(LedStatus, LOW);
 readString = ""; // Limpa a mensagem
} // Fecha void imprimir


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected())
  {
    conectado = strlen(servidor_mqtt_usuario) > 0 ?
                client.connect("PortaoEletronico", servidor_mqtt_usuario, servidor_mqtt_senha) :
                client.connect("PortaoEletronico");
    if (conectado)
    {
     client.subscribe(mqtt_topico_sub, 1); //QoS 1 Subscreve para monitorar os comandos recebidos
     //Serial.println("Conectado!");
     digitalWrite(LedStatus, LOW); // Ligado caso conecte no MQTT
    }
    else
    {
     //Serial.println("Tentando Reconectar!");
     digitalWrite(LedStatus, HIGH); // Mantem apagado caso nao realize conexao
     delay(2000);
    }
  }
}

//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
   digitalWrite(LedStatus, HIGH); // 
   delay(200);
    digitalWrite(LedStatus, LOW); // 
  if (strMensagem == id )
  {
    String DadosDaMensagemRecebida = String(id) + String(" = ") + String(ValorIP);
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    client.publish("dev/test/garagem/externa/central", MensagemRecebida);
    delay(100);
  }
  else
  {
   MensagemParaImprimir = strMensagem;
   readString = strMensagem;
   if (primeira_mensagem == 1)
   {
    
    imprimir(); //Chama o void para imprimir
   }
   if (primeira_mensagem == 0)
   {
    primeira_mensagem = 1;
   }
  }
} // Fecha o void atualizar_mensagem


void setup()
{
  Ethernet.begin(mac,myIP,myDNS,myGW,myMASK);
  RS485.begin(9600);
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW);

  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
  pinMode(LedStatus, OUTPUT); // Define LedMensagem como saida
  digitalWrite(LedStatus, HIGH); // Inicia apagagado

} // Fecha o void setup



void loop()
{

  while (RS485.available())
 {
  delay(3);
  char c = RS485.read();
  readString += c;
 }

 // Se receber mensagem 
 if (readString.length() > 0)
 {
  
  if ( readString.indexOf("giteto1_1") >= 0 )
  {
   client.publish("dev/test/minhacasa/supervisorio", "gi_teto1_1");
   delay(100);
  }
  if ( readString.indexOf("giteto1_0") >= 0 )
  {
   client.publish("dev/test/minhacasa/supervisorio", "gi_teto1_0");
   delay(100);
  }
  if ( readString.indexOf("giteto2_1") >= 0 )
  {
   client.publish("dev/test/minhacasa/supervisorio", "gi_teto2_1");
   delay(100);
  }
  if ( readString.indexOf("giteto2_0") >= 0 )
  {
   client.publish("dev/test/minhacasa/supervisorio", "gi_teto2_0");
   delay(100);
  }



  
  if ( readString.indexOf("portaog_f") >= 0 )
  {
   client.publish("dev/test/minhacasa/acesso/garagem1/state", "Fechado!");
   delay(100);
  }
  if ( readString.indexOf("portaog_a") >= 0 )
  {
   client.publish("dev/test/minhacasa/acesso/garagem1/state", "Aberto!");
   delay(100);
  }



  



 
  readString = ""; // Limpa as mensagens
  
 } // Fecha se existe mensagem na modbus
  

  
  
  if (!client.connected())
  {
    reconectar(); // Caso perca a conexão entra em loop para reconectar ao MQTT
  }
  client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT

}
