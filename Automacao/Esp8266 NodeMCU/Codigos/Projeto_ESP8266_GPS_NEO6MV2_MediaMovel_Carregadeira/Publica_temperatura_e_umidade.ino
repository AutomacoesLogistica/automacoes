void atualiza_temp_umidade()
{
 delay(dht.getMinimumSamplingPeriod()); // Tempo espera minimo para atualização
 float humidity = dht.getHumidity();
 float temperature = dht.getTemperature();
  
 // Criando o valor de umidade no mqtt ************************************************************************************************************************************************
 umidade = String(humidity,1) + " %";
 Mensagem_Enviar = umidade; // Busca o valor de umidade do sensor e salva na variavel 
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1); 
 topico = "gerdau/"+carregadeira+"/umidade";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a umidade
 delay(200);
 // Criando o valor de temperatura no mqtt *******************************************************************************************************************************************
 temperatura = String(dht.computeHeatIndex(temperature, humidity, false), 1) + " ºC";
 Mensagem_Enviar = temperatura;  // Busca o valor de temperatura do sensor e salva na variavel
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/"+carregadeira+"/temp";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a temperatura
 //**********************************************************************************************************************************************************************************
 delay(200);
 readString =""; // Limpa mensagem recebida
 
 publica_bateria();
 
}
