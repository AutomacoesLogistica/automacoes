<?php
include_once 'conexao.php';

$sql = $dbcon->query("SELECT * FROM tbl_dados");
//$sql = $dbcon->query("INSERT INTO tbl_dados SET sensor1='$sensor1'");
$linha = 0;
$mensagem = "";
$topico = "";
$encontrado = 0;  
if(mysqli_num_rows($sql)>0)
{
  
 while($dados = $sql->fetch_array())
 {
  $encontrado++;
  if($encontrado == 1)
  {
   $topico = $dados['topico'];
   $mensagem = $dados['mensagem'];
    
   $linha = $dados['id']; // busco o ID para poder apagar em seguida
   $incio_do_topico = "mensagem:";
   $fim_do_topico = ";";
   // Enviando a mensagem para o esp publicar
   echo $incio_do_topico. $topico .",".$mensagem .$fim_do_topico    ;
  
   
   }  

 } // fecha o while
}else{
 echo"sem_solicitacoes";
 $encontrado = 0;
 $linha = 0;   
}



if ($linha != 0)
{
 $sql = $dbcon->query("DELETE FROM `tbl_dados` WHERE `tbl_dados`.`id` = '$linha'");
}


?>