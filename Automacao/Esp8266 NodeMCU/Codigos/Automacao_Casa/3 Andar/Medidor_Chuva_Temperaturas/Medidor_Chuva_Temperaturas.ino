/* 
 *  
 *  MEDIDOR DE CHUVA,INTENSIDADE E TEMPERATURA AMBIENTE E BOILER COM ESP8266 NODEMCU
 * 
 * Pode ser alimentado em 3.3V ou 5V - Para o ESP8266 Alimentar com 3.3V
 *  
 * Usar um resistor de 5K ( 2 de 10K em paralelo ) entre o vermelho (VCC) e o sinal ( Amarelo )
 * 
 * Codigo para monitorar dois sensores de temperatura DS18B20
 * Codigo padrao para atualizar via ota - web service arquivo .bin
 * 
 * 
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 
 */
#include <PubSubClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>
#include <OneWire.h> //INCLUSÃO DE BIBLIOTECA
#include <DallasTemperature.h> //INCLUSÃO DE BIBLIOTECA
#define DS18B20 4 // D2 - DEFINE O PINO DIGITAL UTILIZADO PELO SENSOR

#define led 12 // D6
#define Led_Wifi 9
OneWire ourWire(DS18B20); //CONFIGURA UMA INSTÂNCIA ONEWIRE PARA SE COMUNICAR COM O SENSOR
DallasTemperature sensors(&ourWire); //BIBLIOTECA DallasTemperature UTILIZA A OneWire

const char *Usuario     = "AutomacaoLOG2";
const char *Senha = "logistica2019@";
String local = "sensor_chuva";
String intensidade = "";

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/monitor_chuva/sensor_chuva"    //  PARA TROCAR SELECIONAR "arvore_natal" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx
#define TOPICO_PUBLISH   "dev/test/minhacasa/monitor_chuva/status/sensor_chuva"

String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];


