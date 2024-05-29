<?php

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM historico_match WHERE tratado='nao' LIMIT 1");
$encontrado = 0;
$placa_cavalo = '';
$placa_carreta = '';
$rodar = isset($_GET['rodar'])?$_GET['rodar']:"rodar"; // Para evitar erros!


if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $id = $dados['id'];
  $epc_cavalo = $dados['epc_cavalo'];
  $epc_carreta = $dados['epc_carreta'];
  $encontrado = $encontrado+1;
 }


}
 

 // Agora conecto no banco de placas e pelas tags consulto qual sao as placas
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc_cavalo' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $placa_cavalo = $dados['placa'];
 }
}


include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc_carreta' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $placa_carreta = $dados['placa'];
 }
}


print ("Resposta ****************************************");
print("</BR>");
print("ID encontrado: ");print($id);
print("</BR>");
print("Dados do Cavalo: EPC = ");print($epc_cavalo);print( " - Placa = ");print($placa_cavalo);
print("</BR>");
print("Dados do Carreta: EPC = ");print($epc_carreta);print( " - Placa = ");print($placa_carreta);
print("</BR>");
print("</BR>");
print("Finalizou");



// Agora atualiza o status de tratado e insere as placas 
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE historico_match SET placa_cavalo='$placa_cavalo',placa_carreta='$placa_carreta',tratado='sim'WHERE id='$id'");

?>
