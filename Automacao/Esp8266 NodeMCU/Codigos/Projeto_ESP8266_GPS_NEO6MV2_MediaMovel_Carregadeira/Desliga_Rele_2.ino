void desliga_rele2() // Desliga o Reader
{
  digitalWrite(rele2,HIGH);// Desliga pois o rele atua em low
  Mensagem_Enviar = "rele2_"+carregadeira+"_off"; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele2";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 2 desligado 
  readString =""; 
  delay(200);
}
