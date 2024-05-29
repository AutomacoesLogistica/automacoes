/*

   INTERRUPTOR TOUCH SCREEN 3 BOTOES E RS485

   Conexão do modulo RS485
   RO = Pino RX ... 3
   DI = Pino 7
   DE = Pino 8
   RE = Pino 8

   ILUMINACAO PWM DOS BOTOES
   led1 = Pino 9
   led2 = Pino 10
   led3 = Pino 11

   PINO DOS BOTOES
   BotaoTouch_1 = Pino 4 com sensor 2
   BotaoTouch_2 = Pino 4 com sensor 5
   BotaoTouch_3 = Pino 4 com sensor 6
   
  */
#include <CapacitiveSensor.h>
#include<SoftwareSerial.h>

// Dados para enviar mensagens
String MensagemEnviar_1 = "Sala1_1";
String MensagemEnviar_2 = "Sala1_2";
String MensagemEnviar_3 = "Sala1_3";
char MensagemRecebida1[30];
char MensagemRecebida2[30];
char MensagemRecebida3[30];

//SoftwareSerial pins 
#define pinTX 7
#define pinRX 3
SoftwareSerial RS485(pinRX, pinTX);

//MAX485 control pin
#define transmitir 8

// Pinos das iluminações pwm dos botoes
int led1 = 9; // Led do botao 1
int led2 = 10;// Led do botao 2
int led3 = 11;// Led do botao 3
int bloqueia = 1;
 
CapacitiveSensor BotaoTouch_1 = CapacitiveSensor(4,2); 
CapacitiveSensor BotaoTouch_2 = CapacitiveSensor(4,5); 
CapacitiveSensor BotaoTouch_3 = CapacitiveSensor(4,6); 

// Utilizar resistor 10M para mais

void setup()
{
   //Initialize SoftwareSerial
   RS485.begin(9600);
   pinMode(led1, OUTPUT);
   digitalWrite(led1,HIGH);
   pinMode(led2, OUTPUT);
   digitalWrite(led2,HIGH);
   pinMode(led3, OUTPUT);
   digitalWrite(led3,HIGH);
   analogWrite(led1,255);
   analogWrite(led2,255);
   analogWrite(led3,255);
   pinMode(transmitir, OUTPUT);
   digitalWrite(transmitir,LOW);      // Desabilitaa transmissão e fica em modo de recepção
   BotaoTouch_1.set_CS_AutocaL_Millis(0xFFFFFFFF);
   BotaoTouch_2.set_CS_AutocaL_Millis(0xFFFFFFFF);
   BotaoTouch_3.set_CS_AutocaL_Millis(0xFFFFFFFF);
}

void loop()                    
{
    long DadosBotaoTouch_1 =  BotaoTouch_1.capacitiveSensor(300);
//  long DadosBotaoTouch_2 =  BotaoTouch_2.capacitiveSensor(300);
//  long DadosBotaoTouch_3 =  BotaoTouch_3.capacitiveSensor(300);


    // MAPEIA DADOS DO SENSOR TOUCH 1 *************************************************************************************************************************************************
    if (DadosBotaoTouch_1 > 60)
    {
    bloqueia = 0;  
    analogWrite(led1,0); // Desliga o led
    DadosBotaoTouch_1 = 0; // zera o valor do botao
    // faz detalhe da iluminacao
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    String DadosDaMensagemRecebida1 = String(MensagemEnviar_1);
    DadosDaMensagemRecebida1.toCharArray(MensagemRecebida1, DadosDaMensagemRecebida1.length() + 1);
    RS485.write(MensagemRecebida1);
    delay(500);
    for(int a = 0;a<255;a++)
     {
      analogWrite(led1,a);
      delay(10);  
     }
    
     digitalWrite(transmitir,LOW);      // Desabilitaa transmissão e fica em modo de recepção
    }
    // não faz nada caso não seja presisonado
    else 
    {
      if ( bloqueia == 0 )
      analogWrite(led1,255);
      bloqueia = 1;
    }    

/*
 
    // MAPEIA DADOS DO SENSOR TOUCH 2 *************************************************************************************************************************************************
    if (DadosBotaoTouch_2 > 60)
    {
    bloqueia = 0;  
    analogWrite(led2,0); // Desliga o led
    DadosBotaoTouch_2 = 0; // zera o valor do botao
    // faz detalhe da iluminacao
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    String DadosDaMensagemRecebida2 = String(MensagemEnviar_2);
    DadosDaMensagemRecebida2.toCharArray(MensagemRecebida2, DadosDaMensagemRecebida2.length() + 1);
    RS485.write(MensagemRecebida2);
    delay(500);
    for(int a = 0;a<255;a++)
     {
      analogWrite(led2,a);
      delay(10);  
     }
    
     digitalWrite(transmitir,LOW);      // Desabilitaa transmissão e fica em modo de recepção
    }
    // não faz nada caso não seja presisonado
    else 
    {
      if ( bloqueia == 0 )
      analogWrite(led2,255);
      bloqueia = 1;
    }    
       
    // MAPEIA DADOS DO SENSOR TOUCH 3 *************************************************************************************************************************************************
    if (DadosBotaoTouch_3 > 60)
    {
    bloqueia = 0;  
    analogWrite(led3,0); // Desliga o led
    DadosBotaoTouch_3 = 0; // zera o valor do botao
    // faz detalhe da iluminacao
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    String DadosDaMensagemRecebida3 = String(MensagemEnviar_3);
    DadosDaMensagemRecebida3.toCharArray(MensagemRecebida3, DadosDaMensagemRecebida3.length() + 1);
    RS485.write(MensagemRecebida3);
    delay(500);
    for(int a = 0;a<255;a++)
     {
      analogWrite(led3,a);
      delay(10);  
     }
    
     digitalWrite(transmitir,LOW);      // Desabilitaa transmissão e fica em modo de recepção
    }
    // não faz nada caso não seja presisonado
    else 
    {
      if ( bloqueia == 0 )
      analogWrite(led3,255);
      bloqueia = 1;
    }    
    // *********************************************************************************************************************************************************************************
 
     

      
     
*/

}
