
#define encoderPinA  2
#define rEEPROM  3
#define encoderPinB  4

#include <Wire.h>
#include <EEPROM.h>
#include <LiquidCrystal_I2C.h>

// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x3F,2,1,0,4,5,6,7,3, POSITIVE);

volatile unsigned int encoderPos = 0;
long int valor;
long int pulsos,Upulsos;
long int pulsosMax;
int profundidadeMax;

float ValorMedido;
void setup() 
{ 
  pinMode(encoderPinA, INPUT); 
  digitalWrite(encoderPinA, HIGH);// Pull Up
  pinMode(rEEPROM, INPUT); 
  digitalWrite(rEEPROM, HIGH);// Pull Up
  pinMode(encoderPinB, INPUT); 
  digitalWrite(encoderPinB, HIGH);// Pull Up
  attachInterrupt(0, Encoder, CHANGE);
  Serial.begin (9600);
  lcd.begin(20,4);
  int hiByte1 = (EEPROM.read(0)* 255)+(EEPROM.read(0));
  int loByte1 = EEPROM.read(1); 
  valor = ((hiByte1)+(loByte1));
  encoderPos = valor;
  pulsos = valor;
  Upulsos = 0;
  pulsosMax = 500; // valor maximo de pulsos é 99999
  profundidadeMax = 800; // profundidade de metros em cm ( Menor Valor = 1 metro )
  
  // Abertura do programa

lcd.setCursor (0,0);
lcd.print("Iniciando           ");
delay(500);

for ( int x = 0;x<3;x++)
{
if ( digitalRead(rEEPROM)==0)
{
 EEPROM.write(0,0);
 EEPROM.write(1,0);
 pulsos = 0; 
}

lcd.setCursor (9,0);
lcd.print(".          ");
delay(250);
lcd.setCursor (10,0);
lcd.print(".         ");
delay(250);
lcd.setCursor(11,0);
lcd.print(".        ");
delay(250);
lcd.setCursor (9,0);
lcd.print("           ");
delay(500);
}


delay(200);
lcd.setCursor(0,0);
lcd.print("Profundidade Atual: ");
lcd.setCursor(0,1);
lcd.print("                    ");

} 

void loop()
{
   // Imprime valor real ( distancia D )
   ValorMedido = (pulsos*0.306306); // APROXIME O VALOR EM DISTANCIA REAL EM RELACAO A PULSOS APENAS MULTIPLICANDO POR OUTRO VALOR NO LUGAR DO 0.306306
// OBS  0.306306 POIS 1 VOLTA DA 80 PULSOS, COMPRIMENTO CIRCUNFERENCIA 2*3,14*R, RAIO É 3,9 LOGO: 24,5045CM COMPRIMENTO POR VOLTA, DIVIDIVO POR 80 PULSOS, CADA PULSO EQUIVALE A: 0.306306 CM.
  
if ( pulsos != Upulsos )
{
  Upulsos = pulsos;
  
if ( ValorMedido>=0 && ValorMedido<10 ) // De 0 a 9 cm
{
lcd.setCursor(0,1);
lcd.print("                    ");
lcd.setCursor(0,1);
lcd.print(ValorMedido,2);
lcd.setCursor (4,1);
lcd.print("cm   ");
}
if ( ValorMedido>9 && ValorMedido<100) // De 10 a 99 cm
{
lcd.setCursor(0,1);
lcd.print("                    ");
lcd.setCursor(0,1);
lcd.print(ValorMedido,2);
lcd.setCursor (5,1);
lcd.print("cm  ");
}

if (ValorMedido>99 && ValorMedido<1000)//De 1 m a 9,99 m
{
lcd.setCursor(0,1);
lcd.print("                    ");
lcd.setCursor(0,1);
lcd.print((ValorMedido/100),2);
lcd.setCursor (4,1);
lcd.print("m   ");
}
if (ValorMedido>999)//De 10 m a ProfundidadeMax
{
lcd.setCursor(0,1);
lcd.print("                    ");
lcd.setCursor(0,1);
lcd.print((ValorMedido/100),2);
lcd.setCursor (5,1);
lcd.print("m   ");
}

Serial.println(pulsos);
// Armazena na serial
byte hiByte = highByte(pulsos);
byte loByte = lowByte(pulsos);
EEPROM.write(0,hiByte);
EEPROM.write(1,loByte);

} //Fecha Upulsos

}// fecha loop

void Encoder() 
{
  if (digitalRead(encoderPinA) == digitalRead(encoderPinB)) 
  {
   encoderPos++;
  } 
  else 
  {
   if(encoderPos==0){encoderPos = 0;}
   else{encoderPos--;}
   
  }
  
  pulsos = encoderPos;
  
   if ( pulsos<=0){ pulsos = 0; }
   // ----------------------------------------


}



