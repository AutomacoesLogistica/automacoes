<?php

$host = "192.168.40.107";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_cancelas";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>