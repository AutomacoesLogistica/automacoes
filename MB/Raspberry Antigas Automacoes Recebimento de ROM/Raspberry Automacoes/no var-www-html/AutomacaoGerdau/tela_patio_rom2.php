<?php
$mensagem  = $_POST['mensagem'];
include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM tela_acesso_rom WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['mensagem']; // busco o valor que esta agora
 } // fecha o while
}// fecha o if
    
if($mensagem =="")
{
  $mensagem = "INI";  
}
 
echo ($mensagem);
 ?>
