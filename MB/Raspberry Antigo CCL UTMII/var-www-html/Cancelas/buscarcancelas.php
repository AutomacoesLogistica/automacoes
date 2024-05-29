<?php
include_once 'conexao.php';
$id = $_POST['id'];
$local = $_POST['local'];
$cancela = $_POST['cancela'];

if($id == 'nomes'){
$sql = $dbcon->query("SELECT * FROM id_cancelas WHERE local_instalacao = '$local'");
}else{
$sql = $dbcon->query("SELECT * FROM id_cancelas WHERE local_instalacao = '$local' AND nomecancela = '$cancela'");
}
if(mysqli_num_rows($sql)>0){


if($id == 'nomes'){
echo "nome_cancelas_ok,";
echo mysqli_num_rows($sql); #Informa o numero de dados encontrados
echo ",";
while($dados = $sql->fetch_array()){
echo $dados['nomecancela'];# Busca o nome das cancelas encontradas
echo ",";
}
}elseif($id == 'codigos'){
echo "codigo_cancelas_ok,";
echo mysqli_num_rows($sql); #Informa o numero de dados encontrados
echo ",";
while($dados = $sql->fetch_array()){
echo $dados['codigo'];# Busca os codigos das cancelas
echo ",";
}
}else{
echo "cancelas_erro";
}


}else{
echo "cancelas_erro";
}
?>