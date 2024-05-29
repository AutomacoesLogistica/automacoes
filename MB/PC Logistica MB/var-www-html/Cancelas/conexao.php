<?php

$host = "localhost";
$usuario = "root";
$senha = "268300";
$banco = "bd_Cancelas";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
