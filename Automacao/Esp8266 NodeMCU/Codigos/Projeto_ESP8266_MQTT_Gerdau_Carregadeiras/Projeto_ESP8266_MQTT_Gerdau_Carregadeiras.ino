/*
 * 
 * Equivalencia das saidas Digitais entre NodeMCU e ESP8266 (na IDE do Arduino)
NodeMCU - ESP8266
D0 = 16;
D1 = 5;
D2 = 4;
D3 = 0;
D4 = 2;
D5 = 14;
D6 = 12;
D7 = 13;
D8 = 15;
D9 = 3;
D10 = 1;
 * 
 * 
 */
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include "DHTesp.h"
 
const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";

#define LedStatus 16 // Led status mensagem recebida
#define rele1 5 // rele do reader D1
#define rele2 4 // Rele do radio D2
DHTesp dht;

#define sensor_movimento 14 // Sensor D5
int vezes_sensor_movimento = 0;
int vezes_sensor_parado = 0;
String carregadeira = "pc01";

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "138.0.77.81"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "logistica"  //UsuÃ¡rio
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub1           "dev/test/comando/pc001/+"


IPAddress staticIP(10,10,25,90);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
WiFiClient ESP_Central_Supervisorio;                                 //Instância do WiFiClient
PubSubClient client(ESP_Central_Supervisorio);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;
char Funcoes[30];
char Funcoes_topico[60];
String Mensagem_Enviar;
String topico;

long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 5000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;


void liga_rele1()
{
  digitalWrite(rele1,LOW);// Inicia em alto pois o rele atua em low
  Mensagem_Enviar = "rele1_pc01_on"; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/status/pc01/rele1", Funcoes); 
  readString ="";
  delay(200);
  
}
void desliga_rele1()
{
  digitalWrite(rele1,HIGH);// Inicia em alto pois o rele atua em low
  Mensagem_Enviar = "rele1_pc01_off";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/status/pc01/rele1", Funcoes); 
  readString =""; 
  delay(200);
}


void liga_rele2()
{
  digitalWrite(rele2,LOW);// Inicia em alto pois o rele atua em low
  Mensagem_Enviar = "rele2_pc01_on";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/status/pc01/rele2", Funcoes); 
  readString ="";
  delay(200);
  
}
void desliga_rele2()
{
  digitalWrite(rele2,HIGH);// Inicia em alto pois o rele atua em low
  Mensagem_Enviar = "rele2_pc01_off"; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/status/pc01/rele2", Funcoes); 
  readString =""; 
  delay(200);
}




void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
  
 mensagem[tamanho] ='\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 //Serial.print("Chegou do MQTT: ");
 String Enviar;
 
 digitalWrite(LedStatus,HIGH);
 delay(200);
 digitalWrite(LedStatus,LOW);

 Enviar = strMensagem;
// Serial.print("Topico : ");
 //Serial.print(topico);
 //Serial.print("     Mensagem : ");

 if ( Enviar == "rele1_pc01_on" )
 {
 liga_rele1();
 }
 if ( Enviar == "rele1_pc01_off" )
 {
  desliga_rele1();
 }



 if ( Enviar == "rele2_pc01_on" )
 {
   liga_rele2();
 }
 if ( Enviar == "rele2_pc01_off" )
 {
  desliga_rele2();
 }



 if ( Enviar == "pc01_reset" )
 {
 if(digitalRead(rele1)==LOW && digitalRead(rele2)==LOW)
 {
   desliga_rele1();
   desliga_rele2();
   delay(4800);
   liga_rele1();
   liga_rele2();
 }
 
 }


 
 Serial.println(Enviar);

} //fecha recebe mensagem


