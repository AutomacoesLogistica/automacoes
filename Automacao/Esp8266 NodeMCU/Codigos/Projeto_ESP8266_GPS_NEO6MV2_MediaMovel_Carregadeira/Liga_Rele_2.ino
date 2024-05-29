void liga_rele2() // liga o Reader
{
  digitalWrite(rele2,LOW);// Liga pois o rele atua em low
  Mensagem_Enviar = "rele2_"+carregadeira+"_on";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele2";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 2 ligado 
  readString ="";
  delay(200);
}
