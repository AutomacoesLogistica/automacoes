<?php

$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";
$id_mensagem = isset($_GET['id_mensagem'])?$_GET['id_mensagem']:"vazio";



if($mensagem != 'vazio' && $id_mensagem != 'vazio')
{
 include_once 'conexao_tela_pires.php';
 $sql = $dbcon->query("UPDATE tela_pires SET mensagem='$mensagem',tela='1',id_mensagem='$id_mensagem' WHERE id=1");
 echo "OK";
}
else
{
  echo "Erro";  
}
?>