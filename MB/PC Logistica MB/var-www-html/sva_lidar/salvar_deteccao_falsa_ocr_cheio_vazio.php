<?php
$id  = $_GET['id'];
$parecer = $_GET['parecer']; // Sempre sera um SIM
$nome = $_GET['nome'];
$registro = $_GET['registro'];

include_once 'conexao_sva.php';
//CATEGORIZAR O EVENTO COMO DETECÇÃO FALSA, ACRESCETANDO UM SIM
$sql = $dbcon->query("UPDATE deteccao SET deteccao_falsa = '$parecer', nome = '$nome',registro = '$registro' WHERE id='$id'");



//PRA REPLICA O DADO PARA A OUTRA TABELA
$sql = $dbcon->query("INSERT INTO deteccao_descartado (tipo_evento,media_server_id,camera,detected_at,data_leitura,hora_leitura,local_api,saida_detectada,valor_placa,video_placa,condicao,video_bascula,imagem,justificado,registro,nome,justificativa,deteccao_falsa,id_original) SELECT tipo_evento,media_server_id,camera,detected_at,data_leitura,hora_leitura,local_api,saida_detectada,valor_placa,video_placa,condicao,video_bascula,imagem,justificado,registro,nome,justificativa,deteccao_falsa,'$id' FROM deteccao WHERE id='$id'");














//$sql = $dbcon->query("UPDATE cheio_vazio SET justificado = 'SIM',registro='$registro',nome ='$nome',justificativa='$parecer' WHERE id='$id'");

echo json_encode("salvo");
 ?>
