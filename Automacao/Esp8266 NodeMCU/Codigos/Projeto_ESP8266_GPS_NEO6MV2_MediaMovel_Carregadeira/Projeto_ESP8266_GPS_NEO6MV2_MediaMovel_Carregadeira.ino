/*
 * 
 * 
 * 
 * ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!
 * ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!
 * ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!ATENÇÃO !!
 * 
 * 
 * PARA MUDAR A MAQUINA, DA CONTROL+F E ALTERAR TUDO QUE FOR  >>>>>>>     pc01      <<<<<<<<< PARA A MAQUINA DESEJADA, RESPEITANDO O TAMANHO. ex,trocar para maquina 02
 * 
 * Control+F , filtrar     pc01 e substituir todas por pc02
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */








#include <SoftwareSerial.h>
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <TinyGPS.h>
#include "DHTesp.h"

const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";
 
String Mensagem_Enviar; 
String umidade; // String para atribuir o valor de umidade recebida do sensor DHT
String temperatura; // String para atribuir o valor de temperatura recebida do sensor DHT
String topico; // String para armazenar o topico a ser publicado com as variaveis de forma automática
float valor = 0.00; // Para receber o valor da analogica convertido em tensão 
 
char Funcoes_topico[60];
char Funcoes[50];
boolean timer_ligada = false;
boolean timer_desligada = false;
boolean timer_desligada2 = false;

#define rele1 12 // rele do radio D6
#define rele2 14 // Rele do reader D5


TinyGPS gps;
SoftwareSerial SerialVirtual(4, 5);
#define N 50 // Numero de amostas
float media_lat,media_lon; // Recebe a media
float valores_lat[N],valores_lon[N]; // Array para armazenar os valores lidos
float soma_lat,soma_lon; // Variavel para somar os valores 
unsigned long vezes = 0;
boolean pode_publicar_mqtt = false;

DHTesp dht;

String carregadeira = "pc01";

String maquina = "desligada";

void liga_rele1(void);
void liga_rele2(void);
void desliga_rele1(void);
void desliga_rele2(void);
void atualiza_temp_umidade(void);
void publica_bateria(void);
void publica_status(void);
void publica_posicao(void);

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "10.10.25.200"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "logistica"  // Usuario
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/comando/+/+"    


IPAddress staticIP(10,10,25,101);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
WiFiClient pc01;                                 //Instância do WiFiClient
PubSubClient client(pc01);                       //Passando a instância do WiFiClient para a instância do PubSubClient

float bateria2 = 0.00;
bool precisaSalvar = false; //Flag para salvar os dados
String atualiza;

String readString;

unsigned long AtualMillis;


// DADOS PARA O TIMER DE LIGAR MAQUINA
long UltimoMillis_Ligada = 0;        // Variável de controle do tempo
long intervalo_Ligada = 5;     // Tempo em s do intervalo a ser executado


// DADOS PARA O TIMER DE DESLIGAR MAQUINA
long UltimoMillis_Desligada = 0;        // Variável de controle do tempo
long intervalo_Desligada = 5;     // Tempo em s do intervalo a ser executado
long intervalo_Desligada2 = 5;     // Tempo em s do intervalo a ser executado apos o intervaldo desligada ja ter finalizado


// DADOS PARA O TIMER DE GPS
long UltimoMillis_Gps = 0;        // Variável de controle do tempo
long intervalo_Gps = 6600;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis_Gps;

int vezes_ligado = 0;
int vezes_desligado = 0;

#define Led_Wifi 10
#define Led_Mqtt 16

