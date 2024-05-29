<?php
$condicao = '';
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array(); 
 $condicao = $dados['condicao_automacao_semaforos'];
}

//MENSAGENS
//>0,0<   : BLOQUEIA SISTEMA
//>9,9<   : LIBERA SISTEMA

if($condicao == '>0,0<')
{
 //Sistema esta bloqueado!
 //vou liberar para operacao!
 include_once 'conexao.php';
 $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('>9,9<')");
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE display_balanca1 SET condicao_automacao_semaforos='>9,9<' WHERE id='1'");
 echo 'liberado!';  
}
else if ($condicao == '>9,9<')
{
 //Sistema esta liberado!
 //vou bloquear para operacao!
 include_once 'conexao.php';
 $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('>0,0<')");
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE display_balanca1 SET condicao_automacao_semaforos='>0,0<' WHERE id='1'");
 echo 'bloqueado!';  
}
echo'erro';
?>