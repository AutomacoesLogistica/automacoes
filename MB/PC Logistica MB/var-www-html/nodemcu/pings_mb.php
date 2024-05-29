<?php
include_once 'conexao.php';

$dispositivo = isset($_GET['dispositivo'])?$_GET['dispositivo']:"";
$condicao = isset($_GET['condicao'])?$_GET['condicao']:"";
$linha = 0;
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$condicao_no_banco = "";
//$modo_alimentacao = "";

$status = '';
  if($condicao =="OK"){
   $status = "ONLINE";
  }else if($condicao =="Erro"){
   $status = "OFFLINE";
  }else{
   $status = "ERRO"; 
  }


$sql = $dbcon->query("SELECT * FROM tbl_ping WHERE dispositivo='$dispositivo' ");
if(mysqli_num_rows($sql)>0)
{
  while($dados = $sql->fetch_array())
  {
   $linha = $dados['id'];
   $condicao_no_banco = $dados['condicao']; // busca para ver se ja esta com Erro ' Offline '
   //$modo_alimentacao = $dados['modo_alimentacao']; 
  }
}else{
  //echo"nao_encontrado";
}

if ( $linha != 0){ // Se encontrou


 if ($condicao_no_banco == $condicao)
 {
  // Não salva para manter o tempo da primeira vez offline para poder saber desde quanto o dispositivo esta offline.
 }
 else
 {
  // Salva alteracao de Status do link
  $sql = $dbcon->query("UPDATE tbl_ping SET condicao='$condicao' , data='$data' , hora='$hora' WHERE id='$linha'");
  
  if($status != "ERRO")
  {
  // Salva dados na tabela Status para consultas futuras
  $sql = $dbcon->query("INSERT INTO tbl_status_rede SET ponto='$dispositivo', condicao='$status' , modo_alimentacao='-' , data='$data' , hora='$hora'");
  }
  
 }
} // Fecha o if se linha !=0
?>
