<?php

$host = "localhost";
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "radius";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
