void banheiro_social()
{
  
  if ( readString.indexOf("banhsocial_1") >= 0)
  {
    soteto = 1;
    reles.SetRelay(8, LigarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "banhsocial_1");
  }
  if ( readString.indexOf("banhsocial_0") >= 0 )
  {
    soteto = 0;
    reles.SetRelay(8, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "banhsocial_0");
  }

  if ( readString.indexOf("l_ban_soci") >= 0)
  {
    intertrava = 0;
    if (soteto == 0 && intertrava == 0)
    {
      soteto = 1;
      intertrava = 1;
      reles.SetRelay(8, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "banhsocial_1");
    }
    if (soteto == 1 && intertrava == 0)
    {
      soteto = 0;
      intertrava = 1;
      reles.SetRelay(8, DesligarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "banhsocial_0");
    }
  }

 
  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("soesp_1") >= 0)
  {
    soesp = 1;
    reles.SetRelay(1, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "soesp_1");
  }
  if ( readString.indexOf("soesp_0") >= 0 )
  {
    soesp = 0;
    reles.SetRelay(1, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "soesp_0");
  }

  if ( readString.indexOf("esp_ban_soci") >= 0)
  {
    intertrava = 0;
    if (soesp == 0 && intertrava == 0)
    {
      soesp = 1;
      intertrava = 1;
      reles.SetRelay(1, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "soesp_1");
    }
    if (soesp == 1 && intertrava == 0)
    {
      soesp = 0;
      intertrava = 1;
      reles.SetRelay(1, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "soesp_0");
    }
  }
 
  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("soambi_1") >= 0)
  {
    soambi = 1;
    reles.SetRelay(2, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "soambi_1");
  }
  if ( readString.indexOf("soambi_0") >= 0 )
  {
    soambi = 0;
    reles.SetRelay(2, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "soambi_0");
  }

  if ( readString.indexOf("amb_ban_soci") >= 0)
  {
    intertrava = 0;
    if (soambi == 0 && intertrava == 0)
    {
      soambi = 1;
      intertrava = 1;
      reles.SetRelay(2, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "soambi_1");
    }
    if (soambi == 1 && intertrava == 0)
    {
      soambi = 0;
      intertrava = 1;
      reles.SetRelay(2, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "soambi_0");
    }
  }
  
  if ( readString.indexOf("all_bansoci_on") >= 0)
  {
   soteto = 1;
   soesp = 1;
   soambi = 1;
   reles.SetRelay(8, LigarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "banhsocial_1");
   delay(500);
   reles.SetRelay(1, LigarRele, 5); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "soesp_1");
   delay(500);
   reles.SetRelay(2, LigarRele, 5); // num rele, modo, num modulo    
   client.publish("dev/test/minhacasa/supervisorio", "soambi_1");
   delay(500);
  }
  
  if ( readString.indexOf("all_bansoci_off") >= 0)
  {
   soteto = 0;
   soesp = 0;
   soambi = 0;
   reles.SetRelay(8, DesligarRele, 4); // num rele, modo, num modulo
   reles.SetRelay(1, DesligarRele, 5); // num rele, modo, num modulo
   reles.SetRelay(2, DesligarRele, 5); // num rele, modo, num modulo    
   client.publish("dev/test/minhacasa/supervisorio", "banhsocial_0");
   delay(500);
   client.publish("dev/test/minhacasa/supervisorio", "soesp_0");
   delay(500);
   client.publish("dev/test/minhacasa/supervisorio", "soambi_0");
   delay(500);
  }

} // Fecha void banheiro_social
