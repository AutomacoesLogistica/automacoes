<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atualiza Display TCP/IP</title>
</head>
<body>

<?php

$publica = 1;   //Se quiser habilitar para mandar pro display em campo salve com 1
$v_msg1 = isset($_GET['v_msg1'])?$_GET['v_msg1']:'___________________';
$v_msg2 = isset($_GET['v_msg2'])?$_GET['v_msg2']:'___________________';
$complemento = isset($_GET['complemento'])?$_GET['complemento']:'-';
$valor = isset($_GET['valor'])?$_GET['valor']:'0';
if($valor==1){$valor=2;}
 
//echo $complemento;
//echo '</BR>';echo '</BR>';echo '</BR>';
$veiculo = '-';
$condicao_veiculo = '-';
$opcao = '-';
$mensagem_aux = '-';
$ponto = '-';
$semaforo_entrada = '-';
$semaforo_saida = '-';
$sigla = '-';
$epc_cavalo = '-';
$ponto = '-';
$sigla_transportadora = '-';
$placa_cavalo = '-';
include_once 'conexao.php';
$publicar_display = "nao";
$sql = $dbcon->query("SELECT * FROM configuracoes WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $publicar_display =$dados['publicar_display'];
}
if($publicar_display == "" || $publicar_display == "false")
{
  $publicar_display = "nao";
}
else
{
  $publicar_display == "sim";
}

include_once 'conexao.php';
$mensagem ="";
$mensagem2 = "";
$mensagem_aux = "";
$ponto = "";
$semaforo_entrada = "";
$semaforo_saida = "";

$sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $mensagem =$dados['mensagem1'];
 $mensagem2 = $dados['mensagem2'];
 $epc_carreta = $dados['epc_carreta'];
 $placa_carreta = $dados['mensagem_aux'];
 $api_cheio_vazio = $dados['api_cheio_vazio']; //Pega o status da deteccao
 $id_cheio_vazio = $dados['id_cheio_vazio'];
 $api_lidar = $dados['api_lidar'];
 $alerta = $dados['alerta'];
 $alerta2 = $dados['alerta2'];
 $data_alerta = $dados['data_alerta'];
 $hora_alerta = $dados['hora_alerta'];
 $veiculo = $dados['veiculo'];
 $condicao_veiculo = $dados['condicao_veiculo'];
 $id_historico = $dados['id_historico'];
 $opcao = $dados['opcao'];
 $dlc = $dados['dlc'];
 $dtc = $dados['dtc'];

 if(strlen($epc_carreta)==24 )
 {
  //busco qual a transportadora é referente a essa tag
  // PESQUISANDO A TAG DA CARRETA!
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc_carreta' LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $sigla_transportadora = $dados['sigla'];
  }
 }

 if($sigla_transportadora =='' || $sigla_transportadora == ' '){$sigla_transportadora = '-';}
 if($epc_carreta == '' || $epc_carreta == ''){$epc_carreta = '-';}
 if($placa_carreta=='' || $placa_carreta=='_______'){$placa_carreta = '-';}
 if($id_cheio_vazio == '' || $id_cheio_vazio == ' '){$id_cheio_vazio = '-';}
 if($api_cheio_vazio == '' || $api_cheio_vazio ==' '){$api_cheio_vazio = '-';}
 if($api_lidar == '' || $api_lidar == ' '){$api_lidar = '-';}
 if($id_historico == '' || $id_historico == ' '){$id_historico = '-';}
 if($alerta == '' || $alerta == ' '){$alerta = '-';}
 if($alerta2 == '' || $alerta2 == ' '){$alerta2 = '-';}
 if($veiculo == '' || $veiculo == ' '){$veiculo = '-';}
 if($condicao_veiculo == '' || $condicao_veiculo == ' '){$condicao_veiculo = '-';}
 if($epc_cavalo == '' || $epc_cavalo == ' '){$epc_cavalo = '-';}
 if($placa_cavalo == '' || $placa_cavalo == ' '){$placa_cavalo = '-';}
 if($dlc == '' || $dlc == ' '){$dlc = '-';}
 if($dtc == '' || $dtc == ' '){$dtc = '-';} 

