<?php
require('./api/routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = false;
$quantidade_usuarios = 0;

if ($API->connect('192.168.10.2', 'admin', 'logistica2019@@')) 
{
    //Verifico se ja existe o usuario
    $API->write('/radius/print'); // Comando a executar no terminal
    $resposta = $API->read();
    $quantidade_usuarios = count($resposta);
    //var_dump($resposta);
    for ($x = 0; $x < $quantidade_usuarios; $x++) 
    {
    $mensagem = $resposta[$x];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $ip = $b->address;
    //echo "> " . $ip ;
    //echo "</BR>";
    }
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
    

    
    //$API->write('/user aaa set use-radius=yes');
    $API->disconnect();
   


}

?>

