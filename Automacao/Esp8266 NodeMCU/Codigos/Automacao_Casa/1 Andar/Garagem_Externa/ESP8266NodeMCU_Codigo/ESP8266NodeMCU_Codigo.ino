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



//CLOUD MQTT
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "m11.cloudmqtt.com"  //URL do servidor MQTT
#define servidor_mqtt_porta       "10671"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "qjuidpsd"  //UsuÃ¡rio
#define servidor_mqtt_senha       "bUA07u8vEsPj"  //Senha
#define mqtt_topico_sub           "dev/test/garagem/externa/automacao"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/garagem/externa" 

char Corrente_Disj_Illuminacao_1[10];


/*
// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "casabrunog.ddns.luxvision.com.br"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/garagem/externa"    //TÃ³pico para publicar o comando de inverter o pino do outro ESP8266
#define TOPICO_PUBLISH   "dev/test/garagem/externa" 

*/








const char *Usuario     = "Bruno";
const char *Senha = "bruno268300";
WiFiUDP ntpUDP;
int16_t utc = -3; //UTC -3:00 Brazil

uint32_t TempoAtual = 0;
uint32_t UltimoTempo = 0;


int bloqueiaCarro1 = 0;
int bloqueiaCarro2 = 0;
int bloqueiaCarro3 = 0;

String segundo; 
String minuto;
String hora;
String horario;
int n_de_lampada = 0;
int LUZ_jardim_Horizontal = 0;

NTPClient TempoServidor(ntpUDP, "a.st1.ntp.br", utc*3600, 60000);



//Declaração do pino que será utilizado e a memória alocada para armazenar o status deste pino na EEPROM
#define pino1 14 // saida para carro 1
#define pino2 12  // saida para carro 2
#define pino3 13  // saida para carro 3

#define entrada1 16 // saida para carro 1
#define entrada2 5  // saida para carro 2
#define entrada3 4  // saida para carro 3

WiFiClient espClient;                                 //Instância do WiFiClient
PubSubClient client(espClient);                       //Passando a instância do WiFiClient para a instância do PubSubClient

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 60000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;



String readString;
String ultimaMsg1 = "teto_0";
String ultimaMsg2 = "pendente_0";
String ultimaMsg3 = "quadro_0";
String ultimaMsg4 = "muro_ch_0";
String ultimaMsg5 = "muro_ca_0";
String ultimaMsg6 = "jardim_h_0";
String ultimaMsg7 = "jardim_v_0";
String ultimaMsg8 = "desliga1";
String ultimaMsg9 = "desliga2";
String ultimaMsg10 = "desliga3";
String ultimaMsg11 = "area_0";
String ultimaMsg12 = "frente_0";





//Função que será chamada ao receber mensagem do servidor MQTT
void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();


//Serial.print("Chegou do MQTT: ");
//Serial.println(strMensagem);


if(strMensagem == "hora") // Desligar tudo
 {
  String String_Corrente_Disj_Illuminacao_1 = {String(hora)}; 
  String_Corrente_Disj_Illuminacao_1.toCharArray(Corrente_Disj_Illuminacao_1, String_Corrente_Disj_Illuminacao_1.length()+1); 
  client.publish("dev/test/garagem/externa",Corrente_Disj_Illuminacao_1);
  delay(100);
 }


