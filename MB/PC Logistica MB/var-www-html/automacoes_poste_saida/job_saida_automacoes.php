<?php
$id = isset($_GET['id'])?$_GET['id']:'vazio';


if($id != "vazio")
{
    include_once 'conexao.php';   
 $sql = $dbcon->query("SELECT * FROM historico_display WHERE id='$id'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $v_ponto = $dados['ponto'];
  $epc_cavalo = $dados['epc_cavalo'];
  $epc_carreta = $dados['epc_carreta'];
  $v_data =$dados['data_aqui1'];
  $v_hora =$dados['hora_aqui1'];
  $v_condicao = $dados['condicao1'];
  $v_tratado_por_segurpro = $dados['tratado_por_segurpro'];
  $v_tratado_por_ccl = $dados['tratado_por_ccl'];
  $v_gagf = $dados['gagf'];
  $v_gscs = $dados['gscs'];
  $v_destino = $dados['destino'];
  $v_motorista = $dados['motorista'];
  $v_material = $dados['material'];
 
 }

 //CONSULTO NO GAGF
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
echo($idProcessoGscs);
echo("</BR>");
echo($destino);
echo("</BR>");
echo($placaCarreta);
echo("</BR>");
echo($placaCavalo);




$mensagem = "vvvv " . $statusProcesso. " vvv"; // Nao retirar os vvvv

if(intval(strpos($mensagem,"Concluído"))>0)
{
 include_once 'conexao.php';   
 $valor_condicao = $statusProcesso . "</BR><b>JOB</b>";
 $sql = $dbcon->query("UPDATE historico_display SET condicao1='$valor_condicao' WHERE id='$id'");
 print "Encerrado via JOB";
}
else if(intval(strpos($mensagem,"Cancelado"))>0)
{
 if($v_gscs == "0")   
 {
    include_once 'conexao.php';   
    $valor_condicao = $statusProcesso . "</BR><b>JOB</b>";
    $sql = $dbcon->query("UPDATE historico_display SET condicao1='$valor_condicao' WHERE id='$id'");
   }
 else
 {
    include_once 'conexao.php';   
    $valor_condicao = "ATENÇÃO!</BR><b>JOB</b>";
    $sql = $dbcon->query("UPDATE historico_display SET condicao1='$valor_condicao',tratado_por_segurpro='Verificar!' WHERE id='$id'");
  
 }
 print "Encerrado via JOB";
}


else
{
 //print("Nao tem");
}





}
else
{
  print ("Insira um id valido!")  ;
}
