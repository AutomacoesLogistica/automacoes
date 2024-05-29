void principais()
{

  // LIGAR TODAS AS PRINCIPAIS DA CASA *****************************************************************************************************************************************************
  if ( readString.indexOf("all_principais_on") >= 0)
  {
    // ATUALIZA AS VARIAVEIS
    steto = 1;
    svaranda = 1;
    q1teto = 1;
    q2teto = 1;
    czteto = 1;
    czcorredor = 1;
    qcteto = 1;
    clteto = 1;
    egteto = 1;
    egteto2 = 1;
    lbteto = 1;
    soteto = 1;
    suteto = 1;

    // LIGA A LAMPADA DA SALA
    reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
    // LIGAR A VARANDA DA CASA
    reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
    // LIGA A LAMPADA DO QUARTO 1
    reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
    // LIGA A LAMPADA DO QUARTO 2
    reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
    // LIGAR LAMPADA DA COZINHA
    reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
    // LIGAR LAMPADA DO CORREDOR
    reles.SetRelay(5, LigarRele, 2); // num rele, modo, num modulo
    // LIGAR QUARTO DE CASAL
    reles.SetRelay(2, LigarRele, 3); // num rele, modo, num modulo
    // LIGAR CLOSET
    reles.SetRelay(5, LigarRele, 3); // num rele, modo, num modulo
    // LIGAR ESPACO GOURMET
    reles.SetRelay(8, LigarRele, 3); // num rele, modo, num modulo
    // LIGAR AREA DE SERVICO
    reles.SetRelay(4, LigarRele, 4); // num rele, modo, num modulo
    // LIGAR LABORATORIO
    reles.SetRelay(5, LigarRele, 4); // num rele, modo, num modulo
    // LIGAR BANHEIRO SOCIAL
    reles.SetRelay(8, LigarRele, 4); // num rele, modo, num modulo
    // LIGAR BANHEIRO SUITE
    reles.SetRelay(3, LigarRele, 5); // num rele, modo, num modulo


    // Atualiza no MQTT ***********************************************************************************************
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "sala_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "svaranda_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "quarto1_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "quarto2_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "cozinha_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "czcorredor_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "quartocasal_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "closet_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "laboratorio_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "banhsocial_1");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "banhsuite_1");
    delay(200);

  } // Fecha if all_principais_on


  // DESLIGAR TODAS AS PRINCIPAIS DA CASA **************************************************************************************************************************************************
  if ( readString.indexOf("all_principais_off") >= 0)
  {
    // ATUALIZA AS VARIAVEIS
    steto = 0;
    svaranda = 0;
    q1teto = 0;
    q2teto = 0;
    czteto = 0;
    czcorredor = 0;
    qcteto = 0;
    clteto = 0;
    egteto = 0;
    egteto2 = 0;
    lbteto = 0;
    soteto = 0;
    suteto = 0;

    // DESLIGA A LAMPADA DA SALA
    reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
    // DESLIGAR A VARANDA DA CASA
    reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo    
    // DESLIGA A LAMPADA DO QUARTO 1
    reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
    // DESLIGA A LAMPADA DO QUARTO 2
    reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
    // DESLIGAR LAMPADA DA COZINHA
    reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
    // DESLIGAR LAMPADA DO CORREDOR
    reles.SetRelay(5, DesligarRele, 2); // num rele, modo, num modulo
    // DESLIGAR QUARTO DE CASAL
    reles.SetRelay(2, DesligarRele, 3); // num rele, modo, num modulo
    // DESLIGAR CLOSET
    reles.SetRelay(5, DesligarRele, 3); // num rele, modo, num modulo
    // DESLIGAR ESPACO GOURMET
    reles.SetRelay(8, DesligarRele, 3); // num rele, modo, num modulo
    // DESLIGAR AREA DE SERVICO
    reles.SetRelay(4, DesligarRele, 4); // num rele, modo, num modulo
    // DESLIGAR LABORATORIO
    reles.SetRelay(5, DesligarRele, 4); // num rele, modo, num modulo
    // DESLIGAR BANHEIRO SOCIAL
    reles.SetRelay(8, DesligarRele, 4); // num rele, modo, num modulo
    // DESLIGAR BANHEIRO SUITE
    reles.SetRelay(3, DesligarRele, 5); // num rele, modo, num modulo


    // Atualiza no MQTT ***********************************************************************************************
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "sala_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "svaranda_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "quarto1_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "quarto2_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "cozinha_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "czcorredor_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "quartocasal_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "closet_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "laboratorio_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "banhsocial_0");
    delay(200);
    client.publish("dev/test/minhacasa/supervisorio", "banhsuite_0");
    delay(200);

  } // Fecha if all_principais_off

}
