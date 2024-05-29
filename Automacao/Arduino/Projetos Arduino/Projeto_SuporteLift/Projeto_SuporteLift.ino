/*
 * LCD RS pin to digital pin 13
 * LCD Enable pin to digital pin 12
 * LCD D4 pin to digital pin 11
 * LCD D5 pin to digital pin 10
 * LCD D6 pin to digital pin 9
 * LCD D7 pin to digital pin 8
 * LCD R/W pin to ground
 * LCD VSS pin to ground
 * LCD VCC pin to 5V
 * 10K resistor:
 * ends to +5V and ground
 * LCD VO pin (pin 3) - potenciometro

 */


int posicao;
int modo;

#include <LiquidCrystal.h>
LiquidCrystal lcd(13, 12, 11, 10, 9, 8);

void setup() 
{
 lcd.begin(16, 2);
 lcd.print("  Suporte Lift  ");
 delay(5000);
 modo=0;
 posicao = 0;

pinMode(2,INPUT);
pinMode(3,INPUT);
pinMode(4,INPUT);
pinMode(5,INPUT);

pinMode(6,OUTPUT); // seleciona modo de descer
pinMode(7,OUTPUT); // seleciona modo de subir

digitalWrite(6,0);
digitalWrite(7,0);

}

void loop()
{
  int ValorDesce = analogRead(A0);
  int ValorSobe = analogRead(A1);
  int ValorAtual = analogRead(A2);
  
  int ValorDesce1 = map(ValorDesce,0,1023,0,1023);
  int ValorSobe1 = map(ValorSobe,0,1023,0,1023);
  int ValorAtual1 = map(ValorAtual,0,1023,0,1023); 



// MAPEIA A CONDICAO DE OPERACAO     MANUAL OU AUTOMATICO *************************************************************************************************************************

if (digitalRead(5)==0&&modo==0){modo=1;delay(1000);}
if (digitalRead(5)==0&&modo==1){modo=0;delay(1000);}

if(modo==1)
{
 lcd.setCursor(0, 0);
 lcd.print("Modo: Automatico");
}

if(modo==0)
{
 lcd.setCursor(0, 0);
 lcd.print("Modo: Manual    ");
}

//***********************************************************************************************************************************************************************************

// MODO RESET
if (digitalRead(3)==0&&digitalRead(5)==0)
{
delay(2000);setup();
}

//***********************************************************************************************************************************************************************************


// mapeia o valor limite de descida
  lcd.setCursor(0, 1);
  lcd.print(ValorDesce1);
  if(ValorDesce1<1000){lcd.setCursor(3, 1);lcd.print(" ");lcd.setCursor(0, 1);lcd.print(ValorDesce1);}
  if(ValorDesce1<100){lcd.setCursor(2, 1);lcd.print(" ");lcd.setCursor(0, 1);lcd.print(ValorDesce1);}
  if(ValorDesce1<10){lcd.setCursor(1, 1);lcd.print(" ");lcd.setCursor(0, 1);lcd.print(ValorDesce1);}

// mapeia o valor limite de subida
  lcd.setCursor(5, 1);
  lcd.print(ValorSobe1);
  if(ValorSobe1<1000){lcd.setCursor(8, 1);lcd.print(" ");lcd.setCursor(5, 1);lcd.print(ValorSobe1);}
  if(ValorSobe1<100){lcd.setCursor(7, 1);lcd.print(" ");lcd.setCursor(5, 1);lcd.print(ValorSobe1);}
  if(ValorSobe1<10){lcd.setCursor(6, 1);lcd.print(" ");lcd.setCursor(5, 1);lcd.print(ValorSobe1);}

// mapeia o valor atual de posicao da base
  lcd.setCursor(10, 1);
  lcd.print(ValorAtual1);
  if(ValorAtual1<1000){lcd.setCursor(13, 1);lcd.print(" ");lcd.setCursor(10, 1);lcd.print(ValorAtual1);}
  if(ValorAtual1<100){lcd.setCursor(12, 1);lcd.print(" ");lcd.setCursor(10, 1);lcd.print(ValorAtual1);}
  if(ValorAtual1<10){lcd.setCursor(11, 1);lcd.print(" ");lcd.setCursor(10, 1);lcd.print(ValorAtual1);}
  
  if(ValorAtual1==ValorDesce1)
  {
  posicao=2;  
  lcd.setCursor(15, 1);
  lcd.print("P");
  digitalWrite(6,0); // desce
  digitalWrite(7,0); // sobe

  }

  if(ValorAtual1<ValorDesce1&&posicao==2)
  {
  posicao=1;  
  lcd.setCursor(15, 1);
  lcd.print("S");
  digitalWrite(6,0); // desce
  digitalWrite(7,1); // sobe
  }

  if(ValorAtual1==ValorSobe1&&posicao==1)
  {
  posicao=0;  
  lcd.setCursor(15, 1);
  lcd.print("P");
  digitalWrite(6,0); // desce
  digitalWrite(7,0); // sobe
  }

  if(ValorAtual1>ValorSobe1&&posicao==0)
  {
  posicao=1;  
  lcd.setCursor(15, 1);
  lcd.print("D");
  digitalWrite(6,1); // desce
  digitalWrite(7,0); // sobe
  }


// MODO MANUAL ****************************************************************************************************************************************************************

if(modo==0)
{








}

// ****************************************************************************************************************************************************************************




// MODO AUTOMATICO ************************************************************************************************************************************************************

if(modo==1)
{







}
// ****************************************************************************************************************************************************************************

} // FECHA LOOP



