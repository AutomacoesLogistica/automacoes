<?php   

$registro = isset($_POST['registro'])?$_POST['registro']:"vazio";
$valor_senha = isset($_POST['senha'])?$_POST['senha']:"vazio";
$valor_csenha = isset($_POST['csenha'])?$_POST['csenha']:"vazio";

/*
echo "Registro = ";
echo $registro;
echo"</BR>";
echo "Senha = ";
echo $valor_senha;
echo"</BR>";
echo "Conf Senha = ";
echo $valor_csenha;
echo"</BR>";
*/

$nome = "";
include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro'");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
    $nome = $dados['nome'];
  }
  
  
  
  if ($valor_senha == $valor_csenha && $valor_senha!="" && $valor_csenha!="")
  {
   //Pode alterar a senha
   $sql = $dbcon->query("UPDATE pessoas SET senha='$valor_senha', alterar='0' WHERE registro='$registro'");
   ?>
   <script>
   alert("Senha alterada com sucesso! \nAgora sera necessario logar novamente!");
   window.location="login.php";
   </script>
   <?php 
  }
  else
  {
   //Erro, senha digitadas não batem  
   ?>
   <script>
   alert("As senha digitadas não conferem, favor tentar novamente!");
   window.location="login.php";
   </script>
   <?php
  }


 }
 else // Não deixa alterar a senha pois ja foi alterada, será necessário zerar a senha
 {
   //Não encontrado o registro
   ?>
   <script>
    alert("Registro não encontrado no sistema!    Contate o administrador!");
    window.location="login.php";
    </script>
    <?php
 }
  






?>