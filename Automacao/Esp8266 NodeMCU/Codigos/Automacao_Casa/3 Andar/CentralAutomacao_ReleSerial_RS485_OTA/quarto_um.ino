void quarto1()
{
  if ( readString.indexOf("quarto1_1") >= 0)
  {
    q1teto = 1;
    reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "quarto1_1");
  }
  if ( readString.indexOf("quarto1_0") >= 0 )
  {
    q1teto = 0;
    reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "quarto1_0");
  }

  if ( readString.indexOf("lamp_quarto1") >= 0)
  {
    intertrava = 0;
    if (q1teto == 0 && intertrava == 0)
    {
      q1teto = 1;
      intertrava = 1;
      reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "quarto1_1");
    }
    if (q1teto == 1 && intertrava == 0)
    {
      q1teto = 0;
      intertrava = 1;
      reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "quarto1_0");
    }
  }

  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("q1painel_1") >= 0)
  {
    q1painel = 1;
    reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q1painel_1");
  }
  if ( readString.indexOf("q1painel_0") >= 0 )
  {
    q1painel = 0;
    reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q1painel_0");
  }

  if ( readString.indexOf("amb_quarto1") >= 0)
  {
    intertrava = 0;
    if (q1painel == 0 && intertrava == 0)
    {
      q1painel = 1;
      intertrava = 1;
      reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q1painel_1");
    }
    if (q1painel == 1 && intertrava == 0)
    {
      q1painel = 0;
      intertrava = 1;
      reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q1painel_0");
    }
  }

  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("q1corti_1") >= 0)
  {
    q1corti = 1;
    reles.SetRelay(8, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q1corti_1");
  }
  if ( readString.indexOf("q1corti_0") >= 0 )
  {
    q1corti = 0;
    reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q1corti_0");
  }

  if ( readString.indexOf("lam_cor_q1") >= 0)
  {
    intertrava = 0;
    if (q1corti == 0 && intertrava == 0)
    {
      q1corti = 1;
      intertrava = 1;
      reles.SetRelay(8, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q1corti_1");
    }
    if (q1corti == 1 && intertrava == 0)
    {
      q1corti = 0;
      intertrava = 1;
      reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q1corti_0");
    }
  }

  if ( readString.indexOf("all_quarto1_on") >= 0)
  {
   q1teto = 1;
   q1painel = 1;
   q1corti = 1;
   reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "quarto1_1");
   delay(500);
   reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "q1painel_1");
   delay(500);
   client.publish("dev/test/minhacasa/supervisorio", "q1corti_1");
   reles.SetRelay(8, LigarRele, 1); // num rele, modo, num modulo
   delay(500);
  }
  
  if ( readString.indexOf("all_quarto1_off") >= 0)
  {
   q1teto = 0;
   q1painel = 0;
   q1corti = 0;
   reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "quarto1_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "q1painel_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "q1corti_0");
   delay(200);
  }
  
} // Fecha o void quarto 1
