<?php
$curl = curl_init();


$v_placa = isset($_GET['placa'])?$_GET['placa']:"vazio";

if($v_placa != "vazio")
{
 curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sistemas.hh2risk.com.br/ws_rest/public/api/veiculo/'.$v_placa,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array('Content-Type: application/json','User-Agent: cpprestsdk/2.9.0','Authorization: Basic aW50ZWdyYWNhby5nZXJkYXU6aW50ZTIwMjI=')));
 $response = curl_exec($curl);
 curl_close($curl);
 echo($response);
  echo "</BR>";
 if($response =='{"veiculo":null}')
 {
  echo "Placa não encontrada no sistema!";
 }
 else
 {
  $jsonObj = json_decode($response,false);
  $jsonObj2 = $jsonObj->veiculo;
  $codigo = $jsonObj2->codigo;
  $placa = $jsonObj2->placa;
  $frota = $jsonObj2->frota;
  $tipo_veiculo = $jsonObj2->tipo_veiculo;
  $documento_proprietario = $jsonObj2->documento_proprietario;
  $modelo = $jsonObj2->modelo;
  $marca = $jsonObj2->marca;
  $ano_modelo = $jsonObj2->ano_modelo;
  $ano_fabricacao = $jsonObj2->ano_fabricacao;
  $cor = $jsonObj2->cor;
  $condicao = $jsonObj2->status;
  if($condicao =="1")
  {
   $condicao = "Ativo";     
  }
  else if($condicao =="0")
  {
   $condicao = "Desativado"; 
  }
  else
  {
   $condicao = '';   
  }
  $terminais = $jsonObj2->terminais;
  $numero = strval(json_encode($terminais));
  $tec = json_decode($numero);
  $tecc = $tec[0];
  $v = json_encode($tecc);
  $valor = $v;
  $b = json_decode($valor);
  $numero = $b->numero;
  $tecnologia = $b->tecnologia;
  echo "Codigo = ". $codigo;echo("</BR>");
  echo "Placa Cavalo = ". $placa;echo("</BR>");
  echo "Frota = ". $frota;echo("</BR>");
  echo "Tipo Veiculo = ". $tipo_veiculo;echo("</BR>");
  echo "Documento Proprietario = ". $documento_proprietario;echo("</BR>");
  echo "Modelo = ". $modelo;echo("</BR>");
  echo "Ano Modelo = ". $ano_modelo;echo("</BR>");
  echo "Marca = ". $marca;echo("</BR>");
  echo "Ano Fabricacao = ". $ano_fabricacao;echo("</BR>");
  echo "Cor = ". $cor;echo("</BR>");
  echo "Telemetria = ". $tecnologia;echo("</BR>");
  echo "Codigo Telemetria = ". $numero;echo("</BR>");
  echo "Situação do veiculo = ". $condicao;echo("</BR>");
 }
}
else
{
 echo "Favor inserir um placa válida!";   
}
?>