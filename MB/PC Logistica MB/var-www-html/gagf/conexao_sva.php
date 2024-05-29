<?php

$host = "localhost";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_sva";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
