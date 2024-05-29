#include <VirtualWire.h>
int conta;
// Declarando pinos para transmissao (RF TX 433 MHz)
const int SENSOR1 = A0;
const int SENSOR2 = A1;
const int SENSOR3 = A2;
const int SENSOR4 = A3;
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
int A = analogRead(SENSOR1);
int B = analogRead(SENSOR2)/10;
int C = analogRead(SENSOR3)/100;
int D = analogRead(SENSOR4)/1000;



// Funcoes para transmissao

//Lendo e armazenando o valor da temperatura
// Convertndo int para char

char SensorCharMsg1[10];
char SensorCharMsg2[10];
char SensorCharMsg3[10];
char SensorCharMsg4[10];

itoa(A, SensorCharMsg1,10);
itoa(B, SensorCharMsg2,10);
itoa(C, SensorCharMsg3,10);
itoa(D, SensorCharMsg4,10);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg1, strlen(SensorCharMsg1));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);Serial.println(A);
Serial.println("1");
delay(2000);
digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg2, strlen(SensorCharMsg2));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);Serial.println(B);
Serial.println("2");
delay(2000);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg3, strlen(SensorCharMsg3));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
Serial.println("3");Serial.println(C);
delay(2000);

digitalWrite(LED, HIGH); // Pisca LED no pino 13 enquanto esta transmitindo
vw_send((uint8_t *)SensorCharMsg4, strlen(SensorCharMsg4));
vw_wait_tx(); // Espera o envio da informacao
digitalWrite(LED, LOW);
Serial.println("4");Serial.println(D);
delay(2000);


}
