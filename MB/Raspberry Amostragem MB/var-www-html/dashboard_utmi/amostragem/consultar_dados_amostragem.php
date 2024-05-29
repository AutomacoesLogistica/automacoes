<?php

date_default_timezone_set('America/Sao_Paulo');
$data_leitura = date('d/m/Y');
$hora_leitura = date('H:i:s');

$dia = (substr($data_leitura,0,2));
$mes = (substr($data_leitura,3,2)); // extrai o mes atual
$ano = (substr($data_leitura,6,4)); // extrai o ano atual

$hora = (substr($hora_leitura,0,2)); 

$tabela_consulta = "lista_turno_dashboard_".$ano."_amostragem";
$turno = '-';
$sigla = '-';
$turno1 = '';
$turno2 = '';
$turno3 = '';


//Busco o turno 
include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM $tabela_consulta WHERE data='$data_leitura'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $turno1 = $dados['turno1'];
 $turno2 = $dados['turno2'];
 $turno3 = $dados['turno3'];
}

if(intval($hora)>=0 && intval($hora)<8) // 00 as 08
{
 $turno = $turno1;
}
else if(intval($hora)>=8 && intval($hora)<17) // 08 as 17
{
  $turno = $turno2;
}
else
{
  //Turno3  17 as 23
  $turno = $turno3;
}

if($turno == '')
{
  $turno = 'X'; //Nao identificado!
}

 // BUSCO A ULTIMA EPC LIDA EM ESPERA
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("SELECT * FROM lista_amostragem ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $epc_salvar = $dados['epc'];
  $tratado = $dados['tratado'];
 }



$curl = curl_init();

//$epc=isset($_GET['epc'])?$_GET['epc']:'0';



$ultima_epc = '';

 // BUSCO O TURNO DE ACORDO COM A DATA E A HORA RECEBIDA DA LEITURA
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("SELECT * FROM configuracoes_amostragem WHERE id=1");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $ultima_epc = $dados['ultima_epc'];
 }

if($epc_salvar != $ultima_epc)
{
 $ultima_epc = $epc_salvar;







if($epc_salvar != '0')
{


$curl = curl_init();
  curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate='.$epc_salvar,
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
  echo "</BR>";

  if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
  {
   //echo "Verificar!";
   //echo "-;-;-;-;-";
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
$estoque = $jsonObj2->estoque;
$rota = $jsonObj2->rota;
$nome_completo = $jsonObj2->nome;
$nome_reduzido = explode(" ",$nome_completo);
$nome_reduzido = $nome_reduzido[0];
$n_sap = $jsonObj2->ticket;
$placaCarreta =  $jsonObj2->placaCarreta;
$placaCavalo =  $jsonObj2->placaCavalo;
$n_transportadora = $jsonObj2->transportadoraCarreta;

if($nome_completo == "")
{
  $nome_completo = "Não identificado!";
}

 if($destino == "" || $destino == "-")
 {
  $destino = $rota;
 }
 
 if($destino == "")
 {
  $destino = "Não identificado!";
 }

 if($material == "" || $material == "-")
 {
  $material = "Não identificado!";
 }

 if($estoque == "")
 {
  $estoque = "Não identificado!";
 }

 //Agora consulto a transportadora
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$n_transportadora'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $sigla = $dados['sigla'];
  }


  if($sigla == "-" || $sigla == "")
  {
    $sigla = "Não identificado!";
  }


  if($placaCarreta == "")
  {
    $placaCarreta = "-";
  }

  if($statusProcesso == "")
  {
    $statusProcesso = '-';
  }

  //echo $response;
  
  
  
  /*
  echo ("</BR></BR></BR></BR>");
  echo($nome_completo);
  echo("</BR>");
  echo($placaCarreta);
  echo("</BR>");
  echo($estoque);
  echo("</BR>");
  echo($material);
  echo("</BR>");
  echo($destino);
  echo("</BR>");
  */

  //Mensagem api
  //echo $nome_completo.";".$placaCarreta.";".$estoque.";".$material.";".$destino;
   


  //Atualizo no banco
  include_once 'conexao_amostragem.php';
  $sql = $dbcon->query("UPDATE configuracoes_amostragem SET nome='$nome_completo',placa='$placaCarreta',estoque='$estoque',material='$material', destino='$destino', ultima_epc='$epc_salvar' WHERE id=1");
  
  
  echo "</BR>";
  echo "EPC = " . $epc_salvar;
  echo "</BR>";
  echo "Placa = " . $placaCarreta;
  echo "</BR>";
  echo "Data leitura = " . $data_leitura;
  echo "</BR>";
  echo "Hora leitura = " . $hora_leitura;
  echo "</BR>";
  echo "Hora = " . $hora;
  echo "</BR>";
  echo "Dia = " . $dia;
  echo "</BR>";
  echo "Mes = " . $mes;
  echo "</BR>";
  echo "Ano = " . $ano;
  echo "</BR>";
  echo "Transportadora = " . $sigla;
  echo "</BR>";
  echo "Nome = " . $nome_completo;
  echo "</BR>";
  echo "Destino = " . $destino;
  echo "</BR>";
  echo "Material = " . $material;
  echo "</BR>";
  echo "Estoque = " . $estoque;
  echo "</BR>";
  echo "Turno = " . $turno;
  echo "</BR>";
  echo "</BR>";



  $array_epcs = [];
  $encontrado = 0;
  include_once 'conexao_amostragem.php';
  $sql = $dbcon->query("SELECT * FROM amostragem ORDER BY id DESC LIMIT 5");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   {
    $id = $dados['id'];
    $epc = $dados['epc'];
    array_push($array_epcs, $epc);
    $encontrado = intval($encontrado)+1;
   }
  }// fecha o if
  if(in_array($epc_salvar,$array_epcs, true))
  {
   //echo "nao_pode_salvar";
  }
  else
  {
   //echo "pode_salvar";
   //Tambem insiro em amostragem!
   include_once 'conexao_amostragem.php';
   $sql = $dbcon->query("INSERT INTO amostragem (epc,placa,data_leitura,hora_leitura,hora,dia,mes,ano,amostrado,tempo_gasto,nome,transportadora,destino,material,estoque,turno,status_processo)VALUES('$epc_salvar','$placaCarreta','$data_leitura','$hora_leitura','$hora','$dia','$mes','$ano','nao','0','$nome_completo','$sigla','$destino','$material','$estoque','$turno','$statusProcesso')");
   echo "ok";
  }

  





  //chamo a tela
  include_once 'conexao_amostragem.php';
  $sql = $dbcon->query("UPDATE configuracoes_amostragem SET tela='1' WHERE id=1");


}
else
{
 
 //echo "-;-;-;-;-"; 
 $nome_completo = "NÃO IDENTIFICADO!";
 $placaCarreta = "NÃO IDENTIFICADO!";
 $estoque = "NÃO IDENTIFICADO!";
 $material = "NÃO IDENTIFICADO!";
 $destino = "NÃO IDENTIFICADO!";
 
 
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("UPDATE configuracoes_amostragem SET nome='$nome_completo',placa='$placaCarreta',estoque='$estoque',material='$material', destino='$destino' WHERE id=1");
 echo "erro";
 }
}
else
{
  echo "ja_atualizado";
  

}



http_response_code(200);
?>