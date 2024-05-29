/* 

 CODIGO PARA USAR COM ESP8266 NODEMCU
 
 SCK = Pino 2   // MCU = 12
 DT = pino 3    // MCU = 14
  

* CODIGO PARA ESP8266 NODEMCU -
 * Codigo padrao para atualizar via ota - web service arquivo .bin
 * 
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 * 
 
*/

 
#include "HX711.h" //Biblioteca do HX711.h
#include <PubSubClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>

HX711 balanca; 

float calibration_factor = 48011.00;                                                        // Fator de calibração para ajuste da célula
float peso;                                                                                 // variável peso
float peso_botijao_vazio = 14.25;

#define N 60 // Numero de amostas
float media; // Recebe a media
int valores[N]; // Array para armazenar os valores lidos
float soma; // Variavel para somar os valores 

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/monitor_gas"    //  PARA TROCAR SELECIONAR "monitor_gas" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx
#define TOPICO_PUBLISH   "dev/test/minhacasa/gas"

String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];
unsigned long contador = 0;
int espera = 100;

const char *Usuario     = "AutomacaoLOG";
const char *Senha = "logistica2019@";
String local = "monitor_gas"; // aqui é o local onde sera publicado

IPAddress staticIP(192, 168, 20, 175);
IPAddress gateway(192, 168, 20, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient monitor_gas;                                 //Instância do WiFiClient
PubSubClient client(monitor_gas);                       //Passando a instância do WiFiClient para a instância do PubSubClient

ESP8266HTTPUpdateServer atualizadorOTA_monitor_gas; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_monitor_gas(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Monitor de Gas";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";



bool precisaSalvar  =             false;              //Flag para salvar os dados
String atualiza;

String readString;



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

  
  servidorWeb_monitor_gas.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_monitor_gas.send(200, "text/html", paginaWeb);}







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
  if(Enviar == "0")
  {
    balanca.tare();
    delay(1000);
    client.publish("dev/test/minhacasa/status_gas", "zerado");
  }
  else
  {
   int tempo = 0;
   tempo = Enviar.toInt();

    if ( tempo>0 )
    {
    espera = tempo;
    }
  }
  
} //fecha recebe mensagem

void setup() {                                                                              // rotina de configurações
  Serial.begin(115200);                                                                       // Baud rate da comunicação 
  Serial.println("Remova todos os pesos da balança");                                       // Printa "Remova todos os pesos da balança" na COM 
  delay(2000);                                                                              // atraso de 1000ms = 1s
  balanca.begin(14,12);// DT(D5), SCK(D6)
  balanca.set_scale();                                                                      // seta escala
  balanca.tare();                                                                           // escala da tara

  long zero_factor = balanca.read_average();

  ConectarWIFI();
  
  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta);
  client.setServer(servidor_mqtt, portaInt);
  client.setCallback(atualizar_mensagem);

 // Iniciar servidor atualizacao OTA
 atualizadorOTA_monitor_gas.setup(&servidorWeb_monitor_gas);
 servidorWeb_monitor_gas.begin();
}

//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("monitor_gas", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("monitor_gas");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      delay(200);
    }
  }
}
void loop()
{                                                                               // chama função de loop
  balanca.set_scale(calibration_factor);                                                    // a balanca está em função do fator de calibração 
  peso = balanca.get_units(), 10;                                                           // imprime peso
  
  if (peso < 0)                                                                             // se a unidade for menor que 0 será considerado 0
  {
    peso = 0.00;                                                                            // Para o caso do peso ser negativo, o valor apresentado será 0 
  }                                                  
  else
  {
   float peso_liquido;
   peso_liquido = (peso - peso_botijao_vazio)+0.95; // -1 para ajustar o peso das mangueiras
   for(int i = N-1;i>0;i--)
   {
    valores[i] = valores[i-1];
   }
   valores[0] = peso_liquido; // Coloca o valor mais atual em valores[0]
   soma = 0;  // Limpa a variavel de soma
   for (int i=0;i<N;i++)
   {
    soma = soma+valores[i];
   }
   
   media = soma/N;
     
   float peso_bruto = peso;
   float gas;

   gas = ((media * 100)/13);
   if(int(gas) >=100)
   {
    gas = 100.0;
   }
   Serial.print("Peso Bruto = ");Serial.print(peso);
   Serial.print(" Kg   -  Peso Liguido = ");Serial.print(media);
   Serial.print(" Kg  -  Gas = ");Serial.print(gas);
   Serial.print(" %   -  Contador = ");
   //Serial.println(contador);
   //contador++;
   //if ( contador >=espera)
   //{
    delay(2000);
    Serial.println("Publicou");
    String nivel = String(gas,2);
    Mensagem_Enviar = nivel;
    Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
    client.publish("dev/test/minhacasa/gas", Funcoes);
    //contador = 0;
   //}
    
  } // Fecha o else

if (!client.connected())
{
 reconectar();
}

// VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 if(WiFi.status() != WL_CONNECTED) 
 {
  ConectarWIFI();
 }
 else
 {
  servidorWeb_monitor_gas.handleClient();
 }

client.loop();

}
