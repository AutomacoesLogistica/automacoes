<?php
$nome_service = isset($_GET['nome_service'])?$_GET['nome_service']:"vazio";
$condicao = isset($_GET['condicao'])?$_GET['condicao']:"vazio";


if($nome_service !="vazio")
{
 include_once 'conexao.php';
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 $sql = $dbcon->query("UPDATE atualizacao_services SET data_atualizacao='$data',hora_atualizacao='$hora', condicao='$condicao' WHERE nome_service='$nome_service'"); 
}
else
{
 echo "Favor inserir uma mensagem valida!";   
}

?>