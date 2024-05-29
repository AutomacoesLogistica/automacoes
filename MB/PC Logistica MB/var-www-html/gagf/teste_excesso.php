<?php

$id = '31732';
include_once 'conexao_excesso.php';
$sql = $dbcon->query("UPDATE lista_excesso_mb SET sala_log = 'Sim' WHERE id='$id'");


?>

