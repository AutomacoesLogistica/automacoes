void desliga_rele4() // Desliga o carretamento do tablet excesso vl
{
  digitalWrite(rele4,HIGH);// Desliga o rele pois o rele atua em low
  digitalWrite(saida_rele4,LOW); // Desliga o led da saida
  Mensagem_Enviar = "rele4_"+carregadeira+"_off";  
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
  topico = "gerdau/status/"+carregadeira+"/rele4";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica status do rele 4 desligado 
  readString =""; 
  delay(200);


  // Publica Hora de atualizacao
  horario2 = horario + " " + datacompleta;
  Mensagem_Enviar = horario2;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
  topico = "gerdau/"+carregadeira+"/atualizacao/rele4";
  topico.toCharArray(Funcoes_topico, topico.length()+1);
  client.publish(Funcoes_topico, Funcoes); // Publica a latitude
  delay(200);
}
