void closet()
{

  if ( readString.indexOf("closet_1") >= 0)
  {
    clteto = 1;
    reles.SetRelay(5, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "closet_1");
  }
  if ( readString.indexOf("closet_0") >= 0 )
  {
    clteto = 0;
    reles.SetRelay(5, DesligarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "closet_0");
  }

  if ( readString.indexOf("lamp_closet") >= 0)
  {
    intertrava = 0;
    if (clteto == 0 && intertrava == 0)
    {
      clteto = 1;
      intertrava = 1;
      reles.SetRelay(5, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "closet_1");
    }
    if (clteto == 1 && intertrava == 0)
    {
      clteto = 0;
      intertrava = 1;
      reles.SetRelay(5, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "closet_0");
    }
  }

 
 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("clesp_1") >= 0)
  {
    clesp = 1;
    reles.SetRelay(7, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "clesp_1");
  }
  if ( readString.indexOf("clesp_0") >= 0 )
  {
    clesp = 0;
    reles.SetRelay(7, DesligarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "clesp_0");
  }

  if ( readString.indexOf("espe_closet") >= 0)
  {
    intertrava = 0;
    if (clesp == 0 && intertrava == 0)
    {
      clesp = 1;
      intertrava = 1;
      reles.SetRelay(7, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "clesp_1");
    }
    if (clesp == 1 && intertrava == 0)
    {
      clesp = 0;
      intertrava = 1;
      reles.SetRelay(7, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "clesp_0");
    }
  }

  if ( readString.indexOf("all_closet_on") >= 0)
  {
   clteto = 1;
   clesp = 1;
   reles.SetRelay(5, LigarRele, 3); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "closet_1");
   delay(500);
   reles.SetRelay(7, LigarRele, 3); // num rele, modo, num modulo  
   client.publish("dev/test/minhacasa/supervisorio", "clesp_1");
   delay(500);
  }

  if ( readString.indexOf("all_closet_off") >= 0)
  {
   clteto = 0;
   clesp = 0;
   reles.SetRelay(5, DesligarRele, 3); // num rele, modo, num modulo
   reles.SetRelay(7, DesligarRele, 3); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "closet_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "clesp_0");
   delay(200);
  }

    
} // Fecha void closet
