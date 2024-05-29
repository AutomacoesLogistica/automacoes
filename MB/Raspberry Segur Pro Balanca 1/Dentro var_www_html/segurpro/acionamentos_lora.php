<?php
$mensagem = $_GET['mensagem'];

if($mensagem == "normalizar")
{
    $v_msg = ">0,1<"; //Normaliza entrada!
    include_once 'conexao_poste.php';
    $sql = $dbcon->query("INSERT INTO mensagens_lora(id,mensagem) VALUES (DEFAULT,'$v_msg')");
    
    //mysqli_close();
   
    echo ("ok");
}
else
{
    echo ("n_ok");
}
