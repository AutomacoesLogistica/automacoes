#include <VirtualWire.h>

const int LED = 13;
const int RX = 12;
int x;
void setup() {
// Comunicacao com o Serial Monitor
Serial.begin(9600);
Serial.println("Receptor");
x = 1;
// Inicializando E/S do receptor
vw_set_rx_pin(RX);
vw_set_ptt_inverted(true); // Requerido para DR3100
vw_setup(2000); // Bits por segundo

vw_rx_start(); // Inicia a recepcao
}

void loop() {
uint8_t buf[VW_MAX_MESSAGE_LEN];
uint8_t buflen = VW_MAX_MESSAGE_LEN;


if(x==4){
if (vw_get_message(buf, &buflen))  // Sem bloqueios na recepcao
{
  
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra

char carCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
carCharMsg[i] = (char)buf[i];
}

//verifica se terminou a transmissao
carCharMsg[buflen] = '\0';

//Convertendo char para inteiro
int D = atoi(carCharMsg);
Serial.print("D = ");
Serial.println(D);
digitalWrite(LED, LOW);x = 1;
}
}



if(x==3){
if (vw_get_message(buf, &buflen))  // Sem bloqueios na recepcao
{
  
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra

char carCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
carCharMsg[i] = (char)buf[i];
}

//verifica se terminou a transmissao
carCharMsg[buflen] = '\0';

//Convertendo char para inteiro
int C = atoi(carCharMsg);
Serial.print("C = ");
Serial.println(C);
digitalWrite(LED, LOW);x = 4;
}
}

if(x==2){
if (vw_get_message(buf, &buflen))  // Sem bloqueios na recepcao
{
  
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra

char carCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
carCharMsg[i] = (char)buf[i];
}

//verifica se terminou a transmissao
carCharMsg[buflen] = '\0';

//Convertendo char para inteiro
int B = atoi(carCharMsg);
Serial.print("B = ");
Serial.println(B);
digitalWrite(LED, LOW);x = 3;
}
}

if(x==1){
if (vw_get_message(buf, &buflen))  // Sem bloqueios na recepcao
{
  
digitalWrite(LED, HIGH); // Pisca LED no pino 13 se receber a mensagem integra

char carCharMsg[10]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
carCharMsg[i] = (char)buf[i];
}

//verifica se terminou a transmissao
carCharMsg[buflen] = '\0';

//Convertendo char para inteiro
int A = atoi(carCharMsg);
Serial.print("A = ");
Serial.println(A);
digitalWrite(LED, LOW);x = 2;
}
}

}
