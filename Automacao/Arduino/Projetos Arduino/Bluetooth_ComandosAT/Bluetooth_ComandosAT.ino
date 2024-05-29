#include <SoftwareSerial.h>
/*
  CONEXOES:
  ARDUINO   BLUETOOTH
  5V        VCC
  GND       GND
  PIN 2     TX
  PIN 3     RX
  
 */

SoftwareSerial bluetooth(2, 3);   //Cria a conexao para o bluetooth ( x , y ) onde x = RX e y = TX    >>>>> PIN 2 vai ao TX do modulo e o PIN 3 ao RX do modulo

char NOME[21]  = "Central_Multimedia"; // Nome de 20 caracteres maximo
char BPS         = '4';     // 1=1200 , 2=2400, 3=4800, 4=9600, 5=19200, 6=38400, 7=57600, 8=115200
char PASS[5]    = "1234";   // PIN de 4 caracteres numericos     
 
void setup()
{
    bluetooth.begin(9600); // inicialmente a comunicacao serial a 9600 Bauds (velocidade de fabrica)
    
    pinMode(13,OUTPUT);
    digitalWrite(13,HIGH); // Acende o LED 13 durante 4s antes de configurar o Bluetooth
    delay(4000);
    
    digitalWrite(13,LOW); // Apaga el LED 13 para iniciar a programacao
    
    bluetooth.print("AT");  // Inicializa comando AT
    delay(1000);
 
    bluetooth.print("AT+NAME"); // Configura o novo nome 
    bluetooth.print(NOME);
    delay(1000);                  // espera 1 segundo
 
    bluetooth.print("AT+BAUD");  // Configura a nova velocidade de baud rate 
    bluetooth.print(BPS); 
    delay(1000);
 
    bluetooth.print("AT+PIN");   // Configura o novo PIN
    bluetooth.print(PASS); 
    delay(1000);    
}
 
void loop()
{
    digitalWrite(13, !digitalRead(13)); // quando terminar de configurar o Bluetooth fica piscando o led
    delay(300);
}
