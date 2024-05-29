<?php
error_reporting(0);

$mensagem  = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";

if($mensagem != "vazio")
{
  //echo($mensagem);
$mensagem = explode("=",$mensagem);

$dia = $mensagem[0];
$mes = $mensagem[1];

if($mes == '01')
{
  $mes = 'janeiro';  
}
elseif($mes == '02')
{
  $mes = 'fevereiro';  
}
elseif($mes == '03')
{
  $mes = 'março';  
}
elseif($mes == '04')
{
  $mes = 'abril';  
}
elseif($mes == '05')
{
  $mes = 'maio';
}
elseif($mes == '06')
{
  $mes = 'junho';
}
elseif($mes == '07')
{
  $mes = 'julho';
}
elseif($mes == '08')
{
  $mes = 'agosto';
}
elseif($mes == '09')
{
  $mes = 'setembro';
}
elseif($mes == '10')
{
  $mes = 'outubro';  
}
elseif($mes == '11')
{
  $mes = 'novembro';  
}
else
{
  $mes = 'dezembro';  
}





$valor = $mensagem[2];
$mensagem = explode("_",$valor);
$ano = $mensagem[0];
$banco = '';
$banco = "deteccoes_".$ano; // Pega o ano
$mensagem = $mensagem[1];

include_once 'conexao_sva.php';

if($ano == "2021")
{

    $sql = $dbcon->query("SELECT * FROM deteccoes_2021 WHERE id='$dia'");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      $valor = $dados[$mes];
     }
    }
    $valor = $valor+1;
    include_once 'conexao_sva.php';
    $sql = $dbcon->query("UPDATE deteccoes_2021 SET $mes = '$valor' WHERE id='$dia'");
    

}
elseif($ano == "2022")
{
    $sql = $dbcon->query("SELECT * FROM deteccoes_2022 WHERE id='$dia'");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      $valor = $dados[$mes];
     }
    }
    $valor = $valor+1;
    include_once 'conexao_sva.php';
    $sql = $dbcon->query("UPDATE deteccoes_2022 SET $mes = '$valor' WHERE id='$dia'");    
    
   
}


}
else
{
  echno('erro');  
}
?>