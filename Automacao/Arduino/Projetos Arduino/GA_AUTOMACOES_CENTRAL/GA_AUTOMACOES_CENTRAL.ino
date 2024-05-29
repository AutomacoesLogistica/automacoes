// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção
// inclui a biblioteca LiquidCrystal:
 
int SINAIS[2];  // usada para receber os comandos enviados

void setup()
{
 
  Serial.begin(9600);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
 }

void loop()
{
  if ( radio.available()) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {

   radio.read( SINAIS, sizeof(SINAIS) );

    radio.stopListening();;  // para o recebimento
    radio.openWritingPipe(pipe); // inicia envio
    SINAIS[0]=10;
      
    radio.write(SINAIS,sizeof(SINAIS));
  
   
    radio.openReadingPipe(1,pipe);// abre o recebimento
    radio.startListening();; // inicia listagem do recebimento
   
}



 if(SINAIS[0]==33)// RECEBE COMANDO DO INTERRUPTOR
 {
 
 }
 
 
    radio.write(SINAIS,sizeof(0));
   
    SINAIS[0]=9;
    radio.write(SINAIS,sizeof(SINAIS));// so para preparar para outro pulso
    radio.openReadingPipe(1,pipe);// abre o recebimento
    radio.startListening();; // inicia listagem do recebimento
 

}// fecha loop
 

