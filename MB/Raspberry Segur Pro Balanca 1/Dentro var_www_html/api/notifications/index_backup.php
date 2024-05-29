<?php
error_reporting(0);
$method = $_SERVER['REQUEST_METHOD'];
header('Content-Type: application/json;charset=utf-8');
$dados = json_decode(file_get_contents('php://input'), true);
//print_r($dados);
$mensagem = strval(implode("','",$dados));
//echo strlen($mensagem);
$tipo_evento = $dados["type"]; // Para essa aplica��o sempre sera 15
$media_server_id = $dados["media_server_id"]; // pega o nome do servidor
$camera = $dados["camera_id"]; // pega o nome do ms+numero camera EX: ms0099-cam00
$valor_camera = explode('-',$camera);
$camera = $valor_camera[1]; //Extrai apenas o nome da camera!
$detected_at = $dados["detected_at"]; // recebe o horario detectado pelo sistema SVA
$local_api = $dados["media_server_name"]; // pega o local da api EX: MB-BAL-01
$saida_detectada = $dados["camera_name"]; // pega o nome do local da saida EX: SAIDA-PRI ou SAIDA-SEG
$deu_match = "";

if($saida_detectada == "SAIDA-PRI") // Detectado apenas placa
{
  $saida_detectada = "Saida Principal";  
}
else if($saida_detectada == "SAIDA-SEG") // Detectado apenas placa
{
  $saida_detectada = "Saida Segur Pro";  
}
else if ($saida_detectada == "SAIDA-PRI Cheio") // Detectado saindo cheio pela saida principal
{
  $saida_detectada = "Saida Principal";
}
else if ($saida_detectada == "SAIDA-PRI Vazio") // Detectado saindo vazio pela saida principal
{
  $saida_detectada = "Saida Principal";
}
else if ($saida_detectada == "SAIDA-SEG Cheio") // Detectado saindo cheio pela saida segur pro
{
  $saida_detectada = "Saida Segur Pro";
}
else if ($saida_detectada == "SAIDA-SEG Vazio") // Detectado saindo vazio pela saida segur pro
{
  $saida_detectada = "Saida Segur Pro";
}
else
{
  //Deixa como esta, o que foi recebido
}


$valor_placa = $dados["text"]; // recebe o valor da placa EX: ABC1010

if ( $valor_placa == "-" )
{
  $valor_placa = "xxxxxxx";
}
$video_placa = $dados["url"]; // recebe a url da placa
$condicao = $dados["text_2"]; // recebe o valor do status EX: CHE Cheio ou VAZ Vazio

if ($condicao == "CHE Cheio")
{
  $condicao = "Saindo Cheio!";  
}
else if ( $condicao == "VAZ Vazio")
{
  $condicao = "Saindo Vazio!";  
}
else if ( $condicao == "-")
{
  $condicao = "Detectado Placa!";
}
else
{
 // N�o faz nada, e deixa o valor que foi recebido!
}
$video_bascula = $dados["url_2"]; // recebe a url do video da b�scula
$imagem = $dados["image"]; // Imagem do evento

$data_completa = '';
$horario = '';

if ( $video_placa == $video_bascula)
{
$deu_match = "";
}
else
{
$deu_match = "MAT";
}



date_default_timezone_set('America/Sao_Paulo');
$data_completa = date('d/m/Y');
$horario = date('H:i:s');

include_once 'conexao_sva.php';

$pode_salvar = "SIM";

//VERIFICO SE A PLACA DETECTADA N�O CONSTA NA LISTA DE PLACAS DESCARTADAS
$sql = $dbcon->query("SELECT * FROM placas_descartadas WHERE valor_placa='$valor_placa'");
if(mysqli_num_rows($sql)>0)
{
 $pode_salvar = "NAO"; // A placa entregue pela API ja consta na lista de que nao desejamos salvar no sistema principal, porem vamos salva-la em outra lista por seguran�a!
}



$tag = "0";
//VERIFICO SE A PLACA DETECTADA Existe TAG
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$valor_placa'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $tag = $dados['tag'];# Busco a tag referente a placa
 }
}
else
{
$tag = 'vazio'; // Deixa em branco pois n�o encontrou a tag referente a esta placa!
}


include_once 'conexao_sva.php';

if ($pode_salvar=="SIM")
{
 //SALVA OS DADOS NO BANDO DE DADOS DO SISTEMA PRINCIPAL POIS A PLACA EST� PERMITDA!  
 $sql = $dbcon->query("INSERT INTO deteccao SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$data_completa',hora_leitura='$horario',local_api='$local_api',saida_detectada='$saida_detectada',valor_placa='$valor_placa',video_placa='$video_placa',condicao='$condicao',video_bascula='$video_bascula',imagem='$imagem',justificado='',registro='',nome='',justificativa='',deteccao_falsa='$deu_match',tag='$tag'");
}
else
{
  // A PLACA EXISTE NA LISTA DE NAO DESEJADOS, SALVAREMOS NO SISTEMA SECUNDARIO
  //$sql = $dbcon->query("INSERT INTO deteccao_proibidas SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$data_completa',hora_leitura='$horario',local_api='$local_api',saida_detectada='$saida_detectada',valor_placa='$valor_placa',video_placa='$video_placa',condicao='$condicao',video_bascula='$video_bascula',imagem='$imagem',justificado='SIM',registro='12345678',nome='USUARIO ROB�',justificativa='Placa detectada corretamente e a mesma n�o se trata de uma placa de carreta!',deteccao_falsa=''");
  $sql = $dbcon->query("INSERT INTO deteccao_proibidas SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$data_completa',hora_leitura='$horario',local_api='$local_api',saida_detectada='$saida_detectada',valor_placa='$valor_placa',video_placa='$video_placa',condicao='$condicao',video_bascula='$video_bascula',imagem='$imagem',justificado='SIM',registro='12345678',nome='USUARIO ROBO',justificativa='Placa detectada corretamente e a mesma nao se trata de uma placa de carreta!',deteccao_falsa='',tag='$tag'");
}



//Dados da mensagem sem a imagem.
$msg_completa = $tipo_evento.','.$media_server_id.','.$camera.','.$detected_at.','.$local_api.','.$saida_detectada.','.$valor_placa.','.$video_placa.','.$condicao.','.$video_bascula;

include_once 'conexao_sva.php';
$sql = $dbcon->query("INSERT INTO teste SET mensagem='$msg_completa'");

$msg = '200 OK';
echo json_encode($msg);
http_response_code(200);
?>

