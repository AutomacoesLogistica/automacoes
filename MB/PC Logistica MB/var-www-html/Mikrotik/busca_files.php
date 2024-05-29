<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$usuario = isset($_GET['usuario'])?$_GET['usuario']:"vazio";
$senha = isset($_GET['senha'])?$_GET['senha']:"vazio";

$skin_usuario = "nao";
$skin_suporte = "nao";

if($valor_ip != "vazio" && $usuario != "vazio" && $senha != "vazio")
{
 $API = new RouterosAPI();
 $API->debug = false;
 $result = [];
 $quantidade_dados = 0;
 $msg = "";
 if ($API->connect($valor_ip, $usuario, $senha)) 
 {
  //Caso conecte com sucesso realiza o comando abaixo
  $API->write('/file/print'); // Comando a executar no terminal
  $READ = $API->read(false);
  //var_dump($READ);
  $ARRAY = $API->parseResponse($READ);
  $quantidade_dados = intval(count($ARRAY));
  $result = ($ARRAY);
  //var_dump($result);
  
  $API->disconnect();
  if($quantidade_dados >0)
  {
   //echo "Dados **************************************************";
   //echo "</BR>";echo "</BR>";echo "</BR>";
   //echo "Quantidade de dados = " . $quantidade_dados;
   //echo "</BR>";
   //echo "</BR>";
   //var_dump($result);  
   for ($x = 0; $x < $quantidade_dados; $x++) 
   {
    $mensagem = $result[$x];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $nome = $b->name;
    //echo "NOME = " . $nome;
    //echo "</BR>";
    if($nome == "skins/usuario.json")
    {
     $skin_usuario = "sim";   
    }
    else if ( $nome == "skins/suporte.json" )
    {
     $skin_suporte = "sim";   
    }
   } // Fecha o for 
   
   if($skin_suporte == "sim" && $skin_usuario == "sim")
   {
    echo "tudo_ok";
   }
   else
   {
    echo "falta_skin";
   }
  } // Fecha quantidade >0
  
 } // Fecha if ($API->connect($valor_ip, $usuario, $senha))
 else
 {
  echo "Erro conexao!";
 }
}
else
{
 echo "Erro parametros!";  
}
?>
