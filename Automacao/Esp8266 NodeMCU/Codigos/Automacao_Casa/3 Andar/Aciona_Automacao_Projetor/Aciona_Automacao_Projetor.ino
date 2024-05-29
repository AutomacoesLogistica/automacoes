/*
 * 
 * CODIGO PARA ESP8266 NODEMCU - TRABALHA JUNTO COM O CODIGO RODANDO EM DOIS ARDUINO PRO MINI ACIONANDO A TELA RETRATIL E LIFT PROJETO E ENVIANDO OS DADOS VIA SERIAL
 * Codigo padrao para atualizar via ota - web service arquivo .bin
 * 
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 * 
 * 
 * 
 * 
 * 
 * 
 * 
   Conexão do modulo RS485
   RO = Pino D1
   DI = Pino D2
   DE = Pino D3
   RE = Pino D3

 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */



#include <PubSubClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>
#include<SoftwareSerial.h>
#define transmitir 0 // Pino DE e RE - Transmissao
#define pinRX 5 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);


#define rele 14  // D5
#define rele2 12  // D6 reserva, ainda nao definido


int erro = 0;

//Tempo para publicação
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 120000;     // Tempo em ms do intervalo a ser executado
boolean tempo = false;
unsigned long AtualMillis;

int mensagem_erro = 0;
boolean tela_aberta = false;
boolean tela_fechada = false;
boolean projetor_aberto = false;
boolean projetor_fechado = false;

const char *Usuario     = "Automacao";
const char *Senha = "2020@bru";
String local = "automacao_projetor"; // aqui é o local onde sera publicado

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/automacao_projetor/comando"    //  PARA TROCAR SELECIONAR "arvore_natal" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx


String Mensagem_Enviar;
String topico;
char Funcoes_topico[120];
char Funcoes[100];

IPAddress staticIP(192, 168, 3, 172);
IPAddress gateway(192, 168, 3, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient automacao_projetor;                                 //Instância do WiFiClient
PubSubClient client(automacao_projetor);  

ESP8266HTTPUpdateServer atualizadorOTA_automacao_projetor; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_automacao_projetor(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Automação Projetor - LIFT e Telão Retrátil";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String condicao = "--";
String paginaWeb = "";
String mac = "";

bool primeira_mensagem = 0;
String readString;

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
 
  //Serial.println(Enviar);
  UltimoMillis = AtualMillis;
  
  if (primeira_mensagem == 1)
  {
   
   if(Enviar == "abrir_t")
   {
    digitalWrite(rele,LOW); // Liga o rele de alimentação!
    tempo = true; //Ativa o timer para desligar o rele apos 2 min!
    Serial.println("descer");
    delay(2000); 
    // Envia a mensagem > descer <  no RS485
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("descer");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
    delay(100);
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("descer");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   else if(Enviar == "fechar_t")
   {
     digitalWrite(rele,LOW); // Liga o rele de alimentação!
    tempo = true; //Ativa o timer para desligar o rele apos 2 min!
    delay(2000);
    Serial.println("subir");
    
    // Envia a mensagem > subir <  no RS485
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("subir");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
    delay(100);
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("subir");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  } // Fecha primeira_mensagem = 1
  if (primeira_mensagem == 0)
  {
   primeira_mensagem = 1;
  }
  
  
  
 
  
} //fecha recebe mensagem


//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("automacao_projetor", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("automacao_projetor");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      
    }
  }
}


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
 servidorWeb_automacao_projetor.on("/", RecepcaoClienteWeb);
 
}// Fecha void ConectarWIFI




