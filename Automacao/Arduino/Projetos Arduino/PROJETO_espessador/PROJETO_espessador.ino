// ...................................................PROJETO EQUIPAMENTO DE DETECÇÃO DE FALHAS DE CORREIAS TRANSPORTADORAS ...................................................................

// Conexoes LCD

//    1 =  VSS = GND = gnd
//    2 =  VDD = Positivo = 53
//    3 =  Vo = Centro Potenciometro
//    4 =  Rs = 12 = 49
//    5 =  Rw = GND = 47
//    6 =  E = 11 = 45
//    7 =  nao conecta
//    8 =  nao conecta
//    9 =  nao conecta
//   10 =  nao conecta
//   11 =  D4 = 5 = 43
//   12 =  D5 = 4 = 41
//   13 =  D6 = 3 = 39
//   14 =  D7 = 2 = 37
//   15 =  A = 5V  = 35     A e K alimentam luz do display LCD
//   16 =  K = GND = 33

#include <Keypad.h>
#include <LiquidCrystal.h>  
LiquidCrystal lcd(49, 45, 43, 41, 39, 37);  // Declaração do objeto tipo lcd


// desenha o icone do carregando
byte heart[8] = {0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111};

// desenha as setas do menu
byte heart1[8] = {0b00000,0b01000,0b01100,0b11110,0b11111,0b11110,0b01100,0b01000};
byte heart2[8] = {0b00000,0b00010,0b00110,0b01111,0b11111,0b01111,0b00110,0b00010};
byte heart3[8] = {0b00000,0b00000,0b00000,0b11111,0b11111,0b11111,0b00000,0b00000};

// DEFINIÇÃO DAS ENTRADAS -  DEFINIÇÃO DAS ENTRADAS -  DEFINIÇÃO DAS ENTRADAS -  DEFINIÇÃO DAS ENTRADAS -  DEFINIÇÃO DAS ENTRADAS -  DEFINIÇÃO DAS ENTRADAS -  DEFINIÇÃO DAS ENTRADAS - 

// Definição dos pinos referente a entrada .........................................................................................................................................
#define vcce 7 // vira 5v para alimentar as entradas referentes a correia ( x,y,z e w)
#define entw 6 // recebe o sina da linha de corda gaveta
#define entz 5 // recebe o sina da linha de corda plc
#define enty 4 // recebe o sina da linha de desalinhamento
#define entx 3 // recebe o sina da linha de emergencia de soco
#define gnde 2  // vira ground para as entradas referentes a correia  ( x,y,z e w)

// define cabos do lcd ............................................................................................................................................................. 
#define rw  47 // coloca a saida para terra, simula um gnd
#define ledDisplay1  35 // anodo do display
#define ledDisplay2  33 // catodo do display

// define cabos dos leds ...........................................................................................................................................................
#define lok 13 // alimenta led de ok
#define ldefeito 12 // alimenta led de defeito
#define ljump 11 // alimenta o led de jump ativo

// define cabos lampada 127 e sinal de jump para o PLC .............................................................................................................................
#define relelamp 10 // sainda para acionar o rele da lampada de defeito de 127v
#define relejump 9 // sainda para acionar o rele do sinal de jump para o PLC

// define saida para comando PLC de correia OK .....................................................................................................................................
#define releok 8 // (fica em 0) ,se estiver defeito ,saida vai para 1 para acionar o rele e indicar que a correia esta com defeito

// define saidas para acionar os reles referente aos jumps .........................................................................................................................
#define jump1 A8 // aciona o rele e coloca o jump
#define jump2 A9 // aciona o rele e coloca o jump
#define jump3 A10 // aciona o rele e coloca o jump
#define jump4 A11 // aciona o rele e coloca o jump

// define conexoes do teclado .....................................................................................................................................................
// define 14    de 14 a 17 define as linhas , ROWS
// define 15
// define 16
// define 17    todas essas entradas estao referenciadas para acionamento de menus, acionar jumps, entre outros, atraves do teclado 
// define 18    de 18 a 21 define as colunas , COLS
// define 19
// define 20
// define 21

// define conexoes do teclado ...............................................................................................................................................................

// nao precisa declarar pois ja tem a instrução para tal.
// definição de qual sera a SENHA ...........................................................................................................................................................
char senha[] = {'3', '2', '6', '8', '0', '1','\0'};
char palavra[] = {'0', '0', '0', '0', '0', '0','\0'};

// define quantas serao as linhas e colunas .................................................................................................................................................
const byte ROWS = 4; // 4 linhas
const byte COLS = 4;// 4 colunas

// definindo os caracteres que contem no nosso teclado ......................................................................................................................................
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

// definindo o menu .........................................................................................................................................................................
# define saindomenu 52
int var = 0;
int recebeRPM = 1800;
int recebeA = 200;
int recebeH = 6230;
float recebePh = 18.5;
#define sairdoloop 26

