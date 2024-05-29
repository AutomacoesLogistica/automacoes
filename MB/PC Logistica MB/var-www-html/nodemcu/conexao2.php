<?php

$host = "localhost";
$usuario = "root";
$senha = "268300";
$banco = "bd_cancelas";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>
