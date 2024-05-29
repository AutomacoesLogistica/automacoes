// ...................................................PROJETO EQUIPAMENTO DE DETECÇÃO DE FALHAS DE CORREIAS TRANSPORTADORAS ...................................................................

// Conexoes LCD

//    1 =  VSS = GND = gnd
//    2 =  VDD = Positivo = 53
//    3 =  Vo = Centro Potenciometro
//    4 =  Rs = 12 = 49
//    5 =  Rw = GND = 47
//    6 =  E = 11 = 45
//    7 =
//    8 =
//    9 =
//   10 =
//   11 =  D4 = 5 = 43
//   12 =  D5 = 4 = 41
//   13 =  D6 = 3 = 39
//   14 =  D7 = 2 = 37
//   15 =  A = 5V  = 35     A e K alimentam luz do display LCD
//   16 =  K = GND = 33


#include <LiquidCrystal.h>  
LiquidCrystal lcd(49, 45, 43, 41, 39, 37);  // Declaração do objeto tipo lcd


// desenha o icone do carregando
byte heart[8] = {0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111};

// Definição dos pinos referente a entrada 
#define vcce 7 // vira 5v para alimentar as entradas referentes a correia ( x,y,z e w)
#define entw 6 // recebe o sina da linha de corda gaveta
#define entz 5 // recebe o sina da linha de corda plc
#define enty 4 // recebe o sina da linha de desalinhamento
#define entx 3 // recebe o sina da linha de emergencia de soco
#define gnde 2  // vira ground para as entradas referentes a correia  ( x,y,z e w)

// define cabos do lcd 
#define rw  47
#define ledDisplay1  35 // anodo do display
#define ledDisplay2  33 // catodo do display

// define cabos dos leds
#define lok 13 // alimenta led de ok
#define ldefeito 12 // alimenta led de defeito
#define ljump 11 // alimenta o led de jump ativo

// define cabos lampada 127 e sinal de jump para o PLC 
#define rele 10 // sainda para acionar o rele da lampada de defeito de 127v
#define rele 9 // sainda para acionar o rele do sinal de jump para o PLC

#define Led2   8
#define ljump 12
#define L1   14
#define L2   15
#define L3   16
#define L4   17
#define bMenu    A0  // Os pinos analógicos podem ser
#define bChange  A1  // usados como digitais, bastando
#define bUp      A2  // referenciá-los por A0, A1..
#define bDown    A3
#define lok A4
#define ldefeito A5

#define bMenu0   90  // Valor de referência que a 
#define bChange0 91  // função CheckButton() passa
#define bUp0     92  // indicando que um botão foi
#define bDown0   93  // solto
#define liga   53 = 1  // solto
boolean aMenu, aChange, aUp, aDown;  // Grava o ultimo valor lidos nos botões.
// Utilizado pela função Checkbutton p/ identificar quando há uma alteração no estado do pino dos botões
int p;
int variavel;
int variavel1;
int variavel2;
int variavel3;// variavel a ser alterada pelo menu
char state=1;  // variável que guarda posição atual do menu
LiquidCrystal lcd(49, 45, 43, 41, 39, 37);  // Declaração do objeto tipo lcd

