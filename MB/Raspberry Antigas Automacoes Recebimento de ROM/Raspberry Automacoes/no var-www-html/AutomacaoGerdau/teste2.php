<?php
//Salva no banco que entrou alguem
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Entrou no ROM - Entrada Principal',data='$data',hora='$hora'");
?>