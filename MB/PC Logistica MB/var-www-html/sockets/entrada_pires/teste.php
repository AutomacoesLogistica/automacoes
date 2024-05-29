<?php
$epc = '442002000000000000001628';

//Antes de salvar, verifico se ja não é igual a ultima inserida!
include_once 'conexao.php';
$lista_epc = [];
$sql = $dbcon->query("SELECT * FROM validacoes_socket ORDER BY id DESC LIMIT 10");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  $v_epc = trim($dados['epc_carreta']);
  array_push($lista_epc,$v_epc);
 }
}  
//var_dump($lista_epc);

//Agora verifico se tem a tag a inserir no array
if (in_array($epc,$lista_epc)) 
{
    echo "Tem a tag ja na lista!" ;
}
else
{
   echo "Nao tem a tag na lista, pode inserir!";  
}

?>