
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
LiquidCrystal lcd(49, 45, 43, 41, 39, 37);



// DESENHO DO QUADRADO PARA O CARREGANDO .....................................................................................................................................................

byte heart[8] = {0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111};


void setup()
{
pinMode(53,OUTPUT);
digitalWrite(53,1);
pinMode(47,OUTPUT);
digitalWrite(47,0);
pinMode(35,OUTPUT);
digitalWrite(35,1);
pinMode(33,OUTPUT);
digitalWrite(33,0);

pinMode(7,OUTPUT); // vcc para entradas de 5 v referente a sinais da correia
digitalWrite(7,1);
pinMode(2,OUTPUT); // gnd referente a sinais da correia
digitalWrite(2,0);

  // RECEBE ENTRADAS DOS 4 SINAIS DA CORREIA ....................................................................................................................................................

// Variaveis para receber o sinal de entrada dos sinais de 127 convertidos em 5v

int w = digitalRead(6);  // recebe o sinal de defeito de emergencia de soco
int z = digitalRead(5);  // recebe o sinal de defeito de desalinhamento
int y = digitalRead(4);  // recebe o sinal de defeito de emergencia de corda que vai na gaveta do PLC
int x = digitalRead(3);  // recebe o sinal de defeito de emergencia de corda que vai na gaveta do ccm

pinMode(6,INPUT);
digitalWrite(6,0);
pinMode(5,INPUT);
digitalWrite(5,0);
pinMode(4,INPUT);
digitalWrite(4,0);
pinMode(3,INPUT);
digitalWrite(3,0);

// RECEBE JUMP ...............................................................................................................................................................................

// Variaveis para receber sinais de jump

int a = digitalRead(A0);  // recebe o sinal de jump para emergencia de soco atuada
int b = digitalRead(A1);  // recebe o sinal de jump para defeito de desalinhamento
int c = digitalRead(A2);  // recebe o sinal de jump para defeito de emergencia de corda PLC
int d = digitalRead(A3);  // recebe o sinal de jump para defeito de emergencia de corda GAVETA

pinMode(A0,INPUT);
digitalWrite(A0,1);
pinMode(A1,INPUT);
digitalWrite(A1,1);
pinMode(A2,INPUT);
digitalWrite(A2,1);
pinMode(A3,INPUT);
digitalWrite(A3,1);

// SINAL PARA O LED VERDE ...................................................................................................................................................................................

pinMode(11,OUTPUT); // Led verde do equipamento
digitalWrite(11,0); // força led começar desligado

pinMode(9,OUTPUT); // Led verde do equipamento
digitalWrite(9,0); // força led começar desligado
// SINAL PARA O LED VERMELHO .................................................................................................................................................................

pinMode(10,OUTPUT);   // Sinal de defeito, passa num rele e NA liga lampada vermelha forte
digitalWrite(10,0); // força led começar desligado

// JUMP ...................................................................................................................................................................................

pinMode(8,OUTPUT);  // Pino 7 sera o sinal de jump ativo que ira para o PLC.
digitalWrite(8,0); // força led começar desligado


// INICIALIZAÇÃO  ...........................................................................................................................................................................................  

lcd.begin(16, 2);
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

digitalWrite(11,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste do led ok ");
delay(4000);digitalWrite(11,0);
lcd.clear();

digitalWrite(10,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste do led de ");delay(1000);
lcd.setCursor(0,1);
lcd.print("defeito         ");
delay(3000);digitalWrite(10,0);
lcd.clear();

digitalWrite(8,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste do led de ");delay(1000);
lcd.setCursor(0,1);
lcd.print("jump ativo      ");
delay(3000);digitalWrite(8,0);
lcd.clear();

digitalWrite(9,1);
lcd.print("TESTANDO LEDS   ");lcd.setCursor(0,1);
lcd.print("teste da lampada");delay(1000);
lcd.setCursor(0,1);
lcd.print("de 127 v        ");
delay(3000);digitalWrite(9,0);
lcd.clear();


}

void loop ()

{

// VARIAVEIS ...............................................................................................................................................................................

  int a = digitalRead(A0);  // recebe o sinal de jump para emergencia de soco atuada
  int b = digitalRead(A1);  // recebe o sinal de jump para defeito de desalinhamento
  int c = digitalRead(A2);  // recebe o sinal de jump para defeito de emergencia de corda PLC
  int d = digitalRead(A3);  // recebe o sinal de jump para defeito de emergencia de corda GAVETA
  int w = digitalRead(6);  // recebe o sinal de defeito de emergencia de soco
  int z = digitalRead(5);  // recebe o sinal de defeito de desalinhamento
  int y = digitalRead(4);  // recebe o sinal de defeito de emergencia de corda que vai na gaveta do PLC
  int x = digitalRead(3);  // recebe o sinal de defeito de emergencia de corda que vai na gaveta do ccm

pinMode(9,OUTPUT); // Led verde do equipamento
 
if (a==0) // DETECTA JUMP NA LINHA DE EMERGENCIA DE SOCO
  {
  digitalWrite(8,1); // acende led amarelo do painel indicando jump ativo
  
  lcd.print("JUMPERs ATIVOS  ");
  lcd.setCursor(0,1);
  lcd.print("Jump na         ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("emergencia de   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("soco            ");
  delay(2000);
  lcd.clear();delay(200);
  }

if (b==0)  // DETECTA JUMP NA LINHA DE DESALINHAMENTO DA CORREIA
  {
  digitalWrite(8,1); // acende led amarelo do painel indicando jump ativo
    
  
  lcd.print("JUMPERs ATIVOS  ");
  lcd.setCursor(0,1);
  lcd.print("Jump na         ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("linha de        ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("desalinhamento  ");
  delay(2000);
  lcd.clear();delay(200);
  }

if (c==0)  // DETECTA JUMP NA LINHA DE EMERGENCIA DE CORDA PLC
  {
  digitalWrite(8,1); // acende led amarelo do painel indicando jump ativo
 
  lcd.print("JUMPERs ATIVOS  ");
  lcd.setCursor(0,1);
  lcd.print("Jump na linha de");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("emergencia de   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("corda PLC       ");
  delay(2000);
  lcd.clear();delay(200);
  }

if (d==0)  // DETECTA JUMP NA LINHA DE EMERGENCIA DE CORDA GAVETA
  {
  digitalWrite(8,1); // acende led amarelo do painel indicando jump ativo
 
  lcd.print("JUMPER ATIVOS  " );
  lcd.setCursor(0,1);
  lcd.print("Jump na linha de");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("emergencia de   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("corda GAVETA    ");
  delay(2000);
  lcd.clear();delay(200);
  delay(1000);  
  }

// LOGICA PARA OS JUMPS .....................................................................................................................................................................

   // se todos os jumps nao forem ativos ,ou seja, nivel diferente de 0, desliga o led amarelo de sinalização de jump ativo

 if(a!=0&&b!=0&&c!=0&&d!=0)

  {
  digitalWrite(8,0); // desliga led amarelo do painel indicando que nao possui jump ativo
  }
  
// LOGICA PARA CONDIÇÃO DA CORREIA ..........................................................................................................................................................

  if((x==1&&a==0)||(x==0)&&(y==1&&b==0)||(y==0)&&(z==1&&c==0)||(z==0)&&(w==1&&d==0)||(w==0)) // se todos os sinais forem verdadeiros, ou seja, nivel 0, sinaliza STATUS OK E SEM DEFEITO
  {

 digitalWrite(11,1); // aciona saida acendendo o led verde do painel indicando que esta tudo OK }
}
  if (x==0&&y==0&&z==0&&w==0)
  {
// LIGA LED VERDE ...........................................................................................................................................................................
  
  digitalWrite(11,1); // aciona saida acendendo o led verde do painel indicando que esta tudo OK
  
// DESLIGA LED VERMELHO .......................................................................................................................................................................

   // desliga a saida apagando o led vermelho do painel
  digitalWrite(11,1);
  digitalWrite(10,0);
  lcd.print("STATUS CORREIA  " );
  lcd.setCursor(0,1);
  lcd.print("Correia OK      ");
  delay(3000);
  lcd.clear();
  delay(200);
  lcd.print("DEFEITOS CORREIA" );
  lcd.setCursor(0,1);
  lcd.print("Sem defeitos    ");
  delay(3000);
  lcd.clear();
  delay(200);

  
  if ( a!=0&&b!=0&&c!=0&&d!=0)
  {
  lcd.print("JUMPERs ATIVOS  ");
  lcd.setCursor(0,1);
  lcd.print("Sem jump ativo  ");
  delay(3000);
  lcd.clear();
  delay(200);
  }
  } // finaliza o if

// ........................................................................................................................................................................................... 

  else  // se nao for verdadeiro a condição de OK da correia, faz essas logicas abaixo, sendo verdadeiras
  
  { // inicia o else 

    
// DETECTA DEFEITO DE EMERGENCIA DE SOCO ASSOCIADO AO JUMP .....................................................................................................................................    

  
  if (x==1&&a!=0) // Se o jump b nao for atuado e der defeito no y, atua defeito e indica no lcd
  { 
  digitalWrite(9,1);
  }
  
// DETECTA DEFEITO DE EMERGENCIA DE SOCO .......................................................................................................................................................
  
  if (x==1&&a==0&&y==0&&z==0&&w==0)
  {
  digitalWrite(11,1);
  }
  else {digitalWrite(11,0);}
  
  if (x==1) // se der defeito , ou seja, nivel logico 1, atua a logica
  {
  digitalWrite(10,1);  
  lcd.print("DEFEITOS CORREIA" );
  lcd.setCursor(0,1);
  lcd.print("Emergencia de   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("soco atuada     ");
  delay(2000);
  lcd.clear();
  delay(200);
  }

// DETECA DEFEITO DESALINHAMENTO ASSOCIADO AO JUMP .............................................................................................................................................

  
  if (y==1&&b!=0) // Se o jump b nao for atuado e der defeito no y, atua defeito e indica no lcd
  { 
  digitalWrite(9,1);
  }
  
// DETECTA DEFEITO DE DESALINHAMENTO ..........................................................................................................................................................  
  
  if (y==1&&b==0&&x==0&&z==0&&w==0)
  {
  digitalWrite(11,1);
  }
  else {digitalWrite(11,0);}
  
  if (y==1) // se der defeito no desalinhamento , ou seja, nivel logico 1, atua a logica
  {
  digitalWrite(10,1);  
  lcd.print("DEFEITOS CORREIA" );
  lcd.setCursor(0,1);
  lcd.print("Defeito de      ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("desalinhamento  ");
  delay(2000);
  lcd.clear();delay(200);
  }

// DETECTA DEFEITO NA EMERGENCIA DE CORDA PLC ASSOCIADO AO JUMP ..............................................................................................................................

  
  if (z==1&&c!=0) // Se o jump c nao for atuado e der defeito no z, atua defeito e indica no lcd
  { 
  digitalWrite(9,1);
  }

// DETECTA DEFEITO NA EMERGENCIA DE CORDA PLC..................................................................................................................................................

  if (z==1&&c==0&&x==0&&y==0&&w==0)
  {
  digitalWrite(11,1); // desliga o verde
  }
  else {digitalWrite(11,0);}
  
  if (z==1) // se der defeito na emergencia de corda plc, atua a logica
  {
  digitalWrite(10,1);  
  lcd.print("DEFEITOS CORREIA" );
  lcd.setCursor(0,1);
  lcd.print("Defeito de      ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("emergencia de   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("corda PLC       ");
  delay(2000);
  lcd.clear();delay(200);
  }

// DETECTA DEFEITO NA EMERGENCIA CORDA GAVETA ASSOCIADO AO JUMP ...............................................................................................................................

  
  if (w==1&&d!=0) // Se o jump d nao for atuado e der defeito no w, atua defeito, para a correia e indica no lcd
  { 
  digitalWrite(9,1);
  }

// DETECTA DEFEITO NA EMERGENCIA CORDA GAVETA .................................................................................................................................................

  if (w==1&&d==0&&x==0&&y==0&&z==0)
  {
  digitalWrite(11,1);
  }
  else {digitalWrite(11,0);}
  
  if (w==1) // se der defeito na emergencia de corda da gaveta faz isso
  {
  digitalWrite(10,1);  
  lcd.print("DEFEITOS CORREIA" );
  lcd.setCursor(0,1);
  lcd.print("Defeito de      ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("emergencia de   ");
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print("corda GAVETA    ");
  delay(2000);
  lcd.clear();delay(200);
  }

// DETECTA ALGUM DEFEITO E ATUA  ..............................................................................................................................................................

  if ((x==1&&a!=0)||(y==1&&b!=0)||(z==1&&c!=0)||(w==1&&d!=0)) // se alguma das entradas derem problema, ou seja, ir para nivel 1, atua a logica
  {

// LIGA LED VERMELHO .......................................................................................................................................................................

   // liga a saida acendendo o led vermelho
  
// DESLIGA LED VERDE ...........................................................................................................................................................................
  
  digitalWrite(11,0); // desliga saida apagando o led verde do painel indicando que tem algum problema
  
  lcd.print("STATUS CORREIA " );
  lcd.setCursor(0,1);
  lcd.print("Com defeito     ");
  delay(2000);
  lcd.clear();
  delay(200);
  }  
  
//.............................................................................................................................................................................................
  
} // fecha o else

}// fecha o loop




  


//.............................................................................................................................................................................................



