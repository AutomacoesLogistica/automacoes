#include <VirtualWire.h>

// Declarando pinos para transmissao (RF TX 433 MHz)
const int rotacao = A0;
const int corrente = A1;
const int LED = 13;
const int TX = 10;
int conta;
void setup() {
// Comunicacao com o Serial Monitor
Serial.begin(9600); // baud-rate
Serial.println("Transmissor");
conta = 0;
// Inicializando E/S do transmissor
vw_set_tx_pin(TX);
vw_set_ptt_inverted(true); // Requerido para DR3100
vw_setup(2000); // Bits por segundos
}

void loop() {
// Funcoes do Sensor - Calculos
int R = analogRead(rotacao);
int I = analogRead(corrente);

// Funcoes para transmissao

//Lendo e armazenando o valor da temperatura
// Convertndo int para char
char rotacaoCharMsg[4];
itoa(R, rotacaoCharMsg,10);
char correnteCharMsg[4];
itoa(I, correnteCharMsg,10);

if(conta==0)
{
digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo  
vw_send((uint8_t *)rotacaoCharMsg, strlen(rotacaoCharMsg));
vw_wait_tx(); // Espera o envio da informacao
conta = 1;
delay(100);
digitalWrite(LED, LOW);
}

if(conta==1)
{
digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)correnteCharMsg, strlen(correnteCharMsg));
vw_wait_tx(); // Espera o envio da informacao
conta = 0;
digitalWrite(LED, LOW);
delay(1000);
}


}
