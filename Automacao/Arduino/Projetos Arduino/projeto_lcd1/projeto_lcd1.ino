//  LiquidCrystal Library - Hello World
 
 Demonstra o uso de um display LCD 16x2.  A biblioteca LiquidCrystal
 trabalha com todos os displays LCD compativeis com o driver 
 Hitachi HD44780. Existem muitos destes por ai, e voce
 casualmente pode identifica-los pela interface de 16 pinos.
 
 Este sketch imprime "Hello World!" no LCD
 e mostra o tempo ligado.
 
  O circuito:
 * LCD RS na porta digital 12
 * LCD Enable na porta digital 11
 * LCD D4 na porta digital 5
 * LCD D5 na porta digital 4
 * LCD D6 na porta digital 3
 * LCD D7 na porta digital 2
 * LCD R/W no GND
 * Potenciometro de 10K: vo
// inclui a biblioteca LiquidCrystal:
#include <LiquidCrystal.h>

// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

void setup() {
  // configura o numero de colunas e linhas do LCD: 
  lcd.begin(16, 2);
  // Imprime uma mensagem no LCD.
  lcd.print("Bem Vindo");
     lcd.setCursor(0, 1);
   lcd.print("                ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("               O");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("              Ol");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("             Ola");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("            Ola ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("           Ola  ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("          Ola   ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("         Ola    ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("       Ola      ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("      Ola       ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("     Ola        ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("    Ola         ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("   Ola          ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("  Ola           ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print(" Ola            ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("Ola             ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("la              ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("a               ");delay(500);
   lcd.setCursor(0, 1);
   lcd.print("                ");delay(500);
}

void loop() {
  // configura o cursor para a coluna 0, linha 1
  // (nota: linha 1 e a segunda linha, pois a contagem comeca em 0):
  lcd.setCursor(0, 1);
  // imprime o numero de segundos desde o reset:
   lcd.print("Bruno Goncalves ");delay(5000);
  lcd.setCursor(0, 0);
   lcd.print("Tel (31)88494604");
   lcd.setCursor(0, 1);
   lcd.print("Defeitos = 0    ");delay(2000);
   lcd.setCursor(0, 1);
   lcd.print("Jump Atuados = 0");delay(2000);





}

