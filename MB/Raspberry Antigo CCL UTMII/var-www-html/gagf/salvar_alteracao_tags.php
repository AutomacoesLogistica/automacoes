<?php
include_once 'conexao.php';
$complemento = $_GET['complemento'];
$check = $_GET['check'];
$id = $_GET['id'];
$epc_nova = isset($_GET['epc_nova'])?$_GET['epc_nova']:"nao mudou";
$epc = $_GET['epc'];
$epc_antiga = $_GET['epc_antiga'];
if ($epc_antiga = "nao cadastrada"){$epc_antiga = "";}// Mantem vazio
$tipo_equipamento = $_GET['tipo_equipamento'];
$placa = mb_strtoupper($_GET['placa'],'UTF8'); // Deixar em caixa alta
$localidade = $_GET['localidade'];
$tipo_parte = $_GET['tipo_parte'];
$transportadora_nova =$_GET['transportadora_nova'];
if($transportadora_nova == ""){$transportadora_nova = "nao mudou";}
$transportadora_atual = $_GET['transportadora_atual'];
$transportadora_antiga = $_GET['transportadora_antiga'];


echo "id = " ; echo $id;
echo "</br>";
echo "epc_nova = "; echo $epc_nova;
echo "</br>";
echo "epc_atual = "; echo $epc;
echo "</br>";
echo "epc_antiga = "; echo $epc_antiga;
echo "</br>";
echo "tipo_equipamento = "; echo $tipo_equipamento;
echo "</br>";
echo "placa = "; echo $placa;
echo "</br>";
echo "localidade = "; echo $localidade;
echo "</br>";
echo "tipo_parte = "; echo $tipo_parte;
echo "</br>";
echo "transportadora_nova = "; echo $transportadora_nova;
echo "</br>";
echo "transportadora_atual = "; echo $transportadora_atual;
echo "</br>";
echo "transportadora_antiga = "; echo $transportadora_antiga;
echo "</br>";

$epc_banco = "";
$epc_antiga_banco = "";

$transportadora_atual_banco = "";
$transportadora_antiga_banco = "";

if ($epc_nova == "nao mudou")
{
 // nao altera nada   
$epc_banco = $epc;
$epc_antiga_banco = $epc_antiga;
}
else
{
 $epc_banco = $epc_nova;
 $epc_antiga_banco = $epc;
 // Descarta a epc_antiga   
}


if($transportadora_nova == "nao mudou")
{
$transportadora_atual_banco = $transportadora_atual;
$transportadora_antiga_banco = $transportadora_antiga;
}
else
{
$transportadora_atual_banco = $transportadora_nova;
$transportadora_antiga_banco = $transportadora_atual;
}


date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');

include_once 'conexao.php';
$sql = $dbcon->query("UPDATE lista_tags SET epc='$epc_banco', epc_antiga='$epc_antiga_banco', tipo_equipamento='$tipo_equipamento',placa='$placa',localidade='$localidade',tipo_parte='$tipo_parte',transportadora_atual='$transportadora_atual_banco',transportadora_antiga='$transportadora_antiga_banco',data_alteracao='$data'  WHERE id='$id'");

?>
<script>
// Chama para voltar para a tela e ver as alteracoes
//chama a tela para salvar 
location.href=`consultar_tag.php?complemento=${"<?php print $complemento ?>"}&check=${"<?php print $check ?>"}&epc=${"<?php print $epc_banco ?>"}`;

</script>


<?php

?>
