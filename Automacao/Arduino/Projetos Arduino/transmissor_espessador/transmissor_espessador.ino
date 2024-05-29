 
// __________________________________________________________ PROJETO TRANSMISSOR DE SINAL 433MHz __________________________________________________________


// PRODUZIDO POR:..........................
// BRUNO GONÇALVES
// TEL: (31) 8849 - 4604
 

//CONEXOES DO LCD
//    1 =  VSS = GND = gnd
//    2 =  VDD = Positivo
//    3 =  Vo = Centro Potenciometro
//    4 =  Rs = 12
//    5 =  Rw = GND
//    6 =  E = 11
//    7 =
//    8 =
//    9 =
//   10 =
//   11 =  D4 = 5
//   12 =  D5 = 4
//   13 =  D6 = 3
//   14 =  D7 = 2
//   15 =  A = 5V    A e K alimentam luz do display LCD
//   16 =  K = GND

// ...........................................................................................................................................................................................



// INCLUINDO AS BIBLIOTECAS

#include <LiquidCrystal.h> // inclui a biblioteca do LCD
#include <VirtualWire.h> // inclui a biblioteca de transmissao de sinal
#include <dht.h> // inclui a biblioteca de temperatura



// ...........................................................................................................................................................................................



// DECLARANDO PINOS PARA TRANSMISSAO (RF TX 433 MHz)

const int rotacao = A1; // recebe o sinal de rotação
const int corrente = A2; // recebe o sinal de corrente
const int nivel = A3; // recebe o sinal de nivel
const int torque = A4; // recebe o sinal de torque
const int ph = A5; // recebe o sinal de ph
const int TX = 10;// declara o envio de transmissao no pino 10

int conta; // variavel para alternancia de envio entre variaveis
float crpm; // constante para RPM
float ci; // constante para CORRENTE
float ct; // constante para TORQUE
float cph; // constante para PH
float PH;


// ..................................
// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(12, 8, 5, 4, 3, 2);

void setup() {
 lcd.begin(16, 2);

  lcd.print("Transmissor");delay(3000);lcd.clear();delay(10);

lcd.setCursor(0,0);
lcd.print("R");
lcd.setCursor(1,0);
lcd.print("=");
lcd.setCursor(7,0);
lcd.print("I");
lcd.setCursor(8,0);
lcd.print("=");

lcd.setCursor(0,1);
lcd.print("T");
lcd.setCursor(1,1);
lcd.print("=");
lcd.setCursor(7,1);
lcd.print("PH");
lcd.setCursor(9,1);
lcd.print("=");
lcd.setCursor(13,1);

delay(1000);

// Comunicacao com o Serial Monitor
Serial.begin(9600); // baud-rate
Serial.println("Transmissor");
conta = 0;
// Inicializando E/S do transmissor
vw_set_tx_pin(TX);
vw_set_ptt_inverted(true); // Requerido para DR3100
vw_setup(2000); // Bits por segundos



}