//========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= 

void setup()
{
char key = kpd.getKey();
// Definição dos pinos referente a entrada .........................................................................................................................................
pinMode(vcce,OUTPUT);
digitalWrite(vcce,1);
pinMode(entw,INPUT);
digitalWrite(entw,1);
pinMode(entz,INPUT);
digitalWrite(entz,1);
pinMode(enty,INPUT);
digitalWrite(enty,1);
pinMode(entx,INPUT);
digitalWrite(entx,1);
pinMode(gnde,OUTPUT);
digitalWrite(gnde,0);

// define cabos do lcd ............................................................................................................................................................. 
pinMode(rw,OUTPUT);
digitalWrite(rw,0);
pinMode(ledDisplay1,OUTPUT);
digitalWrite(ledDisplay1,1);
pinMode(ledDisplay2,OUTPUT);
digitalWrite(ledDisplay2,0);

// define cabos dos leds ...........................................................................................................................................................
pinMode(lok,OUTPUT);
digitalWrite(lok,0);
pinMode(ldefeito,OUTPUT);
digitalWrite(ldefeito,0);
pinMode(ljump,OUTPUT);
digitalWrite(ljump,0);

// define cabos lampada 127 e sinal de jump para o PLC .............................................................................................................................
pinMode(relelamp,OUTPUT);
digitalWrite(relelamp,0);
pinMode(relejump,OUTPUT);
digitalWrite(relejump,0);

// define saida para comando PLC de correia OK .....................................................................................................................................
pinMode(releok,OUTPUT);
digitalWrite(releok,0);

// define saidas para acionar os reles referente aos jumps .........................................................................................................................
pinMode(jump1,OUTPUT);
digitalWrite(jump1,0);
pinMode(jump2,OUTPUT);
digitalWrite(jump2,0);
pinMode(jump3,OUTPUT);
digitalWrite(jump3,0);
pinMode(jump4,OUTPUT);
digitalWrite(jump4,0);

// define menu
pinMode(saindomenu,OUTPUT);
digitalWrite(saindomenu,0);

// define sair do loop
pinMode(sairdoloop,OUTPUT);
digitalWrite(sairdoloop,0);
// ..........................................................................................................................................................................................


// ABERTURA DO EQUIPAMENTO 

lcd.begin(16, 2);  // Iniciando a biblioteca do LCD
Serial.begin(9600);
lcd.setCursor(0,0);
lcd.print("ESPESSADOR      ");
delay(3000);


}


void loop()
{

char key = kpd.getKey();
if(key=='#'){var++;lcd.clear();delay(10);  }
if(key=='*'){var--;lcd.clear();delay(10);  }

if (var==0)
{
  if(key=='A'&&var==0){recebeA++;}
if(key=='B'&&var==0){recebeA--;}
if(key=='C'&&var==0){recebeA=recebeA+25;}
if(key=='D'&&var==0){recebeA=recebeA-25;}
if(key=='0'&&var==0){lcd.clear();delay(10);recebeA=0;}

lcd.setCursor(0,0);
lcd.print("Valor Corrente  ");
lcd.setCursor(0,1);
lcd.print(recebeA);
}

if(var==1)
{
if(key=='A'&&var==1){recebeRPM++;}
if(key=='B'&&var==1){recebeRPM--;}
if(key=='C'&&var==1){recebeRPM=recebeRPM+25;}
if(key=='D'&&var==1){recebeRPM=recebeRPM-25;}
if(key=='0'&&var==1){lcd.clear();delay(10);recebeRPM=0;}
  
lcd.setCursor(0,0);
lcd.print("Valor RPM Motor ");
lcd.setCursor(0,1);
lcd.print(recebeRPM);
}

if(var==2)
{
lcd.setCursor(0,0);
lcd.print("Alt. Espessador ");
lcd.setCursor(0,1);
lcd.noAutoscroll();
lcd.print(recebeH);
}

if(var==3)
{
lcd.setCursor(0,0);
lcd.print("Dens. Espessador");
lcd.setCursor(0,1);
lcd.print(recebePh);
}

if(var==4&&digitalRead(26)==1)
{
var = 0;
}

if(var==4)
{
int H;
float constanteA=(recebeA/1023);
float constanteRPM;  
  constanteRPM=(recebeRPM)/1023;

  H = recebeH/1000;

Serial.println(constanteA, 8);  
Serial.print(recebeA);Serial.println(" Amperes");delay(1000);
Serial.println(constanteRPM, 8);
Serial.print(recebeRPM);Serial.println(" RPM");delay(1000);
Serial.print(H);Serial.println(" Metros");delay(1000);
Serial.print(recebePh);Serial.println(" Ph");delay(1000);
delay(2000);
}

}

