#include <Keypad.h>
#include <LiquidCrystal.h>

LiquidCrystal lcd(49, 45, 43, 41, 39, 37);  // Declaração do objeto tipo lcd
  // Definição dos pinos dos botões, luz do display e buzzer
#define rele   6
#define rw  47
#define ledDisplay1  35
#define ledDisplay2  33
int contador2 = 0;
int contador = 0;
int contador1 = 0;
// definição de qual sera a senha

char senha[] = {'3', '8', '6', '2', '0', '1','\0'};
char palavra[] = {'0', '0', '0', '0', '0', '0','\0'};
int fechadura = 13;

const byte ROWS = 4; // 4 linhas
const byte COLS = 4;// 4 colunas

// definindo os caracteres que contem no nosso teclado

char keys[ROWS][COLS] = {
    {'1','2','3','A'},
    {'4','5','6','B'},
    {'7','8','9','C'},
    {'*','0','#','D'},
};

byte rowPins[ROWS] = {14, 15, 16, 17}; // atribui as linhas
byte colPins[COLS] = {18, 19, 20, 21}; // atribui as colunas

Keypad kpd = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );

void setup()
{
  pinMode(rw,OUTPUT);
  digitalWrite(rw,LOW);// 
  pinMode(ledDisplay1 ,OUTPUT);
  pinMode(ledDisplay2 ,OUTPUT);  // Luz de fundo do display 
  digitalWrite(ledDisplay1 ,HIGH);
  digitalWrite(ledDisplay2 ,LOW);// Liga a luz do display.
pinMode(12,OUTPUT);


  pinMode(fechadura,OUTPUT);
  digitalWrite(fechadura,LOW);

lcd.begin(16, 2);
lcd.clear();
delay(2000);
}



void loop()
{

char key = kpd.getKey();
if(key=='#'){contador2++;}
if(key=='*'){contador2--;}
if(key=='D'){contador2==0;}
if(key=='A'){contador2==1;}
if(key=='B'){contador2==2;}



if(contador2 = 0)
{
lcd.clear();delay(200);
lcd.setCursor(0, 0);
lcd.print("MENU            ");
}

//...................................................
if (contador2 = 1)
{

  if (key=='5')
  {
  contador2 = 0;
  }
  if(NO_KEY)
  {
  lcd.clear();delay(100);
  lcd.print("MENU jumps      ");
  lcd.setCursor(0, 1);delay(100);
  lcd.print("aperte de 1 a 4 ");
  }

  if(key=='1')
  {
  lcd.clear();delay(200);  
  lcd.setCursor(0, 0);
  lcd.print("JUMP 1          ");
  lcd.setCursor(0, 1);
  lcd.print("jump ativo      ");
  }

  if(key=='2')
  {
  lcd.clear();delay(200);  
  lcd.setCursor(0, 0);
  lcd.print("JUMP 2          ");
  lcd.setCursor(0, 1);
  lcd.print("jump ativo      ");
  }

  if(key=='3')
  {
  lcd.clear();delay(200);  
  lcd.setCursor(0, 0);
  lcd.print("JUMP 3          ");
  lcd.setCursor(0, 1);
  lcd.print("jump ativo      ");
  }

  if(key=='4')
  {
  lcd.clear();delay(200);  
  lcd.setCursor(0, 0);
  lcd.print("JUMP 4          ");
  lcd.setCursor(0, 1);
  lcd.print("jump ativo      ");
  }

}
//...........................................................
}





