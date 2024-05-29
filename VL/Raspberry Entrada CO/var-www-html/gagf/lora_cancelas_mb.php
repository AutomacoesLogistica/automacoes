<?php
$dispositivo = isset($_GET['dispositivo'])?$_GET['dispositivo']:"vazio";
$condicao = isset($_GET['condicao'])?$_GET['condicao']:"vazio";
$condicao_banco = "";

// primeiro busca qual era a condição
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM acionamentos_cancelas_mb WHERE ponto='$dispositivo'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $condicao_banco = $dados['condicao'];
 }
}
else
{
  echo "Nao encontrado!";
}




if($condicao_banco=="normal" && $condicao=="atuado")
{
  //Salva no historio que o ponto X acabou de atuar
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $sql = $dbcon->query("INSERT INTO historico_alertas SET ponto='$dispositivo', data='$data' , hora='$hora',condicao='$condicao' ");  
}
if($condicao_banco=="atuado" && $condicao=="normal")
{
  //Salva no historio que o ponto X acabou de atuar
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $sql = $dbcon->query("INSERT INTO historico_alertas SET ponto='$dispositivo', data='$data' , hora='$hora',condicao='$condicao' ");  
}

// Atualiza o status do banco de alertas!
if($condicao_banco!=$condicao) // Evita ficar abrindo e salvando toda hora, salva somente se alterar o status
{
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE acionamentos_cancelas_mb SET condicao='$condicao'WHERE ponto='$dispositivo'");

$status = "Salvo!";
$mensagem = $condicao;
    
$incio_do_topico = "mensagem:";
$fim_do_topico = ";";
// Enviando a mensagem para o esp publicar
echo $incio_do_topico. $status .",".$mensagem .$fim_do_topico    ;
}









?>
