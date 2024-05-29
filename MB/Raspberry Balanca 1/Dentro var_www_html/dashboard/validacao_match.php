<?php

$ponto = isset($_GET['rodar'])?$_GET['rodar']:"rodar"; // Para evitar erros!
$encontrado = 0;
$placaCarreta = '';
$placaCavalo = '';
$epc_carreta = '-';
$epc_cavalo = '-';
$msg = '-'; //Serve para salvar o retorno da api

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM historico_match WHERE (tratado='nao' AND ponto='$ponto') LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
 $epc_carreta = $dados['epc_carreta'];
 $encontrado = 1;
}
 
if($encontrado == 1 && strlen($epc_carreta)==24 )
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
  //Atualizo o match mas com erro pois nao encontrou essa tag dentro do gagf
  // Agora atualiza o status de tratado e insere as placas 
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE historico_match SET epc_cavalo='-',placa_cavalo='-',placa_carreta='-',tratado='sim'WHERE id='$id'");
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
  $sql = $dbcon->query("SELECT * FROM historico_leituras WHERE tipo='cavalo' ORDER BY id DESC LIMIT 1");
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
 $sql = $dbcon->query("UPDATE historico_match SET epc_cavalo = '$epc_cavalo',placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',tratado='sim'WHERE id='$id'");
 

 // Adiciono no historico math do poste saida balanca 1
 include_once 'conexao_poste_balanca1.php';
 $sql = $dbcon->query("INSERT INTO historico_match SET epc_cavalo = '$epc_cavalo',placa_cavalo='$placaCavalo',epc_carreta='$epc_carreta',placa_carreta='$placaCarreta',tratado='nao'");

 //Agora coloco na lista de espera para tratar na automacao do display
 if($statusProcesso=='Concluído' || $statusProcesso == 'Saindo da Planta')
 {
  include_once 'conexao_poste_balanca1.php';
  $sql = $dbcon->query("INSERT INTO historico_display SET condicao2='$statusProcesso',epc_cavalo='$epc_cavalo', epc_carreta ='$epc_carreta', placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',ponto='$ponto',concluido='nao',condicao1='Aguardando',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',material='$material',destino='$destino',data_aqui1='$data',hora_aqui1='$hora',retorno_api='$msg',caminho_snapshot='$url_caminho_foto',sigla_transportadora='$sigla_carreta'");
 }
 else
 {
  include_once 'conexao_poste_balanca1.php';
  $sql = $dbcon->query("INSERT INTO historico_display SET condicao2='$statusProcesso',epc_cavalo='$epc_cavalo', epc_carreta ='$epc_carreta', placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',ponto='$ponto',concluido='nao',condicao1='Aguardando',tratado_por_segurpro='-',tratado_por_ccl='-',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',material='$material',destino='$destino',data_aqui1='$data',hora_aqui1='$hora',retorno_api='$msg',caminho_snapshot='$url_caminho_foto',sigla_transportadora='$sigla_carreta'");
 }



 $encontrado_tag = 0;
 //Agora verifico se as tags existem no banco do poste da saida
 if($epc_cavalo != '-')
 { 
  // PESQUISANDO A TAG DO CAVALO!
  include_once 'conexao_poste_balanca1.php';
  $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placaCavalo' LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $encontrado_tag = 1; 
   $dados = $sql->fetch_array();
   $epc = $dados['tag'];
  }
  if($encontrado_tag == 1)
  {
   //Existe a tag, nao precisa adicionar 
  }
  else
  {
   //Não exist a tag, tenho que cadastrar no banco!
   include_once 'conexao_poste_balanca1.php';
   $sql = $dbcon->query("INSERT INTO lista_tags SET placa='$placaCavalo',estado='$estadoCavalo',tipo='$tipoCavalo',parte='Cavalo',tag='$epc_cavalo',nome='$n_transportadora',cod_sap='-',link='-'");
  }
 } //Fecha if($epc_cavalo != '-')
 $encontrado_tag = 0;
 if($epc_carreta !='-')
 {
  // PESQUISANDO A TAG DA CARRETA!
  include_once 'conexao_poste_balanca1.php';
  $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placaCarreta' LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $encontrado_tag = 1; 
   $dados = $sql->fetch_array();
   $epc = $dados['tag'];
  }
  if($encontrado_tag == 1)
  {
   //Existe a tag, nao precisa adicionar 
  }
  else
  {
   //Não exist a tag, tenho que cadastrar no banco!
   include_once 'conexao_poste_balanca1.php';
   $sql = $dbcon->query("INSERT INTO lista_tags SET placa='$placaCarreta',estado='$estadoCarreta',tipo='$tipoCarreta',parte='Carreta',tag='$epc_carreta',nome='$n_transportadora',cod_sap='-',link='-'");
  }
  
  


 } // fecha if($epc_carreta !='-')
}
else
{
 echo 'Nao encontrado'; 
}







?>
