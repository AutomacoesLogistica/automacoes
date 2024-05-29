<?php

$host = "192.168.10.96";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_dashboard";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
