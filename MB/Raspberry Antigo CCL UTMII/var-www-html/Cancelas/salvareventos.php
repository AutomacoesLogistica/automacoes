<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$registro = $_POST['registro'];
$justificativa = $_POST['justificativa'];
$cancela = $_POST['cancela'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$nome_colaborador = $_POST['nome_colaborador'];
$sitio = $_POST['sitio'];
$area = $_POST['area'];


$sql3 = $dbcon->query("INSERT INTO eventos(registro,justificativa,cancela,data,hora,nome_colaborador,sitio,area)VALUES('$registro','$justificativa','$cancela','$data','$hora','$nome_colaborador','$sitio','$area')");


if($sql3){
echo "salvo_com_sucesso"; #Aconteceu tudo certo e informa a mensagem para o app proceguir
}else{
echo "erro_ao_salvar";# Aconteceu alguma falha e informa o app para tratar ou solicitar novo salvamento
};


?>
