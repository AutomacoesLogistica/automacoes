<?php
$id  = $_GET['id'];
$parecer = $_GET['parecer']; // Sempre sera um SIM
$nome = $_GET['nome'];
$registro = $_GET['registro'];

include_once 'conexao_sva.php';

//PRIMEIRO VOU CATEGORIZAR O EVENTO COMO DETECÇÃO FALSA, ACRESCETANDO UM SIM
$sql = $dbcon->query("UPDATE pessoas SET deteccao_falsa = '$parecer', nome = '$nome',registro = '$registro'  WHERE id='$id'");


//ORA REPLICA O DADO PARA A OUTRA TABELA
$sql = $dbcon->query("INSERT INTO pessoas_descartado (tipo_evento,media_server_id,detected_at,data_leitura,hora,text,camera_id,caminho,caminho_video,imagem,justificado,registro,nome,justificativa,deteccao_falsa,id_original) SELECT tipo_evento,media_server_id,detected_at,data_leitura,hora,text,camera_id,caminho,caminho_video,imagem,justificado,registro,nome,justificativa,deteccao_falsa,'$id' FROM pessoas WHERE id='$id'");




//$sql = $dbcon->query("UPDATE cheio_vazio SET justificado = 'SIM',registro='$registro',nome ='$nome',justificativa='$parecer' WHERE id='$id'");

echo json_encode("salvo");
 ?>