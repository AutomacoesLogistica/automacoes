<?php

$semaforo = isset($_GET['semaforo'])?$_GET['semaforo']:"vazio";


if($semaforo == "vazio")
{
 echo "Erro, faltando dados!";
}
else
{
 echo "Valor da semaforo foi para " . $semaforo;   
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("UPDATE configuracoes_amostragem SET semaforo='$semaforo' WHERE id=1");  
}
http_response_code(200);

?>