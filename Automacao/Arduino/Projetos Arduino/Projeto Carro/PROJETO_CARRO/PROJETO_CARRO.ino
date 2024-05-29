
#include <LiquidCrystal.h>


// NUMERO 0 ..........................................................................
byte caracterZEROA[8] = {0b00000,0b00111,0b01111,0b01100,0b01100,0b01100,0b01100,0b01100};
byte caracterZEROB[8] = {0b00000,0b11100,0b11110,0b00110,0b00110,0b00110,0b00110,0b00110};
byte caracterZEROC[8] = {0b01100,0b01100,0b01100,0b01100,0b01100,0b01111,0b00111,0b00000};
byte caracterZEROD[8] = {0b00110,0b00110,0b00110,0b00110,0b00110,0b11110,0b11100,0b00000};
//....................................................................................


// NUMERO 1 ..........................................................................
byte caracterUMA[8] = {0b00000,0b00001,0b00011,0b00111,0b01111,0b00001,0b00001,0b00001};
byte caracterUMB[8] = {0b00000,0b10000,0b10000,0b10000,0b10000,0b10000,0b10000,0b10000};
byte caracterUMC[8] = {0b00001,0b00001,0b00001,0b00001,0b00001,0b01111,0b01111,0b00000};
byte caracterUMD[8] = {0b10000,0b10000,0b10000,0b10000,0b10000,0b11110,0b11110,0b00000};
//....................................................................................

// NUMERO 2 ..........................................................................
byte caracterDOISA[8] = {0b00000,0b00001,0b00011,0b00110,0b01100,0b0000,0b00000,0b00000};
byte caracterDOISB[8] = {0b00000,0b10000,0b11000,0b01100,0b00110,0b00110,0b00110,0b01100};
byte caracterDOISC[8] = {0b00000,0b00001,0b00011,0b00110,0b01100,0b01111,0b01111,0b00000};
byte caracterDOISD[8] = {0b11000,0b10000,0b00000,0b00000,0b00000,0b11110,0b11110,0b00000};
//....................................................................................


// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(49, 45, 43, 41, 39, 37); 
// define cabos do lcd ............................................................................................................................................................. 
#define rw  47 // coloca a saida para terra, simula um gnd
#define ledDisplay1  35 // anodo do display
#define ledDisplay2  33 // catodo do display
int seg;
int minuto;
int hora;


void setup() {
pinMode(rw,OUTPUT);
digitalWrite(rw,0);
pinMode(ledDisplay1,OUTPUT);
digitalWrite(ledDisplay1,1);
pinMode(ledDisplay2,OUTPUT);
digitalWrite(ledDisplay2,0);
lcd.begin(16, 2);
 // lcd.setCursor(4, 0);
 // lcd.print("Relogio:");
  pinMode(2,INPUT);
  pinMode(3,INPUT);
  seg = 0;
  minuto = 0;
  hora = 0;
} 
void loop()
{
// CRIA ZERO  ................................................
lcd.createChar(1.1, caracterZEROA);
lcd.createChar(2.1, caracterZEROB);
lcd.createChar(3.1, caracterZEROC);
lcd.createChar(4.1, caracterZEROD);
//............................................................


// CRIA UM  ................................................
lcd.createChar(5.1, caracterUMA);
lcd.createChar(6.1, caracterUMB);
lcd.createChar(7.1, caracterUMC);
lcd.createChar(8.1, caracterUMD);
//............................................................


// CRIA DOIS  ................................................
lcd.createChar(9, caracterDOISA);
lcd.createChar(10, caracterDOISB);
lcd.createChar(11, caracterDOISC);
lcd.createChar(12, caracterDOISD);
//............................................................

lcd.setCursor(0,0);
lcd.write(1.1);
lcd.setCursor(1,0);
lcd.write(2.1);
lcd.setCursor(0,1);
lcd.write(3.1);
lcd.setCursor(1,1);
lcd.write(4.1);
delay(3000);
lcd.setCursor(0,0);
lcd.write(5.1);
lcd.setCursor(1,0);
lcd.write(6.1);
lcd.setCursor(0,1);
lcd.write(7.1);
lcd.setCursor(1,1);
lcd.write(8.1);
delay(3000);
lcd.setCursor(0,0);
lcd.write(9);
lcd.setCursor(1,0);
lcd.write(10);
lcd.setCursor(0,1);
lcd.write(11);
lcd.setCursor(1,1);
lcd.write(12);
delay(3000);

}

