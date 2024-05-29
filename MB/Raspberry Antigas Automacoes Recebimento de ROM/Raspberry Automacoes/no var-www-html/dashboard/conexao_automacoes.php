<?php

$host = "192.168.20.66";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_display_mb";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>