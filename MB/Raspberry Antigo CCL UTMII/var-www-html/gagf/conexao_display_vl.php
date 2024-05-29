<?php

$host = "localhost";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_display_vl";

$aux_conexao_display = new MySQLi("$host","$usuario","$senha","$banco");


if ($aux_conexao_display->connect_error){
echo "conexao_erro";
}

?>