void loop()  // inicia o loop................................................................................................................................................................. 
{





// CONSTANTES E VARIAVEIS PARA CALCULOS

crpm = 17595308 ; // incia constante para rotação nesse valor ( referente a 1800RPM )
ci = 20039101; // incia constante para corrente nesse valor ( refente a 20,5A )
ct = 97751711 ; // incia constante para torque nesse valor ( referente a 1000kgf )
cph = 48875855 ; // incia constante para ph nesse valor ( referente de 7 a 12ph )




// RECEBENDO A ROTAÇÃO .....................................................................................................................................................................

int recebeRPM = analogRead(rotacao); 
int R = ( recebeRPM * crpm )/10000000;




// RECEBENDO A CORRENTE .....................................................................................................................................................................

int recebeI = analogRead(corrente);
float I = (( recebeI * ci ) / 1000000000) ;



// RECEBENDO O TORQUE .......................................................................................................................................................................

int recebeTORQUE = analogRead(torque);
int T = ( recebeTORQUE * ct) / 100000000 ;



// RECEBENDO O NIVEL ........................................................................................................................................................................

int N = analogRead(nivel);



// RECEBENDO O PH ...........................................................................................................................................................................

int recebePH = analogRead(ph);
float PH = (recebePH*((cph/1000000000)/10))+(71/10);

// ...............................





// VARIAVEIS EM CHAR QUE CORRESPONDEM AS INFORMAÇÕES .........................................................................................................................................

char rotacaoCharMsg[4]; // char refetente a sinal de ROTACAO 
char correnteCharMsg[4]; // char refetente a sinal de CORRENTE 
char torqueCharMsg[4]; // char refetente a sinal de TORQUE 
char nivelCharMsg[4]; // char refetente a sinal de NIVEL 
char phCharMsg[4]; // char refetente a sinal de PH 



// CONVERTENDO AS VARIAVEIS INT EM CHAR PARA ENVIA-LAS VIA FREQUENCIA .........................................................................................................................

itoa(R, rotacaoCharMsg,4); // conterte para o envio o sinal de ROTACAO , e envia-o como R
itoa(I, correnteCharMsg,4); // conterte para o envio o sinal de CORRENTE , e envia-o como I
itoa(T, torqueCharMsg,4); // conterte para o envio o sinal de TORQUE , e envia-o como T
itoa(N, nivelCharMsg,4); // conterte para o envio o sinal de NIVEL , e envia-o como N
itoa(PH, phCharMsg,4); // conterte para o envio o sinal de PH , e envia-o como PH



// INICIA O ENVIO DAS INFORMAÇÕES .............................................................................................................................................................

if(conta==5){conta = 0;}; // se chegar em 5  ,zera a variavel conta e volta a enviar a partir da primeira variavel




// ENVIA O SINAL DE ROTAÇÃO ...................................................................................................................................................................

if(conta==0)
{
  
vw_send((uint8_t *)rotacaoCharMsg, strlen(rotacaoCharMsg)); // funcao para ler o sinal de rotacao e converte-lo para envio
vw_wait_tx(); // Espera o envio da informacao
Serial.print(R);
Serial.println(" RPM ");

// FUNÇOES PARA O LCD ................................................

if(R<1000)
{
  lcd.setCursor(5,0);
  lcd.print(" ");
  lcd.setCursor(2,1);
  lcd.print(R);
}
if(R<100)
{
  lcd.setCursor(5,0);
  lcd.print(" ");
  lcd.setCursor(4,0);
  lcd.print(" ");
  lcd.setCursor(2,0);
  lcd.print(R);
}
if(R<10)
{
  lcd.setCursor(5,0);
  lcd.print(" ");
  lcd.setCursor(4,0);
  lcd.print(" ");
  lcd.setCursor(3,0);
  lcd.print(" ");  
  lcd.setCursor(2,0);
  lcd.print(R);
}
if(R>1000)
{
  lcd.setCursor(2,0);
  lcd.print(R);
}

delay(50);
}


// ENVIA O SINAL DE CORRENTE ..................................................................................................................................................................

if(conta==1)
{
vw_send((uint8_t *)correnteCharMsg, strlen(correnteCharMsg)); // funcao para ler o sinal de corrente e converte-lo para envio
vw_wait_tx(); // Espera o envio da informacao
Serial.print(I, 1);
Serial.println(" A ");

// FUNCOES PARA O LCD ...............................................
lcd.setCursor(9,0);
lcd.print(I, 1);

delay(50);
}



// ENVIA O SINAL DE TORQUE ....................................................................................................................................................................


if(conta==2)
{
vw_send((uint8_t *)torqueCharMsg, strlen(torqueCharMsg)); // funcao para ler o sinal de torque e converte-lo para envio
vw_wait_tx(); // Espera o envio da informacao
Serial.print(T);
Serial.println(" Kgf");


// FUNCOES PARA O LCD
if(T<1000)
{
  lcd.setCursor(5,1);
  lcd.print(" ");
  lcd.setCursor(2,1);
  lcd.print(T
  );
}

if(T<100)
{
  lcd.setCursor(5,1);
  lcd.print(" ");
   lcd.setCursor(4,1);
  lcd.print(" ");
  lcd.setCursor(2,1);
  lcd.print(T);
}
if(T<10)
{
  lcd.setCursor(5,1);
  lcd.print(" ");
   lcd.setCursor(4,1);
  lcd.print(" ");
  lcd.setCursor(3,1);
  lcd.print(" ");  
  lcd.setCursor(2,1);
  lcd.print(T);
}


if(T>1000)
{
  lcd.setCursor(2,1);
  lcd.print(T);
}
delay(50);
}




// ENVIA O SINAL DE NIVEL .....................................................................................................................................................................

if(conta==3)
{
vw_send((uint8_t *)nivelCharMsg, strlen(nivelCharMsg)); // funcao para ler o sinal de nivel e converte-lo para envio
vw_wait_tx(); // Espera o envio da informacao
Serial.print(N);
Serial.println(" Nivel");

delay(50);
}


// ENVIA O SINAL DE PH ........................................................................................................................................................................

if(conta==4)
{
vw_send((uint8_t *)phCharMsg, strlen(phCharMsg)); // funcao para ler o sinal de ph e converte-lo para envio
vw_wait_tx(); // Espera o envio da informacao
Serial.print(PH, 1);
Serial.println(" Ph ");

// FUNCOES PARA O LCD

if(I>10)
{
  lcd.setCursor(10,1);
  lcd.print(PH, 1);
}

if(I<10)
{
  lcd.setCursor(11,1);
  lcd.print(" ");
  lcd.setCursor(10,1);
  lcd.print(PH, 1);
}

delay(50);
}

// ............................................................................................................................................................................................


delay(100); // espera um tempo para sincronizar o envio com o recebimento  ( tx com rx )


conta++; // incrementa 1 na variavel conta para que no proximo ciclo do loop ela passe a enviar outra variavel



} // fecha o LOOP
