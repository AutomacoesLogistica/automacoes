<?php
echo 'Iniciado </BR>';
$curl = curl_init();
##$epc = "442002000000000000001216"; 

$epc=isset($_GET['epc'])?$_GET['epc']:'0';

if($epc != '0')
{


$curl = curl_init();
  curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate='.$epc,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'GET',
   CURLOPT_HTTPHEADER => array(
    'Authorization: Basic c2VydmljZV9hcGlfc2NoZWR1bGU6TWluQDMyMU1pbkA='
   ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  //echo $response;

  if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
  {
   echo "Verificar!";
  }
  else
  {

  }
//TRATO OS DADOS DO VEICULO
$jsonObj = json_decode($response);

$jsonObj2 = $jsonObj->scheduleDetail;
$statusProcesso = $jsonObj2->statusProcesso;
$material = $jsonObj2->material;
$idProcessoGagf = $jsonObj2->idProcessoGagf;
$idProcessoGscs = $jsonObj2->idProcessoGscs;
$origem = $jsonObj2->origem;
$destino = $jsonObj2->destino;
$nome_completo = $jsonObj2->nome;
$nome_reduzido = explode(" ",$nome_completo);
$nome_reduzido = $nome_reduzido[0];
$n_sap = $jsonObj2->ticket;
$placaCarreta =  $jsonObj2->placaCarreta;
$placaCavalo =  $jsonObj2->placaCavalo;
$n_transportadora = $jsonObj2->transportadoraCarreta;



  //echo $response;
  echo ("</BR></BR></BR></BR>");
  echo($statusProcesso);
  echo("</BR>");
  echo($nome_completo);
  echo("</BR>");
  echo($nome_reduzido);
  echo("</BR>");
  echo($material);
  echo("</BR>");
  echo($idProcessoGagf);
  echo("</BR>");
  echo($idProcessoGagf);
  echo("</BR>");
  echo($destino);
  echo("</BR>");
  echo($placaCarreta);
  echo("</BR>");
  echo($placaCavalo);
  
}
else
{
 echo "Faltam dados!"; 
}
?>