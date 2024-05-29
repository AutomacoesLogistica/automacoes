/*

   MONITOR DE TENSÃO DO >>> monitor_patrag <<<<

   PARA ALTERAR O LOCAL BASTA MUDAR O IP E DAR CONTROL+F E SUBSTITUIR TUDO QUE FOR monitor_patrag PELO PONTO QUE DESEJA

   Pode operar como monitor de tensao ( uso de AC ou BAT ) e tambem como a leitura do valor de tensao

   Para ler o statur em relaco a AC ou BAT monitorar no topico: gerdau/monitor_tensao/monitor_patrag

   Para saber o valor da tensão monitorar no topico: gerdau/valor_tensao/monitor_tensao/monitor_patrag

   Para saber o instante da ultima atualização monitorar no topico: gerdau/instante/monitor_tensao/monitor_patrag

*/
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


const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";

String local = "monitor_patrag"; // aqui é o local onde sera publicado
String condicao = ""; // aqui sera salvo ou AC para alimentado por rede eletrica ou BAT sendo alimentado por bateria

#define Led_Wifi 10
#define Led_Mqtt 16
#define entrada_Tensao 5
#define Led_BAT 4
float valor = 0.00;
float bateria2 = 0.00;

long UltimoMillis = 0;        // Variável de controle do Publica_MQTT
long intervalo = 60;     // Publica_MQTT em segundos do intervalo a ser executado, neste caso , 1 minuto de intervalo
unsigned long AtualMillis;

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "138.0.77.81" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "logistica"  //UsuÃ¡rio
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/mmmm"    //  PARA TROCAR SELECIONAR "monitor_patrag" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx
#define TOPICO_PUBLISH   "gerdau/nnnn"

String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];


IPAddress staticIP(10, 10, 25, 202);
IPAddress gateway(10, 10, 25, 1);
IPAddress mascara(255, 255, 255, 0);
IPAddress dns(8, 8, 8, 8);

static const char ntpServerName[] = "a.st1.ntp.br";
const int timeZone = -3;     // Brasil
WiFiUDP Udp;
unsigned int localPort = 8888;  // porta padrao

time_t Sincronizar_com_servidor();
void imprimirValores();
void Enviar_solicitacao_pacotes_ntp(IPAddress &address);


WiFiClient monitor_patrag;                                 //Instância do WiFiClient
PubSubClient client(monitor_patrag);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;






void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
  //Serial.print("Chegou do MQTT: ");
  String Enviar;

  digitalWrite(Led_Mqtt, LOW);
  delay(200);
  digitalWrite(Led_Mqtt, HIGH);



  Enviar = "";

  Serial.println(Enviar);


} //fecha recebe mensagem

void VerificaTempo(void)
{
  if (int(hour() < 10)) {
    hora = "0" + String(hour());
  } else {
    hora = String(hour());
  }
  if (int(minute() < 10)) {
    minuto = "0" + String(minute());
  } else {
    minuto = String(minute());
  }
  if (int(second() < 10)) {
    segundo = "0" + String(second());
  } else {
    segundo = String(second());
  }
  horario = hora + ":" + minuto + ":" + segundo;

  if (int(day()) < 10) {
    dia = "0" + String(day());
  } else {
    dia = String(day());
  }
  if (int(month()) < 10) {
    mes = "0" + String(month());
  } else {
    mes = String(month());
  }
  ano = String(year());
  datacompleta = dia + "/" + mes + "/" + ano;
  Serial.print("Atualizado em: ");
  Serial.println(horario + " " + datacompleta);

  publica_hora_atualizacao();// chama para atualizar horario
}

//Função que será chamada ao receber mensagem do servidor MQTT ***************************************************************************************************************************



void setup()
{
  Serial.begin(115200);

  pinMode(entrada_Tensao, INPUT);
  pinMode(Led_BAT, OUTPUT);
  pinMode(Led_Wifi, OUTPUT);
  digitalWrite(Led_Wifi, LOW);
  pinMode(Led_Wifi, OUTPUT);
  digitalWrite(Led_Wifi, LOW);
  pinMode(Led_Mqtt, OUTPUT);
  digitalWrite(Led_Mqtt, LOW);
  WiFi.mode(WIFI_STA);
  WiFi.begin(Usuario, Senha);
  WiFi.config(staticIP, gateway, mascara, dns);
  while (WiFi.status() != WL_CONNECTED)
  {
    digitalWrite(Led_Wifi, LOW);
    delay(500);
    Serial.print(".");
  }
  digitalWrite(Led_Wifi, HIGH); // Conectado!
  Serial.println("");
  Serial.println("WiFi conectado com");
  Serial.println("IP: ");
  Serial.println(WiFi.localIP());
  Serial.println("");
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
    digitalWrite(Led_Mqtt, LOW);

    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("monitor_patrag", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("monitor_patrag");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      digitalWrite(Led_Mqtt, HIGH);

      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      digitalWrite(Led_Mqtt, LOW);
      delay(200);
    }
  }
}

void Publica_MQTT()
{
  // Verificando o pulso do GAGF **************************************************************************************************************************************************
  if (digitalRead(entrada_Tensao) == 0)
  {
    Serial.println("Alimentado por AC");
    digitalWrite(Led_BAT, LOW);
    condicao = "AC";
  }
  else
  {
    Serial.println("Alimentado por BAT");
    digitalWrite(Led_BAT, HIGH);
    condicao = "BAT";
  }
  digitalWrite(Led_Mqtt, LOW);
  Mensagem_Enviar = condicao; // Busca o valor de umidade do sensor e salva na variavel
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length() + 1);
  topico = "gerdau/monitor_tensao/" + local;
  topico.toCharArray(Funcoes_topico, topico.length() + 1);
  client.publish(Funcoes_topico, Funcoes); // Publica se esta sendo alimentado por AC ou BAT
  delay(200);
  String tensao = "";
  tensao = String(valor) + " V";
  Mensagem_Enviar = tensao; // Busca o valor de umidade do sensor e salva na variavel
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length() + 1);
  topico = "gerdau/valor_tensao/monitor_tensao/" + local;
  topico.toCharArray(Funcoes_topico, topico.length() + 1);
  client.publish(Funcoes_topico, Funcoes); // Publica o valor da bateria
  delay(200);

  // chama o void para atualizar o horario da publicacao
  VerificaTempo();


}

void loop()
{
  
  
 
 bateria2 = analogRead(A0);
 valor = ((analogRead(A0)*2.68/884)-0.02)*11.42;
  
  
  //valor = (((analogRead(A0) * 2.68 / 884) - 0.02) * 11.42) + (0.9); // 0.9 porque tem 2 diodos de proteção reversa ai faz ajustes pela queda dos mesmos
  //if ( int(valor) < 5)
  //{
   // valor = 0.00;
  //}

  //Serial.print("Tensao = ");Serial.print(valor);Serial.println(" V");



  AtualMillis = millis() / 1000;  //Publica_MQTT atual em segundos

  if (AtualMillis - UltimoMillis > intervalo)
  {
    UltimoMillis = AtualMillis;    // Salva o Publica_MQTT atual
    Publica_MQTT();
  }

  // Verificando o pulso do GAGF **************************************************************************************************************************************************
  if (digitalRead(entrada_Tensao) == 0)
  {
    digitalWrite(Led_BAT, LOW);
    condicao = "AC";
  }
  else
  {
    digitalWrite(Led_BAT, HIGH);
    condicao = "BAT";
  }

  if (!client.connected())
  {
    reconectar();
  }

  client.loop();
}
