/*
   
   CENTRAL PLACA DE AUTOMACAO - 3 ANDAR
   ARDUINO PRO MINI   - Trabalha em rede RS485 com um ESP8266 conectado na rede via MQTT

   Conexão do modulo RS485 Recebe as mensagens do esp8266 via MQTT e atualiza as saidas
   RO = Pino 3
   DI = Pino 4
   DE = Pino 2 Pino para ativar transmissao
   RE = Pino 2 Pino para ativar transmissao

   Data = Pino 5         Usado no modulo relé serial
   Clock = Pino 6        Usado no modulo relé serial
   LedStatus = Pino 13  Usado para toda recepcao de mensagem piscar o led d status
   
   DEFINICAO DOS RELES

   Sala   **************************************************   
   
   steto = 0;     // Rele1_1
   slustre = 0;   // Rele2_1
   svaranda = 0;  // Rele3_1
   spainel = 0;   // Rele4_1
   scorti = 0;    // Rele5_1
   
   Quarto 1  ***********************************************
   
   q1teto = 0;    // Rele6_1
   q1painel = 0;  // Rele7_1
   q1corti = 0;   // Rele8_1

   Quarto 2  ***********************************************
   
   q2teto = 0;    // Rele1_2
   q2painel = 0;  // Rele2_2
   q2corti = 0;   // Rele3_2
   
   Cozinha   ***********************************************
   
   czteto = 0;     // Rele4_2
   czcorredor = 0; // Rele5_2
   czpendente = 0; // Rele6_2
   czpia = 0;      // Rele7_2
   czpersi = 0;    // Rele8_2
   czpainel = 0;   // Rele1_3
   
   Quarto de Casal *****************************************
   qcteto = 0;    // Rele2_3
   qcpainel = 0;  // Rele3_3
   qccorti = 0;   // Rele4_3

   Closet  ************************************************
   
   clteto = 0;    // Rele5_3
   clinter = 0;   // Rele6_3
   clesp = 0;     // Rele7_3
   
   Espaco Gourmet *****************************************
   
   egteto = 0;      // Rele8_3
   egpendente = 0;  // Rele1_4
   egchurras = 0;   // Rele2_4
   egpersi = 0;     // Rele3_4
   eg2teto = 0;     // Rele4_4
   
   Laboratorio *********************************************
   
   lbteto = 0;      // Rele5_4
   lbpersi = 0;     // Rele6_4
   lbventi = 0;     // Rele7_4
   
   Banheiro Social *****************************************
   
   soteto = 0;    // Rele8_4
   soesp = 0;     // Rele1_5
   soambi = 0;    // Rele2_5

   Banheiro Suite ******************************************
   
   suteto = 0;    // Rele3_5
   suesp = 0;     // Rele4_5
   suambi = 0;    // Rele5_5

   Acesso    ***********************************************
   
   ac1teto = 0;   // Rele6_5
   ac2teto = 0;   // Rele7_5
   ac2ambi = 0;    // Rele8_5
   
   
   RTC I2C
   SDA = A4
   SCL = A5
   
*/

#include <SerialRelayBruno.h>
const int NumeroModulos = 5;    // Maximo de 10 ( 80 reles )
SerialRelayBruno reles(5,6,NumeroModulos); // (data, clock, Numero de Modulos)


// Criando dados para o relogio RTC I2C
#include <Wire.h>        //Biblioteca para manipulação do protocolo I2C
#include <DS3231.h>      //Biblioteca para manipulação do DS3231
DS3231 RTC;              //Criação do objeto do tipo DS3231
RTCDateTime dataehora;   //Criação do objeto do tipo RTCDateTime
int dia;
int mes;
int ano; 
int hora;
int minuto;
int segundo;


// Dados para o millis()
long UltimoMillis = 0;        // Variável de cDesligarReletrole do tempo
long intervalo = 20000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;



#include<SoftwareSerial.h>
#define transmitir 2 // Pino DE e RE - Transmissao
#define pinRX 3 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);

