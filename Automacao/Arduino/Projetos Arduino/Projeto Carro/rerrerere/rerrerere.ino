
#include <LiquidCrystal.h>

// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(49, 45, 43, 41, 39, 37); 
// define cabos do lcd ............................................................................................................................................................. 
#define rw  47 // coloca a saida para terra, simula um gnd
#define ledDisplay1  35 // anodo do display
#define ledDisplay2  33 // catodo do display
int segundo;
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
  lcd.setCursor(4, 0);
  lcd.print("Relogio:");
  pinMode(2,INPUT);
  pinMode(3,INPUT);
  segundo = 0;
  minuto = 0;
  hora = 0;
} 
void loop()
{
  if(digitalRead(2) == 1){
    hora++;
  }
  if(digitalRead(3) == 1){
    minuto++;
  }

  lcd.setCursor(4,1);
  if(hora < 10){
    lcd.print("0");
  }
  if(hora > 24){
    hora = 0;
  }
  lcd.print(hora);
  lcd.print(":");
   
  if(minuto < 10){
    lcd.print("0");
  }
  lcd.print(minuto);
  lcd.print(":");
  
  if(segundo < 10){
    lcd.print("0");
  }
  lcd.print(segundo);
  
  segundo++;
  if(segundo == 60){
    minuto++;
    segundo = 0;
  }
  if(minuto == 60){
    hora++;
    minuto = 0;
  }
 
  if(hora == 24){
    hora = 0;
  } 
  delay(1000);
}

 