if(strMensagem == "atualizar") // Desligar tudo
 {
 if (ultimaMsg1=="teto_0"){client.publish("dev/test/garagem/externa","teto_0");}
 if (ultimaMsg1=="teto_1"){client.publish("dev/test/garagem/externa","teto_1");}
 delay(100);
 if (ultimaMsg2=="pendente_0"){client.publish("dev/test/garagem/externa","pendente_0");}
 if (ultimaMsg2=="pendente_1"){client.publish("dev/test/garagem/externa","pendente_1");}
 delay(100);
 if (ultimaMsg3=="quadro_0"){client.publish("dev/test/garagem/externa","quadro_0");}
 if (ultimaMsg3=="quadro_1"){client.publish("dev/test/garagem/externa","quadro_1");}
 delay(100);
 if (ultimaMsg4=="muro_ch_0"){client.publish("dev/test/garagem/externa","muro_ch_0");}
 if (ultimaMsg4=="muro_ch_1"){client.publish("dev/test/garagem/externa","muro_ch_1");}
 delay(100);
 if (ultimaMsg5=="muro_ca_0"){client.publish("dev/test/garagem/externa","muro_ca_0");}
 if (ultimaMsg5=="muro_ca_1"){client.publish("dev/test/garagem/externa","muro_ca_1");}
 delay(100);
 if (ultimaMsg6=="jardim_h_0"){client.publish("dev/test/garagem/externa","jardim_h_0");LUZ_jardim_Horizontal = 0;}
 if (ultimaMsg6=="jardim_h_1"){client.publish("dev/test/garagem/externa","jardim_h_1");}
 delay(100);
 if (ultimaMsg7=="jardim_v_0"){client.publish("dev/test/garagem/externa","jardim_v_0");}
 if (ultimaMsg7=="jardim_v_1"){client.publish("dev/test/garagem/externa","jardim_v_1");}
 delay(100);
 if (ultimaMsg8=="liga1"){client.publish("dev/test/garagem/externa","liga1");}
 if (ultimaMsg8=="desliga1"){client.publish("dev/test/garagem/externa","desliga1");}
 delay(100);
 if (ultimaMsg9=="liga2"){client.publish("dev/test/garagem/externa","liga2");}
 if (ultimaMsg9=="desliga2"){client.publish("dev/test/garagem/externa","desliga2");}
 delay(100);
 if (ultimaMsg10=="liga3"){client.publish("dev/test/garagem/externa","liga3");}
 if (ultimaMsg10=="desliga3"){client.publish("dev/test/garagem/externa","desliga3");}
 delay(100);
 if (ultimaMsg11=="area_0"){client.publish("dev/test/garagem/externa","area_0");}
 if (ultimaMsg11=="area_1"){client.publish("dev/test/garagem/externa","area_1");}
 delay(100);
 if (ultimaMsg12=="frente_0"){client.publish("dev/test/garagem/externa","frente_0");}
 if (ultimaMsg12=="frente_1"){client.publish("dev/test/garagem/externa","frente_1");}
 delay(100);
 loop();
 }
 
 if(strMensagem == "all_0") // Desligar tudo
 {
  Serial.println("all_0");delay(100);
  digitalWrite(pino1, LOW);delay(100);
  digitalWrite(pino2, LOW);delay(100);
  digitalWrite(pino3, LOW);delay(100);
  client.publish("dev/test/garagem/externa", "teto_0");delay(100);ultimaMsg1 = "teto_0";
  client.publish("dev/test/garagem/externa", "pendente_0");delay(100);ultimaMsg2 = "pendente_0";
  client.publish("dev/test/garagem/externa", "quadro_0");delay(100);ultimaMsg3 = "quadro_0";
  client.publish("dev/test/garagem/externa", "muro_ch_0");delay(100);ultimaMsg4 = "muro_ch_0";
  client.publish("dev/test/garagem/externa", "muro_ca_0");delay(100);ultimaMsg5 = "muro_ca_0";
  client.publish("dev/test/garagem/externa", "jardim_h_0");LUZ_jardim_Horizontal = 0;delay(100);ultimaMsg6 = "jardim_h_0";
  client.publish("dev/test/garagem/externa", "jardim_v_0");delay(100);ultimaMsg7 = "jardim_v_0";
  client.publish("dev/test/garagem/externa", "desliga1");delay(100);ultimaMsg8 = "desligar1";
  client.publish("dev/test/garagem/externa", "desliga2");delay(100);ultimaMsg9 = "desligar2";
  client.publish("dev/test/garagem/externa", "desliga3");delay(100);ultimaMsg10 = "desligar3";
  client.publish("dev/test/garagem/externa", "area_0");delay(100);ultimaMsg11 = "area_0";
  client.publish("dev/test/garagem/externa", "frente_0");delay(100);ultimaMsg12 = "frente_0";
 }
 
 if(strMensagem == "teto_0"){Serial.println("teto_0");ultimaMsg1 = "teto_0";}
 if(strMensagem == "teto_1"){Serial.println("teto_1");ultimaMsg1 = "teto_1";}
 
 if(strMensagem == "pendente_0"){Serial.println("pendente_0");ultimaMsg2 = "pendente_0";}
 if(strMensagem == "pendente_1"){Serial.println("pendente_1");ultimaMsg2 = "pendente_1";}
 
 if(strMensagem == "quadro_0"){Serial.println("quadro_0");ultimaMsg3 = "quadro_0";}
 if(strMensagem == "quadro_1"){Serial.println("quadro_1");ultimaMsg3 = "quadro_1";}
 
 if(strMensagem == "muro_ch_0"){Serial.println("muro_ch_0");ultimaMsg4 = "muro_ch_0";}
 if(strMensagem == "muro_ch_1"){Serial.println("muro_ch_1");ultimaMsg4 = "muro_ch_1";}
 
 if(strMensagem == "muro_ca_0"){Serial.println("muro_ca_0");ultimaMsg5 = "muro_ca_0";}
 if(strMensagem == "muro_ca_1"){Serial.println("muro_ca_1");ultimaMsg5 = "muro_ca_1";}
 
 if(strMensagem == "jardim_h_0"){Serial.println("jardim_h_0");ultimaMsg6 = "jardim_h_0";LUZ_jardim_Horizontal = 0;}
 if(strMensagem == "jardim_h_1"){Serial.println("jardim_h_1");ultimaMsg6 = "jardim_h_1";LUZ_jardim_Horizontal = 1;}
 
 if(strMensagem == "jardim_v_0"){Serial.println("jardim_v_0");ultimaMsg7 = "jardim_v_0";}
 if(strMensagem == "jardim_v_1"){Serial.println("jardim_v_1");ultimaMsg7 = "jardim_v_1";}
 
 if(strMensagem == "area_0"){Serial.println("area_0");ultimaMsg11 = "area_0";}
 if(strMensagem == "area_1"){Serial.println("area_1");ultimaMsg11 = "area_1";}
 
 if(strMensagem == "frente_0"){Serial.println("frente_0");ultimaMsg12 = "frente_0";}
 if(strMensagem == "frente_1"){Serial.println("frente_1");ultimaMsg12 = "frente_1";}

