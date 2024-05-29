
#include <LiquidCrystal.h>

// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(49, 45, 43, 41, 39, 37); 
// define cabos do lcd ............................................................................................................................................................. 
#define rw  47 // coloca a saida para terra, simula um gnd
#define ledDisplay1  35 // anodo do display
#define ledDisplay2  33 // catodo do display
int seg;
int minuto;
int hora;

int tempo;
int solenoide;


void setup() {
pinMode(rw,OUTPUT);
digitalWrite(rw,0);
pinMode(ledDisplay1,OUTPUT);
digitalWrite(ledDisplay1,1);
pinMode(ledDisplay2,OUTPUT);
digitalWrite(ledDisplay2,0);
lcd.begin(16, 2);
  lcd.setCursor(0,0);
  lcd.print("MIGUEL BURNIER 2");delay(5000);
  pinMode(2,INPUT);
  pinMode(3,INPUT);
  pinMode(13,OUTPUT);
  seg = 0;
  minuto = 0;
  hora = 0;
tempo = 0;
solenoide = 1;


lcd.clear();delay(250);
} 




void loop()
{
digitalWrite(13,0);
delay(1000);
tempo++;
lcd.print ("Solenoide =     ");
lcd.setCursor(12,0);
lcd.print(solenoide);
lcd.setCursor(0,1);
lcd.print ("Tempo =         ");        
lcd.setCursor(9,1);
lcd.print (tempo);        


if (tempo==25)
{
lcd.clear();delay(10);
lcd.print("Disparado        ");
solenoide++;tempo = 0;
digitalWrite(13,1);delay(1500);digitalWrite(13,0);
lcd.clear();delay(10);
}
if ( solenoide==11)
{solenoide = 1;}

}



/*{

// RELOGIO ========================================================================================================================================================================

//if (digitalRead(2)!=0){seg++;}
//if (digitalRead(3)!=0){minuto++;}

 seg++;
 if(seg==60)
 { seg = 0;minuto++; }
 
 if(minuto==60)
 { hora++; }
 
 if(hora==24)
 {
  hora = 0;
} 
  
  if(minuto==60)
 { minuto = 0; }
 lcd.setCursor(6,1);
 lcd.print(":");
 lcd.setCursor(9,1);
 lcd.print(":");
    
  if(seg<10)
  {
    lcd.setCursor(10,1);
    lcd.print("0");
    lcd.setCursor(11,1);
    lcd.print(seg);
  }
   if(seg>=10)
  {
    lcd.setCursor(10,1);
    lcd.print(seg);
  }
  //______________________________________
  
  if(minuto<10)
  {
    lcd.setCursor(7,1);
    lcd.print("0");
    lcd.setCursor(8,1);
    lcd.print(minuto);
  }
   if(minuto>=10)
  {
    lcd.setCursor(7,1);
    lcd.print(minuto);
  }

  //______________________________________
  
  if(hora<10)
  {
    lcd.setCursor(4,1);
    lcd.print("0");
    lcd.setCursor(5,1);
    lcd.print(hora);
  }
   if(hora>=10)
  {
    lcd.setCursor(4,1);
    lcd.print(hora);
  }

  
delay(1000);

//============================================================================================================================================================================================


}

 
*/


