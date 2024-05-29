#include <VirtualWire.h>

// Declarando pinos para transmissao (RF TX 433 MHz)
const int SENSOR0 = A0;
const int SENSOR1 = A1;
const int SENSOR2 = A2;
const int SENSOR3 = A3;
const int SENSOR4 = A4;
const int SENSOR5 = A5;
const int LED = 13;
const int TX = 10;
int menu;

void setup() 
{
// Comunicacao com o Serial Monitor
Serial.begin(9600); // baud-rate
Serial.println("Transmissor");
pinMode(2,INPUT); // RECEBE O SINAL DO RECEPTOR PARA INCREMENTAR " MENU "E ASSIM ENVIAR OUTROS SINAIS
menu = 0;
// Inicializando E/S do transmissor
vw_set_tx_pin(TX);
vw_set_ptt_inverted(true); // Requerido para DR3100
vw_setup(2000); // Bits por segundos
}

void loop() {
  
  // SINAL PARA MUDAR DE VARIAVEL A SER ENVIADA ..........................................................................................................................................
  if (digitalRead(2)!=0)
  {
    menu++;
  }
  if(menu==6)
  {
    menu = 0;
  }
  
int A = analogRead(SENSOR0); // LE O SINAL DA ENTRADA A0
int B = analogRead(SENSOR1); // LE O SINAL DA ENTRADA A1
int C = analogRead(SENSOR2); // LE O SINAL DA ENTRADA A2
int D = analogRead(SENSOR3); // LE O SINAL DA ENTRADA A3
int E = analogRead(SENSOR4); // LE O SINAL DA ENTRADA A4
int F = analogRead(SENSOR5); // LE O SINAL DA ENTRADA A5


// ENVIA DADOS DA ANALOGICA A0 .............................................................................................................................................................

if(menu==0)
{
char SensorCharMsg[10];
itoa(A, SensorCharMsg,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
delay(1000);
}




// ENVIA DADOS DA ANALOGICA A1 .............................................................................................................................................................

if(menu==1)
{
char SensorCharMsg[10];
itoa(B, SensorCharMsg,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
delay(1000);
}



// ENVIA DADOS DA ANALOGICA A2 .............................................................................................................................................................

if(menu==2)
{
char SensorCharMsg[10];
itoa(C, SensorCharMsg,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
delay(1000);
}



// ENVIA DADOS DA ANALOGICA A3 .............................................................................................................................................................

if(menu==3)
{
char SensorCharMsg[10];
itoa(D, SensorCharMsg,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
delay(1000);
}



// ENVIA DADOS DA ANALOGICA A4 .............................................................................................................................................................

if(menu==4)
{
char SensorCharMsg[10];
itoa(E, SensorCharMsg,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
delay(1000);
}



// ENVIA DADOS DA ANALOGICA A5 .............................................................................................................................................................

if(menu==5)
{
char SensorCharMsg[10];
itoa(F, SensorCharMsg,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
delay(1000);
}



}// FECHA LOOP ...............................................................................................................................................................................
