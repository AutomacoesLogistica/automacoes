<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>



<?php


$pesquisa_id = isset($_GET['id'])?$_GET['id']:'vazio';


if($pesquisa_id != 'vazio')
{
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao_sva.php';
    $sql = $dbcon->query("UPDATE exportar_csv SET tratado='Sim',data_tratado='$data', hora_tratado='$hora' WHERE id_lidar='$pesquisa_id'");

    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE display_balanca1 SET api_lidar='$pesquisa_id'");


}
else
{
 echo   'vazio';   
}
exit();
?>