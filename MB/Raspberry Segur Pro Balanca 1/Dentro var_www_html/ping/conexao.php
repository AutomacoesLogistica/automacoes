<?php

$host = "192.168.10.254:3306";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_pings";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
