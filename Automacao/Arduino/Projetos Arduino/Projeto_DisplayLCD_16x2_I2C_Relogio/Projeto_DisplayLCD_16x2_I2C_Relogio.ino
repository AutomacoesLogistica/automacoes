#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);
int hora = 23;
int minuto = 23;
int segundo = 0;
String valor_hora;
String valor_minuto;
String valor_segundo;
boolean pulso = 0;


void setup() 
{ 
 lcd.begin(16,2);
 lcd.setCursor(0,0);
 lcd.print ("bem vindo!      ");
 delay(2000);
 lcd.setCursor(0,0);
 lcd.print ("Relogio:        ");
 
}
  

void loop()
{
 if (segundo >=60)
 {
  segundo = 0;
  minuto = minuto + 1;
 }
 
 if ( minuto >=60)
 {
  minuto = 0;
  hora = hora + 1;
 }

 if (hora >=24)
 {
  hora = 0;
  
 }

 lcd.setCursor(0,1);
 
 if ( segundo <10 )
 {
 valor_segundo = ("0"+ String(segundo));
 }
 else
 {
  valor_segundo = String(segundo);
 }

 if (minuto <10 )
 {
  valor_minuto = "0"+ String(minuto);
 }
 else
 {
  valor_minuto = String(minuto);
 }

 if ( hora < 10 )
 {
  valor_hora = "0"+ String(hora);
 }
 else
 {
  valor_hora = String(hora);
 }


 if ( pulso == 0 )
 { 
  lcd.print(valor_hora + ":" + valor_minuto + ":" + valor_segundo);
 }
 else
 {
  lcd.print(valor_hora + " " + valor_minuto + " " + valor_segundo);
 }

  
segundo = segundo+1;
delay(1000);
pulso = !pulso; 
}
