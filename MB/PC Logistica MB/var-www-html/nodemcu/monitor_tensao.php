<?php
include_once 'conexao.php';

$dispositivo = isset($_GET['dispositivo'])?$_GET['dispositivo']:"";
$modo_alimentacao = isset($_GET['mensagem'])?$_GET['mensagem']:""; // recebe AC ou BAT
$linha = 0;
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$modo_alimentacao_no_banco = "";



$sql = $dbcon->query("SELECT * FROM tbl_ping WHERE dispositivo='$dispositivo' ");
if(mysqli_num_rows($sql)>0)
{
  while($dados = $sql->fetch_array())
  {
   $linha = $dados['id'];
   $modo_alimentacao_no_banco = $dados['modo_alimentacao']; // busca o modo de alimentacao que esta no banco
  }
}else{
  //echo"nao_encontrado";
}

if ( $linha != 0){ // Se encontrou


 if ($modo_alimentacao_no_banco == $modo_alimentacao)
 {
  // Não salva para manter o tempo da primeira vez offline para poder saber desde quanto o dispositivo esta offline.
 }
 else
 {
  // Altera status dos dispositivos na tabela PING 
  $sql = $dbcon->query("UPDATE tbl_ping SET modo_alimentacao='$modo_alimentacao' , data='$data' , hora='$hora' WHERE id='$linha'");
  
  $local = "";

  // ALTERAR O DISPOSITIVO PARA O NOME DO LOCAL RESPECTIVO
  if($dispositivo=="monitor_tensao_patrag")
  {
  $local = "PATRAG";
  }
  if($dispositivo=="monitor_tensao_utmi")
  {
    $local = "UTMI";
  }

  // Salva dados na tabela Status para consultas futuras
   $sq2 = $dbcon->query("INSERT INTO tbl_status_rede SET ponto='$local', condicao='-' , modo_alimentacao='$modo_alimentacao' , data='$data' , hora='$hora'");
 
  // Salva dados para envio de email
  $sq3 = $dbcon->query("INSERT INTO tbl_email SET ponto='$local', condicao='$modo_alimentacao' , data='$data' , hora='$hora'");

 }
} // Fecha o if se linha !=0
?>
