<?php

$host = "localhost";
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_saida_pires";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
