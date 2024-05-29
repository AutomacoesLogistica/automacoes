<?php

$host = "192.168.20.66";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_recebimento_rom";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>