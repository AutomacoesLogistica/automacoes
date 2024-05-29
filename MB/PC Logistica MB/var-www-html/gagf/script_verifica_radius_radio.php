<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$ip = isset($_GET['ip2'])?$_GET['ip2']:"vazio";
$tabela = isset($_GET['tabela'])?$_GET['tabela']:"vazio";
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
    //Verifico se ja existe o usuario
    $API->write('/radius/print'); // Comando a executar no terminal
    $resposta = $API->read();
    $quantidade_usuarios = count($resposta);
    //var_dump($resposta);
    //for ($x = 0; $x < $quantidade_usuarios; $x++) 
    // {
    //$mensagem = $resposta[$x];
    //$v = json_encode($mensagem);
    //echo($v);
    //$b = json_decode($v);
    //$ip = $b->address;
    //echo "> " . $ip ;
    //echo "</BR>";
   
    if ($quantidade_usuarios == 0) // Nesse caso como so insere por aqui nao vou fazer outras tratativas
    {
       echo "cadastrar";
    }
    else
    {
        echo "ja_habilitado";

        //Salvo no banco o valor da versao
        if(($tabela != '' && $tabela != 'vazio') && ($ip != 'vazio' ))
        {
         include_once 'conexao_portal_gestao.php';
         $sql = $dbcon->query("UPDATE $tabela SET radius='Sim' WHERE ip='$ip'");
        }    
    }
    

    
    //$API->write('/user aaa set use-radius=yes');
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

