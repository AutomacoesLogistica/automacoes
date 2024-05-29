#include <LiquidCrystal.h>
#define Luz_Fundo  7


//Conexoes LCD
//VSS = GND
//VDD = Positivo
//Vo = Centro Potenciometro
//Rs = 12
//Rw = GND
//E = 11
//D4 = 5
//D5 = 4
//D6 = 3
//D7 = 2
//A = 7      A e K alimentam luz do display LCD
//K = GND


// MENUS

//A0 = botao 1
//A1 = botao 2
//A2 = botao 3


LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

byte heart[8] = {0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111};
#include <LiquidCrystal.h>
#define Luz_Fundo  7

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
lcd.write(1); 
delay(200);
lcd.setCursor(4,1);
lcd.write(1);
delay(200);
lcd.setCursor(5,1);
lcd.write(1); 
delay(200);
lcd.setCursor(6,1);
lcd.write(1);
delay(200);
lcd.setCursor(7,1);
lcd.write(1);
delay(200);
lcd.setCursor(8,1);
lcd.write(1);
delay(200);
lcd.setCursor(9,1);
lcd.write(1); 
delay(200);
lcd.setCursor(10,1);
lcd.write(1); 
delay(200);
lcd.setCursor(11,1);
lcd.write(1); 
delay(200);
lcd.setCursor(12,1);
lcd.write(1); 
delay(200);
lcd.setCursor(13,1);
lcd.write(1); 
delay(200);
lcd.setCursor(14,1);
lcd.write(1);
delay(200);
lcd.setCursor(15,1);
lcd.write(1); 
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
lcd.write(1);
delay(200);
lcd.setCursor(4,1);
lcd.write(1);
delay(200);
lcd.setCursor(5,1);
lcd.write(1);
delay(200);
lcd.setCursor(6,1);
lcd.write(1);
delay(200);
lcd.setCursor(7,1);
lcd.write(1);
delay(200);
lcd.setCursor(8,1);
lcd.write(1);
delay(200);
lcd.setCursor(9,1);
lcd.write(1);
delay(200);
lcd.setCursor(10,1);
lcd.write(1);
delay(200);
lcd.setCursor(11,1);
lcd.write(1);
delay(200);
lcd.setCursor(12,1);
lcd.write(1);
delay(200);
lcd.setCursor(13,1);
lcd.write(1);
delay(200);
lcd.setCursor(14,1);
lcd.write(1);
delay(200);
lcd.setCursor(15,1);
lcd.write(1);
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
lcd.write(1);
delay(200);
lcd.setCursor(4,1);
lcd.write(1);
delay(200);
lcd.setCursor(5,1);
lcd.write(1);
delay(200);
lcd.setCursor(6,1);
lcd.write(1);
delay(200);
lcd.setCursor(7,1);
lcd.write(1);
delay(200);
lcd.setCursor(8,1);
lcd.write(1);
delay(200);
lcd.setCursor(9,1);
lcd.write(1);
delay(200);
lcd.setCursor(10,1);
lcd.write(1);
delay(200);
lcd.setCursor(11,1);
lcd.write(1);
delay(200);
lcd.setCursor(12,1);
lcd.write(1);
delay(200);
lcd.setCursor(13,1);
lcd.write(1);
delay(200);
lcd.setCursor(14,1);
lcd.write(1);
delay(200);
lcd.setCursor(15,1);
lcd.write(1);
delay(200);
lcd.clear();

lcd.print("Bruno Goncalves ");lcd.setCursor(0,1);
lcd.print("Tel:(31)88494604");
delay(3000);
lcd.clear();

lcd.print("Acessando MENU  ");lcd.setCursor(0,1);
lcd.print("Aguarde ...     ");
delay(5000);
lcd.clear();

}

void loop()
{
 
int bstatus = analogRead(A0);
int bdefeitos = analogRead(A1);
int bjump = analogRead(A2); 
int a;
int b;
int c;
int d;
int A;
int B;
int C;

a = bstatus<=800;
b = bdefeitos<=200;  
c = bjump<=200;
A = bstatus>=1000;
B = bdefeitos>=1000;
C = bjump>=1000;
d = (A&&B&&C);

// MENUS ..................................................................................................................................................................................

 if (a==B==C)

{
lcd.print("STATUS CORREIA  " );lcd.setCursor(0,1);lcd.print("Correia OK      ");
}
 
if (b)
 {
 lcd.print("DEFEITOS CORREIA" );lcd.setCursor(0,1);lcd.print("Defeitos =      ");}

if (c)
 {
 lcd.print("JUMPER ATIVO    " );lcd.setCursor(0,1);lcd.print("dddd            ");}
 
 
  if (d)
 {
 lcd.print("MENU            ");lcd.setCursor(0,1);lcd.print("1 = Defeitos    ");delay(2000);lcd.setCursor(0,1);lcd.print("2=Status Correia");delay(2000);lcd.setCursor(0,1);lcd.print("3=Jumpers Ativos");delay(2000);} 
 
delay(1000);
  

}
//.............................................................................................................................................................................................



