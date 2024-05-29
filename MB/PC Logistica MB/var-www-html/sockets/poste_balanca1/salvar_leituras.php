<?php
$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";
//echo $mensagem;
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
 #Time: 2023/09/19 11:05:12.721
 epc=4420020000000000000012160,ant=0,host=SAIDABAL1,data=2023/09/19,hora=11:05:12.545

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


 if(strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  ))
 {
  include_once 'conexao.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
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
      //Agora para Valizar FJX
      $tag_cavalo = 'vazio'; // Nao mudar
      $tag_carreta = $epc;
      $ultima_epc = "vazio"; // Nao mudar
   
      //Antes de salvar, verifico se ja não é igual a ultima inserida!
      include_once 'conexao.php';
      $lista_epc = [];
      $sql = $dbcon->query("SELECT * FROM validacoes_tags_tora_fjx ORDER BY id DESC LIMIT 10");
      if(mysqli_num_rows($sql)>0)
      {
           while($dados = $sql->fetch_array())
           { 
               $v_epc = trim($dados['placa_ou_tag']);
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
       //Salvo para la verificar se é tag ta TORA ou FJX
       include_once 'conexao.php';
       $sql = $dbcon->query("INSERT INTO validacoes_tags_tora_fjx (placa_ou_tag,validado,data_validacao,hora_validacao,sigla) VALUES ('$tag_carreta','pendente','-','-','-')");
      }   
   
   
    
    
  } // fecha if($v1_epc == '442002')
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
    //Agora verifico se e tora ou fjx
    //Agora para Valizar FJX
    $tag_cavalo = 'vazio'; // Nao mudar
    $tag_carreta = $epc;
    $ultima_epc = "vazio"; // Nao mudar
    //Antes de salvar, verifico se ja não é igual a ultima inserida!
    include_once 'conexao.php';
    $lista_epc = [];
    $sql = $dbcon->query("SELECT * FROM validacoes_tags_tora_fjx ORDER BY id DESC LIMIT 10");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $v_epc = trim($dados['placa_ou_tag']);
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
     //Salvo para la verificar se é tag ta TORA ou FJX
     include_once 'conexao.php';
     $sql = $dbcon->query("INSERT INTO validacoes_tags_tora_fjx (placa_ou_tag,validado,data_validacao,hora_validacao,sigla) VALUES ('$tag_carreta','pendente','-','-','-')");
    }   
   }
 } // Fecha if(strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  ))
}
else
{
 echo "Favor inserir uma mensagem valida!";   
}

?>