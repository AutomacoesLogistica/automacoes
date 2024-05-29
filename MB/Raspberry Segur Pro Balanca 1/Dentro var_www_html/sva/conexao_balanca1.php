<?php

$host = "192.168.10.96"; // Conecta na porta 3306 e tem q liberar o acesso externo!
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_sva";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