// COMANDO PARA GARAGEM 01
 if(strMensagem == "portg1" && digitalRead(pino1)== LOW && ( hora=="18" || hora=="19" || hora=="20" || hora=="21"|| hora=="22"|| hora=="23"|| hora=="00"|| hora=="01"|| hora=="02"|| hora=="03"|| hora=="04"|| hora=="05"))
 {
  digitalWrite(pino1, HIGH);
  client.publish("dev/test/garagem/externa", "liga1");delay(100);
  ultimaMsg8 = "ligar1";
  Serial.println("muro_ca_1");
  ultimaMsg5 = "muro_ca_1";
  client.publish("dev/test/garagem/externa", "muro_ca_1");delay(100);
 }



// COMANDO PARA GARAGEM 02
 if(strMensagem == "portg2" && digitalRead(pino2)== LOW && ( hora=="18" || hora=="19" || hora=="20" || hora=="21"|| hora=="22"|| hora=="23"|| hora=="00"|| hora=="01"|| hora=="02"|| hora=="03"|| hora=="04"|| hora=="05"))
 {
  digitalWrite(pino2, HIGH);
  client.publish("dev/test/garagem/externa", "liga2");delay(100);
  ultimaMsg9 = "ligar2";
  Serial.println("muro_ca_1");
  ultimaMsg5 = "muro_ca_1";
  client.publish("dev/test/garagem/externa", "muro_ca_1");delay(100);
 }
 // COMANDO PARA GARAGEM 03
 if(strMensagem == "portg3" && digitalRead(pino3)== LOW && ( hora=="18" || hora=="19" || hora=="20" || hora=="21"|| hora=="22"|| hora=="23"|| hora=="00"|| hora=="01"|| hora=="02"|| hora=="03"|| hora=="04"|| hora=="05"))
 {
  digitalWrite(pino3, HIGH);
  client.publish("dev/test/garagem/externa", "liga3");delay(100);
  ultimaMsg10 = "ligar3";
  Serial.println("muro_ca_1");
  ultimaMsg5 = "muro_ca_1";
  client.publish("dev/test/garagem/externa", "muro_ca_1");delay(100);
 }
 if(strMensagem == "carros")
 {
  if(digitalRead(pino1)==HIGH) {n_de_lampada++;}
  if(digitalRead(pino2)==HIGH) {n_de_lampada++;}
  if(digitalRead(pino3)==HIGH) {n_de_lampada++;}
  
  if (digitalRead(pino1)==LOW && digitalRead(pino2)==LOW && digitalRead(pino3)==LOW&&n_de_lampada==0 )
  {
   digitalWrite(pino1, HIGH);
   digitalWrite(pino2, HIGH);
   digitalWrite(pino3, HIGH);
   client.publish("dev/test/garagem/externa", "liga1");delay(100);
   client.publish("dev/test/garagem/externa", "liga2");delay(100);
   client.publish("dev/test/garagem/externa", "liga3");delay(100);
   n_de_lampada = 50;
  }
  if (n_de_lampada ==1 || ( (digitalRead(pino1)==HIGH && digitalRead(pino2) == HIGH && digitalRead(pino3) == HIGH ) && n_de_lampada!=50 ) )
  {
  digitalWrite(pino1, LOW);
  digitalWrite(pino2, LOW);
  digitalWrite(pino3, LOW);
  client.publish("dev/test/garagem/externa", "desliga1");delay(100);
  client.publish("dev/test/garagem/externa", "desliga2");delay(100);
  client.publish("dev/test/garagem/externa", "desliga3");delay(100);
  n_de_lampada = 0;
  }
  if ( n_de_lampada ==2)
  {
  digitalWrite(pino1, HIGH);
  digitalWrite(pino2, HIGH);
  digitalWrite(pino3, HIGH);
  client.publish("dev/test/garagem/externa", "liga1");delay(100);
  client.publish("dev/test/garagem/externa", "liga2");delay(100);
  client.publish("dev/test/garagem/externa", "liga3");delay(100);
  n_de_lampada = 0;
  }
 n_de_lampada = 0;
}

