#include <nRF24L01.h>
#include <RF24.h>
#include <RF24_config.h>
#include <SPI.h>
#define SaidaTXRX A3
String readString;
int msg[1];
// DIP Switch
int var2,var3,var4,var5,var6;
int modo;
int no;
// Para Arduino UNO CE_PIN 9  e  CSN_PIN 10
// Para Arduino UNO CE_PIN 48 e  CSN_PIN 49
#define CE_PIN   9
#define CSN_PIN 10
const uint64_t p1 = 0xE8E80F0LL;
const uint64_t pipe =(p1+no);
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção
String Mensagem = "";
String UltimaMensagem = "0";

void setup()
{
Serial.begin(9600);
// Mensagem inicial
Mensagem = "Transmissao de dados RS232/2.4 Ghz - Desenvolvido por Bruno Goncalves - Versao 1.0";
// Lampada Modo
pinMode(A0,OUTPUT);digitalWrite(A0,HIGH); // Alimentação lampada modo transmissao / recepcção
pinMode(A1,OUTPUT);digitalWrite(A1,HIGH); // Tranmissao
pinMode(A2,OUTPUT);digitalWrite(A2,HIGH); //Recepção
// Lampada TX/RX
pinMode(SaidaTXRX,OUTPUT);digitalWrite(SaidaTXRX,LOW);
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

if ( modo == 0)
{
radio.openReadingPipe(1,pipe);
radio.startListening();
}
if (modo ==1 )
{
radio.openWritingPipe(pipe);
}


}
void loop()
{ // Abre loop

// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
// MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO     MODO RECEPÇÂO    
if (modo == 0 )
{
pinMode(A2,OUTPUT);digitalWrite(A2,LOW); // Recepção acende
pinMode(A1,OUTPUT);digitalWrite(A1,HIGH); // Transmissão apaga

if (radio.available()>0)
{
 bool finalizado = false;
 finalizado = radio.read(msg, 1);
 char Char = msg[0];
 if (msg[0] !=2)
 {
   Mensagem.concat(Char);
   digitalWrite(SaidaTXRX,HIGH);
 }
 else
 {
  if((Mensagem!=UltimaMensagem)&& Mensagem!="")
 {
  
  Serial.print(Mensagem);
  UltimaMensagem = Mensagem;

  }
  digitalWrite(SaidaTXRX,LOW);
  Mensagem = "";
 } // Fecha else
} // Fecha if radio available
} // Fecha modo Recepção

// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
// MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO    MODO TRANSMISSÃO   
if ( modo == 1 )
{
pinMode(A1,OUTPUT);digitalWrite(A1,LOW); // Tranmissao acende
pinMode(A2,OUTPUT);digitalWrite(A2,HIGH); // Recepção apaga
 // Se estiver dados disponiveis na serial ********************************************************************************
  while (Serial.available()) 
  {
      
    char c = Serial.read();
    readString += c;
    digitalWrite(SaidaTXRX,HIGH); 
  }
  // **********************************************************************************************************************
  
  
  if (readString.length() >0) // Se não for ruido, atribui o dado da serial na variavel Mensagem
    {
    Mensagem = readString;
    } 

int TamanhoMensagem = Mensagem.length(); // Variavel busca o tamanho da mensagem recebida para efetuar o for e concatenar

if ( ( Mensagem != UltimaMensagem ) && Mensagem !="")
{
  UltimaMensagem = Mensagem;
for (int i = -1; i < TamanhoMensagem; i++) // Executa o for n vezes referente ao tamanho do dado recebido na serial
{
int charToSend[1];
charToSend[0] = Mensagem.charAt(i);
radio.write(charToSend,1);
}
//Usado para finalizar string
msg[0] = 2; // Nao apagar
radio.write(msg,1);
digitalWrite(SaidaTXRX,LOW); 
}

 Mensagem = "";// Caso prefira que as mensagens fiquem se repetindo ate uma nova atualização, apagar essa linha
 readString="";


} //Fecha modo transmissao

} // Fecha loop
