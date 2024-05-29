void abrir()
{
 // ABRIR O PORTAO GRANDE *******************************************************************************************************************************************************
 if (contador == 1)
 {
  // Libera a trancaeletromagnetica 12V
  digitalWrite(eletromagnetica,HIGH); // Libera o eletroima
  delay(500); // Por segurança
  // Libera a tranca eletromecanica 127V em cima
  digitalWrite(eletromecanica,LOW); // Energiza a tranca eletromecanica
  delay(1000); // Por segurança
   
  // LIBERA AGUA PARA O SISTEMA
  digitalWrite(alimentacao_Abrir,LOW);// Liberacao da agua e dreno abrir no fisico
  digitalWrite(bloqueio,LOW); // Abre a válvula de bloqueio para permitir que a agua na frente do pistao que tem o batente saia para dreno abrindo tambem o portao
  
  delay(2500);
  
  // Retira alimentacao da tranca eletromecanica 127V em cima para ela nao queimar
  digitalWrite(eletromecanica,HIGH); // Libera a tranca eletromecanica
  contador = 2;
      
  }

  

} // Fecha void abrir
