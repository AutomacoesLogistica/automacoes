<?php
$id  = $_GET['id'];
$parecer = $_GET['parecer'];

include_once 'conexao_sva.php';
$sql = $dbcon->query("UPDATE deteccao SET justificativa = '$parecer'WHERE id='$id'");
echo json_encode("ok");















 ?>