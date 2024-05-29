<?php
error_reporting(0);
$method = $_SERVER['REQUEST_METHOD']=='POST';
header('Content-Type: application/json;charset=utf-8;');
$dados = json_decode(file_get_contents('php://input'), true);
//print_r($dados);
//$mensagem = strval(implode("','",$dados));
//echo strlen($mensagem);

$media_server_id = $dados["media_server_id"]; // pega o nome do servidor
$camera = $dados["camera_id"]; // pega o nome do ms+numero camera EX: ms0099-cam00
$tipo_evento = $dados["type"]; // Para essa aplicacao sempre sera 15
$text = $dados["text"]; // Para essa aplicacao vem sempre DCG Distribuição
$detected_at = $dados["detected_at"]; // recebe o horario detectado pelo sistema SVA
$confidence = $dados["confidence"]; // Valor de 0 a 100, quando maior, significa que foi uma boa assertividade e pode confiar no evento
$mediaZ_Total = $dados["averageAll"]; // Media do Z de todos os pontos
$mediaZ_Carga = $dados["averageCargo"]; // Media do Z de todos os pontos
$dlc = $dados["dlc"]; // Numero entre 0 e 100 indicando a distribuicao longitudinal da carga
$dtc = $dados["dtc"]; // Numero entre 0 e 100 indicando a distribuicao longitudinal da carga
$videoURL = $dados["videoURL"]; // Implementacao futura
$snapshotURL = $dados["snapshotURL"]; // Implementacao futura
$num_linhas_matrix = $dados["surface_rows"]; // Indica quantas linhas ha na matriz de superficie.
$num_colunas_matrix = $dados["surface_cols"]; // Indica quantas colunas ha na matriz de superficie.
$matrix = $dados["surface"]; //Matriz bidimensional com a altura de cada ponto do solo. Pontos onde nao houve leitura vem com null
date_default_timezone_set('America/Sao_Paulo');
$data_completa = date('d/m/Y');
$horario = date('H:i:s');


//$msg_completa = $media_server_id.','.$camera.','.$tipo_evento.','.$text.','.$detected_at.','.$conficende.','.$mediaZ_Total.','.$mediaZ_Carga.','.$dlc.','.$dtc.','.$num_linhas_matrix.','.$num_colunas_matrix;
$msg_completa = '-';
include_once 'conexao.php';
$sql = $dbcon->query("INSERT INTO teste SET mensagem='$msg_completa");

include_once 'conexao.php';
$sql = $dbcon->query("INSERT INTO dados_api_lidar SET media_server_id='$media_server_id',camera='$camera',tipo_evento='$tipo_evento',detected_at='$detected_at',data_leitura='$data_completa',hora_leitura='$horario',confidence='$confidence',mediaZ_Total='$mediaZ_Total',mediaZ_Carga='$mediaZ_Carga',dlc='$dlc',dtc='$dtc',num_linhas_matrix='$num_linhas_matrix',num_colunas_matrix='$num_colunas_matrix',url_video='$videoURL',url_snapshot='$snapshotURL',plot_lidar='".serialize($matrix)."' ");

include_once 'conexao.php';
$sql = $dbcon->query("INSERT INTO teste2 SET mensagem='ok");



include_once 'conexao.php';
//$v_msg = $mensagem[0].','.$mensagem[1].','.$mensagem[2];
//$sql = $dbcon->query("INSERT INTO teste2 SET mensagem='$v_msg'");

$msg = '200 OK';
echo json_encode($msg);
http_response_code(200);
?>

