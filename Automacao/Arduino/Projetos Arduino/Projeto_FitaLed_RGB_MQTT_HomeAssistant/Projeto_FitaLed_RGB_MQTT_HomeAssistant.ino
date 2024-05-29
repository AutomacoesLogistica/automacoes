/*
   MQTT RGB Light for Home-Assistant - NodeMCU (ESP8266)
   https://home-assistant.io/components/light.mqtt/

   Libraries :
    - ESP8266 core for Arduino : https://github.com/esp8266/Arduino
    - PubSubClient : https://github.com/knolleary/pubsubclient

   Sources :
    - File > Examples > ES8266WiFi > WiFiClient
    - File > Examples > PubSubClient > mqtt_auth
    - File > Examples > PubSubClient > mqtt_esp8266
    - http://forum.arduino.cc/index.php?topic=272862.0

   Schematic :
    - https://github.com/mertenats/open-home-automation/blob/master/ha_mqtt_rgb_light/Schematic.png
    - LED leg 1 - Resistor 270 Ohms - D1/GPIO5
    - LED leg 2 (longuest leg) - GND
    - LED leg 3 - Resistor 270 Ohms - D2/GPIO4
    - LED leg 4 - Resistor 270 Ohms - D3/GPIO0

   Configuration (HA) : 
    light:
      - platform: mqtt
        name: "Sala RGB light"
        state_topic: "sala/rbg1/luz/status"
        command_topic: "sala/rbg1/luz/switch"
        brightness_state_topic: 'sala/rbg1/brilho/status'
        brightness_command_topic: 'sala/rbg1/brilho/set'
        rgb_state_topic: 'sala/rbg1/rgb/status'
        rgb_command_topic: 'sala/rbg1/rgb/set'
        brightness_scale: 100
        optimistic: false


   If you like this example, please add a star! Thank you!
   https://github.com/mertenats/open-home-automation
*/

#include <ESP8266WiFi.h>
#include <PubSubClient.h>

#define MQTT_VERSION MQTT_VERSION_3_1_1

// Wifi: SSID and password
const char* WIFI_SSID = "Bruno";
const char* WIFI_PASSWORD = "bruno268300";

// MQTT: ID, server IP, port, username and password
const PROGMEM char* MQTT_CLIENT_ID = "sala_rbg_luz"; // Nome do cliente OBS: Definir abaixo tambem no wifi client e pubsubclient
const PROGMEM char* MQTT_SERVER_IP = "m11.cloudmqtt.com"; // Nome do servidor MQTT
const PROGMEM uint16_t MQTT_SERVER_PORT = 10671; // Nome da porta do servidor MQTT
const PROGMEM char* MQTT_USER = "qjuidpsd"; // Nome do usuario do MQTT
const PROGMEM char* MQTT_PASSWORD = "bUA07u8vEsPj"; // Senha do usuario do MQTT

// Topicos do MQTT
// Topico para > state
const PROGMEM char* MQTT_LIGHT_STATE_TOPIC = "sala/rbg1/luz/status"; // Recebe o comando ON ou OFF do homeassistant ou servidor MQTT
const PROGMEM char* MQTT_LIGHT_COMMAND_TOPIC = "sala/rbg1/luz/switch"; // Envia a resposta do comando ON ou OFF do homeassistant ou servidor MQTT

// Topico para > brightness
const PROGMEM char* MQTT_LIGHT_BRIGHTNESS_STATE_TOPIC = "sala/rbg1/brilho/status"; // Recebe o valor de brilho do homeassistant ou servidor MQTT
const PROGMEM char* MQTT_LIGHT_BRIGHTNESS_COMMAND_TOPIC = "sala/rbg1/brilho/set"; // Envia o valor de brilho para o homeassistant ou servidor MQTT

// Topico para > colors (rgb)
const PROGMEM char* MQTT_LIGHT_RGB_STATE_TOPIC = "sala/rbg1/rgb/status";  // Recebe os valores das cores do homeassistant ou servidor MQTT
const PROGMEM char* MQTT_LIGHT_RGB_COMMAND_TOPIC = "sala/rbg1/rgb/set"; // Envia os valores das cores do homeassistant ou servidor MQTT

