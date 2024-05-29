/*
 * CODIGO USADO PARA CONTROLAR A ILUMINAÇÃO RGB DO CORREDOR - ESP8266 
 * Codigo padrao para atualizar via ota - web service arquivo .bin
 *  
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 
 * 
 */
#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>
#include <PubSubClient.h>

IPAddress staticIP(192, 168, 20, 92);
IPAddress gateway(192, 168, 20, 1);
IPAddress mascara(255, 255, 255, 0);

const char* Usuario = "AutomacaoLOG";
const char* Senha = "logistica2019@";
const PROGMEM char* MQTT_CLIENT_ID = "geladeira_rgb";
const PROGMEM char* MQTT_SERVER_IP = "192.168.3.186";
const PROGMEM uint16_t MQTT_SERVER_PORT = 1883;
const PROGMEM char* MQTT_USER = "brunogon";
const PROGMEM char* MQTT_PASSWORD = "268300";

// MQTT: Topicos
// Estado
const PROGMEM char* MQTT_LIGHT_STATE_TOPIC = "dev/test/minhacasa/cz/geladeira/status";
const PROGMEM char* MQTT_LIGHT_COMMAND_TOPIC = "dev/test/minhacasa/cz/geladeira/comando";

// Brilho
const PROGMEM char* MQTT_LIGHT_BRIGHTNESS_STATE_TOPIC = "dev/test/minhacasa/cz/geladeira/brilho/status";
const PROGMEM char* MQTT_LIGHT_BRIGHTNESS_COMMAND_TOPIC = "dev/test/minhacasa/cz/geladeira/brilho/setar";

// Cores(rgb)
const PROGMEM char* MQTT_LIGHT_RGB_STATE_TOPIC = "dev/test/minhacasa/cz/geladeira/rgb/status";
const PROGMEM char* MQTT_LIGHT_RGB_COMMAND_TOPIC = "dev/test/minhacasa/cz/geladeira/rgb/setar";

// Atribui valor Payload para a variavel - Neste caso o default que e ON e OFF
const PROGMEM char* Lampada_Ligada = "ON";
const PROGMEM char* Lampada_Desligada = "OFF";

// Variaveis usadas para guardar o valor das cores e brilho
boolean m_rgb_state = false;
uint8_t m_rgb_brightness = 100;
uint8_t m_rgb_red = 255;
uint8_t m_rgb_green = 255;
uint8_t m_rgb_blue = 255;

// Define os pinos ligados aos TIP120 - Saidas PWM
const PROGMEM uint8_t RGB_LIGHT_RED_PIN = 5;//D1
const PROGMEM uint8_t RGB_LIGHT_GREEN_PIN = 14; //D5
const PROGMEM uint8_t RGB_LIGHT_BLUE_PIN = 4; // D2

// Variaveis de BUFFER para envio e recepcao do MQTT
const uint8_t MSG_BUFFER_SIZE = 20;
char m_msg_buffer[MSG_BUFFER_SIZE]; 

WiFiClient geladeira_rgb;
PubSubClient client(geladeira_rgb);


ESP8266HTTPUpdateServer atualizadorOTA_geladeira_rgb; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_geladeira_rgb(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Controlador RGB da Geladeira da Cozinha";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";



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

  
  servidorWeb_geladeira_rgb.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_geladeira_rgb.send(200, "text/html", paginaWeb);}

// Funcao para atribuir o brilho mantendo a cor
void setColor(uint8_t p_red, uint8_t p_green, uint8_t p_blue) 
{
 // Faz o map do brilho de 0 a 100 para a saida da cor de 0 a 255
  uint8_t brilho = map(m_rgb_brightness, 0, 100, 0, 255);
  analogWrite(RGB_LIGHT_RED_PIN, map(p_red, 0, 255, 0, brilho));
  analogWrite(RGB_LIGHT_GREEN_PIN, map(p_green, 0, 255, 0, brilho));
  analogWrite(RGB_LIGHT_BLUE_PIN, map(p_blue, 0, 255, 0, brilho));
}

// function called to publish the state of the led (on/off)
void publishRGBState() {
  if (m_rgb_state) {
    client.publish(MQTT_LIGHT_STATE_TOPIC, Lampada_Ligada, true);
  } else {
    client.publish(MQTT_LIGHT_STATE_TOPIC, Lampada_Desligada, true);
  }
}

// function called to publish the brightness of the led (0-100)
void publishRGBBrightness() {
  snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d", m_rgb_brightness);
  client.publish(MQTT_LIGHT_BRIGHTNESS_STATE_TOPIC, m_msg_buffer, true);
}

//Publica o valor das cores
void publishRGBColor() 
{
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d,%d,%d", m_rgb_red, m_rgb_green, m_rgb_blue);
 client.publish(MQTT_LIGHT_RGB_STATE_TOPIC, m_msg_buffer, true); //Publica para alternar no supervisorio a lampada
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d", m_rgb_red);
 client.publish("dev/test/minhacasa/cz/geladeira/red",m_msg_buffer);//Publica o valor de vermelho
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d", m_rgb_green);
 client.publish("dev/test/minhacasa/cz/geladeira/green",m_msg_buffer);//Publica o valor de verde
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d", m_rgb_blue);
 client.publish("dev/test/minhacasa/cz/geladeira/blue",m_msg_buffer);//Publica o valor de azul
}

