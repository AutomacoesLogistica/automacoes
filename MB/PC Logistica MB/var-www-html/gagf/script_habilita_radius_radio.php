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
        $API->comm("/radius/add", array(
            "address" => "192.168.10.96",
            "secret" => "logistica",
            "service" => "login",
            "timeout"  => "1s800ms",
            "protocol"  => "udp",
         ));
         $API->comm("/radius/incoming/set", array(
            "accept" => "yes",
         ));
         $API->comm("/user/aaa/set", array(
            "use-radius" => "yes",
            "default-group" => "read",
         ));
         $API->comm("/user/add", array(
            "name" => "bruno",
            "group" => "full",
            "password" => "268300",
         ));
    }
    

    echo "tudo_ok";
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

