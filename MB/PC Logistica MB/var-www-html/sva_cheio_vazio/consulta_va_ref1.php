<?php
$id  = $_GET['id'];
include_once 'conexao_sva.php';

$sql = $dbcon->query("SELECT * FROM deteccao WHERE id='$id'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $justificado = $dados['justificado'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
  $registro = $dados['registro'];
  $nome = $dados['nome'];
  $justificativa = $dados['justificativa'];
 }
}

echo json_encode($justificado.','.$registro.','.$nome.','.$justificativa);
 ?>
