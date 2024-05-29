<?php

$host = "localhost";
$usuario = "root";
$senha = "268300";
$banco = "imagens_devmedia";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>