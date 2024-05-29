<?php

$host = "localhost";
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_ca1_utmi";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
