<?php
$bloqueia_echo = isset($_GET['bloqueia'])?$_GET['bloqueia']:0;
$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';

$conexao = "conexao.php";
$tabela = "validacoes_socket";

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

if($bloqueia_echo == 1)
{
 echo 'Iniciado </BR>';
}
 $curl = curl_init();
##$epc = "442002000000000000001216"; 

$epc=isset($_GET['epc'])?$_GET['epc']:'0';

if($epc != '0' && strlen($epc)== 24)
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
   include_once $conexao;
   $sql = $dbcon->query("UPDATE $tabela SET api_erro = 'Sim', data_tratado='$data', hora_tratado='$hora',condicao2='-',saindo='-'  WHERE (epc_carreta='$epc' AND data_tratado = '-')");
  }
  else
  {

 
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

if($bloqueia_echo == 1)
{

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
  } // Fecha o bloqueia_echo

  include_once $conexao;
  if($statusProcesso == "Concluído" || $statusProcesso == "Concluido" || $statusProcesso == "Pendente de Pesagem" || $statusProcesso == "Cancelado" || $statusProcesso == "Pendente de Tara" || $statusProcesso == "Saindo da Planta")
  {
    $concluido2 = "Alerta!";
  }
  else
  {
   $concluido2 = $statusProcesso; 
  }

  $sql = $dbcon->query("UPDATE $tabela SET api_erro = 'Nao', data_tratado='$data', hora_tratado='$hora',concluido2='$concluido2', saindo='-' WHERE (epc_carreta='$epc' AND data_tratado = '-')"); 
} // Fecha else if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
 
} // Fecha else if($epc != '0')
else
{
 echo "Faltam dados!"; 
}
?>