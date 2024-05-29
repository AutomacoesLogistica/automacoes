<?php



$publica = isset($_GET['publicar'])?$_GET['publicar']:"nao";
$publica_betruck = isset($_GET['betruck'])?$_GET['betruck']:"sim";

echo "Publicar: " . $publica ."</BR>";

//RECEBE OS PARAMETROS EM CONDICAO DE TESTE ***************************************************************************
$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";
$v_epc = isset($_GET['epc'])?$_GET['epc']:"vazio";
$v_id = isset($_GET['id'])?$_GET['id']:"vazio";
$condicao_betruck = ""; //Sera usada no fim do codigo para saber o que notifica na api betruck em eventos

class consulta_banco 
{
 public $b_nome_completo;
 public $b_encontrado;
 public $b_id;
 public $b_concluido;
 public $b_status_gagf;
 public $b_epc_cavalo; 
 public $b_epc_carreta;
 public $b_placa_cavalo;
 public $b_placa_carreta;
 public $b_telefone;
 public $b_transportadora;
 public $b_destino;
 public $b_saida;
 public $b_sigla;
 public $b_pode_salvar;
 public $b_status_api_cheio_vazio;
 public $b_id_cheio_vazio;
 public $b_api_lidar;
 public $b_alerta1;
 public $b_alerta2;
 public $b_veiculo;
 public $b_condicao_veiculo;
 public $b_id_historico;
 public $b_id_lidar;
 public $b_epc_excesso;
 
}

class crc_display
{
 public $b_crc_display;
 public $b_nome_reduzido3;
}


function tags_betruck($epc_betruck,$sigla)
{
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao_saida_automacoes_tags_betruck.php';
  $sql = $dbcon->query("INSERT INTO tags_betruck(epc,sigla,data,hora)VALUES('$epc_betruck','$sigla','$data','$hora')");

}
function notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla)
{
 echo "</BR>Entrou na function >> nofiticacao_betruck << <BR/>"; 
 //consulta
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('Y-m-d');
 $hora = date('H:i:s');
 $data_agora = $data . 'T' . $hora.'Z';  //Caso eu queira usar a data de agora PADRAO "2024-05-09T12:26:05Z
 echo "</BR></BR></BR>Entrou para o post no BeTruck";
 
 //Busco os dados do ponto na tabela
 $vponto = "Saida Automações MB";
 include_once 'conexao_saida_automacoes_notificacao_betruck.php';
 $sql = $dbcon->query("SELECT * FROM referencias_betruck WHERE ponto = '$vponto'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $sn_reader = $dados['sn_reader'];
  $site = $dados['site'];
  $latitude = $dados['latitude'];
  $longitude = $dados['longitude'];
 }
 
 echo "Dados";
 echo "SN : " . $sn_reader . "</BR>";
 echo "site : " . $site . "</BR>";
 echo "latitude : " . $latitude . "</BR>";
 echo "longitude : " . $longitude . "</BR>";
 echo "ponto : " . $vponto . "</BR>";
 echo "ID : " . $id_betruck_ultima_viagem . "</BR>";
 echo "data_agora : " . $data_agora . "</BR>";
 echo "CONDICAO: " . $condicao_betruck."</BR>";
 echo "EPC_BETRUCK: " . $epc_betruck ."</BR>";
   
 echo "</BR></BR></BR></BR>";

 if ( $condicao_betruck == "Liberado!" )
 {
  echo "</BR></BR>Tratando condicao Liberado!</BR>"; 
  
  // Crio um evento no BeTruck notificando saida cheia e com processo concluido!, na justificativa coloco que foi acionada por uma tag de carreta
  $justificativa = "Veículo saindo cheio da mina com processo finalizado, ID: " .$id_gagf_ultima_viagem;
  echo "</BR>Justificativa: <b>".$justificativa."</BR>";
  
  $msg2 = "Processo ID:".$id_gagf_ultima_viagem. " finalizado!";

  //Agora faço envio para atualizar historico no BeTruck
  //Agora faço o POST para atualizar o evento do historico
  $curl = curl_init();
  curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS =>'{
    "idAgendamento": "'.$id_betruck_ultima_viagem.'",
    "idStatus": "1",
    "descricaoStatus": "'.$vponto.'",
    "localEvento": "'.$site.'",
    "latitude": '.$latitude.',
    "longitude": '.$longitude.',
    "dataHoraEvento": "'.$data_agora.'",
    "codigoDocumentoVenda": "",
    "codigoDocumentoFiscal": "",
    "codigoDocumento": "",
    "localCarga": "",
    "localDescarga": "",
    "pesoBruto": "",
    "pesoLiquido": "",
    "taraVeiculo": "",
    "usuario": "",
    "camposDinamicos": 
    {
     "alerta1": "Enviar push!",
     "alerta2": "'.$msg2.'",      
     "video_bascula": "",
     "video_placa": "",
     "imagem_bascula": "",
     "imagem_placa": "",
     "justificativa": "'.$justificativa.'",
     "sn_ponto": "'.$sn_reader.'"
    },
    "arquivoDocumento": ""
   }',
   CURLOPT_HTTPHEADER => array(
    'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
    'localEvento: Miguel Burnier',
    'Content-Type: application/json'
   ),
  ));
  
 } // Fecha if ( $condicao_betruck == "Liberado!" )
 else if ( $condicao_betruck == "Saindo Vazio da Mina!" )
 {
  echo "</BR></BR>Tratando condicao Saindo Vazio da Mina!</BR>";
  
  // Crio um evento no BeTruck notificando apenas uma saida, na justificativa coloco que foi acionada por uma tag de carreta e veiculo saiu vazio
  $justificativa = "Veículo saindo vazio da mina!";
  echo "</BR>Justificativa: <b>".$justificativa."</BR>";

  //Agora faço envio para atualizar historico no BeTruck
  //Agora faço o POST para atualizar o evento do historico
  $curl = curl_init();
  curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS =>'{
    "idAgendamento": "'.$id_betruck_ultima_viagem.'",
    "idStatus": "1",
    "descricaoStatus": "'.$vponto.'",
    "localEvento": "'.$site.'",
    "latitude": '.$latitude.',
    "longitude": '.$longitude.',
    "dataHoraEvento": "'.$data_agora.'",
    "codigoDocumentoVenda": "",
    "codigoDocumentoFiscal": "",
    "codigoDocumento": "",
    "localCarga": "",
    "localDescarga": "",
    "pesoBruto": "",
    "pesoLiquido": "",
    "taraVeiculo": "",
    "usuario": "",
    "camposDinamicos": 
    {
     "alerta1": "",
     "alerta2": "",
     "video_bascula": "",
     "video_placa": "",
     "imagem_bascula": "",
     "imagem_placa": "",
     "justificativa": "'.$justificativa.'",
     "sn_ponto": "'.$sn_reader.'"
    },
    "arquivoDocumento": ""
   }',
  CURLOPT_HTTPHEADER => array(
   'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
   'localEvento: Miguel Burnier',
   'Content-Type: application/json'
   ),
  ));
 } //Fecha else if ( $condicao_betruck == "Saindo Vazio da Mina!" )
 else if ( $condicao_betruck == "Carga Descentralizada!" )
 {
  echo "</BR></BR>Tratando condicao Carga Descentralizada!";
  
  // Crio um evento de carga descentralizada, solicito o envio do push, mas nao disparo envio do email ainda. Acionado via carreta
  $justificativa = "Veículo com carga descentralizada, necessário retornar ao pátio para ajuste da carga!";

  echo "</BR>Justificativa: <b>".$justificativa."</BR>";

  //Agora faço envio para atualizar historico no BeTruck
  //Agora faço o POST para atualizar o evento do historico
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
   "idAgendamento": "'.$id_betruck_ultima_viagem.'",
   "idStatus": "1",
   "descricaoStatus": "'.$vponto.'",
   "localEvento": "'.$site.'",
   "latitude": '.$latitude.',
   "longitude": '.$longitude.',
   "dataHoraEvento": "'.$data_agora.'",
   "codigoDocumentoVenda": "",
   "codigoDocumentoFiscal": "",
   "codigoDocumento": "",
   "localCarga": "",
   "localDescarga": "",
   "pesoBruto": "",
   "pesoLiquido": "",
   "taraVeiculo": "",
   "usuario": "",
   "camposDinamicos": 
   {
    "alerta1": "Enviar push!",
    "alerta2": "",
    "video_bascula": "",
    "video_placa": "",
    "imagem_bascula": "",
    "imagem_placa": "",
    "chave_integracao" : "carga_descentralizada",
    "justificativa": "'.$justificativa.'",
    "sn_ponto": "'.$sn_reader.'"
   },
   "arquivoDocumento": ""
  }',
  CURLOPT_HTTPHEADER => array(
   'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
   'localEvento: Miguel Burnier',
   'Content-Type: application/json'
   ),
  ));
 } // Fecha else if ( $condicao_betruck == "Carga Descentralizada!" )
 else if ( $condicao_betruck == "Excesso!" )
 {
  echo "</BR></BR>Tratando condicao Excesso!";

  // Crio um evento de excesso
  $justificativa = "Necessário retornar ao pátio de excessos para completar ou retirar o excesso da carga!";

  echo "</BR>Justificativa: <b>".$justificativa."</BR>";

  //Agora faço envio para atualizar historico no BeTruck
  //Agora faço o POST para atualizar o evento do historico
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
   "idAgendamento": "'.$id_betruck_ultima_viagem.'",
   "idStatus": "1",
   "descricaoStatus": "'.$vponto.'",
   "localEvento": "'.$site.'",
   "latitude": '.$latitude.',
   "longitude": '.$longitude.',
   "dataHoraEvento": "'.$data_agora.'",
   "codigoDocumentoVenda": "",
   "codigoDocumentoFiscal": "",
   "codigoDocumento": "",
   "localCarga": "",
   "localDescarga": "",
   "pesoBruto": "",
   "pesoLiquido": "",
   "taraVeiculo": "",
   "usuario": "",
   "camposDinamicos": 
   {
    "alerta1": "Enviar push!",
    "alerta2": "Favor retornar ao pátio de excessos para complear ou retirar o excesso da carga!",
    "video_bascula": "",
    "video_placa": "",
    "imagem_bascula": "",
    "imagem_placa": "",
    "justificativa": "'.$justificativa.'",
    "sn_ponto": "'.$sn_reader.'"
    },
    "arquivoDocumento": ""
   }',
  CURLOPT_HTTPHEADER => array(
   'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
   'localEvento: Miguel Burnier',
   'Content-Type: application/json'
   ),
  ));
 } // Fecho else if ( $condicao_betruck == "Excesso!" )

 //TRATA LOGS *********************************************************************************************************************************************************
 $response = curl_exec($curl);
 $retorno = curl_exec($curl);
 curl_close($curl);

 $valor = intval(strpos($response,"statusCode"));
 if($valor>0)
 {
  $condicao = "Erro!";
 }
 else
 {
  $condicao = "Sucesso!";
 }
 
 //AGORA TRATO SE PRECISO SALVAR A TAG POIS NAO ACHOU NO BETRUCK *******************************************************************************************************
 echo "</BR>".$response."</BR>";
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 include_once 'conexao_saida_automacoes_notificacao_betruck.php';
 $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data,hora,condicao,resposta_betruck)VALUES('$epc_betruck','$data','$hora','$condicao','$retorno')");
 echo "</BR>Entrou na function >> nofiticacao_betruck << <BR/>"; 
}


