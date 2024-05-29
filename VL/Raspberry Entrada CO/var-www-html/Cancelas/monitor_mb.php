<?php
$condicao = isset($_GET['status'])?$_GET['status']:"vazio";
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

// Atualiza o status do banco das cancelas da umtii
if($condicao_banco!=$condicao) // Evita ficar abrindo e salvando toda hora, salva somente se alterar o status
{
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE id_cancelas_utmii SET condicao='$condicao' WHERE codigo_lora='$ID'");
}

?>
