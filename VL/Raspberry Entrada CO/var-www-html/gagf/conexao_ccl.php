<?php

$host = "http://10.10.25.145:3306";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_gagf";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
