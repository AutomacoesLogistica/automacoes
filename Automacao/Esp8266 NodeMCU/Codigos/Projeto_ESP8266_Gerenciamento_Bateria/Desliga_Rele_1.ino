void desliga_rele1() // Desliga o carretamento do tablet de MB
{
  digitalWrite(rele1,HIGH);// Desliga o rele pois o rele atua em low
  digitalWrite(saida_rele1,LOW); // Desliga o led da saida
  Mensagem_Enviar = "rele1_"+carregadeira+"_off";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele1";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 1 desligado 
  readString =""; 
  delay(200);


  // Publica Hora de atualizacao
  horario2 = horario + " " + datacompleta;
  Mensagem_Enviar = horario2;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
  topico = "gerdau/"+carregadeira+"/atualizacao/rele1";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica a latitude
  delay(200);
}
