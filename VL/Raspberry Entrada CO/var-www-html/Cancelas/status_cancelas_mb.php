<?php
$condicao = isset($_GET['condicao'])?$_GET['condicao']:"vazio";
$ID = isset($_GET['id'])?$_GET['id']:"vazio";
$condicao_banco = "";

// primeiro busca qual era a condição
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM id_cancelas_utmii WHERE codigo_lora='$ID'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $condicao_banco = $dados['condicao'];
 }
}

// Atualiza o condicao do banco das cancelas da umtii
if($condicao_banco!=$condicao) // Evita ficar abrindo e salvando toda hora, salva somente se alterar o condicao
{
include_once 'conexao.php';
//Salva no historio que o ponto X acabou de atuar
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$sql = $dbcon->query("UPDATE id_cancelas_utmii SET condicao='$condicao', data='$data' , hora='$hora' WHERE codigo_lora='$ID'");
}

?>
