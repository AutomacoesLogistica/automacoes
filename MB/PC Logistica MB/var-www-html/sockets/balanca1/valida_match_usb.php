<?php

$ponto = isset($_GET['rodar'])?$_GET['rodar']:"rodar"; // Para evitar erros!
$v_epc = isset($_GET['epc'])?$_GET['epc']:"rodar"; // Para evitar erros!
$epc_carreta = $v_epc;


if($ponto =="balanca")
{
  $valor_ponto = "Balança";
  //Busco os dados do ponto na tabela
  $vponto = "Balança 01 MB";
  include_once 'conexao_saida_automacoes.php';
  $sql = $dbcon->query("SELECT * FROM referencias_betruck WHERE ponto = '$vponto'");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $sn_reader = $dados['sn_reader'];
   $site = $dados['site'];
   $latitude = $dados['latitude'];
   $longitude = $dados['longitude'];
  }  
}
else if($ponto =="mg")
{
  $valor_ponto = "MG030";
  //Busco os dados do ponto na tabela
  $vponto = "Saida MG030 MB";
  include_once 'conexao_saida_automacoes.php';
  $sql = $dbcon->query("SELECT * FROM referencias_betruck WHERE ponto = '$vponto'");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $sn_reader = $dados['sn_reader'];
   $site = $dados['site'];
   $latitude = $dados['latitude'];
   $longitude = $dados['longitude'];
  }
}
else
{
 $valor_ponto = "erro";
}





if($v_epc != 'rodar')
{
  $equipamento = substr($v_epc,0,6);
  if($equipamento == '442002')
  {
   $justificativa = "Validação pela EPC da carreta!";
  }
  else if ($equipamento == '442001')
  {
    $justificativa = "Validação pela EPC do cavalo!";
  }
  else
  {
   $justificativa = "";
  }
  
}
else
{
  $justificativa = "";
}













//Agora consulto se e tag cavalo
if(substr($v_epc,0,6) =="442001")
{
  $curl = curl_init();
   $epc_cavalo  = $epc;
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/atual?tagVeiculo='.$v_epc,
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
    $v_epc = $betruck_api_carreta; // Coloco a tag de retorno da api be truck forçando o codigo simulando leitura da tag da carreta no reader e segue o fluxo
}
// ******************************************************************






//Faço update falando que estou tratando
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

$encontrado = 0;
$placaCarreta = '';
$placaCavalo = '';
$epc_carreta = '-';
$epc_cavalo = '-';
$msg = '-'; //Serve para salvar o retorno da api

$id_duplicado = 0;

//PRIMEIRO VERIFICO SE JA NAO ESTA NA LISTA!
$pode_salvar = "nao";
include_once 'conexao_saida_automacoes.php';
$lista_epc = [];
$sql = $dbcon->query("SELECT * FROM historico_match ORDER BY id DESC LIMIT 5");
if(mysqli_num_rows($sql)>0)
{
    while($dados = $sql->fetch_array())
    { 
        $encontrado = intval($encontrado)+1;
        $v_epc2 = trim($dados['epc_carreta']);
        array_push($lista_epc,$v_epc2);
    }
}
var_dump($lista_epc);
echo "</BR>Encontrado = ".$encontrado ." </BR>";
//Agora verifico se tem a tag a inserir no array
if (in_array($v_epc,$lista_epc)) 
{
  echo "Tem a tag ja na lista!" ;
  $pode_salvar = "nao";
}
else
{
  echo "Nao tem a tag na lista, pode inserir!";  
  $pode_salvar = "sim";
  //Ja insiro a tag na lista para tratar abaixo!
  include_once 'conexao_saida_automacoes.php';
  $sql = $dbcon->query("INSERT INTO historico_match SET epc_cavalo='-',placa_cavalo='-',epc_carreta='$v_epc',placa_carreta='-',ponto='$ponto',tratado='nao'");
} 









