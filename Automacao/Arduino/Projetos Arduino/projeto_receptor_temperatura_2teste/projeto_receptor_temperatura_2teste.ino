#include <VirtualWire.h>

const int LED = 13;
const int RX = 12;
int conta;
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

void loop()
{

uint8_t buf[VW_MAX_MESSAGE_LEN];
uint8_t buflen = VW_MAX_MESSAGE_LEN;

if (vw_get_message(buf, &buflen)) 
{
char rotacaoCharMsg[8]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
rotacaoCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
rotacaoCharMsg[buflen] = '\0';

//Convertendo char para inteiro
float D = atoi(rotacaoCharMsg);
float crpm =1.75953079;
int R = D*crpm; 
Serial.print(R);
Serial.println(" RPM");
conta = 1;
}
}

delay(190);
if(conta==1)
{


if (vw_get_message(buf, &buflen)) 
{
char correnteCharMsg[4]; // conteudo da transmissao
for (int i = 0; i < buflen; i++) {
correnteCharMsg[i] = (char)buf[i];
}
//verifica se terminou a transmissao
correnteCharMsg[buflen] = '\0';

//Convertendo char para inteiro
float RC = atoi(correnteCharMsg);
float ci = 0.0200391;
float I = RC*ci; 
Serial.print(I, 2);
Serial.println(" Amperes ");
conta = 0;
}

}
delay(195);

}

