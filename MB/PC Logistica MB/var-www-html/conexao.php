<?php


$host = "localhost"; //Caso nao aceite, mudar para o IP!
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_teste";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error)
{
 echo "conexao_erro";
}
else
{
    echo "ok";
}


?>