<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recebimento de ROM</title>
</head>
<body>
     
<?php
error_reporting(0);
$tag_carreta = '';
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$tag = isset($_GET['epc'])?$_GET['epc']:'vazio';
$antena = isset($_GET['antena'])?$_GET['antena']:'vazio';
$equipamento = substr($tag,0,6);
$tipo = '';
$v_equipamento = 'nao';
$v_antena = 'nao';
$condicao = '';

if($equipamento == '442002')
{
 //echo 'Carreta : '. $tag;
 $v_equipamento = 'sim';
 $tipo = 'Carreta';
}
else if ($equipamento == '442001')
{
 //   echo 'Cavalo : '. $tag;
    $v_equipamento = 'sim'; 
    $tipo = 'Cavalo';
}


if($antena == '0' || $antena == '1')
{
 //echo '</BR>';
 //echo 'Entrando veiculo';
 $v_antena = 'sim';
 $condicao = 'Entrando';
}
else if ( $antena == '2' || $antena == '3')
{
   // echo '</BR>';
   // echo 'Saindo veiculo';
    $v_antena = 'sim';
    $condicao = 'Saindo';
}
else
{
 echo 'erro!';   
}


if($v_antena == 'sim' && $v_equipamento == 'sim')
{
 // Pode pesquisar a ultima placa no sistema e salvar
 // Primeiro busco se existe match ou tag salva ja para esse evento
 $encontrado = 0;
 if($tipo == 'Carreta')
 {
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM historico_match WHERE epc_carreta='$tag' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $encontrado = 1;   
   $dados = $sql->fetch_array();
   $placa_cavalo = $dados['placa_cavalo'];
   $placa_carreta = $dados['placa_carreta'];
   $data_banco = $dados['data_atualizacao'];
   $hora_banco = $dados['hora_atualizacao'];
  }
  mysqli_close();
 } //Fecha if($tipo == 'Carreta')
 
 else
 {
  //Cavalo
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM historico_match WHERE epc_cavalo='$tag' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $encontrado = 1;   
   $dados = $sql->fetch_array();
   $placa_cavalo = $dados['placa_cavalo'];
   $placa_carreta = $dados['placa_carreta'];
   $data_banco = $dados['data_atualizacao'];
   $hora_banco = $dados['hora_atualizacao'];
  }
  mysqli_close();
 } //Fecha else Cavalo
 
 // Primeiro busco no banco de lista tags de qual é essa transportadora
 $transportadora = '';
 $resumo_transportadora = '';
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$tag' ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $transportadora = $dados['nome'];
  if($encontrado == 0)
  {
   $placa = $dados[ 'placa'];
  }
 }
 mysqli_close();
 
 //Agora trago o nome resumido da transportadora
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadora' ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $resumo_transportadora = $dados['sigla'];
 }
 mysqli_close();
 $placa_salvar = '-';
 echo '</BR>';
 echo 'Acesso: ' . $condicao;
 echo '</BR>';
 if($placa_carreta != '')
 {
  $placa_salvar = $placa_carreta;
  echo 'Placa: ' . $placa_carreta;
 }
 else if ($placa_cavalo != '')
 {
  $placa_salvar = $placa_cavalo;
  echo 'Placa: ' . $placa_cavalo;   
 }
 else
 {
  if($placa == ''){$placa = '-';}
  echo 'Placa: ' . $placa;
  $placa_salvar = $placa;    
 }
 echo '</BR>';
 echo 'Tipo: ' . $tipo;
 $id = '-';

 if($transportadora == ''){$transportadora = 'Não localizado!';}
 if($resumo_transportadora == ''){$resumo_transportadora = 'Não identificado!';}
 
 
 if($condicao == 'Saindo')
 {
  echo '</BR> Entrou para tratar o saindo! </BR>';
  //Agora conecto no portal sistema SVA e busco o ultimo evento sem placa para atualizar 
  if($tipo == 'Carreta')
  {
   echo '</BR> Entrou para tratar como carreta! </BR>'; 
   $achou = 0;
   include_once 'conexao_portal_sva.php';
   $sql = $dbcon->query("SELECT * FROM cheio_vazio WHERE ((camera_id='ms0742-cam01' OR camera_id='ms0742-cam05' ) AND placa = '' ) ORDER BY id DESC LIMIT 1"); //Camera saida
   if(mysqli_num_rows($sql)>0)
   {
    $dados = $sql->fetch_array();
    $id = $dados['id']; //Pego o ID do video
    $data_banco = $dados['data_leitura'];
    $hora_banco = $dados['hora'];
    //Agora faço a conta para ver se tem menos de 10 segundos
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    $mensagem2 = explode('/',$data);
    $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
    $data_agora = $mensagem2 . ' ' . $hora;  
    //Trato a data do banco
    $mensagem = explode('/',$data_banco);
    $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
    $horario_banco = $mensagem . ' ' . $hora_banco; 
    //Agora calculo a diferença
    $data_inicio = new DateTime($data_agora);
    $data_fim = new DateTime($hora_banco);
    // Resgata diferença entre as datas
    $dateInterval = $data_inicio->diff($data_fim);
    $mensagem = $dateInterval->format("%H:%I:%S");
    echo $mensagem;echo '</BR>';
    $mensagem = explode(':',$mensagem);
    $hora = $mensagem[0];
    $minuto = $mensagem[1];
    $segundo = $mensagem[2];
    if(intval($minuto)<1 && intval($hora)==0 ){$achou = 1;}else{$achou = 0;}
    mysqli_close();
   }
   //Agora faço o update da placa e transportadora
   if($achou == 1)
   {
    echo '</BR>Salvou carreta 1</BR>';   
    include_once 'conexao_portal_sva.php';
    $sql = $dbcon->query("UPDATE cheio_vazio SET tipo='Carreta', resumo_transportadora='$resumo_transportadora', placa='$placa_salvar', epc='$tag',gagf='',gscs='',material='',nomination='',liquido='' WHERE id='$id'");
    mysqli_close();
   }
   else
   {
    //É uma tag lida que nao foi detectado evendo sva - Erro Câmera não validou !
    //Jogo ela no sistema para espera que assim que der pulso no gscs salvo um errro no sistema SVA OCR CHEIO VAZIO
    echo '</BR>Pendente para carreta!</BR>';
    include_once 'conexao_portal_sva.php';
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    $sql = $dbcon->query("INSERT INTO leituras_pendentes (epc,placa,gagf,gscs,nomination,material,liquido,resumo_transportadora,condicao,tratado,data_atualizacao,hora_atualizacao) VALUES ('$tag','$placa_salvar','','','','','','$resumo_transportadora','Saida','nao', '$data', '$hora')"); 
    mysqli_close();
   }
  } // fecha se e carreta
 } // Fecha se for Entrada
 echo '</BR>';
 echo 'ID: ' . $id;
 echo '</BR>';
 echo 'Transportadora: ' . $transportadora;
 echo '</BR>';
 echo 'Sigla: ' . $resumo_transportadora;
 echo '</BR>';
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s'); 
 echo 'Atualizado em: ' . $data .   ' - ' . $hora; 
}//Fecha if($v_antena == 'sim' && $v_equipamento == 'sim')

?>
</body>
</html>