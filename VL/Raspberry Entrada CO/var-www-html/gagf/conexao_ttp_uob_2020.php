<?php

$host = "localhost";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_ttp_usina_2020";

$aux_conexao_ttp = new MySQLi("$host","$usuario","$senha","$banco");


if ($aux_conexao_ttp->connect_error){
echo "conexao_erro";
}

?>
