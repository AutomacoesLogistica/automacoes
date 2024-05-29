<?php
$condicao = isset($_GET['condicao'])?$_GET['condicao']:"vazio";

require_once 'condicao_pires.php';
$sql = $dbcon->query("SELECT * FROM mensagens_pires ORDER BY id DESC");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $valor_limite = $dados['id'];
}// fecha o if
 
echo ($valor_limite);


 ?>