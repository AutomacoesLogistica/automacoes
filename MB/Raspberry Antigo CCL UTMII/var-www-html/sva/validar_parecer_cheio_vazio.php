<?php
$id  = $_GET['id'];
include_once 'conexao_sva.php';
$encontrado = 0;
$sql = $dbcon->query("SELECT * FROM cheio_vazio WHERE id='$id'");
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
//ms0742-cam00 - Entrada ROM Cheio
//ms0742-cam01 - Saida ROM Vazio
//ms0742-cam02 - Saida Alternativa ROM Vazio
//ms0742-cam03 - Saida Alternativa ROM Cheio
//ms0742-cam04 - Entrada ROM Vazio
//ms0742-cam05 - Saida ROM Cheio
//ms0742-cam06 - Saida Alternativa ROM Cheio



if($encontrado == 1)
{

 if($camera == "ms0742-cam00" && $text == "Detect - Cheio")
 {
     //Pode exibir o botao padrao entrada
     echo json_encode("entrada");
 }
 elseif( ($camera == "ms0742-cam01" || $camera == "ms0742-cam02" )  && $text == "Detect - Vazio")
 {
     //Pode exibir o botao padrao saida
     echo json_encode("saida");
 }
 else
 {
    echo json_encode("erro");
 }




} // Fecha encontrado == 1













 ?>