void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 Serial.print("Chegou do MQTT: ");
 Serial.println(strMensagem);
 String Enviar;
 
  digitalWrite(Led_Mqtt,LOW);
 
  
 Enviar = strMensagem;

 if ( Enviar == "rele1_"+carregadeira+"_on" ){liga_rele1();}
 if ( Enviar == "rele1_"+carregadeira+"_off" ){desliga_rele1();}
 if ( Enviar == "rele2_"+carregadeira+"_on" ){liga_rele2();}
 if ( Enviar == "rele2_"+carregadeira+"_off" ){desliga_rele2();}

 if ( Enviar == carregadeira+"_reset" )
 {
  if(digitalRead(rele1)==LOW && digitalRead(rele2)==LOW)// Somente reseta se estiverem ligados
  {
   desliga_rele1();desliga_rele2();
   delay(4800); // Tempo para descarregar em campo
   liga_rele1();liga_rele2();
  }
 }
 if ( Enviar == carregadeira+"_desliga" )
 {
  desliga_rele1();
  delay(1000);
  desliga_rele2();
  }
 
 

 delay(200);
 digitalWrite(Led_Mqtt,HIGH);
 
} //fecha recebe mensagem ***************************************************************************************************************************************************************



//Função que será chamada ao receber mensagem do servidor MQTT ***************************************************************************************************************************

void setup()
{
 Serial.begin(115200);
 dht.setup(0, DHTesp::DHT11); // Conectado na porta D3
 pinMode(Led_Wifi,OUTPUT);
 digitalWrite(Led_Wifi,LOW);
 pinMode(Led_Mqtt,OUTPUT);
 digitalWrite(Led_Mqtt,LOW);
 WiFi.mode(WIFI_STA);
 WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara);  // (DNS not required)  
 pinMode(rele1,OUTPUT);
 pinMode(rele2,OUTPUT);
 digitalWrite(rele1,HIGH);// Inicia em alto pois o rele atua em low
 digitalWrite(rele2,HIGH);// Inicia em alto pois o rele atua em low
 delay(1000);
 Serial.println("Verificando Conexao!");
 while (WiFi.status() != WL_CONNECTED) 
 {
  digitalWrite(Led_Wifi,LOW);
  delay(500);
  Serial.println("Conectando Wifi...");
 }
 digitalWrite(Led_Wifi,HIGH);
 Serial.println("Conectado no wifi " + String(Usuario));
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
 SerialVirtual.begin(9600); // Não mudar pois o GPS só opera em 9600
 
}


//Função que reconecta ao servidor MQTT
void reconectar() {
  
  //Repete até conectar
  while (!client.connected()) {
    digitalWrite(Led_Mqtt,LOW);
     //Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("pc01", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("pc01");

    if(conectado) {
      digitalWrite(Led_Mqtt,HIGH);
       Serial.println("Conectado_MQTT,");
       //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
      publica_posicao(); // Chama para ja atualizar os valores
      
      if ( maquina == "desligada")
      {
        desliga_rele1();
        desliga_rele2();
      }
      if ( maquina == "ligada")
      {
        liga_rele1();
        liga_rele2();
      }
    } else {
       //Serial.println("Falhou ao tentar conectar. Codigo: ");
       //Serial.println(String(client.state()).c_str());
       Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      //Aguarda 5 segundos para tentar novamente
      digitalWrite(Led_Mqtt,LOW);
      delay(200);
    }
  }
}




