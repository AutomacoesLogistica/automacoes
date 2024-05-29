void quartoc()
{

  if ( readString.indexOf("quartocasal_1") >= 0)
  {
    qcteto = 1;
    reles.SetRelay(2, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "quartocasal_1");
  }
  if ( readString.indexOf("quartocasal_0") >= 0 )
  {
    qcteto = 0;
    reles.SetRelay(2, DesligarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "quartocasal_0");
  }

  if ( readString.indexOf("lamp_quartoc") >= 0)
  {
    intertrava = 0;
    if (qcteto == 0 && intertrava == 0)
    {
      qcteto = 1;
      intertrava = 1;
      reles.SetRelay(2, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "quartocasal_1");
    }
    if (qcteto == 1 && intertrava == 0)
    {
      qcteto = 0;
      intertrava = 1;
      reles.SetRelay(2, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "quartocasal_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("qcpainel_1") >= 0)
  {
    qcpainel = 1;
    reles.SetRelay(3, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "qcpainel_1");
  }
  if ( readString.indexOf("qcpainel_0") >= 0 )
  {
    qcpainel = 0;
    reles.SetRelay(3, DesligarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "qcpainel_0");
  }

  if ( readString.indexOf("amb_quartoc") >= 0)
  {
    intertrava = 0;
    if (qcpainel == 0 && intertrava == 0)
    {
      qcpainel = 1;
      intertrava = 1;
      reles.SetRelay(3, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "qcpainel_1");
    }
    if (qcpainel == 1 && intertrava == 0)
    {
      qcpainel = 0;
      intertrava = 1;
      reles.SetRelay(3, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "qcpainel_0");
    }
  }

  // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("qccorti_1") >= 0)
  {
    qccorti = 1;
    reles.SetRelay(4, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "qccorti_1");
  }
  if ( readString.indexOf("qccorti_0") >= 0 )
  {
    qccorti = 0;
    reles.SetRelay(4, DesligarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "qccorti_0");
  }

  if ( readString.indexOf("lam_cor_qc") >= 0)
  {
    intertrava = 0;
    if (qccorti == 0 && intertrava == 0)
    {
      qccorti = 1;
      intertrava = 1;
      reles.SetRelay(4, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "qccorti_1");
    }
    if (qccorti == 1 && intertrava == 0)
    {
      qccorti = 0;
      intertrava = 1;
      reles.SetRelay(4, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "qccorti_0");
    }
  }

 // ***************************************************************************************************************************************************************************************

  if ( readString.indexOf("qcpendente_1") >= 0)
  {
    qcpendente = 1;
    reles.SetRelay(6, LigarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "qcpendente_1");
  }
  if ( readString.indexOf("qcpendente_0") >= 0 )
  {
    qcpendente = 0;
    reles.SetRelay(6, DesligarRele, 3); // num rele, modo, num modulo
    client.publish("dev/test/minhacasa/supervisorio", "qcpendente_0");
  }

  if ( readString.indexOf("pendente_qc") >= 0)
  {
    intertrava = 0;
    if (qcpendente == 0 && intertrava == 0)
    {
      qcpendente = 1;
      intertrava = 1;
      reles.SetRelay(6, LigarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "qcpendente_1");
    }
    if (qcpendente == 1 && intertrava == 0)
    {
      qcpendente = 0;
      intertrava = 1;
      reles.SetRelay(6, DesligarRele, 3); // num rele, modo, num modulo
      client.publish("dev/test/minhacasa/supervisorio", "qcpendente_0");
    }
  }
 




  

  if ( readString.indexOf("all_quartoc_on") >= 0)
  {
   qcteto = 1;
   qcpainel = 1;
   qccorti = 1;
   qcpendente = 1;
   reles.SetRelay(2, LigarRele, 3); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "quartocasal_1");
   delay(500);
   reles.SetRelay(3, LigarRele, 3); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "qcpainel_1");   
   delay(500);
   reles.SetRelay(4, LigarRele, 3); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "qccorti_1");
   delay(500);
   reles.SetRelay(6, LigarRele, 3); // num rele, modo, num modulo
   client.publish("dev/test/minhacasa/supervisorio", "qcpendente_1");
   delay(500);
  }

  if ( readString.indexOf("all_quartoc_off") >= 0)
  {
   qcteto = 0;
   qcpainel = 0;
   qccorti = 0;
   qcpendente = 0;
   reles.SetRelay(2, DesligarRele, 3); // num rele, modo, num modulo
   reles.SetRelay(3, DesligarRele, 3); // num rele, modo, num modulo
   reles.SetRelay(4, DesligarRele, 3); // num rele, modo, num modulo
   reles.SetRelay(6, DesligarRele, 3); // num rele, modo, num modulo
      
   client.publish("dev/test/minhacasa/supervisorio", "quartocasal_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "qcpainel_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "qccorti_0");
   delay(200);
   client.publish("dev/test/minhacasa/supervisorio", "qcpendente_1");
   delay(200);
  }
  
} // Fecha void quartoc
