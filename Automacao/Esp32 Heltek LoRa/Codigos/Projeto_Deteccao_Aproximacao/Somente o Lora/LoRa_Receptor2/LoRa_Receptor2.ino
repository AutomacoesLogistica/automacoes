/*
 * 
 * 
 * CODIGO DO RECEPTOR DE LORA SEM REQUISIÇÃO, APENAS RECEBE CASO EXISTA ALGUM RADIO ENVIANDO E MOSTRA NO DISPLAY
 * ESP32 HELTEK 915 MHZ
 * 
 * 
 * 
 */


#include <SPI.h> //responsável pela comunicação serial
#include <LoRa.h> //responsável pela comunicação com o WIFI Lora
#include <Wire.h>  //responsável pela comunicação i2c

long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 1000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
boolean timer_enable = false;

// Definição dos pinos para o radio lora
#define SCK     5    // GPIO5  -- SX127x's SCK
#define MISO    19   // GPIO19 -- SX127x's MISO
#define MOSI    27   // GPIO27 -- SX127x's MOSI
#define SS      18   // GPIO18 -- SX127x's CS
#define RST     14   // GPIO14 -- SX127x's RESET
#define DI00    26   // GPIO26 -- SX127x's IRQ(Interrupt Request)

#define BAND    915E6  //Frequencia do radio - podemos utilizar ainda : 433E6, 868E6, 915E6

int packetSize = 0;
String dispositivo = "PC-02.001";

String Sinal = "RSSI -- "; // Para receber a intensidade do sinal
String Tamanho_do_Pacote = "--"; // Para receber o tamanho do pacote recebido
String readString ; // Para receber o pacote 
boolean conectado = 0;
boolean vezes = 0;
int incremento = 0;
String ultima_msg = "";

void setup() 
{
 Serial.begin(9600);
 pinMode(12,OUTPUT); 
 digitalWrite(12,0); 
  pinMode(13,OUTPUT); 
 digitalWrite(13,0);  
 pinMode(16,OUTPUT); // Define a porta de alimentação do display OLED como saida
 digitalWrite(16, LOW); // Desliga para dar um reset em qualquer configuracao existente no display
 delay(50); 
 digitalWrite(16, HIGH); // enquanto o OLED estiver ligado, GPIO16 deve estar HIGH

 LoRa.setPins(SS,RST,DI00); //configura os pinos que serão utlizados para o radio (deve ser chamado antes do LoRa.begin)
 SPI.begin(SCK,MISO,MOSI,SS); //inicia a comunicação com o radio LORA
  
  //inicializa o Lora com a frequencia específica.
  if (!LoRa.begin(BAND)) {
    Serial.println("A inicializacao do radio LoRa falhou!");
    while (1);
  }
  else
  {
  //indica no display que inicilizou corretamente.
  Serial.println("LoRa Iniciado com Sucesso!");
  conectado = 0;
  Atualizar_dados();
  }
  
  LoRa.receive(); //habilita o Lora para receber dados
}
void Atualizar_dados()
{
  if (conectado == 1) // Conectado
  {
   
   String Placa = "";
   String Area = "";
   int posicao_string = 0;  //Monitora onde fica o ;
   
   readString.trim();
   posicao_string = readString.length()-1;
   Placa = readString.substring(0,8);
   Area = readString.substring(9,posicao_string);
   
   if ( Placa.length() == 8 && ((readString.substring(8,9))== ",") && (readString.substring(readString.length()-1,readString.length()) == ";"))
   {
   timer_enable = false; 
   Serial.print("Sinal = ");  // Sinal : primeira linha
   Serial.println(LoRa.packetRssi());
   Serial.print("Placa = ");// Tamanho Byte recebido : segunda linha
   Serial.println(Placa+","+Area+";");
   Serial.println(Area);// Pacote recebido : terceira linha
   // Ativa blink
   vezes = 1;
   packetSize = 0;
   }
   
   
  }
  else // Não esta conectado ou perdeu a conexão
  {
   if ( vezes == 0)
   {
   vezes = 1;
   timer_enable = true;
   Serial.println("Sem obstaculos por perto");
   Serial.print("Sinal = ");  // Sinal : primeira linha
   Serial.println(LoRa.packetRssi());
   }
  }
}
void loop() 
{
   AtualMillis = millis();    //Tempo atual em ms
   
   if ( timer_enable == true )
   {
    if (AtualMillis - UltimoMillis > intervalo) 
    { 
      UltimoMillis = AtualMillis;    // Salva o tempo atual
     Tempo();
    }
   }
   else
   {
    if (AtualMillis - UltimoMillis > intervalo/4) 
    { 
      UltimoMillis = AtualMillis;    // Salva o tempo atual
     Tempo2();
    }
   }
  
  packetSize = 0;
  
 packetSize = LoRa.parsePacket(); // Checa se chegou algum pacote Se for 0 nao recebeu nada, caso 1 recebeu
 if (packetSize)//caso tenha recebido pacote chama a função para configurar os dados que serão mostrados em tela
 { 
  cbk(packetSize);  // Chama o void cbk para tratar os dados do pacote packetSize
  
 }
 else
 {
  incremento++;
  if(incremento >= 55350) //Não mudar este valor, esta saindo para perca de sinal proximo a 3segundos
  {
   conectado = 0;
   incremento = 0;
   vezes = 0;
   Atualizar_dados();
  }
 }
 
  
 
}

//função responsável por recuperar o conteúdo do pacote recebido
//parametro: tamanho do pacote (bytes)
void cbk(int packetSize) 
{
  readString ="";
  Tamanho_do_Pacote = String(packetSize,DEC); //transforma o tamanho do pacote em String para imprimirmos
  for (int i = 0; i < packetSize; i++) { 
    readString += (char) LoRa.read(); //recupera o dado recebido e concatena na variável "packet"
  }
  Sinal = "Sinal    " + String(LoRa.packetRssi(), DEC)+ " dB"; //Busca a intensidade da conecxao em "Lora.packetRssi(), transforma para DEC e converte em String para exibir na tela
  int valor = LoRa.packetRssi()*-1;
  
  if (valor <70)
  {
  conectado = 1;
  incremento = 0;
  Atualizar_dados();
  vezes = 1;
  }
  else
  {
    incremento++;
   if(incremento >= 488000) //Não mudar este valor, esta saindo para perca de sinal proximo a 2segundos
   {
    Serial.println("Sem obstaculos por perto");
    Serial.print("Sinal = ");  // Sinal : primeira linha
   Serial.println(LoRa.packetRssi());
    timer_enable = true;
    //desativa blink
    incremento = 0;
   }
  }
} 

void Tempo()
{
digitalWrite(12,!digitalRead(12));  
digitalWrite(13,0);  
}
void Tempo2()
{
digitalWrite(12,!digitalRead(12));
//digitalWrite(13,!digitalRead(13));  
  
}
