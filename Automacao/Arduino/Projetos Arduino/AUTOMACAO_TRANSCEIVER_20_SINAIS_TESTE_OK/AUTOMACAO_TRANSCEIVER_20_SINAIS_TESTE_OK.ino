// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
#define CE_PIN   9
#define CSN_PIN 10

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089
RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

// inclui a biblioteca LiquidCrystal:
#include <LiquidCrystal.h>
// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(7, 6, 5, 4, 3, 2);

String readString;
int modo;
int x;     
int SINAIS[20];  // usada para receber os comandos enviados

void setup()
{
 
  Serial.begin(9600);
  delay(10);
  // configura o numero de colunas e linhas do LCD: 
  lcd.begin(20, 4);
  radio.begin();
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
  x=0;
  modo=0;
  lcd.setCursor(0, 0);lcd.print("                    ");lcd.setCursor(0, 0);lcd.print("    GA Automacoes   ");
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("Modo Recepcao");
}

void loop()
{
 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString+=c; 
 }
 if (readString.indexOf("transmissao")>=0)     
 {
  radio.stopListening();;  
  lcd.clear();
  lcd.setCursor(0, 0);lcd.print("                    ");lcd.setCursor(0, 0);lcd.print("    GA Automacoes   ");
  radio.openWritingPipe(pipe);
  modo=1;
  lcd.setCursor(0, 2);lcd.print("                    ");lcd.setCursor(0, 2);lcd.print("Modo Transmissao"); 
  readString="";
 }

if(modo==0)
{
 if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
 {
  radio.read( SINAIS, sizeof(SINAIS) );
  if(SINAIS[0]==1)
  {
   lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Ligado [0]");delay(10);x=0;
  }
  if(SINAIS[0]==0)
  {
  lcd.setCursor(0, 1);lcd.print("                    ");lcd.setCursor(0, 1);lcd.print("Desligado [0]");delay(10);x=0;  
  }
  if(SINAIS[0]==9&&x==0)
  {
   x=1;lcd.setCursor(0, 3);lcd.print("                    ");lcd.setCursor(0, 3);lcd.print("Transmissor OK");
  }
 }
           
}// fecha modo=0

 if(modo==1)
 {
  SINAIS[0]=1;
  radio.write(SINAIS,sizeof(0));Serial.println(SINAIS[0]);
  SINAIS[0]=9;
  radio.write(SINAIS,sizeof(0));Serial.println(SINAIS[0]);
  delay(2000);
  setup(); 
 }
 
 }// fecha loop
 

