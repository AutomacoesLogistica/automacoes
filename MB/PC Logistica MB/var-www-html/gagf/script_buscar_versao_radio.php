<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$ip = isset($_GET['ip2'])?$_GET['ip2']:"vazio";
$usuario = isset($_GET['usuario'])?$_GET['usuario']:"vazio";
$senha = isset($_GET['senha'])?$_GET['senha']:"vazio";
$versao = isset($_GET['versao'])?$_GET['versao']:"vazio";
$tabela = isset($_GET['tabela'])?$_GET['tabela']:"vazio";

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
    $mensagem = $result[0];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $uptime = $b->uptime;
    $version = $b->version;
    
    if(doubleval($version) >= doubleval($versao)  )
    {
        $msg = $version . "&emsp;&emsp;&emsp; <b> >>> Não é necessário atualizar <<< </b></BR>";
    }
    else
    {
        $msg = $version . "&emsp;&emsp;&emsp; <b> >>> É necessário atualizar <<< </b></BR>";
    }
    
    //Salvo no banco o valor da versao
    if(($tabela != '' && $tabela != 'vazio') && ($ip != 'vazio' ))
    {
     include_once 'conexao_portal_gestao.php';
     $version2 = explode(" ",$version);
     $sql = $dbcon->query("UPDATE $tabela SET versao='$version2[0]' WHERE ip='$ip'");
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
