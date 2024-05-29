/*
 * TimeNTP_ESP8266WiFi.ino
 * Example showing time sync to NTP time source
 *
 * This sketch uses the ESP8266WiFi library
 */

#include <TimeLib.h>
#include <ESP8266WiFi.h>
#include <WiFiUdp.h>
const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";
uint32_t TempoAtual = 0;
uint32_t UltimoTempo = 0;

String dia = "";
String mes = "";
String ano = "";
String hora = "";
String minuto = "";
String segundo = "";
String horario = "";
String datacompleta = "";

IPAddress staticIP(10,10,25,98);
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

void setup()
{
Serial.begin(115200);
  WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara, dns);  // (DNS not required)  
 while(WiFi.status() != WL_CONNECTED) 
 {
  delay(50);
  Serial.print(".");
 }
 Udp.begin(localPort);
 setSyncProvider(Sincronizar_com_servidor);
 setSyncInterval(300);
} // fecha void setup

time_t tempo_inicial = 0; // when the digital clock was displayed

void loop()
{
  TempoAtual = millis();//Tempo atual em ms
 //Lógica de verificação do tempo
 if (TempoAtual - UltimoTempo > 1000) 
 {
  UltimoTempo = TempoAtual;    // Salva o tempo atual
  imprimirValores();
 }
}

void imprimirValores()
{
  if(int(hour()<10)){hora = "0" + String(hour());}else{hora = String(hour());}
  if(int(minute()<10)){minuto = "0" + String(minute());}else{minuto = String(minute());}
  if(int(second()<10)){segundo = "0" + String(second());}else{segundo = String(second());}
  horario = hora + ":" + minuto + ":" + segundo;
   
  if(int(day())<10){dia = "0"+String(day());}else{dia = String(day());}
  if(int(month())<10){mes = "0"+String(month());}else{mes = String(month());}
  ano = String(year());
  datacompleta = dia + "/" + mes + "/" + ano;
  Serial.println(horario + " " + datacompleta);
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
