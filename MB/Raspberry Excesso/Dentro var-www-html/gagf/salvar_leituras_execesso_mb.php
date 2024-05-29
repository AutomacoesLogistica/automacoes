<?php
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO

include_once 'conexao.php';
$id = 'DEFAULT';
$encontrado_lidar = 0;
//$data = $_GET['data'];
//$hora = $_GET['hora'];
$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';
$antena = isset($_GET['antena'])?$_GET['antena']:'0';
$tipo = isset($_GET['tipo'])?$_GET['tipo']:'Carreta';
$local_instalacao = "Miguel Burnier";
$ca = "KA16005925";
$localidade = "XX";
$funcao = "Excesso MB";
$operador = "Nao definido";
echo $epc;



$v_condicao_atualizar = "";

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');


$mes = (substr($data,3,2)); // extrai o mes atual
$ano = (substr($data,6,4)); // extrai o ano atual

$placa = '-';
$transportadora = '-';
$sigla = '-';

//BUSCO A PLACA CASO EXISTA
include_once 'conexao.php';
$sq5 = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc'");
if(mysqli_num_rows($sq5)>0)
{ 
 while($dados = $sq5->fetch_array())
 {
  //ENCONTRADA
  $placa = $dados['placa'];
  $transportadora = $dados['nome'];
  $localidade = $dados['estado'];
 } // Fecha while
} // Fecha if

if($placa == '-')
{
 $placa = 'Não encontrada!';
 $localidade = 'XX';
 $transportadora = 'Não identificada!';
 $sigla = 'Não identificada!';
}
else
{
 //BUSCO A SIGLA
 include_once 'conexao.php';
 $sq6 = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadora'");
 if(mysqli_num_rows($sq6)>0)
 { 
  while($dados = $sq6->fetch_array())
  {
   //ENCONTRADA
   $sigla = $dados['sigla'];
  } // Fecha while
 } // Fecha if
}// Fecha else



#Salvando os dados dentro do banco de dados ************************************************************************************************
$sql3 = $dbcon->query("INSERT INTO lista_leitura_tags_mb(ca,data,hora,epc,antena,funcao,placa,localidade,sigla,operador)VALUES('$ca','$data','$hora','$epc','$antena','$funcao','$placa','$localidade','$sigla', '$operador')");







