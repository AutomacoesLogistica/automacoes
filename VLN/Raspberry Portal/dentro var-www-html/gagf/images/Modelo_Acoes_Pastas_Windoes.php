
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Acoes em Pastas Windoes</title>
</head>
<body>


<?php
if(is_dir("C:/xampp/htdocs/GAGF/cadastros/teste1"))// Verifica se a pasta existe
{
  echo "A Pasta Existe";
}
else
{
  echo "A Pasta não Existe";
  mkdir('C:/xampp/htdocs/GAGF/cadastros/'.'teste1', 0777, true); // Cria a pasta no windows
  echo "Pasta criada";
}

?>


</body>




<style>
body{
    background-color: #87CEEB;
}
</style>









</html>