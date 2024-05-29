<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$ip = isset($_GET['ip2'])?$_GET['ip2']:"vazio";
$tabela = isset($_GET['tabela'])?$_GET['tabela']:"vazio";
$usuario = isset($_GET['usuario'])?$_GET['usuario']:"vazio";
$senha = isset($_GET['senha'])?$_GET['senha']:"vazio";
$ja_realizado = "nao";
$tem_arquivos = "nao";

if($valor_ip != "vazio" && $usuario != "vazio" && $senha != "vazio")
{
 $API = new RouterosAPI();
 $API->debug = false;
 $result = [];
 $quantidade_interfaces = 0;
 $msg = "";
 if ($API->connect($valor_ip, $usuario, $senha)) 
 {
  //Primeiro verifico se tem os arquivos de skin dentro do radio!
  $API->write('/file/print'); // Comando a executar no terminal
  $READ = $API->read(false);
  $ARRAY = $API->parseResponse($READ);
  $quantidade_dados = intval(count($ARRAY));
  $result = ($ARRAY);
  $API->disconnect();
  if($quantidade_dados >0)
  {
   for ($x = 0; $x < $quantidade_dados; $x++) 
   {
    $mensagem = $result[$x];
    $v = json_encode($mensagem);
    $b = json_decode($v);
    $nome = $b->name;
    if($nome == "skins/usuario.json" || $nome == "flash/skins/usuario.json")
    {
     $skin_usuario = "sim";   
    }
    else if ( $nome == "skins/suporte.json"  || $nome == "flash/skins/suporte.json")
    {
     $skin_suporte = "sim";   
    }
   } // Fecha o for 
   if($skin_suporte == "sim" && $skin_usuario == "sim")
   {
    //echo "tudo_ok";
    $tem_arquivos = "sim";
   }
   else
   {
    //echo "falta_skin";
    $tem_arquivos = "nao";
   }
  } // Fecha quantidade >0
   
  if($tem_arquivos == "sim")
  {
    if ($API->connect($valor_ip, $usuario, $senha)) 
    {
     //Verifico se ja existe o usuario
     $API->write('/user/group/print'); // Comando a executar no terminal
     $resposta = $API->read();
     $quantidade_usuarios = count($resposta);
     $result = ($resposta);
     //echo "Quantidade de usuarios = " . intval($quantidade_usuarios);
     //var_dump($resposta);
     //echo "</BR>";echo "</BR>";
     for ($x = 0; $x < $quantidade_usuarios; $x++) 
     {
         $mensagem = $result[$x];
         $v = json_encode($mensagem);
         //echo($v);
         $b = json_decode($v);
         $nome = $b->name;
         //echo " NOME = " . $nome;
         //echo "</BR>";
  
         if($nome == "suporte")
         {
           $ja_realizado = "sim"  ;
           //Salvo no banco que esta ok as skins!
           if(($tabela != '' && $tabela != 'vazio') && ($ip != 'vazio' ))
           {
            include_once 'conexao_portal_gestao.php';
            $sql = $dbcon->query("UPDATE $tabela SET files='Sim' WHERE ip='$ip'");
           }    

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
      
      echo "tudo_ok";
      }
      else
      {
       echo "ja_cadastrado";
      }
  
      //$API->write('/user aaa set use-radius=yes');
      $API->disconnect();
    }
    else
    {
        echo "Erro conexao!";   
    }
  }
  else
  {
   echo "Falta inserir os arquivos de 'skin' dentro da pasta 'files' do equipamento!";
  }

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

