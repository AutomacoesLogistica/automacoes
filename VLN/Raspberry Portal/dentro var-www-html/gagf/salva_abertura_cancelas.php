<?php
$nome = isset($_GET['nome'])?$_GET['nome']:'vazio';
$id_cancela = isset($_GET['cancela'])?$_GET['cancela']:'vazio';
$registro = '-';

$codigo_lora = '';

include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM pessoas WHERE nome='$nome'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $registro = $dados['registro'];
 //echo "achou registro " . $registro . "</BR>";
}

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');// data agora
$hora = date('H:i:s');// hora de agora


if($id_cancela == "Saida VLN LE")
{
 $id_cancela2 = " do lado esquerdo!";
 $codigo_lora = '21'; //Codigo da cancela do lado esquerdo
}
else if($id_cancela == "Saida VLN LD")
{
 $id_cancela2 = " do lado direito!";
 $codigo_lora = '22'; //Codigo da cancela do lado direito
}

$descricao = "Realizado ao acionamento manual da cancela " . $id_cancela2 . " pelo(a) colaborador(a) " . $nome;

include_once 'conexao2.php';
$sql = $dbcon->query("INSERT INTO eventos(registro,justificativa,descricao,cancela,data,hora,nome_colaborador,sitio,area)VALUES('$registro','-','$descricao','$id_cancela','$data','$hora','$nome','VLN','Saida VLN')");


include_once 'conexao_cancelas_saida.php';
$sql = $dbcon->query("INSERT INTO acionamento (codigo_lora)VALUES('$codigo_lora')");



echo ("Realizado com sucesso o acionamento da cancela " . $id_cancela2);
 ?>