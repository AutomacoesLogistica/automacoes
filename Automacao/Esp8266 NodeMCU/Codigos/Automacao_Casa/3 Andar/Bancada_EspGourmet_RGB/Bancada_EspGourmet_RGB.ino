#include <ESP8266WiFi.h>
#include <PubSubClient.h>

const char* WIFI_SSID = "Casa_Bruno2";
const char* WIFI_PASSWORD = "casabruno2@@";
const PROGMEM char* MQTT_CLIENT_ID = "bancada_espgourmet_rbg";
const PROGMEM char* MQTT_SERVER_IP = "192.168.2.200";
const PROGMEM uint16_t MQTT_SERVER_PORT = 1883;
const PROGMEM char* MQTT_USER = "brunogon";
const PROGMEM char* MQTT_PASSWORD = "268300";

// MQTT: Topicos
// Estado
const PROGMEM char* MQTT_LIGHT_STATE_TOPIC = "dev/test/minhacasa/espgourmet/bancada/status";
const PROGMEM char* MQTT_LIGHT_COMMAND_TOPIC = "dev/test/minhacasa/espgourmet/bancada/comando";

// Brilho
const PROGMEM char* MQTT_LIGHT_BRIGHTNESS_STATE_TOPIC = "dev/test/minhacasa/espgourmet/bancada/brilho/status";
const PROGMEM char* MQTT_LIGHT_BRIGHTNESS_COMMAND_TOPIC = "dev/test/minhacasa/espgourmet/bancada/brilho/setar";

// Cores(rgb)
const PROGMEM char* MQTT_LIGHT_RGB_STATE_TOPIC = "dev/test/minhacasa/espgourmet/bancada/rgb/status";
const PROGMEM char* MQTT_LIGHT_RGB_COMMAND_TOPIC = "dev/test/minhacasa/espgourmet/bancada/rgb/setar";

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

WiFiClient bancada_espgourmet_rbg;
PubSubClient client(bancada_espgourmet_rbg);

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
 client.publish("dev/test/minhacasa/espgourmet/bancada/red",m_msg_buffer);//Publica o valor de vermelho
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d", m_rgb_green);
 client.publish("dev/test/minhacasa/espgourmet/bancada/green",m_msg_buffer);//Publica o valor de verde
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d", m_rgb_blue);
 client.publish("dev/test/minhacasa/espgourmet/bancada/blue",m_msg_buffer);//Publica o valor de azul
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
  WiFi.mode(WIFI_STA);
  Serial.println(WIFI_SSID);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("INFO: WiFi connected");
  Serial.print("INFO: IP address: ");
  Serial.println(WiFi.localIP());

  // init the MQTT connection
  client.setServer(MQTT_SERVER_IP, MQTT_SERVER_PORT);
  client.setCallback(callback);
}

void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop();
}
