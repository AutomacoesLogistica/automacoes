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

#define rele1 14 // rele do reader D5
#define rele2 12 // Rele do radio D6


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







// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "138.0.77.81"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "logistica"  //UsuÃ¡rio
#define servidor_mqtt_senha       "logistica2019@@"  //Senha
#define mqtt_topico_sub           "gerdau/comando/+/+"    


IPAddress staticIP(10,10,25,90);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
WiFiClient ESP_Central_Supervisorio;                                 //Instância do WiFiClient
PubSubClient client(ESP_Central_Supervisorio);                       //Passando a instância do WiFiClient para a instância do PubSubClient
float bateria2 = 0.00;

bool precisaSalvar = false; //Flag para salvar os dados
String atualiza;

String readString;



// DADOS PARA O TIMER DE LIGAR MAQUINA
long UltimoMillis_Ligada = 0;        // Variável de controle do tempo
long intervalo_Ligada = 5000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis_Ligada;

// DADOS PARA O TIMER DE DESLIGAR MAQUINA
long UltimoMillis_Desligada = 0;        // Variável de controle do tempo
long intervalo_Desligada = 10000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis_Desligada;
long UltimoMillis_Desligada2 = 0;        // Variável de controle do tempo
long intervalo_Desligada2 = 20000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis_Desligada2;

// DADOS PARA O TIMER DE GPS
long UltimoMillis_Gps = 0;        // Variável de controle do tempo
long intervalo_Gps = 6600;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis_Gps;



#define Led_Wifi 16
#define Led_Mqtt 10


//Função que será chamada ao receber mensagem do servidor MQTT ***************************************************************************************************************************
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
 delay(200);
 digitalWrite(Led_Mqtt,HIGH);
  
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
} //fecha recebe mensagem ***************************************************************************************************************************************************************

void liga_rele1()
{
  digitalWrite(rele1,LOW);// Liga o rele atua em low
  Mensagem_Enviar = "rele1_"+carregadeira+"_on"; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele1";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 1 ligado
  readString ="";
  delay(200);
  publica_status();
}
void desliga_rele1()
{
  digitalWrite(rele1,HIGH);// Desliga o rele pois o rele atua em low
  Mensagem_Enviar = "rele1_"+carregadeira+"_off";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele1";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 1 desligado 
  readString =""; 
  delay(200);
  publica_status();
}

void liga_rele2()
{
  digitalWrite(rele2,LOW);// Liga pois o rele atua em low
  Mensagem_Enviar = "rele2_"+carregadeira+"_on";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele2";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 2 ligado 
  readString ="";
  delay(200);
}
void desliga_rele2()
{
  digitalWrite(rele2,HIGH);// Desliga pois o rele atua em low
  Mensagem_Enviar = "rele2_"+carregadeira+"_off"; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele2";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 2 desligado 
  readString =""; 
  delay(200);
}

void atualiza_temp_umidade()
{
 delay(dht.getMinimumSamplingPeriod()); // Tempo espera minimo para atualização
 float humidity = dht.getHumidity();
 float temperature = dht.getTemperature();
  
 // Criando o valor de umidade no mqtt ************************************************************************************************************************************************
 umidade = String(humidity,1) + " %";
 Mensagem_Enviar = umidade; // Busca o valor de umidade do sensor e salva na variavel 
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 topico = "gerdau/"+carregadeira+"/umidade";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a umidade
 delay(200);
 // Criando o valor de temperatura no mqtt *******************************************************************************************************************************************
 temperatura = String(dht.computeHeatIndex(temperature, humidity, false), 1) + " ºC";
 Mensagem_Enviar = temperatura;  // Busca o valor de temperatura do sensor e salva na variavel
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/"+carregadeira+"/temp";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a temperatura
 //**********************************************************************************************************************************************************************************
 delay(200);
 readString =""; // Limpa mensagem recebida
 
 publica_bateria();
 
}

void publica_bateria()
{
 

// Criando o valor de tensão bateria no mqtt ************************************************************************************************************************************************
 String bateria = String(valor,2) + " V";
 Mensagem_Enviar = bateria; // Busca o valor de umidade do sensor e salva na variavel 
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 topico = "gerdau/"+carregadeira+"/bat";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a umidade
 delay(200);
 publica_status();
}

void publica_status()
{
 String maquina2 = ""; 
 if (maquina == "desligada"){maquina2 = "Desligada!";}
 if (maquina == "ligada"){maquina2 = "Ligada!";}
 String maq = String(maquina2);
 Mensagem_Enviar = maq; // Busca o valor de umidade do sensor e salva na variavel 
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 topico = "gerdau/"+carregadeira+"/status";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a umidade
 delay(200);

 
}

