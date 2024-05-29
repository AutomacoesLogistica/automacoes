void publica_status()
{
 String maquina2 = ""; 
 if (maquina == "desligada"){maquina2 = "Desligada!";}
 if (maquina == "ligada"){maquina2 = "Ligada!";}
 String maq = String(maquina2);
 Mensagem_Enviar = maq; // Busca o valor de umidade do sensor e salva na variavel 
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 topico = "gerdau/"+carregadeira+"/status";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a umidade
 delay(200);

 
}
