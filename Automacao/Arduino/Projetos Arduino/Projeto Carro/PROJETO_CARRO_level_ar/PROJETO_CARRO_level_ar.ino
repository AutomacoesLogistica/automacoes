
#include <LiquidCrystal.h>
byte l8[8] = {                                   B00011,                                  B11011,                                  B11011,                                  B11011,                                  B11011,                                  B11011,                                  B11011,                                  B11011                             };
byte l7[8] = {                                   B00000,                                  B11000,                                  B11000,                                  B11000,                                  B11000,                                  B11000,                                  B11000,                                  B11000                             };
byte l6[8] = {                                   B00000,                                  B00000,                                  B00011,                                  B11011,                                  B11011,                                  B11011,                                  B11011,                                  B11011                             };
byte l4[8] = {                                   B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00011,                                  B11011,                                  B11011,                                  B11011                             };
byte l5[8] = {                                   B00000,                                  B00000,                                  B00000,                                  B11000,                                  B11000,                                  B11000,                                  B11000,                                  B11000                             };
byte l3[8] = {                                   B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00000,                                  B11000,                                  B11000,                                  B11000                             };
byte l2[8] = {                                   B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00011,                                  B11011                             };
byte l1[8] = {                                   B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00000,                                  B00000,                                  B11000                             };

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
// CRIA level  ................................................
lcd.createChar(8, l8);
lcd.createChar(7, l7);
lcd.createChar(6, l6);
lcd.createChar(5, l5);
lcd.createChar(4, l4);
lcd.createChar(3, l3);  
lcd.createChar(2, l2);
lcd.createChar(9, l1);

lcd.setCursor(0,0);
lcd.write(9);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 12.5 %");
delay(3000);
lcd.setCursor(0,0);
lcd.write(2);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 25 %  ");
delay(3000);
lcd.setCursor(1,0);
lcd.write(3);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 37.5 %");
delay(3000);
lcd.setCursor(1,0);
lcd.write(4);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 50 %  ");
delay(3000);
lcd.setCursor(2,0);
lcd.write(5);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 62.5 %");
delay(3000);
lcd.setCursor(2,0);
lcd.write(6);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 75 %  ");
delay(3000);
lcd.setCursor(3,0);
lcd.write(7);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 87.5 %");
delay(3000);
lcd.setCursor(3,0);
lcd.write(8);
lcd.setCursor(0,1);
lcd.println("Ar Ligado 100 % ");
delay(3000);
lcd.clear();
delay(5000);


}

