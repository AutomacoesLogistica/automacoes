<?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM tela_pires WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
  $mensagem = $dados['mensagem']; // busco o valor que esta agora
  $tela = $dados['tela'];
}// fecha o if
 
 
echo ($mensagem.';'.$tela);
 ?>
