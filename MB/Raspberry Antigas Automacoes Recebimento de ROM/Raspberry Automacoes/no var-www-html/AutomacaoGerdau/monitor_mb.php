<?php
$tensao = isset($_GET['tensao'])?$_GET['tensao']:"vazio";
$umidade = isset($_GET['umidade'])?$_GET['umidade']:"vazio";
$ID = isset($_GET['id'])?$_GET['id']:"vazio";
$tensao_banco = "";
$umidade_banco = "";

// primeiro busca qual era a condição
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM monitor_mb WHERE codigo_lora='$ID'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $tensao_banco = $dados['tensao'];
  $umidade_banco = $dados['umidade'];
 }
}



// Atualiza o tensao
if(($tensao_banco!=$tensao)&& $tensao !="vazio") // Evita ficar abrindo e salvando toda hora, salva somente se alterar o tensao
{
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE monitor_mb SET valor_tensao='$tensao' WHERE codigo_lora='$ID'");
}




// PARA UMIDADE
// Atualiza a umidade
if(($umidade_banco!=$umidade)&& $umidade !="vazio") // Evita ficar abrindo e salvando toda hora, salva somente se alterar a umidade
{
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE monitor_mb SET valor_umidade='$umidade' WHERE codigo_lora='$ID'");
}















?>
