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

$valor  = $_POST['dentro'];

if ($valor != '')
{
 include_once 'conexao_rom.php';
 $sql = $dbcon->query("UPDATE acessos SET dentro='$valor' WHERE id='1'");
}

?>


</body>
</html>