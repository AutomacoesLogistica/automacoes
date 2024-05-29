<?php
error_reporting(0);
$tag_carreta = '';
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  
echo($data_agora);    
echo'</BR>';

$tag = isset($_GET['epc'])?$_GET['epc']:'vazio';

//Atualiza como tratado no banco
include_once 'conexao_ca2.php';
$sql = $dbcon->query("UPDATE validacoes_socket SET data_tratado='$data', hora_tratado='$hora', condicao='Tratado' WHERE epc_carreta='$tag'");

$equipamento = substr($tag,0,6);
if($equipamento == '442002')
{
 $tag_cavalo = 'vazio';
 $tag_carreta = $tag;
}
else if ($equipamento == '442001')
{
 $tag_carreta = 'vazio';
 $tag_cavalo = $tag;
}
else
{
 $equipamento = '';
}
$encontrados_dashboard = 0;
$encontrados_historico = 0;
$id_banco_dashboard = 0;
$id_banco_historico = 0;
$valor_ponto = 0;


//Busco o turno
$turno1 = '';
$turno2 = '';
$turno3 = '';
$turno_atual = '';

//Busco o turno atual
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_turno_dashboard_2024 WHERE data='$data'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  $turno1 = $dados['turno1'];
  $turno2 = $dados['turno2'];
  $turno3 = $dados['turno3'];
 }
}

$valor_hora = explode(':',$hora);
$valor_hora = $valor_hora[0];
if(intval($valor_hora)>=0 && intval($valor_hora)<8)
{
 //Turno 1
 $turno_atual = $turno1;  
}
else if(intval($valor_hora)>=8 && intval($valor_hora)<17)
{
 //Turno 2
 $turno_atual = $turno2;  
}
else if(intval($valor_hora)>=17 && intval($valor_hora)<23)
{
 //Turno 3
 $turno_atual = $turno3;  
}
else
{
 //erro
 $turno_atual = '-';
}



echo "Turno atual : " .$turno_atual . "</BR>";

//echo ($equipamento);
if($tag_carreta != 'vazio') // Ja busco pela tag da carreta
{
 print('</BR>');
 print('Buscando por tag de carreta! - Tag: ' .$tag_carreta);
 print('</BR>');
 // Agora conecto no banco e busco os dados
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_carreta='$tag_carreta' AND (tipo='Entrada') ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  { 
   $id_banco_dashboard = $dados['id'];
   $encontrados_dashboard = 1;
	 echo('ID no banco é '. $id_banco_dashboard);
   echo'</BR>';
  }
 } // Fecho if do banco
 else
 {
	$encontrados_dashboard = -2;
  //TEM QUE CRIAR NO BANCO POIS DEIXOU DE LER NA ENTRADA POR ALGUM MOTIVO!
  //FALTA CRIAR ESTA PARTE
 }
 // Agora conecto no banco historico e busco os dados
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$tag_carreta' AND (v_status!='Controle Acesso' AND v_status!='Saiu da Planta' AND $encontrados_dashboard != 0) ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  { 
   $id_banco_historico = $dados['id'];
   $valor_ponto = intval($dados['valor_ponto']);
   $encontrados_historico = 1;
  }
 } // Fecho if do banco
 else
 {
  //TEM QUE CRIAR NO BANCO POIS DEIXOU DE LER NA ENTRADA POR ALGUM MOTIVO!
  //FALTA CRIAR ESTA PARTE
 }
} // Fecha if carreta
else if ($tag_cavalo != 'vazio')
{
 print('</BR>');
 print('Buscando por tag de cavalo! - Tag: ' .$tag_cavalo);
 print('</BR>');
 echo'</BR>';
 // Agora conecto no banco e busco os dados
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_cavalo='$tag_cavalo' AND (tipo='Entrada') ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  { 
   $id_banco_dashboard = $dados['id'];
   $encontrados_dashboard = 1;
  }
 } // Fecho if do banco
 else
 {
	$encontrados_dashboard = -3; // ainda a decider se vou tratar ou nao
	//Não encontrou, falta criar o historico para ele, pois faltou leitura na entrada
 }
 // Agora conecto no banco historico e busco os dados
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM historico WHERE epc_cavalo='$tag_cavalo' AND (v_status!='Controle Acesso' AND v_status!='Saiu da Planta' AND $encontrados_dashboard != 0)  ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  { 
   $id_banco_historico = $dados['id'];
   $valor_ponto = intval($dados['valor_ponto']);
   $encontrados_historico = 1;
  }
 } // Fecho if do banco
 else
 {
  // Não encontrou, agora faço leitura para ele na entrada
  //FALTA FAZER
 }
}
else
{
 //Nao busca
 print('Sem tag!');
 echo'</BR>';
}

echo " TAG no banco historico: ";
echo($id_banco_historico);
echo "</BR>";



$epc_carreta = $tag;

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


    //Busco os dados do ponto na tabela
    $vponto = "Controle de Acesso LD";
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM referencias_betruck WHERE ponto = '$vponto'");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $sn_reader = $dados['sn_reader'];
   $site = $dados['site'];
   $latitude = $dados['latitude'];
   $longitude = $dados['longitude'];
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






