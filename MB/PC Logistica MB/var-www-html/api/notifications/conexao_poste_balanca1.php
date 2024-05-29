<?php

$host = "192.168.10.35";
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_poste_balanca1";

$dbcon = new MySQLi("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}else{
   //echo'ok';
}

?>
