<?php
$encontrado = 0;
include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM configuracoes_amostragem ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $semaforo = $dados['semaforo'];
 $encontrado = 1;
}// fecha o if


if($encontrado == 1)
{
 echo $semaforo;
}
else
{
  echo "erro";  
}
http_response_code(200);
?>

