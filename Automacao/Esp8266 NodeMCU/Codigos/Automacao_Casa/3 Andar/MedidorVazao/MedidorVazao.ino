#include <SPI.h>
#include <Wire.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
#include <ESP8266WebServer.h>

#include <PubSubClient.h>

const char *Usuario     = "AutomacaoLOG";
const char *Senha = "logistica2019@";
String local = "medidor_consumo_agua"; // aqui é o local onde sera publicado

int leitura;

String Mensagem_Enviar; 
String topico;
char Funcoes_topico[60];
char Funcoes[50];

// DEFINIÇÕES DE PINOS
#define pinTrigger 13//D7
#define pinEcho 15 //D8

// DECLARAÇÃO DE FUNÇÕES
float leituraSimples();
float calcularDistancia();
void sonarBegin(byte trig ,byte echo);

// DECLARAÇÃO DE VARIÁVEIS
float distancia;
float nivel;
float distancia_cheio = 20.2; // distancia cheio, ou seja, o valor do sensor até o nivel mais alto da caixa a ser medida
float distancia_vazio = 72.3; // distancia vazio, ou seja, o valor do sensor até o chao da caixa a ser medida
float constante = distancia_vazio-distancia_cheio;





// SERVIDOR RAPSBERRY MOSQUITTO
//Coloque os valores padrÃµes aqui, porÃ©m na interface eles poderÃ£o ser substituÃ­dos.
#define servidor_mqtt             "192.168.3.186"  //URL do servidor MQTT
#define servidor_mqtt_porta       "1883"  //Porta do servidor (a mesma deve ser informada na variavel abaixo)
#define servidor_mqtt_usuario     "brunogon"  // Usuario
#define servidor_mqtt_senha       "268300"  //Senha
#define mqtt_topico_sub           "dev/test/minhacasa/agua/+" 


IPAddress staticIP(192,168,20,70);
IPAddress gateway(192,168,20,1);
IPAddress mascara(255,255,255,0);
IPAddress dns(8,8,8,8);

boolean pode_publicar_mqtt = false;




 
#define LED_BUILTIN 16 // PINO D0
#define SENSOR  14 // PINO D5
 
long TempoAtual = 0;
long TempoAnterior = 0;
int Intervalo = 1000;
boolean LedStatus = LOW;
float Fator_de_Calibracao = 4.5;
volatile byte Contagem_Pulsos;
byte Pulso_1_Segundo = 0;
float Quociente_Vazao;
unsigned long Vazao_Mililitros;
unsigned int Total_Mililitros;
float Vazao_Litros;
float Total_Litros;


WiFiClient medidor_consumo_agua;                                 //Instância do WiFiClient
PubSubClient client(medidor_consumo_agua);                       //Passando a instância do WiFiClient para a instância do PubSubClient

