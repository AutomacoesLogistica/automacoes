<?php

$host = "192.168.30.73";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_ca_2";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>