<?php
include_once 'conexao.php';

$sql = $dbcon->query("SELECT * FROM acionamentos_cancelas_mb");
$linha = 0;
$id_cancela = "";
$comando = "";
$encontrado = 0;  
if(mysqli_num_rows($sql)>0)
{
  
 while($dados = $sql->fetch_array())
 {
  $encontrado++;
  if($encontrado == 1)
  {
   $id_cancela = $dados['id_cancela'];
   $comando = $dados['comando'];
    
   $linha = $dados['id']; // busco o ID para poder apagar em seguida
   $incio_do_topico = "mensagem:";
   $fim_do_topico = ";";
   // Enviando a comando para o esp publicar
   echo $incio_do_topico. $id_cancela .",".$comando .$fim_do_topico    ;
  
   
   }  

 } // fecha o while
}else{
 echo"sem_solicitacoes";
 $encontrado = 0;
 $linha = 0;   
}



if ($linha != 0)
{
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 $sql = $dbcon->query("DELETE FROM `acionamentos_cancelas_mb` WHERE `acionamentos_cancelas_mb`.`id` = '$linha'");
 $sql = $dbcon->query("INSERT INTO acionamentos_efetuados(codigo_lora,comando,data,hora)VALUES('$id_cancela','$comando','$data','$hora')");
}


?>