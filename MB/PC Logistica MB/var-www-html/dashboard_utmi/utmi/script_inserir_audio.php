<?php
include_once 'conexao.php';
$sql = $dbcon->query("INSERT INTO audios(audio) VALUES ('reproduzir_audio')");
echo "ok";
?>