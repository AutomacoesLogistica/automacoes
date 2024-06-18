<?php
$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";
$ww_epc = isset($_GET['epc'])?$_GET['epc']:"vazio";
$valor = ""; // Nao mudar

if( ($mensagem !="vazio" && strlen($mensagem)>30 ) || ( $ww_epc != 'vazio' && strlen($ww_epc)==24 )   )
{
 if(($mensagem !="vazio" && strlen($mensagem)>30 ))
 {
  /*
 padrao mensagem recebida pelo aliien
 #Alien RFID Reader Tag Stream
 #ReaderName: Alien RFID Reader
 #Hostname: SAIDABAL1
 #IPAddress: 192.168.10.94
 #IPAddress6: fdaa::aaaa
 #CommandPort: 23
 #MACAddress: 00:1B:5F:01:14:48
 #Time: 2022/12/15 13:22:12.721
 epc=442002000000000000001760,ant=0,host=SAIDABAL1,data=2022/12/15,hora=13:22:12.545

 */
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

 }
 else
 {
  echo "</BR>Iniciando com tag vindas de testes!</BR>";
  //Veio de tag de teste
  $antena = '0';
  $epc = $ww_epc;
  $ip='000.000.000.000';
  $mac='AB:AC:AD:AE:AF';
  $ca='CA000000';
  $hostname='Testes!';
  $nomeReader='Testes!';
 }

 if($antena =="0" || $antena == "1")
 {
  $ponto = "Saida Automacoes";
 }
 else
 {
  $ponto = "Erro";   
 }

 

 if(strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  ))
 { 
  echo "</BR>Salvando a tag no historico socket!</BR>";
  
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao_saida_automacoes.php';
  $sql = $dbcon->query("INSERT INTO historico_socket(epc,antena,ca,ip,mac,hostname,nomeReader,data_atualizacao,hora_atualizacao)VALUES('$epc','$antena','$ca','$ip','$mac','$hostname','$nomeReader','$data','$hora')");
 
  echo "</BR>Finalizado salvar a tag no historico socket!</BR>";
  
 
  //Agora ja trato para as automacoes da saida balanca 1
  //Verifico se é carreta
  $v1_epc = substr($epc,0,6);
  if($v1_epc == '442002')
  {
   echo "</BR>TAG é de carreta e esta sendo verificada na lista!</BR>";
   $valor = "Encontrado"; // Nao retirar valida la embaixo isso!
   include_once 'conexao_saida_automacoes.php';
   $lista_epc = [];
   $sql = $dbcon->query("SELECT * FROM validacoes_socket ORDER BY id DESC LIMIT 10");
   if(mysqli_num_rows($sql)>0)
   {
    while($dados = $sql->fetch_array())
    { 
     $v_epc = trim($dados['epc_carreta']);
     array_push($lista_epc,$v_epc);
    }
    //Ja achou a tag da carreta, agora so verifico la embaixo se pode inserir para tratar ou nao!
   }  
  } //Fecho if($v1_epc == '442002')
  else
  {
   echo "</BR>TAG de cavalo, buscando a outra no betruck!</BR>"; 

   $valor = ""; // Nao retirar, valida la embaixo isso!
   // É uma tag de cavalo, preciso localizar ela para buscar a de carreta caso esteja ja na lista!
   //Busco no BeTruck e pego a tag de carreta
   $epc_betruck = $epc;
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
      'localEvento: ' . $localEvento
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
     //TRATA LOGS *********************************************************************************************************************************************************
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      include_once 'conexao_saida_automacoes.php';
      $sql = $dbcon->query("INSERT INTO tags_betruck(epc,sigla,data,hora)VALUES('$epc_betruck','-','$data','$hora')");
     }
     else
     {
      $condicao = "Sucesso!";
     }
    }
   }
   else // Pode seguir pois achou a tag no betruck
   {
    $valor = "Encontrado"; // Não retirar, valida la embaixo isso!
    //echo $response;
    $jsonObj = json_decode($response);
    
    //DADOS DO VEICULO *************************************************************
    $dados_do_veiculo = $jsonObj->veiculo;
    $dados_cavalo = $dados_do_veiculo[0];
    $dados_carreta = $dados_do_veiculo[1];
    
    // TRATANDO DADOS DA CARRETA ****************************************************************
    $tag_da_carreta = $dados_carreta->tag;
      
    // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
    // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
    // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
    // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
    // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
    
    echo "</BR>TAG da carreta referente a tag passada de cavalo é: ".$tag_carreta ."</BR>";

    //Passo a tag do betruck para o valor a ser virificado
    $epc = $tag_da_carreta;
    include_once 'conexao_saida_automacoes.php';
    $lista_epc = [];
    $sql = $dbcon->query("SELECT * FROM validacoes_socket ORDER BY id DESC LIMIT 10");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $v_epc = trim($dados['epc_cavalo']);
      array_push($lista_epc,$v_epc);
     }
    }  
   }
  } //Fecho else >>('442001')

  echo "</BR>Preciso verificar agora se pode salvar!</BR>";
  if($valor == "Encontrado")
  {
   //Agora verifico se tem a tag a inserir no array
   if (in_array($epc,$lista_epc)) 
   {
    echo "</BR>Tem a tag ja na lista!</BR>" ;
   }
   else
   {
    echo "</BR>Nao tem a tag na lista, pode inserir!</BR>";  
    //Salvo para o python publicar simulando uma leitura do reader localmente!
    include_once 'conexao_saida_automacoes.php';
    $sql = $dbcon->query("INSERT INTO validacoes_socket(epc_carreta,antena,ponto,data_leitura,hora_leitura,condicao,data_tratado,hora_tratado,api_tratada)VALUES('$epc','$antena','$ponto','$data','$hora','pendente','-','-','GAGF')");
   
 
    //Agora verifico se a tag e tora ou fjx!
    echo "</BR></BR>Agora verifico se a tag e ja esta na lista para verificar se é TORA ou FJX </BR>";
    
    //Agora verifico se e tora ou fjx
    //Agora para Valizar FJX
    $tag_cavalo = 'vazio'; // Nao mudar
    $tag_carreta = $epc;
    $ultima_epc = "vazio"; // Nao mudar
    //Antes de salvar, verifico se ja não é igual a ultima inserida!
    include_once 'conexao_saida_automacoes.php';
    $lista_epc2 = [];
    $sql = $dbcon->query("SELECT * FROM validacoes_tags_tora_fjx ORDER BY id DESC LIMIT 10");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $v_epc2 = trim($dados['placa_ou_tag']);
      array_push($lista_epc2,$v_epc2);
     }
    }   
    //Agora verifico se tem a tag a inserir no array
    if (in_array($epc,$lista_epc2)) 
    {
     echo "</BR>Tem a tag ja na lista de veiculos!" ;
    }
    else
    {
     echo "</BR>Nao tem a tag na lista de veiculos, pode inserir!</BR>";  
     //Salvo para la verificar se é tag ta TORA ou FJX
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO validacoes_tags_tora_fjx (placa_ou_tag,validado,data_validacao,hora_validacao,sigla) VALUES ('$tag_carreta','pendente','-','-','-')");
    }
   }
  }
  else
  {
   echo "</BR>Ocorreu algum erro ao encontrar a tag!</BR>";
  }
 } // Fecha if(strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  ))
 else
 {
  echo "Favor inserir uma mensagem valida!";   
 }
} // Fecha if($mensagem !="vazio" && strlen($mensagem)>30)
else
{
 echo "Erro, dados invalidos!" ;
}
?>