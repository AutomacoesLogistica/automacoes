<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$usuario = isset($_GET['usuario'])?$_GET['usuario']:"vazio";
$senha = isset($_GET['senha'])?$_GET['senha']:"vazio";
$versao = isset($_GET['versao'])?$_GET['versao']:"vazio";

if($valor_ip != "vazio" && $usuario != "vazio" && $senha != "vazio" && $versao != "vazio")
{
 $API = new RouterosAPI();
 $API->debug = false;
 $result = [];
 $quantidade_interfaces = 0;
 $msg = "";
 if ($API->connect($valor_ip, $usuario, $senha)) 
 {
  //Caso conecte com sucesso realiza o comando abaixo
  $API->write('/system/resource/print'); // Comando a executar no terminal
  $READ = $API->read(false);
  //var_dump($READ);
  $ARRAY = $API->parseResponse($READ);
  $quantidade_interfaces = 1;//intval(count($ARRAY));
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
   
    $mensagem = $result[0];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $uptime = $b->uptime;
    $version = $b->version;
    
    if(doubleval($version) >= doubleval($versao)  )
    {
        $msg = "UPTIME = " . $uptime . " </BR> Versão =  " . $version . " (Não necessario atualizar)</BR>";
    }
    else
    {
        $msg = "UPTIME = " . $uptime . " </BR> Versão =  " . $version . " (Necessario atualizar)</BR>";
    }
    
     
     echo $msg;  
   
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
