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
 $transportadora = "";
 $sigla = '';
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
  $transportadora = $dados['nome'];
 } // Fecha while
} // Fecha if

if($placa == '-')
{
 $placa = 'Não encontrada!';
 $localidade = "XX";
 $transportadora = "Não identificado!";
 $sigla = "Não identificado!";
}
else
{
  //BUSCO A SIGLA
include_once 'conexao.php';
$sq5 = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadora'");
if(mysqli_num_rows($sq5)>0)
{ 
 while($dados = $sq5->fetch_array())
 {
  //ENCONTRADA
  $sigla = $dados['sigla'];
 } // Fecha while
} // Fecha if  
}//Fecha else

echo 'Placa Encontrada : ' . $placa . '  Estado : ' . $localidade;
echo "<br>";
echo "<br>";
echo "Transportadora : " . $transportadora;
echo "</br>";
echo "Sigla : " . $sigla;

?>
</body>
</html>