void fechar()
{
  // FECHAR O PORTAO GRANDE *******************************************************************************************************************************************************
  if (contador == 4) 
  {
   digitalWrite(alimentacao_Fechar,LOW);// Liberacao da agua sentido fechar e no fisico o dreno fechar tambem
   digitalWrite(bloqueio,HIGH); // Desativa a valvula bloqueio para o portao com batente comecar a fechar
   // Ativa o bloqueio para o portao com batente esperar 6 segundos e dar tempo do outro vir e não encavalar
   delay(10000);
   digitalWrite(bloqueio,LOW); // Modula a valvula bloqueio permitindo o botao que tem batente fechar
   delay(1000);
    
   
   contador = 5;
  }


} // Fecha void fechar
