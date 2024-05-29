/*

   LEITURA DOS DADOS DE UM BARRAMENTO RS485

   
   Conexão do modulo RS485
   RO = Pino D1
   DI = Pino D2
   DE = Pino D0
   RE = Pino D0

*/


#include<SoftwareSerial.h>
#define transmitir D0 // Pino DE e RE - Transmissao
#define pinRX D1 // Pino RO
#define pinTX D2 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);

String readString; // Variavel pra concatenar dados da serial
char MensagemRecebida[13]; // Usado para criar a string de envio dos dados recebidos pelo MQTT

void imprimir()
{
  String DadosDaMensagemRecebida = String(MensagemRecebida);
  DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
  Serial.println(MensagemRecebida);
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  RS485.write(MensagemRecebida);
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   
  
}

void setup()
{
  Serial.begin(9600);
  RS485.begin(9600);
  pinMode(transmitir, OUTPUT);
  digitalWrite(transmitir, LOW);
}


void loop()
{
 while (RS485.available())
 {
  delay(3);
  char c = RS485.read();
  readString += c;
 }

  // Se receber mensagem 
 if (readString.length() > 0)
 {
  //Serial.println(readString);
  String DadosDaMensagemRecebida = {String(readString)};
  DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
  readString = ""; // Limpa a mensagem recebida
  imprimir(); // Chama o void para verificar o que deve ser feito
 }
} // Fecha loop


