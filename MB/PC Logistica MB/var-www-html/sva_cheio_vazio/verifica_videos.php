<?php
$id  = $_GET['id'];

include_once 'conexao_sva_cheio_vazio.php';
$sql = $dbcon->query("SELECT * FROM deteccao ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $ultimo_id = $dados['id'];
 
}


echo ("$ultimo_id");












//$sql = $dbcon->query("UPDATE cheio_vazio SET justificado = 'SIM',registro='$registro',nome ='$nome',justificativa='$parecer' WHERE id='$id'");


 ?>
