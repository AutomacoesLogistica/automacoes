/*
 *    CONTADOR DE ESTATISTICAS DO CANAL DO YOU TUBE
 * 
 *  Para este projeto funcionar você deve
 *  > Ter instalado a biblioteca YoutubeApi.h
 *  > ArduinoJson.h intalado para executar dentro do arduino codigos para ESP8266 NODEMCU
 *  > Ter um email ativo para trabalhar com API do YouTube Data API V3 ( Era a 3 quando foi criado o código )
 *  > Usar a API no mesmo email do canal do YouTube
 *  
 *  
 *  Desenvolvido por: BGautomacoes
 *  Data : 12/01/2018 as 21:30
 *  
 */


 
#include <YoutubeApi.h>
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>

#include <ArduinoJson.h> // Necessário ter esta biblioteca para rodar projetos do ESP dentro do Arduino


char ssid[] = "Bruno";       // Nome da sua rede WIFI
char password[] = "bruno268300";       // Senha da sua rede WIFI
#define API_KEY "AIzaSyC-cM2Qbaf8JDBGoPbHx-rc8dn5JO0w2RY"  // dados da sua API-KEY que deve ser criada e abilitado YouTube Data em API's dentro da sua conta
#define CHANNEL_ID "UCV0Izow6n1wyt03qW1vb9yA" // ID do seu canal, clicando em configurações e abaixo da foto em avançado.


WiFiClientSecure client;
YoutubeApi api(API_KEY, client);

unsigned long espera_coleta_youtube = 180000; // Tempo de requisição no site do YouTube ( de 3 em 3 s ) .    Este valor não pode ser muito baixo pois temos limites de acesso de requisição diario
unsigned long tempo_ultima_coleta_youtube;    // Valor do ultimo tempo para referencia no millis
long subs = 0;


long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 1000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;



String nome_do_canal = " - - ";
String nome_do_canal2 = "BGautomacoes";
String n_seguidores = "0";
String n_visualizacoes = "0";
String n_comentarios = "0";
String n_videos = "0";

void setup() 
{
 Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.disconnect();
  delay(100);
  WiFi.begin(ssid, password); // Verifica a conexão atraves dos parametros definidos acima da rede WIFI
  while (WiFi.status() != WL_CONNECTED) // Enquanto aguarda conexão preenche com pontos
  {
   delay(100);
  }
  IPAddress ip = WiFi.localIP(); // Busca Ip na rede que foi atribuido para o ESP8266 e atribui na variavel "ip"
}

void enviar()
{
 Serial.print(nome_do_canal);
 Serial.print(",");
 Serial.print(n_seguidores);//Busca número de seguidores do canal
 Serial.print(".");
 Serial.print(n_visualizacoes);// Busca número geral de vizualizações
 Serial.print(">");
 Serial.print(n_comentarios);// Busca número de comentarios do canal
 Serial.print(";");
 Serial.print(n_videos);// Busca número de videos do canal
 Serial.println(" *"); // Não retirar o espaço antes do * pois ira gerar falha na coleta de dados
}





void loop()
{

  if (millis() - tempo_ultima_coleta_youtube > espera_coleta_youtube)   // Executa sempre que o millis for verdadeiro ************************************************************************************************
  {
    if(api.getChannelStatistics(CHANNEL_ID)) // Verifica se está tudo ok com sua credencial 
    {
     nome_do_canal = nome_do_canal2; // Atribui em nome do canal o valor definido em setup
     
     if ( api.channelStats.subscriberCount !=0 )
     {     
      n_seguidores =api.channelStats.subscriberCount;//Busca número de seguidores do canal
     }

     if (api.channelStats.viewCount!=0)
     {
      n_visualizacoes =api.channelStats.viewCount;// Busca número geral de vizualizações
     }

     if (api.channelStats.commentCount!=0)
     {
      n_comentarios = api.channelStats.commentCount;// Busca número de comentarios do canal
     }

     if (api.channelStats.videoCount!=0)
     {
      n_videos =api.channelStats.videoCount;// Busca número de videos do canal
     }
     
    }
    tempo_ultima_coleta_youtube = millis();
  }

 AtualMillis = millis();    //Tempo atual em ms
  
  if (AtualMillis - UltimoMillis > intervalo) 
  { 
    UltimoMillis = AtualMillis;    // Salva o tempo atual
   enviar();
    
  }
}




