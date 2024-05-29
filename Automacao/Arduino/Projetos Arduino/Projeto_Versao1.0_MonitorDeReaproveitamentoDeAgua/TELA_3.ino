void TELA_3()
{
 if ( tela == 3.0)
 {
 lcd.setCursor(0,0);
 lcd.print("Insira todas as ");
 lcd.setCursor(0,1);
 lcd.print("medidas em mm ! ");
 delay(3000);
 lcd.clear();
 tela = 3.1;
 }

if ( tela == 3.1)
{
 lcd.setCursor(0,0);
 lcd.print("Alt.do tanque(A)");
 lcd.setCursor(0,1);
 lcd.print("Valor : 0000.0  "); 
}

if ( tela == 3.2)
{
 lcd.setCursor(0,0);
 lcd.print("Alt.do dreno(B)");
 lcd.setCursor(0,1);
 lcd.print("Valor : 0000.0  ");   
}

if ( tela == 3.3)
{
 lcd.setCursor(0,0);
 lcd.print("Diam. Tanque (C)");
 lcd.setCursor(0,1);
 lcd.print("Valor : 0000.0  ");   
}

if ( tela == 3.4)
{
 lcd.setCursor(0,0);
 lcd.print("Capacidade:     ");
 lcd.setCursor(0,1);
 lcd.print("Valor : 0000.0 L");   
 delay(3000);
 tela = 3.5;
}

if ( tela == 3.5)
{
 lcd.setCursor(0,0);
 lcd.print("Zona Morta:     ");
 lcd.setCursor(0,1);
 lcd.print("Valor : 0000.0 L");   
 delay(3000);
 tela = 3.6;
}

if ( tela == 3.6)
{
 lcd.setCursor(0,0);
 lcd.print("Niv. Bloqueio(D)");
 lcd.setCursor(0,1);
 lcd.print("Valor : 000.0%  ");   
}




 
}
