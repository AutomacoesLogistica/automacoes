#include <VirtualWire.h>
int A;
int B;
int C;
int D;
int E;
int F;
int menu;
int MENU;
const int LED = 13;
const int RX = 12;

void setup() {
// Comunicacao com o Serial Monitor
Serial.begin(9600);
Serial.println("Receptor");

// Inicializando E/S do receptor
vw_set_rx_pin(RX);
vw_set_ptt_inverted(true); // Requerido para DR3100
vw_setup(2000); // Bits por segundo

vw_rx_start(); // Inicia a recepcao

A = 0;
B = 0;
C = 0;
D = 0;
E = 0;
F = 0;
menu = 0;
MENU = 0;
}

void loop()
{
Serial.print("Analogica A0:   ");
Serial.println (A);
Serial.print("Analogica A1:   ");
Serial.println (B);
Serial.print("Analogica A2:   ");
Serial.println (C);
Serial.print("Analogica A3:   ");
Serial.println (D);
Serial.print("Analogica A4:   ");
Serial.println (E);
Serial.print("Analogica A5:   ");
Serial.println (F);
  

if(MENU==1)
{
  digitalWrite(2)==1;delay(1000);menu = 1;digitalWrite(2)==0;
}
if(MENU==2)
{
  digitalWrite(2)==1;delay(1000);digitalWrite(2)==0;
}
if(MENU==3)
{
  digitalWrite(2)==1;delay(1000);digitalWrite(2)==0;
}
if(MENU==4)
{
  digitalWrite(2)==1;delay(1000);digitalWrite(2)==0;
}
if(MENU==5)
{
  digitalWrite(2)==1;delay(1000);digitalWrite(2)==0;
}


  
  
uint8_t buf[VW_MAX_MESSAGE_LEN];
uint8_t buflen = VW_MAX_MESSAGE_LEN;



// RECEBE O SINAL DA ANALOGICA A0 ...........................................................................................................................................................
if (menu==0)
{
if (vw_get_message(buf, &buflen)) 
{ // Sem bloqueios na recepcao
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra
char SensorCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
SensorCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
SensorCharMsg[buflen] = '\0';
//Convertendo char para inteiro
A = atoi(SensorCharMsg);
analogWrite((A0),A);
MENU = 1;
delay(500);
}
}


// RECEBE O SINAL DA ANALOGICA A1 ...........................................................................................................................................................
if (menu==1)
{
if (vw_get_message(buf, &buflen)) 
{ // Sem bloqueios na recepcao
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra
char SensorCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
SensorCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
SensorCharMsg[buflen] = '\0';
//Convertendo char para inteiro
B = atoi(SensorCharMsg);
analogWrite((A1),B);
delay(50);
}
}



// RECEBE O SINAL DA ANALOGICA A2 ...........................................................................................................................................................
if (menu==2)
{
if (vw_get_message(buf, &buflen)) 
{ // Sem bloqueios na recepcao
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra
char SensorCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
SensorCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
SensorCharMsg[buflen] = '\0';
//Convertendo char para inteiro
C = atoi(SensorCharMsg);
analogWrite((A2),C);
delay(50);
}
}



// RECEBE O SINAL DA ANALOGICA A3 ...........................................................................................................................................................
if (menu==3)
{
if (vw_get_message(buf, &buflen)) 
{ // Sem bloqueios na recepcao
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra
char SensorCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
SensorCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
SensorCharMsg[buflen] = '\0';
//Convertendo char para inteiro
D = atoi(SensorCharMsg);
analogWrite((A3),D);
delay(50);
}
}



// RECEBE O SINAL DA ANALOGICA A4 ...........................................................................................................................................................
if (menu==4)
{
if (vw_get_message(buf, &buflen)) 
{ // Sem bloqueios na recepcao
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra
char SensorCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
SensorCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
SensorCharMsg[buflen] = '\0';
//Convertendo char para inteiro
E = atoi(SensorCharMsg);
analogWrite((A4),E);
delay(50);
}
}



// RECEBE O SINAL DA ANALOGICA A5 ...........................................................................................................................................................
if (menu==5)
{
if (vw_get_message(buf, &buflen)) 
{ // Sem bloqueios na recepcao
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra
char SensorCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
SensorCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
SensorCharMsg[buflen] = '\0';
//Convertendo char para inteiro
F = atoi(SensorCharMsg);
analogWrite((A5),F);
delay(50);
}
}


}// FECHA LOOP
