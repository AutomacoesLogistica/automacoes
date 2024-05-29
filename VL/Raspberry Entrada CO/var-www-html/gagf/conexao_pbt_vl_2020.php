<?php

$host = "localhost";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_pbt_vl_2020";

$aux_conexao_pbt = new MySQLi("$host","$usuario","$senha","$banco");


if ($aux_conexao_pbt->connect_error){
echo "conexao_erro";
}

?>
