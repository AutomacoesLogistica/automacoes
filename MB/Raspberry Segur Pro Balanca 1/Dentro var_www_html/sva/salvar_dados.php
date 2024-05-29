<?php
$foto  = isset($_GET['foto'])?$_GET['foto']:"vazio";
$foto_recebida = $foto;
//echo($foto_recebida);
$url_video = str_replace(".png",".avi",$foto);

$foto = explode('_',$foto);
$data_leitura = str_replace("=","/",$foto[0]);
$dados = explode("/",$data_leitura);
$dia = $dados[0];
$mes = $dados[1];
$ano = $dados[2]; 


$foto = $foto[1];

$foto = explode("*",$foto);
$horario_leitura = str_replace("^",":",$foto[0]);

//echo($horario_leitura);
$foto = $foto[1];
$velocidade = explode('.',$foto);
$velocidade = $velocidade[0];
$caminho = "http://192.168.10.42/sva/videos/radar_restaurante_mb/".$ano."/".$mes."/".$dia."/".$url_video;
$caminho2 = "http://192.168.10.42/sva/videos/radar_restaurante_mb/".$ano."/".$mes."/".$dia."/".$foto_recebida;
//$caminho2 = ''
//echo($caminho);
$img = file_get_contents($caminho2); 
$foto_blob = base64_encode($img); 
//echo($foto_blob);

include_once 'conexao_sva.php';

$sql = $dbcon->query("INSERT INTO radar_restaurante_mb (tipo_evento,media_server_id,detected_at,data_leitura,hora,text,camera_id,caminho,caminho_video,imagem,justificado,registro,nome,justificativa,placa,deteccao_falsa) VALUES ($velocidade,'-','-','$data_leitura','$hora_leitura','Veiculo detectado','-','$url_video','-','$foto_blob','-','-','-','-','-','-')");

?>
