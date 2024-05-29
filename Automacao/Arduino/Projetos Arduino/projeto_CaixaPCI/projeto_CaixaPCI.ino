/*

BGautomacoes
Canal YouTube
https://www.youtube.com/channel/UCV0Izow6n1wyt03qW1vb9yA

PROJETO CAIXA PARA CONFECCAO DE CIRCUITOS IMPRESSOS





Ligação do Display LCD 16x2

1 - pino GND LCD
2 - pino VCC LCD
3 - pino ajuste contraste (Centro do potenciometro )
4 - pino 13
5 - pino GND
6 - pino 12                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
7 - pino NC
8 - pino NC
9 - pino NC
10 - pino NC
11 - pino 11
12 - pino 10
13 - pino 9
14 - pino 8
15 - pino VCC
16 - pino GND

**********************************************************************

TECLADO

Linhas
1 - pino A0
2 - pino A1
3 - pino A2
4 - pino A3

Colunas
5 - pino 2
6 - pino 3
7 - pino 4 
8 - pino 5

*********************************************************************

Lâmpadas

Normal = A4 ( Aciona um módulo relé )
Luz Negra = A5 ( Aciona um módulo relé )

*********************************************************************



*/


#include <Keypad.h> // Importa a biblioteca para o teclado Matricial
#include <LiquidCrystal.h> // Importa a biblioteca para o LCD

int menu;

LiquidCrystal lcd(13, 12, 11, 10, 9, 8);  // Declaração do objeto tipo lcd

  

int contador = 0;
int contador1 = 0;

char palavra[] = {'0', '0', '0','\0'};
char tempo1;
char tempo2;
char tempo3;
int TEMPO;
const byte ROWS = 4; // 4 linhas
const byte COLS = 4; // 4 colunas
// 4 colunas

// definindo os caracteres que contem no nosso teclado

char keys[ROWS][COLS] = {
    {'1','2','3','A'},
    {'4','5','6','B'},
    {'7','8','9','C'},
    {'*','0','#','D'},
};

byte rowPins[ROWS] = {A0, A1, A2, A3}; // atribui as linhas
byte colPins[COLS] = {2, 3, 4, 5}; // atribui as colunas

Keypad kpd = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );

int valorTempo = 0; 
int intervalo = 0; // DEFINE O TEMPO DO TIMER
int numero_vezes_loop;
int timer_ativo;
void setup()
{
  lcd.begin(16, 2);
  lcd.clear();
  lcd.print("Inicializando...");
  delay(2000);
  lcd.clear();
  lcd.print("Digite o tempo :");
  pinMode(A4,OUTPUT);
  pinMode(A5,OUTPUT); 
  digitalWrite(A4,0);
  digitalWrite(A5,0); 
  contador = 0; 
  timer_ativo = 0;
  numero_vezes_loop = 0; 
}

void loop()
{
 
  unsigned long tempo = millis()/1000;

//********************************************************************************************************************

if (timer_ativo == 1)
{
  if(tempo - valorTempo > intervalo) 
 {
  lcd.clear();
  valorTempo = tempo;
  lcd.setCursor(0,0);
  digitalWrite(A5,0);
  lcd.print("Finalizado!     ");
  delay(2500);
  lcd.setCursor(0,0);
  timer_ativo = 0;
  lcd.print("Digite o tempo :");
  contador = 0;
  contador1 = 0;
 }
 else
 {
 
  lcd.setCursor(11,1);
  lcd.print(tempo-valorTempo);
 }
}


//******************************************************************************************************************** 
  
   
char key = kpd.getKey();



if(key)
{
 lcd.setCursor(contador, 1);
 lcd.print(key);
 delay(10);
 palavra[contador] = key;
 contador++;

 if (key=='A' && contador1==1)
 {
  timer_ativo = 1;
  intervalo = TEMPO;
  valorTempo = millis()/1000;
  digitalWrite(A4,0);
  digitalWrite(A5,1);
  lcd.setCursor(0,1);
  lcd.print("Andamento :     ");
 }



 if (key=='B')
 {
  
  if ( timer_ativo==0)
  {  
  digitalWrite(A4,!digitalRead(A4));
  
  if (digitalRead(A4)==0)
  {
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Lamp. Desligada!");
  delay(1500);

  lcd.setCursor(0,0);
  lcd.print("Digite o tempo :");
  }
  
  if (digitalRead(A4)==1)
  {
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Lamp. Ligada!   ");
  delay(1500);
  lcd.setCursor(0,0);
  lcd.print("Digite o tempo :");
  }
  contador = 0;  
 }
 }



 if (key=='C')
 {
  lcd.clear(); 
  lcd.setCursor(0,0);
  lcd.print("Digite o tempo :");
  contador = 0;
 }
 
 if (key=='D') // Reinicia o Arduino
 {
 setup();
 }
 

 
 
if (contador==3)
{
   palavra[contador] = '\0';

   tempo1 = palavra[0];
   tempo2 = palavra[1];
   tempo3 = palavra[2];
  
   TEMPO = atoi(palavra);
   lcd.setCursor(0,0);
   lcd.print("Setado :        ");
   lcd.setCursor(9,0);
   lcd.print(TEMPO);
   lcd.setCursor(0,1);
   lcd.print("Aperte A p/ ini.");
   contador = 0;
   contador1 = 1;
  }
 } 
}





