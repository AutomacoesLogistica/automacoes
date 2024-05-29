void cozinha()
{

  if ( readString.indexOf("cozinha_1") >= 0)
  {
    czteto = 1;
    reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "cozinha_1");
  }
  if ( readString.indexOf("cozinha_0") >= 0 )
  {
    czteto = 0;
    reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "cozinha_0");
  }

  if ( readString.indexOf("teto_cozinha") >= 0)
  {
    intertrava = 0;
    if (czteto == 0 && intertrava == 0)
    {
      czteto = 1;
      intertrava = 1;
      reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "cozinha_1");
    }
    if (czteto == 1 && intertrava == 0)
    {
      czteto = 0;
      intertrava = 1;
      reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "cozinha_0");
    }
  }

  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("czcorredor_1") >= 0)
  {
    czcorredor = 1;
    reles.SetRelay(5, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czcorredor_1");
  }
  if ( readString.indexOf("czcorredor_0") >= 0 )
  {
    czcorredor = 0;
    reles.SetRelay(5, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czcorredor_0");
  }

  if ( readString.indexOf("teto_corredo") >= 0)
  {
    intertrava = 0;
    if (czcorredor == 0 && intertrava == 0)
    {
      czcorredor = 1;
      intertrava = 1;
      reles.SetRelay(5, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czcorredor_1");
    }
    if (czcorredor == 1 && intertrava == 0)
    {
      czcorredor = 0;
      intertrava = 1;
      reles.SetRelay(5, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czcorredor_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("czpendente_1") >= 0)
  {
    czpendente = 1;
    reles.SetRelay(6, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czpendente_1");
  }
  if ( readString.indexOf("czpendente_0") >= 0 )
  {
    czpendente = 0;
    reles.SetRelay(6, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czpendente_0");
  }

  if ( readString.indexOf("pend_cozinha") >= 0)
  {
    intertrava = 0;
    if (czpendente == 0 && intertrava == 0)
    {
      czpendente = 1;
      intertrava = 1;
      reles.SetRelay(6, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpendente_1");
    }
    if (czpendente == 1 && intertrava == 0)
    {
      czpendente = 0;
      intertrava = 1;
      reles.SetRelay(6, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpendente_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("czpia_1") >= 0)
  {
    czpia = 1;
    reles.SetRelay(7, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czpia_1");
  }
  if ( readString.indexOf("czpia_0") >= 0 )
  {
    czpia = 0;
    reles.SetRelay(7, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czpia_0");
  }

  if ( readString.indexOf("amb_cozinha") >= 0)
  {
    intertrava = 0;
    if (czpia == 0 && intertrava == 0)
    {
      czpia = 1;
      intertrava = 1;
      reles.SetRelay(7, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpia_1");
    }
    if (czpia == 1 && intertrava == 0)
    {
      czpia = 0;
      intertrava = 1;
      reles.SetRelay(7, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpia_0");
    }
  }

 
  
  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("czpersi_1") >= 0)
  {
    czpersi = 1;
    reles.SetRelay(8, LigarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czpersi_1");
  }
  if ( readString.indexOf("czpersi_0") >= 0 )
  {
    czpersi = 0;
    reles.SetRelay(8, DesligarRele, 2); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czpersi_0");
  }

  if ( readString.indexOf("lam_per_coz") >= 0)
  {
    intertrava = 0;
    if (czpersi == 0 && intertrava == 0)
    {
      czpersi = 1;
      intertrava = 1;
      reles.SetRelay(8, LigarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpersi_1");
    }
    if (czpersi == 1 && intertrava == 0)
    {
      czpersi = 0;
      intertrava = 1;
      reles.SetRelay(8, DesligarRele, 2); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpersi_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("czpainel_1") >= 0)
  {
    czpainel = 1;
    reles.SetRelay(1, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "czpainel_1");
  }
  if ( readString.indexOf("czpainel_0") >= 0 )
  {
    czpainel = 0;
    reles.SetRelay(1, DesligarRele, 3); // num rele, modo, num modulo  
    client.publish("dev/test/minhacasa/supervisorio", "czpainel_0");
  }

  if ( readString.indexOf("amb_ptv_coz") >= 0)
  {
    intertrava = 0;
    if (czpainel == 0 && intertrava == 0)
    {
      czpainel = 1;
      intertrava = 1;
      reles.SetRelay(1, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpainel_1");
    }
    if (czpainel == 1 && intertrava == 0)
    {
      czpainel = 0;
      intertrava = 1;
      reles.SetRelay(1, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "czpainel_0");
    }
  }

  if ( readString.indexOf("all_cozinha_on") >= 0)
  {
   czteto = 1;
   czcorredor = 1;
   czpendente = 1;
   czpia = 1;
   czpersi = 1;
   czpainel = 1;
   reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "cozinha_1");
   delay(500);
   reles.SetRelay(5, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "czcorredor_1");
   delay(500);
   reles.SetRelay(6, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "czpendente_1");
   delay(500);
   reles.SetRelay(7, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "czpia_1");
   delay(500);
   reles.SetRelay(8, LigarRele, 2); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "czpersi_1");
   delay(500);
   reles.SetRelay(1, LigarRele, 3); // num rele, modo, num modulo  
   client.publish("dev/test/minhacasa/supervisorio", "czpainel_1");
   delay(500);
  }
  
  if ( readString.indexOf("all_cozinha_off") >= 0)
  {
   czteto = 0;
   czcorredor = 0;
   czpendente = 0;
   czpia = 0;
   czpersi = 0;
   czpainel = 0;
   reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
   reles.SetRelay(5, DesligarRele, 2); // num rele, modo, num modulo
   reles.SetRelay(6, DesligarRele, 2); // num rele, modo, num modulo
   reles.SetRelay(7, DesligarRele, 2); // num rele, modo, num modulo
   reles.SetRelay(8, DesligarRele, 2); // num rele, modo, num modulo
   reles.SetRelay(1, DesligarRele, 3); // num rele, modo, num modulo  
   client.publish("dev/test/minhacasa/supervisorio", "cozinha_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "czcorredor_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "czpendente_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "czpia_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "czpersi_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "czpainel_0");
   delay(200);
  }
  
} // Fecha void cozinha
