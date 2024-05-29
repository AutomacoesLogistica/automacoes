<?php
error_reporting(0);

$ref_audio  = $_GET['ref_audio'];
date_default_timezone_set('America/Sao_Paulo');
$valor_dia = date('d/m/Y');
$valor_hora = date('H:i:s');
$mensagem = $valor_dia . " " . $valor_hora . "<b>(T)</b>"; // Para informar que veio de testes
$historico = "";


//PRIMEIRO VOU ATUALIZAR A HORA DO ACIONAMENTO
include_once 'conexao_sva.php';
$sql = $dbcon->query("UPDATE referencia_audios SET historico = '$mensagem' WHERE ref_audio='$ref_audio'");



include_once 'conexao_sva.php';
$sql = $dbcon->query("SELECT * FROM referencia_audios WHERE ref_audio='$ref_audio'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $audio = $dados['audio'];
  $historico = $dados['historico'];
 }
}



include_once 'conexao_sva.php';
//Coloco aqui para a caixa do ccl reproduzir tambem este audio!
$sql = $dbcon->query("INSERT INTO audios (audio) VALUES ('$audio')");


//Respondo para atualizar a data e hora do banco
echo json_encode($historico);
?>