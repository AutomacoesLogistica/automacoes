#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x27,20,4);




#define entrada_zerar_mes 12 // Tambem tera por MQTT
#define entrada_pulso 14

#define valor_kwh 1.10124712

float kwh_casa = 377.22;
float kwh_cemig = 845.35;
float valor_mensal;
float valor_acumulado;
float valor_reais;

void setup() 
{ 
 pinMode(entrada_zerar_mes,INPUT); 
 pinMode(entrada_pulso,INPUT);
 lcd.init();                      // initialize the lcd   
 lcd.backlight();
 valor_mensal = 86.81;
 valor_reais = (valor_mensal * valor_kwh);
 valor_acumulado = kwh_cemig+kwh_casa;
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("KWh Men.:");
 lcd.setCursor(10,0);
 lcd.print("          ");//Limpar o local do valor kwh mensal
 lcd.setCursor(10,0);
 lcd.print(String(valor_mensal,2));
 lcd.setCursor(0,1);
 lcd.print ("KWh Acu.:");
 lcd.setCursor(10,1);
 lcd.print("          ");//Limpar o local do valor kwh acumulado
 lcd.setCursor(10,1);
 lcd.print(String(valor_acumulado,2));
 lcd.setCursor(0,2);
 lcd.print ("KWh Casa:");
 lcd.setCursor(9,2);
 lcd.print("           ");
 lcd.setCursor(10,2);
 lcd.print(kwh_casa);
 lcd.setCursor(0,3);
 lcd.print ("Previsao:");
 lcd.setCursor(9,3);
 lcd.print ("           "); // Limpa o valor em reais
 lcd.setCursor(10,3);
 lcd.print("R$ "+String(valor_reais,2));
} 



void atualiza()
{
  valor_reais = (valor_mensal * valor_kwh);
  valor_acumulado = kwh_cemig+kwh_casa;
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print ("KWh Men.:");
  lcd.setCursor(10,0);
  lcd.print("          ");//Limpar o local do valor kwh mensal
  lcd.setCursor(10,0);
  lcd.print(String(valor_mensal));
  lcd.setCursor(0,1);
  lcd.print ("KWh Acu.:");
  lcd.setCursor(10,1);
  lcd.print("          ");//Limpar o local do valor kwh acumulado
  lcd.setCursor(10,1);
  lcd.print(String(valor_acumulado,2));
  lcd.setCursor(0,2);
  lcd.print ("KWh Casa:");
  lcd.setCursor(9,2);
  lcd.print("           ");
  lcd.setCursor(10,2);
  lcd.print(kwh_casa);
  lcd.setCursor(0,3);
  lcd.print ("Previsao:");
  lcd.setCursor(9,3);
  lcd.print ("           "); // Limpa o valor em reais
  lcd.setCursor(10,3);
  lcd.print("R$ "+String(valor_reais,2));
}

void loop()
{
 if(digitalRead(entrada_zerar_mes)==LOW)
 {
  delay(1000);
  valor_mensal = 0.00;
  valor_reais = (valor_mensal * valor_kwh);
  valor_acumulado = kwh_cemig+kwh_casa;
  atualiza();
 }

 if(digitalRead(entrada_pulso)==LOW)
 {
  valor_mensal = valor_mensal+ 0.00125;
  kwh_casa = kwh_casa + 0.00125;
  atualiza();
 }

 
}
