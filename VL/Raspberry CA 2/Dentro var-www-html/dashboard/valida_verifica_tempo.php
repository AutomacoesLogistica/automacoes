<?php
$msg  = $_GET['msg'];
$mensagem2 = explode(',',$msg);

//var_dump($mensagem2);
$tamanho = count($mensagem2);

for ($i = 1; $i <= $tamanho; $i++) {
    
    $id = $mensagem2[intval($i)-1];
    echo $id; echo '</BR>'; 
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("DELETE FROM dashboard WHERE id='$id'"); // Deleto a linha para tirar o dado da tela do dashboard







} // Fecha for
echo json_encode($msg);
 ?>
