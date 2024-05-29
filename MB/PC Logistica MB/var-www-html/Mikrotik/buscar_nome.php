<?php
require('./api/routeros_api.class.php');
$ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$API = new RouterosAPI();

$API->debug = false;
$quantidade_interfaces = 0;

if($ip != "vazio")
{
  if ($API->connect($ip, 'admin', 'logistica2019@@')) 
  {
    //Caso conecte com sucesso realiza o comando abaixo
     $API->write('/system/identity/print'); // Comando a executar no terminal
     $READ = $API->read(false);
     $ARRAY = $API->parseResponse($READ);
     $result = ($ARRAY);
     $API->disconnect();
  }
  $mensagem = $result[0];
  $v = json_encode($mensagem);
  //echo($v);
  $b = json_decode($v);
  $nome = $b->name;
    
  echo $nome;
  
  
}
else
{
  echo "erro!";
}
?>
