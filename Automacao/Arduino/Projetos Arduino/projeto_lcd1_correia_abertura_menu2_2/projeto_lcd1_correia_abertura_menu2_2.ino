#include <LiquidCrystal.h>



//Conexoes LCD
//VSS = GND
//VDD = Positivo
//Vo = Centro Potenciometro
//Rs = 12
//Rw = GND
//E = 11
//D4 = 5
//D5 = 4
//D6 = 3
//D7 = 2
//A = 5V      A e K alimentam luz do display LCD
//K = GND

LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

byte heart[8] = {0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111,0b11111};
#include <LiquidCrystal.h>


void setup()
{
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
delay(3000);
lcd.clear();

lcd.print("Acessando MENU  ");lcd.setCursor(0,1);
lcd.print("Aguarde ...     ");
delay(5000);
lcd.clear();

}

void loop()
{
int x;
int y;
int z;
int w;
int a;
int b;
int c;
int d;

// RECEBE ENTRADAS .............................................................................................................................................................................

// Variaveis para receber o sinal de entrada dos sinais de 127 convertidos em 5v
x = digitalRead(13);
y = digitalRead(8);
z = digitalRead(9);
w = digitalRead(10);

pinMode(13,INPUT);
digitalWrite(13,1);
pinMode(8,INPUT);
digitalWrite(8,1);
pinMode(9,INPUT);
digitalWrite(9,1);
pinMode(10,INPUT);
digitalWrite(10,1);
pinMode(6,OUTPUT);   // Sinal de correia Ok ou Defeito, passa num rele ,o contato NF liga led verde ok e NA liga lampada vermelha forte

// RECEBE JUMP ...............................................................................................................................................................................

// Variaveis para receber sinais de jump
a = digitalRead(A0);
b = digitalRead(A1);
c = digitalRead(A2);
d = digitalRead(A3);

pinMode(A0,INPUT);
digitalWrite(A0,1);
pinMode(A1,INPUT);
digitalWrite(A1,1);
pinMode(A2,INPUT);
digitalWrite(A2,1);
pinMode(A3,INPUT);
digitalWrite(A3,1);

// SINAL DO LED VERDE .....................................................................................................................................................................
pinMode(A4,OUTPUT);
digitalWrite(A4,1);


// JUMP ...................................................................................................................................................................................

// Pino 7 sera o sinal de jump ativo que ira para o PLC.

pinMode(7,OUTPUT);
digitalWrite(7,0);

// MENUS ..................................................................................................................................................................................

if (a==0) // DETECTA JUMP NA LINHA DE EMERGENCIA DE SOCO
{
  digitalWrite(7,1);
lcd.print("JUMPERs ATIVOS  ");
lcd.setCursor(0,1);
lcd.print("Jump na         ");
delay(1500);
lcd.setCursor(0,1);
lcd.print("emergencia de   ");
delay(1500);
lcd.setCursor(0,1);
lcd.print("soco            ");
delay(2000);
lcd.clear();delay(200);
}
if (b==0)  // DETECTA JUMP NA LINHA DE DESALINHAMENTO DA CORREIA
{
  digitalWrite(7,1);
lcd.print("JUMPERs ATIVOS  ");
lcd.setCursor(0,1);
lcd.print("Jump na         ");
delay(1500);
lcd.setCursor(0,1);
lcd.print("linha de        ");
delay(1500);
lcd.setCursor(0,1);
lcd.print("desalinhamento  ");
delay(2000);
lcd.clear();delay(200);
}
if (c==0)  // DETECTA JUMP NA LINHA DE EMERGENCIA DE CORDA PLC
{
  digitalWrite(7,1);
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
  digitalWrite(7,1);
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
if(a,b,c,b==0)

{
  digitalWrite(7,0);
}

// CORREIA ESTA OK, FAZ ISTO ...............................................................................................................................................................

if(x==1&&y==1&&z==1&&w==1)
{
digitalWrite(6,0);
digitalWrite(A4,1);
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

}

else
{

if (x==0&&a==0) // Se o jump a for atuado e der defeito no x, retira defeito e indica no lcd defeito ate normalizar
{  
digitalWrite(6,0);
digitalWrite(A4,1);
}
if (x==0&&a==1) // Se o jump a nao for atuado e der defeito no x, atua defeito e indica no lcd

{ // CORREIA ESTA COM ALGUM DEFEITO FAZ ISTO .................................................................................................................................................
digitalWrite(6,1);
digitalWrite(A4,0);
}
if (x==0)
{
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
if (y==0&&b==0) // Se o jump b for atuado e der defeito no y, retira defeito e indica no lcd defeito ate normalizar
{  
digitalWrite(6,0);
digitalWrite(A4,1);
}
if (y==0&&b==1) // Se o jump b nao for atuado e der defeito no y, atua defeito e indica no lcd
{ 
digitalWrite(6,1);
digitalWrite(A4,0);
}
if (y==0)
{
lcd.print("DEFEITOS CORREIA" );
lcd.setCursor(0,1);
lcd.print("Defeito de      ");
delay(1000);
lcd.setCursor(0,1);
lcd.print("desalinhamento  ");
delay(2000);
lcd.clear();delay(200);
}
if (z==0&&c==0) // Se o jump c for atuado e der defeito no z, retira defeito e indica no lcd defeito ate normalizar
{  
digitalWrite(6,0);
digitalWrite(A4,1);
}
if (z==0&&c==1) // Se o jump c nao for atuado e der defeito no z, atua defeito e indica no lcd
{ 
digitalWrite(6,1);
digitalWrite(A4,0);
}
if (z==0)
{
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
if (w==0&&d==0) // Se o jump d for atuado e der defeito no w, retira defeito e indica no lcd defeito ate normalizar
{  
digitalWrite(6,0);
digitalWrite(A4,1);
}
if (w==0&&d==1) // Se o jump d nao for atuado e der defeito no w, atua defeito e indica no lcd
{ 
digitalWrite(6,1);
digitalWrite(A4,0);
}
if (w==0)
{
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

if (x==0||y==0||z==0||w==0)
{
lcd.print("STATUS CORREIA " );
lcd.setCursor(0,1);
lcd.print("Com defeito     ");
delay(2000);
lcd.clear();
delay(200);

}  
}
}




  


//.............................................................................................................................................................................................



