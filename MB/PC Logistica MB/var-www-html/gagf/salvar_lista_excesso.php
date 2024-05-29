<?php
include_once 'conexao.php';
$epc = $_GET['epc'];
$placa = $_GET['placa'];
$data = $_GET['data'];
$hora = $_GET['hora'];
$uf = $_GET['uf'];
$nome_sitio = $_GET['nome_sitio']; // Busca se o CA esta pertencendo a MB ou VL para a carregadeira de excesso
$ID = 0;

$sql = $dbcon->query("SELECT * FROM lista_excesso WHERE epc='$epc' AND data='$data'");

if(mysqli_num_rows($sql)>0){ # Encontrou algum registro com tag e data igual, basta verificar se é a mais de 1 hora
while($dados = $sql->fetch_array()){
$rest = intval(substr($dados['hora'],0,2));
$result = (intval(substr($hora,0,2)))-intval($rest);
if ($result>=1){
$ID = intval($dados['id']);
}else{
$ID = 0;
}
}#fecha while

#Verifica se pode salvar
if ($ID > 0 ){
#Pode Salvar
$sql3 = $dbcon->query("INSERT INTO lista_excesso(epc,placa,data,hora,uf,nome_sitio)VALUES('$epc','$placa','$data','$hora','$uf','$nome_sitio')");
if($sql3){
echo "salvo_excesso_sucesso"; #Aconteceu tudo certo e informa a mensagem para o app proceguir
}else{
echo "erro_ao_salvar_excesso";# Aconteceu alguma falha e informa o app para tratar ou solicitar novo salvamento
}
}else{
echo"nao_pode_salvar";
}

}else{# Ja salva pois nao existe no banco de dados
$sql3 = $dbcon->query("INSERT INTO lista_excesso(epc,placa,data,hora,uf,nome_sitio)VALUES('$epc','$placa','$data','$hora','$uf','$nome_sitio')");
if($sql3){
echo "salvo_excesso_sucesso"; #Aconteceu tudo certo e informa a mensagem para o app proceguir
}else{
echo "erro_ao_salvar_excesso";# Aconteceu alguma falha e informa o app para tratar ou solicitar novo salvamento
}
}#Fecha if geral
?>