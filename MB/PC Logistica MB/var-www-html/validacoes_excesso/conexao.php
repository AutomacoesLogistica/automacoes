<?php


$host = "192.168.10.20"; //Caso nao aceite, mudar para o IP!
$usuario = "admin";
$senha = "logistica2019@@";
$banco = "bd_gagf";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error)
{
 echo "conexao_erro";
}
else
{
    //echo "ok";
}


?>