<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$nome_infracao = $_POST['nome_infracao'];
$pontos_infracao = $_POST['pontos_infracao'];

$sql3 = $dbcon->query("INSERT INTO lista_infracoes(nome_infracao,pontos_infracao)VALUES('$nome_infracao','$pontos_infracao')");


if($sql3){
echo "salvo_infracao_sucesso"; #Aconteceu tudo certo e informa a mensagem para o app proceguir
}else{
echo "erro_ao_salvar_infracao";# Aconteceu alguma falha e informa o app para tratar ou solicitar novo salvamento
};


?>
