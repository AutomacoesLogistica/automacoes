<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$nome = $_GET['nome'];
$registro = $_GET['registro'];
$senha = $_GET['senha'];

$sql1 = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro'");

if(mysqli_num_rows($sql1)>0){
echo "registro_encontrado";#Não continua pois ja existe o cadastro no banco
}else{
# Vai cadastrar pois não existe no banco
$sql2 = $dbcon->query("INSERT INTO pessoas(nome,registro,senha)VALUES('$nome','$registro','$senha')");


if($sql2){
 echo "registrado_com_sucesso"; # realizou o registro no banco de dados com sucesso
}else{
 echo "nao_registrou";# aconteceu algum erro ao salvar
}








}


?>