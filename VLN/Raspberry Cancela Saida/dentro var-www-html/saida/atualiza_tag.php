<?php

$ponto = isset($_GET['ponto'])?$_GET['ponto']:'vazio';
$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';

if($ponto != 'vazio')
{
 if($ponto =="Saida VLN LE")
 {
  //Agora atualizo a tag no portal!
  include_once 'conexao_portal.php';
  $sql = $dbcon->query("UPDATE id_cancelas_vln SET tag_lida='$epc'  WHERE id='4'");
 }
 else if($ponto =="Saida VLN LD")
 {
  //Agora atualizo a tag no portal!
  include_once 'conexao_portal.php';
  $sql = $dbcon->query("UPDATE id_cancelas_vln SET tag_lida='$epc'  WHERE id='3'");

 }
 else
 {
  echo "Chegou outro valor para ponto que não é valido!";   
 }
}
else
{
 echo "Erro para valor do ponto!";   
}


?>