#define LedStatus 13 // Pino para quando receber mensagem piscar definido na porta 7
String readString; // Variavel pra cDesligarRelecatenar dados da serial
char MensagemRecebida[15]; // Usado para receber e concaternar as mensagens
char* MensagemParaImprimir;
int intertrava = 0; // Serve para bloqueio e aciDesligarRelear apenas uma unica vez
int n_de_lampada = 0;

// Variaveis da automacao


// Sala  **************************************************
boolean steto = 0;     // Rele1_1
boolean slustre = 0;   // Rele2_1
boolean svaranda = 0;  // Rele3_1
boolean spainel = 0;   // Rele4_1
boolean scorti = 0;    // Rele5_1
   
// Quarto 1  ***********************************************
boolean q1teto = 0;    // Rele6_1
boolean q1painel = 0;  // Rele7_1
boolean q1corti = 0;   // Rele8_1

// Quarto 2  ***********************************************
boolean q2teto = 0;    // Rele1_2
boolean q2painel = 0;  // Rele2_2
boolean q2corti = 0;   // Rele3_2

// Cozinha   ***********************************************
boolean czteto = 0;     // Rele4_2
boolean czcorredor = 0; // Rele5_2
boolean czpendente = 0; // Rele6_2
boolean czpia = 0;      // Rele7_2
boolean czpersi = 0;    // Rele8_2
boolean czpainel = 0;   // Rele1_3
   
// Quarto de Casal *****************************************
boolean qcteto = 0;    // Rele2_3
boolean qcpainel = 0;  // Rele3_3
boolean qccorti = 0;   // Rele4_3

// Closet  ************************************************
boolean clteto = 0;    // Rele5_3
boolean clinter = 0;   // Rele6_3
boolean clesp = 0;     // Rele7_3

//  Espaco Gourmet *****************************************
boolean egteto = 0;      // Rele8_3
boolean egpendente = 0;  // Rele1_4
boolean egchurras = 0;   // Rele2_4
boolean egpersi = 0;     // Rele3_4
boolean eg2teto = 0;     // Rele4_4
   
// Laboratorio *********************************************
boolean lbteto = 0;      // Rele5_4
boolean lbpersi = 0;     // Rele6_4
boolean lbventi = 0;     // Rele7_4
   
// Banheiro Social *****************************************
boolean soteto = 0;    // Rele8_4
boolean soesp = 0;     // Rele1_5
boolean soambi = 0;    // Rele2_5

// Banheiro Suite ******************************************
boolean suteto = 0;    // Rele3_5
boolean suesp = 0;     // Rele4_5
boolean suambi = 0;    // Rele5_5

// Acesso    ***********************************************
boolean ac1teto = 0;   // Rele6_5
boolean ac2teto = 0;   // Rele7_5
boolean ac2ambi = 0;    // Rele8_5*/




void setup() 
{
 RS485.begin(9600);      //Inicialização da rede RS485
 Serial.begin(9600);     //Inicialização da Serial
 RTC.begin();            //Inicialização do RTC DS3231
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW);
 pinMode(LedStatus, OUTPUT); // Define LedMensagem como saida
 digitalWrite(LedStatus, HIGH); // Inicia ligado 

 // Desligando todos os reles
 for(int i=1 ; i <= NumeroModulos ; i++)
 {
  for(int j=1 ; j <= 8 ; j++)
  {
   reles.SetRelay(j, DesligarRele, i);
  }
  delay(20);
 }

} // Fecha o void setup



void loop() 
{

 // Se recebeu dados da rede RS485 MODBUS 
 while (RS485.available())
 {
  delay(3);
  char c = RS485.read();
  readString += c;
 }


 // Se a rede serial estiver disponivel ou digitado no serial monitor
 while (Serial.available())
 {
  delay(3);
  char c = Serial.read();
  readString += c;
 }


  // Se existe alguma mensagem 
 if (readString.length() > 0 && readString.length() < 13)
 {
  digitalWrite(LedStatus, 0);
  delay(150);
  digitalWrite(LedStatus, 1);
  delay(150);
  imprimir(); // Chama o void para verificar o que deve ser feito
 }
 

 // Millis para atualizar a hora a cada 60 segundos
 AtualMillis = millis();    //Tempo atual em ms
 if (AtualMillis - UltimoMillis > intervalo) 
 { 
  UltimoMillis = AtualMillis;    // Salva o tempo atual
  atualizar_hora();
 }

} // Fecha Loop


