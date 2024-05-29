#include <VirtualWire.h>

// Declarando pinos para transmissao (RF TX 433 MHz)
const int SENSOR = A0;
const int LED = 13;
const int TX = 10;

void setup() {
// Comunicacao com o Serial Monitor
Serial.begin(9600); // baud-rate
Serial.println("Transmissor");

// Inicializando E/S do transmissor
vw_set_tx_pin(TX);
vw_set_ptt_inverted(true); // Requerido para DR3100
vw_setup(2000); // Bits por segundos
}

void loop() {
// Funcoes do Sensor - Calculos
int D = analogRead(SENSOR);
int T = (D * 5 * 100) / 1023;

Serial.print(T);
Serial.println(" *C");
delay(1000);

// Funcoes para transmissao

//Lendo e armazenando o valor da temperatura
// Convertndo int para char
char SensorCharMsg[10];
itoa(T, SensorCharMsg,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
delay(1000);
}
