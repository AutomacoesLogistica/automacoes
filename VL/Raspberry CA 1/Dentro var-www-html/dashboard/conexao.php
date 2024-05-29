<?php

$host = "192.168.30.72";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_ca_1";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>