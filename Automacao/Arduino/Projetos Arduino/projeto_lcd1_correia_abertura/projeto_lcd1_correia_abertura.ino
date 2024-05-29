#include <LiquidCrystal.h>
#define Luz_Fundo  7
LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

byte heart[8] = {0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111};

void setup()
{
lcd.begin(16, 2);
pinMode(Luz_Fundo,OUTPUT);
digitalWrite(Luz_Fundo,HIGH);
lcd.setCursor(0,0);
lcd.print(" Bem Vindo! ");delay(5000);lcd.clear();
lcd.createChar(1, heart); // envia nosso character p/ o display
lcd.print("Carregando...  ");
lcd.setCursor(0,1);
lcd.write(1);
delay(200);
lcd.setCursor(1,1);
lcd.write(1);
delay(200);
lcd.setCursor(2,1);
lcd.write(1);
delay(200);
lcd.setCursor(3,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(4,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(5,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(6,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(7,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(8,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(9,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(10,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(11,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(12,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(13,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(14,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(15,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.clear();lcd.print("Carregando...  ");
lcd.setCursor(0,1);
lcd.write(1);
delay(200);
lcd.setCursor(1,1);
lcd.write(1);
delay(200);
lcd.setCursor(2,1);
lcd.write(1);
delay(200);
lcd.setCursor(3,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(4,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(5,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(6,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(7,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(8,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(9,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(10,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(11,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(12,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(13,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(14,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(15,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.clear();lcd.print("Carregando...  ");
lcd.setCursor(0,1);
lcd.write(1);
delay(200);
lcd.setCursor(1,1);
lcd.write(1);
delay(200);
lcd.setCursor(2,1);
lcd.write(1);
delay(200);
lcd.setCursor(3,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(4,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(5,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(6,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(7,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(8,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(9,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(10,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(11,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(12,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(13,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(14,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(15,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.clear();lcd.print("Carregando...  ");
lcd.setCursor(0,1);
lcd.write(1);
delay(200);
lcd.setCursor(1,1);
lcd.write(1);
delay(200);
lcd.setCursor(2,1);
lcd.write(1);
delay(200);
lcd.setCursor(3,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(4,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(5,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(6,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(7,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(8,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(9,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(10,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(11,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(12,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(13,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(14,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(15,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.clear();lcd.print("Carregando...  ");
lcd.setCursor(0,1);
lcd.write(1);
delay(200);
lcd.setCursor(1,1);
lcd.write(1);
delay(200);
lcd.setCursor(2,1);
lcd.write(1);
delay(200);
lcd.setCursor(3,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(4,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(5,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(6,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(7,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(8,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(9,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(10,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(11,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(12,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(13,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(14,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.setCursor(15,1);
lcd.write(1); // desenha o coração
delay(200);
lcd.clear();

lcd.print("Bruno Goncalves ");lcd.setCursor(0,1);
lcd.print("Tel:(31)88494604");
delay(3000);
lcd.clear();






}

void loop()
{
}

