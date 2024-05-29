<?php

$host = "localhost";
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_sva_cheio_vazio";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}else{
   //echo'ok';
}

?>
