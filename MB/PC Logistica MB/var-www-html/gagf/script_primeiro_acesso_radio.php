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
 $posicao_admin = "vazio";

 if ($API->connect($valor_ip, $usuario, $senha)) 
 {
   //Verifico a usuario do usuario admin
   $API->write('/user/print'); // Comando a executar no terminal
   $resposta = $API->read();
   $quantidade_usuarios = count($resposta);
   //var_dump($resposta);
   for ($x = 0; $x < $quantidade_usuarios; $x++) 
   {
    $mensagem = $resposta[$x];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $nome = $b->name;
    if($nome == "admin")
    {
        $posicao_admin = $x;
    }
    break;
   }
   
    //echo "Admin na posicao " . $posicao_admin;
    $API->comm("/user/add", array(
        "name" => "bruno",
        "group" => "full",
        "password" => "268300",
         ));
    
         $API->comm("/user/remove", array(
            "numbers" => $posicao_admin,
             ));

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

