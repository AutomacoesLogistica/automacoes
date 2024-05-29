<?php

$host = "186.235.193.170:3306";
$usuario = "cclmb";
$senha = "logistica2019@@";
$banco = "bd_gagf";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}
else
{
echo "conectado!";    
}

?>
