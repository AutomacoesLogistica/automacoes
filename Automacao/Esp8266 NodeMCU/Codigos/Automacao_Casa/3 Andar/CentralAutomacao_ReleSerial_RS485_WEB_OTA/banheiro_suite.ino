void banheiro_suite()
{
  
  if ( readString.indexOf("banhsuite_1") >= 0)
  {
    suteto = 1;
    reles.SetRelay(3, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "banhsuite_1");
  }
  if ( readString.indexOf("banhsuite_0") >= 0 )
  {
    suteto = 0;
    reles.SetRelay(3, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "banhsuite_0");
  }

  if ( readString.indexOf("lam_banh_c") >= 0)
  {
    intertrava = 0;
    if (suteto == 0 && intertrava == 0)
    {
      suteto = 1;
      intertrava = 1;
      reles.SetRelay(3, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "banhsuite_1");
    }
    if (suteto == 1 && intertrava == 0)
    {
      suteto = 0;
      intertrava = 1;
      reles.SetRelay(3, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "banhsuite_0");
    }
  }

 

  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("suesp_1") >= 0)
  {
    suesp = 1;
    reles.SetRelay(4, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "suesp_1");
  }
  if ( readString.indexOf("suesp_0") >= 0 )
  {
    suesp = 0;
    reles.SetRelay(4, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "suesp_0");
  }

  if ( readString.indexOf("esp_banh_c") >= 0)
  {
    intertrava = 0;
    if (suesp == 0 && intertrava == 0)
    {
      suesp = 1;
      intertrava = 1;
      reles.SetRelay(4, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "suesp_1");
    }
    if (suesp == 1 && intertrava == 0)
    {
      suesp = 0;
      intertrava = 1;
      reles.SetRelay(4, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "suesp_0");
    }
  }

  
  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("suambi_1") >= 0)
  {
    suambi = 1;
    reles.SetRelay(5, LigarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "suambi_1");
  }
  if ( readString.indexOf("suambi_0") >= 0 )
  {
    suambi = 0;
    reles.SetRelay(5, DesligarRele, 5); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "suambi_0");
  }

  if ( readString.indexOf("amb_ban_c") >= 0)
  {
    intertrava = 0;
    if (suambi == 0 && intertrava == 0)
    {
      suambi = 1;
      intertrava = 1;
      reles.SetRelay(5, LigarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "suambi_1");
    }
    if (suambi == 1 && intertrava == 0)
    {
      suambi = 0;
      intertrava = 1;
      reles.SetRelay(5, DesligarRele, 5); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "suambi_0");
    }
  }

  if ( readString.indexOf("all_bansui_on") >= 0)
  {
   suteto = 1;
   suesp = 1;
   suambi = 1;
   reles.SetRelay(3, LigarRele, 5); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "banhsuite_1");
   delay(500);
   reles.SetRelay(4, LigarRele, 5); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "suesp_1");
   delay(500);
   reles.SetRelay(5, LigarRele, 5); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "suambi_1");
   delay(500);
  }
  
  if ( readString.indexOf("all_bansui_off") >= 0)
  {
   suteto = 0;
   suesp = 0;
   suambi = 0;
   reles.SetRelay(3, DesligarRele, 5); // num rele, modo, num modulo
   reles.SetRelay(4, DesligarRele, 5); // num rele, modo, num modulo
   reles.SetRelay(5, DesligarRele, 5); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "banhsuite_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "suesp_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "suambi_0");
   delay(200);
  } 
} // Fecha o void banheiro_suite
