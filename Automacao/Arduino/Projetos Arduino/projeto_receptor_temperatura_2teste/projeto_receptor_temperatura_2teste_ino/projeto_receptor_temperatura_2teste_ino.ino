#include <VirtualWire.h>

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
}

void loop() {
uint8_t buf[VW_MAX_MESSAGE_LEN];
uint8_t buflen = VW_MAX_MESSAGE_LEN;

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
int T = atoi(carCharMsg);
Serial.println(T);
digitalWrite(LED, LOW);


}
}
