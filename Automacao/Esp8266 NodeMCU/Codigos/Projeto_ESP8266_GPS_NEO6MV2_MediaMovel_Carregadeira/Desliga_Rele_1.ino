void desliga_rele1() // Desliga o radio
{
  digitalWrite(rele1,HIGH);// Desliga o rele pois o rele atua em low
  Mensagem_Enviar = "rele1_"+carregadeira+"_off";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele1";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 1 desligado 
  readString =""; 
  delay(200);
  publica_status();
}