function insere___lidar_excesso($id_lidar,$id_cheio_vazio,$id_historico,$epc_excesso,$placa,$veiculo,$data,$dia,$mes,$ano,$hora,$condicao,$nome_reduzido2,$telefone,$transportadora,$destino)
{
 echo "</BR>Entrou na function >> insere___lidar_excesso << <BR/>"; 
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $v_data = explode("/",$data);
 $dia = $v_data[0];
 $mes = $v_data[1];
 $ano = $v_data[2];    
 $hora = date('H:i:s');
 
 include_once 'conexao_saida_automacoes___insere___lidar_excesso.php';
 $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,motorista,telefone,transportadora,destino,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_excesso','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$condicao','$nome_reduzido2','$telefone','$transportadora','$destino','nao','-','-','nao','0','-')");
 echo "</BR>Saiu da function >> insere___lidar_excesso << <BR/>"; 
}





function atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo)
{
 echo "</BR>Entrou na function >> atualiza___viajem << <BR/>"; 

 //Dados recebidos
 echo "</BR>concluido1 = " . $concluido1 . "</BR>";
 echo "</BR>tratado_por_segurpro = " . $tratado_por_segurpro . "</BR>";
 echo "</BR>tratado_por_ccl = " . $tratado_por_ccl . "</BR>";
 echo "</BR>vconlcuido = " . $concluido1 . "</BR>";
 echo "</BR>crc_display = " . $crc_display . "</BR>";
 echo "</BR>mensagem1 = " . $mensagem1 . "</BR>";
 echo "</BR>mensasgem2 = " . $mensagem2 . "</BR>";
 echo "</BR>id_historico_display = " . $id_historico_display . "</BR>";


 //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 
 include_once 'conexao_saida_automacoes___atualiza___viajem.php';
 $sql = $dbcon->query("UPDATE historico_display SET condicao1='$concluido1',tratado_por_segurpro='$tratado_por_segurpro',tratado_por_ccl='$tratado_por_ccl',concluido='$vconcluido',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem1',mensagem2='$mensagem2',id_cheio_vazio='$id_cheio_vazio',api_cheio_vazio='$status_api_cheio_vazio',id_lidar='$id_lidar',sigla_transportadora='$sigla',veiculo='$veiculo',condicao_veiculo='$condicao_veiculo'  WHERE id='$id_historico_display'");
          
 //SE A VIAJEM FOR CONCLUÍDO
 if($concluido1 == "Concluído")
 {
  include_once 'conexao_dashboard___atualiza___viajem.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $v_hora = explode(':',$hora);
  $v_hora = intval($v_hora[0]);
  $ano = explode('/',$data);
  $ano = $ano[2];
  $tabela = 'lista_turno_dashboard_'.$ano.'_concluidos';
  if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
  {
   $v_turno = 'v_turno1';  
  }
  else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
  {
   $v_turno = 'v_turno2';  
  }
  else
  {
   $v_turno = 'v_turno3';      
  }
  include_once 'conexao_dashboard___atualiza___viajem.php';
  $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
  {
   $dados = $sql->fetch_array(); 
   $id = $dados['id'];
   $v_turno1 = $dados['v_turno1'];
   $v_turno2 = $dados['v_turno2'];
   $v_turno3 = $dados['v_turno3'];
  }
  if($v_turno == 'v_turno1')
  {
   $v_turno1 = intval($v_turno1)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
  }
  else if ($v_turno == 'v_turno2')
  {
   $v_turno2 = intval($v_turno2)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
  }
  else
  {
   $v_turno3 = intval($v_turno3)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
  }
 }// Fecha if($concluido1 == "Concluído")
 else if ($concluido1 == "Carga Descentralizada!")
 {
  include_once 'conexao_dashboard___atualiza___viajem.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $v_hora = explode(':',$hora);
  $v_hora = intval($v_hora[0]);
  $ano = explode('/',$data);
  $ano = $ano[2];
  $tabela = 'lista_turno_dashboard_'.$ano.'_carga';
  if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
  {
   $v_turno = 'v_turno1';  
  }
  else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
  {
   $v_turno = 'v_turno2';  
  }
  else
  {
   $v_turno = 'v_turno3';      
  }
    
  include_once 'conexao_dashboard___atualiza___viajem.php';
  $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
  {
   $dados = $sql->fetch_array(); 
   $id = $dados['id'];
   $v_turno1 = $dados['v_turno1'];
   $v_turno2 = $dados['v_turno2'];
   $v_turno3 = $dados['v_turno3'];
  }
  if($v_turno == 'v_turno1')
  {
   $v_turno1 = intval($v_turno1)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
  }
  else if ($v_turno == 'v_turno2')
  {
   $v_turno2 = intval($v_turno2)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
  }
  else
  {
   $v_turno3 = intval($v_turno3)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
  }
 } // Fecha else if ($concluido1 == "Carga Descentralizada!")
 else if ($concluido1 == 'Saindo Vazio')
 {
  include_once 'conexao_dashboard___atualiza___viajem.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $v_hora = explode(':',$hora);
  $v_hora = intval($v_hora[0]);
  $ano = explode('/',$data);
  $ano = $ano[2];
  $tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
  if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
  {
   $v_turno = 'v_turno1';  
  }
  else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
  {
   $v_turno = 'v_turno2';  
  }
  else
  {
   $v_turno = 'v_turno3';      
  }
  include_once 'conexao_dashboard___atualiza___viajem.php';
  $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
  {
   $dados = $sql->fetch_array(); 
   $id = $dados['id'];
   $v_turno1 = $dados['v_turno1'];
   $v_turno2 = $dados['v_turno2'];
   $v_turno3 = $dados['v_turno3'];
  }
  if($v_turno == 'v_turno1')
  {
   $v_turno1 = intval($v_turno1)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
  }
  else if ($v_turno == 'v_turno2')
  {
   $v_turno2 = intval($v_turno2)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
  }
  else
  {
   $v_turno3 = intval($v_turno3)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
  }
 } // Fecha else if ($concluido1 == 'Saindo Vazio')
 else if ( $concluido1 == 'Patrimonial Validar!')
 {
  include_once 'conexao_dashboard___atualiza___viajem.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $v_hora = explode(':',$hora);
  $v_hora = intval($v_hora[0]);
  $ano = explode('/',$data);
  $ano = $ano[2];
  $tabela = 'lista_turno_dashboard_'.$ano.'_patrimonial';
  if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
  {
   $v_turno = 'v_turno1';  
  }
  else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
  {
   $v_turno = 'v_turno2';  
  }
  else
  {
   $v_turno = 'v_turno3';      
  }
  include_once 'conexao_dashboard___atualiza___viajem.php';
  $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
  {
   $dados = $sql->fetch_array(); 
   $id = $dados['id'];
   $v_turno1 = $dados['v_turno1'];
   $v_turno2 = $dados['v_turno2'];
   $v_turno3 = $dados['v_turno3'];
  }
  if($v_turno == 'v_turno1')
  {
   $v_turno1 = intval($v_turno1)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
  }
  else if ($v_turno == 'v_turno2')
  {
   $v_turno2 = intval($v_turno2)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
  }
  else
  {
   $v_turno3 = intval($v_turno3)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
  }
 } // Fecha else if ( $concluido1 == 'Patrimonial Validar!')
 else if ($concluido1 == "Excesso/Falta")
 {
  include_once 'conexao_dashboard___atualiza___viajem.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $v_hora = explode(':',$hora);
  $v_hora = intval($v_hora[0]);
  $ano = explode('/',$data);
  $ano = $ano[2];
  $tabela = 'lista_turno_dashboard_'.$ano.'_excesso_falta';
  if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
  {
   $v_turno = 'v_turno1';  
  }
  else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
  {
   $v_turno = 'v_turno2';  
  }
  else
  {
   $v_turno = 'v_turno3';      
  }
  include_once 'conexao_dashboard___atualiza___viajem.php';
  $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
  {
   $dados = $sql->fetch_array(); 
   $id = $dados['id'];
   $v_turno1 = $dados['v_turno1'];
   $v_turno2 = $dados['v_turno2'];
   $v_turno3 = $dados['v_turno3'];
  }
  if($v_turno == 'v_turno1')
  {
   $v_turno1 = intval($v_turno1)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
  }
  else if ($v_turno == 'v_turno2')
  {
   $v_turno2 = intval($v_turno2)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
  }
  else
  {
   $v_turno3 = intval($v_turno3)+1;
   $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
  }
 }
 echo "</BR>Saiu da function >> atualiza___viajem << <BR/>";
}


