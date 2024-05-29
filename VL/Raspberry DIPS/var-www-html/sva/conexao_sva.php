<?php

$host = "192.168.30.166";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_sva";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
