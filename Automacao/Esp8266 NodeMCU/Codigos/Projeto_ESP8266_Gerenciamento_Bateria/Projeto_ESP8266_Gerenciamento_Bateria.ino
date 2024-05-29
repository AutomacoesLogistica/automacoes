/*
 * 
 * 
 * 
 * ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!
 * ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!
 * ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!
 * 
 * 
 * PARA MUDAR A MAQUINA, DA CONTROL+F E ALTERAR TUDO QUE FOR  >>>>>>>     gerenciamento_bateria      <<<<<<<<< PARA A MAQUINA DESEJADA, RESPEITANDO O TAMANHO. ex,trocar para maquina 02
 * 
 * Control+F , filtrar     gerenciamento_bateria e substituir todas por pc02
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


#include <SoftwareSerial.h>
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <TimeLib.h>
#include <WiFiUdp.h>

String dia = "";
String mes = "";
String ano = "";
String hora = "";
String minuto = "";
String segundo = "";
String horario = "";
String datacompleta = "";
String horario2 = "";

const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";
 
String Mensagem_Enviar; 
String topico; // String para armazenar o topico a ser publicado com as variaveis de forma automática

 
char Funcoes_topico[60];
char Funcoes[50];

#define rele1 5 // Rele tablet TTP MB D1
#define rele2 4 // Rele tablet TTP VL D2
#define rele3 10 // Rele tablet Excesso MB SD3
#define rele4 16 // Rele tablet Excesso VL  D0


#define saida_rele1 14
#define saida_rele2 12
#define saida_rele3 13
#define saida_rele4 15


boolean pode_publicar_mqtt = false;

String carregadeira = "gerenciamento_bateria";

String maquina = "desligada";

void liga_rele1(void);
void liga_rele2(void);
void liga_rele3(void);
void liga_rele4(void);
void desliga_rele1(void);
void desliga_rele2(void);
void desliga_rele3(void);
void desliga_rele4(void);

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "138.0.77.81"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "logistica"  // Usuario
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/tablet/+/+/status"   //ttp ou excesso vl ou mb  


IPAddress staticIP(10,10,25,94);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
IPAddress dns(8,8,8,8);


static const char ntpServerName[] = "a.st1.ntp.br";
const int timeZone = -3;     // Brasil
WiFiUDP Udp;
unsigned int localPort = 8888;  // porta padrao

time_t Sincronizar_com_servidor();
void imprimirValores();
void Enviar_solicitacao_pacotes_ntp(IPAddress &address);


WiFiClient gerenciamento_bateria;                                 //Instância do WiFiClient
PubSubClient client(gerenciamento_bateria);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar = false; //Flag para salvar os dados
String atualiza;
bool primeira_mensagem = 0;

String readString;

unsigned long AtualMillis;

#define Led_Wifi 0 // D3
#define Led_Mqtt 2 // D4

void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 Serial.print("Chegou do MQTT: ");
 Serial.println(strMensagem);
 String Enviar;
 digitalWrite(Led_Mqtt,LOW);
 Enviar = strMensagem;


 if(primeira_mensagem == 1)
 {
  if (String(topico) == "gerdau/tablet/ttp/mb/status")
  {
   if ( Enviar == "carregar" ){liga_rele1();} 
   if ( Enviar == "parar_carga" ){desliga_rele1();} 
  }
  if (String(topico) == "gerdau/tablet/ttp/vl/status")
  {
   if ( Enviar == "carregar" ){liga_rele2();} 
   if ( Enviar == "parar_carga" ){desliga_rele2();} 
  }
  if (String(topico) == "gerdau/tablet/excesso/mb/status")
  {
   if ( Enviar == "carregar" ){liga_rele3();} 
   if ( Enviar == "parar_carga" ){desliga_rele3();} 
  }
  if (String(topico) == "gerdau/tablet/excesso/vl/status")
  {
   if ( Enviar == "carregar" ){liga_rele4();} 
   if ( Enviar == "parar_carga" ){desliga_rele4();} 
  }
 
 } // Fecha o deixa publicar
 if(primeira_mensagem == 0){primeira_mensagem = 1;}
  








 delay(200);
 digitalWrite(Led_Mqtt,HIGH);
 
} //fecha recebe mensagem ***************************************************************************************************************************************************************


void VerificaTempo(void) 
{
  if(int(hour()<10)){hora = "0" + String(hour());}else{hora = String(hour());}
  if(int(minute()<10)){minuto = "0" + String(minute());}else{minuto = String(minute());}
  if(int(second()<10)){segundo = "0" + String(second());}else{segundo = String(second());}
  horario = hora + ":" + minuto + ":" + segundo;
   
  if(int(day())<10){dia = "0"+String(day());}else{dia = String(day());}
  if(int(month())<10){mes = "0"+String(month());}else{mes = String(month());}
  ano = String(year());
  datacompleta = dia + "/" + mes + "/" + ano;
  
  //Serial.println(horario + " " + datacompleta);
  
}


//Função que será chamada ao receber mensagem do servidor MQTT ***************************************************************************************************************************

void setup()
{
 Serial.begin(115200);
 pinMode(Led_Wifi,OUTPUT);
 digitalWrite(Led_Wifi,LOW);
 pinMode(Led_Mqtt,OUTPUT);
 digitalWrite(Led_Mqtt,LOW);
 WiFi.mode(WIFI_STA);
 WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara, dns); 
 pinMode(rele1,OUTPUT); // Tablet MB
 pinMode(rele2,OUTPUT); // Tablet VL
 pinMode(rele3,OUTPUT); // reserva
 pinMode(rele4,OUTPUT); // reserva
 digitalWrite(rele1,HIGH);// Inicia em alto pois o rele atua em low
 digitalWrite(rele2,HIGH);// Inicia em alto pois o rele atua em low
 digitalWrite(rele3,HIGH);// Inicia em alto pois o rele atua em low
 digitalWrite(rele4,HIGH);// Inicia em alto pois o rele atua em low

 pinMode(saida_rele1,OUTPUT);
 pinMode(saida_rele2,OUTPUT);
 pinMode(saida_rele3,OUTPUT);
 pinMode(saida_rele4,OUTPUT);
 digitalWrite(saida_rele1,LOW); // Inicia apagado
 digitalWrite(saida_rele2,LOW); // Inicia apagado
 digitalWrite(saida_rele3,LOW); // Inicia apagado
 digitalWrite(saida_rele4,LOW); // Inicia apagado

 
 delay(1000);
 Serial.println("Verificando Conexao!");
 while (WiFi.status() != WL_CONNECTED) 
 {
  digitalWrite(Led_Wifi,LOW);
  delay(500);
  Serial.println("Conectando Wifi...");
 }
 digitalWrite(Led_Wifi,HIGH);
 Serial.println("Conectado no wifi " + String(Usuario));
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
 Udp.begin(localPort);
 setSyncProvider(Sincronizar_com_servidor);
 setSyncInterval(300);
 
}

const int NTP_PACKET_SIZE = 48; // Tamanho do pacote
byte packetBuffer[NTP_PACKET_SIZE]; //Armazena o pacote 

time_t Sincronizar_com_servidor()
{
 IPAddress ntpServerIP;
 while (Udp.parsePacket() > 0) ;
 WiFi.hostByName(ntpServerName, ntpServerIP);
 Enviar_solicitacao_pacotes_ntp(ntpServerIP);
 uint32_t beginWait = millis();
 while (millis() - beginWait < 1500)
 {
  int size = Udp.parsePacket();
  if (size >= NTP_PACKET_SIZE)
  { // Se receber pacotes de atualizacao
   Udp.read(packetBuffer, NTP_PACKET_SIZE);  // read packet into the buffer
   unsigned long secsSince1900;
   secsSince1900 =  (unsigned long)packetBuffer[40] << 24;
   secsSince1900 |= (unsigned long)packetBuffer[41] << 16;
   secsSince1900 |= (unsigned long)packetBuffer[42] << 8;
   secsSince1900 |= (unsigned long)packetBuffer[43];
   return secsSince1900 - 2208988800UL + timeZone * SECS_PER_HOUR;
  }
 }
 // Falha de comunicacao com o servidor
 return 0; 
}// Fecha o void time_t

void Enviar_solicitacao_pacotes_ntp(IPAddress &address)
{
  memset(packetBuffer, 0, NTP_PACKET_SIZE);
  packetBuffer[0] = 0b11100011;   // LI, Version, Mode
  packetBuffer[1] = 0;     // Stratum, or type of clock
  packetBuffer[2] = 6;     // Polling Interval
  packetBuffer[3] = 0xEC;  // Peer Clock Precision
  packetBuffer[12] = 49;
  packetBuffer[13] = 0x4E;
  packetBuffer[14] = 49;
  packetBuffer[15] = 52;
  Udp.beginPacket(address, 123); //NTP requests are to port 123
  Udp.write(packetBuffer, NTP_PACKET_SIZE);
  Udp.endPacket();
}



//Função que reconecta ao servidor MQTT
void reconectar() {
  
  //Repete até conectar
  while (!client.connected()) {
    digitalWrite(Led_Mqtt,LOW);
     //Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("gerenciamento_bateria", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("gerenciamento_bateria");

    if(conectado)
    {
     digitalWrite(Led_Mqtt,HIGH);
     Serial.println("Conectado_MQTT,");
     //Subscreve para monitorar os comandos recebidos
     client.subscribe(mqtt_topico_sub, 1); //QoS 1
    }
    else
    {
     //Serial.println("Falhou ao tentar conectar. Codigo: ");
     //Serial.println(String(client.state()).c_str());
     Serial.println("Reconectando MQTT novamente em 0.2 segundos");
     //Aguarda 5 segundos para tentar novamente
     digitalWrite(Led_Mqtt,LOW);
     delay(200);
    }
  }
}




void loop()
{
 if (!client.connected()) 
{
 reconectar();
} 


client.loop();
  
}// Fecha Loop