if ($tipo == "Carreta")
{
 $resultado = intval(substr($hora,0,2)); // quebro o valor da hora para saber qual turno pertence e posteriormente buscar a letra no banco de dados
 if($resultado >= 0 && $resultado < 8) // Pertence ao primeiro turno
 {
  $valor_turno = "turno1"; // Busca na coluna 3 que equivale ao primeiro turno
 }
 if($resultado >= 8 && $resultado < 17) // Pertence ao segundo turno
 {
  $valor_turno = "turno2"; // Busca na coluna 4 que equivale ao segundo turno
 }
 if($resultado >= 17 && $resultado <=23 )
 {
  $valor_turno = "turno3"; // Busca na coluna 5 que equivale ao terceiro turno
 }
 // BUSCO O TURNO DE ACORDO COM A DATA E A HORA RECEBIDA DA LEITURA
 $tabela = 'lista_turno_' . $ano;

 $sq6 = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
 if(mysqli_num_rows($sq6)>0)
 {
  while($dados = $sq6->fetch_array())
  {
   // Achou a data agora salva a o turno
   if($valor_turno == "turno1")
   {
    $turno = $dados['turno1']; // Busca a letra do turno
   }
   elseif($valor_turno == "turno2")
   {
    $turno = $dados['turno2']; // Busca a letra do turno
   }
   else
   {
    $turno = $dados['turno3']; // Busca a letra do turno
   }
  }// Fecha o while 
 } // Fecha o if mysqli_num_rows($sq6)>0
 $ID = 0;
 $result = 0;
 $result2 = 0;

 $sq4 = $dbcon->query("SELECT * FROM lista_excesso_mb WHERE epc='$epc' AND data='$data'");
 if(mysqli_num_rows($sq4)>0)
 { // Encontrou algum registro com tag e data igual, basta verificar se é a mais de 1 hora
  while($dados = $sq4->fetch_array())
  {
   $rest = intval(substr($dados['hora'],0,2));
   $rest_minutos = intval(substr($dados['hora'],3,2));
   $result = (intval(substr($hora,0,2)))-intval($rest);
   if($result>=1)
   {
    if($result>=2) // Garante que tem mais de 1 hora
    {
     $ID = 1;
    }
    else // Deu apenas numero 1, entra para tratar
    {
     if($result2 = (intval(substr($hora,3,2))) > (intval($rest_minutos)) ) // Trata minutos
     {
      $ID = 1; // Caso o minuto atual da leitura seja maior que o outro e a hora, dando invervalor de mais d 60min
     }
     else // Resultado não é maior que seu numero
     {
      $ID = 0;
     }
    } 
   } // fecha if result>1
   else 
   {
    $ID = 0; // Contem a mesma hora a coleta que chegou da ultima que foi salva
   }
  } //fecha while
 }
  
 
  




  
  // Verifica se pode salvar
  if($ID == 1 )
  {
   include_once 'conexao.php';
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $hora = date('H:i:s');
   $mes = (substr($data,3,2)); // extrai o mes atual
   $ano = (substr($data,6,4)); // extrai o ano atual
   $sql = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,sigla,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$sigla','$data','$mes','$ano' ,'$hora','$localidade','$local_instalacao','$ca', '$turno','$operador')");

  } // Fecha se encontrou registo e tratou para ver se tem mais de 60min
  else // Ja salva pois nao existe no banco de dados
  {
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $hora = date('H:i:s');
   $mes = (substr($data,3,2)); // extrai o mes atual
   $ano = (substr($data,6,4)); // extrai o ano atual
   include_once 'conexao.php';
   $sql = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,sigla,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$sigla','$data','$mes','$ano','$hora','$localidade','$local_instalacao', '$ca', '$turno','$operador')");
  }
  
  
//AGORA VERIFICO RETORNO DE CARGA DESCENTRALIZADA **********************************************************
//Agora verifico se é um veiculo que precisa de confirmação para LIDAR/Carga Descentralizada!
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  

//echo "Consultando a epc = " . $epc . "</BR>";
//echo "Data consulta = " . $data . "</BR>";
   
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lidar_excesso WHERE (epc_lidar='$epc' AND data_leitura='$data' AND confirmacao='nao') ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $encontrado_lidar = 1;
 $dados = $sql->fetch_array();
 $id_lidar_excesso = $dados['id'];
 $data_banco = $dados['data_leitura'];
 $hora_banco = $dados['hora_leitura'];
 $epc_lidar = $dados['epc_lidar'];
 $id_lidar = $dados['id_lidar'];
 $id_cheio_vazio = $dados['id_cheio_vazio'];
 $id_historico = $dados['id_historico'];
 $placa = $dados['placa'];
 $veiculo = $dados['veiculo'];
    $dia = $dados['dia'];
    $mes = $dados['mes'];
    $ano = $dados['ano'];
    $condicao = $dados['condicao'];
    $tamanho_data  = intval(strlen($data_banco));
    $tamanho_hora  = intval(strlen($hora_banco));
    //echo "achou";
   
    if($encontrado_lidar == 1 && $tamanho_data==10 && $tamanho_hora == 8)
    {
        //Faço o calculo do tempo que demorou da leitura la no lidar ate a confirmacao aqui
        $mensagem = explode('/',$data_banco);
        $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
        $horario_banco = $mensagem . ' ' . $hora_banco; 
        //Agora calculo a diferença
        $data_inicio = new DateTime($data_agora);
        $data_fim = new DateTime($hora_banco);
        // Resgata diferença entre as datas
        $dateInterval = $data_inicio->diff($data_fim);
        $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
        $mensagem1 = explode(' ',$mensagem);
        $vmensagem1 = explode('/',$mensagem1[0]);
        $dia = $vmensagem1[0];
        $mes = $vmensagem1[1];
        $ano = $vmensagem1[2];
        $mensagem = explode(':',$mensagem1[1]);
        $hora = $mensagem[0];
        $minuto = $mensagem[1];
        $segundo = $mensagem[2];
        //Calculo a diferenca
        $tempo_gasto = (intval($hora)*60) + intval($minuto); 
    }
   
    echo "tempo gasto = " . $tempo_gasto . "</BR>";

    if($tempo_gasto >60)
    {
     //Se for maior, se trata de um excesso e nao confirmação de retorno!
     //Encerro a retorno
     //Faço UPDATE
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao.php';
     $motivo = "Veiculo nao retornou na viagem anterior e essa se trata de outra, possivelmente um execesso!";
     $v_condicao_atualizar = "excesso";
     $sql = $dbcon->query("UPDATE lidar_excesso SET confirmacao='Sim2',tempo_confirmacao='-',data_tratado='$data',hora_tratado='$hora',motivo='$motivo' WHERE id='$id_lidar_excesso'");
    }
    else
    {
     //Sendo menor que 60, se trata de uma confirmação de retorno!
     //Agora so confiro antes para saber se se tratada de carga descentralizada mesmo, caso contrario, considero excesso!
     echo "Entrou para verifica a condicao primeiro!</BR>";

     if($condicao == "Carga Descentralizada!")
     {
      echo "Pode considerar retorno e encerrar o id = ".$id_lidar_excesso."!</BR>";
      //Faço UPDATE
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      include_once 'conexao.php';
      $motivo = "Retornou para conferência da carga e foi encerrado automaticamente via sistema!";
      $v_condicao_atualizar = "retornou_para_conferencia_carga";
      $sql = $dbcon->query("UPDATE lidar_excesso SET tratado='Sim',confirmacao='Sim',tempo_confirmacao='$tempo_gasto',data_tratado='$data',hora_tratado='$hora',motivo='$motivo' WHERE id='$id_lidar_excesso'"); 
     }
     else
     {
       //Nao faço nada pois o codigo do excesso ja tratou
       echo "Não faço nada pois não é carga descentralizada!</BR>";
     }
    }




   }
   else
   {
    echo "Nao é confirmacao de retorno!";
    //Ai nao faço nada tambem pois o codigo do excesso ja vai ter feito!
   }

   











   //AGORA ATUALIZO NO BETRUCK ***********************************************************************************************************************************
   
    $localEvento = "Miguel Burnier";  //Para api BeTruck

    //  Consulto API BETRUCK ************************************************************************************************************
    //  Consulto API BETRUCK ************************************************************************************************************
    //  Consulto API BETRUCK ************************************************************************************************************
    //  Consulto API BETRUCK ************************************************************************************************************

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/atual?tagVeiculo='.$epc,
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
   
      if($valor == "Encontrado")
      {




       //Agora faço envio para atualizar historico no BeTruck

       //consulta
       date_default_timezone_set('America/Sao_Paulo');
       $data = date('Y-m-d');
       $hora = date('H:i:s');
       $data_agora = $data . 'T' . $hora.'Z';  //Caso eu queira usar a data de agora PADRAO "2024-05-09T12:26:05Z
       
       
       $justificativa = "";
       if($v_condicao_atualizar == "retornou_para_conferencia_carga")
       {
        $justificativa = "Retornou para conferência de carga!";
       }
       else
       {
        //Considera com um excesso/falta
        $justificativa = "Entrou no pátio de excesso para retirar/completar!";
       }



       echo "</BR></BR></BR>Entrou para o post no BeTruck";
 
      $vponto = "Patio de Excessos MB";
      
      
      /*
      //Busco os dados do ponto na tabela
      include_once 'conexao_pc_logistica2.php';

      $sql = $dbcon->query("SELECT * FROM referencias_betruck WHERE ponto = '$vponto'");
      if(mysqli_num_rows($sql)>0)
      {
      $dados = $sql->fetch_array();
      $sn_reader = $dados['sn_reader'];
      $site = $dados['site'];
      $latitude = $dados['latitude'];
      $longitude = $dados['longitude'];
      }
      */
      
      $site = "Miguel Burnier";
      $sn_reader = "KA16005925";
      $latitude = -20.434922;
      $longitude = -43.777724;


       echo "Dados";
       echo "SN : " . $sn_reader . "</BR>";
       echo "site : " . $site . "</BR>";
       echo "latitude : " . $latitude . "</BR>";
       echo "longitude : " . $longitude . "</BR>";
       echo "ponto : " . $vponto . "</BR>";
       echo "ID : " . $id_betruck_ultima_viagem . "</BR>";
       echo "data_agora : " . $data_agora . "</BR>";
      
      
       echo "</BR></BR></BR></BR>";



       //Agora faço o POST para atualizar o evento do historico
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
        "justificativa": "'.$justificativa.'",
        "video_bascula": "",
        "video_placa": "",
        "imagem_bascula": "",
        "imagem_placa": "",
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
          
      }




} // Fecha se é carreta e salva dentro do excesso

?>
