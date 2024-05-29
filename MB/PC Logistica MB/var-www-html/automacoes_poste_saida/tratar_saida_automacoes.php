<?php
//  primeira coisa limpo os duplicados em alerta no lidar_excesso
include_once 'conexao.php';
$sql = $dbcon->query("DELETE p1 FROM `lidar_excesso` AS p1, `lidar_excesso` AS p2 WHERE p1.`id`<p2.`id` AND p1.`epc_lidar`=p2.`epc_lidar`;");
$epc_carreta ='-';
//*************************************************************************************************

$id = isset($_GET['id'])?$_GET['id']:'vazio';
$epc_carreta = isset($_GET['epc_carreta'])?$_GET['epc_carreta']:'vazio';

if($epc_carreta != 'vazio' && strlen($epc_carreta)==24 )
{
 //Preparo o caminho para o snapshot ********************************************************
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 $hora_foto = explode(':',$hora);
 $hora_foto = $hora_foto[0];
 $data_foto = explode('/',$data);
 $data_foto = $data_foto[2].'-'.$data_foto[1].'-'.$data_foto[0]; // Para deixar nesse formato 2022/12/01
 $url_caminho_foto = 'http://192.168.10.96/Saida01/HSUH0401241XU/'. $data_foto .'/001/jpg/'.$hora_foto.'/';
 $epc = $epc_carreta;
 //Consulto via API
 //######################################################################################################
 for ($x = 0; $x <= 2; $x++) 
 {
  $curl = curl_init();
  curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate='.$epc,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'GET',
   CURLOPT_HTTPHEADER => array(
    'Authorization: Basic c2VydmljZV9hcGlfc2NoZWR1bGU6TWluQDMyMU1pbkA='
   ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  echo $response;
  if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
  {
   if( $tentativa >=2)
   {
    //echo "nao encontrado!";
    //TEVE ERRO NA SOLICITACAO
    $tentativa = -1;
    $epc_cavalo = '-';
   }
   else
   {
    //echo "Tentando novamente!";
   } 
   $tentativa = intval($tentativa)+1;
  }
  else
  {
   //achou e pode sair
   break;
   $tentativa = 0;
  }
 }// fecha o for
  
 if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
 {
  //Nao encontrado
  exit(); // Fecha a pagina!
 }
 else
 {
  //TRATO OS DADOS DO VEICULO
  $jsonObj = json_decode($response);
  $jsonObj2 = $jsonObj->scheduleDetail;
  $statusProcesso = $jsonObj2->statusProcesso;
  $material = $jsonObj2->material;
  $idProcessoGagf = $jsonObj2->idProcessoGagf;
  $idProcessoGscs = $jsonObj2->idProcessoGscs;
  $origem = $jsonObj2->origem;
  $destino = $jsonObj2->destino;
  $nome_completo = $jsonObj2->nome;
  $nome_reduzido = explode(" ",$nome_completo);
  $nome_reduzido = $nome_reduzido[0];
  $estadoCarreta = $jsonObj2->estadoCarreta;
  $estadoCavalo = $jsonObj2->estadoCavalo;
  $n_sap = $jsonObj2->ticket;
  $placaCarreta =  $jsonObj2->placaCarreta;
  $placaCavalo =  $jsonObj2->placaCavalo;
  $tipoCavalo = $jsonObj2->tipoCavalo;
  $tipoCarreta = $jsonObj2->tipoCarreta;
  $n_transportadora = $jsonObj2->transportadoraCarreta;
  $msg = $statusProcesso.','.$idProcessoGagf.','.$idProcessoGscs.','.$material.','.$origem.','.$destino.','.$nome_completo.','.$n_sap.','.$n_transportadora;
  //echo $response;
  echo ("</BR></BR></BR></BR>");
  echo($statusProcesso);
  echo("</BR>");
  echo($nome_completo);
  echo("</BR>");
  echo($nome_reduzido);
  echo("</BR>");
  echo($material);
  echo("</BR>");
  echo($idProcessoGagf);
  echo("</BR>");
  echo($idProcessoGagf);
  echo("</BR>");
  echo($destino);
  echo("</BR>");
  echo($placaCarreta);
  echo("</BR>");
  echo($placaCavalo);
 } // Fecha o else
 $encontrado_tag = 0;
 // Agora conecto no e verifico se ja existe essas tags no sistema, caso nao cadastro elas
 // PESQUISANDO A TAG DO CAVALO!
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placaCavalo' LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $encontrado_tag = 1; 
  $dados = $sql->fetch_array();
  $epc_cavalo = $dados['tag'];
 }
 if($encontrado_tag == 1)
 {
  //Existe a tag, nao precisa adicionar 
 }
 else
 {  
  //Não exist a tag, tenho que cadastrar no banco!
  $ultimaPlacaCarreta = $placaCarreta;
  echo'</BR>';echo'</BR>';
  echo'Tentando sincronizar!';
  echo'</BR>';
  echo 'Ultima placa carreta: ' . $ultimaPlacaCarreta;
  echo'</BR>';
  //Agora consulto a ultima tag de cavalo na lista de leitura de tags
  include_once 'conexao.php';
  $busca = "442001";
  $sql = $dbcon->query("SELECT * FROM historico_socket WHERE  epc like '%".$busca."%' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $epc_cavalo2 = $dados['epc'];
  }
  echo 'Ultima tag cavalo nas leituras: '. $epc_cavalo2;
  echo'</BR>';
  //Agora consulto novamente no GAGF passando essa tag de cavalo e confiro se é responde com a mesma tag para carreta.
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate='.$epc_cavalo2,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
   'Authorization: Basic c2VydmljZV9hcGlfc2NoZWR1bGU6TWluQDMyMU1pbkA='
   ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
  {
   //Nao achou
   echo 'Não achou!';
   $placaCavalo = '-';
   $epc_cavalo = '-';
   $placaCarreta = '-';
  }
  else
  {
   echo 'Achou e verifica agora o sincronismo!';
   echo'</BR>';
   //Achou, existe algo no gagf, agora confirmo se bate com o ultimo processo de carreta
   //TRATO OS DADOS DO VEICULO
   $jsonObj = json_decode($response);
   $jsonObj2 = $jsonObj->scheduleDetail;
   $estadoCavalo2 = $jsonObj2->estadoCavalo;
   $placaCarreta2 =  $jsonObj2->placaCarreta;
   $placaCavalo2 =  $jsonObj2->placaCavalo;
   $tipoCavalo2 = $jsonObj2->tipoCavalo;
   $n_transportadora2 = $jsonObj2->transportadoraCavalo;
   if(trim($ultimaPlacaCarreta) == trim($placaCarreta2))
   {
    echo'As placas sao do mesmo processo!';
    echo'</BR>';
    //Essa tag de cavalo é a atual para o processo da carreta consultada!
    $epc_cavalo = $epc_cavalo2;
    $placaCavalo = $placaCavalo2;
    $estadoCavalo = $estadoCavalo2;
    $tipoCavalo = $tipoCavalo2; 
    //Agora insiro essa tag na lista tags
    include_once 'conexao.php';
    $sql = $dbcon->query("INSERT INTO lista_tags SET placa='$placaCavalo',estado='$estadoCavalo',tipo='$tipoCavalo',parte='Cavalo',tag='$epc_cavalo',nome='$n_transportadora',cod_sap='-',link='-'");
   }
   else
   {
    //Nao faz nada pois nao bateu os processos
    echo 'As tags sao de processos diferentes!';
    echo'</BR>';
    echo 'Placa dessa tag e: '. $placaCavalo2;
    echo'</BR>';
    echo 'Placa carreta e: ' . $placaCarreta2;
    echo'</BR>';
   }
  }
 }
 $encontrado_tag = 0;
 // PESQUISANDO A TAG DA CARRETA!
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placaCarreta' LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $encontrado_tag = 1; 
  $dados = $sql->fetch_array();
  $epc = $dados['tag'];
  $sigla_carreta = $dados['sigla'];
 }
 if($encontrado_tag == 1)
 {
  //Existe a tag, nao precisa adicionar 
 }
 else
 {
  //Não exist a tag, tenho que cadastrar no banco!
  include_once 'conexao.php';
  $sql = $dbcon->query("INSERT INTO lista_tags SET placa='$placaCarreta',estado='$estadoCarreta',tipo='$tipoCarreta',parte='Carreta',tag='$epc_carreta',nome='$n_transportadora',cod_sap='-',link='-'");
  //Nao existia a tag, agora tenho que buscar a sigla da transportadora dela
  // PESQUISANDO A SIGLA DA TRANSPORTADORA DA CARRETA!
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placaCarreta' LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $sigla_carreta = $dados['sigla'];
  } 
 }
 if($placaCarreta == ''){$placaCarreta = '-';}
 if($placaCavalo==''){$placaCavalo = '-';}
 if($epc_cavalo=''){$epc_cavalo = '-';}
 if($sigla_carreta=''){$sigla_carreta = '-';}
 print("</BR>");print("</BR>");
 print ("Resposta ****************************************");
 print("</BR>");
 print("ID encontrado: ");print($id);
 print("</BR>");
 print("Dados do Cavalo: EPC = ");print($epc_cavalo);print( " - Placa = ");print($placaCavalo);
 print("</BR>");
 print("Dados do Carreta: EPC = ");print($epc_carreta);print( " - Placa = ");print($placaCarreta);
 print("</BR>");
 print("</BR>");
 print("Finalizou");
 //Faço update falando que estou tratando
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 // Agora atualiza o status de tratado e insere as placas 
 include_once 'conexao.php';
 $sql = $dbcon->query("INSERT INTO historico_match SET epc_cavalo = '$epc_cavalo',placa_cavalo='$placaCavalo',epc_carreta='$epc_carreta',placa_carreta='$placaCarreta',tratado='sim'");
 
 include_once 'conexao.php';
 $ponto = "Saida Automações";
 $sql = $dbcon->query("INSERT INTO historico_display SET condicao2='$statusProcesso',epc_cavalo='$epc_cavalo', epc_carreta ='$epc_carreta', placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',ponto='$ponto',concluido='nao',condicao1='Tratando!',tratado_por_segurpro='-',tratado_por_ccl='-',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',material='$material',destino='$destino',data_aqui1='$data',hora_aqui1='$hora',retorno_api='$msg',caminho_snapshot='$url_caminho_foto',sigla_transportadora='$sigla_carreta'");
  
 //Agora conecto e busco o ultimo ID adicionado, que no caso é esse mesmo!
 $id_historico_display = "";
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM historico_display WHERE ponto='$ponto' LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $id_historico_display = $dados['id'];
 }

 //Agora coloco na lista de espera para tratar na automacao do display
 if($statusProcesso=='Concluído' || $statusProcesso == 'Saindo da Planta')
 {
  echo '</BR>';
  echo  'Esta em condicao concluido, porem agora verifico se esta com carga descentralizada!' ;
  echo '</BR>';
  //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE historico_display SET condicao1='Concluído',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
  //Atualizo os dados no display_balanca1 
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE display_balanca1 SET id_historico='$id_historico_display',epc_cavalo = '$epc_cavalo',placa_cavalo='$placa_cavalo' WHERE id='1'");
  //Atualiza display***********************************************************************************************************************
  $nome_reduzido = explode(" ",$nome_completo);
  $nome_reduzido = strtolower($nome_reduzido[0]); // Coloca o nome todo em minusculo
  $nome_reduzido = ucfirst($nome_reduzido); // Coloca a primeira letra em maiusculo
  $nome_reduzido = '__viagem_'.$nome_reduzido.'!';
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
  //PRIMEIRO VERIFICO SE NAO TEM CARGA DESCENTRALIZADA!
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
  {
   $dados = $sql->fetch_array(); 
   $status_api_cheio_vazio = $dados['api_cheio_vazio'];
   $id_cheio_vazio = $dados['id_cheio_vazio'];
   $api_lidar = $dados['api_lidar'];
   $alerta = $dados['alerta'];
   $alert2 = $dados['alerta2'];
   $veiculo = $dados['veiculo'];
  }
  echo '</BR>';
  echo $status_api_cheio_vazio;
  echo '</BR>';
  
  if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' )
  {
   echo '</BR>';
   echo 'Esta tudo ok!';
   echo '</BR>';
   //Libera semáforo saída *****************************************************************************************************************
   include_once 'conexao.php';
   $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
   $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
   //Atualizo semaforo virtual
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
   //**************************************************************************************************************************************
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
   //**************************************************************************************************************************************
   //Atualizo o display
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
   
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE historico_display SET crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
  }
  else
  { //Concluido ou Saindo da Planta , porem com carga descentralizada, verifico se recebi algum alerta de cheio ou vazio,caso contrario, considero ok
   echo '</BR>';
   echo 'Erro - Verifico se esta vazio!';
   echo '</BR>';

   if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
   {
    echo '</BR>';
    echo 'Veiculo saindo vazio, considero como ok';
    echo '</BR>'; 

    //Atualizo o status no historico_display
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE historico_display SET condicao1='Concluido2' WHERE id='$id_historico_display'");
    
    //Libera semáforo saída *****************************************************************************************************************
    include_once 'conexao.php';
    $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
    $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
    //Atualizo semaforo virtual
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
    
        //**************************************************************************************************************************************
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
   //**************************************************************************************************************************************
   //Atualizo o display
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
   
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE historico_display SET crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
   }
   else
   {
     echo '</BR>';
     echo 'Esta cheio, carga descentralizada!';
     echo '</BR>'; 
     //Existe carga descentralizada!
     echo '</BR>';
     echo 'Esta tudo ok e não tem carga descentralizada!';
     echo '</BR>'; 
     //Libera semáforo saída *****************************************************************************************************************
     include_once 'conexao.php';
     $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
     $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
     
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Carga___',mensagem2='_descentralizada!__',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
  
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Carga   ',mensagem2=' descentralizada!  ' WHERE id='$id_historico_display'");

     $condicao = "Carga Descentralizada!";
     if($epc_excesso != 'vazio' )
     {
      if(strlen($epc_excesso)==24)
      {
       date_default_timezone_set('America/Sao_Paulo');
       $data = date('d/m/Y');
       $v_data = $nome_reduzido = explode("/",$data);
       $dia = $v_data[0];
       $mes = $v_data[1];
       $ano = $v_data[2];    
       $hora = date('H:i:s');
       /*
       echo $data;echo'</BR>';
       echo $dia;echo'</BR>';
       echo $mes;echo'</BR>';
       echo $ano;echo'</BR>';
       echo $hora;echo'</BR>';
       */  
       include_once 'conexao.php';
       $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_excesso','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$condicao','nao','-','-','nao','0','-')");
       //Agora limpa na tabela
       include_once 'conexao.php';
       $sql = $dbcon->query("UPDATE display_balanca1 SET epc_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_carreta='-',api_cheio_vazio='-',api_lidar='-',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',veiculo='-' WHERE id='1'");
      }
     }         
  


   }
  }
 }
 else
 {
  //Qualquer outra condicao de Concluido ou Saindo da planta
  //Como não sei de onde veio, considero como vindo da MG030 por via das duvidas, e a falta de ticket mando procurar a patrimonial e eles validam!
  
  
  //include_once 'conexao.php';
  //$sql = $dbcon->query("INSERT INTO historico_display SET condicao2='$statusProcesso',epc_cavalo='$epc_cavalo', epc_carreta ='$epc_carreta', placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',ponto='$ponto',concluido='nao',condicao1='Aguardando',tratado_por_segurpro='-',tratado_por_ccl='-',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',material='$material',destino='$destino',data_aqui1='$data',hora_aqui1='$hora',retorno_api='$msg',caminho_snapshot='$url_caminho_foto',sigla_transportadora='$sigla_carreta'");



 }
} // Fecha if($epc_carreta != 'vazio')
else
{
 echo 'Favor informar a tag da carreta!';   
}























?>