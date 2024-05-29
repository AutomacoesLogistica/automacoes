<?php
$epc_betruck = isset($_GET['epc'])?$_GET['epc']:'"442002000000000000001926";';

$localEvento = "Miguel Burnier";
   
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
    'localEvento: '.$localEvento
),
));



   
   
    $response = curl_exec($curl);
    $valor = intval(strpos($response,"statusCode"));
    if($valor>0)
    {
     $condicao = "Erro!";
    }
    else
    {
     $condicao = "Sucesso!";
    }
    curl_close($curl);
    echo $response;
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao_saida_automacoes.php';
    $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");



?>