function atualiza___semaforos($mensagem_lora)
{
 echo "</BR>Entrou na function >> atualiza___semaforoes << <BR/>"; 
 include_once 'conexao_saida_automacoes___atualiza___semaforos.php';
 $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
 
 //Atualizo semaforo virtual
 $semaforo1 = substr($mensagem_lora,1,1);
 $semaforo2 = substr($mensagem_lora,3,1);
 
 include_once 'conexao_saida_automacoes___atualiza___semaforos.php';
 $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='$semaforo1',semaforo_saida='$semaforo2' WHERE id='1'");
 
 //**************************************************************************************************************************************
 echo "</BR>Saiu function >> atualiza___semaforoes << <BR/>";
}






function atualiza___atualiza_display($id,$nome_completo)
{
  echo "</BR>Entrou na function >> atualiza___atualiza_display << <BR/>"; 
 //Atualiza display***********************************************************************************************************************
 //Trato o nome
 $nome_reduzido = explode(" ",$nome_completo);
 $nome_reduzido = strtolower($nome_reduzido[0]); // Coloca o nome todo em minusculo
 $nome_reduzido = ucfirst($nome_reduzido); // Coloca a primeira letra em maiusculo
 $nome_reduzido = '__viagem_'.$nome_reduzido.'!';
 $nome_reduzido3 = $nome_reduzido;
 $tamanho_nome = 0;
 $tamanho_nome= strlen($nome_reduzido);
 
 if($tamanho_nome != 19)
 {
  $vezes = 19-intval($tamanho_nome);
  for ($i = 0; $i<$vezes;$i++) 
  {
   $nome_reduzido = $nome_reduzido. "_";//Nao retirar esse espaco!
  }
 }
 //CALCULO O CRC DISPLAY
 $mensagem = '   Tenha uma boa   ';
 $nome_reduzido = str_replace("_"," ",$nome_reduzido);
 $mensagem2 =$nome_reduzido; //aqui ja tem os dados do motorista
 $mensagem_tratada2 = "";
 $mensagem_tratada2_2 = "";
 $mensagem_CRC="";
 $mensagem_CRC_2="";
 $tamanho = 0;
 $tamanho2 = 0;
 $tamanho_mesagem1 = 0;
 $tamanho_mesagem1= strlen($mensagem);
 $tamanho_mesagem2 = 0;
 $tamanho_mesagem2= strlen($mensagem2);
 if($tamanho_mesagem1 != 19)
 {
  $vezes = 19-intval($tamanho_mesagem1);
  for ($i = 0; $i<$vezes;$i++) 
  {
   $mensagem = $mensagem. " ";//Nao retirar esse espaco!
  }
 }
 if($tamanho_mesagem2 != 19)
 {
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
  $mensagem_tratada2 = $mensagem_tratada2 .$mensagem_tratada . " ";
  $mensagem_CRC = $mensagem_CRC . strval($mensagem_tratada);
 }
 for ($i = 0; $i<strlen($mensagem2);$i++) 
 {
  $tamanho2 = $tamanho2 + 1;
  $str = substr($mensagem2,$i,1);
  $mensagem_tratada_2 = dechex(ord($str));  
  $mensagem_tratada2_2 = $mensagem_tratada2_2 .$mensagem_tratada_2 . " ";
  $mensagem_CRC_2 = $mensagem_CRC_2 . strval($mensagem_tratada_2);
 }
 $tamanho = dechex(ord($tamanho));
 $protocolo = "01 02 50 01 01 AA 01 01 82 01 01 00 ";// NAO TERIAR O ESPACO NO FIM
 $tamanho_mensagem = "32 ";// NAO TERIAR O ESPACO NO FIM Equivale a 50 em HEX
 $funcoes = "AA 10 AA 70 AA 01 "; // NAO TERIAR O ESPACO NO FIM 
 $funcoes2 = "AA 10 AA 70 AA 02 "; // NAO TERIAR O ESPACO NO FIM 
 $mensagem_fim = '03';
 $mensagem_completa = $protocolo . $tamanho_mensagem. $funcoes . strtoupper($mensagem_tratada2). $funcoes2. strtoupper($mensagem_tratada2_2) . $mensagem_fim;
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
     if (($result <<= 1) & 0x10000) $result ^= CRC16POLYN;
     $result &= 0xFFFF;
    }
   }
  }
  return $result;
 }
 //Calculando o crc e tratando para uppercase
 $crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem_completa2))));
 if(strlen($crc_16_CCITT)<4){$crc_16_CCITT = '0'.$crc_16_CCITT;}
 $mensagem_display = $mensagem_completa . ' '. substr($crc_16_CCITT,0,2). ' '. substr($crc_16_CCITT,2,2);
 $mensagem_display = str_replace(' ','',$mensagem_display);
 $crc_display = $mensagem_display; 

 //Insiro no objeto os dados da pesquisa ************************************************
 $msg_crc_display = new crc_display();
 $msg_crc_display->b_crc_display = $crc_display;
 $msg_crc_display->b_nome_reduzido3 = $nome_reduzido3;
 
 echo "</BR>Saiu da function >> atualiza___atualiza_display << <BR/>";
 return $msg_crc_display;

}



