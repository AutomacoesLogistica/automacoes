#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <EEPROM.h>
const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";
int eprom_GAGF = 0; // Usado para Endereco na eeprom para GAGF
int eprom_SVA = 1; // Usado para Endereco na eeprom para SVA

#define entrada_GAGF 5
#define entrada_SVA 4
#define saida 0
#define saida_GAGF 14
#define saida_SVA 12

boolean GAGF = 0;
unsigned long pulsos = 0;
boolean SVA = 0;

String comando = "";
boolean bypass_GAGF = false;
boolean bypass_SVA = false;


// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "10.10.25.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "logistica"  //UsuÃ¡rio
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/cancela/can4_mb"    //  PARA TROCAR SELECIONAR "can4_mb" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO
#define TOPICO_PUBLISH   "gerdau/cancela/condicao/can4_mb" 


IPAddress staticIP(10,10,25,86);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
WiFiClient can4_mb;                                 //Instância do WiFiClient
PubSubClient client(can4_mb);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;
char Funcoes[50];
#define LedStatus 16





void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 //Serial.print("Chegou do MQTT: ");
 String Enviar;
 
 digitalWrite(LedStatus,HIGH);
 delay(500);
 digitalWrite(LedStatus,LOW);
 
 if ( strMensagem == "pulso"){comando = "pulso"; }
 if ( strMensagem == "bypass_gagf_on"){bypass_GAGF = true; EEPROM.begin(512); EEPROM.write(eprom_GAGF, 1);delay(500); EEPROM.end(); strMensagem = "info";}
 if ( strMensagem == "bypass_gagf_off"){bypass_GAGF = false; EEPROM.begin(512); EEPROM.write(eprom_GAGF, 0);delay(500); EEPROM.end(); strMensagem = "info";}
 if ( strMensagem == "bypass_sva_on"){bypass_SVA = true; EEPROM.begin(512); EEPROM.write(eprom_SVA, 1);delay(500); EEPROM.end(); strMensagem = "info";}
 if ( strMensagem == "bypass_sva_off"){bypass_SVA = false; EEPROM.begin(512); EEPROM.write(eprom_SVA, 0);delay(500); EEPROM.end(); strMensagem = "info";}
 
 if ( strMensagem == "info")
 {
  String msg_GAGF = "";
  if (bypass_GAGF == true){msg_GAGF = "GAGF_ON";}
  if (bypass_GAGF == false){msg_GAGF = "GAGF_OFF";}
  
  String msg_SVA = "";
  if (bypass_SVA == true){msg_SVA = "SVA_ON";}
  if (bypass_SVA == false){msg_SVA = "SVA_OFF";}
  
  String Mensagem_Enviar,topico;
  char Funcoes_topico[60];
  char Funcoes[50];
  Mensagem_Enviar = msg_GAGF + " - " + msg_SVA;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
  topico = "gerdau/cancela/condicao/can4_mb";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica a longitude
  delay(500);
  
 }
 
 Enviar = "";
 Enviar = strMensagem += ",";
 Serial.println(Enviar);


} //fecha recebe mensagem





void setup()
{
  Serial.begin(115200);
  EEPROM.begin(512);

  int leitura_DECIMAL_GAGF = -1;
  int leitura_DECIMAL_SVA = -1;

  leitura_DECIMAL_GAGF = EEPROM.read(eprom_GAGF);
  leitura_DECIMAL_SVA = EEPROM.read(eprom_SVA);
  
  if ( leitura_DECIMAL_GAGF == 1 ){ bypass_GAGF = true; }
  if ( leitura_DECIMAL_GAGF == 0 ){ bypass_GAGF = false; }

  if ( leitura_DECIMAL_SVA == 1 ){ bypass_SVA = true; }
  if ( leitura_DECIMAL_SVA == 0 ){ bypass_SVA = false; }
  
  
  pinMode(entrada_GAGF,INPUT);
  pinMode(entrada_SVA,INPUT);
  pinMode(saida,OUTPUT);
  digitalWrite(saida,LOW);
  pinMode(saida_GAGF,OUTPUT);
  digitalWrite(saida_GAGF,LOW);
  pinMode(saida_SVA,OUTPUT);
  digitalWrite(saida_SVA,LOW);
  pinMode(LedStatus,OUTPUT);
  digitalWrite(LedStatus,LOW);
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

//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
     //Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("can4_mb", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("can4_mb");

    if(conectado) {
       Serial.println("Conectado_MQTT,");
       digitalWrite(LedStatus,LOW);
      //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
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
  // Verificando o pulso do GAGF **************************************************************************************************************************************************
 if (digitalRead(entrada_GAGF) == 1)
 {
  delay(200);
  while(digitalRead(entrada_GAGF) == 1)
  {
   delay(100);
  }
  GAGF = 1;
  digitalWrite(saida_GAGF,HIGH);
  pulsos = 0;
  
 }
 // Verificando o pulso do GAGF **************************************************************************************************************************************************
 if (digitalRead(entrada_SVA) == 1)
 {
  delay(200);
  while(digitalRead(entrada_SVA) == 1)
  {
   delay(100);
  }
  SVA = 1;
  digitalWrite(saida_SVA,HIGH);
  pulsos = 0;
  
 }


if (bypass_GAGF == true && SVA == true)
{
 comando = "";
 digitalWrite(saida,HIGH);
 digitalWrite(saida_SVA,HIGH);
 delay(2000);
 digitalWrite(saida,LOW);
 digitalWrite(saida_GAGF,LOW);
 digitalWrite(saida_SVA,LOW);
 SVA = 0;
 GAGF = 0;
}

if (bypass_SVA == true && GAGF == true)
{
 comando = "";
 digitalWrite(saida,HIGH);
 digitalWrite(saida_GAGF,HIGH);
 delay(2000);
 digitalWrite(saida,LOW);
 digitalWrite(saida_GAGF,LOW);
 digitalWrite(saida_SVA,LOW);
 SVA = 0;
 GAGF = 0;
}



 if ((SVA == true && GAGF == true) || comando == "pulso" )
 {
  comando = "";
  digitalWrite(saida,HIGH);
  digitalWrite(saida_GAGF,HIGH);
  digitalWrite(saida_SVA,HIGH);
  delay(2000);
  digitalWrite(saida,LOW);
  digitalWrite(saida_GAGF,LOW);
  digitalWrite(saida_SVA,LOW);
  SVA = 0;
  GAGF = 0;
 }




 pulsos++;



 if ( pulsos == 700000 )
 {
  pulsos = 0;
  Serial.println ("Zerou");
  digitalWrite(saida,LOW);
  digitalWrite(saida_GAGF,LOW);
  digitalWrite(saida_SVA,LOW);
  SVA = 0;
  GAGF = 0;
 }
   if (!client.connected()) 
  {
   reconectar();
  }
  
  client.loop();
}