echo 'v_msg1 = ' . $v_msg1;echo'</BR>';
echo 'v_msg2 = ' . $v_msg2 ;echo'</BR>';
echo 'valor = ' . $valor;echo'</BR>';
echo'</BR>';
echo'</BR>';

 echo 'Resumo dos dados *************************</BR>';
 echo "</BR>";
 echo "</BR>";
 echo 'Complemento : '. $complemento;
 echo '</BR>'; 
 echo 'Publicar display : '.$publicar_display;
 echo "</BR>";
 echo 'id_cheio_vazio = ' . $id_cheio_vazio.'</BR>';
 echo 'api_cheio_vazio = ' . $api_cheio_vazio.'</BR>';
 echo 'api_lidar = ' . $api_lidar.'</BR>';
 echo 'id_historico = ' . $id_historico.'</BR>';
 echo 'DLC = ' . $dlc. '</BR>';
 echo 'DTC = ' . $dtc. '</BR>';
 echo 'alerta = ' . $alerta.'</BR>';
 echo 'alerta2 = ' . $alerta2.'</BR>';
 echo 'veiculo = ' . $veiculo.'</BR>';
 echo 'condicao_veiculo = ' . $condicao_veiculo.'</BR>';
 echo 'epc_carreta = ' . $epc_carreta.'</BR>';
 echo 'placa_carreta = ' . $placa_carreta.'</BR>';
 echo 'epc_cavalo = ' . $epc_cavalo.'</BR>';
 echo 'placa_cavalo = ' . $placa_cavalo.'</BR>';
 echo 'opcao = ' . $opcao.'</BR>';
echo '</BR>';
echo '</BR>';
echo '</BR>';
echo '</BR>';



 $mensagem_aux = $dados['mensagem_aux'];
 $ponto = $dados['ponto'];
 $semaforo_entrada = $dados['semaforo_entrada'];
 $semaforo_saida = $dados['semaforo_saida'];
} 

