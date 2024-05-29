/*
   Codico para atualização da central em OTA

   >Atenção!
   A primeira vez deve carregar o código de preparação do ESP8266 para receber OTA que esta dentro desta pasta
   >>>>>   Codigo_para_preparar_CentralESP8266_receber_OTA_ethernet    <<<<<<<

   Em seguida so atualizar este código por OTA


   CONEXÃO DO ARDUINO ( NAO ESP8266 NODEMCU ) NO MQTT

   MODULO DA CENTRAL EXTERNA IP 192.168.2.199
   
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

  
*/


#include <UIPEthernet.h>
#include "PubSubClient.h"
#include<SoftwareSerial.h>
#define transmitir 0 // Pino DE e RE - Transmissao
#define pinRX 5 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);

#define LedStatus 16 // LedStatus
String readString; // Variavel pra concatenar dados da serial

                                           //199
#define MACADDRESS 0x00,0x01,0x02,0x03,0x04,0xC7
#define MYIPADDR 192,168,2,199
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

//byte ip[] = { 192, 168, 2, 199 }; // Define o IP do arduino CADA UM DEVE TER O SEU
String ValorIP = "192.168.2.199"; // Colocar o mesmo que ip, este serve para impressao via mqtt
String id = "central_externa"; // SEMPRE em minusculo
bool conectado; // Variavel para armazenar se está conectado
String MensagemParaImprimir; // Usado para enviar os dados recebidos pelo MQTT para os modulos via RS485
bool primeira_mensagem = 0;

// DADOS DO SERVIDOR DO MQTT
//#define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
//#define servidor_mqtt_porta       "10671"  //Porta do servidor MQTT
//#define servidor_mqtt_usuario     "qjuidpsd"  //Usuario
//#define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
//#define mqtt_topico_sub           "dev/test/garagem/externa"
//#define TOPICO_PUBLISH   "dev/test/garagem/externa/central"

#define servidor_mqtt             "192.168.2.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor MQTT
#define servidor_mqtt_usuario     "brunogon"  //Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/garagem/externa"
#define TOPICO_PUBLISH   "dev/test/garagem/externa/central"


EthernetClient ESP8266_Central_Externa; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(ESP8266_Central_Externa); // Nome de cada Servidor UNICO para cada Arduino

char MensagemRecebida[15]; // Usado para criar a string de envio dos dados recebidos pelo MQTT


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected())
  {
    conectado = strlen(servidor_mqtt_usuario) > 0 ?
                client.connect("ESP8266_Central_Externa", servidor_mqtt_usuario, servidor_mqtt_senha) :
                client.connect("ESP8266_Central_Externa");
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

void imprimir() // Se chegou o MQTT tras para ca
{
  pinMode(LedStatus,HIGH);
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  readString.trim();
  RS485.print(readString);
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  pinMode(LedStatus,LOW);
  readString = "";
}




//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
    
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

}



