<?php
$id  = $_GET['id'];
$parecer = $_GET['parecer'];
$nome = $_GET['nome'];
$registro = $_GET['registro'];
$erro_ocr = $_GET['erro_ocr'];

if($erro_ocr == 'VAZIO')
{
$erro_ocr = ' ';
}

$parecer = str_replace(",",">",$parecer); // Troca a virgula por > , da erro de exibição no mysql a virgula


include_once 'conexao_sva.php';

$sql = $dbcon->query("UPDATE deteccao SET justificado = 'SIM',registro='$registro',nome ='$nome',justificativa='$parecer', deteccao_falsa='$erro_ocr' WHERE id='$id'");

echo json_encode("salvo");

 ?>
