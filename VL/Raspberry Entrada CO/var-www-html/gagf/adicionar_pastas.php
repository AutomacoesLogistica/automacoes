
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Acoes em Pastas Windoes</title>
</head>
<body>


<?php
include_once 'conexao.php';

$sql = $dbcon->query("SELECT * FROM lista_motoristas WHERE id<>''");

if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $cpf = $dados['cpf'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
    
  if(is_dir("C:/xampp/htdocs/GAGF/cadastros/$cpf"))// Verifica se a pasta existe
  {
   //echo "A Pasta Existe";
  }
  else
  {
   mkdir("C:/xampp/htdocs/GAGF/cadastros/".$cpf, 0777, true); // Cria a pasta no windows
   echo "Pasta criada para o cpf $cpf";
   echo "<br/>";
  }
  
 }
 echo "FIM!";
}



?>


</body>




<style>
body{
    background-color: #87CEEB;
}
</style>









</html>