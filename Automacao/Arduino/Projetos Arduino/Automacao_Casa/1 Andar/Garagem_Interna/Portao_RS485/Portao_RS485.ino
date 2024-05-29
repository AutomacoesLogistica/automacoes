/*

COMPLEMENTO ESP8266 PARA ACIONAR O PORTAO

   LedStatus = Pino 13
   
   Conexão do modulo RS485
   RO = Pino 10 
   DI = Pino 12 
   DE = Pino 11 Pino para ativar transmissao
   RE = Pino 11 Pino para ativar transmissao
   
   PINO DOS BOTOES
   BotaoA = Pino 2
   BotaoB = Pino 3
   BotaoC = Pino 4
   BotaoD = Pino 5
   
   Pino 8 Entrada portao fechado
   Pino 9 Entrada portao aberto
   
  DEFINICAO DOS RELES

   Solenoides   ************* *************************************

   alimentacao_Abrir = 0;     // Rele1 A0
   alimentacao_Fechar = 0;   // Rele2    A1
   bloqueio = 0;  // Rele3       A2
   
   Trancas  ***********************************************
   
   eletromagnetica = 0;   // Rele4 A3
   eletromecanica = 0;    // Rele5 A4

   Acionamentos  ***********************************************

   giteto1 = 0;    // Rele6        A5
   giteto2 = 0;  // Rele7          6
   portaopequeno = 0;   // Rele8   7

*/

#include <SoftwareSerial.h>
#define transmitir 11 // Pino DE e RE - Transmissao    PINO 11
#define pinRX 10 // Pino RO                            PINO 10
#define pinTX 12 // Pino DI                            PINO 12
SoftwareSerial RS485(pinRX, pinTX);

#define LedStatus 13 // LedStatus                      PINO 13

char MensagemParaEnviar[12]; // Usado para concaternar as mensagens para enviar e convertelas em char para ser possivel envialar com serial.write
String DadosDaMensagemParaEnviar; // Usado dentro da função para concatenar e enviar na rede RS485

// CRIANDO VOIDS PARA ACESSO AS ABAS EXTERNAS DE CADA COMODO
void aciona_portao(void);
void fechar(void);
void abrir(void);

int contador = -1; // Não mudar!!!

String readString; // Variavel pra concatenar dados da serial
char c;

// entradas RF  **************************************************
#define BotaoA 2
#define BotaoB 3
#define BotaoC 4
#define BotaoD 5

// solenoides  **************************************************
#define alimentacao_Abrir A0     // Rele1 // solenoide que libera agua para o sistema, tanto para abrir quanto para fechar
#define alimentacao_Fechar A1   // Rele2  // solenoide que modula para fechar, abrir padrao desenergizada
#define bloqueio A2  // Rele3    // solenoide que modula ao fechar para o portao com batente esperar o outro vir primeiro para nao encavalar

// Trancas  **************************************************
#define eletromagnetica A3   // Rele4
#define eletromecanica A4    // Rele5

// Acionamentos  ***********************************************
#define giteto1 A5    // Rele6   // as 3 lampadas proximo ao terreiro
#define giteto2 6  // Rele7     // as 3 lampadas proximo a rua
#define portaopequeno 7   // Rele8    // pulso no portao

#define ent_portg_fechado 8 // Sensor fechado 1 No
#define ent_portg_aberto 9  // Sensor aberto  2 No



char MensagemRecebida[30]; // Usado para criar a string de envio dos dados recebidos pelo MQTT


