<?php
$id  = $_GET['id'];
include_once 'conexao_sva.php';
$encontrado = 0;
$sql = $dbcon->query("SELECT * FROM pessoas WHERE id='$id'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $text = $dados['text'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
  $camera = $dados['camera_id'];
  $encontrado = 1;
 }
}



//Dados das cameras
//ms0742-cam08 - Abertura I e II
//ms0742-cam09 - Patio CCL




if($encontrado == 1)
{

 if($camera == "ms0742-cam08" && $text == "Pessoa detectada")
 {
     //Pode exibir o botao padrao entrada
     echo json_encode("abertura1e2");
 }
 elseif( ($camera == "ms0742-cam07")  && $text == "Pessoa detectada")
 {
     //Pode exibir o botao padrao saida
     echo json_encode("patio_ccl");
 }
 else
 {
    echo json_encode("erro");
 }




} // Fecha encontrado == 1













 ?>
