<?php


///var/www/html/sockets/saida_automacoes

$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";

if($mensagem !="vazio" && strlen($mensagem)>30)
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
  include_once 'conexao.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $sql = $dbcon->query("INSERT INTO historico_socket(epc,antena,ponto,ca,ip,mac,hostname,nomeReader,data_atualizacao,hora_atualizacao)VALUES('$epc','$antena','$ponto','$ca','$ip','$mac','$hostname','$nomeReader','$data','$hora')");
  //Agora ja trato para as automacoes da saida balanca 1
  //Verific se é carreta
  $v1_epc = substr($epc,0,6);
  if($v1_epc == '442002')
  {
   
    //Antes de salvar, verifico se ja não é igual a ultima inserida!
    include_once 'conexao.php';
    $lista_epc = [];
    $sql = $dbcon->query("SELECT * FROM validacoes_socket ORDER BY id DESC LIMIT 10");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $v_epc = trim($dados['epc_carreta']);
      array_push($lista_epc,$v_epc);
     }
    }  
    //Agora verifico se tem a tag a inserir no array
    if (in_array($epc,$lista_epc)) 
    {
     echo "Tem a tag ja na lista!" ;
    }
    else
    {
     echo "Nao tem a tag na lista, pode inserir!";  
     //Salvo para o python publicar simulando uma leitura do reader localmente!
     include_once 'conexao.php';
     $sql = $dbcon->query("INSERT INTO validacoes_socket(epc_carreta,antena,ponto,data_leitura,hora_leitura,condicao,data_tratado,hora_tratado,api_tratada)VALUES('$epc','$antena','$ponto','$data','$hora','pendente','-','-','GAGF')");
    }





  } //Fecho if($v1_epc == '442002')
  else
  {

   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************

   //valido com tag da carreta vinda por sincronismo na API BETRUCK consultando a tag cavalo
   $curl = curl_init();
   $epc_cavalo  = $epc;
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/atual?tagVeiculo='.$epc_cavalo,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM'
    ),
    ));
    $response = curl_exec($curl);
    $jsonObj = json_decode($response);
    $veiculos = $jsonObj->veiculo;
    curl_close($curl);
    //$dados_cavalo = $veiculos[0];
    $dados_carreta = $veiculos[1];
    $betruck_api_carreta = $dados_carreta->tag;
    $epc = $betruck_api_carreta; // Coloco a tag de retorno da api be truck forçando o codigo simulando leitura da tag da carreta no reader e segue o fluxo
  
    //Antes de salvar, verifico se ja não é igual a ultima inserida!
    include_once 'conexao.php';
    $lista_epc = [];
    $sql = $dbcon->query("SELECT * FROM validacoes_socket ORDER BY id DESC LIMIT 10");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $v_epc = trim($dados['epc_carreta']);
      array_push($lista_epc,$v_epc);
     }
    }  
    //Agora verifico se tem a tag a inserir no array
    if (in_array($epc,$lista_epc)) 
    {
     echo "Tem a tag ja na lista!" ;
    }
    else
    {
     echo "Nao tem a tag na lista, pode inserir!";  
     //Salvo para o python publicar simulando uma leitura do reader localmente!
     include_once 'conexao.php';
     $sql = $dbcon->query("INSERT INTO validacoes_socket(epc_carreta,antena,ponto,data_leitura,hora_leitura,condicao,data_tratado,hora_tratado,api_tratada)VALUES('$epc','$antena','$ponto','$data','$hora','pendente','-','-','BeTruck')");
    }






  }//Fecho else >>('442001')
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************
   //NOVO TESTE PARA EVITAR AGUARDANDO VALIDACAO NA TELA ---CONSULTANDO API BETRUCK *********************************************************************************************













 }
}
else
{
 echo "Favor inserir uma mensagem valida!";   
}

?>