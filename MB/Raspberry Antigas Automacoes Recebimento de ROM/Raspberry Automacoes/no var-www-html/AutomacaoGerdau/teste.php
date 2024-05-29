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
//ATUALIZA A LISTA SOMANDO UM QUE ENTROU
include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM acessos WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $dentro = $dados['dentro']; // busco o valor que esta agora
 } // fecha o while
}// fecha o if

//Atualiza o valor
$dentro = $dentro +1; // Soma um pois saiu um do patio
if($dentro <0){$dentro = 0;}
if($dentro >20){$dentro = 20;}
if($dentro ==""){$dentro = 0;}

$sql = $dbcon->query("UPDATE acessos SET dentro='$dentro' WHERE id=1"); // atualiza no banco o numero de veiculos
  ?>
</body>
</html>