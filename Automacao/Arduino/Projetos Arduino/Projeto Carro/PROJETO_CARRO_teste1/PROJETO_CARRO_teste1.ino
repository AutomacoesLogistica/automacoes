
#include <LiquidCrystal.h>
#include <Keypad.h>
// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(49, 45, 43, 41, 39, 37); 
// define cabos do lcd ............................................................................................................................................................. 
#define rw  47 // coloca a saida para terra, simula um gnd
#define ledDisplay1  35 // anodo do display
#define ledDisplay2  33 // catodo do display
int seg;
int minuto;
int hora;
int menu;
const byte ROWS = 4; // 4 linhas
const byte COLS = 4;// 4 colunas
char keys[ROWS][COLS] = {
    {'1','2','3','A'},
    {'4','5','6','B'},
    {'7','8','9','C'},
    {'*','0','#','D'},
};
// define as entradas para o teclado ........................................................................................................................................................
byte rowPins[ROWS] = {14, 15, 16, 17}; // atribui as linhas
byte colPins[COLS] = {18, 19, 20, 21}; // atribui as colunas
Keypad kpd = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );
char key = kpd.getKey();



void setup() {
pinMode(rw,OUTPUT);
digitalWrite(rw,0);
pinMode(ledDisplay1,OUTPUT);
digitalWrite(ledDisplay1,1);
pinMode(ledDisplay2,OUTPUT);
digitalWrite(ledDisplay2,0);
pinMode(2,INPUT);
  pinMode(3,INPUT);
  seg = 0;
  minuto = 0;
  hora = 0;
menu = 0;



  lcd.begin(16, 2);
  delay(5000);
  lcd.setCursor(0,0);
  lcd.print("   NEW  CIVIC   ");
  delay(5000);lcd.clear();
  
lcd.setCursor(0,0);
lcd.print("TENSAO BATERIA: ");
lcd.setCursor(0,1);
lcd.print("       12 Volts ");
delay(5000);lcd.clear();delay(100);

lcd.setCursor(0,0);
lcd.print(" LIGUE O CARRO  ");
delay(5000);lcd.clear();delay(100);

  lcd.setCursor(0,0);
  lcd.print("TENSAO BATERIA: ");
  lcd.setCursor(0,1);
  lcd.print("     14,3 Volts ");
  delay(5000);
lcd.clear();delay(100);

  lcd.setCursor(0,0);
  lcd.print(" AJUSTE A HORA  ");
  lcd.setCursor(0,1);
  lcd.print(" Hora:   :  :00 ");

  
} 
void loop()
{

  
  if(menu==1)
  {
  lcd.clear();delay(10);
  lcd.setCursor(0,0);
  lcd.print(" AJUSTE A HORA  ");
  lcd.setCursor(0,1);
  lcd.print(" Hora:   :  :00 ");

char key = kpd.getKey();
if(key=='#'){minuto++;}
if(key=='*'){hora++;}
if(key=='D'){menu = 0;}

lcd.setCursor(11,1);
lcd.print(minuto);
lcd.setCursor(8,1);
lcd.print(hora);

 
} 
  
// RELOGIO ========================================================================================================================================================================


if(menu==0)
{


if(key=='D'){menu = 1;}
lcd.setCursor(4, 0);
lcd.print("Relogio:");
//if (digitalRead(2)!=0){seg++;}
//if (digitalRead(3)!=0){minuto++;}

 seg++;
 if(seg==60)
 { seg = 0;minuto++; }
 
 if(minuto==60)
 { hora++; }
 
 if(hora==24)
 {
  hora = 0;
} 
  
  if(minuto==60)
 { minuto = 0; }
 lcd.setCursor(6,1);
 lcd.print(":");
 lcd.setCursor(9,1);
 lcd.print(":");
    
  if(seg<10)
  {
    lcd.setCursor(10,1);
    lcd.print("0");
    lcd.setCursor(11,1);
    lcd.print(seg);
  }
   if(seg>=10)
  {
    lcd.setCursor(10,1);
    lcd.print(seg);
  }
  //______________________________________
  
  if(minuto<10)
  {
    lcd.setCursor(7,1);
    lcd.print("0");
    lcd.setCursor(8,1);
    lcd.print(minuto);
  }
   if(minuto>=10)
  {
    lcd.setCursor(7,1);
    lcd.print(minuto);
  }

  //______________________________________
  
  if(hora<10)
  {
    lcd.setCursor(4,1);
    lcd.print("0");
    lcd.setCursor(5,1);
    lcd.print(hora);
  }
   if(hora>=10)
  {
    lcd.setCursor(4,1);
    lcd.print(hora);
  }

  
delay(1000);

//============================================================================================================================================================================================
}

}

 