void atualizar_hora()
{
  dataehora = RTC.getDateTime();     // Busca a hora interna do RTC
  dia = dataehora.day;
  mes = dataehora.month;
  ano = dataehora.year;
  hora = dataehora.hour;
  minuto = dataehora.minute;
  segundo = dataehora.second;
  //Serial.print(hora);
  //Serial.print(":");
  //Serial.println(minuto);


// Caso tenha algo que utilize hora do rtc o codigo ficara aqui


} // Fecha atualizar_hora







void imprimir() 
{
  Serial.println(readString);
  


// ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA    
// ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA    
// ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA    
// ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA    
// ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA     ALTERANDO OS RELES DA SALA    

if ( readString.indexOf("steto_1") >= 0)
{
 steto = 1; 
 reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("steto_0") >= 0 )
{
 steto = 0; 
 reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("teto_sala") >= 0)
  {
   intertrava = 0;
   if (steto == 0 && intertrava == 0)
   {
    steto = 1;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("steto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (steto == 1 && intertrava == 0)
   {
    steto = 0;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("steto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("slustre_1") >= 0)
{
 slustre = 1; 
 reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("slustre_0") >= 0 )
{
 slustre = 0; 
 reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lustre_sala") >= 0)
  {
   intertrava = 0;
   if (slustre == 0 && intertrava == 0)
   {
    slustre = 1;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("slustre_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (slustre == 1 && intertrava == 0)
   {
    slustre = 0;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("slustre_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("svaranda_1") >= 0)
{
 svaranda = 1; 
 reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("svaranda_0") >= 0 )
{
 svaranda = 0; 
 reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("varan_sala") >= 0)
  {
   intertrava = 0;
   if (svaranda == 0 && intertrava == 0)
   {
    svaranda = 1;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("svaranda_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (svaranda == 1 && intertrava == 0)
   {
    svaranda = 0;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("svaranda_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("spainel_1") >= 0)
{
 spainel = 1; 
 reles.SetRelay(4, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("spainel_0") >= 0 )
{
 spainel = 0; 
 reles.SetRelay(4, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_sala") >= 0)
  {
   intertrava = 0;
   if (spainel == 0 && intertrava == 0)
   {
    spainel = 1;
    intertrava = 1;
    reles.SetRelay(4, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("spainel_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (spainel == 1 && intertrava == 0)
   {
    spainel = 0;
    intertrava = 1;
    reles.SetRelay(4, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("spainel_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("scorti_1") >= 0)
{
 scorti = 1; 
 reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("scorti_0") >= 0 )
{
 scorti = 0; 
 reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_cor_sala") >= 0)
  {
   intertrava = 0;
   if (scorti == 0 && intertrava == 0)
   {
    scorti = 1;
    intertrava = 1;
    reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("scorti_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (scorti == 1 && intertrava == 0)
   {
    scorti = 0;
    intertrava = 1;
    reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("scorti_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }



// QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1      
// QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1      
// QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1      
// QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1      
// QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1      
// QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1       QUARTO 1      


if ( readString.indexOf("q1teto_1") >= 0)
{
 q1teto = 1; 
 reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("q1teto_0") >= 0 )
{
 q1teto = 0; 
 reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lamp_quarto1") >= 0)
  {
   intertrava = 0;
   if (q1teto == 0 && intertrava == 0)
   {
    q1teto = 1;
    intertrava = 1;
    reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q1teto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (q1teto == 1 && intertrava == 0)
   {
    q1teto = 0;
    intertrava = 1;
    reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q1teto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }



// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("q1painel_1") >= 0)
{
 q1painel = 1; 
 reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("q1painel_0") >= 0 )
{
 q1painel = 0; 
 reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_quarto1") >= 0)
  {
   intertrava = 0;
   if (q1painel == 0 && intertrava == 0)
   {
    q1painel = 1;
    intertrava = 1;
    reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q1painel_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (q1painel == 1 && intertrava == 0)
   {
    q1painel = 0;
    intertrava = 1;
    reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q1painel_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("q1corti_1") >= 0)
{
 q1corti = 1; 
 reles.SetRelay(8, LigarRele, 1); // num rele, modo, num modulo
}
if ( readString.indexOf("q1corti_0") >= 0 )
{
 q1corti = 0; 
 reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_cor_q1") >= 0)
  {
   intertrava = 0;
   if (q1corti == 0 && intertrava == 0)
   {
    q1corti = 1;
    intertrava = 1;
    reles.SetRelay(8, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q1corti_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (q1corti == 1 && intertrava == 0)
   {
    q1corti = 0;
    intertrava = 1;
    reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q1corti_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2    
// QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2    
// QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2    
// QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2    
// QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2    
// QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2     QUARTO 2    

if ( readString.indexOf("q2teto_1") >= 0)
{
 q2teto = 1; 
 reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("q2teto_0") >= 0 )
{
 q2teto = 0; 
 reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lamp_quarto2") >= 0)
  {
   intertrava = 0;
   if (q2teto == 0 && intertrava == 0)
   {
    q2teto = 1;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q2teto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (q2teto == 1 && intertrava == 0)
   {
    q2teto = 0;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q2teto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("q2painel_1") >= 0)
{
 q2painel = 1; 
 reles.SetRelay(2, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("q2painel_0") >= 0 )
{
 q2painel = 0; 
 reles.SetRelay(2, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_quarto2") >= 0)
  {
   intertrava = 0;
   if (q2painel == 0 && intertrava == 0)
   {
    q2painel = 1;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q2painel_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (q2painel == 1 && intertrava == 0)
   {
    q2painel = 0;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q2painel_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("q2corti_1") >= 0)
{
 q2corti = 1; 
 reles.SetRelay(3, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("q2corti_0") >= 0 )
{
 q2corti = 0; 
 reles.SetRelay(3, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_cor_q2") >= 0)
  {
   intertrava = 0;
   if (q2corti == 0 && intertrava == 0)
   {
    q2corti = 1;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q2corti_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (q2corti == 1 && intertrava == 0)
   {
    q2corti = 0;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("q2corti_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA   
// COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA   
// COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA   
// COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA   
// COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA   
// COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA    COZINHA   

if ( readString.indexOf("czteto_1") >= 0)
{
 czteto = 1; 
 reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("czteto_0") >= 0 )
{
 czteto = 0; 
 reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("teto_cozinha") >= 0)
  {
   intertrava = 0;
   if (czteto == 0 && intertrava == 0)
   {
    czteto = 1;
    intertrava = 1;
    reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czteto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (czteto == 1 && intertrava == 0)
   {
    czteto = 0;
    intertrava = 1;
    reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czteto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("czcorredor_1") >= 0)
{
 czcorredor = 1; 
 reles.SetRelay(5, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("czcorredor_0") >= 0 )
{
 czcorredor = 0; 
 reles.SetRelay(5, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("teto_corredo") >= 0)
  {
   intertrava = 0;
   if (czcorredor == 0 && intertrava == 0)
   {
    czcorredor = 1;
    intertrava = 1;
    reles.SetRelay(5, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czcorredor_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (czcorredor == 1 && intertrava == 0)
   {
    czcorredor = 0;
    intertrava = 1;
    reles.SetRelay(5, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czcorredor_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("czpendente_1") >= 0)
{
 czpendente = 1; 
 reles.SetRelay(6, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("czpendente_0") >= 0 )
{
 czpendente = 0; 
 reles.SetRelay(6, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("pend_cozinha") >= 0)
  {
   intertrava = 0;
   if (czpendente == 0 && intertrava == 0)
   {
    czpendente = 1;
    intertrava = 1;
    reles.SetRelay(6, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpendente_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (czpendente == 1 && intertrava == 0)
   {
    czpendente = 0;
    intertrava = 1;
    reles.SetRelay(6, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpendente_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("czpia_1") >= 0)
{
 czpia = 1; 
 reles.SetRelay(7, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("czpia_0") >= 0 )
{
 czpia = 0; 
 reles.SetRelay(7, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_cozinha") >= 0)
  {
   intertrava = 0;
   if (czpia == 0 && intertrava == 0)
   {
    czpia = 1;
    intertrava = 1;
    reles.SetRelay(7, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpia_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (czpia == 1 && intertrava == 0)
   {
    czpia = 0;
    intertrava = 1;
    reles.SetRelay(7, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpia_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("czpersi_1") >= 0)
{
 czpersi = 1; 
 reles.SetRelay(8, LigarRele, 2); // num rele, modo, num modulo
}
if ( readString.indexOf("czpersi_0") >= 0 )
{
 czpersi = 0; 
 reles.SetRelay(8, DesligarRele, 2); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_per_coz") >= 0)
  {
   intertrava = 0;
   if (czpersi == 0 && intertrava == 0)
   {
    czpersi = 1;
    intertrava = 1;
    reles.SetRelay(8, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpersi_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (czpersi == 1 && intertrava == 0)
   {
    czpersi = 0;
    intertrava = 1;
    reles.SetRelay(8, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpersi_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("czpainel_1") >= 0)
{
 czpainel = 1; 
 reles.SetRelay(1, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("czpainel_0") >= 0 )
{
 czpainel = 0; 
 reles.SetRelay(1, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_ptv_coz") >= 0)
  {
   intertrava = 0;
   if (czpainel == 0 && intertrava == 0)
   {
    czpainel = 1;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpainel_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (czpainel == 1 && intertrava == 0)
   {
    czpainel = 0;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("czpainel_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }



// QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL    
// QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL    
// QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL    
// QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL    
// QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL     QUARTO DE CASAL    

if ( readString.indexOf("qcteto_1") >= 0)
{
 qcteto = 1; 
 reles.SetRelay(2, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("qcteto_0") >= 0 )
{
 qcteto = 0; 
 reles.SetRelay(2, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lamp_quartoc") >= 0)
  {
   intertrava = 0;
   if (qcteto == 0 && intertrava == 0)
   {
    qcteto = 1;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("qcteto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (qcteto == 1 && intertrava == 0)
   {
    qcteto = 0;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("qcteto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("qcpainel_1") >= 0)
{
 qcpainel = 1; 
 reles.SetRelay(3, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("qcpainel_0") >= 0 )
{
 qcpainel = 0; 
 reles.SetRelay(3, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_quartoc") >= 0)
  {
   intertrava = 0;
   if (qcpainel == 0 && intertrava == 0)
   {
    qcpainel = 1;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("qcpainel_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (qcpainel == 1 && intertrava == 0)
   {
    qcpainel = 0;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("qcpainel_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("qccorti_1") >= 0)
{
 qccorti = 1; 
 reles.SetRelay(4, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("qccorti_0") >= 0 )
{
 qccorti = 0; 
 reles.SetRelay(4, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_cor_qc") >= 0)
  {
   intertrava = 0;
   if (qccorti == 0 && intertrava == 0)
   {
    qccorti = 1;
    intertrava = 1;
    reles.SetRelay(4, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("qccorti_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (qccorti == 1 && intertrava == 0)
   {
    qccorti = 0;
    intertrava = 1;
    reles.SetRelay(4, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("qccorti_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("clteto_1") >= 0)
{
 clteto = 1; 
 reles.SetRelay(5, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("clteto_0") >= 0 )
{
 clteto = 0; 
 reles.SetRelay(5, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lamp_closet") >= 0)
  {
   intertrava = 0;
   if (clteto == 0 && intertrava == 0)
   {
    clteto = 1;
    intertrava = 1;
    reles.SetRelay(5, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("clteto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (clteto == 1 && intertrava == 0)
   {
    clteto = 0;
    intertrava = 1;
    reles.SetRelay(5, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("clteto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("clinter_1") >= 0)
{
 clinter = 1; 
 reles.SetRelay(6, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("clinter_0") >= 0 )
{
 clinter = 0; 
 reles.SetRelay(6, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_closet") >= 0)
  {
   intertrava = 0;
   if (clinter == 0 && intertrava == 0)
   {
    clinter = 1;
    intertrava = 1;
    reles.SetRelay(6, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("clinter_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (clinter == 1 && intertrava == 0)
   {
    clinter = 0;
    intertrava = 1;
    reles.SetRelay(6, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("clinter_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("clesp_1") >= 0)
{
 clesp = 1; 
 reles.SetRelay(7, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("clesp_0") >= 0 )
{
 clesp = 0; 
 reles.SetRelay(7, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("espe_closet") >= 0)
  {
   intertrava = 0;
   if (clesp == 0 && intertrava == 0)
   {
    clesp = 1;
    intertrava = 1;
    reles.SetRelay(7, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("clesp_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (clesp == 1 && intertrava == 0)
   {
    clesp = 0;
    intertrava = 1;
    reles.SetRelay(7, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("clesp_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET   
// ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET   
// ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET   
// ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET   
// ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET    ESPACO GOURMET   

if ( readString.indexOf("egteto_1") >= 0)
{
 egteto = 1; 
 reles.SetRelay(8, LigarRele, 3); // num rele, modo, num modulo
}
if ( readString.indexOf("egteto_0") >= 0 )
{
 egteto = 0; 
 reles.SetRelay(8, DesligarRele, 3); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("teto_gourmet") >= 0)
  {
   intertrava = 0;
   if (egteto == 0 && intertrava == 0)
   {
    egteto = 1;
    intertrava = 1;
    reles.SetRelay(8, LigarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egteto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (egteto == 1 && intertrava == 0)
   {
    egteto = 0;
    intertrava = 1;
    reles.SetRelay(8, DesligarRele, 3); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egteto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("egpendente_1") >= 0)
{
 egpendente = 1; 
 reles.SetRelay(1, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("egpendente_0") >= 0 )
{
 egpendente = 0; 
 reles.SetRelay(1, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("pend_gourmet") >= 0)
  {
   intertrava = 0;
   if (egpendente == 0 && intertrava == 0)
   {
    egpendente = 1;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egpendente_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (egpendente == 1 && intertrava == 0)
   {
    egpendente = 0;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egpendente_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("egchurras_1") >= 0)
{
 egchurras = 1; 
 reles.SetRelay(2, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("egchurras_0") >= 0 )
{
 egchurras = 0; 
 reles.SetRelay(2, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("chur_gourmet") >= 0)
  {
   intertrava = 0;
   if (egchurras == 0 && intertrava == 0)
   {
    egchurras = 1;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egchurras_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (egchurras == 1 && intertrava == 0)
   {
    egchurras = 0;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egchurras_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("egpersi_1") >= 0)
{
 egpersi = 1; 
 reles.SetRelay(3, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("egpersi_0") >= 0 )
{
 egpersi = 0; 
 reles.SetRelay(3, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_per_eg") >= 0)
  {
   intertrava = 0;
   if (egpersi == 0 && intertrava == 0)
   {
    egpersi = 1;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egpersi_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (egpersi == 1 && intertrava == 0)
   {
    egpersi = 0;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("egpersi_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("eg2teto_1") >= 0)
{
 eg2teto = 1; 
 reles.SetRelay(4, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("eg2teto_0") >= 0 )
{
 eg2teto = 0; 
 reles.SetRelay(4, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lava_per_eg") >= 0)
  {
   intertrava = 0;
   if (eg2teto == 0 && intertrava == 0)
   {
    eg2teto = 1;
    intertrava = 1;
    reles.SetRelay(4, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("eg2teto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (eg2teto == 1 && intertrava == 0)
   {
    eg2teto = 0;
    intertrava = 1;
    reles.SetRelay(4, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("eg2teto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO    
// LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO    
// LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO    
// LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO    
// LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO     LABORATORIO    

if ( readString.indexOf("lbteto_1") >= 0)
{
 lbteto = 1; 
 reles.SetRelay(5, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("lbteto_0") >= 0 )
{
 lbteto = 0; 
 reles.SetRelay(5, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("teto_labora") >= 0)
  {
   intertrava = 0;
   if (lbteto == 0 && intertrava == 0)
   {
    lbteto = 1;
    intertrava = 1;
    reles.SetRelay(5, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("lbteto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (lbteto == 1 && intertrava == 0)
   {
    lbteto = 0;
    intertrava = 1;
    reles.SetRelay(5, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("lbteto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("lbpersi_1") >= 0)
{
 lbpersi = 1; 
 reles.SetRelay(6, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("lbpersi_0") >= 0 )
{
 lbpersi = 0; 
 reles.SetRelay(6, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_per_lb") >= 0)
  {
   intertrava = 0;
   if (lbpersi == 0 && intertrava == 0)
   {
    lbpersi = 1;
    intertrava = 1;
    reles.SetRelay(6, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("lbpersi_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (lbpersi == 1 && intertrava == 0)
   {
    lbpersi = 0;
    intertrava = 1;
    reles.SetRelay(6, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("lbpersi_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("lbventi_1") >= 0)
{
 lbventi = 1; 
 reles.SetRelay(7, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("lbventi_0") >= 0 )
{
 lbventi = 0; 
 reles.SetRelay(7, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("vent_labora") >= 0)
  {
   intertrava = 0;
   if (lbventi == 0 && intertrava == 0)
   {
    lbventi = 1;
    intertrava = 1;
    reles.SetRelay(7, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("lbventi_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (lbventi == 1 && intertrava == 0)
   {
    lbventi = 0;
    intertrava = 1;
    reles.SetRelay(7, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("lbventi_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL    
// BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL    
// BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL    
// BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL    
// BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL     BANHEIRO SOCIAL    

if ( readString.indexOf("soteto_1") >= 0)
{
 soteto = 1; 
 reles.SetRelay(8, LigarRele, 4); // num rele, modo, num modulo
}
if ( readString.indexOf("soteto_0") >= 0 )
{
 soteto = 0; 
 reles.SetRelay(8, DesligarRele, 4); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_ban_soci") >= 0)
  {
   intertrava = 0;
   if (soteto == 0 && intertrava == 0)
   {
    soteto = 1;
    intertrava = 1;
    reles.SetRelay(8, LigarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("soteto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (soteto == 1 && intertrava == 0)
   {
    soteto = 0;
    intertrava = 1;
    reles.SetRelay(8, DesligarRele, 4); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("soteto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("soesp_1") >= 0)
{
 soesp = 1; 
 reles.SetRelay(1, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("soesp_0") >= 0 )
{
 soesp = 0; 
 reles.SetRelay(1, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("esp_ban_soci") >= 0)
  {
   intertrava = 0;
   if (soesp == 0 && intertrava == 0)
   {
    soesp = 1;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("soesp_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (soesp == 1 && intertrava == 0)
   {
    soesp = 0;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("soesp_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }



// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("soambi_1") >= 0)
{
 soambi = 1; 
 reles.SetRelay(2, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("soambi_0") >= 0 )
{
 soambi = 0; 
 reles.SetRelay(2, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_ban_soci") >= 0)
  {
   intertrava = 0;
   if (soambi == 0 && intertrava == 0)
   {
    soambi = 1;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("soambi_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (soambi == 1 && intertrava == 0)
   {
    soambi = 0;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("soambi_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE    
// BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE    
// BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE    
// BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE    
// BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE     BANHEIRO SUITE    

if ( readString.indexOf("suteto_1") >= 0)
{
 suteto = 1; 
 reles.SetRelay(3, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("suteto_0") >= 0 )
{
 suteto = 0; 
 reles.SetRelay(3, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_banh_c") >= 0)
  {
   intertrava = 0;
   if (suteto == 0 && intertrava == 0)
   {
    suteto = 1;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("suteto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (suteto == 1 && intertrava == 0)
   {
    suteto = 0;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("suteto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("suesp_1") >= 0)
{
 suesp = 1; 
 reles.SetRelay(4, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("suesp_0") >= 0 )
{
 suesp = 0; 
 reles.SetRelay(4, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("esp_banh_c") >= 0)
  {
   intertrava = 0;
   if (suesp == 0 && intertrava == 0)
   {
    suesp = 1;
    intertrava = 1;
    reles.SetRelay(4, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("suesp_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (suesp == 1 && intertrava == 0)
   {
    suesp = 0;
    intertrava = 1;
    reles.SetRelay(4, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("suesp_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("suambi_1") >= 0)
{
 suambi = 1; 
 reles.SetRelay(5, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("suambi_0") >= 0 )
{
 suambi = 0; 
 reles.SetRelay(5, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("esp_banh_c") >= 0)
  {
   intertrava = 0;
   if (suambi == 0 && intertrava == 0)
   {
    suambi = 1;
    intertrava = 1;
    reles.SetRelay(5, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("suambi_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (suambi == 1 && intertrava == 0)
   {
    suambi = 0;
    intertrava = 1;
    reles.SetRelay(5, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("suambi_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO   
// ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO   
// ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO   
// ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO   
// ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO    ACESSO   

if ( readString.indexOf("ac1teto_1") >= 0)
{
 ac1teto = 1; 
 reles.SetRelay(6, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("ac1teto_0") >= 0 )
{
 ac1teto = 0; 
 reles.SetRelay(6, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_ac_t1") >= 0)
  {
   intertrava = 0;
   if (ac1teto == 0 && intertrava == 0)
   {
    ac1teto = 1;
    intertrava = 1;
    reles.SetRelay(6, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("ac1teto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (ac1teto == 1 && intertrava == 0)
   {
    ac1teto = 0;
    intertrava = 1;
    reles.SetRelay(6, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("ac1teto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("ac2teto_1") >= 0)
{
 ac2teto = 1; 
 reles.SetRelay(7, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("ac2teto_0") >= 0 )
{
 ac2teto = 0; 
 reles.SetRelay(7, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("lam_ac_t2") >= 0)
  {
   intertrava = 0;
   if (ac2teto == 0 && intertrava == 0)
   {
    ac2teto = 1;
    intertrava = 1;
    reles.SetRelay(7, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("ac2teto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (ac2teto == 1 && intertrava == 0)
   {
    ac2teto = 0;
    intertrava = 1;
    reles.SetRelay(7, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("ac2teto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


// ***************************************************************************************************************************************************************************************

if ( readString.indexOf("ac2ambi_1") >= 0)
{
 ac2ambi = 1; 
 reles.SetRelay(8, LigarRele, 5); // num rele, modo, num modulo
}
if ( readString.indexOf("ac2ambi_0") >= 0 )
{
 ac2ambi = 0; 
 reles.SetRelay(8, DesligarRele, 5); // num rele, modo, num modulo
}
  
  if ( readString.indexOf("amb_ac_t2") >= 0)
  {
   intertrava = 0;
   if (ac2ambi == 0 && intertrava == 0)
   {
    ac2ambi = 1;
    intertrava = 1;
    reles.SetRelay(8, LigarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("ac2ambi_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (ac2ambi == 1 && intertrava == 0)
   {
    ac2ambi = 0;
    intertrava = 1;
    reles.SetRelay(8, DesligarRele, 5); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("ac2ambi_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }










   
readString = ""; // Limpa a mensagem
  

loop(); // Mantem sempre rodando

} // Fecha void imprimir