IPAddress staticIP(192, 168, 20, 174);
IPAddress gateway(192, 168, 20, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient sensor_chuva;                                 //Instância do WiFiClient
PubSubClient client(sensor_chuva);                       //Passando a instância do WiFiClient para a instância do PubSubClient

ESP8266HTTPUpdateServer atualizadorOTA_sensor_chuva; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_sensor_chuva(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Monitor temperaturas e chuva";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";

bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;


 
int pino_d = 14; //Pino ligado ao D0 do sensor
int pino_a = A0; //Pino ligado ao A0 do sensor

unsigned long contador = 0;

int val_d = 0; //Armazena o valor lido do pino digital
int val_a = 0; //Armazena o valor lido do pino analogico




void ConectarWIFI()
{
 WiFi.mode(WIFI_STA);
 WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara);
 if (WiFi.status() != WL_CONNECTED)
 {
  delay(500);
  Serial.print(".");
 }
 Serial.println("");
 Serial.println("WiFi conectado com");
 Serial.println("IP: ");
 Serial.println(WiFi.localIP());
 Serial.println("");
 valor_ip = WiFi.localIP().toString();
 mac = WiFi.macAddress();
 Pagina();
}// Fecha void ConectarWIFI


void Pagina()
{
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DADOS QUE SERAO EXIBIDOS NO SITE

  paginaWeb = ""
  "<!DOCTYPE html><html>"
  "<head>"
  "<title>OTA</title>"
  "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
  "<meta charset='UTF-8'>"
  "<meta http-equiv='X-UA-Compatible' content='IE=edge'>"
  "</head>"
  "<body style='margin: 20px; padding: 0px; background-color: #ADD8E6'>"
    "<h1 style='color: #00008B'>"+titulo+"</h1>"
    "<h3>IP: " + valor_ip + "</h3>"
    "<h3>MAC: " + mac + "</h3>"  
    "<h3>Para atualizar o sketch basta abrir <a href='http://"+valor_ip+"/update'>http://"+valor_ip+"/update</a> e pressionar enter!</h3>" 
    "<footer>Desenvolvido por Bruno Gonçalves </footer>"
  "</body>"
  "</html>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  servidorWeb_sensor_chuva.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_sensor_chuva.send(200, "text/html", paginaWeb);}




void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho)
{
  //Convertendo a mensagem recebida para string
  mensagem[tamanho] = '\0';
  String strMensagem = String((char*)mensagem);
  strMensagem.toLowerCase();
  //Serial.print("Chegou do MQTT: ");
  String Enviar;

  Enviar = "";
  Enviar = strMensagem;
  Serial.println(Enviar);
  //if(Enviar == "ligar")
  //{
  // client.publish("dev/test/minhacasa/status_arvore", "ligada");
  //}
  

} //fecha recebe mensagem
 
 
void setup()
{
 pinMode(pino_d, INPUT);
 pinMode(pino_a, INPUT);
 pinMode(led,OUTPUT);
 digitalWrite(led,LOW);
 Serial.begin(115200);
 pinMode(Led_Wifi,OUTPUT);
 digitalWrite(Led_Wifi,LOW);
 delay(2000);

 ConectarWIFI();
  
 digitalWrite(Led_Wifi,HIGH);
 Serial.println("");
 //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
 sensors.begin(); //INICIA O SENSOR
 delay(1000); //INTERVALO DE 1 SEGUNDO
  
 // Iniciar servidor atualizacao OTA
 atualizadorOTA_sensor_chuva.setup(&servidorWeb_sensor_chuva);
 servidorWeb_sensor_chuva.begin();
  
}//Fecha void setup

//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  if (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("sensor_chuva", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("sensor_chuva");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
    }
  }
} 
void loop()
{

 // VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 if(WiFi.status() != WL_CONNECTED) 
 {
  ConectarWIFI();
 }
 else
 {
  servidorWeb_sensor_chuva.handleClient();
 }

 if ( contador >=2000000 ) // +/- 30 segundos 
 {
  digitalWrite(led,HIGH);
  sensors.requestTemperatures();//SOLICITA QUE A FUNÇÃO INFORME A TEMPERATURA DO SENSOR
  Serial.print("Temperatura: "); //IMPRIME O TEXTO NA SERIAL
  Serial.print(sensors.getTempCByIndex(0)); //IMPRIME NA SERIAL O VALOR DE TEMPERATURA MEDIDO // Primeiro Sensor
  Serial.print( " - " );
  Serial.print(sensors.getTempCByIndex(1)); //IMPRIME NA SERIAL O VALOR DE TEMPERATURA MEDIDO // Segundo Sensor
  Serial.println("*C"); //IMPRIME O TEXTO NA SERIAL
  String temp1 = String(sensors.getTempCByIndex(0));
  Mensagem_Enviar = temp1;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/minhacasa/monitor_temperatura/status/temp1", Funcoes);
  delay(100);
  String temp2 = String(sensors.getTempCByIndex(1));
  Mensagem_Enviar = temp2;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/minhacasa/monitor_temperatura/status/temp2", Funcoes);
  //Le e arnazena o valor do pino digital
  val_d = digitalRead(pino_d);
  //Le e armazena o valor do pino analogico
  val_a = analogRead(pino_a);
  //Envia as informacoes para o serial monitor
  Serial.print("Valor digital : ");
  Serial.print(val_d);
  Serial.print(" - Valor analogico : ");
  Serial.println(val_a);
  contador = 0;
  //Mostra no display se ha chuva ou nao
  if (val_d == 1)
  {
   Serial.println("Chuva : Nao");
  }
  else
  {
   Serial.println("Chuva : Sim");
  }
  // Intensidade da chuva
  if (val_a >900 && val_a <=1024)
  {
   intensidade = "Nao esta chovendo!";
   Serial.print("Intensidade : ");
   Serial.println(intensidade);
  }
  else if (val_a >600 && val_a <900)
  {
   intensidade = "Fraca";
   Serial.print("Intensidade : ");
   Serial.println(intensidade);
  }
  else if (val_a >400 && val_a <600)
  {
   intensidade = "Moderada";
   Serial.print("Intensidade : ");
   Serial.println(intensidade);
  }
  else if (val_a <400)
  {
   intensidade = "Forte";
   Serial.print("Intensidade : ");
   Serial.println(intensidade);
  }
   
   // Publica valores
   if( intensidade == "")
   {
    intensidade = "Nao esta chovendo!";
   }
   String v_intensidade = String(intensidade);
   Mensagem_Enviar = v_intensidade;
   Serial.print("Intensidade = ");
   Serial.println(v_intensidade);
   Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
   client.publish("dev/test/minhacasa/monitor_chuva/status/intensidade", Funcoes);
   delay(100);
   String valor = String(val_a);
   Mensagem_Enviar = valor;
   Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
   client.publish("dev/test/minhacasa/monitor_chuva/status/valor", Funcoes);
   delay(100);
   if (val_d == 1)
   {
    client.publish("dev/test/minhacasa/monitor_chuva/status/chuva2", "Nao");
   }
   else
   {
    client.publish("dev/test/minhacasa/monitor_chuva/status/chuva2", "Sim");
   }
   delay(100);
   digitalWrite(led,LOW);    
  } // Fecha contador
  contador++;
 if (!client.connected())
  {
    reconectar();
  }

  client.loop();
}//Fecha void loop
