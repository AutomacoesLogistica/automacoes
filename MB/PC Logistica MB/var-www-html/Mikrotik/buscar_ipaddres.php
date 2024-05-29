<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$usuario = isset($_GET['usuario'])?$_GET['usuario']:"vazio";
$senha = isset($_GET['senha'])?$_GET['senha']:"vazio";

if($valor_ip != "vazio" && $usuario != "vazio" && $senha != "vazio")
{
 $API = new RouterosAPI();
 $API->debug = false;
 $result = [];
 $quantidade_interfaces = 0;
 $msg = "";
 if ($API->connect($valor_ip, $usuario, $senha)) 
 {
  //Caso conecte com sucesso realiza o comando abaixo
  $API->write('/ip/address/print'); // Comando a executar no terminal
  $READ = $API->read(false);
  //var_dump($READ);
  $ARRAY = $API->parseResponse($READ);
  $quantidade_interfaces = intval(count($ARRAY));
  $result = ($ARRAY);
  //var_dump($result);
  $API->disconnect();
  if($quantidade_interfaces >0)
  {
   echo "Dados **************************************************";
   echo "</BR>";echo "</BR>";echo "</BR>";
   echo "Quantidade de Interfaces = " . $quantidade_interfaces;
   echo "</BR>";
   echo "</BR>";
   //var_dump($result);  
   for ($x = 0; $x < $quantidade_interfaces; $x++) 
   {
    $mensagem = $result[$x];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $ip = $b->address;
    $interface = $b->interface;
    $sub_rede = $b->network;
    if($x==0)
    {
     $msg = "> " . $ip . " - " . $interface . "</BR>";
    }
    else if($x==1)
    {
     echo "> " . $ip . " - " . $interface;
     echo "</BR>";
     echo $msg; 
    }
    else
    {
     echo "> " . $ip . " - " . $interface;
     echo "</BR>";
    }
   } // Fecha o for  
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
