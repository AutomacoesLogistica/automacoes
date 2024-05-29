void liga_rele1() // Liga Radio
{
  digitalWrite(rele1,LOW);// Liga o rele atua em low
  Mensagem_Enviar = "rele1_"+carregadeira+"_on"; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele1";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 1 ligado
  readString ="";
  delay(200);
  publica_status();
}
