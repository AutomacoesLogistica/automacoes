<?php

$curl = curl_init();
$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';

if($epc != "vazio")
{
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/ultima?tagVeiculo='.$epc,
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

curl_close($curl);
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

//DADOS DO VEICULO *************************************************************
$dados_do_veiculo = $jsonObj->veiculos;
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


//DADOS DA ULTIMA VIAGEM ********************************************************
$dados_da_ultima_viagem = $jsonObj->ultimaViagem;
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

echo "Dados da ultima viagem ****************************************************</br>";
echo "ID BeTruck da ultima viagem = " . $id_betruck_ultima_viagem ."</br>";
echo "ID GAGF da ultima viagem = " . $id_gagf_ultima_viagem ."</br>";
echo "Contratante da ultima viagem = " . $contratante_ultima_viagem ."</br>";
echo "Fornecedor da ultima viagem = " . $fornecedor_ultima_viagem ."</br>";
echo "Origem da ultima viagem = " . $origem_ultima_viagem ."</br>";
echo "Destino da ultima viagem = " . $destino_ultima_viagem ."</br>";
echo "Transportadora da ultima viagem = " . $transportadora_ultima_viagem ."</br>";
echo "Material da ultima viagem = " . $material_ultima_viagem ."</br>";
echo "Status da ultima viagem = " . $status_ultima_viagem ."</br>";
echo "Peso bruto da ultima viagem = " . $peso_bruto_ultima_viagem ."</br>";
echo "Peso liquido da ultima viagem = " . $peso_liquido_ultima_viagem ."</br>";
echo "Tara do veiculo na ultima viagem = " . $tara_veiculo_ultima_viagem ."</br>";
echo "Veiculo pesou na ultima viagem = " . $veiculo_pesou_ultima_viagem ."</br>";




}
else
{
 echo "Favor inserir uma tag valida!"   ;
}