/*

   CONEXÃO DO ARDUINO ( NAO ESP8266 NODEMCU ) NO MQTT

   Conexão Enc28j60
   SCK = Pino 13
   SO = Pino 12
   ST = Pino 11
   CS = Pino 10
   RST = Reset
   VCC = 5V
   GND = GND
   
   Conexão do modulo RS485
   RO = Pino 3
   DI = Pino 4
   DE = Pino 2 Usado para transmitir
   RE = Pino 2 Usado para transmitir
    
   LedStatus = Pino 5

    
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
  
  
  
*/


#include <UIPEthernet.h>
#include "PubSubClient.h"
#include <SerialRelayBruno.h>

//Criando a Serial
#include<SoftwareSerial.h>
#define transmitir 2 // Pino DE e RE - Transmissao
#define pinRX 3 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);


const int NumeroModulos = 1;    // maximum of 10
const int TempoPausa = 50;  // [ms]


byte ip[] = { 192, 168, 2, 201 }; // Define o IP do arduino CADA UM DEVE TER O SEU
String ValorIP = "192.168.2.201"; // Colocar o mesmo que ip, este serve para impressao via mqtt
String id = "supervisorio"; // SEMPRE em minusculo
bool conectado; // Variavel para armazenar se está conectado
String MensagemParaImprimir; // Usado para enviar os dados recebidos pelo MQTT para os modulos via RS485


// DADOS DO SERVIDOR DO MQTT
#define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
#define servidor_mqtt_porta       "10671"  //Porta do servidor MQTT
#define servidor_mqtt_usuario     "qjuidpsd"  //Usuario
#define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa"
#define TOPICO_PUBLISH   "dev/test/minhacasa"


EthernetClient Supervisorio_MQTT; // Nome de cada Servidor UNICO para cada Arduino
PubSubClient client(Supervisorio_MQTT); // Nome de cada Servidor UNICO para cada Arduino
String readString; // Variavel pra concatenar dados da serial
char MensagemRecebida[30]; // Usado para criar a string de envio dos dados recebidos pelo MQTT
SerialRelayBruno reles(4,5,NumeroModulos); // (data, clock, number of modules)
boolean intertrava = 0;
boolean var_sala1_1 = 0;
boolean var_sala1_2 = 0;
boolean var_sala1_3 = 0;












void setup()
{
  RS485.begin(9600);
  Serial.begin(9600);
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW);
  Ethernet.begin(ip); // Conecta através do ip fixo
  pinMode(2, OUTPUT); // Define o pino 2 como saida
  digitalWrite(2, 0); // Inicia desligado
  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta); // Atribui a porta utilizada no mqtt
  client.setServer(servidor_mqtt, portaInt); // Cria a conexão no servidor client conectando no servidor mqtt com porta
  client.setCallback(atualizar_mensagem); // Atualiza a ultima mensagem do servidor
  //Serial.println(Ethernet.localIP());

  // Desligando todos os reles
  for(int i=1 ; i <= NumeroModulos ; i++)
  {
   for(int j=1 ; j <= 8 ; j++)
   {
    reles.SetRelay(j, DesligarRele, i);
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
  //Serial.print("Chegou do MQTT: ");
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
    String DadosDaMensagemRecebida = {String(readString)};
    DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
    client.publish("dev/test/minhacasa", MensagemRecebida);
    digitalWrite(2, 0);
    delay(150);
    digitalWrite(2, 1);
    delay(150);
    digitalWrite(2, 0);
    delay(150);
    digitalWrite(2, 1);
    
    readString = "";
  }



  if (!client.connected())
  {
    reconectar(); // Caso perca a conexão entra em loop para reconectar ao MQTT
  }
  client.loop(); // Deixar essa linha pois ela que reconecta a leitura de mensagens recebidas pelo MQTT
}


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected())
  {
    conectado = strlen(servidor_mqtt_usuario) > 0 ?
                client.connect("Supervisorio_MQTT", servidor_mqtt_usuario, servidor_mqtt_senha) :
                client.connect("Supervisorio_MQTT");
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
  //digitalWrite(transmitir, HIGH);    //Habilita a transmissão
  String DadosDaMensagemRecebida = String(MensagemParaImprimir);
  DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
  //RS485.write(MensagemRecebida);
  Serial.println(MensagemRecebida);
  //digitalWrite(transmitir,LOW);      //Desabilita a transmissão e volta a receber dados


  // Alterando reles da Sala ******************************************************************************************************************************************************
  if ( MensagemParaImprimir == "sala1_1")
  {
   intertrava = 0;
   if (var_sala1_1 == 0 && intertrava == 0)
   {
    var_sala1_1 = 1;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
   }
   if (var_sala1_1 == 1 && intertrava == 0)
   {
    var_sala1_1 = 0;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
   }
  }
  
  if ( MensagemParaImprimir == "sala1_2")
 {
   intertrava = 0;
   
   if (var_sala1_2 == 0 && intertrava == 0)
   {
    var_sala1_2 = 1;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
   }
   if (var_sala1_2 == 1 && intertrava == 0)
   {
    var_sala1_2 = 0;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
   }
  }
  if ( MensagemParaImprimir == "sala1_3")
  {
   intertrava = 0;
   
   if (var_sala1_3 == 0 && intertrava == 0)
   {
    var_sala1_3 = 1;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
   }
   if (var_sala1_3 == 1 && intertrava == 0)
   {
    var_sala1_3 = 0;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
   }
  }

  // Alterando reles da Sala ******************************************************************************************************************************************************









  
}

