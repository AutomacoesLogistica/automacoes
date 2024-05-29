<?php

$host = "localhost";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_divergencia_mbvl_gagf_2020";

$aux_conexao_divergencia = new MySQLi("$host","$usuario","$senha","$banco");


if ($aux_conexao_divergencia->connect_error){
echo "conexao_erro";
}

?>
