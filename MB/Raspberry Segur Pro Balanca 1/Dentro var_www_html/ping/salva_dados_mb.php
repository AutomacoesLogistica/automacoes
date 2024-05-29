<?php
$ip  = isset($_GET['ip'])?$_GET['ip']:"vazio";
$condicao = isset($_GET['condicao'])?$_GET['condicao']:"vazio";
$data_atualizacao = isset($_GET['data'])?$_GET['data']:"vazio";
$hora_atualizacao = isset($_GET['hora'])?$_GET['hora']:"vazio";
$site = isset($_GET['site'])?$_GET['site']:"vazio";
$caminho_audio = isset($_GET['caminho_audio'])?$_GET['caminho_audio']:"vazio";



// Atualiza a tabela principal
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE dados SET condicao='$condicao', data_atualizacao='$data_atualizacao', hora_atualizacao='$hora_atualizacao' WHERE ip='$ip'");

include_once 'conexao.php';
$sql = $dbcon->query("INSERT INTO historico (valor_site, ip, data_atualizacao, hora_atualizacao, condicao) VALUES ('$site', '$ip','$data_atualizacao', '$hora_atualizacao', '$condicao')");


if( $caminho_audio == "")
{
 //Não faz nada pois não precisa notificar
}
else
{
 // Notifica audio
 //Agora verifica de onde se trata
 if ($site == "UTMI")
 {
  if($condicao == "Online")
  {
  // Estava fora e voltou
  }
  else
  {
  // Estava online e caiu

  }
 }
 elseif($site == "UTMII")
 {
  if($condicao == "Online")
  {
  // Estava fora e voltou
  }
  else
  {
  // Estava online e caiu
  
  }
 }
 elseif($site == "VL")
 {
    if($condicao == "Online")
    {
    // Estava fora e voltou
    }
    else
    {
    // Estava online e caiu
    
    }
 }
 elseif($site == "VLN")
 {
    if($condicao == "Online")
    {
    // Estava fora e voltou
    }
    else
    {
    // Estava online e caiu
    
    }
 }





}




?>