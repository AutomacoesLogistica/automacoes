<?php

$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";

if($mensagem != 'vazio')
{
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');  
 
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM configuracoes_audio ORDER BY id DESC");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $mutado_carga_descentralizada = $dados['mutado_carga_descentralizada'];
 }// fecha o if
 
 include_once 'conexao.php';
 $sql = $dbcon->query("INSERT INTO historico_audio (nome_audio,mutado,data_executado,hora_executado) VALUES ('$mensagem','$mutado_carga_descentralizada','$data','$hora')");
  
 echo "OK";
}
else
{
  echo "Erro";  
}

?>