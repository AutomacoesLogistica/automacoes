
<?php

$host = "localhost";
$usuario = "admin";
$senha = "Logistica2019@@";
$banco = "bd_dashboard";

$dbcon = mysqli_connect("$host","$usuario","$senha","$banco");


if ($dbcon->connect_error){
echo "conexao_erro";
}

?>