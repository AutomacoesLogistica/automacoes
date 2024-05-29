<?php
$mensagem  = $_POST['mensagem'];
include_once 'conexao5.php';
$sql = $dbcon->query("SELECT * FROM acessos WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $limite = $dados['limite']; // busco o valor que esta agora
  $dentro = $dados['dentro'];
 } // fecha o while
}// fecha o if
    

echo ($limite.','.$dentro);
 ?>
