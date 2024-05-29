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
int contador = 0; // contador para senha
int contador1 = 0;
int contador2 = 20; // contador para troca dos menus
int sairmenu = 0; // ativa para sair do menu
int somatorio = 0;
# define saindomenu 52

#define sairdoloop 26

//========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= SETUP ========= 

void setup()
{
char key = kpd.getKey();
if(key=='#'){contador2++;}
if(key=='*'){contador2--;}
if(key=='D'){contador2 = 5;}

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
contador2 = 2;
}
// ====== LOOP ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ====== LOOP  ======   
void loop()
{  
char key = kpd.getKey();
if(key=='#'&&contador2!=21){contador2++;}
if(key=='*'&&contador2!=21){contador2--;}
if(key=='D'&&contador2!=21){contador2 = 5;}

lcd.createChar(1, heart1);
lcd.createChar(2, heart2);
lcd.createChar(3, heart3);

//...........................................................................................................................................................................................
if (contador2==5||contador2==6||contador2==7||contador2==8||contador2==9||contador2==10||contador2==11||contador2==12||contador2==13||contador2==14)
{


// LOGICA PARA DESLIGAR O RELE DE JUMPS CASO NAO TENHA NENHUM JUMP ATIVO ...................................................................................................................  
 if (digitalRead(jump1)==0&&digitalRead(jump2)==0&&digitalRead(jump3)==0&&digitalRead(jump4)==0)
  {
  digitalWrite(relejump,0);
  }
else
{
  digitalWrite(relejump,1);
  }
  
if (digitalRead(jump1)==1||digitalRead(jump2)==1||digitalRead(jump3)==1||digitalRead(jump4)==1)
  {
  digitalWrite(ljump,1);
  }
else { digitalWrite(ljump,0);
}

//...........................................................................................................................................................................................
 // DETECTA ALGUM DEFEITO E ATUA  ..............................................................................................................................................................
  if((digitalRead(entx)!=1)&&(digitalRead(enty)!=1)&&(digitalRead(entz)!=1)&&(digitalRead(entw)!=1)) // se faltar 127 na entrada acende o led de defeito
  {
  digitalWrite(ldefeito,0); // acende o led de defeito
  }
  if((digitalRead(entx)!=0)||(digitalRead(enty)!=0)||(digitalRead(entz)!=0)||(digitalRead(entw)!=0)) // se faltar 127 na entrada acende o led de defeito
  {
  digitalWrite(ldefeito,1); // acende o led de defeito
  }
//............................................................................................................................................................................................
// LOGICA PARA CONDIÇÃO DA CORREIA ..........................................................................................................................................................

  if(((digitalRead(entx)==0)||(digitalRead(entx)==1&&digitalRead(jump1)==1))&&((digitalRead(enty)==0)||(digitalRead(enty)==1&&digitalRead(jump2)==1))&&((digitalRead(entz)==0)||(digitalRead(entz)==1&&digitalRead(jump3)==1))&&((digitalRead(entw)==0)||(digitalRead(entw)==1&&digitalRead(jump4)==1))) // STATUS OK e/ou OK com JUMP ATIVO
  {
  digitalWrite(lok,1); // aciona saida acendendo o led verde do painel indicando que esta tudo OK
  digitalWrite(releok,0); // Desaciona rele enviando sinal de ok e a correia aceita partir, pois esta ligado a um contado NF
  digitalWrite(relelamp,0); // Desaciona a saida rele , e apaga a lampada de 127 vermelha indicando que não possui defeito.
  }
  else
  {
  digitalWrite(lok,0); // Desaciona saida apagando o led verde do painel indicando que não esta OK
  digitalWrite(releok,1); // Aciona o rele retirando o envio de sinal de ok e a correia para, pois esta ligado a um contado NF
  digitalWrite(relelamp,1); // Aciona a saida rele , e acende a lampada de 127 vermelha indicando algum defeito.
  
  }








}







if(contador2==5 && key=='A') // ativa jump 1
{contador = 14;}


if(contador2==6 && key=='1') // ativa jump 1
{digitalWrite(jump1,1);digitalWrite(ljump,1);}
if(contador2==6 && key=='2')
{digitalWrite(jump1,0);}

if(contador2==7 && key=='1') // ativa jump 2
{digitalWrite(jump2,1);digitalWrite(ljump,1);}
if(contador2==7 && key=='2')
{digitalWrite(jump2,0);}

if(contador2==8 && key=='1') // ativa jump 3
{digitalWrite(jump3,1);digitalWrite(ljump,1);}
if(contador2==8 && key=='2')
{digitalWrite(jump3,0);}

if(contador2==9 && key=='1') // ativa jump 4
{digitalWrite(jump4,1);digitalWrite(ljump,1);} 
if(contador2==9 && key=='2')
{digitalWrite(jump4,0);}

if(contador2==14 && key=='D') // ativa sair do menu
{digitalWrite(sairmenu,1);}
if(contador2==9 && key!='D')  // desativa sair menu
{digitalWrite(sairmenu,0);}

if (key=='D'){lcd.clear();delay(10);}




if(contador2==5&&key=='*'){lcd.clear();delay(200);}


if(sairmenu==4){contador2 = 1;}
if(contador2==2)
{
lcd.setCursor(0, 0);
lcd.print("INICIANDO...    ");
    if (key=='A')
    {
    lcd.setCursor(0, 1);lcd.print("Pulando abertura");delay(3000);
    lcd.clear();delay(100);lcd.print("Aperte          ");lcd.setCursor(0, 1);lcd.print("1 Menu 2 Projeto");
    contador2 = 20;
  }
    if (key!='A')
    {
    sairmenu++;
      lcd.setCursor(0, 1);lcd.print("                ");delay(1000);
    
  }
}





// contador2==21 > esta no final

if(contador2==3)
{
contador2 = 4;
}
if(contador2==4)
{
lcd.setCursor(0, 0);
lcd.print("RESET ?         ");
lcd.setCursor(0, 1);
lcd.print("                ");

    if (key=='1')
    {
    lcd.setCursor(0, 1);lcd.print("reset ativado   ");delay(2000);
   digitalWrite(lok ,0); 
   digitalWrite(ldefeito,0);
   digitalWrite(ljump,0);
   digitalWrite(relejump,0);
   digitalWrite(relelamp,0);
   digitalWrite(releok,0);
   digitalWrite(jump1,0);
   digitalWrite(jump2,0);
   digitalWrite(jump3,0);
   digitalWrite(jump4,0);
   
    contador2 = 2;lcd.clear();delay(250);
   }

}


delay(10);
if(contador2==5&&digitalRead(26)==1){ 
contador2 = 13;
}
if(contador2==5&&digitalRead(26)!=1)
{
sairmenu = 0;
lcd.setCursor(0, 0);
lcd.print("MENU            ");
lcd.setCursor(0, 1);
lcd.setCursor(15,1); // imprime a seta para
lcd.write(1);        // a direita
lcd.setCursor(14,1); 
lcd.write(3);        

lcd.setCursor(0,1);  // imprime a seta para
lcd.write(2);
lcd.setCursor(1,1);  // a esquerda
lcd.write(3);
lcd.setCursor(4,1);
lcd.print("*");
lcd.setCursor(11,1);
lcd.print("#");

}

if(contador2==6)
{
lcd.setCursor(0, 0);
lcd.print("JUMP1           ");
    if (digitalRead(jump1)==1)
    {
    lcd.setCursor(0, 1);lcd.print("ativado         ");
    
    }
    else 
    {
    lcd.setCursor(0, 1);lcd.print("desativado       ");
    }
}

if(contador2==7)
{
lcd.setCursor(0, 0);
lcd.print("JUMP2           ");
    if (digitalRead(jump2)==1)
    {
    lcd.setCursor(0, 1);lcd.print("ativado         ");
    }
    else 
    {
    lcd.setCursor(0, 1);lcd.print("desativado       ");
    }
}

if(contador2==8)
{
lcd.setCursor(0, 0);
lcd.print("JUMP3           ");
    if (digitalRead(jump3)==1)
    {
    lcd.setCursor(0, 1);lcd.print("ativado         ");
    }
    else 
    {
    lcd.setCursor(0, 1);lcd.print("desativado       ");
    }

}

if(contador2==9)
{
lcd.setCursor(0, 0);
lcd.print("JUMP4           ");
    if (digitalRead(jump4)==1)
    {
    lcd.setCursor(0, 1);lcd.print("ativado         ");
    }
    else 
    {
    lcd.setCursor(0, 1);lcd.print("desativado       ");
    }
}

if(contador2==10)
{
lcd.setCursor(0, 0);
lcd.print("SAIDA OK DO PLC ");
    if (digitalRead(releok)==1)
    {
    lcd.setCursor(0, 1);lcd.print("saida ativada   ");
    }
    else 
    {
    lcd.setCursor(0, 1);lcd.print("saida desativada");
    }
}

if(contador2==11)
{
lcd.setCursor(0, 0);
lcd.print("SAIDA JUMP PLC  ");
    if (digitalRead(relejump)==1)
    {
    lcd.setCursor(0, 1);lcd.print("saida ativada   ");
    }
    else 
    {
    lcd.setCursor(0, 1);lcd.print("saida desativada");
    }
}

if(contador2==12)
{
lcd.setCursor(0, 0);
lcd.print("SAIDA LAMPADA   ");
    if (digitalRead(relelamp)==1)
    {
    lcd.setCursor(0, 1);lcd.print("saida ativada   ");
    }
    else 
    {
    lcd.setCursor(0, 1);lcd.print("saida desativada");
    }
}
if(contador2==13)
{
lcd.clear();delay(100);
lcd.setCursor(0, 0);
lcd.print("ENTRANDO...     ");
delay(3000);
lcd.clear();
contador2++;
delay(250);
}

delay(10);


// COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA
// COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA
// COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA // COMEÇA O PROGRAMA DA CORREIA

if(contador2==14&&digitalRead(26)==1)
{
  lcd.clear();lcd.print("Voltando ao menu");lcd.setCursor(0, 1);lcd.print("Aguarde...      ");contador = 0;contador2 = 21;delay(3000);lcd.print("Digite a senha!  ");lcd.setCursor(0, 1);lcd.print("                ");
}
if(contador2==14&&digitalRead(26)==0)

// finaliza defeitos .........................................................................................................................................................................




// SENHA ....................................................................................................................................................................................

if(contador2==20 && key=='1')
{contador2 = 23;lcd.clear();delay(500);}

if(contador2==20 && key=='2')
{contador2 = 22;lcd.clear();delay(10);}

if (contador2==20)
{

lcd.println("Aperte          ");
lcd.setCursor(0, 1);
lcd.print("1 Menu 2 Projeto");

if(contador2==20 && key=='1')
{contador2 = 23;lcd.clear();delay(500);}

if(contador2==20 && key=='2')
{contador2 = 22;lcd.clear();delay(10);}


}

if (contador2==22) {contador2 = 13;}   

if (contador2==23 && somatorio==3)
  {
   contador2 = 21;somatorio = 0;
  }  
  
  if (contador2==23)
  {
  contador = 0;lcd.setCursor(0, 0);lcd.print("Digite a senha! ");lcd.setCursor(0, 1);lcd.print("C = Apaga senha ");delay(1000);lcd.clear();
  somatorio++;}


if (contador2==21) 
{
 lcd.setCursor(0, 0);
   lcd.print("Digite a senha! ");
   
  
  if(key)
  {
   lcd.setCursor(0, 0);
   lcd.print("Digite a senha! ");
   lcd.setCursor(contador, 1);
   lcd.print(key);
   delay(10);
   palavra[contador] = key;
   contador++;
   if (key=='C'){contador = 0;lcd.clear();lcd.setCursor(0, 0);lcd.print("Digite a senha! ");}
   
   delay(100);
   }
   if (contador==6)
   {
   
     
   palavra[contador] = '\0';
   if ((palavra[0] == senha[0]) &&(palavra[1] == senha[1]) &&(palavra[2] == senha[2]) &&(palavra[3] == senha[3]) &&(palavra[4] == senha[4]) &&(palavra[5] == senha[5]))
   {
    lcd.clear(); 
    lcd.print("Acessando Menu! ");
    delay(3000);
    contador2 = 5;
    lcd.clear();
   }
  else
   {
    if(contador2==21&&somatorio!=3){ 
    lcd.clear();
    lcd.print("Senha Incorreta!");
    delay(2000);
    contador = 0;
    contador2 = 21;
    somatorio++;
    lcd.clear();
   lcd.setCursor(0, 0);
   lcd.print("Digite a senha! ");
   lcd.setCursor(0, 1);
   lcd.print("                ");
    }
   if(contador2==21&&somatorio==3){ 
   contador2 = 13;
   somatorio = 0;
   lcd.clear();delay(2000);
   }
  }
 } 
}






if(contador2==1)
{
lcd.clear();
delay(100);

lcd.clear();
lcd.print("   BEM VINDO!   ");
delay(3000);
lcd.clear();


delay(200);
lcd.print("Carregando...  ");delay(200);
lcd.createChar(1, heart); // envia nosso character p/ o display



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
delay(5000);
lcd.clear();


lcd.print("Acessando MENU  ");lcd.setCursor(0,1);
lcd.print("Aguarde ...     ");
delay(2500);
lcd.clear();


// INICIA TESTE DAS SAIDAS ..................................................................................................................................................................




digitalWrite(lok,1);
digitalWrite(releok,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste do led ok ");
delay(4000);digitalWrite(lok,0);digitalWrite(releok,0);
lcd.clear();


digitalWrite(ldefeito,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste do led de ");delay(1000);
lcd.setCursor(0,1);
lcd.print("defeito         ");
delay(3000);digitalWrite(ldefeito,0);
lcd.clear();


digitalWrite(ljump,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste do led de ");delay(1000);
lcd.setCursor(0,1);
lcd.print("jump ativo      ");
delay(3000);digitalWrite(ljump,0);
lcd.clear();


digitalWrite(relelamp,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste da lampada");delay(1000);
lcd.setCursor(0,1);
lcd.print("de 127 v        ");
delay(3000);digitalWrite(relelamp,0);

lcd.clear();lcd.print("Aperte          ");lcd.setCursor(0, 1);lcd.print("1 Menu 2 Projeto");contador2 = 20;delay(100);sairmenu = 0;
delay(1000);
}
}


















