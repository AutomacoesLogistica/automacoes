<?php
$condicao_betruck = "Liberado!";
$epc_betruck = "442002000000000000001744";
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
include_once 'conexao_saida_automacoes.php';
$sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");



?>