// Verifica a mensagem e atualiza saida carro 1 ***************************************************************************************************************************************
  if(strMensagem == "liga1" && digitalRead(pino1)== LOW) 
  {
  digitalWrite(pino1, HIGH);
  ultimaMsg8 = "liga1";
  }

  if(strMensagem == "desliga1" && digitalRead(pino1)== HIGH)
  {
   digitalWrite(pino1, LOW);
   ultimaMsg8 = "desliga1";
  }
 
// Verifica a mensagem e atualiza saida carro 2 ***************************************************************************************************************************************
 if(strMensagem == "liga2" && digitalRead(pino2)== LOW)
 {
  digitalWrite(pino2, HIGH);
  ultimaMsg9 = "liga2";
 }
 if(strMensagem == "desliga2" && digitalRead(pino2)== HIGH)
 {
  digitalWrite(pino2, LOW);
  ultimaMsg9 = "desliga2";
 }
 

// Verifica a mensagem e atualiza saida carro 3 ***************************************************************************************************************************************
 if(strMensagem == "liga3" && digitalRead(pino3)== LOW)
 {
  digitalWrite(pino3, HIGH);
  ultimaMsg10 = "liga3";
 }
 if(strMensagem == "desliga3" && digitalRead(pino3)== HIGH)
 {
  digitalWrite(pino3, LOW);
  ultimaMsg10 = "desliga3";
 }
 
} //fecha recebe mensagem

//Função de atualizar_mensagem para notificar sobre a necessidade de salvar as configurações
void precisaSalvarCallback() {
  Serial.println("As configuracoes tem que ser salvas.");
  precisaSalvar = true;
}





//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("ESP8266Client", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("ESP8266Client");

    if(conectado) {
      Serial.println("Conectado!");
      //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Falhou ao tentar conectar. Codigo: ");
      Serial.println(String(client.state()).c_str());
      Serial.println(" tentando novamente em 5 segundos");
      //Aguarda 5 segundos para tentar novamente
      delay(5000);
    }
  }
}










void forceUpdate(void) 
{
 TempoServidor.forceUpdate();
}