void setup()
{
 Serial.begin(115200);
 dht.setup(0, DHTesp::DHT11); // Conectado na porta D3
 pinMode(Led_Wifi,OUTPUT);
 digitalWrite(Led_Wifi,LOW);
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
                     client.connect("ESP_Central_Supervisorio", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("ESP_Central_Supervisorio");

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
       Serial.println("Reconectando MQTT novamente em 5 segundos");
      //Aguarda 5 segundos para tentar novamente
      digitalWrite(Led_Mqtt,LOW);
      delay(2000);
    }
  }
}


void publica_posicao()
{
 // Criando o valor de latitude no mqtt *******************************************************************************************************************************************
 //gerdau/localizacao/latitude/pc01
 String latitude2 = String(media_lat, 6);
 Mensagem_Enviar = latitude2;
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/localizacao/latitude/"+carregadeira;
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a latitude
 delay(200);
 
 // Criando o valor de longitude no mqtt *******************************************************************************************************************************************
 //gerdau/localizacao/longitude/pc01
 String longitude2 = String(media_lon, 6);
 Mensagem_Enviar = longitude2;
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/localizacao/longitude/"+carregadeira;
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a longitude
 delay(200);
 //**********************************************************************************************************************************************************************************
 
 // Criando o valor de latitude+longitude no mqtt *******************************************************************************************************************************************
 //gerdau/pc01/coordenada
 Mensagem_Enviar = latitude2 + "," + longitude2;
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/"+carregadeira+"/coordenada";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a longitude
 delay(200);
 //**********************************************************************************************************************************************************************************


 atualiza_temp_umidade();


  
} // Fecha o publica posicao


void loop()
{
 bateria2 = analogRead(A0);
 valor = ((analogRead(A0)*2.68/884)-0.02)*11.37;


// VERIFICA PARA LIGAR A MAQUINA *******************************************************************************************************************************************************
if ( valor >=27.5 && maquina == "desligada" )
{
  maquina = "ligada";
  timer_ligada = true;
  timer_desligada = false;
  timer_desligada2 = false;
}

// VERIFICA PARA DESLIGAR A MAQUINA *******************************************************************************************************************************************************
if ( valor <=25.5 && maquina == "ligada" )
{
  maquina = "desligada";
  timer_ligada = false;
  timer_desligada = true;
}




 
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************
// BLOCO DE TIMER GERAL ****************************************************************************************************************************************************************

// VERIFICAÇÃO SOMENTE QUANDO A MAQUINA ESTA LIGADA **********************************************************************************************************************************
if (timer_ligada == true)
{
 AtualMillis_Ligada = millis();    //Tempo atual em ms 
 if (AtualMillis_Ligada - UltimoMillis_Ligada > intervalo_Ligada) // timer de 5 segundos
 { 
  UltimoMillis_Ligada = AtualMillis_Ligada;    // Salva o tempo atual
  liga_rele1();// Liga o relé do reader
  liga_rele2();// Liga o relé do radio
  timer_ligada = false; // Desliga o timer para não ficar religando ja estando ligado!
 }
}
else
{
 AtualMillis_Ligada = millis();    //Tempo atual em ms 
 UltimoMillis_Ligada = AtualMillis_Ligada;    // Salva o tempo atual
}

// VERIFICAÇÃO SOMENTE QUANDO A MAQUINA ESTA DESLIGADA ******************************************************************************************************************************
if (timer_desligada == true)
{
  
 AtualMillis_Desligada = millis();    //Tempo atual em ms 
 if (AtualMillis_Desligada - UltimoMillis_Desligada > intervalo_Desligada) // timer de 5 segundos
 { 
  UltimoMillis_Desligada = AtualMillis_Desligada;    // Salva o tempo atual
  desliga_rele1();// Liga o relé do reader
  AtualMillis_Desligada2 = UltimoMillis_Desligada;
  UltimoMillis_Desligada2 = UltimoMillis_Desligada;
  timer_desligada2 = true;
 }
 
if (timer_desligada2 == true)
{
 AtualMillis_Desligada2 = millis();
 if(AtualMillis_Desligada2 - UltimoMillis_Desligada2 > intervalo_Desligada2) // timer de 5 segundos
 { 
  UltimoMillis_Desligada2 = AtualMillis_Desligada2;    // Salva o tempo atual
  desliga_rele2();// Liga o relé do radio
  timer_desligada = false; // Desliga o timer para não ficar religando ja estando ligado!
  timer_desligada2 = false; // Desliga o timer para não ficar religando ja estando ligado!
 }
}
 
}
else
{
  AtualMillis_Desligada = millis();    //Tempo atual em ms 
  UltimoMillis_Desligada = AtualMillis_Desligada;    // Salva o tempo atual
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
  
if (!client.connected()) 
{
 reconectar();
}

client.loop();
  
}// Fecha Loop