void setup()
{
 Serial.begin(115200);
 dht.setup(0, DHTesp::DHT11); // Conectado na porta D3
 
 pinMode(LedStatus,OUTPUT);
 digitalWrite(LedStatus,LOW);
 
 pinMode(rele1,OUTPUT);
 pinMode(rele2,OUTPUT);
 digitalWrite(rele1,HIGH);// Inicia em alto pois o rele atua em low
 digitalWrite(rele2,HIGH);// Inicia em alto pois o rele atua em low

 pinMode(sensor_movimento,INPUT);
 
 WiFi.mode(WIFI_STA);
 WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara);  // (DNS not required)  
 while (WiFi.status() != WL_CONNECTED) 
 {
  delay(500);
  Serial.println("Connecting to WiFi..");
 }
 Serial.println("Connected to the WiFi network");
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
}


void atualiza_temp_umidade()
{
  delay(dht.getMinimumSamplingPeriod()); // Tempo espera minimo para atualização
  float humidity = dht.getHumidity();
  float temperature = dht.getTemperature();
  String Mensagem_Enviar;
  String umidade;
  String temperatura;
  String topico;
  umidade = String(humidity,1) + " %";
  Mensagem_Enviar = umidade; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "dev/test/"+carregadeira+"/umidade";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica a umidade
  
  temperatura = String(dht.computeHeatIndex(temperature, humidity, false), 1) + " ºC";
  Mensagem_Enviar = temperatura; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
  topico = "dev/test/"+carregadeira+"/temp";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica a temperatura
  readString ="";
}




//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
     //Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("ESP_Central_Supervisorio", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("ESP_Central_Supervisorio");

    if(conectado) {
       Serial.println("Conectado_MQTT,");
       digitalWrite(LedStatus,LOW);
      //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub1, 1); //QoS 1
  
    } else {
       //Serial.println("Falhou ao tentar conectar. Codigo: ");
       //Serial.println(String(client.state()).c_str());
       //Serial.println(" tentando novamente em 5 segundos");
      //Aguarda 5 segundos para tentar novamente
      digitalWrite(LedStatus,HIGH);
      delay(2000);
    }
  }
}





 
void loop() 
{
  
   AtualMillis = millis();    //Tempo atual em ms
  
  if (AtualMillis - UltimoMillis > intervalo) 
  { 
    UltimoMillis = AtualMillis;    // Salva o tempo atual
   atualiza_temp_umidade();
    
  }
  
  
  
   if(digitalRead(sensor_movimento)==LOW)
   {
    
    if ( vezes_sensor_movimento == 0 )
    {
     Serial.println("Ligada");
     vezes_sensor_parado = 0;
     Mensagem_Enviar = "Maquina em Operacao!"; 
     Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
     topico = "dev/test/"+carregadeira+"/status";
     topico.toCharArray(Funcoes_topico, topico.length()+1);
     client.publish(Funcoes_topico, Funcoes); // Publica o status da maquina
    }
    
    vezes_sensor_movimento++;
    vezes_sensor_parado = 0;
    if ( vezes_sensor_movimento>=500000)
    {
      vezes_sensor_movimento = 0;
    }
    
   }
   else
   {
      
    if ( vezes_sensor_parado == 0 )
    {
     client.publish("dev/test/pc01/status", "Maquina Desligada!");
     Serial.println("Desligada");
     
    }
    
    vezes_sensor_parado++;
    vezes_sensor_movimento = 0;
    
    if ( vezes_sensor_parado >=500000)
    {
      vezes_sensor_parado = 0;
    }

    
   }
   
   
   
   
   
   
   
   while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   readString += c; 
  }
 
  // Se existir dados na serial **********************************************************************************************************************************************************
  if (readString.length() >0) 
  {
   digitalWrite(LedStatus,HIGH);
   String Mensagem_Enviar = {String(readString)}; 
   Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
   client.publish("/gerdau/funcao/cancelas", Funcoes); 
   delay(200);
   digitalWrite(LedStatus,LOW);  
   
   readString ="";
  } // Fecha se existe dados na serial
 
   if (!client.connected()) 
  {
   reconectar();
  }
  
  client.loop();
}