void loop()
{
 if (!client.connected()) 
{
 reconectar();
} 

 AtualMillis = millis()/1000;
 
 bateria2 = analogRead(A0);
 valor = ((analogRead(A0)*2.68/884)-0.02)*11.37;
 
// VERIFICA PARA LIGAR A MAQUINA *******************************************************************************************************************************************************
if ( valor >=27.5 && maquina == "desligada" && vezes_ligado <=10 )
{
  vezes_ligado ++;
  vezes_desligado = 0;
  maquina = "ligada";
  timer_ligada = true;
  timer_desligada = false;
  timer_desligada2 = false;
  UltimoMillis_Ligada = millis()/1000;
  UltimoMillis_Desligada = millis()/1000;
}

// VERIFICA PARA DESLIGAR A MAQUINA *******************************************************************************************************************************************************
if ( valor <=25.5 && maquina == "ligada" && vezes_desligado <=10)
{
  vezes_ligado = 0;
  vezes_desligado++;
  maquina = "desligada";
  timer_ligada = false;
  timer_desligada = true;
  UltimoMillis_Desligada = millis()/1000;
  UltimoMillis_Ligada = millis()/1000;
}



 
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************

// VERIFICAÇÃO SOMENTE QUANDO A MAQUINA ESTA LIGADA **********************************************************************************************************************************
if (timer_ligada == true)
{
 if (AtualMillis - UltimoMillis_Ligada > intervalo_Ligada) // timer de 5 segundos
 { 
  UltimoMillis_Ligada = AtualMillis;    // Salva o tempo atual
  liga_rele1();// Liga o relé do radio
  liga_rele2();// Liga o relé do rearder
  timer_ligada = false; // Desliga o timer para não ficar religando ja estando ligado!
 }
}
else
{
 UltimoMillis_Ligada = AtualMillis;    // Salva o tempo atual
}



// VERIFICAÇÃO SOMENTE QUANDO A MAQUINA ESTA DESLIGADA ******************************************************************************************************************************
if (timer_desligada == true)
{
  
 if (AtualMillis - UltimoMillis_Desligada > (timer_desligada2==false?intervalo_Desligada:intervalo_Desligada2)) // timer de 5 segundos
 { 
  if ( timer_desligada2 == false )
  {
   UltimoMillis_Desligada = AtualMillis;    // Salva o tempo atual
   desliga_rele2();// Desliga o relé do reader
   timer_desligada2 = true;
  }
  else
  {
   desliga_rele1();// Desliga o relé do radio
   timer_desligada = false; // Desliga o timer para não ficar religando ja estando ligado!
   timer_desligada2 = false; // Desliga o timer para não ficar religando ja estando ligado!
  }
 }
}
else
{
 UltimoMillis_Desligada = AtualMillis;    // Salva o tempo atual
}







//*********************************************************************************************************************************************************************************



if (maquina == "ligada")
{
 bool newData = false;
 for (unsigned long start = millis(); millis() - start < 1000;)
 {
  while (SerialVirtual.available())
  {
   char c = SerialVirtual.read();
   if (gps.encode(c))
   {
    newData = true;
   }
  }
 }
 if (newData)
 {
  float latitude, longitude;
  unsigned long age;
  gps.f_get_position(&latitude, &longitude, &age);
  float valorLido_lat = latitude;
  float valorLido_lon = longitude;
  // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
  for(int i = N-1;i>0;i--)
  {
   valores_lat[i] = valores_lat[i-1];
   valores_lon[i] = valores_lon[i-1];
  }
  // *************************************************************************************************************************************
  valores_lat[0] = valorLido_lat; // Coloca o valor mais atual em valores[0]
  valores_lon[0] = valorLido_lon; // Coloca o valor mais atual em valores[0]
  soma_lat = 0;  // Limpa a variavel de soma
  soma_lon = 0;  // Limpa a variavel de soma
  // For para calcular a media atualizada *************************************************************************************************
  for (int i=0;i<N;i++)
  {
   soma_lat = soma_lat + valores_lat[i];
   soma_lon = soma_lon + valores_lon[i];
   vezes++;
  }
  // ***************************************************************************************************************************************
  media_lat = soma_lat/N;
  media_lon = soma_lon/N;
  
  pode_publicar_mqtt = true;
  
 } // Fecha newData
 
} // Fecha de maquina ligada


if (pode_publicar_mqtt == true)
{
 AtualMillis_Gps = millis();    //Tempo atual em ms 
 if (AtualMillis_Gps - UltimoMillis_Gps > intervalo_Gps) // timer de 5 segundos
 { 
  UltimoMillis_Gps = AtualMillis_Gps;    // Salva o tempo atual
  publica_posicao(); // Permite publicar mqtt latitude e longitude
 }
}
else
{
  AtualMillis_Gps = millis();    //Tempo atual em ms 
  UltimoMillis_Gps = AtualMillis_Gps;    // Salva o tempo atual
}




if (maquina == "desligada")
{
 if ( pode_publicar_mqtt == true)
 { 
  pode_publicar_mqtt = false; 
  publica_posicao(); // Publica para atualzar os ultimos valores
 }
 
}
  


client.loop();
  
}// Fecha Loop
