void sala()
{
  if ( readString.indexOf("sala_1") >= 0)
  {
    steto = 1;
    reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "sala_1");
   
  }

  if ( readString.indexOf("sala_0") >= 0 )
  {
    
    steto = 0;
    reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "sala_0");
  }
  if ( readString.indexOf("teto_sala") >= 0)
  {
    intertrava = 0;
    if (steto == 0 && intertrava == 0)
    {
      steto = 1;
      intertrava = 1;
      reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "sala_1");
    }
    if (steto == 1 && intertrava == 0)
    {
      steto = 0;
      intertrava = 1;
      reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "sala_0");
    }
  }

if ( readString.indexOf("slustre_1") >= 0)
  {
    slustre = 1;
    reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "slustre_1");
  }
  if ( readString.indexOf("slustre_0") >= 0 )
  {
    slustre = 0;
    reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "slustre_0");
  }

  if ( readString.indexOf("lustre_sala") >= 0)
  {
    intertrava = 0;
    if (slustre == 0 && intertrava == 0)
    {
      slustre = 1;
      intertrava = 1;
      reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "slustre_1");
    }
    if (slustre == 1 && intertrava == 0)
    {
      slustre = 0;
      intertrava = 1;
      reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "slustre_0");
    }
  }

  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("svaranda_1") >= 0)
  {
    svaranda = 1;
    reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "svaranda_1");
  }
  if ( readString.indexOf("svaranda_0") >= 0 )
  {
    svaranda = 0;
    reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "svaranda_0");
  }

  if ( readString.indexOf("varan_sala") >= 0)
  {
    intertrava = 0;
    if (svaranda == 0 && intertrava == 0)
    {
      svaranda = 1;
      intertrava = 1;
      reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "svaranda_1");
    }
    if (svaranda == 1 && intertrava == 0)
    {
      svaranda = 0;
      intertrava = 1;
      reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "svaranda_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("spainel_1") >= 0)
  {
    spainel = 1;
    reles.SetRelay(4, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "spainel_1");
  }
  if ( readString.indexOf("spainel_0") >= 0 )
  {
    spainel = 0;
    reles.SetRelay(4, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "spainel_0");
  }

  if ( readString.indexOf("amb_sala") >= 0)
  {
    intertrava = 0;
    if (spainel == 0 && intertrava == 0)
    {
      spainel = 1;
      intertrava = 1;
      reles.SetRelay(4, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "spainel_1");
    }
    if (spainel == 1 && intertrava == 0)
    {
      spainel = 0;
      intertrava = 1;
      reles.SetRelay(4, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "spainel_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("scorti_1") >= 0)
  {
    scorti = 1;
    reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "scorti_1");
  }
  if ( readString.indexOf("scorti_0") >= 0 )
  {
    scorti = 0;
    reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "scorti_0");
  }

  if ( readString.indexOf("lam_cor_sala") >= 0)
  {
    intertrava = 0;
    if (scorti == 0 && intertrava == 0)
    {
      scorti = 1;
      intertrava = 1;
      reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "scorti_1");
    }
    if (scorti == 1 && intertrava == 0)
    {
      scorti = 0;
      intertrava = 1;
      reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "scorti_0");
    }
  }

  if ( readString.indexOf("all_sala_on") >= 0)
  {
   steto = 1;
   slustre = 1;
   svaranda = 1;
   spainel = 1;
   scorti = 1;
   reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "sala_1");
   delay(500);
   reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "slustre_1");
   delay(500);
   reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "svaranda_1");
   delay(500);
   reles.SetRelay(4, LigarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "spainel_1");
   delay(500);
   reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "scorti_1");
   delay(500);
  }
 
  if ( readString.indexOf("all_sala_off") >= 0)
  {
   steto = 0;
   slustre = 0;
   svaranda = 0;
   spainel = 0;
   scorti = 0;
   reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(4, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
 
   client.publish("dev/test/minhacasa/supervisorio", "sala_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "slustre_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "svaranda_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "spainel_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "scorti_0");
   delay(200);
   
  } 
  
} // Fecha o void sala
