/*
AUTOMACAO DA AREA EXTERNA, ESTE PROJETO ESTA ASSOCIADO A UM DO ARDUINO PRO MINI VIA SERIAL

Equivalencia das saidas Digitais entre NodeMCU e ESP8266 (na IDE do Arduino)
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
*/

#include <FS.h>                 //Esta precisa ser a primeira referência, ou nada dará certo e sua vida será arruinada. kkk
#include <ESP8266WiFi.h>        //https://github.com/esp8266/Arduino
#include <NTPClient.h>
#include <WiFiUdp.h>
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>        //https://github.com/tzapu/WiFiManager
#include <ArduinoJson.h>        //https://github.com/bblanchon/ArduinoJson
#include <PubSubClient.h>
#include <EEPROM.h>

#define DEBUG                   //Se descomentar esta linha vai habilitar a 'impressão' na porta serial


/*

//CLOUD MQTT 01
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
#define servidor_mqtt_porta       "10671"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "qjuidpsd"  //UsuÃ¡rio
#define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/supervisorio"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/minhacasa/central" 

//CLOUD MQTT 02
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "m10.cloudmqtt.com"  //URL do servidor MQTT
#define servidor_mqtt_porta       "19291"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "cpywfqsn"  //UsuÃ¡rio
#define servidor_mqtt_senha       "cOuPTqkwMTOL"  //Senha
#define mqtt_topico_sub           "dev/test"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test" 
*/


// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "186.235.193.170"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/supervisorio"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/minhacasa/central" 


const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";


//Declaração do pino que será utilizado e a memória alocada para armazenar o status deste pino na EEPROM

WiFiClient ESP_Central_Supervisorio;                                 //Instância do WiFiClient
PubSubClient client(ESP_Central_Supervisorio);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;
char Funcoes[50];
#define LedStatus 16


long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 5000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
int disjuntor = 0;











//Função que será chamada ao receber mensagem do servidor MQTT
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
  
 Enviar = "";
 Enviar = strMensagem += ",";
 Serial.println(Enviar);


} //fecha recebe mensagem


