
void publica_hora_atualizacao()
{
  // Criando o valor de hora da atualizacao no mqtt *******************************************************************************************************************************************
  String horario2 = horario + " " + datacompleta;
  Mensagem_Enviar = horario2;
  Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length() + 1);
  topico = "gerdau/instante/monitor_tensao/" + local;
  topico.toCharArray(Funcoes_topico, topico.length() + 1);
  client.publish(Funcoes_topico, Funcoes); // Publica o horario da atualizacao
  delay(200);
} // Fecha a hora atualizacao
