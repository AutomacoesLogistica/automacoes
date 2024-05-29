void setup ()
{
pinMode(2,INPUT);
pinMode(3,OUTPUT);// LIBERA PARA ABRIR
pinMode(4,OUTPUT);// LIBERA PARA FECHAR
pinMode(5,OUTPUT);// LIBERA DRENO AO ABRIR
pinMode(6,OUTPUT);// LIBERA DRENO AO FECHAR
pinMode(7,OUTPUT);// ENERGIZA TRANCA
pinMode(8,INPUT);// INDICA QUE O PORTAO ESTA FECHADO
pinMode(9,INPUT);// INDICA QUE O PORTAO ESTA ABERTO
pinMode(10,OUTPUT);// LED INDICANDO PORTAO ABERTO 
pinMode(11,OUTPUT);// LED INDICANDO PORTAO FECHADO
pinMode(12,OUTPUT);// ACIONA TRANCA PORTAO
pinMode(13,INPUT);// RECEBE O SINAL PARA ACIONAR ABRIR OU FECHAR
}

// DECLARANDO AS VARIAVEIS DE ENTRADA E SAIDA

void loop()
{
  int abrir = digitalRead(13);
  int fechar = digitalRead(2);
  int saberto = digitalRead(9);
  int sfechado = digitalRead(8);
   
   if (abrir==1) 
   {
   digitalWrite(11,0);
   }
  if (fechar==1) 
   {
   digitalWrite(10,0);
   } 
   if (abrir==1 && saberto==0) 
   {
   digitalWrite(11,0);
   digitalWrite(3, 1); // ENERGIZA A SOLENOIDE PARA ABRIR 
   digitalWrite(5, 1); // ENERGIZA A SOLENOIDE PARA DRENAR AO ABRIR
   digitalWrite(10, 1);// PISCA LED DE 1 EM 1 SEGUNDO INDICANDO QUE O PORTAO ESTA ABRINDO
   delay(500);
   digitalWrite(10, 0);
   delay(500);
   }
   else if ( abrir==1 && saberto==1)
   {
   digitalWrite(3, 0); // DESLIGA A SOLENOIDE PARA ABRIR 
   digitalWrite(5, 0); // DESLIGA A SOLENOIDE PARA DRENAR AO ABRIR   
   digitalWrite(10, 1); // LED ACENDE E INDICA QUE O PORTAO ABRIU POR COMPLETO
   
   }
   if (fechar==1 && sfechado==0)
   {
   digitalWrite(4,1);  // ENERGIZA A SOLENOIDE PARA FECHAR
   digitalWrite(6, 1); // ENERGIZA A SOLENOIDE PARA DRENAR AO FECHAR
   digitalWrite(11, 1); // PISCA LED DE 1 EM 1 SEGUNDO INDICANDO QUE O PORTAO ESTA FECHANDO
   delay(500);
   digitalWrite(11, 0);
   delay(500);
   }
   else if (fechar==1 && sfechado==1)
   {
   digitalWrite(4, 0); // DESLIGA A SOLENOIDE PARA FECHAR 
   digitalWrite(6, 0); // DESLIGA A SOLENOIDE PARA DRENAR AO FECHAR   
   digitalWrite(11, 1); // LED ACENDE E INDICA PORTAO FECHADO
   }

  
  // CIRCUITO QUE COLOCA OU TIRA ALIMENTACAO PARA A TRANCA
   
  if (fechar ==1 && sfechado==1 )
  {
  digitalWrite(7, 1);
  }
  else
  {
  digitalWrite(7, 0 );
  }
}



