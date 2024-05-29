<?php

$curl = curl_init();

$epc_cavalo  = "442001000000000000002975";
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/ultima?tagVeiculo='.$epc_cavalo,
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
//echo $response;


$jsonObj = json_decode($response);
$veiculos = $jsonObj->veiculos;

curl_close($curl);


$dados_cavalo = $veiculos[0];
$dados_carreta = $veiculos[1];

$betruck_api_carreta = $dados_carreta->tag;

var_dump($betruck_api_carreta);