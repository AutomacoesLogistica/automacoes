void FECHAR()
{
   if (tranca == 2)
   {
    digitalWrite(A4,1); // solenoide 5 alimenta fechar
    digitalWrite(A5,1); // solenoide 6 dreno   
    digitalWrite(A1,1); // solenoide 2
    delay(6000); // faz o portao de batente esperar o outro para nao encavalar
    digitalWrite(A2,1); // solenoide 3 
    tranca = 3;
    delay(3000); // Arruma a questao do portao ficar travando.
   }   
   
   if(contador==3 && digitalRead(3)==0) // comando para desenergizar as solenoides quando o portao estiver fechado
   {
    delay(1000);
    digitalWrite(A1,0); // solenoide 2
    digitalWrite(A2,0); // solenoide 3 
    digitalWrite(A5,0); // solenoide 6 dreno   
    digitalWrite(8,1); // energiza a tranca
    delay(1000);
    digitalWrite(A4,0); // solenoide 5 alimenta fechar
    contador = 0;
    tranca = 0;
    delay(250);
   }


  
}
