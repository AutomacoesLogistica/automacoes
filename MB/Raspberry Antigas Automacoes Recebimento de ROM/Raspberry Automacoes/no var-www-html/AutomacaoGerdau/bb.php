<?php
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');


include_once 'conexao_sva.php';
$sql = $dbcon->query("SELECT * FROM cheio_vazio WHERE (data_leitura ='$data') ORDER BY id ASC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
  $dados = $sql->fetch_array();
  $primeira_deteccao_hj_saida_alternativa = $dados['hora'];
}
mysqli_close();


echo $primeira_deteccao_hj_saida_alternativa;


?>