//Função inicial (será executado SOMENTE quando ligar o ESP)
void setup() 
{
  Serial.begin(9600);

  //Fazendo o pino ser de saída, pois ele irá "controlar" algo.
  pinMode(pino1, OUTPUT);
  pinMode(pino2, OUTPUT);
  pinMode(pino3, OUTPUT);
  digitalWrite(pino1,0);
  digitalWrite(pino2,0);
  digitalWrite(pino3,0);
  pinMode(entrada1, INPUT);
  pinMode(entrada2, INPUT);
  pinMode(entrada3, INPUT);


  //Iniciando o SPIFSS (SPI Flash File System)
  Serial.println("Iniciando o SPIFSS (SPI Flash File System)");
  if (SPIFFS.begin()) {
    Serial.println("Sistema de arquivos SPIFSS montado!");
    if (SPIFFS.exists("/config.json")) {
      //Arquivo de configuração existe e será lido.
      Serial.println("Abrindo o arquivo de configuracao...");
      File configFile = SPIFFS.open("/config.json", "r");
      if (configFile) {
        Serial.println("Arquivo de configuracao aberto.");
        size_t size = configFile.size();
        
        //Alocando um buffer para armazenar o conteúdo do arquivo.
        std::unique_ptr<char[]> buf(new char[size]);

        configFile.readBytes(buf.get(), size);
        DynamicJsonBuffer jsonBuffer;
        JsonObject& json = jsonBuffer.parseObject(buf.get());
        json.printTo(Serial);
        if (json.success()) {
            //Copiando as variáveis salvas previamente no aquivo json para a memória do ESP.
            Serial.println("arquivo json analisado.");
            strcpy(servidor_mqtt, json["servidor_mqtt"]);
            strcpy(servidor_mqtt_porta, json["servidor_mqtt_porta"]);
            strcpy(servidor_mqtt_usuario, json["servidor_mqtt_usuario"]);
            strcpy(servidor_mqtt_senha, json["servidor_mqtt_senha"]);
            strcpy(mqtt_topico_sub, json["mqtt_topico_sub"]);

        } else {
          Serial.println("Falha ao ler as configuracoes do arquivo json.");
        }
      }
    }
  } else {
    Serial.println("Falha ao montar o sistema de arquivos SPIFSS.");
  }
  //Fim da leitura do sistema de arquivos SPIFSS

  //Parâmetros extras para configuração
  //Depois de conectar, parameter.getValue() vai pegar o valor configurado.
  //Os campos do WiFiManagerParameter são: id do parâmetro, nome, valor padrão, comprimento
  WiFiManagerParameter custom_mqtt_server("server", "Servidor MQTT", servidor_mqtt, 40);
  WiFiManagerParameter custom_mqtt_port("port", "Porta", servidor_mqtt_porta, 6);
  WiFiManagerParameter custom_mqtt_user("user", "Usuario", servidor_mqtt_usuario, 20);
  WiFiManagerParameter custom_mqtt_pass("pass", "Senha", servidor_mqtt_senha, 20);
  WiFiManagerParameter custom_mqtt_topic_sub("topic_sub", "Topico para subscrever", mqtt_topico_sub, 30);

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
    Serial.println("Falha ao conectar. Excedeu o tempo limite para conexao.");
    delay(3000);
    //Reinicia o ESP e tenta novamente ou entra em sono profundo (DeepSleep)
    ESP.reset();
    delay(5000);
  }

  //Se chegou até aqui é porque conectou na WiFi!
  Serial.println("Conectado!! :)");

  //Lendo os parâmetros atualizados
  strcpy(servidor_mqtt, custom_mqtt_server.getValue());
  strcpy(servidor_mqtt_porta, custom_mqtt_port.getValue());
  strcpy(servidor_mqtt_usuario, custom_mqtt_user.getValue());
  strcpy(servidor_mqtt_senha, custom_mqtt_pass.getValue());
  strcpy(mqtt_topico_sub, custom_mqtt_topic_sub.getValue());

  //Salvando os parâmetros informados na tela web do WiFiManager
  if (precisaSalvar) {
    Serial.println("Salvando as configuracoes");
    DynamicJsonBuffer jsonBuffer;
    JsonObject& json = jsonBuffer.createObject();
    json["servidor_mqtt"] = servidor_mqtt;
    json["servidor_mqtt_porta"] = servidor_mqtt_porta;
    json["servidor_mqtt_usuario"] = servidor_mqtt_usuario;
    json["servidor_mqtt_senha"] = servidor_mqtt_senha;
    json["mqtt_topico_sub"] = mqtt_topico_sub;

    File configFile = SPIFFS.open("/config.json", "w");
    if (!configFile) {
      Serial.println("Houve uma falha ao abrir o arquivo de configuracao para incluir/alterar as configuracoes.");
    }

    json.printTo(Serial);
    json.printTo(configFile);
    configFile.close();
  }

  Serial.println("IP: ");
  Serial.println(WiFi.localIP().toString());

  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta);
  client.setServer(servidor_mqtt, portaInt);
  client.setCallback(atualizar_mensagem);
  
 
  // Executa mesmo comando do all_0
  Serial.println("all_0");delay(100);
  digitalWrite(pino1, LOW);delay(100);
  digitalWrite(pino2, LOW);delay(100);
  digitalWrite(pino3, LOW);delay(100);
  
  client.publish("dev/test/garagem/externa", "teto_0");delay(100);ultimaMsg1 = "teto_0";
  client.publish("dev/test/garagem/externa", "pendente_0");delay(100);ultimaMsg2 = "pendente_0";
  client.publish("dev/test/garagem/externa", "quadro_0");delay(100);ultimaMsg3 = "quadro_0";
  client.publish("dev/test/garagem/externa", "muro_ch_0");delay(100);ultimaMsg4 = "muro_ch_0";
  client.publish("dev/test/garagem/externa", "muro_ca_0");delay(100);ultimaMsg5 = "muro_ca_0";
  client.publish("dev/test/garagem/externa", "jardim_h_0");delay(100);ultimaMsg6 = "jardim_h_0";
  client.publish("dev/test/garagem/externa", "jardim_v_0");delay(100);ultimaMsg7 = "jardim_v_0";
  client.publish("dev/test/garagem/externa", "desliga1");delay(100);ultimaMsg8 = "desligar1";
  client.publish("dev/test/garagem/externa", "desliga2");delay(100);ultimaMsg9 = "desligar2";
  client.publish("dev/test/garagem/externa", "desliga3");delay(100);ultimaMsg10 = "desligar3";
  client.publish("dev/test/garagem/externa", "area_0");delay(100);ultimaMsg11 = "area_0";
  client.publish("dev/test/garagem/externa", "frente_0");delay(100);ultimaMsg12 = "frente_0";

  
 TempoServidor.begin();
 TempoServidor.update();

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
  if (readString.indexOf("teto_0")>=0){client.publish("dev/test/garagem/externa", "teto_0");delay(100);ultimaMsg1 = "teto_0";}
  if (readString.indexOf("teto_1")>=0){client.publish("dev/test/garagem/externa", "teto_1");delay(100);ultimaMsg1 = "teto_1";}
  
  if (readString.indexOf("pendente_0")>=0){client.publish("dev/test/garagem/externa", "pendente_0");delay(100);ultimaMsg2 = "pendente_0";}
  if (readString.indexOf("pendente_1")>=0){client.publish("dev/test/garagem/externa", "pendente_1");delay(100);ultimaMsg2 = "pendente_1";}
  
  if (readString.indexOf("quadro_0")>=0){client.publish("dev/test/garagem/externa", "quadro_0");delay(100);ultimaMsg3 = "quadro_0";}
  if (readString.indexOf("quadro_1")>=0){client.publish("dev/test/garagem/externa", "quadro_1");delay(100);ultimaMsg3 = "quadro_1";}

  if (readString.indexOf("muro_ch_0")>=0){client.publish("dev/test/garagem/externa", "muro_ch_0");delay(100);ultimaMsg4 = "muro_ch_0";}
  if (readString.indexOf("muro_ch_1")>=0){client.publish("dev/test/garagem/externa", "muro_ch_1");delay(100);ultimaMsg4 = "muro_ch_1";}

  if (readString.indexOf("muro_ca_0")>=0){client.publish("dev/test/garagem/externa", "muro_ca_0");delay(100);ultimaMsg5 = "muro_ca_0";}
  if (readString.indexOf("muro_ca_1")>=0){client.publish("dev/test/garagem/externa", "muro_ca_1");delay(100);ultimaMsg5 = "muro_ca_1";}
  
  if (readString.indexOf("jardim_h_0")>=0){client.publish("dev/test/garagem/externa", "jardim_h_0");delay(100);ultimaMsg6 = "jardim_h_0";}
  if (readString.indexOf("jardim_h_1")>=0){client.publish("dev/test/garagem/externa", "jardim_h_1");delay(100);ultimaMsg6 = "jardim_h_1";}
  
  if (readString.indexOf("jardim_v_0")>=0){client.publish("dev/test/garagem/externa", "jardim_v_0");delay(100);ultimaMsg7 = "jardim_v_0";}
  if (readString.indexOf("jardim_v_1")>=0){client.publish("dev/test/garagem/externa", "jardim_v_1");delay(100);ultimaMsg7 = "jardim_v_1";}
  
  if (readString.indexOf("area_0")>=0){client.publish("dev/test/garagem/externa", "area_0");delay(100);ultimaMsg11 = "area_0";}
  if (readString.indexOf("area_1")>=0){client.publish("dev/test/garagem/externa", "area_1");delay(100);ultimaMsg11 = "area_1";}

  if (readString.indexOf("frente_0")>=0){client.publish("dev/test/garagem/externa", "frente_0");delay(100);ultimaMsg12 = "frente_0";}
  if (readString.indexOf("frente_1")>=0){client.publish("dev/test/garagem/externa", "frente_1");delay(100);ultimaMsg12 = "frente_1";}
 
 
 
 readString ="";
 } // Fecha se existe dados na serial
  
  
  if (!client.connected()) 
  {
   reconectar();
  }