//Função de atualizar_mensagem para notificar sobre a necessidade de salvar as configurações
void precisaSalvarCallback() {
   //Serial.println("As configuracoes tem que ser salvas.");
  precisaSalvar = true;
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



void imprimir()
{
 if (disjuntor == 1 )
 {   
  float Valor_Funcoes = random(10.0);
  float Valor_Corrente_Disj_Illuminacao_2 = random(10.0)/100;
  float Valor_Corrente_Disj_Illuminacao_3 = random(10.0)/100;
  float Valor_Corrente_Disj_Illuminacao_4 = random(10.0)/100;
  float Valor_Corrente_Disj_Illuminacao_5 = random(10.0)/100;
  float Valor_Corrente_Disj_Illuminacao_6 = random(10.0)/100;
  float Valor_Corrente_Disj_Illuminacao_7 = random(10.0)/100;
  Serial.print("Disj-01");
  Serial.print(Valor_Funcoes,1);
  Serial.print("A");
  Serial.print(Valor_Corrente_Disj_Illuminacao_2,1);
  Serial.print("B");
  Serial.print(Valor_Corrente_Disj_Illuminacao_3,1);
  Serial.print("C");
  Serial.print(Valor_Corrente_Disj_Illuminacao_4,1);
  Serial.print("D");
  Serial.print(Valor_Corrente_Disj_Illuminacao_5,1);
  Serial.print("E");
  Serial.print(Valor_Corrente_Disj_Illuminacao_6,1);
  Serial.print("F");
  Serial.print(Valor_Corrente_Disj_Illuminacao_7,1);
  Serial.print("<");
  Serial.println(","); // Necessario para finalizar envio
 }

 if (disjuntor == 2 )
 {   
  float Valor_Corrente_Disj_Illuminacao_8 = random(10.0)/10;
  float Valor_Corrente_Disj_Illuminacao_9 = random(10.0)/10;
  float Valor_Funcoes0 = random(10.0)/10;
  float Valor_Funcoes1 = random(10.0)/10;
  float Valor_Funcoes2 = random(10.0)/10;
  float Valor_Funcoes3 = random(10.0)/10;
  float Valor_Funcoes4 = random(10.0)/10;
  Serial.print("Disj-08");
  Serial.print(Valor_Corrente_Disj_Illuminacao_8,1);
  Serial.print("A");
  Serial.print(Valor_Corrente_Disj_Illuminacao_9,1);
  Serial.print("B");
  Serial.print(Valor_Funcoes0,1);
  Serial.print("C");
  Serial.print(Valor_Funcoes1,1);
  Serial.print("D");
  Serial.print(Valor_Funcoes2,1);
  Serial.print("E");
  Serial.print(Valor_Funcoes3,1);
  Serial.print("F");
  Serial.print(Valor_Funcoes4,1);
  Serial.print("<");
  Serial.println(","); // Necessario para finalizar envio
 }
 if (disjuntor == 3 ) // envia o status dos disjuntores
 {  
 int disj_01 = random(2);
 int disj_02 = random(2);
 int disj_03 = random(2);
 int disj_04 = random(2);
 int disj_05 = random(2);
 int disj_06 = random(2);
 int disj_07 = random(2);
 int disj_08 = random(2);
 int disj_09 = random(2);
 int disj_10 = random(2);
 int disj_11 = random(2);
 int disj_12 = random(2);
 int disj_13 = random(2);
 int disj_14 = random(2);

 Serial.print("*");
 Serial.print(disj_01);
 Serial.print(disj_02);
 Serial.print(disj_03);
 Serial.print(disj_04);
 Serial.print(disj_05);
 Serial.print(disj_06);
 Serial.print(disj_07);
 Serial.print(disj_08);
 Serial.print(disj_09);
 Serial.print(disj_10);
 Serial.print(disj_11);
 Serial.print(disj_12);
 Serial.print(disj_13);
 Serial.print(disj_14);
 Serial.print("*");
 Serial.println(",");
 }


  
}






//Função inicial (será executado SOMENTE quando ligar o ESP)
void setup() 
{
  Serial.begin(9600);
  pinMode(LedStatus,OUTPUT);
  digitalWrite(LedStatus,HIGH);
  //Iniciando o SPIFSS (SPI Flash File System)
   //Serial.println("Iniciando o SPIFSS (SPI Flash File System)");
  if (SPIFFS.begin()) {
    // Serial.println("Sistema de arquivos SPIFSS montado!");
    if (SPIFFS.exists("/config.json")) {
      //Arquivo de configuração existe e será lido.
       //Serial.println("Abrindo o arquivo de configuracao...");
      File configFile = SPIFFS.open("/config.json", "r");
      if (configFile) {
         //Serial.println("Arquivo de configuracao aberto.");
        size_t size = configFile.size();
        
        //Alocando um buffer para armazenar o conteúdo do arquivo.
        std::unique_ptr<char[]> buf(new char[size]);

        configFile.readBytes(buf.get(), size);
        DynamicJsonBuffer jsonBuffer;
        JsonObject& json = jsonBuffer.parseObject(buf.get());
         //json.printTo(Serial);
        if (json.success()) {
            //Copiando as variáveis salvas previamente no aquivo json para a memória do ESP.
             //Serial.println("arquivo json analisado.");
            strcpy(servidor_mqtt, json["servidor_mqtt"]);
            strcpy(servidor_mqtt_porta, json["servidor_mqtt_porta"]);
            strcpy(servidor_mqtt_usuario, json["servidor_mqtt_usuario"]);
            strcpy(servidor_mqtt_senha, json["servidor_mqtt_senha"]);
            strcpy(mqtt_topico_sub, json["mqtt_topico_sub"]);

        } else {
           //Serial.println("Falha ao ler as configuracoes do arquivo json.");
        }
      }
    }
  } else {
     //Serial.println("Falha ao montar o sistema de arquivos SPIFSS.");
  }
  //Fim da leitura do sistema de arquivos SPIFSS

  //Parâmetros extras para configuração
  //Depois de conectar, parameter.getValue() vai pegar o valor configurado.
  //Os campos do WiFiManagerParameter são: id do parâmetro, nome, valor padrão, comprimento
  WiFiManagerParameter custom_mqtt_server("server", "Servidor MQTT", servidor_mqtt, 40);
  WiFiManagerParameter custom_mqtt_port("port", "Porta", servidor_mqtt_porta, 6);
  WiFiManagerParameter custom_mqtt_user("user", "Usuario", servidor_mqtt_usuario, 20);
  WiFiManagerParameter custom_mqtt_pass("pass", "Senha", servidor_mqtt_senha, 20);
  WiFiManagerParameter custom_mqtt_topic_sub("topic_sub", "Topico para subscrever", mqtt_topico_sub, 40);

  //Inicialização do WiFiManager. Uma vez iniciado não é necessário mantê-lo em memória.
  WiFiManager wifiManager;

  //Definindo a função que informará a necessidade de salvar as configurações
  //wifiManager.setSaveConfigCallback(precisaSalvarCallback);
  
  //Adicionando os parâmetros para conectar ao servidor MQTT
  wifiManager.addParameter(&custom_mqtt_server);
  wifiManager.addParameter(&custom_mqtt_port);
  wifiManager.addParameter(&custom_mqtt_user);
  wifiManager.addParameter(&custom_mqtt_pass);
  wifiManager.addParameter(&custom_mqtt_topic_sub);

  //Busca o ID e senha da rede wifi e tenta conectar.
  //Caso não consiga conectar ou não exista ID e senha,
  //cria um access point com o nome "AutoConnectAP" e a senha "senha123"
  //E entra em loop aguardando a configuração de uma rede WiFi válida.
  if (!wifiManager.autoConnect("Automacao_Residencial", "268300")) {
     //Serial.println("Falha ao conectar. Excedeu o tempo limite para conexao.");
    delay(3000);
    //Reinicia o ESP e tenta novamente ou entra em sono profundo (DeepSleep)
    ESP.reset();
    delay(5000);
  }

  //Se chegou até aqui é porque conectou na WiFi!
  Serial.println("Conectado_WIFI,");

  //Lendo os parâmetros atualizados
  strcpy(servidor_mqtt, custom_mqtt_server.getValue());
  strcpy(servidor_mqtt_porta, custom_mqtt_port.getValue());
  strcpy(servidor_mqtt_usuario, custom_mqtt_user.getValue());
  strcpy(servidor_mqtt_senha, custom_mqtt_pass.getValue());
  strcpy(mqtt_topico_sub, custom_mqtt_topic_sub.getValue());

  //Salvando os parâmetros informados na tela web do WiFiManager
  if (precisaSalvar) {
     //Serial.println("Salvando as configuracoes");
    DynamicJsonBuffer jsonBuffer;
    JsonObject& json = jsonBuffer.createObject();
    json["servidor_mqtt"] = servidor_mqtt;
    json["servidor_mqtt_porta"] = servidor_mqtt_porta;
    json["servidor_mqtt_usuario"] = servidor_mqtt_usuario;
    json["servidor_mqtt_senha"] = servidor_mqtt_senha;
    json["mqtt_topico_sub"] = mqtt_topico_sub;

    File configFile = SPIFFS.open("/config.json", "w");
    if (!configFile) {
      // Serial.println("Houve uma falha ao abrir o arquivo de configuracao para incluir/alterar as configuracoes.");
    }

     //json.printTo(Serial);
     //json.printTo(configFile);
    configFile.close();
  }

   //Serial.println("IP: ");
  // Serial.println(WiFi.localIP().toString());

  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta);
  client.setServer(servidor_mqtt, portaInt);
  client.setCallback(atualizar_mensagem);
}


//Função de repetição (será executado INFINITAMENTE até o ESP ser desligado)
void loop() 
{
  while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   readString += c; 
  }
 
  // Se existir dados na serial **********************************************************************************************************************************************************
  if (readString.length() >0) 
  {
   String Mensagem_Enviar = {String(readString)}; 
   Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
   client.publish("dev/test/minhacasa/central", Funcoes); 
   readString ="";
  } // Fecha se existe dados na serial
  
  if (!client.connected()) 
  {
   reconectar();
  }

  AtualMillis = millis();    //Tempo atual em ms
  if (AtualMillis - UltimoMillis > intervalo) 
  { 
   UltimoMillis = AtualMillis;    // Salva o tempo atual
   disjuntor ++;
   if (disjuntor==4)
   {
    disjuntor = 1;
   }
   // imprimir();
  }
 
client.loop();

} // Fecha o void loop
