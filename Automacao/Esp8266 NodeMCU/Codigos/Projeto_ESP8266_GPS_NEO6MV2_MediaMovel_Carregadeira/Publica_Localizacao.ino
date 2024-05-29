void publica_posicao()
{
 // Criando o valor de latitude no mqtt *******************************************************************************************************************************************
 //gerdau/localizacao/latitude/pc01
 String latitude2 = String(media_lat, 6);
 Mensagem_Enviar = latitude2;
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/localizacao/latitude/"+carregadeira;
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a latitude
 delay(200);
 
 // Criando o valor de longitude no mqtt *******************************************************************************************************************************************
 //gerdau/localizacao/longitude/pc01
 String longitude2 = String(media_lon, 6);
 Mensagem_Enviar = longitude2;
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/localizacao/longitude/"+carregadeira;
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a longitude
 delay(200);
  
 // Criando o valor de latitude+longitude no mqtt *******************************************************************************************************************************************
 //gerdau/pc01/coordenada
 Mensagem_Enviar = latitude2 + "," + longitude2;
 Mensagem_Enviar.toCharArray(Funcoes, Mensagem_Enviar.length()+1);
 topico = "gerdau/"+carregadeira+"/coordenada";
 topico.toCharArray(Funcoes_topico, topico.length()+1);
 client.publish(Funcoes_topico, Funcoes); // Publica a longitude
 delay(200);
 //**********************************************************************************************************************************************************************************


 atualiza_temp_umidade();


  
} // Fecha o publica posicao
