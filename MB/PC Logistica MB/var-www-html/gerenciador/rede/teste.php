<?php



include_once 'conexao.php';

#BUSCA A FUNCAO ASSOCIANDO O CA DO READER A ANTENA LIDA E BUSCA NO BANCO QUAL A FUNCAO CADASTRADA ******************************************
$tabela = 'rede_dez_xx';

$sql = $dbcon->query("SELECT * FROM $tabela ");

if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $ip = $dados['ip'];
  $nome = $dados['nome'];

  echo $ip;
  echo " - ";
  echo $nome;
  echo "</BR>";
 }
}


?>