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
  $API->comm("/system/ntp/client/set", array(
    "enabled" => "yes",
    "servers" => "a.ntp.br",

  ));
  echo "tudo_ok";
  
 $API->disconnect();
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

