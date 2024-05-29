<?php

$v_msg1 = isset($_GET['mensagem1'])?$_GET['mensagem1']:'d__________________';
$v_msg2 = isset($_GET['mensagem2'])?$_GET['mensagem2']:'d__________________';

// Para sincronizar com as tatativas la embaixo
$vv_msg1 = $v_msg1;
$vv_msg2 = $v_msg2; 
//*********************************************

$mensagem = $v_msg1;
$mensagem2 = $v_msg2;

$veiculo = '-';
$condicao_veiculo = '-';
$opcao = '-';
$publicar_display = "nao";
$mensagem_aux = "";
$peso = "";
$semaforo_entrada = "";
$semaforo_saida = "";

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM configuracoes WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $publicar_display =$dados['publicar_display'];
}

//Busco para verificar se esta marcado para atualizar display com deixar escrito Em Desenvolvimento!
if($publicar_display == "" || $publicar_display == "false")
{
  $publicar_display = "nao";
}
else
{
  $publicar_display == "sim";
}


include_once 'conexao.php';

$sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 #$mensagem =$dados['mensagem1']; // Vem pela api
 #$mensagem2 = $dados['mensagem2']; //Vem pela api
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
 $mensagem_aux = $dados['mensagem_aux'];
 $peso = $dados['peso'];
 $semaforo_entrada = $dados['semaforo_entrada'];
 $semaforo_saida = $dados['semaforo_saida'];
}


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



/*
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

*/

// AGORA TRATO SE EXISTE CARGA DESCENTRALIZADA 
if($vv_msg1 == '_Atencao:_Carga___' ) //Mensagem de carga descentralizada!
{
 //Existe um alerta de carga descentralizada, insiro localmente no excesso
 //alerta no semaforo semáforo!
 include_once 'conexao.php';
 $mensagem_lora = ">1,2<"; 
 //$sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
 
 //Agora atualizo os dados no historico_display
 include_once 'conexao.php';
 $statusProcesso = "Carga Descentralizada";
 $sql = $dbcon->query("UPDATE historico_display SET condicao1='$statusProcesso',tratado_por_segurpro='Não necessário!',tratado_por_ccl='--',id_cheio_vazio='$id_cheio_vazio',api_cheio_vazio='$api_cheio_vazio',id_lidar='$api_lidar',veiculo='$veiculo',condicao_veiculo='$condicao_veiculo' WHERE id='$id_historico'");
 
 
 //Limpo os dados do banco
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='0',semaforo_saida='1',mensagem1='Aguardando_veiculo!',mensagem2='___________________',mensagem_aux='_______',crc_display='',epc_carreta='-',ultima_epc_carreta='$epc_carreta',ponto='-',api_cheio_vazio='-',api_lidar='-',ultima_api_lidar='$api_lidar',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_lidar='-',veiculo='-',condicao_veiculo='-',id_historico='-',epc_cavalo='-',placa_cavalo='-',opcao='-',dlc='-',dtc='-' WHERE id='1'");
 
 
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
} // Fecha if($v_msg1 == '_Atencao:_Carga___') //Mensagem de carga descentralizada!





















// AGORA TRATO SE EXISTE EXCESSO
else if($vv_msg1 == '_Dirija-se_para_o__' ) //Mensagem de excesso!
{
 //Existe um alerta de excesso, insiro localmente no excesso
 //alerta no semaforo semáforo!
 include_once 'conexao.php';
 $mensagem_lora = ">1,2<"; 
 //$sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");

 //Agora atualizo os dados no historico_display
 include_once 'conexao.php';
 $statusProcesso = "Excesso/Falta";
 $sql = $dbcon->query("UPDATE historico_display SET condicao1='$statusProcesso',tratado_por_segurpro='Não necessário!',tratado_por_ccl='--',id_cheio_vazio='$id_cheio_vazio',api_cheio_vazio='$api_cheio_vazio',id_lidar='$api_lidar',veiculo='$veiculo',condicao_veiculo='$condicao_veiculo' WHERE id='$id_historico'");
 
 //Limpo os dados do banco
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='0',semaforo_saida='1',mensagem1='Aguardando_veiculo!',mensagem2='___________________',mensagem_aux='_______',crc_display='',epc_carreta='-',ultima_epc_carreta='$epc_carreta',ponto='-',api_cheio_vazio='-',api_lidar='-',ultima_api_lidar='$api_lidar',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_lidar='-',veiculo='-',condicao_veiculo='-',id_historico='-',epc_cavalo='-',placa_cavalo='-',opcao='-',dlc='-',dtc='-' WHERE id='1'");
 
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
} // Fecha if($vv_msg1 == '_Atencao:_Carga___') //Mensagem de excesso














else if($vv_msg1 == 'Aguardando veiculo!')
{
 if($id_historico !='-' && $id_historico!='')
 {
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE historico_display SET id_cheio_vazio='$id_cheio_vazio',api_cheio_vazio='$api_cheio_vazio',id_lidar='$api_lidar',veiculo='$veiculo',condicao_veiculo='$condicao_veiculo',sigla_transportadora='$sigla_transportadora' WHERE id='$id_historico'");
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
 
 //Limpo os dados do banco
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='0',semaforo_saida='1',mensagem1='Aguardando_veiculo!',mensagem2='___________________',mensagem_aux='_______',crc_display='',epc_carreta='-',ultima_epc_carreta='$epc_carreta',ponto='-',api_cheio_vazio='-',api_lidar='-',ultima_api_lidar='$api_lidar',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_lidar='-',veiculo='-',condicao_veiculo='-',id_historico='-',epc_cavalo='-',placa_cavalo='-',opcao='-',dlc='-',dtc='-' WHERE id='1'");
    
} // Fecha if($vv_msg1 == 'Aguardando_veiculo!') // Fecha o normalizar display


 




?>