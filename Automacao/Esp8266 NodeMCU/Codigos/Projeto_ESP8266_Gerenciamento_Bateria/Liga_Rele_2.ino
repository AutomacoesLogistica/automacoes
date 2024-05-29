void liga_rele2() // Liga o carregamento do tablet de VL
{
  digitalWrite(rele2,LOW);// Liga pois o rele atua em low
  digitalWrite(saida_rele2,HIGH); // Liga o led da saida
  Mensagem_Enviar = "rele2_"+carregadeira+"_on";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele2";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 2 ligado 
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
