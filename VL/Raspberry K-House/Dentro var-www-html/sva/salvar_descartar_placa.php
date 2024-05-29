<?php
$id  = $_GET['id'];
$nome = $_GET['nome'];
$registro = $_GET['registro'];

include_once 'conexao_sva.php';

 $sql = $dbcon->query("SELECT * FROM deteccao WHERE id='$id'");
 $valor_placa = "VAZIO";
 
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $valor_placa = $dados['valor_placa'];
 }
}

if($valor_placa == "VAZIO")
{
 echo json_encode($id);
}
else
{
 date_default_timezone_set('America/Sao_Paulo');
 $data_completa = date('d/m/Y');
 $horario = date('H:i:s');
 
 
 //CATEGORIZAR O EVENTO COMO DETECÇÃO FALSA, ACRESCETANDO UM SIM
 $parecer = "BLK";
 $sql = $dbcon->query("UPDATE deteccao SET deteccao_falsa = '$parecer', nome = '$nome',registro = '$registro' WHERE id='$id'");
 
 
 include_once 'conexao_sva.php';
 $sql = $dbcon->query("INSERT INTO placas_descartadas SET valor_placa='$valor_placa',nome='$nome',registro='$registro',data_atualizacao='$data_completa',hora_atualizacao='$horario'");
 //CATEGORIZAR O EVENTO COMO DETECÇÃO FALSA, ACRESCETANDO UM BLK para saber que foi bloqueado a placa
 
 include_once 'conexao_sva.php';
 echo json_encode("salvo");
}

 ?>
