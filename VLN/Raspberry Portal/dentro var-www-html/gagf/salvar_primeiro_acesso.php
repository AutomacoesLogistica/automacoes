<?php
$nome = isset($_GET['nome'])?$_GET['nome']:'vazio';
$registro = isset($_GET['registro'])?$_GET['registro']:'vazio';
$passwd = isset($_GET['passwd'])?$_GET['passwd']:'vazio';
$criptografica = isset($_GET['criptografia'])?$_GET['criptografia']:'vazio';

$area = "Logistica VLN";
$tipo_usuario = "Operador CCL";

if($nome != 'vazio' && $registro != 'vazio' && $passwd != 'vazio' && $criptografica != 'vazio')
{
 // Verifico se ja nao tem cadastrado o registro
 include_once 'conexao2.php';
 $sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro'");
 $encontrado = 0;
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $encontrado = 1;
  //echo "achou registro ";
 }
 
 if($encontrado == 0)
 {
  //Pode salvar
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO pessoas(nome,registro,senha,area,tipo_usuario,criptografia,alterar,acesso_portal,acesso_excesso,acesso_aciona_cancela)VALUES('$nome','$registro','$passwd','$area','$tipo_usuario','$criptografica','0','0','0','0')");
    
  echo "Cadastro efetuado com sucesso!\n\n\nBasta agora voltar a tela inicia e logar!";
 }
 else
 {
  echo "Usuario já está cadastrado no sistema!";  
 }








}
else
{
 echo "Erro de dados!";   
}

 ?>