void desliga_rele2() // Desliga o carregamento do tablet de VL
{
  digitalWrite(rele2,HIGH);// Desliga pois o rele atua em low
  digitalWrite(saida_rele2,LOW); // Desliga o led da saida
  Mensagem_Enviar = "rele2_"+carregadeira+"_off"; 
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele2";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 2 desligado 
  readString =""; 
  delay(200);

  // Publica Hora de atualizacao
  horario2 = horario + " " + datacompleta;
  Mensagem_Enviar = horario2;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
  topico = "gerdau/"+carregadeira+"/atualizacao/rele2";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica a latitude
  delay(200);
}