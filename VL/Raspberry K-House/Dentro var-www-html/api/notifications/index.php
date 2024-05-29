<?php
error_reporting(0);
$method = $_SERVER['REQUEST_METHOD'];
header('Content-Type: application/json;charset=utf-8');

$dados = json_decode(file_get_contents('php://input'), true);
//print_r($dados);
$mensagem = strval(implode("','",$dados));
//echo strlen($mensagem);
$tipo_evento = $dados["type"]; // Para essa aplicação sempre sera 2
$media_server_id = $dados["media_server_id"]; // pega o nome do servidor
$detected_at = $dados["detected_at"]; // recebe o horario detectado pelo sistema SVA
$status = $dados["text"]; // recebe o valor Detectou
$camera = $dados["camera_id"]; // pega o nome do ms+numero camera EX: ms0099-cam00
$valor_camera = explode('-',$camera);
$camera = $valor_camera[1]; //Extrai apenas o nome da camera!
$local_api = 'Entrada CO';
$video_url = $dados["url"]; // recebe a url da placa
$imagem = $dados["image"]; // Imagem do evento

$data_completa = '';
$horario = '';

date_default_timezone_set('America/Sao_Paulo');
$data_completa = date('d/m/Y');
$horario = date('H:i:s');

$ultimo_id = 0;
$valor_id = 0;

//Busco o ultimo ID para saber qual o ID do video atual que a API vai salvar
include_once 'conexao_sva.php';
$sql = $dbcon->query("SELECT * FROM deteccao ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $ultimo_id = $dados['id'];
 $valor_id = intval($ultimo_id)+1; //Soma 1 pois o ultimo ID é do ultimo video salvo, quando a api for salvar la, ele pegara um numero acima,nesse caso o valor que ja esta em ultimo_id
}
if($status=='Ausencia de Dip')
{
 include_once 'conexao_sva.php';
 //SALVA OS DADOS NO BANDO DE DADOS DO SISTEMA PRINCIPAL POIS A PLACA ESTÁ PERMITDA!  
 $sql = $dbcon->query("INSERT INTO deteccao SET tipo_evento='$tipo_evento',media_server_id='$media_server_id',camera='$camera',detected_at='$detected_at',data_leitura='$data_completa',hora_leitura='$horario',local_api='$local_api',saida_detectada='',valor_placa='$status',video_placa='$video_url',condicao='',video_bascula='',imagem='$imagem',justificado='',registro='',nome='',justificativa='',deteccao_falsa='',tag=''");
 
 include_once 'conexao_sva.php';
 //SALVO OS DADOS PARA O TABLET ****************************************************8
 $sql = $dbcon->query("INSERT INTO deteccao_tablet SET id_deteccao='$valor_id',media_server_id='$media_server_id',camera='$camera',data_leitura='$data_completa',hora_leitura='$horario',video_placa='$video_url',imagem='$imagem',status='XXX'");

 //Dados da mensagem sem a imagem.
 $msg_completa = $tipo_evento.','.$media_server_id.','.$camera.','.$detected_at.','.$local_api.','.$status.','.$video_url.','.$video_url2;

 include_once 'conexao_sva.php';
 $sql = $dbcon->query("INSERT INTO teste SET mensagem='$msg_completa'");

}
$msg = '200 OK';
echo json_encode($msg);
http_response_code(200);
?>

