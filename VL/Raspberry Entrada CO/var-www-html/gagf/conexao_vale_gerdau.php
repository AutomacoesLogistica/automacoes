<?php

$host = "localhost";
$usuario = "root";
$senha = "268300";
$banco = "bd_vale_gerdau";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