void setup()
{
 RS485.begin(9600);
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW);


 // Botoes com resistor de elevação, ficam sempre em 1, quando pressionados, vao para nivel logico 0
 pinMode(BotaoA,INPUT); // Recebe comandos do botao A
 pinMode(BotaoB,INPUT); // Recebe comandos do botao B
 pinMode(BotaoC,INPUT); // Recebe comandos do botao C
 pinMode(BotaoD,INPUT); // Recebe comandos do botao D

 pinMode(alimentacao_Abrir,OUTPUT); // Acionamento Alimentacao
 digitalWrite(alimentacao_Abrir, HIGH);
 pinMode(alimentacao_Fechar,OUTPUT); // Acionamento alimentacao_Fechar ( Somente ao fechar)
 digitalWrite(alimentacao_Fechar, HIGH);
 pinMode(bloqueio,OUTPUT); // Acionamento Bloqueio ( Portao com Batente Esperar )
 digitalWrite(bloqueio, HIGH);
 pinMode(eletromagnetica,OUTPUT); // Acionamento Ima 12V
 digitalWrite(eletromagnetica, HIGH);
 pinMode(eletromecanica,OUTPUT); // Acionamento Tranca superior  127V
 digitalWrite(eletromecanica, HIGH);
 pinMode(giteto1,OUTPUT); // Acionamento 3 do teto proximo ao terreiro
 digitalWrite(giteto1, HIGH);
 pinMode(giteto2,OUTPUT); // Acionamento 3 do teto proximo a rua
 digitalWrite(giteto2, HIGH);
 pinMode(portaopequeno,OUTPUT); // Acionamento pulso portao pequeno 12V
 digitalWrite(portaopequeno, HIGH);
 pinMode(ent_portg_fechado,INPUT); // Entrda para o sensor do portao fechado
 pinMode(ent_portg_aberto,INPUT);  // Entrada para o sensor do portao aberto
 pinMode(LedStatus, OUTPUT);
 digitalWrite(LedStatus, HIGH); // Chegando mensagem ele apaga e acende novamente

}

