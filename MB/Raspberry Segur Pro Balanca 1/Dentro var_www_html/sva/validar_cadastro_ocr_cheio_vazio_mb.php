<?php
$registro  = $_GET['registro'];
$senha2 = $_GET['senha'];
$validado = 0;
$encontrado = 0;
$nome = "";
$senha_banco="";
$primeiro_acesso = "";
$criptografia = "";
$id="";

include_once 'conexao_sva.php';


$sql = $dbcon->query("SELECT * FROM usuarios WHERE registro='$registro'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $nome = $dados['nome'];
  $id = $dados['id'];
  $criptografia = $dados['criptografia'];
  $encontrado = 1;
  
 }
}

if($encontrado == 1)
{
    $sql = $dbcon->query("UPDATE usuarios SET primeiro_acesso = '1',senha='$senha2' WHERE id='$id'");
    $validado = 1;
}
else
{
  $validado = 0;
}





if($validado == 1)
{
    echo json_encode('ok'.','.$nome.','.$registro.','.$criptografia);
}
else
{
    echo json_encode('erro,erro,erro,erro');
}





 ?>
