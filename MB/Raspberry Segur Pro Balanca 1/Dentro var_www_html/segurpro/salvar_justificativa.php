<?php
$registro = $_GET['registro'];
$senha2 = $_GET['vsenha'];
$justificativa = $_GET['justificativa'];
$id = strval($_GET['id']);
$encontrado = 2;
//Busco pelo registro a senha e confiro se bate com a salva
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM usuarios WHERE registro = '$registro' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $nome = $dados['nome'];
 $banco_senha = $dados['senha'];
 $justificativas = $dados['justificativas'];
 if(strval($banco_senha) == strval($senha2))
 {
  $encontrado = 1; // Tudo certo
 }
 else
 { 
  $encontrado = 3; // erro de senha
 }
}
else
{
 $encontrado == 2; //NAO existe cadastro!
}






if($encontrado == 1)
{
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE historico_display SET registro_segurpro='$registro',nome_segurpro='$nome',descricao_segurpro='$justificativa',condicao1='Justificado',tratado_por_segurpro='Sim' WHERE id='$id'");
 echo ("ok");
 mysqli_close();

 //Agora atualizo o numero de justificativas para o colaborador
 if($justificativas =='')
 {
  $justificativas = 1;  
 }
 else
 {
  $justificativas = intval($justificativas)+1;  
 }
 
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE usuarios SET justificativas='$justificativas' WHERE registro='$registro'");
}
else if($encontrado == 2)
{
 echo ("nok2"); // Nao existe cadastro!
}
else
{
 echo("nok3");// existe cadastro mas a senha nao bate com a senha do banco 
}

?>