<?php

$host = "192.168.30.123";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_saida_co";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>