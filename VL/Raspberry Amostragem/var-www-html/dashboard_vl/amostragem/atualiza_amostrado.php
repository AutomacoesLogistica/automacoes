<?php
$encontrado = 0;

$tempo_gasto = isset($_GET['tempo_gasto'])?$_GET['tempo_gasto']:'0';

include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM amostragem ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
 $epc = $dados['epc'];
 $amostrado = $dados['amostrado'];
 $encontrado = 1;
}// fecha o if


echo "Achou a tag : ".$epc."</BR>";

if($encontrado == 1 && $amostrado == "nao")
{
 //Atualizo o tempo amostrado
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("UPDATE amostragem SET tempo_gasto='$tempo_gasto',amostrado='sim' WHERE id='$id'");

 //Atualizo em lista_amostragem
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("UPDATE lista_amostragem SET tratado = 'sim' WHERE epc='$epc' ORDER BY id DESC LIMIT 1");




//Agora atualizo no betruck



//  Consulto API BETRUCK ************************************************************************************************************
//  Consulto API BETRUCK ************************************************************************************************************
//  Consulto API BETRUCK ************************************************************************************************************
//  Consulto API BETRUCK ************************************************************************************************************
 $localEvento = "Miguel Burnier";

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


    //Busco os dados do ponto na tabela
    $vponto = "Amostragem MB";
  include_once 'conexao_amostragem.php';
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
else
{
  echo "erro";  
}












http_response_code(200);
?>

