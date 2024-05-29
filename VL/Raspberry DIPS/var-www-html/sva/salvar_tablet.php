<?php
$id  = $_GET['id'];
$resposta  = $_GET['resposta'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');


if($resposta =='sim')
{
 $justificativa = 'Justificado OK pelo tablet no dia '. $data. ' as '. $hora;

 include_once 'conexao_sva.php';
 $sql = $dbcon->query("UPDATE deteccao SET deteccao_falsa='',justificado='SIM',registro='123456',nome='Tablet Entrada CO',justificativa='$justificativa' WHERE id='$id'");  
}
else if ($resposta == 'nao')
{
 $justificativa = 'Justificado como ERRO pelo tablet no dia '. $data. ' as '. $hora;
   
    //Foi uma deteccao errada!
    include_once 'conexao_sva.php';
 $sql = $dbcon->query("UPDATE deteccao SET deteccao_falsa='XXX',justificado='SIM',registro='123456',nome='Tablet Entrada CO',justificativa='$justificativa' WHERE id='$id'");  
}

echo json_encode('ok');


?>