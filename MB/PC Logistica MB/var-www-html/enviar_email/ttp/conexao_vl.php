<?php

$host = "138.0.77.80:3667";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_dashboard";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
