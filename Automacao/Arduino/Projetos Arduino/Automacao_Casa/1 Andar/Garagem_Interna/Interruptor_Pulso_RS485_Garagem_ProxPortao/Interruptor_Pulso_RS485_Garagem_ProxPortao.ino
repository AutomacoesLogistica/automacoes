/*

    CODIGO UTILIZANDO UM ARDUINO PRO MINI EM REDE RS485 - CODIGO PARA INTERRUPTOR DA GARAGEM


   Conexão do modulo RS485    Recebe as mensagens dos interruptores e envia tambem para a central com mqtt atualizar supervisorio
   RO = Pino 3
   DI = Pino 4
   DE = Pino 2 Pino para ativar transmissao
   RE = Pino 2 Pino para ativar transmissao

   PINO DOS BOTOES
   Botao1 = Pino 5
   Botao2 = Pino 6
   Botao3 = Pino 7
  
   LedStatus = Pino 13      

   
*/


#define Botao1 5
#define Botao2 6
#define Botao3 7
#define LedStatus 13

String Mensagem_1 = "frenca"; // Iluminação da frente da casa
String Mensagem_2 = "arandela"; // Iluminação da arandelas dos carros
String Mensagem_3 = "jarhori"; // Iluminação do jardim horizontal

char MensagemParaEnviar[12]; // Usado para concaternar as mensagens para enviar e convertelas em char para ser possivel envialar com serial.write
String DadosDaMensagemParaEnviar; // Usado dentro da função para concatenar e enviar na rede RS485

#include<SoftwareSerial.h>
#define transmitir 2 // Pino DE e RE - Transmissao
#define pinRX 3 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);
int intertrava = 0;
 

void setup()
{
 RS485.begin(9600);
 //Serial.begin(9600);
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW);
 pinMode(LedStatus, OUTPUT);
 digitalWrite(LedStatus, HIGH);

 // Botoes com resistor de elevação, ficam sempre em 1, quando pressionados, vao para nivel logico 0
 pinMode(Botao1,INPUT); // Recebe comandos do botao de pulso 1
 pinMode(Botao2,INPUT); // Recebe comandos do botao de pulso 2
 pinMode(Botao3,INPUT); // Recebe comandos do botao de pulso 3
 
}

void loop()                    
{

 
 // Verificando o acionamento do Botao1 **************************************************************************************************************************************************
 if (digitalRead(Botao1) == 0)
 {
  digitalWrite(LedStatus,LOW);
  delay(500);
  while(digitalRead(Botao1) == 0)
  {
   delay(500);
  }
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  //DadosDaMensagemParaEnviar = Mensagem_1;
  //DadosDaMensagemParaEnviar.toCharArray(MensagemParaEnviar, DadosDaMensagemParaEnviar.length() + 1);
  //RS485.write(MensagemParaEnviar);
  RS485.print(Mensagem_1);
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  digitalWrite(LedStatus,HIGH);
 }


 // Verificando o acionamento do Botao2 **************************************************************************************************************************************************
 if (digitalRead(Botao2) == 0 )
 {
  digitalWrite(LedStatus,LOW);
  delay(500);
  while(digitalRead(Botao2) == 0)
  {
   delay(500);
  }
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  //DadosDaMensagemParaEnviar = Mensagem_2;
  //DadosDaMensagemParaEnviar.toCharArray(MensagemParaEnviar, DadosDaMensagemParaEnviar.length() + 1);
  //RS485.write(MensagemParaEnviar);
  RS485.print(Mensagem_2);
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  digitalWrite(LedStatus,HIGH);
 }

 // Verificando o acionamento do Botao3 **************************************************************************************************************************************************
 if ( digitalRead(Botao3) == 0 )
 {
  digitalWrite(LedStatus,LOW);
  delay(500);
  while(digitalRead(Botao3) == 0)
  {
   delay(500);
  }
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  //DadosDaMensagemParaEnviar = Mensagem_3;
  //DadosDaMensagemParaEnviar.toCharArray(MensagemParaEnviar, DadosDaMensagemParaEnviar.length() + 1);
  //RS485.write(MensagemParaEnviar);
  RS485.print(Mensagem_3);
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  digitalWrite(LedStatus,HIGH);
 }


} // Fecha Loop
