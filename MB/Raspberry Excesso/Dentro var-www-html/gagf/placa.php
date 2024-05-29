<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

 $epc = $_GET['tag'];
 echo $epc;
 echo '</br>';
 echo '</br>';
 $placa = '-';
 $localidade = 'XX';

//BUSCO A PLACA CASO EXISTA
include_once 'conexao.php';
$sq5 = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc'");
if(mysqli_num_rows($sq5)>0)
{ 
 while($dados = $sq5->fetch_array())
 {
  //ENCONTRADA
  $placa = $dados['placa'];
  $localidade = $dados['estado'];
 } // Fecha while
} // Fecha if

if($placa == '-')
{
 $placa = 'Não encontrada!';
 $localidade = "XX";
}

echo 'Placa Encontrada : ' . $placa . '  Estado : ' . $localidade;

?>
</body>
</html>