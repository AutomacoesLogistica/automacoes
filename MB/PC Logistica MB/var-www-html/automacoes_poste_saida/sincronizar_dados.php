<?php
$id = isset($_GET['id'])?$_GET['id']:'vazio';

if($id != 'vazio')
{
 include_once 'conexao.php';   
 $sql = $dbcon->query("SELECT * FROM sincronizar_dados WHERE id='$id'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array(); 
  $id_lidar = $dados['id_lidar'];
  $id_cheio_vazio = $dados['id_cheio_vazio'];
  $id_historico = $dados['id_historico'];
  $epc_carreta = $dados['epc_carreta'];
  $placa_carreta = $dados['placa_carreta'];
  $epc_cavalo = $dados['epc_cavalo'];
  $placa_cavalo = $dados['placa_cavalo'];
  $veiculo = $dados['veiculo'];
  $condicao_lidar = $dados['condicao_veiculo'];
  $api_lidar = $dados['api_cheio_vazio'];
  $data_leitura = $dados['data_leitura'];
  $dia = $dados['dia'];
  $mes = $dados['mes'];
  $ano = $dados['ano'];
  $hora_leitura = $dados['hora_leitura'];
  $condicao = $dados['condicao']; 
  $dlc = $dados['dlc'];
  $dtc = $dados['dtc'];
  $alerta2 = $dados['alerta2']; 
 }

 if($condicao_veiculo == 'Cheia')
 {
  $condicao_veiculo = '(L) Saindo Cheia!';  
 }
 else if($condicao_veiculo == 'Vazia')
 {
  $condicao_veiculo = '(L) Saindo Vazia!';  
 }
 else
 {
  $condicao_veiculo = '-';  
 }

 if($veiculo == '' || $veiculo == ' ')
 {
  $veiculo = '-';  
 }



 if($placa_cavalo =="" || $placa_cavalo == " " || $placa_cavalo == '-')
 {
  //busco no gagf passando $epc_carreta
  $curl = curl_init();
  $epc = $epc_carreta; 
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
  echo $response;
  //TRATO OS DADOS DO VEICULO
  $jsonObj = json_decode($response);
  $jsonObj2 = $jsonObj->scheduleDetail;
  $placa_cavalo =  $jsonObj2->placaCavalo;
  $placa_carreta =  $jsonObj2->placaCarreta;
  $n_transportadora = $jsonObj2->transportadoraCarreta;
  
  //Agora atualizo historico_display
  if($id_historico != '-' && $id_historico != " ")
  {
   $sql = $dbcon->query("UPDATE historico_display SET placa_cavalo = '$placa_cavalo',placa_carreta='$placa_carreta' WHERE id='$id_historico'");
  }
 }
 




 
 //Agora atualizo o dado desse evento como foi tratado
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 include_once 'conexao.php'; 
 $sql = $dbcon->query("UPDATE sincronizar_dados SET condicao='Tratado',data_tratado='$data',hora_tratado='$hora' WHERE id='$id'");
 
 
 //Atualizo no banco de dados lidar
 if($id_lidar !='' && $id_lidar != '-')
 {
  include_once 'conexao_sva.php';   
  $sql = $dbcon->query("UPDATE dados_api_lidar SET id_cheio_vazio='$id_cheio_vazio',id_historico_display='$id_historico',placa_cavalo = '$placa_cavalo',placa_carreta='$placa_carreta' WHERE id='$id_lidar'");
 }

 if($id_cheio_vazio != '' && $id_cheio_vazio !='-')
 {
  //Atualizo tudo no PC sala logistica atualizando dados do math la tambem!
  include_once 'conexao_cheio_vazio.php';
  $sql = $dbcon->query("UPDATE deteccao SET id_lidar='$id_lidar',dlc='$dlc',dtc='$dtc',alerta2='$alerta2',id_historico_display='$id_historico',tratado_automacao='Sim',epc_carreta='$epc_carreta',placa_carreta='$placa_carreta',epc_cavalo='$epc_cavalo',placa_cavalo='$placa_cavalo',veiculo = '$veiculo',condicao_lidar='$condicao_lidar' WHERE id='$id_cheio_vazio'");
 }




}
else
{
 echo 'Favor informar o id!';   
}























?>