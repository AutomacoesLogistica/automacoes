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


char ssid[] = "iPhone Bruno";       // Nome da sua rede WIFI
char password[] = "12345678";       // Senha da sua rede WIFI
#define API_KEY "AIzaSyC-cM2Qbaf8JDBGoPbHx-rc8dn5JO0w2RY"  // dados da sua API-KEY que deve ser criada e abilitado YouTube Data em API's dentro da sua conta
#define CHANNEL_ID "UCV0Izow6n1wyt03qW1vb9yA" // ID do seu canal, clicando em configurações e abaixo da foto em avançado.


WiFiClientSecure client;
YoutubeApi api(API_KEY, client);

unsigned long api_mtbs = 180000; // Tempo de requisição no site do YouTube ( de 3 em 3 s ) .    Este valor não pode ser muito baixo pois temos limites de acesso de requisição diario
unsigned long api_lasttime;    // Valor do ultimo tempo para referencia no millis
long subs = 0;

void setup() 
{
 Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.disconnect();
  delay(100);
  Serial.print("Conectando no Wifi: ");
  Serial.println(ssid); // Busca nome da rede que esta sendo criado a conexão
  WiFi.begin(ssid, password); // Verifica a conexão atraves dos parametros definidos acima da rede WIFI
  while (WiFi.status() != WL_CONNECTED) // Enquanto aguarda conexão preenche com pontos
  {
    Serial.print(".");
    delay(500);
  }
  Serial.println(""); // Caso conecte, pula uma linha e escreve conectado!
  Serial.println("WiFi conectado!");
  Serial.println("IP address: ");
  IPAddress ip = WiFi.localIP(); // Busca Ip na rede que foi atribuido para o ESP8266 e atribui na variavel "ip"
  Serial.println(ip);
  Serial.println("");

}

void loop()
{

  if (millis() - api_lasttime > api_mtbs)   // Executa sempre que o millis for verdadeiro ************************************************************************************************
  {
    if(api.getChannelStatistics(CHANNEL_ID)) // Verifica se está tudo ok com sua credencial 
    {
      Serial.println("---------Status do Canal---------");
      Serial.print("Nome do Canal: ");
      Serial.println(" BGautomacoes");
      Serial.print("Numero de Seguidores do Canal: ");
      Serial.println(api.channelStats.subscriberCount); //Busca número de assinantes do canal
      Serial.print("Numero de Vizualizacoes: ");
      Serial.println(api.channelStats.viewCount); // Busca número geral de vizualizações
      Serial.print("Numero de Comentarios: ");
      Serial.println(api.channelStats.commentCount); // Busca número de comentários do canal
      Serial.print("Numero de Videos no Canal: ");
      Serial.println(api.channelStats.videoCount); // Busca número de videos do canal
      Serial.println("---------------------------------");
    }
    else
    {
      Serial.println("Existe alguma falha, verifique sua API-KEY , seu ID canal e se esta ativo API do YouTube dentro do Email");
    }
    api_lasttime = millis();
  }
}
