<?php

$valor_registro = isset($_GET['registro'])?$_GET['registro']:"vazio";
$tratativa = isset($_GET['tratativa'])?$_GET['tratativa']:"vazio";
$id = isset($_GET['id'])?$_GET['id']:"vazio";

if($valor_registro != "vazio" && $tratativa != "vazio" && $id != "vazio")
{
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');   
 include_once 'conexao_poste.php';
 $sql = $dbcon->query("UPDATE lidar_excesso SET tratado='Sim', registro_tratado='$valor_registro',tratativa='$tratativa',data_tratado='$data',hora_tratado='$hora' WHERE id='$id'");
 echo "salvo_com_sucesso";
}
else
{
 echo "Erro";   
}

?>