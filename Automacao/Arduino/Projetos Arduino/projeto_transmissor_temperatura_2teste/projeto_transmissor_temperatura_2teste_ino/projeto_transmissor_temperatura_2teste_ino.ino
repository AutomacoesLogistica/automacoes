#include <VirtualWire.h>
int conta;
// Declarando pinos para transmissao (RF TX 433 MHz)
const int SENSOR = A0;
const int SENSOR1 = A1;
const int LED = 13;
const int TX = 10;

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
int D = analogRead(SENSOR);
int A = analogRead(SENSOR1);
int T = (D * 5 * 100) / 1023;

// Funcoes para transmissao

//Lendo e armazenando o valor da temperatura
// Convertndo int para char

char SensorCharMsg[10];
itoa(D, SensorCharMsg,10);
char SensorCharMsg1[10];
itoa(A, SensorCharMsg1,10);


digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg, strlen(SensorCharMsg));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
Serial.println("proximo");
delay(2000);
digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg1, strlen(SensorCharMsg1));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
Serial.println("anterior");
delay(2000);


}