if($mensagem != $v_msg1 || $mensagem2 != $v_msg2)
{
 $valor = 1;

 //Pode tratar
  $v_msg1 = $mensagem;
  $v_msg2 = $mensagem2;

  //echo "v_msg1 = ".$v_msg1;
  //echo "</BR>";
  //echo "v_msg2 = ".$v_msg2;
  //echo "</BR>";echo "</BR>";
 
if($publicar_display == 'nao')
{
  $mensagem ="Em_Desenvolvimento!"; // MAX 19  
  $mensagem2 ="___________________"; // MAX 19  
}

 //Pode atualizar!
 $mensagem = str_replace("_"," ",$mensagem);
 $mensagem2 = str_replace("_"," ",$mensagem2);
 //Busco a hora atual
 $mensagem_tratada2 = "";
 $mensagem_tratada2_2 = "";
 $mensagem_CRC="";
 $mensagem_CRC_2="";
 $tamanho = 0;
 $tamanho2 = 0;
 $vezes = 0;
 $vezes2 = 0;
 $tamanho_mesagem1 = 0;
 $tamanho_mesagem1= strlen($mensagem);
 $tamanho_mesagem2 = 0;
 $tamanho_mesagem2= strlen($mensagem2);
 if($tamanho_mesagem1 != 19)
 {
  ////echo 'menor';
  $vezes = 19-intval($tamanho_mesagem1);
  for ($i = 0; $i<$vezes;$i++) 
  {
   $mensagem = $mensagem. " ";//Nao retirar esse espaco!
  }
 }
 if($tamanho_mesagem2 != 19)
 {
  ////echo 'menor';
  $vezes2 = 19-intval($tamanho_mesagem2);
  for ($i = 0; $i<$vezes2;$i++) 
  {
   $mensagem2 = $mensagem2. " ";//Nao retirar esse espaco!
  }
 }
 
 for ($i = 0; $i<strlen($mensagem);$i++) 
 {
  $tamanho = $tamanho + 1;
  $str = substr($mensagem,$i,1);
  $mensagem_tratada = dechex(ord($str));  
  ////echo substr($mensagem,$i,1) . ' = ' . $mensagem_tratada;
  ////echo '</BR>';
  $mensagem_tratada2 = $mensagem_tratada2 .$mensagem_tratada . " ";
  $mensagem_CRC = $mensagem_CRC . strval($mensagem_tratada);
 }
 for ($i = 0; $i<strlen($mensagem2);$i++) 
 {
  $tamanho2 = $tamanho2 + 1;
  $str = substr($mensagem2,$i,1);
  $mensagem_tratada_2 = dechex(ord($str));  
  ////echo substr($mensagem,$i,1) . ' = ' . $mensagem_tratada;
  ////echo '</BR>';
  $mensagem_tratada2_2 = $mensagem_tratada2_2 .$mensagem_tratada_2 . " ";
  $mensagem_CRC_2 = $mensagem_CRC_2 . strval($mensagem_tratada_2);
 }
/*
 echo 'Mensagem tratada1 : ' . $mensagem;
 echo '</BR>';
 echo '</BR>';
 echo 'Mensagem1  HEX: ';
 echo strtoupper($mensagem_tratada2);
 echo ' ----> Tamanho : ';
 echo $tamanho;
 echo '</BR>';
 echo '</BR>';
 echo 'Mensagem tratada2 : ' . $mensagem2;
 echo '</BR>';
 echo '</BR>';
 echo 'Mensagem2 HEX: ';
 echo strtoupper($mensagem_tratada2_2);
 echo ' ----> Tamanho : ';
 echo $tamanho2;
 echo '</BR>';
 echo '</BR>';
 */
 
 if($valor == 1)
 {
  echo 'Pode publicar!';
  $tamanho = dechex(ord($tamanho));
  $protocolo = "01 02 50 01 01 AA 01 01 82 01 01 00 ";// NAO TERIAR O ESPACO NO FIM
  $tamanho_mensagem = "32 ";// NAO TERIAR O ESPACO NO FIM Equivale a 50 em HEX
  $funcoes = "AA 10 AA 70 AA 01 "; // NAO TERIAR O ESPACO NO FIM 
  $funcoes2 = "AA 10 AA 70 AA 02 "; // NAO TERIAR O ESPACO NO FIM 
  $mensagem_fim = '03';
  $mensagem_completa = $protocolo . $tamanho_mensagem. $funcoes . strtoupper($mensagem_tratada2). $funcoes2. strtoupper($mensagem_tratada2_2) . $mensagem_fim;
  //echo $mensagem_completa;
  $mensagem_completa2 = strval(str_replace(" ","",$mensagem_completa ));
  //AGORA TRATO E CALCULO O CRC
  define('CRC16POLYN', 0x1021);
  function CRC16Normal($buffer) 
  {
   $result = 0xFFFF;
   if (($length = strlen($buffer)) > 0) 
   {
    for ($offset = 0; $offset < $length; $offset++) 
    {
     $result ^= (ord($buffer[$offset]) << 8);
     for ($bitwise = 0; $bitwise < 8; $bitwise++) 
     {
      if(($result <<= 1) & 0x10000) $result ^= CRC16POLYN;
      $result &= 0xFFFF;
     }
    }
   }
   return $result;
  }
  //Calculando o crc e tratando para uppercase
  $crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem_completa2))));
  if(strlen($crc_16_CCITT)<4)
  {
   $crc_16_CCITT = '0'.$crc_16_CCITT;
  }
  $mensagem_display = $mensagem_completa . ' '. substr($crc_16_CCITT,0,2). ' '. substr($crc_16_CCITT,2,2);
  $mensagem_display = str_replace(' ','',$mensagem_display);
  //echo 'O CRC e : ';
  //echo $crc_16_CCITT;
  //echo '</BR>';
  //echo '</BR>';
  //echo 'Mensagem a ser enviada para o display: ';
  //echo $mensagem_display;
  //echo '</BR>';
  //ABAIXO HABILITA ENVIAR PARA O DISPLAY
  $mensagem_a_enviar =  hex2bin($mensagem_display);
  $valor_mensagem = strval($mensagem_a_enviar);
  //$ip = "138.0.77.80";
  //$port = "3575";
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$valor_mensagem' WHERE id='1'");   
  

  if($v_msg1 == '_Atencao:_Carga___' && $opcao == '-2') //Mensagem de carga descentralizada!
  {
   //Existe um alerta de carga descentralizada, insiro localmente no excesso
   //alerta no semaforo semáforo!
   include_once 'conexao.php';
   $mensagem_lora = ">1,2<"; 
   $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
   //Agora coloco a segunda mensagem informando que é para deslocar para o patio de excessos!
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='_Dirija-se_para_o__',mensagem2='_patio_de_excessos!',mensagem_aux='-',ponto='-',opcao='-1' WHERE id='1'");   
   if($id_historico !='' && $id_historico !=0)
   {
    //Agora atualizo os dados no historico_display
    include_once 'conexao.php';
    $statusProcesso = "Carga Descentralizada";
    $sql = $dbcon->query("UPDATE historico_display SET condicao1='$statusProcesso',tratado_por_segurpro='Não necessário!',tratado_por_ccl='--',id_cheio_vazio='$id_cheio_vazio',api_cheio_vazio='$api_cheio_vazio',id_lidar='$api_lidar',veiculo='$veiculo',condicao_veiculo='$condicao_veiculo' WHERE id='$id_historico'");
    
   }
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $v_data = $nome_reduzido = explode("/",$data);
   $dia = $v_data[0];
   $mes = $v_data[1];
   $ano = $v_data[2];    
   $hora = date('H:i:s');
   //Busco a placa referente a essa tag!
   $placa = '-';
   include_once 'conexao.php';
   $sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc_carreta'");
   if(mysqli_num_rows($sql)>0)
   {
    $dados = $sql->fetch_array();
    $placa = $dados['placa'];
   }
   //Agora salvo em banco local
   //BUSCO SE A ULTIMA TAG É DIFERENTE DESSSA!
   if(strlen($epc_carreta)==24 )
   {
    //busco qual a transportadora é referente a essa tag
    // PESQUISANDO A TAG DA CARRETA!
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM lidar_excesso ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     $ultima_epc = trim($dados['epc_lidar']);
    }
    trim($ultima_epc);
    if(trim($ultima_epc) != trim($epc_carreta))
    {
     //Pode salvar excesso
     include_once 'conexao.php';
     $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$api_lidar','$id_cheio_vazio','$id_historico','$epc_carreta','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$alerta2','','','nao','0','Carga Descentralizada')");
    }
   }
   $valor = 0; // Nao mudar!, Vai atualizar o display!
  } // Fecha if($v_msg1 == '_Atencao:_Carga___' && $valor == 0) //Mensagem de carga descentralizada!
  else if($v_msg1 == '_Dirija-se_para_o__' && $opcao == '-1') // ja notificou carga descentralizada e pede para ir para o excesso!
  {
   $valor = 1; // Nao mudar
  } // Fecha else if($v_msg1 == '_Dirija-se_para_o__' && $valor == -1) // ja notificou carga descentralizada e pede para ir para o excesso!
  else
  {

  }

  //Agora verifico se existe alerta de carga descentralizada
  if($alerta2 != 'Tudo OK' && $alerta2 !='-' && $alerta2 !='' && $alerta2 !=' ' && $alerta2 !='Erro' && $opcao == '-')
  {
   
 
    $valor = 1;
    // Existe um alerta de excesso!
    // alerta no semaforo semáforo!
    include_once 'conexao.php';
    $mensagem_lora = ">1,2<"; 
    $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $v_data = $nome_reduzido = explode("/",$data);
    $dia = $v_data[0];
    $mes = $v_data[1];
    $ano = $v_data[2];    
    $hora = date('H:i:s');
    //Busco a placa referente a essa tag!
    $placa = '-';
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc_carreta'");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     $placa = $dados['placa'];
    }
    //Agora salvo em banco local
    //BUSCO SE A ULTIMA TAG É DIFERENTE DESSSA!
    if(strlen($epc_carreta)==24 )
    {
     //busco qual a transportadora é referente a essa tag
     // PESQUISANDO A TAG DA CARRETA!
     include_once 'conexao.php';
     $sql = $dbcon->query("SELECT * FROM lidar_excesso ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $ultima_epc = trim($dados['epc_lidar']);
     }
     trim($ultima_epc);
     if(trim($ultima_epc) != trim($epc_carreta))
     {
      //Pode salvar excesso
      include_once 'conexao.php';
      $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$api_lidar','$id_cheio_vazio','$id_historico','$epc_carreta','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$alerta2','','','nao','0','Excesso')");
     }
    }
   }//Fecha mensagem de excesso
  else //Esta tudo OK! - Processo Concluído ********************************************************************
  {
   $valor = 1; 
   //libero saida semáforo!
   include_once 'conexao.php';
   $mensagem_lora = ">1,0<"; 
   $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
   

   if($id_historico !='' && $id_historico !=0 )
   {
    $valor = 1;
    echo '</BR>';
    echo 'Atualizou historico_display!';
    echo '</BR>';
    //Atualizo tudo fazendo o match 
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE historico_display SET id_cheio_vazio='$id_cheio_vazio',api_cheio_vazio='$api_cheio_vazio',id_lidar='$api_lidar',veiculo='$veiculo',condicao_veiculo='$condicao_veiculo' WHERE id='$id_historico'");
    
    //Salva no banco para o python sincronizar depois
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $v_data = $nome_reduzido = explode("/",$data);
    $dia = $v_data[0];
    $mes = $v_data[1];
    $ano = $v_data[2];    
    $hora = date('H:i:s');
    include_once 'conexao.php';
    $sql = $dbcon->query("INSERT INTO sincronizar_dados(id_lidar,id_cheio_vazio,id_historico,epc_carreta,placa_carreta,epc_cavalo,placa_cavalo,dlc,dtc,alerta2,veiculo,condicao_veiculo,api_cheio_vazio,data_leitura,dia,mes,ano,hora_leitura,condicao,data_tratado,hora_tratado)VALUES('$api_lidar','$id_cheio_vazio','$id_historico','$epc_carreta','$placa_carreta','$epc_cavalo','$placa_cavalo','$dlc','$dtc','$alerta2','$veiculo','$condicao_veiculo','$api_cheio_vazio','$data','$dia','$mes','$ano','$hora','pendente','-','-')");
   }
  }


  //ATUALIZA FISICAMENTE O DISPLAY TCP IP, MOSTRANDO A MENSAGEM ATUAL!
  if($publica == 1)
  {
   $ip ="192.168.10.100";
   $port="2101";
   $sock=socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create socket");
   $con=socket_connect($sock,$ip,$port) or die("Cannot connect to socket");
   socket_write($sock,$mensagem_a_enviar); // Envia o socket
   socket_close($sock); // Fecha a conexao com o IP
  } // fecha publica

 } //Fecha strlen($epc_carreta)==24

 $complemento = "diferente";

 ?>
 <script>
 
 var v_msg1 = '<?php print $v_msg1 ?>';
 var v_msg2 = '<?php print $v_msg2 ?>';
 var complemento = '<?php print $complemento ?>';
 var valor = '<?php print $valor ?>';
