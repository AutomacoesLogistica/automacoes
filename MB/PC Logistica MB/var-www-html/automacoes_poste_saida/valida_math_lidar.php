<?php
$publica = 1; // Permite echo na tela para debug

$id_lidar = isset($_GET['id'])?$_GET['id']:'vazio';
$ultimo_id_lidar = isset($_GET['u_id'])?$_GET['u_id']:'vazio';
$epc_carreta = isset($_GET['epc'])?$_GET['epc']:'vazio';
$ultima_epc_carreta = isset($_GET['u_epc'])?$_GET['u_epc']:'vazio';

if($id_lidar != 'vazio' && $epc_carreta != 'vazio' && $ultima_epc_carreta != 'vazio')
{

 
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 $mensagem2 = explode('/',$data);
 $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
 $data_agora = $mensagem2 . ' ' . $hora;  

 // Conecto no banco e busco os valores
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM historico_display ORDER BY id DESC LIMIT 1 ");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  { 
   $id_historico= $dados['id'];
   $data_banco = $dados['data_aqui1'];
   $hora_banco = $dados['hora_aqui1'];
   $epc_carreta_banco = $dados['epc_carreta'];
   $tamanho_data  = intval(strlen($data_banco));
   $tamanho_hora  = intval(strlen($hora_banco));
   if( $tamanho_data==10 && $tamanho_hora == 8 && ( trim($epc_carreta) == trim($epc_carreta_banco) ))
   {
    //Inverte o padrao da hora para efetuar o calculo
    $mensagem = explode('/',$data_banco);
    $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
    $horario_banco = $mensagem . ' ' . $hora_banco; 
    //Agora calculo a diferença
    $data_inicio = new DateTime($data_agora);
    $data_fim = new DateTime($hora_banco);
    // Resgata diferença entre as datas
    $dateInterval = $data_inicio->diff($data_fim);
    $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
    if($publica==1)
    {
     // echo $mensagem;
    }
    $mensagem1 = explode(' ',$mensagem);
    $vmensagem1 = explode('/',$mensagem1[0]);
    $dia = $vmensagem1[0];
    $mes = $vmensagem1[1];
    $ano = $vmensagem1[2];
    $mensagem = explode(':',$mensagem1[1]);
    $hora = $mensagem[0];
    $minuto = $mensagem[1];
    $segundo = $mensagem[2];
    if($publica==1)
    {
     echo("*********************************Resumo ****************************</BR>");
     echo('ID: '.$id_historico);echo("</BR>");
     echo('Dia: '.$dia);echo("</BR>");
     echo('Mês: '.$mes);echo("</BR>");
     echo('Ano: '.$ano);echo("</BR>");
     echo('Hora: '.$hora);echo("</BR>");
     echo('Minuto: '.$minuto);echo("</BR>");
     echo('Segundo: '.$segundo);echo("</BR>");
    }
    if($dia>0 || $mes>0 || $ano>0)
    {
     if($publica == 1)
     {
      echo '</br>';
      echo '</br>';
      echo 'Esta com erro!';
      echo'</BR>';
     }
    }
    else
    {
     //Pode comecar a tratar
     //Trato se for saida
     if((intval($minuto)<=5 && intval($hora)== 0 ))
     {
      echo '</BR>Pode validar!</BR>'; 
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id='1' ORDER BY id DESC LIMIT 1 ");
      if(mysqli_num_rows($sql)>0)
      {
        $dados = $sql->fetch_array();
        $id_cheio_vazio = $dados['id_cheio_vazio'];
      }
      if($id_cheio_vazio !='vazio' && $id_cheio_vazio != '')
      {
        $id_cheio_vazio = '-';
      }
     
      //Agora salvo o valor do id do lidar na lista do historico
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE historico_display SET id_lidar='$id_lidar',id_cheio_vazio='$id_cheio_vazio' WHERE id='$id_historico'");
      //apago a linha no banco
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE display_balanca1 SET epc_carreta='-',ultima_epc_carreta = '$epc_carreta', api_lidar='-', ultima_api_lidar='$ultimo_id_lidar',id_cheio_vazio='-' WHERE id = 1"); //id_cheio_vazio = '-'  
      //Agora verifico se id_cheio_vazio esta com algum valor
      include_once 'conexao_cheio_vazio.php';
      $sql = $dbcon->query("UPDATE deteccao SET tratado_automacao='SIM',id_lidar='$id_lidar',id_historico_display='$id_historico' WHERE id ='$id_cheio_vazio'");
      include_once 'conexao_sva.php';
      $sql = $dbcon->query("UPDATE dados_api_lidar SET id_cheio_vazio='$id_cheio_vazio',id_historico_display='$id_historico' WHERE id ='$id_lidar'");
      
     }
     else
     {
      echo 'Nao pode validar';
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE display_balanca1 SET epc_carreta='-',ultima_epc_carreta = '$epc_carreta', api_lidar='-', ultima_api_lidar='$ultimo_id_lidar',id_cheio_vazio='-' WHERE id = 1"); //id_cheio_vazio = '-'  
     } 
        
    } // fecha else  ($dia>0 || $mes>0 || $ano>0)
   } //Fecha se pode tratar
   else
   {
    //
    echo ' hora nao tem tamanho suficiente ou a tag nao bate!';
   }
  } // Fecha while
 } // fecha if(mysqli_num_rows($sql)>0)
}
else
{
 echo 'erro'  ;  
}
?>