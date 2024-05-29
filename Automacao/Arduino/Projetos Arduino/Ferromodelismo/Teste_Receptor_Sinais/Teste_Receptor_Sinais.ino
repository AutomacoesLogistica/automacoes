/*
 * 
 * Servo 1 ferromodelismo pai
 * 
 * Conexos do Modulo de 2.4Ghz
      
   1 - GND
   2 - VCC 3.3V ................Nao usar 5v , queima
   3 - CE to Arduino pin 9
   4 - CSN to Arduino pin 10
   5 - SCK to Arduino pin 13
   6 - MOSI to Arduino pin 11
   7 - MISO to Arduino pin 12
   8 - UNUSED
 * 
 */

// Carrega as Bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   9
#define CSN_PIN 10

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida

RF24 radio(CE_PIN, CSN_PIN); // Crea o Radio e ativa a transissão do sinal

// Array de 10 elementos
/*
 * SINAIS[0] = velocidade  
 * SINAIS[1] = setido  
 * SINAIS[2] = maquina ligada ou nao
 * SINAIS[3] = luz cabine
 * SINAIS[4] = luz chassi
 * SINAIS[5] = buzina
 * SINAIS[6] = sino
 * SINAIS[7] = maquina selecionada
 * SINAIS[8] = deviracao1
 * SINAIS[9] = derivacao2
 */

int SINAIS[10];

int ultimo_SINAIS_zero = 999;
int ultimo_SINAIS_um = 999;
int ultimo_SINAIS_dois = 999;
int ultimo_SINAIS_tres = 999;
int ultimo_SINAIS_quatro = 999;
int ultimo_SINAIS_cinco = 999;
int ultimo_SINAIS_seis = 999;
int ultimo_SINAIS_sete = 999;
int ultimo_SINAIS_oito = 999;
int ultimo_SINAIS_nove = 999;


void setup() 
{
 Serial.begin(9600);
 Serial.println("Iniciado!");
 radio.begin();
 radio.openReadingPipe(1,pipe);
 radio.startListening();;

}

void loop() 
{
 //Serial.println("Rodando");
 if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  bool done = false;
  while (!done)
  {
   //S/erial.println("Lido"); 
   done = radio.read( SINAIS, sizeof(SINAIS) ); // Recebe o sinal de Array em 3
   if(SINAIS[0] == 0 && SINAIS[1] == 0 && SINAIS[2] == 0 && SINAIS[3] == 0 && SINAIS[4] == 0 && SINAIS[5] == 0 && SINAIS[6] == 0 && SINAIS[7] == 0 && SINAIS[8] == 0 && SINAIS[9] == 0 )
   {
   SINAIS[0] = ultimo_SINAIS_zero; 
   SINAIS[1] = ultimo_SINAIS_um; 
   SINAIS[2] = ultimo_SINAIS_dois; 
   SINAIS[3] = ultimo_SINAIS_tres; 
   SINAIS[4] = ultimo_SINAIS_quatro; 
   SINAIS[5] = ultimo_SINAIS_cinco; 
   SINAIS[6] = ultimo_SINAIS_seis; 
   SINAIS[7] = ultimo_SINAIS_sete; 
   SINAIS[8] = ultimo_SINAIS_oito; 
   SINAIS[9] = ultimo_SINAIS_nove; 
   }
   else
   {
   ultimo_SINAIS_zero = SINAIS[0]; 
   ultimo_SINAIS_um = SINAIS[1]; 
   ultimo_SINAIS_dois = SINAIS[2]; 
   ultimo_SINAIS_tres = SINAIS[3]; 
   ultimo_SINAIS_quatro = SINAIS[4]; 
   ultimo_SINAIS_cinco = SINAIS[5]; 
   ultimo_SINAIS_seis = SINAIS[6]; 
   ultimo_SINAIS_sete = SINAIS[7]; 
   ultimo_SINAIS_oito = SINAIS[8]; 
   ultimo_SINAIS_nove = SINAIS[9]; 
    
   }
   
   Serial.print(SINAIS[0]);
   Serial.print(" - ");
   Serial.print(SINAIS[1]);
   Serial.print(" - ");
   Serial.print(SINAIS[2]);
   Serial.print(" - ");
   Serial.print(SINAIS[3]);
   Serial.print(" - ");
   Serial.print(SINAIS[4]);
   Serial.print(" - ");
   Serial.print(SINAIS[5]);
   Serial.print(" - ");
   Serial.print(SINAIS[6]);
   Serial.print(" - ");
   Serial.print(SINAIS[7]);
   Serial.print(" - ");
   Serial.print(SINAIS[8]);
   Serial.print(" - ");
   Serial.println(SINAIS[9]);
  
  }// Fecha while(!done)
 } // Fecha if ( radio.available() )
} // Fecha LOOP