if($encontrados_dashboard == 1) //Posso atualizar 
{
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE dashboard SET epc_cavalo='$tag_do_cavalo',placa_cavalo='$placa_do_cavalo',placa_carreta='$placa_da_carreta',tipo='Controle', ponto='Controle LD UTMI', data_leitura='$data', hora_leitura='$hora' WHERE id='$id_banco_dashboard'");
 echo "Fez UPDATE no dashboard" ;
 echo "</BR>";
}
if($encontrados_historico == 1) // Posso atualizar
{
 $valor_ponto = intval($valor_ponto + 1);
 $ponto = 'ponto'.$valor_ponto; 
 $data_leitura = 'data_leitura'.$valor_ponto;
 $hora_leitura = 'hora_leitura'.$valor_ponto;
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE historico SET turno='$turno_atual', v_status='Controle Acesso',valor_ponto='$valor_ponto', $ponto='Controle LD UTMI', $data_leitura='$data', $hora_leitura='$hora' WHERE id='$id_banco_historico'");
 echo "Fez UPDATE no historico" ;
 echo "</BR>"; 
}
if($encontrados_dashboard == -2 AND $tag_carreta != 'vazio') //Não existe pois perdeu nas entradas, entao crio com o ponto para traz em vazio
{
 echo "Entrou para outra validacao *************</BR>";
 // Agora conecto no banco e busco os dados
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_carreta='$tag_carreta' AND (tipo='Controle') ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
	//Ja existe! foi criado antes e feito isso para nao criar duas vezes ou mais
  while($dados = $sql->fetch_array())
  { 
   echo (' Ja existe e foi criado 1 vez! </BR> ');
   echo'</BR>';
	 $id_banco_dashboard = $dados['id'];
	}
 }
 else
 {
  include_once 'conexao.php';
  $sql = $dbcon->query("INSERT INTO dashboard (epc_cavalo,epc_carreta,placa_cavalo,placa_carreta,tipo,ponto,data_leitura,hora_leitura) VALUES ('$tag_do_cavalo','$tag_da_carreta','$placa_do_cavalo','$placa_da_carreta','Controle', 'Controle LD UTMI', '$data', '$hora')");
  //Busco o turno
	$turno1 = '';
  $turno2 = '';
  $turno3 = '';
  $turno_atual = '';
  //Busco o turno atual
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM lista_turno_dashboard_2024 WHERE data='$data'");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   { 
    $turno1 = $dados['turno1'];
    $turno2 = $dados['turno2'];
    $turno3 = $dados['turno3'];
   }
  }
  $valor_hora = explode(':',$hora);
  $valor_hora = $valor_hora[0];
  if(intval($valor_hora)>=0 && intval($valor_hora)<8)
  {
   //Turno 1
   $turno_atual = $turno1;  
  }
  else if(intval($valor_hora)>=8 && intval($valor_hora)<17)
  {
   //Turno 2
   $turno_atual = $turno2;  
  }
  else if(intval($valor_hora)>=17 && intval($valor_hora)<23)
  {
   //Turno 3
   $turno_atual = $turno3;  
  }
  else
  {
   //erro
   $turno_atual = '-';
  }
  //Agora crio no historico
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao.php';
  $sql = $dbcon->query("INSERT INTO historico SET 
  epc_cavalo='$tag_do_cavalo',
  epc_carreta ='$tag_da_carreta',
  placa_cavalo='$placa_do_cavalo',
  placa_carreta='$placa_da_carreta',
  turno='$turno_atual',
  v_status='Controle Acesso',
  encerrado_por='-',
  valor_ponto='2',
  ponto1='Entrada Pires',
  data_leitura1='-',
  hora_leitura1='-',
  ponto2='Controle LD UTMI',
  data_leitura2='$data',
  hora_leitura2='$hora',
  ponto3='',
  data_leitura3='',
  hora_leitura3='',
  ponto4='',
  data_leitura4='',
  hora_leitura4='',
  ponto5='',
  data_leitura5='',
  hora_leitura5='',
  ponto6='',
  data_leitura6='',
  hora_leitura6='',
  ponto7='',
  data_leitura7='',
  hora_leitura7='',
  ponto8='',
  data_leitura8='',
  hora_leitura8='',
  ponto9='',
  data_leitura9='',
  hora_leitura9='',
  ponto10='',
  data_leitura10='',
  hora_leitura10='',
  ponto11='',
  data_leitura11='',
  hora_leitura11='',
  ponto12='',
  data_leitura12='',
  hora_leitura12='',
  ponto13='',
  data_leitura13='',
  hora_leitura13='',
  ponto14='',
  data_leitura14='',
  hora_leitura14='',
  ponto15='',
  data_leitura15='',
  hora_leitura15=''
  ");
 } // Fecha else de pode crair pois é a primeira vez
} // Fecha if encontrados  == -2






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





?>