<?php
$host = "200.209.137.130";
$usuario = "GERDAU";
$senha = "G3rd@u";
$banco = "MINA_WEB";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}
?>