function atualiza___historico_display($id)
{
 echo "</BR>Iniciou a funcao > atualiza___historico_display < </BR>";
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');   
 
 //Atualizo que esta tratando!
 include_once 'conexao_saida_automacoes___atualiza___historico_display.php';
 $dbcon->query("UPDATE historico_display SET condicao1='Tratando!',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id'");
 echo "</BR>Finalizou a funcao > atualiza___histrorico_display < </BR></BR></BR>";
}








function atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto)
{
 echo "</BR>Iniciou a funcao > atualiza___display_balanca1 < </BR>";
 if($crc_display!='')
 {
  //Veio para atualizar depois de tratar os dados do display
  echo "</BR>Entrou no if($crc_display!='')";
 }
 else
 {
  echo "</BR>Mensagen1 = " . $mensagem1 . "</BR>";

  if($mensagem1 =="_Atencao:_Carga___") //Carga descentralizada!
  {
   include_once 'conexao_saida_automacoes___atualiza___display_balanca1.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Carga___',mensagem2='_descentralizada!__',mensagem_aux='$mensagem_aux',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
  }
  else if($mensagem1 == '_Atencao:_Procure__')
  {
   include_once 'conexao_saida_automacoes___atualiza___display_balanca1.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Procure__',mensagem2='_a_Patrimonial!____',mensagem_aux='$mensagem_aux',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
  }
  else if($mensagem1 = '_Dirija-se_para_o__')
  {
   include_once 'conexao_saida_automacoes___atualiza___display_balanca1.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Dirija-se_para_o__',mensagem2='_patio_de_excessos!',mensagem_aux='$mensagem_aux',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
  }
  else
  {
   include_once 'conexao_saida_automacoes___atualiza___display_balanca1.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET id_historico='$id',epc_carreta='$epc_carreta',placa_carreta='$placa_carreta',epc_cavalo = '$epc_cavalo',placa_cavalo='$placa_cavalo' WHERE id='1'");
  }
 }
 echo "</BR>Saiu da funcao > atualiza___display_balanca1 < </BR>";
}





function busca_dados_banco($tag)
{
 echo "</BR>Chamou a funcao >> function busca_dados_banco << </BR>";

 include_once 'conexao_saida_automacoes___busca_dados_banco.php';
 $encontrado = 0; 
 $vtag = substr($tag,0,6);
  
 if($vtag == '442002')
 {
  $sql = $dbcon->query("SELECT * FROM historico_display WHERE (epc_carreta='$tag') ORDER BY id DESC LIMIT 1");
 }
 else
 {
  $sql = $dbcon->query("SELECT * FROM historico_display WHERE (epc_cavalo='$tag') ORDER BY id DESC LIMIT 1");
 }

 echo "</BR>Iniciado a consulta!</BR>";

 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $encontrado = 1;
  $id = trim($dados['id']);
  $concluido = trim($dados['concluido']);
  $status_gagf = trim($dados['condicao2']);
  $epc_cavalo = trim($dados['epc_cavalo']);
  $epc_carreta = trim($dados['epc_carreta']);
  $placa_cavalo = trim($dados['placa_cavalo']);
  $placa_carreta = trim($dados['placa_carreta']);
  $nome_completo = $dados['motorista'];
  $telefone = $dados['telefone'];
  $transportadora = $dados['transportadora'];
  $destino = $dados['destino'];
  $saida = $dados['ponto'];
 } 
 echo "Achou!</BR>Com condicao = ".$concluido."</BR>";
 $pode_salvar = "sim"; // Mas vou verificar se ja nao esta concluido!
 
 if($transportadora != '' && $transportadora != 'Não identificado!')
 {
  //Busco a sigla
  include_once 'conexao_saida_automacoes___busca_dados_banco.php';
  $sql = $dbcon->query("SELECT * FROM transportadoras WHERE (nome='$transportadora') LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $vencontrado = 0;
   $dados = $sql->fetch_array();
   $vencontrado = 1;
   $sigla = $dados['sigla'];
  }
  if($vencontrado == 1) 
  {
   $transportadora = $sigla;
  }
  else
  {
   $transportadora = "Não identificado!";
  }
 } //Fecha if($transportadora != '' && $transportadora != 'Não identificado!')
 else
 {
  $transportadora = "Não identificado!";
 }



 if($encontrado == 0)
 {
  echo "Nao tem a tag na lista, tenho que fazer o fluxo todo!";  
  $pode_salvar = "nao";
 }

 //VERIFICO SE NAO TEM CARGA DESCENTRALIZADA!
 include_once 'conexao_saida_automacoes___busca_dados_banco.php';
 $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
 {
  $dados = $sql->fetch_array(); 
  $status_api_cheio_vazio = $dados['api_cheio_vazio'];
  $id_cheio_vazio = $dados['id_cheio_vazio'];
  $api_lidar = $dados['api_lidar'];
  $alerta1 = $dados['alerta'];
  $bbb = $dados['alerta'];
  $alerta2 = $dados['alerta2'];
  $veiculo = $dados['veiculo'];
  $condicao_veiculo = $dados['condicao_veiculo'];
  $id_historico = $dados['id_historico']; // ID do evento no historico_display
  $id_lidar = $dados['api_lidar']; // ID API lidar
  $epc_excesso = $dados['epc_carreta'];

 }

 //Imprimo os dados
 echo "Nome Completo = ". $nome_completo . "</BR>";
 echo "Encontrado? = ". $encontrado . "</BR>";
 echo "ID = ". $id . "</BR>";
 echo "Concluido? = ". $concluido . "</BR>";
 echo "Status GAGF = ". $status_gagf . "</BR>";
 echo "TAG do cavalo = ". $epc_cavalo . "</BR>";
 echo "TAG da carreta = ". $epc_carreta . "</BR>";
 echo "Placa do cavalo = ". $placa_cavalo . "</BR>";
 echo "Placa da Carreta = ". $placa_carreta . "</BR>";
 echo "Telefone = ". $telefone . "</BR>";
 echo "Transportadora = ". $transportadora . "</BR>";
 echo "Destino = ". $destino . "</BR>";
 echo "Saida = ". $saida . "</BR>";
 echo "Sigla = ". $sigla . "</BR>";
 echo "Pode salvar? = ". $pode_salvar . "</BR>";
 echo "Status API CHEIO / VAZIO = ". $status_api_cheio_vazio . "</BR>";
 echo "ID CHEIO / VAZIO = ". $id_cheio_vazio . "</BR>";
 echo "API LIDAR = ". $api_lidar . "</BR>";
 echo "Alerta1 = ". $alerta1 . "</BR>";
 echo "Alerta2 = ". $alerta2 . "</BR>";
 echo "Veiculo = ". $veiculo . "</BR>";
 echo "Condicao do Veiculo = ". $condicao_veiculo . "</BR>";
 echo "ID Historico = ". $id_historico . "</BR>";
 echo "ID LIDAR = ". $id_lidar . "</BR>";
 echo "EPC Excesso = ". $epc_excesso . "</BR>";
 


  //Insiro no objeto os dados da pesquisa ************************************************
  $msg = new consulta_banco();
  $msg->b_nome_completo = $nome_completo;
  $msg->b_encontrado = $encontrado;
  $msg->b_id = $id;
  $msg->b_concluido = $concluido;
  $msg->b_status_gagf = $status_gagf;
  $msg->b_epc_cavalo = $epc_cavalo;
  $msg->b_epc_carreta = $epc_carreta;
  $msg->b_placa_cavalo = $placa_cavalo;
  $msg->b_placa_carreta = $placa_carreta;  
  $msg->b_telefone = $telefone;
  $msg->b_transportadora = $transportadora;
  $msg->b_destino = $destino;
  $msg->b_saida = $saida;
  $msg->b_sigla = $sigla;
  $msg->b_pode_salvar = $pode_salvar;
  $msg->b_status_api_cheio_vazio = $status_api_cheio_vazio;
  $msg->b_id_cheio_vazio = $id_cheio_vazio;
  $msg->b_api_lidar = $api_lidar;
  $msg->b_alerta1 = $alerta1;
  $msg->b_alerta2 = $alerta2;
  $msg->b_veiculo = $veiculo;
  $msg->b_condicao_veiculo = $condicao_veiculo;
  $msg->b_id_historico = $id_historico;
  $msg->b_id_lidar = $id_lidar;
  $msg->b_epc_excesso = $epc_excesso;


  // *************************************************************************************
  echo "</BR>Finalizado function >> busca_dados_banco << </BR>";
  return $msg;

 
} //Fecha function busca_dados_banco($tag)






