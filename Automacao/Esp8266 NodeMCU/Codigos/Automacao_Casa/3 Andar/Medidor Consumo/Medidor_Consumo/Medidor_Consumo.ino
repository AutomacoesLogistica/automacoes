/*
 * 
 * 
 * CODIGO UTILIZANDO UM ESP8266 NODEMCU E UM DISPLAY LCD I2C 20X4
 * Codigo padrao para atualizar via ota - web service arquivo .bin
 *  
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 
 * 
 */
 #include <Arduino.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
ESP8266WiFiMulti WiFiMulti;
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>

#include <PubSubClient.h>

//LiquidCrystal_I2C lcd(0x27, 20, 4);
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);

const char *Usuario     = "AutomacaoLOG";
const char *Senha = "logistica2019@";
String local = "medidor_consumo"; // aqui é o local onde sera publicado

int leitura;

String Mensagem_Enviar; 
String topico;
char Funcoes_topico[60];
char Funcoes[50];

bool primeira_mensagem_zerar = 0;
bool primeira_mensagem_valor_mensal = 0;
bool primeira_mensagem_valor_kwh = 0;
bool primeira_mensagem_kwh_casa = 0;
bool primeira_mensagem_kwh_cemig = 0;
bool primeira_mensagem_pulso = 0;

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "brunogon"  // Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/energia/+" 


IPAddress staticIP(192,168,20,105);
IPAddress gateway(192,168,20,1);
IPAddress mascara(255,255,255,0);
IPAddress dns(8,8,8,8);

boolean pode_publicar_mqtt = false;
#define entrada_zerar_mes 12 // D6 e Tambem tera por MQTT
#define entrada_pulso 14     // D5 ...Pulso do medidor HIKING
unsigned int contagem = 0;

//Ultima conta 2039
float valor_kwh = 1.10124712;
//2166
float kwh_casa = 1544.80; // Valor apresentado no HIKING
float kwh_cemig = 621.23; // Valor no medidor CEMIG - HIKING CONSTANTE
float valor_mensal = 127; //  Valor atual do consumo  - Valor CEMIG - Ultimo MES

float valor_acumulado;
float valor_reais;
int v_led_mqtt = 500; // Nao mudar

WiFiClient medidor_consumo;                                 //Instância do WiFiClient
PubSubClient client(medidor_consumo);                       //Passando a instância do WiFiClient para a instância do PubSubClient

ESP8266HTTPUpdateServer atualizadorOTA_medidor_consumo; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_medidor_consumo(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Monitor de Consumo";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";


bool precisaSalvar = false; //Flag para salvar os dados
String readString;
#define Led_Wifi 10    //10   No lolin é 9
#define Led_Mqtt 16

#define rele_pulso 13 // Rele do pulso para abrir portao D7


void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 String strTopico = String((char*)topico);
 strTopico.toLowerCase();
 Serial.print("Chegou do MQTT: ");
 Serial.print(strMensagem);
 Serial.print("     - Topico  : ");
 Serial.println(strTopico);
 
 String Enviar;
 String Topico;
 digitalWrite(Led_Mqtt,LOW);
 Enviar = strMensagem;
 Topico = strTopico;

if(Topico == "dev/test/minhacasa/portao/comando" && Enviar == "abrir")
{
  digitalWrite(rele_pulso,HIGH);
  delay(600);
  digitalWrite(rele_pulso,LOW);
  for(int x=0;x<2;x++)
  {
   client.publish("dev/test/minhacasa/portao/comando", "limpar"); // evitar de abrir o portao de forma indesejada!
   delay(100);
  }
}

  v_led_mqtt=0; // Para apagar o led sinalizando que recebeu mensagem e ativar o contador no loop para voltar a acende-la 
 
}// Fecha void recebe mensagem




void ConectarWIFI()
{
 WiFi.mode(WIFI_STA);
 WiFiMulti.addAP("AutomacaoLOG", "logistica2019@");
 if(WiFiMulti.run() != WL_CONNECTED) 
 {
  Serial.print(".");
  delay(500);
 }
 else
 {
  Serial.println("");
  Serial.println("WiFi conectado com");
  Serial.println("IP: ");
  Serial.println(WiFi.localIP());
  Serial.println("");
  valor_ip = WiFi.localIP().toString();
  mac = WiFi.macAddress();
  Pagina();
 }
}// Fecha void ConectarWIFI



