#include <ESP8266WiFi.h>
#include <PubSubClient.h>

long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 60000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
boolean ativado = 0;

const char *Usuario     = "Casa_Bruno2";
const char *Senha = "casabruno2@@";

String local = "interfone"; // aqui é o local onde sera publicado

// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.2.200" //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variÃ¡vel abaixo)
#define servidor_mqtt_usuario     "brunogon"  //UsuÃ¡rio
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/interfone/comando"    //  PARA TROCAR SELECIONAR "arvore_natal" , DAR CONTROL+F E TROCAR PARA O LOCAL DESEJADO monitor_tensao_xxxx


String Mensagem_Enviar;



IPAddress staticIP(192, 168, 80, 150);
IPAddress gateway(192, 168, 80, 1);
IPAddress mascara(255, 255, 255, 0);

WiFiClient interfone;                                 //Instância do WiFiClient
PubSubClient client(interfone);  

String readString;
int vezes = 0; // Para registrar quantas vezes tocou e a pessoa insistiu
boolean vezes_desligado = 0;
boolean vezes_em_uso = 0;
boolean vezes_no_gancho = 0;
boolean vezes_chamando = 0;

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
  if(Enviar == "ligar")
  {
   
  }
  
} //fecha recebe mensagem



//Função que reconecta ao servidor MQTT
void reconectar() {
  //Repete até conectar
  while (!client.connected()) {
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação.
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("interfone", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("interfone");

    if (conectado) {
      Serial.println("Conectado_MQTT,");
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
    } else {
      Serial.println("Reconectando MQTT novamente em 0.2 segundos");
      delay(1000);
    }
  }
}
void setup()
{
 Serial.begin(115200);
 WiFi.mode(WIFI_STA);
  WiFi.begin(Usuario, Senha);
  WiFi.config(staticIP, gateway, mascara);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi conectado com");
  Serial.println("IP: ");
  Serial.println(WiFi.localIP());
  Serial.println("");
  //Informando ao client do PubSub a url do servidor e a porta.
  int portaInt = atoi(servidor_mqtt_porta);
  client.setServer(servidor_mqtt, portaInt);
  client.setCallback(atualizar_mensagem);
   
}

void resumo()
{
 ativado = 0;
 if(vezes >=2)
 {
  Serial.print("O interfone tocou ");
  Serial.print(vezes);
  Serial.println(" vezes e nao foi atendido");
 }
  
}

void loop() {
  

  if (!client.connected())
  {
    reconectar();
  }
 
    int leitura;
    leitura =analogRead(A0);
    Serial.println(leitura);
    if(leitura <= 17 && vezes_desligado == 0)
    {
     Serial.println("Desligado");
     client.publish("dev/test/interfone/status","Desligado");
     vezes_desligado = 1;  
     vezes_em_uso = 0;
     vezes_no_gancho = 0; 
     vezes_chamando = 0;
     delay(1000);
    }
    else if (leitura >= 18 && leitura <= 48 && vezes_em_uso == 0)
    {
     Serial.println("Em Uso");
     client.publish("dev/test/interfone/status","Em Uso");
     vezes_desligado = 0;  
     vezes_em_uso = 1;
     vezes_no_gancho = 0; 
     vezes_chamando = 0;
     delay(1000);
    }
    else if (leitura >= 55 && leitura <= 75 && vezes_no_gancho == 0 && ativado == 0)
    {
     Serial.println("No Gancho");
     client.publish("dev/test/interfone/status","No Gancho");
     vezes_desligado = 0;  
     vezes_em_uso = 0;
     vezes_no_gancho = 1; 
     vezes_chamando = 0;
     ativado = 0; // Desativa contar o tempo
     vezes = 0; // Zera quantas vezes chamou
     delay(1000);
    }
    else if (leitura >= 80 && vezes_chamando == 1) // Esse para caso chame mais de uma vez, zere o tempo de 1 minuto somando mais 1 min a cada chamada e da um relatorio em seguida
    {
     client.publish("dev/test/interfone/status","Chamando");
     Serial.println("Chamando");
     delay(1000);
     ativado = 1; // Ativa contar o tempo
     vezes++; 
     UltimoMillis = AtualMillis; // Iguala os tempos para contar certo 1 minuto
    }
    else if (leitura >= 80 && vezes_chamando == 0)
    {
     client.publish("dev/test/interfone/status","Chamando");
     Serial.println("Chamando");
     delay(1000);
     ativado = 1; // Ativa contar o tempo
     vezes++; 
     UltimoMillis = AtualMillis; // Iguala os tempos para contar certo 1 minuto
     vezes_desligado = 0;  
     vezes_em_uso = 0;
     vezes_no_gancho = 0; 
     vezes_chamando = 1;
    }
  
    AtualMillis = millis();    //Tempo atual em ms
    
    if (AtualMillis - UltimoMillis > intervalo) 
    { 
      UltimoMillis = AtualMillis;    // Salva o tempo atual
      if( ativado == 1 )
      {
       resumo();
      }
    }
  client.loop();
  delay(200);
}
