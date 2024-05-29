<?php
include_once 'conexao2.php';

$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"";
$cod = isset($_GET['cod'])?$_GET['cod']:"";
$tag = isset($_GET['tag'])?$_GET['tag']:"";
$info = isset($_GET['info'])?$_GET['info']:"";
$linha = 0;

$sql = $dbcon->query("SELECT * FROM id_cancelas WHERE cod='$cod' ");
if(mysqli_num_rows($sql)>0)
{
  while($dados = $sql->fetch_array())
  {
   $linha = $dados['id'];
  }
}else{
  //echo"nao_encontrado";
}

if ( $linha != 0){ // Se encontrou
  $sql = $dbcon->query("UPDATE id_cancelas SET condicao='$mensagem', tag_lida='$tag', info='$info' WHERE cod='$cod'");
}
?>