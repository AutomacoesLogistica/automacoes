void espacogourmet()
{

  if ( readString.indexOf("espgourmet_1") >= 0)
  {
    egteto = 1;
    reles.SetRelay(8, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet_1");
  }
  if ( readString.indexOf("espgourmet_0") >= 0 )
  {
    egteto = 0;
    reles.SetRelay(8, DesligarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet_0");
  }

  if ( readString.indexOf("teto_gourmet") >= 0 ||  readString.indexOf("espgour1") >= 0)
  {
    intertrava = 0;
    if (egteto == 0 && intertrava == 0)
    {
      egteto = 1;
      intertrava = 1;
      reles.SetRelay(8, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "espgourmet_1");
    }
    if (egteto == 1 && intertrava == 0)
    {
      egteto = 0;
      intertrava = 1;
      reles.SetRelay(8, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "espgourmet_0");
    }
  }

    // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("egpendente_1") >= 0)
  {
    egpendente = 1;
    reles.SetRelay(1, LigarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "egpendente_1");
  }
  if ( readString.indexOf("egpendente_0") >= 0 )
  {
    egpendente = 0;
    reles.SetRelay(1, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "egpendente_0");
  }

  if ( readString.indexOf("pend_gourmet") >= 0 ||  readString.indexOf("espgour2") >= 0)
  {
    intertrava = 0;
    if (egpendente == 0 && intertrava == 0)
    {
      egpendente = 1;
      intertrava = 1;
      reles.SetRelay(1, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "egpendente_1");
    }
    if (egpendente == 1 && intertrava == 0)
    {
      egpendente = 0;
      intertrava = 1;
      reles.SetRelay(1, DesligarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "egpendente_0");
    }
  }


  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("egchurras_1") >= 0)
  {
    egchurras = 1;
    reles.SetRelay(2, LigarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "egchurras_1");
  }
  if ( readString.indexOf("egchurras_0") >= 0 )
  {
    egchurras = 0;
    reles.SetRelay(2, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "egchurras_0");
  }

  if ( readString.indexOf("chur_gourmet") >= 0||  readString.indexOf("espgour3") >= 0)
  {
    intertrava = 0;
    if (egchurras == 0 && intertrava == 0)
    {
      egchurras = 1;
      intertrava = 1;
      reles.SetRelay(2, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "egchurras_1");
    }
    if (egchurras == 1 && intertrava == 0)
    {
      egchurras = 0;
      intertrava = 1;
      reles.SetRelay(2, DesligarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "egchurras_0");
    }
  }
 
 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("egpersi_1") >= 0)
  {
    egpersi = 1;
    reles.SetRelay(3, LigarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "egpersi_1");
  }
  if ( readString.indexOf("egpersi_0") >= 0 )
  {
    egpersi = 0;
    reles.SetRelay(3, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "egpersi_0");
  }

  if ( readString.indexOf("lam_per_eg") >= 0)
  {
    intertrava = 0;
    if (egpersi == 0 && intertrava == 0)
    {
      egpersi = 1;
      intertrava = 1;
      reles.SetRelay(3, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "egpersi_1");
    }
    if (egpersi == 1 && intertrava == 0)
    {
      egpersi = 0;
      intertrava = 1;
      reles.SetRelay(3, DesligarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "egpersi_0");
    }
  }
 
  
  
  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("espgourmet2_1") >= 0)
  {
    egteto2 = 1;
    reles.SetRelay(4, LigarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_1");
  }
  if ( readString.indexOf("espgourmet2_0") >= 0 )
  {
    egteto2 = 0;
    reles.SetRelay(4, DesligarRele, 4); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_0");
  }

  if ( readString.indexOf("lam_lav_eg") >= 0 ||  readString.indexOf("espgour4") >= 0)
  {
    intertrava = 0;
    if (egteto2 == 0 && intertrava == 0)
    {
      egteto2 = 1;
      intertrava = 1;
      reles.SetRelay(4, LigarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_1");
    }
    if (egteto2 == 1 && intertrava == 0)
    {
      egteto2 = 0;
      intertrava = 1;
      reles.SetRelay(4, DesligarRele, 4); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_0");
    }
  }

  if ( readString.indexOf("all_espgour_on") >= 0)
  {
   egteto = 1;
   egpendente = 1;
   egchurras = 1;
   egpersi = 1;
   egteto2 = 1;
   reles.SetRelay(8, LigarRele, 3); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "espgourmet_1");
   delay(500);
   reles.SetRelay(1, LigarRele, 4); // num rele, modo, num modulo    
   client.publish("dev/test/minhacasa/supervisorio", "egpendente_1");
   delay(500);
   reles.SetRelay(2, LigarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "egchurras_1");
   delay(500);
   reles.SetRelay(3, LigarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "egpersi_1");
   delay(500);
   reles.SetRelay(4, LigarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_1");
   delay(500);
  }

  if ( readString.indexOf("all_espgour_off") >= 0)
  {
   egteto = 0;
   egpendente = 0;
   egchurras = 0;
   egpersi = 0;
   egteto2 = 0;
   reles.SetRelay(8, DesligarRele, 3); // num rele, modo, num modulo
   reles.SetRelay(1, DesligarRele, 4); // num rele, modo, num modulo    
   reles.SetRelay(2, DesligarRele, 4); // num rele, modo, num modulo
   reles.SetRelay(3, DesligarRele, 4); // num rele, modo, num modulo
   reles.SetRelay(4, DesligarRele, 4); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "espgourmet_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "egpendente_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "egchurras_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "egpersi_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "espgourmet2_0");
   delay(200);
  }
} // Fecha void espacogourmet
