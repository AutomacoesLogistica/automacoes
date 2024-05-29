#include <Wire.h>
#include <EEPROM.h>
String valor_kwh_acumulado = "99913,59";
String parte_decimal = String(valor_kwh_acumulado.substring(valor_kwh_acumulado.length()-2,valor_kwh_acumulado.length()));
String parte_inteira = String(valor_kwh_acumulado.substring(0,valor_kwh_acumulado.length()-3)) ;


long int valor_inteiro = parte_inteira.toInt();
long int valor_decimal = parte_decimal.toInt();

int primeiro_v_kwh_acumulado = 0;
int segundo_v_kwh_acumulado = 0;
int terceiro_v_kwh_acumulado = 0;



void setup()
{
  
 Serial.begin(115200);
/*
 primeiro_v_kwh_acumulado = valor_inteiro/65025;
 segundo_v_kwh_acumulado = (valor_inteiro-65025)/255;
 terceiro_v_kwh_acumulado = (valor_inteiro-65025)-(segundo_v_kwh_acumulado*255);
 
 Serial.println(primeiro_v_kwh_acumulado);
 Serial.println(segundo_v_kwh_acumulado);
 Serial.println(terceiro_v_kwh_acumulado);
 Serial.println(valor_decimal);

//EEPROM.write(0,primeiro_v_kwh_acumulado);
//EEPROM.write(1,segundo_v_kwh_acumulado);
//EEPROM.write(2,terceiro_v_kwh_acumulado);
//EEPROM.write(3,valor_decimal);
*/

 int v0 = EEPROM.read(0); 
 int v1 = EEPROM.read(1); 
 int v2 = EEPROM.read(2); 
 int v3 = EEPROM.read(3); 
unsigned int resultado = 0;
resultado = int(v1)*255;
  
  Serial.println(v0*65025);
  Serial.println(resultado);
  Serial.println(v2);
  Serial.println(v3);
}

void loop()
{

  
}
