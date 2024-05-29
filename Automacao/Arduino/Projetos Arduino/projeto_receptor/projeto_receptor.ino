#include <VirtualWire.h>
int conta;
const int RX = 12;

void setup() {

  
  // Comunicacao com o Serial Monitor
Serial.begin(9600);
Serial.println("Receptor");
conta = 0;
// Inicializando E/S do receptor
vw_set_rx_pin(RX);
vw_set_ptt_inverted(true); // Requerido para DR3100
vw_setup(2000); // Bits por segundo

vw_rx_start(); // Inicia a recepcao
}

void loop() {
uint8_t buf[VW_MAX_MESSAGE_LEN];
uint8_t buflen = VW_MAX_MESSAGE_LEN;

if (vw_get_message(buf, &buflen)) { // Sem bloqueios na recepcao
 // Pisca LED no pino 13 se receber a mensagem integra
/*Serial.print("Msg. OK - "); // Verifica checksum. Se mensagem integra, escreve Msg. OK - :
*/
char SensorCharMsg[10]; // conteudo da transmissao
char potenciometroCharMsg[4]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
SensorCharMsg[i] = (char)buf[i];}
for (int i = 0; i < buflen; i++) {
potenciometroCharMsg[i] = (char)buf[i];}
//verifica se terminou a transmissao
SensorCharMsg[buflen] = '\0';
potenciometroCharMsg[buflen] = '\0';
//Convertendo char para inteiro
int T = atoi(SensorCharMsg);
int D = atoi(potenciometroCharMsg);
if (conta==2){conta = 0;}
delay(50);


if(conta==0)
{
Serial.print("temperatura : ");
Serial.print(T);
Serial.println(" Graus Celsius");
delay(50);
}

if(conta==1)
{
Serial.print("Potenciometro : ");
Serial.print(D);
Serial.println(" Ohms");
}


delay(100);
conta++;
}
}