void setup() 
{
 Serial.begin(115200);  
 pinMode(Led_Wifi,OUTPUT);
 digitalWrite(Led_Wifi,LOW);
 delay(200);
 pinMode(Led_Mqtt,OUTPUT);
 digitalWrite(Led_Mqtt,LOW);
 pinMode(rele_pulso,OUTPUT);
 digitalWrite(rele_pulso,LOW);
 
 ConectarWIFI();
 
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
 
 
 
 
 pinMode(entrada_zerar_mes,INPUT); 
 pinMode(entrada_pulso,INPUT);
 lcd.begin(20,4);   // INICIALIZA O DISPLAY LCD
 //lcd.backlight(); // HABILITA O BACKLIGHT (LUZ DE FUNDO
 
 valor_reais = (valor_mensal * valor_kwh);
 valor_acumulado = kwh_cemig+kwh_casa;
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("KWh Men.:");
 lcd.setCursor(10,0);
 lcd.print("          ");//Limpar o local do valor kwh mensal
 lcd.setCursor(10,0);
 lcd.print(String(valor_mensal,2));
 lcd.setCursor(0,1);
 lcd.print ("KWh Acu.:");
 lcd.setCursor(10,1);
 lcd.print("          ");//Limpar o local do valor kwh acumulado
 lcd.setCursor(10,1);
 lcd.print(String(valor_acumulado,2));
 lcd.setCursor(0,2);
 lcd.print ("KWh Casa:");
 lcd.setCursor(9,2);
 lcd.print("           ");
 lcd.setCursor(10,2);
 lcd.print(kwh_casa);
 lcd.setCursor(0,3);
 lcd.print ("Previsao:");
 lcd.setCursor(9,3);
 lcd.print ("           "); // Limpa o valor em reais
 lcd.setCursor(10,3);
 lcd.print("R$ "+String(valor_reais,2));
 
 
 // Iniciar servidor atualizacao OTA
 atualizadorOTA_medidor_consumo.setup(&servidorWeb_medidor_consumo);
 servidorWeb_medidor_consumo.begin();
 
} 


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

  
  servidorWeb_medidor_consumo.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_medidor_consumo.send(200, "text/html", paginaWeb);}







void atualiza()
{
 
  
  
  
  valor_reais = (valor_mensal * valor_kwh);
  valor_acumulado = kwh_cemig+kwh_casa;
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print ("KWh Men.:");
  lcd.setCursor(10,0);
  lcd.print("          ");//Limpar o local do valor kwh mensal
  lcd.setCursor(10,0);
  lcd.print(String(valor_mensal));
  

  
  
  Mensagem_Enviar = String(valor_mensal);
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "dev/test/minhacasa/consumo/consumoa_kwh";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica o valor de kwh acumulado
  
  
  
  
  lcd.setCursor(0,1);
  lcd.print ("KWh Acu.:");
  lcd.setCursor(10,1);
  lcd.print("          ");//Limpar o local do valor kwh acumulado
  lcd.setCursor(10,1);
  lcd.print(String(valor_acumulado,2));
  Mensagem_Enviar = String(valor_acumulado,2);
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "dev/test/minhacasa/consumo/consumo_kwh";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica o valor de consumo kwh do mes
  lcd.setCursor(0,2);
  lcd.print ("KWh Casa:");
  lcd.setCursor(9,2);
  lcd.print("           ");
  lcd.setCursor(10,2);
  lcd.print(kwh_casa);
  lcd.setCursor(0,3);
  lcd.print ("Previsao:");
  lcd.setCursor(9,3);
  lcd.print ("           "); // Limpa o valor em reais
  lcd.setCursor(10,3);
  lcd.print("R$ "+String(valor_reais,2));
  Mensagem_Enviar = "R$ "+String(valor_reais,2);
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "dev/test/minhacasa/consumo/previsao_conta";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica o valor em reais da previsao da conta no mes  
}


//Função que reconecta ao servidor MQTT
void reconectar() {
  
  //Repete até conectar
  if (!client.connected()) {
    digitalWrite(Led_Mqtt,LOW);
    Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("medidor_consumo", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("medidor_consumo");

    if(conectado) {
      digitalWrite(Led_Mqtt,HIGH);
      Serial.println("Conectado_MQTT,");
       //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
      client.subscribe("dev/test/minhacasa/portao/comando", 1);
      
     
    } else {
      //Serial.println("Falhou ao tentar conectar. Codigo: ");
      //Serial.println(String(client.state()).c_str());
      Serial.println("Reconectando MQTT novamente em 0.5 segundos");
      //Aguarda 5 segundos para tentar novamente
      digitalWrite(Led_Mqtt,LOW);
      
    }
  }
}


void loop()
{
 if (v_led_mqtt<500)
 {
  v_led_mqtt++;
  
 }
 
 if (v_led_mqtt>450 && v_led_mqtt<500)
 {
  digitalWrite(Led_Mqtt,HIGH);
  v_led_mqtt = 500;
 }


  
 if(digitalRead(entrada_zerar_mes)==LOW)
 {
  delay(1000);
  valor_mensal = 0.00;
  valor_reais = (valor_mensal * valor_kwh);
  valor_acumulado = kwh_cemig+kwh_casa;
  atualiza();
 }

 if(digitalRead(entrada_pulso)==LOW)
 {
  while(digitalRead(entrada_pulso)==LOW)
  {
   delay(10); 
  }
  valor_mensal = valor_mensal+ 0.00125;
  kwh_casa = kwh_casa + 0.00125;
  atualiza();
 }

 if (!client.connected()) 
{
 reconectar(); // Reconecta no MQTT
} 



 // VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 if(WiFiMulti.run() != WL_CONNECTED) 
 {
  ConectarWIFI();
 }
 else
 {
  servidorWeb_medidor_consumo.handleClient();
 }


 contagem ++;
 if(contagem >= 40000)
 {
   //Publica o valor da entrada analogica para tratar no nodered as condicoes, chamando,no gancho, etc...
  Mensagem_Enviar = String(analogRead(A0));
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "dev/test/minhacasa/interfone/entrada_analogica";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica o valor da entrada analogica dos dados do interfone
  contagem = 0;
 }
 client.loop();
}