void loop()                    
{
 while (RS485.available())
 {
  delay(3);
  char c = RS485.read();
  readString += c;
 }

 // Se receber mensagem 
 if (readString.length() > 0)
 {
  digitalWrite(LedStatus,LOW);
  
  if (readString.indexOf("gi_teto1_1") >= 0)
  {
   digitalWrite(giteto1,LOW); // Liga a lampada
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto1_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
  }
  if (readString.indexOf("gi_teto1_0") >= 0)
  {
   digitalWrite(giteto1,HIGH); // Desliga a lampada
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto1_0");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
  }
  if (readString.indexOf("gi_teto2_1") >= 0)
  {
   digitalWrite(giteto2,LOW); // Liga a lampada
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto2_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
  }
  if (readString.indexOf("gi_teto2_0") >= 0)
  {
   digitalWrite(giteto2,HIGH); // Desliga a lampada
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto2_0");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
  }
  
  if (readString.indexOf("gateto1") >= 0)
  {
   if (digitalRead(giteto1)==LOW) // Esta ligada
   {
    digitalWrite(giteto1,HIGH); // Desligo a lampada
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("giteto1_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
    delay(200);
   }
   else // Esta desligada
   {
    digitalWrite(giteto1,LOW); // Ligo a lampada
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("giteto1_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

  if (readString.indexOf("gateto2") >= 0)
  {
   if (digitalRead(giteto2)==LOW) // Esta ligada
   {
    digitalWrite(giteto2,HIGH); // Desligo a lampada
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("giteto2_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
    delay(200);
   }
   else // Esta desligada
   {
    digitalWrite(giteto2,LOW); // Ligo a lampada
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("giteto2_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }

  if (readString.indexOf("all_gi_on") >= 0)
  {
   digitalWrite(giteto1,LOW); // Liga a lampada
   digitalWrite(giteto2,LOW); // Liga a lampada
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto1_1");
   delay(500);
   RS485.print("giteto2_1");
   delay(500);
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  }
  if (readString.indexOf("all_gi_off") >= 0)
  {
   digitalWrite(giteto1,HIGH); // Desliga a lampada
   digitalWrite(giteto2,HIGH); // Desliga a lampada
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto1_0");
   delay(500);
   RS485.print("giteto2_0");
   delay(500);
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  }

  if (readString.indexOf("gi_portaopequeno") >= 0)
  {
   // ACIONA O PULSO NA TRANCA
   digitalWrite(portaopequeno, LOW); // Aciona a tranca
   delay(1000);
   digitalWrite(portaopequeno, HIGH);// Desliga o pulso na tranca
  
  }
  if (readString.indexOf("gi_portgrande") >= 0 && (contador == 0 || contador == 3))
  {
   aciona_portao();  
  }




 readString = ""; // limpa a variavel
 delay(200);
 digitalWrite(LedStatus,HIGH);
 } // Fecha se existe mensagens

 













if (contador == -1 && digitalRead(ent_portg_fechado)==LOW && digitalRead(ent_portg_aberto)==HIGH) // Portao está fechado!
{
  digitalWrite(LedStatus,LOW); 
  contador = 0;
  // Energiza a tranca eletromagnetica 12V
  digitalWrite(eletromagnetica,LOW);
  delay(1000);// Por segurança
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  RS485.print("portaog_f");
  digitalWrite(transmitir, LOW);
  digitalWrite(LedStatus,HIGH);

  
}

  
if (contador == 2 && digitalRead(ent_portg_fechado)==HIGH && digitalRead(ent_portg_aberto)==LOW) // Portao Abriu!
{
 delay(10000);//Coloquei para evitar que chegue no sensor e corte o comando e o outro nao abriu ainda 
 digitalWrite(LedStatus,LOW);
 contador = 3;
 digitalWrite(alimentacao_Abrir,HIGH);// Desliga a solenoide agua para abrir
 digitalWrite(bloqueio,HIGH);// Retira a alimentacao da valvula de bloqueio
 digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
 RS485.print("portaog_a");
 digitalWrite(transmitir, LOW);
 delay(200);
 digitalWrite(LedStatus,HIGH);
}

if (contador == 5 && digitalRead(ent_portg_fechado)==LOW && digitalRead(ent_portg_aberto)==HIGH) // Portao Acabou de fechar!
{
 delay(3000);//Coloquei por seguranca 
 digitalWrite(LedStatus,LOW);
 delay(2000);// Por segurança 
 contador = 0;
 digitalWrite(alimentacao_Fechar,HIGH);// Retira alimentacao da valvula de agua para fechar e no fisico o dreno fechar
 digitalWrite(bloqueio,HIGH); // Retira alimentacao da valvula de bloqueio
 digitalWrite(eletromagnetica,LOW); // Energiza a tranca eletromagnetica 12V
 delay(1000);// Por segurança
 digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
 RS485.print("portaog_f");
 digitalWrite(transmitir, LOW);
 digitalWrite(LedStatus,HIGH);
}









 
 // Verificando o acionamento do BotaoA **************************************************************************************************************************************************
 if (digitalRead(BotaoA) == 1 && (contador == 0 || contador == 3) )
 {
  digitalWrite(LedStatus,LOW);
  while(digitalRead(BotaoA) == 1)
  {
   delay(200);
  }
  // Chama para abrir ou fechar o portao grande
  digitalWrite(LedStatus,HIGH);
  aciona_portao();  
 }
 
 // Verificando o acionamento do BotaoB **************************************************************************************************************************************************
 if (digitalRead(BotaoB) == 1)
 {
  digitalWrite(LedStatus,LOW);
  while(digitalRead(BotaoB) == 1)
  {
   delay(200);
  }
  digitalWrite(LedStatus,HIGH);
  
  // ACIONA O PULSO NA TRANCA
  digitalWrite(portaopequeno, LOW); // Aciona a tranca
  delay(1000);
  digitalWrite(portaopequeno, HIGH);// Desliga o pulso na tranca
 }
 
 // Verificando o acionamento do BotaoC **************************************************************************************************************************************************
 if (digitalRead(BotaoC) == 1)
 {
  while(digitalRead(BotaoC) == 1)
  {
   delay(200);
  }

  // ACIONAMENTO DAS 3 LAMPADAS PROXIMO AO TERREIRO
  digitalWrite(giteto1,!digitalRead(giteto1));
  if (digitalRead(giteto1)== LOW) // Ligado em zero
  {
   digitalWrite(LedStatus,LOW);
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto1_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   digitalWrite(LedStatus,HIGH);
  }
  else
  {
   digitalWrite(LedStatus,LOW); 
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto1_0");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   digitalWrite(LedStatus,HIGH);
  }
  delay(1000); // bloqueio de segurança
 }

 // Verificando o acionamento do BotaoD **************************************************************************************************************************************************
 if (digitalRead(BotaoD) == 1)
 {
  while(digitalRead(BotaoD) == 1)
  {
   delay(200);
  }

  // ACIONAMENTO DAS 3 LAMPADAS PROXIMO A RUA
  digitalWrite(giteto2,!digitalRead(giteto2));
  if (digitalRead(giteto2)== LOW) // Ligado em zero
  {
   digitalWrite(LedStatus,LOW); 
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto2_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   digitalWrite(LedStatus,HIGH);
  }
  else
  {
   digitalWrite(LedStatus,LOW); 
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("giteto2_0");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   digitalWrite(LedStatus,HIGH);
  }
  delay(1000); // bloqueio de segurança
 }


} // Fecha Loop