ESP8266HTTPUpdateServer atualizadorOTA_medidor_consumo_agua; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb_medidor_consumo_agua(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 Monitor de Consumo Água";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";

bool precisaSalvar = false; //Flag para salvar os dados
String readString;
#define Led_Wifi 10    //10   No lolin é 9
#define Led_Mqtt 16





void ConectarWIFI()
{
 WiFi.mode(WIFI_STA);
 WiFi.begin(Usuario, Senha);
 WiFi.config(staticIP, gateway, mascara,dns);
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

  
  servidorWeb_medidor_consumo_agua.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb_medidor_consumo_agua.send(200, "text/html", paginaWeb);}


void atualizar_mensagem(char* topico, byte* mensagem, unsigned int tamanho) 
{
 //Convertendo a mensagem recebida para string
 mensagem[tamanho] = '\0';
 String strMensagem = String((char*)mensagem);
 strMensagem.toLowerCase();
 String strTopico = String((char*)topico);
 strTopico.toLowerCase();
 //Serial.print("Chegou do MQTT: ");
 //Serial.print(strMensagem);
 //Serial.print("     - Topico  : ");
 //Serial.println(strTopico);
 
 String Enviar;
 String Topico;
 digitalWrite(Led_Mqtt,LOW);
 Enviar = strMensagem;
 Topico = strTopico;
 /*
           // MENSAGEM PARA ZERAR O MES *********************************************************************************************************************************
            if (primeira_mensagem_zerar == 1)
             {
              if( Topico == "dev/test/minhacasa/energia/funcao" && Enviar == "zerar") 
               {
                Serial.println("Zerando mes");
                valor_mensal = 0.00;
                valor_reais = (valor_mensal * valor_kwh);
                valor_acumulado = kwh_cemig + kwh_casa;
                atualiza();
               }    
             }
             if (primeira_mensagem_zerar == 0)
             {
              primeira_mensagem_zerar = 1;
             }
               
            //***********************************************************************************************************************************************************   
           
           // MENSAGEM PARA ALTERAR O VALOR DE KWH_CASA - SINCRONIZAR COM O MEDIDOR HIKING DO LABORATORIO ***************************************************************
           if (primeira_mensagem_kwh_casa == 1)
           {
            if( Topico == "dev/test/minhacasa/energia/kwh_casa" && Enviar != "vazio") 
            {
             Serial.print("Alterado o valor kwh_casa para ");
             Serial.println(Enviar);
             kwh_casa = Enviar.toDouble();
             atualiza();
            }
           }
           if (primeira_mensagem_kwh_casa == 0)
           {
            primeira_mensagem_kwh_casa = 1;
           }
          
           //***********************************************************************************************************************************************************   
          
           // MENSAGEM PARA ALTERAR O VALOR MENSAL DE CONSUMO - CALULO INICIAL > (VALOR HIKING + 468.14)- ULTIMO VALOR DO MEDIDOR CEMIG NA CONTA
           if (primeira_mensagem_valor_mensal == 1)
           {
            if( Topico == "dev/test/minhacasa/energia/valor_mensal" && Enviar != "vazio") 
            {
             Serial.print("Alterado o valor de valor_mensal para ");
             Serial.println(Enviar);
             valor_mensal = Enviar.toDouble();
             atualiza();
            }
           }
           if (primeira_mensagem_valor_mensal == 0)
           {
            primeira_mensagem_valor_mensal = 1;
           }
          
           //***********************************************************************************************************************************************************   
          
           // MENSAGEM PARA ALTERAR O VALOR DO KWH COM TAXAS EMBUTIDAS *************************************************************************************************
           if (primeira_mensagem_valor_kwh == 1)
           {
            if( Topico == "dev/test/minhacasa/energia/valor_kwh" && Enviar != "vazio") 
            { 
             valor_kwh = Enviar.toDouble();
             Mensagem_Enviar = String(Enviar);
             Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
             client.publish("dev/test/minhacasa/consumo/valor_kwh", Funcoes); // Publica o valor de kwh com taxas
            }
           }
           if (primeira_mensagem_valor_kwh == 0)
           {
            primeira_mensagem_valor_kwh = 1;
           }
          
           // **************************************************************************************************************************************************************
           if (primeira_mensagem_kwh_cemig == 1)
           {
            if( Topico == "dev/test/minhacasa/energia/kwh_cemig" && Enviar != "vazio") 
            {
             Serial.print("Alterado o valor kwh_cemig para ");
             Serial.println(Enviar);
             kwh_cemig = Enviar.toDouble();
             atualiza();
            }
           }
           if (primeira_mensagem_kwh_cemig == 0)
           {
            primeira_mensagem_kwh_cemig = 1;
           }
          
           // ************************************************************************************************************************************************************** 
           
*/

 
}// Fecha void recebe mensagem










 
void ICACHE_RAM_ATTR Conta_Pulsos()
{
  Contagem_Pulsos++;
}
 
 
void setup()
{
 Serial.begin(115200);  
 pinMode(Led_Wifi,OUTPUT);
 digitalWrite(Led_Wifi,LOW);
 delay(200);
 pinMode(Led_Mqtt,OUTPUT);
 digitalWrite(Led_Mqtt,LOW);
 ConectarWIFI();
 
 //Informando ao client do PubSub a url do servidor e a porta.
 int portaInt = atoi(servidor_mqtt_porta);
 client.setServer(servidor_mqtt, portaInt);
 client.setCallback(atualizar_mensagem);
 


 // Iniciar servidor atualizacao OTA
 atualizadorOTA_medidor_consumo_agua.setup(&servidorWeb_medidor_consumo_agua);
 servidorWeb_medidor_consumo_agua.begin();

 sonarBegin(pinTrigger,pinEcho);




 
  pinMode(LED_BUILTIN, OUTPUT);
  pinMode(SENSOR, INPUT_PULLUP);
 
  Contagem_Pulsos = 0;
  Quociente_Vazao = 0.0;
  Vazao_Mililitros = 0;
  Total_Mililitros = 0;
  TempoAnterior = 0;
 
  attachInterrupt(digitalPinToInterrupt(SENSOR), Conta_Pulsos, FALLING);
}




//Função que reconecta ao servidor MQTT
void reconectar() {
  
  //Repete até conectar
  if (!client.connected()) {
    digitalWrite(Led_Mqtt,LOW);
     //Serial.println("Tentando conectar ao servidor MQTT...");
    
    //Tentativa de conectar. Se o MQTT precisa de autenticação, será chamada a função com autenticação, caso contrário, chama a sem autenticação. 
    bool conectado = strlen(servidor_mqtt_usuario) > 0 ?
                     client.connect("medidor_consumo_agua", servidor_mqtt_usuario, servidor_mqtt_senha) :
                     client.connect("medidor_consumo_agua");

    if(conectado) {
      digitalWrite(Led_Mqtt,HIGH);
       Serial.println("Conectado_MQTT,");
       //Subscreve para monitorar os comandos recebidos
      client.subscribe(mqtt_topico_sub, 1); //QoS 1
            
     
    } else {
       //Serial.println("Falhou ao tentar conectar. Codigo: ");
       //Serial.println(String(client.state()).c_str());
       Serial.println("Reconectando MQTT novamente em 0.5 segundos");
      //Aguarda 5 segundos para tentar novamente
      digitalWrite(Led_Mqtt,LOW);
      
    }
  }
}



void publicar()
{
 //Serial.println("Publicou");
 // PUBLICA O VALOR DA VAZAO
 Mensagem_Enviar = String(Quociente_Vazao);
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 client.publish("dev/test/minhacasa/agua/vazao/1", Funcoes); // Publica o valor da vazao 
 // PUBLICA O VALOR DO CONSUMO
 Mensagem_Enviar = String(Total_Litros);
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 client.publish("dev/test/minhacasa/agua/consumo/1", Funcoes); // Publica o valor do consumo

  distancia = calcularDistancia();
  nivel = 100-(((distancia-distancia_cheio)*100)/constante);
  if(nivel <0){nivel = 0.00;}
  if(nivel >100){nivel = 100.00;}
  /*
  Serial.print("Distancia medida : ");
  Serial.print(distancia);
  Serial.print(" cm,    Nivel : ");
  Serial.print(nivel);
  Serial.println(" %");
  */
  // PUBLICA O VALOR DO NIVEL
  Mensagem_Enviar = String(nivel);
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/minhacasa/agua/nivel/1", Funcoes); // Publica o valor do nivel

  // PUBLICA O VALOR DA DISTANCIA LIDA EM CM
  Mensagem_Enviar = String(distancia);
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  client.publish("dev/test/minhacasa/agua/distancia/1", Funcoes); // Publica o valor da distancia lida em cm
}


// IMPLEMENTO DE FUNÇÕES

void sonarBegin(byte trig ,byte echo) {

  #define divisor 58.0
  #define intervaloMedida 10 // MÁXIMO 35 mS PARA ATÉ 6,0M MIN 5mS PARA ATÉ 0,8M
  #define qtdMedidas 20 // QUANTIDADE DE MEDIDAS QUE SERÃO FEITAS
  
  pinMode(trig, OUTPUT); 
  pinMode(echo, INPUT);
  
  digitalWrite(trig, LOW); // DESLIGA O TRIGGER E ESPERA 500 uS
  delayMicroseconds(500);

}

float calcularDistancia() {

  float leituraSum = 0;
  float resultado = 0;
  
  for (int index = 0; index < qtdMedidas; index++) {

    delay(intervaloMedida);
    leituraSum += leituraSimples();

  }

  resultado = (float) leituraSum / qtdMedidas;
  resultado = resultado + 2.2;
  
  return resultado;

}

float leituraSimples() {

  long duracao = 0; 
  float resultado = 0;
  
  digitalWrite(pinTrigger, HIGH); 

  delayMicroseconds(10); 
  digitalWrite(pinTrigger, LOW);

  duracao = pulseIn(pinEcho, HIGH);

  resultado = ((float) duracao / divisor);
  
  return resultado;

}
 
void loop()
{
  TempoAtual = millis();
  if (TempoAtual - TempoAnterior > Intervalo) 
  {
    
    Pulso_1_Segundo = Contagem_Pulsos;
    Contagem_Pulsos = 0;
 
    // Como este loop pode não ser concluído em exatamente 1 segundo, calculamos
    // o número de milissegundos que se passaram desde a última execução e usa
    // isso para dimensionar a saída. Também aplicamos o Fator_de_Calibracao para dimensionar a saída
    // com base no número de pulsos por segundo por unidades de medida (litros / minuto em
    // neste caso) vindo do sensor de vazao instalado.
    Quociente_Vazao = ((1000.0 / (millis() - TempoAnterior)) * Pulso_1_Segundo) / Fator_de_Calibracao;
    TempoAnterior = millis();
 
    // Divida a taxa de fluxo em litros / minuto por 60 para determinar quantos litros
    // passou pelo sensor neste intervalo de 1 segundo, então multiplique por 1000 para
    // converter para mililitros.
    Vazao_Mililitros = (Quociente_Vazao / 60) * 1000;
    Vazao_Litros = (Quociente_Vazao / 60);
 
    // Adicione os mililitros passados ​​neste segundo ao total acumulado
    Total_Mililitros += Vazao_Mililitros;
    Total_Litros += Vazao_Litros;
    /*
    // Imprima a taxa de fluxo para este segundo em litros / minuto
    Serial.print("Quociente de Vazao : ");
    Serial.print(float(Quociente_Vazao));  // Imprime o valor
    Serial.print("L/min");
    Serial.print("\t");       // Espaço da guia de impressão
     
     // Imprime o total acumulado de litros fluidos desde o início
    Serial.print("Quantidade de líquido de saída: ");
    Serial.print(Total_Mililitros);
    Serial.print("mL / ");
    Serial.print(Total_Litros);
    Serial.println("L");
   */
   if(WiFi.status() != WL_CONNECTED)
   {
    ConectarWIFI();
   }
   else
   {
    publicar();
   }
  } // Fecha o if do Millis
  
   if (!client.connected()) 
{
 reconectar(); // Reconecta no MQTT
} 



 // VERIFICA SE WIFI ESTA CONECTADO, SE ESTIVER, CHAMA ATUALIZACAO DA PAGINA OTA, SENAO, RECONECTA
 if(WiFi.status() != WL_CONNECTED) 
 {
  ConectarWIFI();
 }
 else
 {
  servidorWeb_medidor_consumo_agua.handleClient();
 }
 
 
 client.loop();
}// Fecha Loop