// Definindo a palavra para ligar e desligar recebida so servido MQTT ou HomeAssistant (on/off)
const PROGMEM char* LIGHT_ON = "ON";   // Define que ON vira LIGHT_ON
const PROGMEM char* LIGHT_OFF = "OFF"; // Define que OFF vira LIGHT_OFF

// Variaveis usadas para armazerar o estado, brilho e a cor
boolean m_rgb_state = false;    // Inicia desligada
uint8_t m_rgb_brightness = 100; // Brilho em 100
uint8_t m_rgb_red = 255;        // Cor maxima de vermelho
uint8_t m_rgb_green = 255;      // Cor maxima de verde
uint8_t m_rgb_blue = 255;       // Cor maxima de azul

// Define os pinos que serão usados para Acionar a fita Led
const PROGMEM uint8_t RGB_LIGHT_RED_PIN = 5; //GPIO D1
const PROGMEM uint8_t RGB_LIGHT_GREEN_PIN = 4; // GPIO D2
const PROGMEM uint8_t RGB_LIGHT_BLUE_PIN = 0; // GPIO D3

// Buffer usado para Envio e Recepção dos dados MQTT
const uint8_t MSG_BUFFER_SIZE = 20;
char m_msg_buffer[MSG_BUFFER_SIZE]; 

WiFiClient sala_rbg_luz; // Cliente Unico
PubSubClient client(sala_rbg_luz); // Cliente Unico


// Função chamada para adaptar o brilho e a cor do led
void setColor(uint8_t p_red, uint8_t p_green, uint8_t p_blue) 
{
  // Converte a porcentagem de 0 a 100% para valor inteiro de 0 a 255
  uint8_t brightness = map(m_rgb_brightness, 0, 100, 0, 255);
  analogWrite(RGB_LIGHT_RED_PIN, map(p_red, 0, 255, 0, brightness));
  analogWrite(RGB_LIGHT_GREEN_PIN, map(p_green, 0, 255, 0, brightness));
  analogWrite(RGB_LIGHT_BLUE_PIN, map(p_blue, 0, 255, 0, brightness));
}

// Função chamada para publicar o estado do led (on / off) *******************************************************************************************************************************
void Publicar_Estado_RGB() 
{
 if (m_rgb_state) 
 {
  client.publish(MQTT_LIGHT_STATE_TOPIC, LIGHT_ON, true); // Publica que está ligado 
 }
 else
 {
  client.publish(MQTT_LIGHT_STATE_TOPIC, LIGHT_OFF, true); // Publica que está desligado
 }
}

// Função de chamada para publicar o brilho do led de 0 a 100 ****************************************************************************************************************************
void Publicar_Brilho_RGB() 
{
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d", m_rgb_brightness); // Monta a string com o valor do brilho atual
 client.publish(MQTT_LIGHT_BRIGHTNESS_STATE_TOPIC, m_msg_buffer, true); // Publica o estado do brilho do LED
}



// Função chamada para publicar as cores do led (xx (x), xx (x), xx (x)) *****************************************************************************************************************
void Publicar_Cor_RGB() 
{
 snprintf(m_msg_buffer, MSG_BUFFER_SIZE, "%d,%d,%d", m_rgb_red, m_rgb_green, m_rgb_blue); // Monta a string separando com virgulas os valor da cor R, G  e B
 client.publish(MQTT_LIGHT_RGB_STATE_TOPIC, m_msg_buffer, true);   // Publica a cor do LED      R   G   B
}




