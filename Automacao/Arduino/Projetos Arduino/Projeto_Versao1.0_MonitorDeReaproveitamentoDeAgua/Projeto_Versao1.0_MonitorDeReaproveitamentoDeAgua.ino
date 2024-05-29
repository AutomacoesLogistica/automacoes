#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Keypad.h>


long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 5000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
boolean tela_0_aux = 0;
int pulsos = 0;
int contador = 0;
int contador1 = 0;
int somatorio = 0;
float tela = 0;
boolean valor = 0;
char senha[] = {'2', '6', '8', '3', '0', '0', '\0'};
char palavra[] = {'0', '0', '0', '0', '0', '0', '\0'};
const byte ROWS = 4; // 4 linhas
const byte COLS = 4;// 4 colunas
char key;

int nivel_atual = 33;
int valor_de_bloqueio = 12;
int valor_de_capacidade_total = 0;
int valor_de_capacidade_util = 338;

//uint8_t seta[8] = {0x0,0x2,0x6,0x1F,0x1F,0x6,0x2,0x0};
uint8_t seta[8]  = {0x0, 0xc, 0x1d, 0xf, 0xf, 0x6, 0x0};




// definindo os caracteres que contem no nosso teclado

char keys[ROWS][COLS] = {
  {'1', '2', '3', 'A'},
  {'4', '5', '6', 'B'},
  {'7', '8', '9', 'C'},
  {'*', '0', '#', 'D'},
};

byte rowPins[ROWS] = {2, 3, 4, 5}; // atribui as linhas
byte colPins[COLS] = {6, 7, 8, 9}; // atribui as colunas

Keypad kpd = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );


// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x27, 16, 2);
void setup()
{
  lcd.begin();
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.createChar(0, seta);
  lcd.print ("bem vindo!      ");
  delay(20);
contador1 = 0;
}

void loop()
{
  AtualMillis = millis();    //Tempo atual em ms
  
  if (AtualMillis - UltimoMillis > intervalo) 
  { 
    UltimoMillis = AtualMillis;    // Salva o tempo atual
    tela_0_aux = !tela_0_aux;
    
  }


 if ( valor == 0 && tela == 2)
 {
 lcd.setCursor(0,0);
 lcd.print(">");
 lcd.setCursor(0,1);
 lcd.print(" ");
 }
 if ( valor == 1  && tela == 2)
 {
 lcd.setCursor(0,0);
 lcd.print(" "); 
 lcd.setCursor(0,1); 
 lcd.print(">");
 }

 
 key = kpd.getKey();
 
  if (key == '*'  && tela == 2.0)
  {
   valor = !valor;
  }
  if (key == '#'  && tela == 2.0)
  {
   if ( valor == 0 )
   {
    tela = 3.0;
    TELA_3();   
   }
   if ( valor == 1)
   {
     // tela_x;
     //TELA_X();
   }
  }

  if (key == '#'  && tela == 3.6)
  {
  tela = 0;delay(1000);TELA_0();
  }
  if (key == '#'  && tela == 3.3)
  {
  tela = 3.4;delay(1000);TELA_3();
  }
  if (key == '#'  && tela == 3.2)
  {
  tela = 3.3;delay(1000);TELA_3();
  }
  if (key == '#'  && tela == 3.1)
  {
  tela = 3.2;delay(1000);TELA_3();
  }

  

 

  







  
 if(contador1==0 && key=='1')
 {
  tela = 1; lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Digite a senha! ");
  delay(1000);contador1 = 1; TELA_1;tela = 1;
 }

   
 if(contador1==0 && key=='2')
 {
  contador1 = 2;lcd.clear();delay(10);
 }
 
 if ( contador1 == 1)
  {
   
   lcd.setCursor(0, 0);
   lcd.print("Digite a senha! ");
   if (key)
   {
    lcd.setCursor(0, 0);
    lcd.print("Digite a senha! ");
    lcd.setCursor(contador, 1);
    lcd.print(key);
    delay(10);
    palavra[contador] = key;
    contador++;
    if (key == 'C') 
    {
     contador = 0;
     lcd.clear();
     lcd.setCursor(0, 0);
     lcd.print("Digite a senha! ");
    }
    if (key == 'D') 
    {
     contador = 0;
     contador1 = 0;
     lcd.clear();
    }
    delay(100);
   }
   if (contador == 6)
   {
    palavra[contador] = '\0';
    if ((palavra[0] == senha[0]) && (palavra[1] == senha[1]) && (palavra[2] == senha[2]) && (palavra[3] == senha[3]) && (palavra[4] == senha[4]) && (palavra[5] == senha[5]))
    {
     lcd.clear();
     lcd.print("Acessando Menu! ");
     delay(2000);
     contador = 0;
     contador1 = 0;
     lcd.clear();
     tela = 2;
     TELA_2(); 
    }
    else
    {
     lcd.clear();
     lcd.print("Senha Incorreta!");
     delay(2000);
     contador = 0;
     contador1 = 1;
     lcd.clear();
     lcd.setCursor(0, 0);
     lcd.print("Digite a senha! ");
     lcd.setCursor(0, 1);
     lcd.print("                ");
    }
   }
  }



if ( tela==0 ) // Tela principal
{
  TELA_0();
}
  
 } // Fecha Loop
