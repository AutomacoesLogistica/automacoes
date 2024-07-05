<?php
$encontrado = 0;
include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM lista_amostragem ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $epc = $dados['epc'];
 $data_lista = $dados['data_lista'];
 $hora_lista = $dados['hora_lista'];
 $encontrado = 1;
}// fecha o if


if($encontrado == 1)
{
 echo $epc;
}
else
{
  echo "erro";  
}
http_response_code(200);
?>

