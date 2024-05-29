<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$usuario = isset($_GET['usuario'])?$_GET['usuario']:"vazio";
$senha = isset($_GET['senha'])?$_GET['senha']:"vazio";
$condicao = '';

if($valor_ip != "vazio" && $usuario != "vazio" && $senha != "vazio")
{
 $API = new RouterosAPI();
 $API->debug = false;
 $result = [];
 $quantidade_interfaces = 0;
 $msg = "";
 if ($API->connect($valor_ip, $usuario, $senha)) 
 {
  //Caso conecte com sucesso realiza o comando abaixo
  $API->write('/ip/firewall/filter/print'); // Comando a executar no terminal
  $READ = $API->read(false);
  //var_dump($READ);
  $ARRAY = $API->parseResponse($READ);
  $quantidade_interfaces = 1;//intval(count($ARRAY));
  $result = ($ARRAY);
  //var_dump($result);
  
  
  if($quantidade_interfaces >0) // Pega apenas a primeira regra!
  {
   
    $mensagem = $result[0];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $comentario = $b->comment;
    //echo $comentario;
    if (mb_strpos($comentario, 'BLOQUEADO') !== false)
    {
      //echo "Está BLOQUEADO!";
      //Agora dou um comando para HABILITAR
      $API->comm("/ip/firewall/filter/disable", array(
        "numbers" => "0",
      ));
      //Agora dou um comando para mudar o comentario para HABILITADA
      $API->comm("/ip/firewall/filter/set", array(
        "comment" => "Marcacao Pires - HABILITADA",
        "numbers" => "0",
      ));
      echo "Foi habilitado";
      $condicao = "Foi habilitado";
    }
    else
    {
     //echo "Esta HABILITADA!";   
     //Agora dou um comando para BLOQUEAR
     $API->comm("/ip/firewall/filter/enable", array(
        "numbers" => "0",
      ));
      //Agora dou um comando para mudar o comentario para HABILITADA
      $API->comm("/ip/firewall/filter/set", array(
        "comment" => "Marcacao Pires - BLOQUEADO",
        "numbers" => "0",
      ));
      echo "Foi desabilitado"; 
      $condicao = "Foi desabilitado";
    }
  } // Fecha quantidade >0
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


if($condicao == "Foi habilitado")
{
  //Tenho que voltar a tela para 0 para reexibir a tela original do sistema do GAGF!
  include_once 'conexao_tela_pires.php';
  $sql = $dbcon->query("UPDATE tela_pires SET tela='0' WHERE id='1'");
}

?>
