void publica_bateria()
{
 

// Criando o valor de tensão bateria no mqtt ************************************************************************************************************************************************
 String bateria = String(valor,2) + " V";
 Mensagem_Enviar = bateria; // Busca o valor de umidade do sensor e salva na variavel 
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 topico = "gerdau/"+carregadeira+"/bat";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a umidade
 delay(200);
 publica_status();
}
