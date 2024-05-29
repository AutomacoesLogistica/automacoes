<?php

$host = "192.168.40.251";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_saida_vln";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>