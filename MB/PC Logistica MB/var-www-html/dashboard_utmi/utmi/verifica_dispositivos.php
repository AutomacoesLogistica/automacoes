<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Verifica Dispositivos</title>
</head>

<body>

<?php
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  
$array_erro = array();
$array_ok = array();
$encontrados_ok = array();
$encontrados_erro = array();
$array_ponto_ok = array();
$array_ponto_erro = array();
$ponto = '';
echo ( 'Hoje : ' .$data_agora);
echo'</BR>';echo'</BR>';echo'</BR>';

//Conecto na tabela e busco os dados e faco a conta pra saber a atual condicao
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM atualizacao");
if(mysqli_num_rows($sql)>0)
{
 $encontrados_erro = 0;
 $encontrados_ok = 0;
 $encontrado = 0;
 
 while($dados = $sql->fetch_array())
 {
  $id = $dados['id'];
  $ponto = $dados['ponto'];
  $data_atualizacao = $dados['data_atualizacao'];
  $hora_atualizacao = $dados['hora_atualizacao'];
  $mensagem = explode('/',$data_atualizacao);
  $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
  $horario_banco = $mensagem . ' ' . $hora_atualizacao; 
  echo ( 'Banco : ' .$horario_banco);
  echo'</BR>';echo'</BR>';echo'</BR>';
    
  //Agora calculo a diferença
  $data_inicio = new DateTime($data_agora);
  $data_fim = new DateTime($horario_banco);
  // Resgata diferença entre as datas
  $dateInterval = $data_inicio->diff($data_fim);
  $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
  $mensagem1 = explode(' ',$mensagem);
  $vmensagem1 = explode('/',$mensagem1[0]);
  $dia = $vmensagem1[0];
  $mes = $vmensagem1[1];
  $ano = $vmensagem1[2];
  $mensagem = explode(':',$mensagem1[1]);
  $hora = $mensagem[0];
  $minuto = $mensagem[1];
  $segundo = $mensagem[2];
  echo("*********************************Resumo ****************************</BR>");
  echo('ID: '.$id);echo("</BR>");
  echo('Dia: '.$dia);echo("</BR>");
  echo('Mês: '.$mes);echo("</BR>");
  echo('Ano: '.$ano);echo("</BR>");
  echo('Hora: '.$hora);echo("</BR>");
  echo('Minuto: '.$minuto);echo("</BR>");
  echo('Segundo: '.$segundo);echo("</BR>");

  if($dia>0 || $hora>0 || $minuto > 5)
  {
    echo '</br>';echo '</br>';
    echo 'Esta com erro!';
    echo'</BR>';
    $array_erro[$encontrados_erro] = $id;
    $array_ponto_erro[$encontrados_erro] = $ponto;
    $encontrados_erro = intval($encontrados_erro) + 1;
    $encontrado = intval($encontrado) + 1;
    
  }
  else
  {
    echo '</br>';echo '</br>';
    echo 'Esta ok!';
    echo'</BR>';
    $array_ok[$encontrados_ok] = $id;
    $array_ponto_ok[$encontrados_ok] = $ponto;
    $encontrados_ok = intval($encontrados_ok) + 1;
    $encontrado = intval($encontrado) + 1;
  }
 }
}


//echo'</br>';
if($encontrado != 0)
{
  $tamanho_array_ok = count($array_ok);  
  $tamanho_array_erro = count($array_erro);  
  //echo ("Encontrados ok = ");
  include_once 'conexao.php';
  for($i=0;$i<$tamanho_array_ok;$i++)
  {
   //echo($array_ponto_ok[$i]);
   //echo',';
   //echo'</br>';
   
   //Atualizo no banco!
   date_default_timezone_set('America/Sao_Paulo');
   $data_atualizacao2 = date('d/m/Y');
   $hora_atualizacao2 = date('H:i:s');  
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE atualizacao SET condicao='OK', data_atualizacao2='$data_atualizacao2', hora_atualizacao2='$hora_atualizacao2' WHERE id='$array_ok[$i]'");
  }
  
   // AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   
   // AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   
   // AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   
   // AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   AGORA TRATO OS OFFLINES   
   include_once 'conexao.php';
   for($i=0;$i<$tamanho_array_erro;$i++)
   {
    //echo($array_ponto_erro[$i]);
    //echo',';
    //echo'</br>';
    //Atualizo no banco!
    date_default_timezone_set('America/Sao_Paulo');
    $data_atualizacao2 = date('d/m/Y');
    $hora_atualizacao2 = date('H:i:s');  
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE atualizacao SET condicao='Erro', data_atualizacao2='$data_atualizacao2', hora_atualizacao2='$hora_atualizacao2' WHERE id='$array_erro[$i]'");
   }
   



/*
  include_once 'conexao_dispositivos.php';
  for($i=0;$i<$tamanho_array_ok;$i++)
  {
   //Atualizo no banco!
   date_default_timezone_set('America/Sao_Paulo');
   $data_atualizacao2 = date('d/m/Y');
   $hora_atualizacao2 = date('H:i:s');  
   // Atualizando os dados de online
   $msg = explode('/',$data_atualizacao2);
   $valor_dia = $msg[0];
   $valor_mes = $msg[1];
   $valor_ano = $msg[2];
   $data_completa = $data_atualizacao2 . ' ' . $hora_atualizacao2;
   $valor_ping = rand(5, 15);
   $condicao = $valor_ping; // Significa online
   $tabela = $array_ponto_ok[$i];
   $tabela = str_replace(' ', '_',$tabela);  
   include_once 'conexao_dispositivos.php';
   $sql = $dbcon->query("INSERT INTO $tabela(ponto,condicao,dia,mes,ano,vdata,vhora,data_hora)VALUES('$array_ponto_ok[$i]','$condicao','$valor_dia','$valor_mes','$valor_ano','$data_atualizacao2','$hora_atualizacao2','$data_completa')");
  }
  


  


  //echo'</br>';
  
  //echo ("Encontrados erro = ");
  
  include_once 'conexao_dispositivos.php';
  for($i=0;$i<$tamanho_array_erro;$i++)
  {
   //echo($array_ponto_erro[$i]);
   //echo',';
   //echo'</br>';
   //Atualizo no banco!
   date_default_timezone_set('America/Sao_Paulo');
   $data_atualizacao2 = date('d/m/Y');
   $hora_atualizacao2 = date('H:i:s');  
   // Atualizando os dados de offline
   $msg = explode('/',$data_atualizacao2);
   $valor_dia = $msg[0];
   $valor_mes = $msg[1];
   $valor_ano = $msg[2];
   $data_completa = $data_atualizacao2 . ' ' . $hora_atualizacao2;
   $condicao = '0'; // Significa offline
   $tabela = $array_ponto_erro[$i];
   $tabela = str_replace(' ', '_',$tabela);
   include_once 'conexao_dispositivos.php';
   $sql = $dbcon->query("INSERT INTO $tabela(ponto,condicao,dia,mes,ano,vdata,vhora,data_hora)VALUES('$array_ponto_erro[$i]','$condicao','$valor_dia','$valor_mes','$valor_ano','$data_atualizacao2','$hora_atualizacao2','$data_completa')");
  
  }
  */
  
}     

?>


</body>
</html>