//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS
//  FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS ***********FECHA OS FUNCTIONS




// ********************************************************************************************************************

if($v_epc != 'vazio' && $v_id != 'vazio')
{
 echo "</BR></BR>Iniciando com tag de teste!</BR>";
 echo "TAG : " . $v_epc;
 echo "</BR>Com o ID = ".$v_id ." na tabela validacoes_socket!</BR>";
 echo "</BR>";
 echo "</BR></BR>Faço o UPDATE para tratando! </BR>";
 
 //Atualizo que esta tratando!
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 include_once 'conexao_saida_automacoes.php';
 $sql = $dbcon->query("UPDATE validacoes_socket SET condicao='Tratado',data_tratado='$data',hora_tratado='$hora' WHERE id='$v_id'");
 echo "</BR></BR></BR>";
}



//TRATANDO AS TAGS *******************************************************************************************************
if( ($mensagem !="vazio" && strlen($mensagem)>30) ) // TAGS RECEBIDAS PELO SOCKET DO READER 
{
 echo "</BR> Veio tratar por tag do reader</BR>";
 $mensagem = explode("#",$mensagem);
 $v_msg = explode(",",$mensagem[2]);
 $nomeReader = $v_msg[0];
 $nomeReader = explode(":",$nomeReader);
 $nomeReader = $nomeReader[1];
 $ca = $v_msg[1];
 $ca = explode(" = ",$ca);
 $ca = $ca[1];
 $hostname = explode(":",$mensagem[3]);
 $hostname = $hostname[1];
 $ip = explode(":",$mensagem[4]);
 $ip = $ip[1];
 $mac = explode(": ",$mensagem[7]);
 $mac = $mac[1];
 $mensagem1 = $mensagem[8];
 $mensagem2 = explode(" ",$mensagem1);
 $dados = $mensagem2[2];
 $dados = explode(",",$dados);
 $epc = $dados[0];
 $epc = explode("=",$epc);
 $epc = $epc[1];
 $antena = explode("=",$dados[1]);
 $antena = $antena[1];
 $ponto = "";
 if($antena =="0" || $antena == "1")
 {
  $ponto = "Saida Automações";
 }
 else
 {
  $ponto = "Erro";   
 }
 //Pode seguir o fluxo
 $pode_seguir_fluxo = "sim";
}// Fecha if($mensagem !="vazio" && strlen($mensagem)>30)
else if(($v_epc != 'vazio' &&  strlen($v_epc)==24 )) // TAGS RECEBIDAS FORÇADAS MANUALMENTE EM TESTE
{
 //Pode seguir o fluxo
 $pode_seguir_fluxo = "sim";
 echo "</BR> Veio tratar por tag do teste</BR>";
} 
else
{
 echo " Sem dados para tratar!"; 
 $pode_seguir_fluxo = "nao";  
}   