//============================================== SETUP
void setup()
{
  
 pinMode(7,OUTPUT); // vcc para entradas de 5 v referente a sinais da correia
digitalWrite(7,1);
pinMode(2,OUTPUT); // gnd referente a sinais da correia
digitalWrite(2,0); 

  pinMode(rw,OUTPUT);
  digitalWrite(rw,LOW);// 
  pinMode(ledDisplay1 ,OUTPUT);
  pinMode(ledDisplay2 ,OUTPUT);  // Luz de fundo do display 
  pinMode(rele, OUTPUT);
  pinMode(lok, OUTPUT);
  pinMode(ldefeito, OUTPUT);
  pinMode(ljump, OUTPUT);
  pinMode(bMenu,  INPUT);   // Botões
  pinMode(bChange,INPUT);
  pinMode(bUp,    INPUT);
  pinMode(bDown,  INPUT);
  pinMode(L1,OUTPUT);
  pinMode(L2,OUTPUT);
  pinMode(L3,OUTPUT);
  pinMode(L4,OUTPUT);
  digitalWrite(bMenu,  HIGH);  // Aciona o pull-up interno
  digitalWrite(bChange,HIGH);  // dos botões
  digitalWrite(bUp,    HIGH);
  digitalWrite(bDown,  HIGH);
  
  digitalWrite(ledDisplay1 ,HIGH);
  digitalWrite(ledDisplay2 ,LOW);// Liga a luz do display.

pinMode(7,OUTPUT);
pinMode(7,OUTPUT);

delay(8000);
lcd.begin(16, 2);  // Iniciando a biblioteca do LCD

lcd.setCursor(0,0);
lcd.print("   Bem  Vindo!  ");delay(5000);lcd.clear();lcd.print("....INICIADO....");delay(3000);lcd.clear();delay(200);
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

digitalWrite(lok,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste do led ok ");
delay(4000);digitalWrite(lok,0);
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

digitalWrite(rele,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste da lampada");delay(1000);
lcd.setCursor(0,1);
lcd.print("de 127 v        ");
delay(3000);digitalWrite(rele,0);
lcd.clear();



}

//==============================================
//============================================== LOOP
void loop()
{
 
  switch (state) {  // Define checa qual tela atual
    
    case 1:          // executado quando na TELA 1
      switch (CheckButton()) {
        case bMenu:
       lcd.clear(); variavel++;
        break;
        case bChange:
          lcd.clear(); variavel--;
        break;
       case bUp:
          lcd.clear(); Set_state(5); // antes de mudar de tela, é necessário limpar o 
        break;                       // display com a função lcd.clear()
        case bDown:
          lcd.clear(); Set_state(2);
        break;
        default:   // Caso nenhum botão tenha sido apertado, ela executa a set_state
          Set_state(1); // mesmo assim para atualizar o display.
      }
    break;
    
    case 2:          // executado quando na TELA 2
      switch (CheckButton()) {
        case bMenu:
       lcd.clear(); variavel1++;
        break;
        case bChange:
          lcd.clear(); variavel1--;
        break;
       
        case bUp:
          lcd.clear(); Set_state(1);
        break;
        case bDown:
          lcd.clear(); Set_state(3);
        break;
        default: 
          Set_state(2);
      }
    break;
    
    case 3:          // executado quando na TELA 3
      switch (CheckButton()) {
       case bMenu:
       lcd.clear(); variavel2++;
        break;
        case bChange:
          lcd.clear(); variavel2--;
        break;
        case bUp:
          lcd.clear(); Set_state(2);
        break;
        case bDown:
          lcd.clear(); Set_state(4);
        break;
        default: 
          Set_state(3);
      }
    break;
    
    case 4:          // executado quando na TELA 4
      switch (CheckButton()) {
        case bMenu:
          lcd.clear(); variavel3++;
        break;
        case bChange:
          lcd.clear(); variavel3--;
        break;
        case bUp: 
          lcd.clear(); Set_state(3);
        break;
        case bDown:
          lcd.clear(); Set_state(5);
        break;
        default: 
          Set_state(4);
      }
    break;
    case 5:
    switch (CheckButton()) {
        case bMenu:
       digitalWrite(7,1);
        break;
        case bChange:
        p==0;
        break;
    
       case bUp:
          lcd.clear(); Set_state(4); // antes de mudar de tela, é necessário limpar o 
        break;                       // display com a função lcd.clear()
        case bDown:
          lcd.clear(); Set_state(1);
        break;
        default:   // Caso nenhum botão tenha sido apertado, ela executa a set_state
          Set_state(5); // mesmo assim para atualizar o display.
      }
    break;
    default: ;
  }
}
//============================================== FIM da função LOOP
//============================================== 

//============================================== CheckButton
char CheckButton() {
  if (aMenu!=digitalRead(bMenu)) {
    aMenu=!aMenu;
    if (aMenu) return bMenu0; else return bMenu;
  } else
  if (aChange!=digitalRead(bChange)) {
    aChange=!aChange;
    if (aChange) return bChange0; else return bChange;
  } else
  if (aUp!=digitalRead(bUp)) {
    aUp=!aUp;
    if (aUp) return bUp0; else return bUp;
  } else
  if (aDown!=digitalRead(bDown)) {
    aDown=!aDown;
    if (aDown) return bDown0; else return bDown;
  } else
    return 0;
}

//========================================================
//============================================== Set_state
void Set_state(char index) {
  state = index;  // Atualiza a variável state para a nova tela
  switch (state) {  // verifica qual a tela atual e exibe o conteúdo correspondente
           
    case 1: //==================== state 1
      lcd.setCursor(0,0);
      lcd.print("JUMPER 1:       ");
      lcd.setCursor(0,1);
      if ( variavel==1) {lcd.print("jump ativo      ");digitalWrite(L1,1);}
      else if (variavel==0 ){ lcd.print("jump inativo    ");digitalWrite(L1,0);}
    break;
    case 2: //==================== state 2
      lcd.setCursor(0,0);
      lcd.print("JUMPER 2:       ");
      lcd.setCursor(0,1);
      if ( variavel1==1) {lcd.print("jump ativo      ");digitalWrite(L2,1);}
      else if (variavel1==0 ){ lcd.print("jump inativo    ");digitalWrite(L2,0);}
    break;
    case 3: //==================== state 3
      lcd.setCursor(0,0);
      lcd.print("JUMPER 3:       ");
      lcd.setCursor(0,1);
      if ( variavel2==1) {lcd.print("jump ativo      ");}
      else if (variavel2==0 ){ lcd.print("jump inativo    ");}
    break;
    case 4: //==================== state 4
      lcd.setCursor(0,0);
      lcd.print("JUMPER 4:       ");
      lcd.setCursor(0,1);
      if ( variavel3==1) {lcd.print("jump ativo      ");}
      else if (variavel3==0 ){ lcd.print("jump inativo    ");}
   break;
   case 5:
 if (digitalRead(A1)==1)
  {
// LIGA LED VERDE ...........................................................................................................................................................................
  
  digitalWrite(A4,1); // aciona saida acendendo o led verde do painel indicando que esta tudo OK
  
// DESLIGA LED VERMELHO .......................................................................................................................................................................

   // desliga a saida apagando o led vermelho do painel

  digitalWrite(A4,1);
  digitalWrite(A5,0);
  lcd.print("STATUS CORREIA  " );
  lcd.setCursor(0,1);
  lcd.print("Correia OK      ");if (digitalRead(A1)!=1){lcd.print("Saindo Programa ");delay(2000);Set_state(1);}
  delay(3000);
  lcd.clear();
  delay(200);
  lcd.print("DEFEITOS CORREIA" );
  lcd.setCursor(0,1);
  lcd.print("Sem defeitos    ");if (digitalRead(A1)!=1){lcd.print("Saindo Programa ");delay(2000);Set_state(1);}
  delay(3000);
  lcd.clear();
  delay(200);
       
if (digitalRead(A1)!=1){lcd.print("Saindo Programa ");delay(2000);Set_state(1);}

  }

   
   
break;
default : ;
  }
}


