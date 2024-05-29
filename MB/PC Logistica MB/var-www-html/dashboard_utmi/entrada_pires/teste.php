<?php
$tipo = 'Entrada'; //Fixo, nao muda!

$epc_carreta = "442002000000000000001789";
$localEvento = "Miguel Burnier";  //Para api BeTruck

$encontrado = 0;
echo "Tratando o ID = " . $id . " e a TAG = " . $epc_carreta;
echo "</BR>";
echo "</BR>";
echo "</BR>";
echo "</BR>";

if ($epc_carreta != 'vazio') 
{
    echo ("Entrou para fazer validacao no BeTRuck!");
    echo "</BR>";
    echo "</BR>";


    //  Consulto API BETRUCK ************************************************************************************************************
    //  Consulto API BETRUCK ************************************************************************************************************
    //  Consulto API BETRUCK ************************************************************************************************************
    //  Consulto API BETRUCK ************************************************************************************************************

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
    

    $placaCavalo = $placa_do_cavalo;
    $placaCarreta = $placa_da_carreta;

    if ($placaCavalo == "") 
    {
     $placaCavalo = "-";
    }
    if ($placaCarreta == "") 
    {
     $placaCarreta = "-";
    }
        
        
   
    $epc_cavalo = $tag_do_cavalo;
        if($valor == "Encontrado")
        {
         echo "</br></br>Validando BeTruck!</br></br>";
         //Agora faço envio para atualizar historico no BeTruck
         $ponto = "Entrada do Pires";
         //Busco os dados do ponto na tabela
         include_once 'conexao.php';
         $sql = $dbcon->query("SELECT * FROM referencias_betruck WHERE ponto = '$ponto'");
         if(mysqli_num_rows($sql)>0)
         {
          $dados = $sql->fetch_array();
          $sn_reader = $dados['sn_reader'];
          $site = $dados['site'];
          $latitude = $dados['latitude'];
          $longitude = $dados['longitude'];
         }
         //consulta
         date_default_timezone_set('America/Sao_Paulo');
         $data = date('Y-m-d');
         $hora = date('H:i:s');
         $data_agora = $data . 'T' . $hora.'Z';  //Caso eu queira usar a data de agora PADRAO "2024-05-09T12:26:05Z
         

         echo "Dados";
         echo "SN : " . $sn_reader . "</BR>";
         echo "site : " . $site . "</BR>";
         echo "latitude : " . intval($latitude) . "</BR>";
         echo "longitude : " . intval($longitude) . "</BR>";
         echo "ponto : " . $ponto . "</BR>";
         echo "ponto : " . $id_betruck_ultima_viagem . "</BR>";
         echo "data_agora : " . $data_agora . "</BR>";
         
         
         
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
           "descricaoStatus": "'.$ponto.'",
           "localEvento": "'.$site.'",
           "latitude": '.$latitude.',
           "longitude": '.$longitude.',
           "dataHoraEvento": "'.$data_agora.'",
           "codigoDocumentoVenda": "x",
           "codigoDocumentoFiscal": "x",
           "codigoDocumento": "x",
           "localCarga": "x",
           "localDescarga": "x",
           "pesoBruto": "x",
           "pesoLiquido": "x",
           "taraVeiculo": "x",
           "usuario": "x",
           "camposDinamicos": 
           {
             "alerta1": "NA",
             "alerta2": "NA",
             "video_bascula": "NA",
             "video_placa": "NA",
             "imagem_bascula": "NA",
             "imagem_placa": "NA",
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
         echo "</BR></BR></BR>".$response;
         
         
        } //Fecha  if($valor == "Encontrado")
        else
        {
            echo "Erro  if($valor == 'Encontrado')";
        }




























}
else 
{
    echo "Tag invalida!";
    exit();
}