setTimeout(function()
{
  location.href='./atualiza_display.php?v_msg1='+v_msg1+'&v_msg2='+v_msg2+'&complemento='+complemento+'&valor='+valor;
}, 3000); 
  

 //setTimeout("location.reload(true);",1000); // recarrega a pagina em 5 segundos
 </script>
<?php
}
else
{
 echo 'E igual!, id_historico = ' . $id_historico;
 // É igual!
 $complemento = "igual";
 
//Busco os dados antes de apagá-los!
include_once 'conexao.php';
$mensagem ="";
$mensagem2 = "";
$mensagem_aux = "";
$ponto = "";
$semaforo_entrada = "";
$semaforo_saida = "";

$sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $mensagem =$dados['mensagem1'];
 $mensagem2 = $dados['mensagem2'];
 $epc_carreta = $dados['epc_carreta'];
 $api_cheio_vazio = $dados['api_cheio_vazio']; //Pega o status da deteccao
 $id_cheio_vazio = $dados['id_cheio_vazio'];
 $api_lidar = $dados['api_lidar'];
 $alerta = $dados['alerta'];
 $alerta2 = $dados['alerta2'];
 $data_alerta = $dados['data_alerta'];
 $hora_alerta = $dados['hora_alerta'];
 $veiculo = $dados['veiculo'];
 $condicao_veiculo = $dados['condicao_veiculo'];
 $id_historico = $dados['id_historico'];
 $epc_cavalo = $dados['epc_cavalo'];
 $placa_cavalo = $dados['epc_cavalo'];
 $dlc = $dados['dlc'];
 $dtc = $dados['dtc'];

 if($id_cheio_vazio == '' || $id_cheio_vazio == ' '){$id_cheio_vazio = '-';}
 if($api_cheio_vazio == '' || $api_cheio_vazio ==' '){$api_cheio_vazio = '-';}
 if($api_lidar == '' || $api_lidar == ' '){$api_lidar = '-';}
 if($id_historico == '' || $id_historico == ' '){$id_historico = '-';}
 if($alerta == '' || $alerta == ' '){$alerta = '-';}
 if($alerta2 == '' || $alerta2 = ' '){$alerta2 = '-';}
 if($veiculo == '' || $veiculo == ' '){$veiculo = '-';}
 if($condicao_veiculo == '' || $condicao_veiculo == ' '){$condicao_veiculo = '-';}
 if($epc_cavalo == '' || $epc_cavalo = ' '){$epc_cavalo = '-';}
 if($placa_cavalo == '' || $placa_cavalo == ' '){$placa_cavalo = '-';}
 if($dlc == '' || $dlc == ' '){$dlc = '-';}
 if($dtc == '' || $dtc == ' '){$dtc = '-';} 
}

 //Normalizo semáforo!
 //include_once 'conexao.php';
 //$mensagem_lora = ">0,1<"; 
 //$sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
 
 //Atualizo semaforo virtual
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='0',semaforo_saida='1' WHERE id='1'");
 
 if(intval($valor)==2)
{
 //Limpo a tela
 //Limpar display_balanca1 ***********************************************
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='0',semaforo_saida='1',mensagem1='Aguardando_veiculo!',mensagem2='___________________',mensagem_aux='_______',epc_carreta='-',ultima_epc_carreta='$epc_carreta',ponto='-',api_cheio_vazio='-',api_lidar='-',ultima_api_lidar='$api_lidar',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_lidar='-',veiculo='-',condicao_veiculo='-',id_historico='-',epc_cavalo='-',placa_cavalo='-',opcao='-',dlc='-',dtc='-' WHERE id='1'");
  echo'</BR>';echo 'Limpando!';echo'</BR>';
 $valor = 3;
}

