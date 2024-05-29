void quarto2()
{

 if ( readString.indexOf("quarto2_1") >= 0)
  {
    q2teto = 1;
    reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "quarto2_1");
  }
  if ( readString.indexOf("quarto2_0") >= 0 )
  {
    q2teto = 0;
    reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "quarto2_0");
  }

  if ( readString.indexOf("lamp_quarto2") >= 0)
  {
    intertrava = 0;
    if (q2teto == 0 && intertrava == 0)
    {
      q2teto = 1;
      intertrava = 1;
      reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "quarto2_1");
    }
    if (q2teto == 1 && intertrava == 0)
    {
      q2teto = 0;
      intertrava = 1;
      reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "quarto2_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("q2painel_1") >= 0)
  {
    q2painel = 1;
    reles.SetRelay(2, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q2painel_1");
  }
  if ( readString.indexOf("q2painel_0") >= 0 )
  {
    q2painel = 0;
    reles.SetRelay(2, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q2painel_0");
  }

  if ( readString.indexOf("amb_quarto2") >= 0)
  {
    intertrava = 0;
    if (q2painel == 0 && intertrava == 0)
    {
      q2painel = 1;
      intertrava = 1;
      reles.SetRelay(2, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q2painel_1");
    }
    if (q2painel == 1 && intertrava == 0)
    {
      q2painel = 0;
      intertrava = 1;
      reles.SetRelay(2, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q2painel_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("q2corti_1") >= 0)
  {
    q2corti = 1;
    reles.SetRelay(3, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q2corti_1");
  }
  if ( readString.indexOf("q2corti_0") >= 0 )
  {
    q2corti = 0;
    reles.SetRelay(3, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "q2corti_0");
  }

  if ( readString.indexOf("lam_cor_q2") >= 0)
  {
    intertrava = 0;
    if (q2corti == 0 && intertrava == 0)
    {
      q2corti = 1;
      intertrava = 1;
      reles.SetRelay(3, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q2corti_1");
    }
    if (q2corti == 1 && intertrava == 0)
    {
      q2corti = 0;
      intertrava = 1;
      reles.SetRelay(3, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "q2corti_0");
    }
  }

  if ( readString.indexOf("all_quarto2_on") >= 0)
  {
   q2teto = 1;
   q2painel = 1;
   q2corti = 1;
   reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "quarto2_1");
   delay(500);
   reles.SetRelay(2, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "q2painel_1");
   delay(500);
   reles.SetRelay(3, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "q2corti_1");
   delay(500);
  }
  
  if ( readString.indexOf("all_quarto2_off") >= 0)
  {
   q2teto = 0;
   q2painel = 0;
   q2corti = 0;
   reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
   reles.SetRelay(2, DesligarRele, 2); // num rele, modo, num modulo
   reles.SetRelay(3, DesligarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "quarto2_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "q2painel_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "q2corti_0");
   delay(200);
  }
  
} // Fecha void quarto2
