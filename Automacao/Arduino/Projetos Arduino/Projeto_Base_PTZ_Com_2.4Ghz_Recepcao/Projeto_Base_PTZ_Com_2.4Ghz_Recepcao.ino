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


// CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01 
// CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01 
// CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01 
// CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01   CAMERA 01 
 
 if(SINAIS[0]==1)// Zoom + camera 1
 {
 
 }
  if(SINAIS[0]==2)// Zoom - camera 1
 {
 
 }
 if(SINAIS[0]==3)// Pan Direita 
 {
 
 }
 if(SINAIS[0]==4)// Pan Direita 
 {
 
 }
 if(SINAIS[0]==5)// Pan Direita 
 {
 
 }
 if(SINAIS[0]==6)// Pan Esquerda
 {
 
 }
if(SINAIS[0]==7)// Pan Esquerda
 {
 
 }
 if(SINAIS[0]==8)// Pan Esquerda
 {
 
 }

if(SINAIS[0]==9)// Tilt Cima
 {
 
 }

if(SINAIS[0]==10)// Tilt Cima
 {
 
 }
if(SINAIS[0]==11)// Tilt Cima
 {
 
 }
if(SINAIS[0]==12)// Tilt Baixo
 {
 
 }

if(SINAIS[0]==13)// Tilt Baixo
 {
 
 }
if(SINAIS[0]==14)// Tilt Baixo
 {
 
 }

if(SINAIS[0]==1000)// Para o Comando
 {
 
 }
 
// CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02
// CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02
// CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02 
// CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02   CAMERA 02 
 
 if(SINAIS[0]==15)// Zoom + camera 2
 {
 
 }
  if(SINAIS[0]==16)// Zoom - camera 2
 {
 
 }
 if(SINAIS[0]==17)// Pan Direita 
 {
 
 }
 if(SINAIS[0]==18)// Pan Direita 
 {
 
 }
 if(SINAIS[0]==19)// Pan Direita 
 {
 
 }
 if(SINAIS[0]==20)// Pan Esquerda
 {
 
 }
if(SINAIS[0]==21)// Pan Esquerda
 {
 
 }
 if(SINAIS[0]==22)// Pan Esquerda
 {
 
 }

if(SINAIS[0]==23)// Tilt Cima
 {
 
 }

if(SINAIS[0]==24)// Tilt Cima
 {
 
 }
if(SINAIS[0]==25)// Tilt Cima
 {
 
 }
if(SINAIS[0]==26)// Tilt Baixo
 {
 
 }

if(SINAIS[0]==27)// Tilt Baixo
 {
 
 }
if(SINAIS[0]==28)// Tilt Baixo
 {
 
 }

if(SINAIS[0]==1000)// Para o Comando
 {
 
 }






 
    radio.write(SINAIS,sizeof(0));
   
    SINAIS[0]=9;
    radio.write(SINAIS,sizeof(SINAIS));// so para preparar para outro pulso
    radio.openReadingPipe(1,pipe);// abre o recebimento
    radio.startListening();; // inicia listagem do recebimento
 

}// fecha loop
 

