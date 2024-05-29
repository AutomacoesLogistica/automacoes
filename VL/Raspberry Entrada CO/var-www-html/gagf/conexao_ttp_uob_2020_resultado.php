<?php

$host = "localhost";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_ttp_usina_2020_resultado";

$aux_conexao_ttp_resultado = new MySQLi("$host","$usuario","$senha","$banco");


if ($aux_conexao_ttp_resultado->connect_error){
echo "conexao_erro";
}

?>
