<?php
$id  = $_GET['id'];
$parecer = $_GET['parecer']; // Sempre sera um SIM
$nome = $_GET['nome'];
$registro = $_GET['registro'];

include_once 'conexao_sva.php';
//PRIMEIRO VOU CATEGORIZAR O EVENTO COMO DETECÇÃO FALSA, ACRESCETANDO UM SIM
$sql = $dbcon->query("UPDATE cheio_vazio SET deteccao_falsa = '$parecer' WHERE id='$id'");

//$sql = $dbcon->query("UPDATE cheio_vazio SET justificado = 'SIM',registro='$registro',nome ='$nome',justificativa='$parecer' WHERE id='$id'");

echo json_encode("salvo");
 ?>
