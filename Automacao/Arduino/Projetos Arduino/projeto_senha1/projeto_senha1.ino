#include <Keypad.h>
#include <LiquidCrystal.h>

LiquidCrystal lcd(49, 45, 43, 41, 39, 37);  // Declaração do objeto tipo lcd
  // Definição dos pinos dos botões, luz do display e buzzer
#define rele   6
#define rw  47
#define ledDisplay1  35
#define ledDisplay2  33

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
lcd.print("Inicializando...");
delay(2000);
lcd.clear();
lcd.print("Digite a senha: ");
}
void loop()
{
 
if (contador1!=1)
{
lcd.setCursor(0, 0);
lcd.print("Digite a senha: ");
}
else
{
lcd.setCursor(0, 0);
lcd.print("Bem Vindo!      ");
}
   
char key = kpd.getKey();
if ( contador1==1) {digitalWrite(12,1);} else { digitalWrite(12,0);}

if(key)
{
 lcd.setCursor(contador, 1);
 lcd.print(key);
 delay(10);
 palavra[contador] = key;
 contador++;
 if (key=='C'){contador = 0;lcd.clear();}
  if (key=='D'){contador = 0;contador1 = 0;lcd.clear();}
delay(10);
 
 if (contador==6)
 {
   palavra[contador] = '\0';
   if ((palavra[0] == senha[0]) &&(palavra[1] == senha[1]) &&(palavra[2] == senha[2]) &&(palavra[3] == senha[3]) &&(palavra[4] == senha[4]) &&(palavra[5] == senha[5]))
   {
    lcd.clear(); 
    lcd.print(" Senha Correta! ");
    delay(2000);
    contador = 0;
    contador1++;
    lcd.clear();
    digitalWrite(fechadura, HIGH);delay(200);digitalWrite(fechadura,LOW);delay(100);    
   }
  else
   {
    lcd.clear();
    lcd.print("Senha Incorreta!");
    delay(2000);
    contador = 0;
    contador1 = 0;
    lcd.clear();
    lcd.print("Digite a senha: ");
    digitalWrite(fechadura, LOW);delay(1000); 
       
 
 }
 } 
}

}





