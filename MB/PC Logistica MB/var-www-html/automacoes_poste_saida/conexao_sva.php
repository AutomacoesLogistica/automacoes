<?php

$host = "localhost";
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_sva_lidar";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>