<?php

$tela = isset($_GET['tela'])?$_GET['tela']:"vazio";


if($tela == "vazio")
{
 echo "Erro, faltando dados!";
}
else
{
 echo "Valor da tela foi para " . $tela;   
 include_once 'conexao_amostragem.php';
 $sql = $dbcon->query("UPDATE configuracoes_amostragem SET tela='$tela' WHERE id=1");  
}
http_response_code(200);

?>