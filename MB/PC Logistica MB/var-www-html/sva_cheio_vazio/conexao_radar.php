<?php

$host = "138.0.77.80:3515";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_sva";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
