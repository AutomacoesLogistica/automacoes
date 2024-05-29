void acesso()
{

  if ( readString.indexOf("acesso1_1") >= 0)
  {
    ac1teto = 1;
    reles.SetRelay(6, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "acesso1_1");
  }
  if ( readString.indexOf("acesso1_0") >= 0 )
  {
    ac1teto = 0;
    reles.SetRelay(6, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "acesso1_0");
  }

  if ( readString.indexOf("lam_ac_t1") >= 0)
  {
    intertrava = 0;
    if (ac1teto == 0 && intertrava == 0)
    {
      ac1teto = 1;
      intertrava = 1;
      reles.SetRelay(6, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "acesso1_1");
    }
    if (ac1teto == 1 && intertrava == 0)
    {
      ac1teto = 0;
      intertrava = 1;
      reles.SetRelay(6, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "acesso1_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("acesso2_1") >= 0)
  {
    ac2teto = 1;
    reles.SetRelay(7, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "acesso2_1");
  }
  if ( readString.indexOf("acesso2_0") >= 0 )
  {
    ac2teto = 0;
    reles.SetRelay(7, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "acesso2_0");
  }

  if ( readString.indexOf("lam_ac_t2") >= 0)
  {
    intertrava = 0;
    if (ac2teto == 0 && intertrava == 0)
    {
      ac2teto = 1;
      intertrava = 1;
      reles.SetRelay(7, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "acesso2_1");
    }
    if (ac2teto == 1 && intertrava == 0)
    {
      ac2teto = 0;
      intertrava = 1;
      reles.SetRelay(7, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "acesso2_0");
    }
  }

   // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("ac2ambi_1") >= 0)
  {
    ac2ambi = 1;
    reles.SetRelay(8, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "ac2ambi_1");
  }
  if ( readString.indexOf("ac2ambi_0") >= 0 )
  {
    ac2ambi = 0;
    reles.SetRelay(8, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "ac2ambi_0");
  }

  if ( readString.indexOf("amb_ac_t2") >= 0)
  {
    intertrava = 0;
    if (ac2ambi == 0 && intertrava == 0)
    {
      ac2ambi = 1;
      intertrava = 1;
      reles.SetRelay(8, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "ac2ambi_1");
    }
    if (ac2ambi == 1 && intertrava == 0)
    {
      ac2ambi = 0;
      intertrava = 1;
      reles.SetRelay(8, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "ac2ambi_0");
    }
  }

  if ( readString.indexOf("all_acesso_on") >= 0)
  {
   ac1teto = 1;
   ac2teto = 1;
   ac2ambi = 1;
   reles.SetRelay(6, LigarRele, 5); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "acesso1_1");
   delay(500);
   reles.SetRelay(7, LigarRele, 5); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "acesso2_1");
   delay(500);
   reles.SetRelay(8, LigarRele, 5); // num rele, modo, num modulo    
   client.publish("dev/test/minhacasa/supervisorio", "ac2ambi_1");
   delay(500);
  }

  if ( readString.indexOf("all_acesso_off") >= 0)
  {
   ac1teto = 0;
   ac2teto = 0;
   ac2ambi = 0;
   reles.SetRelay(6, DesligarRele, 5); // num rele, modo, num modulo
   reles.SetRelay(7, DesligarRele, 5); // num rele, modo, num modulo
   reles.SetRelay(8, DesligarRele, 5); // num rele, modo, num modulo    
   client.publish("dev/test/minhacasa/supervisorio", "acesso1_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "acesso2_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "ac2ambi_0");
   delay(200);
  }
  
} // Fecha o void acesso