// Função para ler mensagens recebidas pelo MQTT *****************************************************************************************************************************************
void Chegou_Mensagem_MQTT(char* p_topic, byte* p_payload, unsigned int p_length) 
{
 // Concatenar a mensagem recebida
  String payload;
  for (uint8_t i = 0; i < p_length; i++) 
  {
   payload.concat((char)p_payload[i]);
  }
  
  Serial.println(payload); // Imprime o dado recebido so servidor MQTT ou HomeAssistant
  
  // Entra se for mensagens no topico de ligar ou desligar *******************************************************************************************************************************
  if (String(MQTT_LIGHT_COMMAND_TOPIC).equals(p_topic)) 
  {
    // Se a mensagem for igual a "ON" ou "OFF"
    if (payload.equals(String(LIGHT_ON))) // Se for ligado a fita
    {
     if (m_rgb_state != true)  // Inverter para Ligar a fita
     {
      m_rgb_state = true; // Define o estado m_rgb_state = true 
      setColor(m_rgb_red, m_rgb_green, m_rgb_blue); //Busca os valores guardados das cores
      Publicar_Estado_RGB(); // Entra no void para setar a cor salva na fita LED
     }
    }
    else if (payload.equals(String(LIGHT_OFF))) // Se for desligar a fita
    {
     if (m_rgb_state != false) // Inverte para Desligar a fita
     {
      m_rgb_state = false; // Define o estado m_rgb_state = false 
      setColor(0, 0, 0); // Seta para desligar mais não atribui nas variaveis para não perder a cor guardada
      Publicar_Estado_RGB(); // Entra no void para setar a cor desligada
     }
    }
  }
  //  Entra se for mensagens no topico de brilho *****************************************************************************************************************************************
  else if (String(MQTT_LIGHT_BRIGHTNESS_COMMAND_TOPIC).equals(p_topic))
  {
   uint8_t brightness = payload.toInt(); // Faz a conversão do valor da mensagem que está em string para inteiro
   // Caso o valor esteja fora de 0 a 100 é porque deu algum erro na conversão, e com isso não faz nada
   if (brightness < 0 || brightness > 100) 
   {
    // Não faz nada pois houve erro na recepção ou conversão
    return;
   }
   else // Caso a conversão ocorreu ok, ou seja, o valor esta compreendido de 0 a 100
   {
    m_rgb_brightness = brightness; // Atribui o valor na variavel m_rgb_brightness
    setColor(m_rgb_red, m_rgb_green, m_rgb_blue); // Seta a cor salva nas variaveis de cada cor
    Publicar_Brilho_RGB(); // Chama o void para atribuir na cor com brilho atualizado
   }
  }
  // Entra se a mensagem for do topico cor da fita de led ********************************************************************************************************************************
  else if (String(MQTT_LIGHT_RGB_COMMAND_TOPIC).equals(p_topic)) 
  {
   // Busca a posição da primeira e segunda virgula, para poder quebrar a string em tres partes, ou seja, cor R, cor G e cor B
   uint8_t firstIndex = payload.indexOf(','); // Busca a posição da primeira virgula
   uint8_t lastIndex = payload.lastIndexOf(','); // Busca a posição da segunda virgula
   uint8_t rgb_red = payload.substring(0, firstIndex).toInt(); // Quebra a string para buscar o valor da cor R e converte a mesma para inteiro
   
   if (rgb_red < 0 || rgb_red > 255)  // Caso o valor convertido para a cor R esteja fora de 0 a 255 não faz nada
   {
    return; // Retorna sem fazer nada
   }
   else // Caso a conversão do valor para a cor R esteja compreendido de 0 a 255 atribuiu o valor ja em inteiro na variavel da cor vermelha
   {
    m_rgb_red = rgb_red; // Atribui o valor a variavel vermelha
   }
   uint8_t rgb_green = payload.substring(firstIndex + 1, lastIndex).toInt(); // Faz a quebra da segunda string para buscar a cor G e converter para inteiro
   if (rgb_green < 0 || rgb_green > 255) // Caso o valor convertido esteja fora de 0 a 255 não faz nada
   {
    return; // Retorna sem fazer nada pois houve um erro de conversão
   }
   else // Caso a conversão do valor para a cor G esteja compreendido de 0 a 255 atribui o valor ja em inteiro na variavel da cor verde
   {
    m_rgb_green = rgb_green; // Atribui o valor a variavel verde
   }
   uint8_t rgb_blue = payload.substring(lastIndex + 1).toInt(); // Converte o restante da string para a cor B e converte a mesma para inteiro
   if (rgb_blue < 0 || rgb_blue > 255) // Caso o valor esteja fora de 0 a 255 houve algum erro, portanto não faz nada
   {
    return; // Retorna sem fazer nada pois houve falha na recepção ou conversão
   }
   else // Caso a conversão do valor para a cor B esteja compreendido de 0 a 255 atribui o valor ja em inteiro na variavel da cor Azul
   {
    m_rgb_blue = rgb_blue; // Atriui o valor a variavel azul
   }
   setColor(m_rgb_red, m_rgb_green, m_rgb_blue);// Busca as tres cores atualizadas recebidas pelo MQTT e atribui na função para setar a nova cor
   Publicar_Cor_RGB(); // Chama o void para atualizar a cor da fita Led
  }
}


