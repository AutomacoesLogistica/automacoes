<?php

$host = "138.0.77.80:5015";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_gagf";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
