
<?php

$tag = isset($_GET['tag'])?$_GET['tag']:"vazio";


if($tag !='vazio')
{
 $epcs = array();
 include_once 'conexao_dashboard.php';
 $sql = $dbcon->query("SELECT * FROM validacoes_feitas ORDER BY id DESC LIMIT 5");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  { 
   $encontrado = intval($encontrado)+1;
   $v_epc = $dados['placa_ou_tag'];
   $epcs[$encontrado] = $v_epc;
  } 
 }
 
 if (in_array($tag, $epcs))
 { 
  echo "Tem a tag, nao pode salvar!";
 }
 else
 {
  echo ' Nao tem a tag, pode salvar!';  
 }   
    
    












}
else
{
 echo "Falta dados!" ;  
}
?>