// Void para reconectar ******************************************************************************************************************************************************************
void reconnect() 
{
 while (!client.connected())  // Enquanto não estiver conectado, inicia a tentativa de nova conexão até se conectar
 {
  Serial.println("Tentando efetuar conexao no servidor MQTT");
  if (client.connect(MQTT_CLIENT_ID, MQTT_USER, MQTT_PASSWORD)) // Tentando conectar com id, usuario e senha
  {
   Serial.println("Conectado com sucesso!");
   // Efetuou a conexão e em seguida atualiza os valores iniciais na fita
   Publicar_Estado_RGB(); //Entra para atualizar o valor inicial na fita
   Publicar_Brilho_RGB(); //Entra para atualizar o valor inicial de brilho 
   Publicar_Cor_RGB();    //Entra para atualizar o valor inicial da cor
   client.subscribe(MQTT_LIGHT_COMMAND_TOPIC); // Busca no servidor MQTT o ultimo comando do status da fita Led
   client.subscribe(MQTT_LIGHT_BRIGHTNESS_COMMAND_TOPIC); // Busca no servidor MQTT o ultimo comando do brilho da fita Led
   client.subscribe(MQTT_LIGHT_RGB_COMMAND_TOPIC); // Busca no servidor MQTT o ultimo comando da cor da fita Led
   }
   else // Caso haja falha na conexão
   {
    Serial.print("Erro: Codigo de falha rc = ");
    Serial.print(client.state());
    Serial.println("Aguarde: A tentativa de nova conexao sera realizada em 2 segundos!");
    delay(2000); // Aguarda 2 segundos
   }
  }
}

void setup() 
{
 Serial.begin(115200); // Seta a velocidade na serial
 pinMode(RGB_LIGHT_BLUE_PIN, OUTPUT); // Define a porta como saida
 pinMode(RGB_LIGHT_RED_PIN, OUTPUT); // Define a porta como saida
 pinMode(RGB_LIGHT_GREEN_PIN, OUTPUT); // Define a porta como saida
 analogWriteRange(255);// Define o range da saida PWM para 255
 setColor(0, 0, 0);// Define os valores em 0, desligando todas
 Serial.println();
 Serial.println();
 Serial.print("Iniciando tentativa de conexão em :");
 WiFi.mode(WIFI_STA);
 Serial.println(WIFI_SSID); //Imprime o nome da conexão que irá tentar se conectar
 WiFi.begin(WIFI_SSID, WIFI_PASSWORD); // Inicia a conexão no wifi com o SSID e Senha passados no inicio do código
 while (WiFi.status() != WL_CONNECTED) // Aguarda e imprime pontos até a realizar a conexão
 {
  delay(500);
  Serial.print(".");
 }
 Serial.println("");
 Serial.println("Conectado pelo WIFI !");
 Serial.print("IP : ");
 Serial.println(WiFi.localIP()); // Imprime o valor do IP adquirido por DHCP
 client.setServer(MQTT_SERVER_IP, MQTT_SERVER_PORT); // Inicia o servidor na porta especificada
 client.setCallback(Chegou_Mensagem_MQTT); // Faz configuração para qual o nome do void recepção
} // Fecha o voi setup

void loop()
{
 if (!client.connected()) // Verifica se não está mais conectado e caso caiu a conexão chama o void para reconectar
 {
  reconnect(); // Chama o void para tentar reconectar
 }
 client.loop(); // Mantem em loop para garantir o subscribe sendo executado de forma constante
} // Fecha void loop
