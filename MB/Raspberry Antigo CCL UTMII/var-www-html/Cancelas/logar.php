<?php
include_once 'conexao.php';
$registro = $_POST['registro'];
$senha = $_POST['senha'];

$sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro' AND senha='$senha'");

if(mysqli_num_rows($sql)>0){
echo "login_ok,";

while($dados = $sql->fetch_array()){
echo $dados['nome'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
echo ",";
echo $dados['registro'];
echo ",";
echo $dados['area'];
}
}else{
echo "login_erro";
}
?>