// Interruptor carro 1 *********************************************************************************************************************************************************************
if ( digitalRead(entrada1)==1 )
{
 while(digitalRead(entrada1)==1)
 {
 delay(500);
 }
 digitalWrite(pino1,!digitalRead(pino1));
 if(digitalRead(pino1)==1){client.publish("dev/test/garagem/externa", "liga1");ultimaMsg8 = "liga1";}
 if(digitalRead(pino1)==0){client.publish("dev/test/garagem/externa", "desliga1");ultimaMsg8 = "desliga1";}
 
}

// Interruptor carro 2 *********************************************************************************************************************************************************************
if ( digitalRead(entrada2)==1 )
{
 while(digitalRead(entrada2)==1)
 {
 delay(500);
 }
 digitalWrite(pino2,!digitalRead(pino2));
 if(digitalRead(pino2)==1){client.publish("dev/test/garagem/externa", "liga2");ultimaMsg9 = "liga2";}
 if(digitalRead(pino2)==0){client.publish("dev/test/garagem/externa", "desliga2");ultimaMsg9 = "desliga2";}
}

// Interruptor carro 3 *********************************************************************************************************************************************************************
 if ( digitalRead(entrada3)==1 )
 {
 while(digitalRead(entrada3)==1)
 {
  delay(500);
 }
  digitalWrite(pino3,!digitalRead(pino3));
  if(digitalRead(pino3)==1){client.publish("dev/test/garagem/externa", "liga3");ultimaMsg10 = "liga3";}
  if(digitalRead(pino3)==0){client.publish("dev/test/garagem/externa", "desliga3");ultimaMsg10 = "desliga3";}
 }


 AtualMillis = millis();    //Tempo atual em ms
 
 


 if (AtualMillis - UltimoMillis > intervalo) 
 { 
  UltimoMillis = AtualMillis;    // Salva o tempo atual
  horario = TempoServidor.getFormattedTime();
  hora = ((horario.substring(0, 2)).toInt());
 }
  // COMANDO PARA LIGAR LUZ DO JARDIM HORIZONTAL 
  if(hora=="18" && LUZ_jardim_Horizontal==0)
  {
   Serial.println("jardim_h_1");
   ultimaMsg6 = "jardim_h_1";
   LUZ_jardim_Horizontal = 1;
  }
  if(hora=="23" && LUZ_jardim_Horizontal == 1)
  {
   Serial.println("jardim_h_0");
   ultimaMsg6 = "jardim_h_0";
   LUZ_jardim_Horizontal = 0;
  }
 client.loop();
} // Fecha o void loop