if($pode_salvar == "sim" && $ponto != 'rodar')
{
 echo "</BR> Iniciando tratativas *********</BR>";
  $encontrado = 0;

  include_once 'conexao_saida_automacoes.php';
  $sql = $dbcon->query("SELECT * FROM historico_match WHERE (tratado='nao' AND ponto='$ponto' AND epc_carreta='$v_epc') LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $id = $dados['id'];
   $epc_carreta = $dados['epc_carreta'];
   $encontrado = 1;
   echo "</BR>Localizado EPC para tratar......EPC = " . $epc_carreta . "</BR>";
  }
   
  if($encontrado == 1 && strlen($epc_carreta)==24 )
  {
    
    echo "</BR></BR></BR>Tratando!</BR>";
    
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
    include_once 'conexao_saida_automacoes.php';
    $sql = $dbcon->query("UPDATE historico_match SET epc_cavalo='-',placa_cavalo='-',placa_carreta='-',tratado='sim',data_atualizacao='$data',hora_atualizacao='$hora' WHERE id='$id'");
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
    $telefone = $jsonObj2->celular;
    $nome_completo = $jsonObj2->nome;
    $nome_reduzido = explode(" ",$nome_completo);
    $nome_reduzido = $nome_reduzido[0];
    $estadoCarreta = $jsonObj2->estadoCarreta;
    $estadoCavalo = $jsonObj2->estadoCavalo;
    $n_sap = $jsonObj2->ticket;
    $tipoCavalo = $jsonObj2->tipoCavalo;
    $tipoCarreta = $jsonObj2->tipoCarreta;
    if (strpos($tipoCarreta, 'Cavalo') !== false) 
    {
     echo "Esta invertido, preciso inverter";
     $placaCarreta =  $jsonObj2->placaCavalo;
     $placaCavalo =  $jsonObj2->placaCarreta;  
     $tipoCavalo = $jsonObj2->tipoCarreta;
     $tipoCarreta = $jsonObj2->tipoCavalo;
    } 
    else 
    {
     $placaCarreta =  $jsonObj2->placaCarreta;
     $placaCavalo =  $jsonObj2->placaCavalo;    
    }

    
    $n_transportadora = $jsonObj2->transportadoraCarreta;
    $msg = $statusProcesso.','.$idProcessoGagf.','.$idProcessoGscs.','.$material.','.$origem.','.$destino.','.$nome_completo.','.$n_sap.','.$n_transportadora;
         
    
    //echo $response;
    echo ("</BR></BR></BR></BR>");
    echo ("Dados do processo desse veiculo ");
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
   include_once 'conexao_saida_automacoes.php';
   $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placaCavalo' LIMIT 1");
   if(mysqli_num_rows($sql)>0)
   {
    $encontrado_tag = 1; 
    $dados = $sql->fetch_array();
    $epc_cavalo = $dados['tag'];
    echo "</BR>Tag Cavalo é = " . $epc_cavalo;
   }
   if($encontrado_tag == 1)
   {
    //Existe a tag, nao precisa adicionar 
    echo "</BR></BR></BR></BR>Existe a tag, nao preciso adicionar </BR></BR></BR>";
   }
   else
   {
        //Não exist a tag, tenho que cadastrar no banco!
        
        echo "Nao existe a tag de cavalo, vou selecionar a ultima tag lida de cavalo e tentar procurar ela para ver se bate com o mesmo numero do processo GAGF e as placas batem";
        
        $ultimaPlacaCarreta = $placaCarreta;
        echo'</BR>';echo'</BR>';
        echo'Tentando sincronizar!';
        echo'</BR>';
        echo 'Ultima placa carreta: ' . $ultimaPlacaCarreta;
        echo'</BR>';
        //Agora consulto a ultima tag de cavalo na lista de leitura de tags
        include_once 'conexao.php'; // Busco no banco bd_balanca1
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
        $statusProcesso_cavalo = $jsonObj2->statusProcesso;
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
        include_once 'conexao_saida_automacoes.php';
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
  include_once 'conexao_saida_automacoes.php';
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
    include_once 'conexao_saida_automacoes.php';
    $sql = $dbcon->query("INSERT INTO lista_tags SET placa='$placaCarreta',estado='$estadoCarreta',tipo='$tipoCarreta',parte='Carreta',tag='$epc_carreta',nome='$n_transportadora',cod_sap='-',link='-'");
    //Nao existia a tag, agora tenho que buscar a sigla da transportadora dela
    // PESQUISANDO A SIGLA DA TRANSPORTADORA DA CARRETA!
    include_once 'conexao_saida_automacoes.php';
    $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placaCarreta' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $sigla_carreta = $dados['sigla'];
    } 
   }  
   // **************************************************************************************

  if($placaCarreta == ''){$placaCarreta = '-';}
  if($placaCavalo==''){$placaCavalo = '-';}
  if($epc_cavalo==''){$epc_cavalo = '-';}
  if($sigla_carreta==''){$sigla_carreta = '-';}
  

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
      include_once 'conexao_saida_automacoes.php';
      $sql = $dbcon->query("UPDATE historico_match SET epc_cavalo = '$epc_cavalo',placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',tratado='sim',data_atualizacao='$data',hora_atualizacao='$hora'   WHERE id='$id'");
   
  
      //Agora coloco na lista de espera para tratar na automacao do display
      if($statusProcesso=='Concluído' || $statusProcesso == 'Saindo da Planta')
      {
        include_once 'conexao_poste_balanca1.php';
        $sql = $dbcon->query("INSERT INTO historico_display SET condicao2='$statusProcesso',epc_cavalo='$epc_cavalo', epc_carreta ='$epc_carreta', placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',ponto='$ponto',concluido='nao',condicao1='Aguardando',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',telefone='$telefone',transportadora='$n_transportadora',material='$material',destino='$destino',data_aqui1='$data',hora_aqui1='$hora',retorno_api='$msg',caminho_snapshot='$url_caminho_foto',sigla_transportadora='$sigla_carreta'");
      }
      else
      {
        include_once 'conexao_poste_balanca1.php';
        $sql = $dbcon->query("INSERT INTO historico_display SET condicao2='$statusProcesso',epc_cavalo='$epc_cavalo', epc_carreta ='$epc_carreta', placa_cavalo='$placaCavalo',placa_carreta='$placaCarreta',ponto='$ponto',concluido='nao',condicao1='Aguardando',tratado_por_segurpro='-',tratado_por_ccl='-',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',telefone='$telefone',transportadora='$n_transportadora',material='$material',destino='$destino',data_aqui1='$data',hora_aqui1='$hora',retorno_api='$msg',caminho_snapshot='$url_caminho_foto',sigla_transportadora='$sigla_carreta'");
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
  
} // Fecha if($pode_salvar == "sim" && $ponto != 'rodar')
else
{
  echo "Ja existe a tag!";
}












if($valor_ponto != "erro")
{

 
  //  Consulto API BETRUCK ************************************************************************************************************
  //  Consulto API BETRUCK ************************************************************************************************************
  //  Consulto API BETRUCK ************************************************************************************************************
  //  Consulto API BETRUCK ************************************************************************************************************
   $localEvento = "Miguel Burnier";
  
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/atual?tagVeiculo='.$epc_carreta,
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
          if($epc != "vazio")
          {
           //Preciso salvar a tag pois nao encontrada no sistema do BeTruck
           //include_once 'conexao_dashboard.php';
           //$sql = $dbcon->query("UPDATE dashboard SET tipo='Controle', ponto='Controle 3', data_leitura='$data', hora_leitura='$hora' WHERE id='$id_banco_dashboard'");
          }
      }
      else
      {
       $valor = "Encontrado";
      }
  
  
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
      
      
      /*
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
      
     */
  
  
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
  




  if($valor == "Encontrado")
  {
   //consulta
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('Y-m-d');
   $hora = date('H:i:s');
   $data_agora = $data . 'T' . $hora.'Z';  //Caso eu queira usar a data de agora PADRAO "2024-05-09T12:26:05Z
   echo "</BR></BR></BR>Entrou para o post no BeTruck";
   
  
  
   echo "Dados";
   echo "SN : " . $sn_reader . "</BR>";
   echo "site : " . $site . "</BR>";
   echo "latitude : " . $latitude . "</BR>";
   echo "longitude : " . $longitude . "</BR>";
   echo "ponto : " . $vponto . "</BR>";
   echo "ID : " . $id_betruck_ultima_viagem . "</BR>";
   echo "data_agora : " . $data_agora . "</BR>";
  
  
   echo "</BR></BR></BR></BR>";
  
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
  
  
   $response = curl_exec($curl);
  
   curl_close($curl);
   echo $response;
   
  }
  else
  {
    echo "Nao achou betruck";  
  }

















    }


?>