void RecepcaoClienteWeb() {
  String abrir = servidorWeb_automacao_projetor.arg(0);//a
  String fechar = servidorWeb_automacao_projetor.arg(1);//b
  String ajustar = servidorWeb_automacao_projetor.arg(2);//c
  String destravar = servidorWeb_automacao_projetor.arg(3);//d
  String desligar = servidorWeb_automacao_projetor.arg(4);//e
  
  UltimoMillis = AtualMillis;
  if(abrir == "1")
  {
    digitalWrite(rele,LOW); // Liga o rele de alimentação!
    tempo = true; //Ativa o timer para desligar o rele apos 2 min!
    delay(2000);
    Serial.println("descer");

    // Envia a mensagem > descer <  no RS485
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("descer");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
    delay(100);
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("descer");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
      
  }
  else if(fechar == "1")
  {
    digitalWrite(rele,LOW); // Liga o rele de alimentação!
    tempo = true; //Ativa o timer para desligar o rele apos 2 min!
    delay(2000);
    Serial.println("subir");
    // Envia a mensagem > subir <  no RS485
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("subir");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
    delay(100);
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("subir");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  }
  else if(ajustar == "1")
  {
    digitalWrite(rele,LOW); // Liga o rele de alimentação!
    tempo = true; //Ativa o timer para desligar o rele apos 2 min!
    delay(2000);
    Serial.println("ajustar");
  }
  else if(destravar == "1")
  {
    digitalWrite(rele,LOW); // Liga o rele de alimentação!
    tempo = true; //Ativa o timer para desligar o rele apos 2 min!
    delay(2000);
    Serial.println("destravar");
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("destravar");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
    delay(100);
  }
  else if(desligar == "1")
  {
    digitalWrite(rele,HIGH); // Desliga o rele de alimentação!
  }
  servidorWeb_automacao_projetor.send(200, "text/html", paginaWeb);
  Pagina();
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
    "<h3>Condição: " + condicao + "</h3>"
    "<input id='btn_abrir' value='Abrir' type='button' onclick='javascript: location.href=`?a=1&b=0&c=0&d=0&e=0`;'></input>" 
    "&nbsp;&nbsp;&nbsp;"
    "<input id='btn_fechar' value='Fechar' type='button' onclick='javascript: location.href=`?a=0&b=1&c=0&d=0&e=0`;'></input>"  
    "&nbsp;&nbsp;&nbsp;"
    "<input id='btn_ajuste' value='Ajustar' type='button' onclick='javascript: location.href=`?a=0&b=0&c=1&d=0&e=0`;'></input>"  
    "&nbsp;&nbsp;&nbsp;"
    "<input id='btn_destravar' value='Destravar' type='button' onclick='javascript: location.href=`?a=0&b=0&c=0&d=1&e=0`;'></input>"  
    "&nbsp;&nbsp;&nbsp;"
    "<input id='btn_desligar' value='Desligar Fonte' type='button' onclick='javascript: location.href=`?a=0&b=0&c=0&d=0&e=1`;'></input>"  
    "<h3>Para atualizar o sketch basta abrir <a href='http://"+valor_ip+"/update'>http://"+valor_ip+"/update</a> e pressionar enter!</h3>" 
    "<footer>Desenvolvido por Bruno Gonçalves </footer>"
  "</body>"
  
  "</html>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  servidorWeb_automacao_projetor.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_automacao_projetor.send(200, "text/html", paginaWeb);}



void setup()
{
 Serial.begin(115200);
  RS485.begin(9600);
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW); // Fica recebendo mensagem!

 
 ConectarWIFI();
 pinMode(rele,OUTPUT);
 digitalWrite(rele,HIGH);//Inicia desligado o rele ( invertido )

 pinMode(rele2,OUTPUT);
 digitalWrite(rele2,HIGH);//Inicia desligado o rele ( invertido ) - Ainda nao usado mas ja soldado na placa!
 
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);

 // Iniciar servidor atualizacao OTA
 atualizadorOTA_automacao_projetor.setup(&servidorWeb_automacao_projetor);
 servidorWeb_automacao_projetor.begin();
  
}//Fecha void setup


void loop() 
{

 if (!client.connected())
 {
  reconectar(); // Para MQTT
 }

 while (RS485.available())
 {
  delay(3);
  char c = RS485.read();
  readString += c;
 }

  
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c;
 }
 
 if(tempo == true)
 {
  AtualMillis = millis();    //Tempo atual em ms
  if (AtualMillis - UltimoMillis > intervalo) 
  { 
   UltimoMillis = AtualMillis;    // Salva o tempo atual
   digitalWrite(rele,HIGH); //Desliga o rele pois é invertido
   tempo=false;
  }
 }
 
 if (readString.length() >0)
 {
  AtualMillis - UltimoMillis;
  Serial.println(readString);
  if (readString.indexOf("tela_aberta") >=0)
  {
   tela_aberta = true;
   tela_fechada = false;
   client.publish("dev/test/minhacasa/tela","aberta");
  }
  else if(readString.indexOf("tela_fechada") >=0)
  {
   tela_aberta = false;
   tela_fechada = true;
   client.publish("dev/test/minhacasa/tela","fechada");
  }
  else if(readString.indexOf("projetor_aberto") >=0)
  {
   projetor_aberto = true;
   projetor_fechado = false;
   client.publish("dev/test/minhacasa/projetor","aberto");
  }
  else if(readString.indexOf("projetor_fechado") >=0)
  {
   projetor_aberto = false;
   projetor_fechado = true;
   client.publish("dev/test/minhacasa/projetor","fechado");
  }

  if(projetor_fechado == true && tela_fechada == true)
  {
   //digitalWrite(rele,HIGH); // Desliga o rele de alimentação!
   condicao = "Fechado!";
   client.publish("dev/test/minhacasa/automacao/cinema","fechados");
  }
  if(projetor_aberto == true && tela_aberta == true)
  {
   //digitalWrite(rele,HIGH); // Desliga o rele de alimentação!
   condicao = "Aberto!";
   client.publish("dev/test/minhacasa/cinema","abertos");
  }
  
   
   readString="";
 }
 
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
  servidorWeb_automacao_projetor.handleClient();
 }

 client.loop(); // Loop para mqtt rodar
}//Fecha Loop