if ( $pode_seguir_fluxo == "sim")
{
 if ((strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  )  && $ponto == 'Saida Automações'  ) || (strlen($v_epc)==24 && (  substr($v_epc,0,6) =="442002" || substr($v_epc,0,6) =="442001"  ) )     )  // A segunda parte e para ter condicao de publicar manualmente para testar alguma tag
 {
  if($v_epc != 'vazio')
  {
   $v2_epc = substr($v_epc,0,6);
   $epc_betruck = $v_epc; //Para usar la embaixo na api BeTruck
  }
  else
  {
   $v1_epc = substr($epc,0,6);
   $epc_betruck = $epc; //Para usar la embaixo na api BeTruck
  }

  //  Consulto API BETRUCK ************************************************************************************************************
  //  Consulto API BETRUCK ************************************************************************************************************
  //  Consulto API BETRUCK ************************************************************************************************************
  //  Consulto API BETRUCK ************************************************************************************************************
  $localEvento = "Miguel Burnier";
   
  echo "</BR>Iniciando consulta no BeTruck com a EPC = ".$epc_betruck."</BR>";

  $curl = curl_init();
  curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/atual?tagVeiculo='.$epc_betruck,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'GET',
   CURLOPT_HTTPHEADER => array(
       'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
       'localEvento: '.$localEvento
   ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);

  $valor = intval(strpos($response,"statusCode"));
  if($valor>0)
  {
   if($epc_betruck != "vazio")
   {
    echo "</BR>Preciso salvar a tag no banco!</BR>";
    //Preciso salvar a tag pois nao encontrada no sistema do BeTruck
    tags_betruck($epc_betruck,$sigla);
   }
  }
  else
  {
   $valor = "Encontrado";



   //echo $response;
   $jsonObj = json_decode($response);

   //DADOS DO MOTORISTA ***********************************************************
   $dados_do_motorista = $jsonObj->motorista;
   $nome_do_motorista = $dados_do_motorista->nome;
   $data_validade_da_cnh = $dados_do_motorista->dataDeValidadeCNH;
   $data_validade_da_cnh = explode("T",$data_validade_da_cnh);
   $data_validade_da_cnh = $data_validade_da_cnh[0];
   $data_validade_da_cnh = explode("-",$data_validade_da_cnh);
   $data_validade_da_cnh = $data_validade_da_cnh[2].'/'. $data_validade_da_cnh[1] . '/' . $data_validade_da_cnh[0];
   $numero_da_cnh = $dados_do_motorista->cnh;
   $numero_do_cpf = $dados_do_motorista->cpf;
   $numero_do_telefone = $dados_do_motorista->telefone;
   $numero_da_tag_do_motorista = $dados_do_motorista->tag;
   $motorista_bloqueado = $dados_do_motorista->motoristaBloqueado;

   //DADOS DO VEICULO *************************************************************
   $dados_do_veiculo = $jsonObj->veiculo;
   $dados_cavalo = $dados_do_veiculo[0];
   $dados_carreta = $dados_do_veiculo[1];
   
   
       // TRATANDO DADOS DO CAVALO ****************************************************************
       $tipo_do_cavalo = $dados_cavalo->tipo;
       $rotulo_do_cavalo = $dados_cavalo->rotuloDoTipo;
       $marca_do_cavalo = $dados_cavalo->marca;
       $modelo_do_cavalo = $dados_cavalo->modelo;
       $renavam_do_cavalo = $dados_cavalo->renavam;
       $placa_do_cavalo = $dados_cavalo->placa;
       $chassi_do_cavalo = $dados_cavalo->chassi;
       $capacidade_do_cavalo = $dados_cavalo->capacidade;
       $tag_do_cavalo = $dados_cavalo->tag;
   
       // TRATANDO DADOS DA CARRETA ****************************************************************
       $tipo_da_carreta = $dados_carreta->tipo;
       $rotulo_da_carreta = $dados_carreta->rotuloDoTipo;
       $marca_da_carreta = $dados_carreta->marca;
       $modelo_da_carreta = $dados_carreta->modelo;
       $renavam_da_carreta = $dados_carreta->renavam;
       $placa_da_carreta = $dados_carreta->placa;
       $chassi_da_carreta = $dados_carreta->chassi;
       $capacidade_da_carreta = $dados_carreta->capacidade;
       $tag_da_carreta = $dados_carreta->tag;
   
   
   //DADOS DA viagem atual ********************************************************
   $dados_da_ultima_viagem = $jsonObj->viagem;
   //Dados
   $id_betruck_ultima_viagem = $dados_da_ultima_viagem->id;
   $id_gagf_ultima_viagem = $dados_da_ultima_viagem->idProgramacaoGaGf;
   $contratante_ultima_viagem = $dados_da_ultima_viagem->contratante;
   $fornecedor_ultima_viagem = $dados_da_ultima_viagem->fornecedor;
   $origem_ultima_viagem = $dados_da_ultima_viagem->origem;
   $destino_ultima_viagem = $dados_da_ultima_viagem->destino;
   $transportadora_ultima_viagem = $dados_da_ultima_viagem->transportadora;
   $material_ultima_viagem = $dados_da_ultima_viagem->material;
   $status_ultima_viagem = $dados_da_ultima_viagem->status;
   $peso_bruto_ultima_viagem = $dados_da_ultima_viagem->pesoBruto;
   $peso_liquido_ultima_viagem = $dados_da_ultima_viagem->pesoLiquido;
   $tara_veiculo_ultima_viagem = $dados_da_ultima_viagem->taraVeiculo;
   $veiculo_pesou_ultima_viagem = $dados_da_ultima_viagem->veiculoPesou;
   
   
   if($publica =="sim")
   {
    //Imprimindo os dados
      
    echo "Dados do motorista *************************************************</br>";
    echo "Nome do motorista = " . $nome_do_motorista ."</br>";
    echo "Data da validade da CNH = " . $data_validade_da_cnh ."</br>";
    echo "Numero da CNH = " . $numero_da_cnh ."</br>";
    echo "Numero do CPF = " . $numero_do_cpf ."</br>";
    echo "Numero do telefone = " . $numero_do_telefone ."</br>";
    echo "Numero da TAG do motorista = " . $numero_da_tag_do_motorista ."</br>";
    echo "Motorista bloqueado: " . $motorista_bloqueado . "</BR>";
    
    echo "</br></br>";
    
    echo "Dados do cavalo ****************************************************</br>";
    echo "Tipo do cavalo = " . $tipo_do_cavalo ." </br>";
    echo "Rotulo da cavalo = " . $rotulo_do_cavalo ." </br>";
    echo "Marca do cavalo = " . $marca_do_cavalo ." </br>";
    echo "Modelo do cavalo = " . $modelo_do_cavalo ." </br>";
    echo "Renavam do cavalo = " . $renavam_do_cavalo ." </br>";
    echo "Placa do cavalo = " . $placa_do_cavalo ." </br>";
    echo "Chassi do cavalo = " . $chassi_do_cavalo ." </br>";
    echo "Capacidade do cavalo = " . $capacidade_do_cavalo ." </br>";
    echo "EPC do cavalo = " . $tag_do_cavalo  . "</br>";
    
    echo "</br></br>";
    
    echo "Dados da carreta ****************************************************</br>";
    echo "Tipo da carreta = " . $tipo_da_carreta . "</br>";
    echo "Rotulo da carreta = " . $rotulo_da_carreta . "</br>";
    echo "Marca da carreta = " . $marca_da_carreta . "</br>";
    echo "Modelo da carreta = " . $modelo_da_carreta . "</br>";
    echo "Renavam da carreta = " . $renavam_da_carreta . "</br>";
    echo "Placa da carreta = " . $placa_da_carreta . "</br>";
    echo "Chassi da carreta = " . $chassi_da_carreta . "</br>";
    echo "Capacidade da carreta = " . $capacidade_da_carreta . "</br>";
    echo "EPC da carreta = " . $tag_da_carreta . "</br>";
    
    
    echo "</br></br>";
    
    echo "Dados da viagem atual ****************************************************</br>";
    echo "ID BeTruck da viagem atual = " . $id_betruck_ultima_viagem ."</br>";
    echo "ID GAGF da viagem atual = " . $id_gagf_ultima_viagem ."</br>";
    echo "Contratante da viagem atual = " . $contratante_ultima_viagem ."</br>";
    echo "Fornecedor da viagem atual = " . $fornecedor_ultima_viagem ."</br>";
    echo "Origem da viagem atual = " . $origem_ultima_viagem ."</br>";
    echo "Destino da viagem atual = " . $destino_ultima_viagem ."</br>";
    echo "Transportadora da viagem atual = " . $transportadora_ultima_viagem ."</br>";
    echo "Material da viagem atual = " . $material_ultima_viagem ."</br>";
    echo "Status da viagem atual = " . $status_ultima_viagem ."</br>";
    echo "Peso bruto da viagem atual = " . $peso_bruto_ultima_viagem ."</br>";
    echo "Peso liquido da viagem atual = " . $peso_liquido_ultima_viagem ."</br>";
    echo "Tara do veiculo na viagem atual = " . $tara_veiculo_ultima_viagem ."</br>";
    echo "Veiculo pesou na viagem atual = " . $veiculo_pesou_ultima_viagem ."</br>";
   } //Fecha if($publica =="sim")   
  
  } //Fecho else do if($epc_betruck != "vazio")
  
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************




  
  if($v1_epc == '442002' || $v2_epc == '442002' || $v1_epc == '442001' || $v2_epc == '442001')
  {
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $hora = date('H:i:s');
   $id_duplicado = 0;
   
   //PRIMEIRO VERIFICO SE JA NAO ESTA NA LISTA!
   if($v1_epc == '442002' || $v1_epc == '442001')
   {
     $tag = $v1_epc; // TAG lida pelo reader
   }
   else
   {
    $tag = $v_epc; // TAG inserida manualmente para testes 
   }
   echo "</BR>TAG = " . $tag . "</BR>";
   $pode_salvar = "nao";


   //Consulto no banco
   $consulta = busca_dados_banco($tag); // Busco os dados na function e espero o retorno

  //Trato os dados de retorno
  $nome_completo = $consulta->b_nome_completo; 
  $encontrado = $consulta->b_encontrado;
  $id = $consulta->b_id;
  $concluido = $consulta->b_concluido;
  $status_gagf = $consulta->b_status_gagf;
  $epc_cavalo = $consulta->b_epc_cavalo;
  $epc_carreta = $consulta->b_epc_carreta;
  $placa_cavalo = $consulta->b_placa_cavalo;
  $placa_carreta = $consulta->b_placa_carreta;  
  $telefone = $consulta->b_telefone;
  $transportadora = $consulta->b_transportadora;
  $destino = $consulta->b_destino;
  $saida = $consulta->b_saida;
  $sigla = $consulta->b_sigla;
  $pode_salvar = $consulta->b_pode_salvar;
  $status_api_cheio_vazio = $consulta->b_status_api_cheio_vazio;
  $id_cheio_vazio = $consulta->b_id_cheio_vazio;
  $api_lidar = $consulta->b_api_lidar;
  $alerta1 = $consulta->b_alerta1;
  $alerta2 = $consulta->b_alerta2;
  $veiculo = $consulta->b_veiculo;
  $condicao_veiculo = $consulta->b_condicao_veiculo; 
  $id_historico = $consulta->b_id_historico;
  $id_lidar = $consulta->b_id_lidar;
  $epc_excesso = $consulta->b_epc_excesso;


  
  echo "</BR></BR></BR>>>>>>>>>>>>>>>>>>>>>>>>>></BR>";
   //Imprimo os dados
 echo "Nome Completo = ". $nome_completo . "</BR>";
 echo "Encontrado? = ". $encontrado . "</BR>";
 echo "ID = ". $id . "</BR>";
 echo "Concluido? = ". $concluido . "</BR>";
 echo "Status GAGF = ". $status_gagf . "</BR>";
 echo "TAG do cavalo = ". $epc_cavalo . "</BR>";
 echo "TAG da carreta = ". $epc_carreta . "</BR>";
 echo "Placa do cavalo = ". $placa_cavalo . "</BR>";
 echo "Placa da Carreta = ". $placa_carreta . "</BR>";
 echo "Telefone = ". $telefone . "</BR>";
 echo "Transportadora = ". $transportadora . "</BR>";
 echo "Destino = ". $destino . "</BR>";
 echo "Saida = ". $saida . "</BR>";
 echo "Sigla = ". $sigla . "</BR>";
 echo "Pode salvar? = ". $pode_salvar . "</BR>";
 echo "Status API CHEIO / VAZIO = ". $status_api_cheio_vazio . "</BR>";
 echo "ID CHEIO / VAZIO = ". $id_cheio_vazio . "</BR>";
 echo "API LIDAR = ". $api_lidar . "</BR>";
 echo "Alerta1 = ". $alerta1 . "</BR>";
 echo "Alerta2 = ". $alerta2 . "</BR>";
 echo "Veiculo = ". $veiculo . "</BR>";
 echo "Condicao do Veiculo = ". $condicao_veiculo . "</BR>";
 echo "ID Historico = ". $id_historico . "</BR>";
 echo "ID LIDAR = ". $id_lidar . "</BR>";
 echo "EPC Excesso = ". $epc_excesso . "</BR>";
 echo "</BR></BR></BR>>>>>>>>>>>>>>>>>>>>>>>>>></BR>";

   if($pode_salvar == "sim")
   {
    echo "</BR>Entrou para validar dados do veiculo </BR>";
    if($concluido == "sim" || $concluido == "Sim")
    {
     //Nao faz nada, ja foi tratado!
     echo "</BR> Não faço nada pois esse veiculo ja foi validado e encerrou o processo!</BR>";
    }
    else
    {
     //Tenho que tratar!
     echo "</BR></BR>Preciso tratar a tag do veiculo!";
     echo "</BR>Status do GAGF = ".$status_gagf . "</BR>";
     
     //Atualizo que esta tratando!
     atualiza___historico_display($id);
     
     $crc_display='';
     $mensagem1='';
     $mensagem3='';
     $mensagem_aux='';
     
     atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem3,$mensagem_aux,$ponto);
     
     $id_historico_display = $id;
   
     if($status_gagf == "Concluído" || $status_gagf == "Saindo da Planta" )
     {
      echo "Entrou para tratar como CONCLUIDO ou SAINDO DA PLANTA!</BR>";
      echo '</BR>$status_api_cheio_vazio > ' .$status_api_cheio_vazio.'</BR>';
      echo '</BR>$alerta1 > ' . $alerta1.'</BR>';
      
      // Verifica se nao tem alerta de carga descentralizada!
      if($alerta1 =='Erro' || $alerta1 =='-' || $alerta1 =='' || $alerta1 =='Tudo OK' ) 
      {
       echo '</BR>';
       echo 'Esta tudo ok e LIBERO a saída!';
       echo '</BR>';
          
       // LIbera no BeTruck
       $condicao_betruck = "Liberado!";
       
       //Libera semáforo saída *****************************************************************************************************************
       $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
       atualiza___semaforos($mensagem_lora);
        
       //Atualizo display
       $consulta2 = atualiza___atualiza_display($id,$nome_completo); // Chama a funcao e ainda pego o retorno
       //Trato os dados de retorno
       $crc_display = $consulta2->b_crc_display; 
       $nome_reduzido3 = $consulta2->b_nome_reduzido3;

       $mensagem1 = '___Tenha_uma_boa___';
       $mensagem2 = $nome_reduzido3;
       $mensagem_aux = $placa;
       
       //Chamo para atualizar o display no banco display_balanca1 *****************************
       atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
       
       //Finalizo a viajem *********************************************************************
       $concluido1 = "Concluído";
       $tratado_por_segurpro = "Não necessário!";
       $tratado_por_ccl = "Não necessário!";
       $vconcluido = "Sim";
       atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
   
       //Notificação no BeTruck *****************************************************************
       if($valor == "Encontrado" && $publica_betruck == "sim")
       {
        notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
       }
    
      } // fecha if($alerta1 =='Erro' || $alerta1 =='-' || $alerta1 =='' || $alerta1 =='Tudo OK' )
      else
      {
       //TEVE ALERTA DE CARGA DESCENTRALIZADA, AI VERIFICO SE ESTA VAZIO, SE SIM, FOI ERRO DA API, CASO CONTRARIO É CARGA DESCENTRALIZADA   
       echo '</BR>';
       echo 'Erro - Verifico se esta vazio pois pode ter sido ERRO da API do LIDAR!';
       echo '</BR>';
       if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
       {
        echo '</BR>';
        echo 'Veiculo saindo vazio, considero como ok';
        echo '</BR>'; 
        
        // Libero tambem no BeTruck
        $condicao_betruck = "Liberado!";
   
        //Libera semáforo saída *****************************************************************************************************************
        $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
        atualiza___semaforos($mensagem_lora);
        
        //Atualizo display
        $consulta2 = atualiza___atualiza_display($id,$nome_completo); // Chama a funcao e ainda pego o retorno
        //Trato os dados de retorno
        $crc_display = $consulta2->b_crc_display; 
        $nome_reduzido = $consulta2->b_nome_reduzido3;
   
        $mensagem1 = '___Tenha_uma_boa___';
        $mensagem2 = $nome_reduzido;
        $mensagem_aux = $placa;
       
        //Chamo para atualizar o display no banco display_balanca1 *****************************
        atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
       
        //Finalizo a viajem *********************************************************************
        $concluido1 = "Concluído";
        $tratado_por_segurpro = "Não necessário!";
        $tratado_por_ccl = "Não necessário!";
        $vconcluido = "Sim";
        atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
        
        //Notificação no BeTruck *****************************************************************
        if($valor == "Encontrado" && $publica_betruck =="sim")
        {
         notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
        }
   
       }
       else
       {
        echo '</BR>';
        echo 'Esta cheio, carga descentralizada!';
        echo '</BR>'; 
        //Existe carga descentralizada!
   
        //Atualizo que esta com carga descentralizada no BeTruck  ****ATENÇÃO ****** >>> Nao notifica enviar email ainda e sim o primeiro push apenas
        $condicao_betruck = "Carga Descentralizada!";
   
        //Libera semáforo saída com alerta *****************************************************************************************************************
        $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
        atualiza___semaforos($mensagem_lora);
   
   
        
        $mensagem1 = '_Atencao:_Carga___';
        $mensagem2 = '_descentralizada!__';
        $mensagem_aux = $placa;
        
        //Chamo para atualizar o display no banco display_balanca1 *****************************
        atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
        
        //Atualizo historico_display
        
        //Atualizo o status no historico_display
        $mensagem1 = ' Atencao: Carga   ';
        $mensagem2 = ' descentralizada!  ';
        $concluido1 = "Carga Descentralizada!";
        $tratado_por_segurpro = "Não necessário!";
        $tratado_por_ccl = "Não";
        $vconcluido = "Sim";
        atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
   
        //Insere lidar_excesso
        $placa = $placa_carreta;
        $condicao = "Carga Descentralizada!";
        insere___lidar_excesso($id_lidar,$id_cheio_vazio,$id_historico,$epc_excesso,$placa,$veiculo,$data,$dia,$mes,$ano,$hora,$condicao,$nome_reduzido2,$telefone,$transportadora,$destino);
   
        //Notificação no BeTruck *****************************************************************
        if($valor == "Encontrado" && $publica_betruck =="sim")
        {
         notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
        }
   
       }// Fecha else do if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
      } // Fecha o else do if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' )
     } // Fecha if($status_gagf == "Concluído" || $status_gagf == "Saindo da Planta")
     else if($status_gagf == "Cancelado" )
     {
      //VERIFICO SE ESTA VAZIO, SE SIM, FOI ERRO DA API, CASO CONTRARIO DIRECIONO PARA PATRIMONIAL TRATAR!  
      echo '</BR>';
      echo 'Erro - Verifico se esta vazio, senao, direciono para PATRIMONIAL tratar carreta!';
      echo '</BR>';
      if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
      {
       echo '</BR>';
       echo 'Veiculo saindo vazio, considero como ok';
       echo '</BR>'; 
       
       // Libero tambem no BeTruck
       $condicao_betruck = "Liberado!";
   
       //Libera semáforo saída *****************************************************************************************************************
       $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
       atualiza___semaforos($mensagem_lora);
       
       //Atualizo display
       $consulta2 = atualiza___atualiza_display($id,$nome_completo); // Chama a funcao e ainda pego o retorno
       //Trato os dados de retorno
       $crc_display = $consulta2->b_crc_display;
       $nome_reduzido = $consulta2->b_nome_reduzido3; 
   
       $mensagem1 = '___Tenha_uma_boa___';
       $mensagem2 = $nome_reduzido;
       $mensagem_aux = $placa;
      
       //Chamo para atualizar o display no banco display_balanca1 *****************************
       atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
      
       //Finalizo a viajem *********************************************************************
       $concluido1 = "Saindo Vazio";
       $tratado_por_segurpro = "Não necessário!";
       $tratado_por_ccl = "Não necessário!";
       $vconcluido = "Sim";
       //condicao1='Saindo Vazio'
       atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
       
       //Notificação no BeTruck *****************************************************************
       if($valor == "Encontrado" && $publica_betruck =="sim")
       {
        notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
       }
      
      } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
      else
      {
       // VEICULO ESTA CHEIO, DIRECIONO PARA A PATRIMONIAL TRATAR!
       echo '</BR>';
       echo 'Esta cheio, DIRECIONO PARA PATRIMONIAL VERIFICAR!';
       echo '</BR>'; 
   
       // Notifico tambem no BeTruck
       $condicao_betruck = "Patrimonial!";
   
       //Libera semáforo saída com alerta *****************************************************************************************************************
       $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
       atualiza___semaforos($mensagem_lora);
       $mensagem1 = '_Atencao:_Procure__';
       $mensagem2 = '_a_Patrimonial!____';
       $mensagem_aux = $placa;
        
        //Chamo para atualizar o display no banco display_balanca1 *****************************
        atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
        
        //Atualizo historico_display
        
        //Atualizo o status no historico_display
        $mensagem1 = ' Atencao: Procure ';
        $mensagem2 = ' a Patrimonial!    ';
        $concluido1 = "Patrimonial Validar!";
        $tratado_por_segurpro = "Não";
        $tratado_por_ccl = "Não necessário!";
        $vconcluido = "Sim";
        atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
        
        //Notificação no BeTruck *****************************************************************
        if($valor == "Encontrado" && $publica_betruck =="sim")
        {
         notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
        }
       } // Fecha else if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
      }
      else
      {
       //Tenho que tratar pois é algo diferente
       echo "Verifico onde foi a saida pois pode ter havido um EXCESSO para carreta</BR>";
       echo "</BR>Saida foi pela " . $saida . "</BR>";
   
       if($saida =="mg")
       {
        echo "Saiu pela MG030, considero um possivel alerta de desvio!";
        echo "Primeiro vou verificar se esta cheio ou nao, se SIM, sinalizo possivel desvio, caso contrario libero a saida!";
        if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
        {
         echo '</BR>';
         echo 'Veiculo saindo vazio, considero como ok';
         echo '</BR>'; 
         
         // Libero tambem no BeTruck
         $condicao_betruck = "Liberado!";
   
         //Libera semáforo saída *****************************************************************************************************************
         $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
         atualiza___semaforos($mensagem_lora);
         
         //Atualizo display
         $consulta2 = atualiza___atualiza_display($id,$nome_completo); // Chama a funcao e ainda pego o retorno
         //Trato os dados de retorno
         $crc_display = $consulta2->b_crc_display; 
         $nome_reduzido = $consulta2->b_nome_reduzido3;
   
         $mensagem1 = '___Tenha_uma_boa___';
         $mensagem2 = $nome_reduzido;
         $mensagem_aux = $placa;
        
         //Chamo para atualizar o display no banco display_balanca1 *****************************
         atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
        
         //Finalizo a viajem *********************************************************************
         $concluido1 = "Saindo Vazio";
         $tratado_por_segurpro = "Não necessário!";
         $tratado_por_ccl = "Não necessário!";
         $vconcluido = "Sim";
         //condicao1='Saindo Vazio'
         atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
         
         //Notificação no BeTruck *****************************************************************
         if($valor == "Encontrado" && $publica_betruck =="sim")
         {
          notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
         }
        } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
        else
        {
         // VEICULO ESTA CHEIO, DIRECIONO PARA A PATRIMONIAL TRATAR!
         echo '</BR>';
         echo 'Esta cheio, DIRECIONO PARA PATRIMONIAL VERIFICAR!';
         echo '</BR>'; 
         // Notifico tambem no BeTruck
         $condicao_betruck = "Patrimonial!";
   
         //Libera semáforo saída com alerta *****************************************************************************************************************
         $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
         atualiza___semaforos($mensagem_lora);
         $mensagem1 = '_Atencao:_Procure__';
         $mensagem2 = '_a_Patrimonial!____';
         $mensagem_aux = $placa;
        
         //Chamo para atualizar o display no banco display_balanca1 *****************************
         atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
        
         //Atualizo historico_display
        
         //Atualizo o status no historico_display
         $mensagem1 = ' Atencao: Procure ';
         $mensagem2 = ' a Patrimonial!    ';
         $concluido1 = "Patrimonial Validar!";
         $tratado_por_segurpro = "Não";
         $tratado_por_ccl = "Não necessário!";
         $vconcluido = "Sim";
         atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
         
         //Notificação no BeTruck *****************************************************************
         if($valor == "Encontrado" && $publica_betruck =="sim")
         {
          notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
         }
   
        }
       } // Fecho if ($saida == "mg")
       else
       {
        //Saiu pela balança, considero um possivel excesso
        echo "Saiu pela BALANÇA 01, considero um possivel excesso!</BR>";  
        
        // Notifico tambem no BeTruck
        $condicao_betruck = "Excesso!";
   
        //Libera semáforo saída com alerta *****************************************************************************************************************
        $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
        atualiza___semaforos($mensagem_lora);
        $mensagem1 = '_Dirija-se_para_o__';
        $mensagem2 = '_patio_de_excessos!';
        $mensagem_aux = 'xxxx';
        
        //Chamo para atualizar o display no banco display_balanca1 *****************************
        atualiza___display_balanca1($id,$epc_carreta,$placa_carreta,$epc_cavalo,$placa_cavalo,$crc_display,$mensagem1,$mensagem2,$mensagem_aux,$ponto);
       
        //Atualizo o status no historico_display
        $mensagem1 = ' Dirija-se para o  ';
        $mensagem2 = ' patio de excessos!';
        $concluido1 = "Excesso/Falta";
        $tratado_por_segurpro = "Não necessário!";
        $tratado_por_ccl = "Não necessário!";
        $vconcluido = "Sim";
        
        atualiza___viajem($concluido1,$tratado_por_segurpro,$tratado_por_ccl,$vconcluido,$crc_display,$mensagem1,$mensagem2,$id_historico_display,$id_cheio_vazio,$status_api_cheio_vazio,$id_lidar,$sigla,$veiculo,$condicao_veiculo);
    
        //Insere lidar_excesso
        $placa = $placa_carreta;
        $condicao = "Excesso/Falta";
        insere___lidar_excesso($id_lidar,$id_cheio_vazio,$id_historico,$epc_excesso,$placa,$veiculo,$data,$dia,$mes,$ano,$hora,$condicao,$nome_reduzido2,$telefone,$transportadora,$destino);
        
        //Notificação no BeTruck *****************************************************************
        if($valor == "Encontrado" && $publica_betruck =="sim")
        {
         notificacao_betruck($condicao_betruck,$epc_betruck,$id_gagf_ultima_viagem,$id_betruck_ultima_viagem,$sigla);
        }
   
      } // Fecha o else que saiu pela balança 
     } // Fecho else de outra condicao sem ser CONCLUIDO, SAINDO DA PLANTA OU CANCELADO
    }  // Fecha else if($concluido == "sim" || $concluido == "Sim")
   } // Fecha if($pode_salvar == "sim")
   else
   {
    echo "Pode salvar nao!";
   }
  
  
  
  
  
  
  
  
  
  
  
 
  
  
  

  } // Fecha if($v1_epc == '442002' || $v2_epc == '442002')

 } // Fecha if ((strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  )  && $ponto == 'Saida Automações'  ) || (strlen($v_epc)==24 && (  substr($v_epc,0,6) =="442002" || substr($v_epc,0,6) =="442001"  ) )     )  // A segunda parte e para ter condicao de publicar manualmente para testar alguma tag   
} // Fecha if ( $pode_seguir_fluxo == "sim")




