// Versão 1.0
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#include <RF24_config.h>
String readString;

#define SaidaTX A3
int msg[1]; // Define o numero de mensagens a enviar
// DIP Switch
int var2,var3,var4,var5,var6;
int modo;
int no;// Para Arduino UNO CE_PIN 9  e  CSN_PIN 10
// Para Arduino UNO CE_PIN 48 e  CSN_PIN 49
#define CE_PIN   48
#define CSN_PIN 49
const uint64_t p1 = 0xE8E80F0LL;
const uint64_t pipe =(p1+no);
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção
String Mensagem;

void setup(void)
{
Serial.begin(9600);
// Mensagem inicial
Mensagem = "Transmissao de dados RS232/2.4 Ghz - Desenvolvido por Bruno Goncalves - Versao 1.0";
// Lampada Modo
pinMode(A0,OUTPUT);digitalWrite(A0,HIGH); // Alimentação lampada modo transmissao / recepcção
pinMode(A1,OUTPUT);digitalWrite(A1,HIGH); // Tranmissao
pinMode(A2,OUTPUT);digitalWrite(A2,HIGH); //Recepção
// Lampada TX/RX
pinMode(SaidaTX,OUTPUT);digitalWrite(SaidaTX,LOW);
// ********************************************************************************************************************
pinMode(2,INPUT);digitalWrite(2,HIGH);pinMode(3,INPUT);digitalWrite(3,HIGH);pinMode(4,INPUT);digitalWrite(4,HIGH);pinMode(5,INPUT);digitalWrite(5,HIGH);pinMode(6,INPUT);digitalWrite(6,HIGH);pinMode(7,INPUT);digitalWrite(7,HIGH);
if ( digitalRead(2)==1){var2 = 0;}if ( digitalRead(2)==0){var2 = 1;}
if ( digitalRead(3)==1){var3 = 0;}if ( digitalRead(3)==0){var3 = 1;}
if ( digitalRead(4)==1){var4 = 0;}if ( digitalRead(4)==0){var4 = 1;}
if ( digitalRead(5)==1){var5 = 0;}if ( digitalRead(5)==0){var5 = 1;}
if ( digitalRead(6)==1){var6 = 0;}if ( digitalRead(6)==0){var6 = 1;}
// Codigo para converter os binarios em um valor unico decimal compriendido de 0 a 31, sendo 32 numeros
no = ( ( 16 * var6 ) + ( 8 * var5 ) + ( 4 * var4 ) + ( 2 * var3 ) + ( 1 * var2 ) );
// Define  o modo    em 0 = recebe e em 1 = envia
if ( digitalRead(7)==0){modo = 1;Serial.print("Em modo de Transmissao!");Serial.print("   -   Utilizando o no: ");Serial.println(no);}
if ( digitalRead(7)==1){modo = 0;Serial.print("Em modo de Recepcao!");Serial.print("   -   Utilizando o no: ");Serial.println(no);}
const uint64_t pipe =(p1+no);
radio.begin();
radio.openWritingPipe(pipe);
}

void loop(void)
{

// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
if (modo == 0 )
{
pinMode(A2,OUTPUT);digitalWrite(A2,LOW); // Recepção acende
pinMode(A1,OUTPUT);digitalWrite(A1,HIGH); // Transmissão apaga


 
 // Se estiver dados disponiveis na serial ********************************************************************************
  while (Serial.available()) 
  {
    delay(3);  
    char c = Serial.read();
    readString += c;
    digitalWrite(SaidaTX,HIGH); 
  }
  // **********************************************************************************************************************
  
  
  if (readString.length() >0) // Se não for ruido, atribui o dado da serial na variavel Mensagem
    {
    Mensagem = readString;
    } 

int TamanhoMensagem = Mensagem.length(); // Variavel busca o tamanho da mensagem recebida para efetuar o for e concatenar

if ( Mensagem !="")
{
for (int i = -1; i < TamanhoMensagem; i++) // Executa o for n vezes referente ao tamanho do dado recebido na serial
{
int charToSend[1];
charToSend[0] = Mensagem.charAt(i);
radio.write(charToSend,1);
}
//Usado para finalizar string
msg[0] = 2; // Nao apagar
radio.write(msg,1);
digitalWrite(SaidaTX,LOW); 
}

 Mensagem = "";// Caso prefira que as mensagens fiquem se repetindo ate uma nova atualização, apagar essa linha
 readString="";

} // Fecha modo recepção



// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
if ( modo == 1 )
{
pinMode(A1,OUTPUT);digitalWrite(A1,LOW); // Tranmissao acende
pinMode(A2,OUTPUT);digitalWrite(A2,HIGH); // Recepção apaga




} //Fecha modo transmissão
}
