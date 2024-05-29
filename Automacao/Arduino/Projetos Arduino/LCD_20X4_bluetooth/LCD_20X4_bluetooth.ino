/*

  LIGACOES DO DISPLAY 20X4 OU ATE MESMO 16X2
  
 1 - VSS do LCD - GND
 2 - VDD do LCD - 5V
 3 - VO do LCD - Pino central do potenciometro ou DIVISOR DE TENSAO VCC/470R/100R/GND   e o sinal em entre 470R e 100R
 4 - RS do LCD - Vai ao pino 7
 5 - RW do LCD - GND
 6 - E do LCD - Vai ao pino 6
 7 - D0 do LCD - NC
 8 - D1 do LCD - NC
 9 - D2 do LCD - NC
10 - D3 do LCD - NC
11 - D4 do LCD - Pino 5
12 - D5 do LCD - Pino 4
13 - D6 do LCD - Pino 3 
14 - D7 do LCD - Pino 2 
15 - A do LCD - 5V 
16 - K do LCD - GND 


*/
 
// inclui a biblioteca LiquidCrystal:
#include <LiquidCrystal.h>

// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(7, 6, 5, 4, 3, 2);
String readString;

void setup() 
{
  // configura o numero de colunas e linhas do LCD: 
    lcd.begin(20, 4);
Serial.begin(9600);
}

void loop() 
{
  String dados;
         while (Serial.available()) 
         {
          delay(3);  
          char c = Serial.read();
          readString += c; 
         }
       
        if (readString.length() >0) 
        {
         
          dados = readString;
          lcd.setCursor(0, 2);
         lcd.print("                    ");delay(50);
         lcd.setCursor(0, 2);
         lcd.print(dados);
         Serial.println(dados);
         
        readString="";
        } 
      
  
  
   lcd.setCursor(0, 0);
   lcd.print("Bruno Goncalves");
   lcd.setCursor(0, 1);
   lcd.print("Dado Recebido");
   
   lcd.setCursor(0, 3);
   lcd.print(millis()/1000);// imprime o numero de segundos desde o reset:
}

