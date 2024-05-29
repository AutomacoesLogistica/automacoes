<?php
$publicar_display = isset($_GET['display'])? $_GET['display']:'vazio';
$publicar_gagf = isset($_GET['gagf'])? $_GET['gagf']:'vazio';
$modo_operacao_display = isset($_GET['apenas_placas'])? $_GET['apenas_placas']:'vazio';

if( $publicar_gagf !='vazio' && $publicar_display != 'vazio' && $modo_operacao_display !='vazio')
{
  if($modo_operacao_display == 'true')
  {
   $modo_operacao_display = 'apenas_placas';
  } 
  else
  {
   $modo_operacao_display = 'modo_completo';
  } 
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE configuracoes SET modo_operacao_display='$modo_operacao_display',publicar_gagf='$publicar_gagf',publicar_display='$publicar_display' WHERE id='1'");
}

?>