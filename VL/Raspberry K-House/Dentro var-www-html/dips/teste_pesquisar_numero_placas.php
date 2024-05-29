<?php
date_default_timezone_set('America/Sao_Paulo');
$data1 = date('d/m/Y');
$data = isset($_GET['data'])?$_GET['data']:$data1;


//Primeiro busco as 10 ultimas tags no banco
$encontrado_placas = 0;
$epcs = array();

include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM validacoes_feitas2 WHERE data_validacao='$data'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  $v_epc = trim($dados['placa_ou_tag']);
  $v_epc = trim($v_epc);
  if (in_array($v_epc, $epcs))
  { 
   //echo "Tem a tag, nao pode salvar!";
   //echo 'nao pode';
  }
  else
  {
   //echo ' Nao tem a tag, pode salvar!';  
   //Insere no array e conta quantas tags tem no dia!
   
   array_push($epcs,trim($v_epc));
   $encontrado_placas = intval($encontrado_placas)+1;
  }   
 
  



 } 
}

echo 'Encontrados : ' . $encontrado_placas;
echo '</BR>';echo '</BR>';
for ($x = 0; $x < intval($encontrado_placas); $x++) 
{
 echo "Valor " . $x. "  - EPC = " . $epcs[$x]." <br>";
}


?>