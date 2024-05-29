<?php
$registro  = $_GET['registro'];
$senha2 = $_GET['senha'];
$validado = 0;
$encontrado = 0;
$nome = "";
$senha_banco="";
$primeiro_acesso = "";
$criptografia = "";

include_once 'conexao_sva.php';


if($registro != $senha2)
{
    $sql = $dbcon->query("SELECT * FROM usuarios WHERE registro='$registro'");
    if(mysqli_num_rows($sql)>0)
    {
      while($dados = $sql->fetch_array())
      {
       $validado = 1;
       $senha_banco = $dados['senha'];
       $nome = $dados['nome'];
       $primeiro_acesso = $dados['primeiro_acesso'];
       $criptografia = $dados['criptografia'];
       $encontrado = 1;
      }
      if($senha_banco == $senha2)
      {
       $validado = 1;
      }
      else
      {
       $validado = 0;
      }
    }
    else
    {
     $validado = 4;
    }
    
}
else
{
    $sql = $dbcon->query("SELECT * FROM usuarios WHERE registro='$registro'");
    if(mysqli_num_rows($sql)>0)
    {
      while($dados = $sql->fetch_array())
      {
       $nome = $dados['nome'];
       $primeiro_acesso = $dados['primeiro_acesso'];
       $criptografia = $dados['criptografia'];
       $senha_banco = $dados['senha'];
       $encontrado = 1;
      }
    }
    else
    {
     $encontrado = 0;   
    }

    if($encontrado == 1)
    { 
      if($primeiro_acesso == '0')
      {
       $validado = 2;   // Validado no sistema que está igual e se trata do primeiro acesso da pessoa
      }
      else
      {
       $validado = 3; // Ja foi alterada no sistema e digitou a mesma para registro e senha   
      }
    }
    else
    {
    $validado = 4;
    }
}


if($validado == 1)
{
    echo('ok'.','.$nome.','.$registro.','.$criptografia);
}
elseif($validado == 2)
{
    echo('primeiro_acesso'.','.$nome.','.$registro.','.$criptografia);
}
elseif($validado == 3)
{
    echo('igual,igual,igual,igual'); // Igual é não é o primeiro acesso!
}
elseif($validado == 4)
{
    echo('nao_cadastrado,nao_cadastrado,nao_cadastrado,nao_cadastrado');
}
else
{
    echo('negado,negado,negado,negado');
}

 ?>
