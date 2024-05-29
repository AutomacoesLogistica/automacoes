<?php

$epc = $_GET['tag']; // Tag a cadastrar

$epc_antiga = ""; // Nao usa
$tipo_equipamento = $_GET['veiculo']; // Carreta ou Testes , Cavalo
$placa = mb_strtoupper($_GET['placa'],'UTF8'); // Deixar em caixa alta
$localidade = $_GET['localidade'];
$tipo_parte = $_GET['equipamento']; // Tipo da parte
$transportadora_atual = mb_strtoupper($_GET['transportadora'],'UTF8');
$transportadora_antiga = "";// Nao usa
$complemento = $_GET['complemento'];
$check = $_GET['check'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y'); // Pega na internet para salvar a data do cadastro




echo "</br>";
echo "epc_atual = "; echo $epc;
echo "</br>";
echo "tipo_equipamento = "; echo $tipo_equipamento;
echo "</br>";
echo "placa = "; echo $placa;
echo "</br>";
echo "localidade = "; echo $localidade;
echo "</br>";
echo "tipo_parte = "; echo $tipo_parte;
echo "</br>";
echo "transportadora_atual = "; echo $transportadora_atual;
echo "</br>";echo "</br>";echo "</br>";



include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE epc='$epc'");

# verifica se nao existe essa tag ja no banco
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  ?>
  <script>
  alert("Tag já existe no sistema, favor selecionar outra tag!");
  location.href=`cadastrar_tag.php?complemento=${"<?php print $complemento ?>"}&check=${"<?php print $check ?>"}`;
  </script>
  <?php
 }
}
else
{
  echo "Pode Salvar!";
  include_once 'conexao.php';
  $sq2 = $dbcon->query("INSERT INTO lista_tags(id,epc,tipo_equipamento,placa,localidade,tipo_parte,transportadora_atual,data_cadastro)VALUES('DEFAULT','$epc','$tipo_equipamento','$placa','$localidade','$tipo_parte','$transportadora_atual','$data')");
  ?>
  <script>
  alert("Tag Cadastrada com sucesso!");
  //location.href=`menu_gestao_tag.php?complemento=${"<?php print $complemento ?>"}&check=${"<?php print $check ?>"}`;
  </script>
  <?php

}


?>