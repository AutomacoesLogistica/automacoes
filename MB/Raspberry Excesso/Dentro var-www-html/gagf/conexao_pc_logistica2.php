<?php

$host = "192.168.10.96";
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_dashboard";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>