<?php
$ponto  = $_GET['ponto'];


include_once 'conexao_portal_gestao.php';

$sql = $dbcon->query("SELECT * FROM tabela_referencia WHERE ponto='$ponto' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
 $site = $dados['site'];
 $area = $dados['area'];
 $caminho_foto1 = $dados['caminho_foto1'];
 $caminho_foto2 = $dados['caminho_foto2'];
 $caminho_foto3 = $dados['caminho_foto3']; 
 $descricao1 = $dados['descricao1'];
}
echo json_encode($id . ',' . $site . ',' . $area  . ',' . $caminho_foto1 . ',' . $caminho_foto2 . ',' . $caminho_foto3 . ',' . $descricao1);

 ?>
