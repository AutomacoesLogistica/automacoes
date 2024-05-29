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
    $mensagem  = "";
   
    
    include_once 'conexao5.php';
     $sql = $dbcon->query("SELECT * FROM tela_acesso_rom WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['mensagem']; // busco o valor que esta agora
 } // fecha o while
}// fecha o if
    
if($mensagem =="")
{
  $mensagem = "INI";  
}
    echo json_encode($mensagem);
    ?>
</body>
</html>