<?php 
 $msg = isset($_GET['msg'])?$_GET['msg']:'Testando!';

  
 include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='$msg',mensagem2=' ' WHERE id='1'");
 
 echo $msg;
?>