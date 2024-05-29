<?php

include_once 'conexao_balanca1.php';
$sql = $dbcon->query("SELECT * FROM placas_descartadas ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
   $ultimo_placa_descartada = $dados['id'];
   
 }
}


echo $ultimo_placa_descartada;
?>