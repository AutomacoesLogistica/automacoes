<?php
include_once 'conexao.php';
$id = $_POST['id'];

$sql = $dbcon->query("SELECT * FROM sitios WHERE id != 'NULL'"); # busca tudo que for diferente de vazio

if(mysqli_num_rows($sql)>0){


if($id == 'nomesitios'){
echo "sitios_ok,";
echo mysqli_num_rows($sql); #Informa o numero de dados encontrados
echo ",";
while($dados = $sql->fetch_array()){
echo $dados['nomesitios'];# Busca os sitios
echo ",";
}
}else{
echo "sitios_erro";
}
}
?>