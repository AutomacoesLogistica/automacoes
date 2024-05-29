<?php
$id  = $_GET['id'];
$parecer = $_GET['parecer'];
$nome = $_GET['nome'];
$registro = $_GET['registro'];

$parecer = str_replace(",",">",$parecer); // Troca a virgula por > , da erro de exibição no mysql a virgula


include_once 'conexao_sva.php';

$sql = $dbcon->query("UPDATE pessoas SET justificado = 'SIM',registro='$registro',nome ='$nome',justificativa='$parecer' WHERE id='$id'");

echo json_encode("salvo");
 ?>
