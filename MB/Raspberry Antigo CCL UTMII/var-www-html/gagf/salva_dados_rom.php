<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>

<?php

$limite  = $_POST['limite'];
//DADOS MENSAGENS
$mensagem_motorista  = $_POST['mensagem_motorista'];


//DADOS DOS MATERIAIS
$sl_primeiro_material = $_POST['sl_primeiro_material'];
$sl_segundo_material = $_POST['sl_segundo_material'];
$sl_terceiro_material = $_POST['sl_terceiro_material'];


//DADOS DAS AREAS
$sl_primeiro_area = $_POST['sl_primeiro_area'];
$sl_segundo_area = $_POST['sl_segundo_area'];
$sl_terceiro_area = $_POST['sl_terceiro_area'];

//DADOS DAS BAIAS
$sl_primeiro_baia = $_POST['sl_primeiro_baia'];
$sl_segundo_baia = $_POST['sl_segundo_baia'];
$sl_terceiro_baia = $_POST['sl_terceiro_baia'];


/*
if ($limite <0)
{
$limite = 10;
}
if($limite >20)
{
    $limite = 20;
}

*/
//SOMENTE NO PERIODO QUE ROM ESTA FALHANDO, DEPOIS APAGAR
$limite = '99999';


include_once 'conexao_rom.php';
$sql = $dbcon->query("UPDATE acessos SET limite='$limite' WHERE id='1'");



include_once 'conexao_rom.php';
$sql = $dbcon->query("UPDATE baias SET baia1='$sl_primeiro_material',baia2='$sl_segundo_material',baia3='$sl_terceiro_material',v_area1 = '$sl_primeiro_area',v_area2 = '$sl_segundo_area',v_area3 = '$sl_terceiro_area',v_baia1 = '$sl_primeiro_baia',v_baia2 = '$sl_segundo_baia',v_baia3 = '$sl_terceiro_baia' WHERE id='1'");


include_once 'conexao_rom.php';
$sql = $dbcon->query("UPDATE baias_mensagem SET mensagem='$mensagem_motorista' WHERE id='1'");



?>


</body>
</html>