//Funcao para tratar o dado recebido pelo MQTT
void callback(char* p_topic, byte* p_payload, unsigned int p_length) 
{
 // Concatena o payload ate formar a string de recepcao
 String payload;
 for (uint8_t i = 0; i < p_length; i++) 
 {
  payload.concat((char)p_payload[i]);
 }
 // Tratando a mensagem de recepcao
 if (String(MQTT_LIGHT_COMMAND_TOPIC).equals(p_topic)) 
 {
  //Faz o teste de verificacao se a string e igual ao valor setado no envio "ON" or "OFF" - Neste caso o payload default do HA para light
  if (payload.equals(String(Lampada_Ligada))) 
  {
   if (m_rgb_state != true) 
   {
    m_rgb_state = true;
    setColor(m_rgb_red, m_rgb_green, m_rgb_blue);
    publishRGBState();
   }
  }
  else if (payload.equals(String(Lampada_Desligada))) 
  {
   if (m_rgb_state != false) 
   {
    m_rgb_state = false;
    setColor(0, 0, 0);
    publishRGBState();
   }
  }
 }
 else if (String(MQTT_LIGHT_BRIGHTNESS_COMMAND_TOPIC).equals(p_topic)) 
 {
  uint8_t brightness = payload.toInt();
  if (brightness < 0 || brightness > 100) 
  {
   // Ignora pois o valor esta fora do range 0 a 100
   return;
  }
  else // Atualiza o brilho pois esta no range valido
  {
   m_rgb_brightness = brightness; // Coloca o valor do brilho na variavel
   setColor(m_rgb_red, m_rgb_green, m_rgb_blue);// Atualiza o valor das cores nas variaveis e chama o brilho
   publishRGBBrightness();
  }
 }
 else if (String(MQTT_LIGHT_RGB_COMMAND_TOPIC).equals(p_topic)) 
 {
  // get the position of the first and second commas
  uint8_t firstIndex = payload.indexOf(',');
  uint8_t lastIndex = payload.lastIndexOf(',');
  uint8_t rgb_red = payload.substring(0, firstIndex).toInt();
  if (rgb_red < 0 || rgb_red > 255) 
  {
   return;
  }
  else
  {
   m_rgb_red = rgb_red;
  }
  uint8_t rgb_green = payload.substring(firstIndex + 1, lastIndex).toInt();
  if (rgb_green < 0 || rgb_green > 255) 
  {
   return;
  }
  else
  {
   m_rgb_green = rgb_green;
  }
  uint8_t rgb_blue = payload.substring(lastIndex + 1).toInt();
  if (rgb_blue < 0 || rgb_blue > 255) 
  {
   return;
  }
  else
  {
   m_rgb_blue = rgb_blue;
  }
  setColor(m_rgb_red, m_rgb_green, m_rgb_blue);
  publishRGBColor();
 }
}

void reconnect() // Conexao ao MQTT
{
 while (!client.connected()) 
 {
  Serial.println("INFO: Efetuando conecxao no servidor MQTT");
  if (client.connect(MQTT_CLIENT_ID, MQTT_USER, MQTT_PASSWORD)) 
  {
   Serial.println("INFO: Conectado!");
   publishRGBState();
   publishRGBBrightness();
   publishRGBColor();
   client.subscribe(MQTT_LIGHT_COMMAND_TOPIC);
   client.subscribe(MQTT_LIGHT_BRIGHTNESS_COMMAND_TOPIC);
   client.subscribe(MQTT_LIGHT_RGB_COMMAND_TOPIC);
  }
  else
  {
   Serial.print("ERROR: Falha, Codigo=");
   Serial.print(client.state());
   delay(1000);
  }
 }
}

void setup() {
  // init the serial
  Serial.begin(115200);

  // init the RGB led
  pinMode(RGB_LIGHT_BLUE_PIN, OUTPUT);
  pinMode(RGB_LIGHT_RED_PIN, OUTPUT);
  pinMode(RGB_LIGHT_GREEN_PIN, OUTPUT);
  analogWriteRange(255);
  setColor(0, 0, 0);

  // init the WiFi connection
  Serial.println();
  Serial.println();
  Serial.print("INFO: Connecting to ");

  ConectarWIFI();
  
  // init the MQTT connection
  client.setServer(MQTT_SERVER_IP, MQTT_SERVER_PORT);
  client.setCallback(callback);
  
  // Iniciar servidor atualizacao OTA
  atualizadorOTA_geladeira_rgb.setup(&servidorWeb_geladeira_rgb);
  servidorWeb_geladeira_rgb.begin();
}

void loop() {
  if (!client.connected()) {
    reconnect();
  }
 
 // VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 if(WiFi.status() != WL_CONNECTED) 
 {
  ConectarWIFI();
 }
 else
 {
  servidorWeb_geladeira_rgb.handleClient();
 }
  client.loop();
}
