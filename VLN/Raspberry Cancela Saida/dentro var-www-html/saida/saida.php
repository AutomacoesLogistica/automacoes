<?php

$ponto = isset($_GET['ponto'])?$_GET['ponto']:'vazio';
$epc = isset($_GET['epc'])?$_GET['epc']:'xxxxxxxxxxxxxxxxxxxxxxxx';

if($ponto != 'vazio')
{
 if($ponto =="Saida VLN LE")
 {
  $codigo_lora = 'p21';   
  include_once 'conexao.php';
  $sql = $dbcon->query("INSERT INTO acionamento(codigo_lora) VALUES ('$codigo_lora')");
  echo "Acionado a cancela do lado esquerdo pelo automatismo de socket vindo do portal!";

 }
 else if($ponto =="Saida VLN LD")
 {
  $codigo_lora = 'p22';   
  include_once 'conexao.php';
  $sql = $dbcon->query("INSERT INTO acionamento(codigo_lora) VALUES ('$codigo_lora')");
  echo "Acionado a cancela do lado direito pelo automatismo de socket vindo do portal!";

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