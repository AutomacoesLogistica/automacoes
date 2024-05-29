void TELA_0()
{
 lcd.setCursor(0,0);
 lcd.print("Cap.Tanque:    ");
 lcd.setCursor(12,0);
 lcd.print(valor_de_capacidade_util); // Variavel da capacidade do tanque
 lcd.setCursor(15,0);
 lcd.print("L");
 lcd.setCursor(0,1);
 
 if(tela_0_aux == 0 )
 {
       lcd.print("Nivel Atual:    ");
       lcd.setCursor(11,1);
       if ( nivel_atual <100)
       {
        lcd.setCursor(12,1);
        lcd.print(" ");
        lcd.setCursor(13,1);
        lcd.print(nivel_atual);
       }
       else
       {
        lcd.setCursor(12,1); 
        lcd.print(nivel_atual); // Variavel do valor de bloqueio
       }
       lcd.setCursor(15,1);
       lcd.print("%");
 }
 if ( tela_0_aux == 1 )
 {
       lcd.print("Valor Bloq:     ");
       lcd.setCursor(11,1);
       if ( valor_de_bloqueio <100)
       {
        lcd.setCursor(12,1);
        lcd.print(" ");
        lcd.setCursor(13,1);
        lcd.print(valor_de_bloqueio);
       }
       else
       {
        lcd.setCursor(12,1); 
        lcd.print(valor_de_bloqueio); // Variavel do valor de bloqueio
       }
       lcd.setCursor(15,1);
       lcd.print("%");


  
 }






  
}