void setup()
{
  Serial.begin(9600);
  //Ethernet.begin(ip); // Conecta através do ip fixo
  Ethernet.begin(mac,myIP,myDNS,myGW,myMASK);
  RS485.begin(9600);
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW);
  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
  //Serial.println(Ethernet.localIP());
}


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
  Serial.println(readString);
  
  // Atualizando pelo comando carros
  // Atualizando as garagens - Todos ligados
  if ( readString.indexOf("todos_on") >= 0)
  {
   client.publish("dev/test/garagem/externa/central", "liga1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "liga2");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "liga3");
   delay(300);
  }
  
  if ( readString.indexOf("todos_off") >= 0 )
  {
   client.publish("dev/test/garagem/externa/central", "desliga1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "desliga2");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "desliga3");
   delay(300);
  }

  // Atualiza desligar geral
  if ( readString.indexOf("geral_0") >= 0 )
  {
   client.publish("dev/test/garagem/externa/central", "teto_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "pendente_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "quadro_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "muro_ch_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "desliga1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "desliga2");
   delay(300); 
   client.publish("dev/test/garagem/externa/central", "desliga3");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "muro_ca_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "jardim_v_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "jardim_h_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "oficina_0");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "frente_0");
   delay(300);
  }
  
  // Atualiza ligar geral
  if ( readString.indexOf("geral_1") >= 0 )
  {
   client.publish("dev/test/garagem/externa/central", "teto_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "pendente_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "quadro_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "muro_ch_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "liga1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "liga2");
   delay(300); 
   client.publish("dev/test/garagem/externa/central", "liga3");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "muro_ca_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "jardim_v_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "jardim_h_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "oficina_1");
   delay(300);
   client.publish("dev/test/garagem/externa/central", "frente_1");
   delay(300);
  }

  // Atualiza Iluminacao do teto da area de churrasco
  if ( readString.indexOf("teto_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "teto_1");delay(300);}
  if ( readString.indexOf("teto_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "teto_0");delay(300);}

  // Atualiza Iluminacao dos pendentes da area de churrasco
  if ( readString.indexOf("pendente_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "pendente_1");delay(300);}
  if ( readString.indexOf("pendente_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "pendente_0");delay(300);}

  // Atualiza Iluminacao ds quadros da area de churrasco
  if ( readString.indexOf("quadro_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "quadro_1");delay(300);}
  if ( readString.indexOf("quadro_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "quadro_0");delay(300);}

  // Atualiza Iluminacao das arandelas do muro da area de churrasco
  if ( readString.indexOf("muro_ch_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "muro_ch_1");delay(300);}
  if ( readString.indexOf("muro_ch_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "muro_ch_0");delay(300);}

  // Atualiza Iluminacao da garagem 1
  if ( readString.indexOf("liga1") >= 0 ){client.publish("dev/test/garagem/externa/central", "liga1");delay(300);}
  if ( readString.indexOf("desliga1") >= 0 ){client.publish("dev/test/garagem/externa/central", "desliga1");delay(300);}
  
  // Atualiza Iluminacao da garagem 2
  if ( readString.indexOf("liga2") >= 0 ){client.publish("dev/test/garagem/externa/central", "liga2");delay(300);}
  if ( readString.indexOf("desliga2") >= 0 ){client.publish("dev/test/garagem/externa/central", "desliga2");delay(300);}
  
  // Atualiza Iluminacao da garagem 3
  if ( readString.indexOf("liga3") >= 0 ){client.publish("dev/test/garagem/externa/central", "liga3");delay(300);}
  if ( readString.indexOf("desliga3") >= 0 ){client.publish("dev/test/garagem/externa/central", "desliga3");delay(300);}
  
  // Atualiza Iluminacao da arandela do muro dos carros
  if ( readString.indexOf("muro_ca_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "muro_ca_1");delay(300);}
  if ( readString.indexOf("muro_ca_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "muro_ca_0");delay(300);}

  // Atualiza Iluminacao do jardim vertical
  if ( readString.indexOf("jardim_v_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "jardim_v_1");delay(300);}
  if ( readString.indexOf("jardim_v_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "jardim_v_0");delay(300);}
  
  // Atualiza Iluminacao do jardim horizontal
  if ( readString.indexOf("jardim_h_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "jardim_h_1");delay(300);}
  if ( readString.indexOf("jardim_h_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "jardim_h_0");delay(300);}
  
  // Atualiza Iluminacao da oficina
  if ( readString.indexOf("oficina_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "oficina_1");delay(300);}
  if ( readString.indexOf("oficina_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "oficina_0");delay(300);}
  
  // Atualiza Iluminacao da frente da casa
  if ( readString.indexOf("frente_1") >= 0 ){client.publish("dev/test/garagem/externa/central", "frente_1");delay(300);}
  if ( readString.indexOf("frente_0") >= 0 ){client.publish("dev/test/garagem/externa/central", "frente_0");delay(300);}
  
  } // Fecha if readString >=0
  readString = "";
 
 

  if (!client.connected())
  {
    reconectar(); // Caso perca a conexão entra em loop para reconectar ao MQTT
  }
  client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT
}
