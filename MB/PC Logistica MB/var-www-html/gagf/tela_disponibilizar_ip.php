<?php
$id  = $_GET['id'];
$tabela  = $_GET['tabela'];
$nome = $_GET['nome'];
$gateway = $_GET['gateway'];
$mascara = $_GET['mascara'];
$informacao_adicional = $_GET['informacao'];
$usuario = $_GET['usuario'];
$vsenha = $_GET['senha'];
$editado_por = $_GET['editado_por'];
$ativo = $_GET['ativo'];
$data = $_GET['data'];
$hora = $_GET['hora'];
$modelo = $_GET['modelo'];
$tipo = $_GET['tipo'];

$disponivel = '';

if($nome != '' && $nome != 'IP disponivel para utlização')
{
 $disponivel = 'Não'; //Esta em uso
}
else
{
 $disponivel = 'Sim'; //Pode utilizar   
}


include_once 'conexao_portal_gestao.php';
$sql = $dbcon->query("UPDATE $tabela SET nome = '$nome', gateway='$gateway',mascara='$mascara',modelo='$modelo',tipo='$tipo',informacao_adicional='$informacao_adicional',ativo='$ativo',status='Bloqueado',usuario='$usuario',senha='$vsenha',disponivel='$disponivel',editado_por='$editado_por',data='$data',hora='$hora'  WHERE id='$id'");

echo 'ok';
 ?>
