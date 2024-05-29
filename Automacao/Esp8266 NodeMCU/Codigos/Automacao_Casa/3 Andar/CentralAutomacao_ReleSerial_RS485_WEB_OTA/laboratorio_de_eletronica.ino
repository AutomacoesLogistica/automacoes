void laboratorio()
{

  if ( readString.indexOf("laboratorio_1") >= 0)
  {
    lbteto = 1;
    reles.SetRelay(5, LigarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "laboratorio_1");
  }
  if ( readString.indexOf("laboratorio_0") >= 0 )
  {
    lbteto = 0;
    reles.SetRelay(5, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "laboratorio_0");
  }

  if ( readString.indexOf("teto_labora") >= 0)
  {
    intertrava = 0;
    if (lbteto == 0 && intertrava == 0)
    {
      lbteto = 1;
      intertrava = 1;
      reles.SetRelay(5, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "laboratorio_1");
    }
    if (lbteto == 1 && intertrava == 0)
    {
      lbteto = 0;
      intertrava = 1;
      reles.SetRelay(5, DesligarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "laboratorio_0");
    }
  }

 

  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("lbpersi_1") >= 0)
  {
      lbpersi = 1;
      reles.SetRelay(6, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "lbpersi_1");
  }
  if ( readString.indexOf("lbpersi_0") >= 0 )
  {
    lbpersi = 0;
    reles.SetRelay(6, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "lbpersi_0");
  }

  if ( readString.indexOf("lam_per_lb") >= 0)
  {
    intertrava = 0;
    if (lbpersi == 0 && intertrava == 0)
    {
      lbpersi = 1;
      intertrava = 1;
      reles.SetRelay(6, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "lbpersi_1");
    }
    if (lbpersi == 1 && intertrava == 0)
    {
      lbpersi = 0;
      intertrava = 1;
      reles.SetRelay(6, DesligarRele, 4); // num rele, modo, num modulo
     client.publish("dev/test/minhacasa/supervisorio", "lbpersi_0");
    }
  }

  
  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("lbventi_1") >= 0)
  {
    lbventi = 1;
    reles.SetRelay(7, LigarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "lbventi_1");
  }
  if ( readString.indexOf("lbventi_0") >= 0 )
  {
    lbventi = 0;
    reles.SetRelay(7, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "lbventi_0");
  }

  if ( readString.indexOf("vent_labora") >= 0)
  {
    intertrava = 0;
    if (lbventi == 0 && intertrava == 0)
    {
      lbventi = 1;
      intertrava = 1;
      reles.SetRelay(7, LigarRele, 4); // num rele, modo, num modulo
     client.publish("dev/test/minhacasa/supervisorio", "lbventi_1");
    }
    if (lbventi == 1 && intertrava == 0)
    {
      lbventi = 0;
      intertrava = 1;
      reles.SetRelay(7, DesligarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "lbventi_0");
    }
  }
  
  if ( readString.indexOf("all_lab_on") >= 0)
  {
   lbteto = 1;
   lbpersi = 1;
   lbventi = 1;
   reles.SetRelay(5, LigarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "laboratorio_1");
   delay(500);
   reles.SetRelay(6, LigarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "lbpersi_1");
   delay(500);
   reles.SetRelay(7, LigarRele, 4); // num rele, modo, num modulo  
   client.publish("dev/test/minhacasa/supervisorio", "lbventi_1");
   delay(500);
  }

  if ( readString.indexOf("all_lab_off") >= 0)
  {
   lbteto = 0;
   lbpersi = 0;
   lbventi = 0;
   reles.SetRelay(5, DesligarRele, 4); // num rele, modo, num modulo
   reles.SetRelay(6, DesligarRele, 4); // num rele, modo, num modulo
   reles.SetRelay(7, DesligarRele, 4); // num rele, modo, num modulo  
   client.publish("dev/test/minhacasa/supervisorio", "laboratorio_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "lbpersi_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "lbventi_0");
   delay(200);  
  }

} // Fecha o void laboratorio
