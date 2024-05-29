<?php

$host = "localhost"; // Conecta na porta 3306 e tem q liberar o acesso externo!
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_sva_lidar";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