if(intval($valor)==3) // Para atualizar fisicamente o displaypara aguarando veiculo
{
  $tamanho = dechex(ord($tamanho));
  $protocolo = "01 02 50 01 01 AA 01 01 82 01 01 00 ";// NAO TERIAR O ESPACO NO FIM
  $tamanho_mensagem = "32 ";// NAO TERIAR O ESPACO NO FIM Equivale a 50 em HEX
  $funcoes = "AA 10 AA 70 AA 01 "; // NAO TERIAR O ESPACO NO FIM 
  $funcoes2 = "AA 10 AA 70 AA 02 "; // NAO TERIAR O ESPACO NO FIM 
  $mensagem_fim = '03';
  $mensagem_completa = $protocolo . $tamanho_mensagem. $funcoes . strtoupper($mensagem_tratada2). $funcoes2. strtoupper($mensagem_tratada2_2) . $mensagem_fim;
  //echo $mensagem_completa;
  $mensagem_completa2 = strval(str_replace(" ","",$mensagem_completa ));
  //AGORA TRATO E CALCULO O CRC
  define('CRC16POLYN', 0x1021);
  function CRC16Normal($buffer) 
  {
   $result = 0xFFFF;
   if (($length = strlen($buffer)) > 0) 
   {
    for ($offset = 0; $offset < $length; $offset++) 
    {
     $result ^= (ord($buffer[$offset]) << 8);
     for ($bitwise = 0; $bitwise < 8; $bitwise++) 
     {
      if(($result <<= 1) & 0x10000) $result ^= CRC16POLYN;
      $result &= 0xFFFF;
     }
    }
   }
   return $result;
  }
  //Calculando o crc e tratando para uppercase
  $crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem_completa2))));
  if(strlen($crc_16_CCITT)<4)
  {
   $crc_16_CCITT = '0'.$crc_16_CCITT;
  }
  $mensagem_display = $mensagem_completa . ' '. substr($crc_16_CCITT,0,2). ' '. substr($crc_16_CCITT,2,2);
  $mensagem_display = str_replace(' ','',$mensagem_display);
  //echo 'O CRC e : ';
  //echo $crc_16_CCITT;
  //echo '</BR>';
  //echo '</BR>';
  //echo 'Mensagem a ser enviada para o display: ';
  //echo $mensagem_display;
  //echo '</BR>';
  //ABAIXO HABILITA ENVIAR PARA O DISPLAY
  $mensagem_a_enviar =  hex2bin($mensagem_display);
  $valor_mensagem = strval($mensagem_a_enviar);
  //$ip = "138.0.77.80";
  //$port = "3575";
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$valor_mensagem' WHERE id='1'");  
  $ip ="192.168.10.100";
  $port="2101";
  $sock=socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create socket");
  $con=socket_connect($sock,$ip,$port) or die("Cannot connect to socket");
  socket_write($sock,$mensagem_a_enviar); // Envia o socket
  socket_close($sock); // Fecha a conexao com o IP
   
  $valor=0;

} //Fecha $valor==3




if($id_historico !='-' && $id_historico!='' && $valor==1)
{
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE historico_display SET id_cheio_vazio='$id_cheio_vazio',api_cheio_vazio='$api_cheio_vazio',id_lidar='$api_lidar',veiculo='$veiculo',condicao_veiculo='$condicao_veiculo',sigla_transportadora='$sigla_transportadora' WHERE id='$id_historico'");
 $valor = 2;
} 


 ?>
 <script>
 
 var v_msg1 = '<?php print $v_msg1 ?>';
 var v_msg2 = '<?php print $v_msg2 ?>';
 var complemento = '<?php print $complemento ?>';
 var valor = '<?php print $valor ?>'; 
 
 setTimeout(function()
 {
  location.href='./atualiza_display.php?v_msg1='+v_msg1+'&v_msg2='+v_msg2+'&complemento='+complemento+'&valor='+valor;
 }, 2000); 

</script>

<?php
} // fecha igual
?>

</body>
</html>

