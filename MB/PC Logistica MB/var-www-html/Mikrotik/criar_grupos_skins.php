<?php
require('./api/routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = false;
$quantidade_usuarios = 0;
$ja_realizado = "nao";

if ($API->connect('192.168.10.2', 'bruno', '268300')) 
{
    //Verifico se ja existe o usuario
    $API->write('/user/group/print'); // Comando a executar no terminal
    $resposta = $API->read();
    $quantidade_usuarios = count($resposta);
    $result = ($resposta);
    echo "Quantidade de usuarios = " . intval($quantidade_usuarios);
    //var_dump($resposta);
    echo "</BR>";echo "</BR>";
    for ($x = 0; $x < $quantidade_usuarios; $x++) 
    {
        $mensagem = $result[$x];
        $v = json_encode($mensagem);
        //echo($v);
        $b = json_decode($v);
        $nome = $b->name;
        echo " NOME = " . $nome;
        echo "</BR>";

        if($nome == "suporte")
        {
          $ja_realizado = "sim"  ;
        }
    } 
    
    if($ja_realizado == "nao")
    {
      //Cadastro  
        
        $API->comm("/user/group/add", array(
                "name" => "usuario",
                "skin" => "usuario",
                "policy" => "read,web",
            ));
        
        $API->comm("/user/group/add", array(
                "name" => "suporte",
                "skin" => "suporte",
                "policy" => "local,write,read,policy,test,web",
            ));

        }
        else
        {
         echo "Já castrado!" ;
        }
    //$API->write('/user aaa set use-radius=yes');
    $API->disconnect();
   


}

?>

