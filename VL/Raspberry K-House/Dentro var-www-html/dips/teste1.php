<?php
 $array_ttp = array();
 $array_id = array();
  // Conecto no banco e busco os valores
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM ttp_entrada_a_saida ORDER BY id DESC");
  if(mysqli_num_rows($sql)>0)
  {
   $encontrado = 0;

   while($dados = $sql->fetch_array())
   { 
    $ttp= $dados['ttp'];
    $id = $dados['id_historico'];
    $valor = 0;
    $valor = intval($ttp);
    if($valor > 100)
    {
     $valor = (rand(45,85));   
     $array_ttp[$encontrado] = $valor;
     $array_id[$encontrado] = $id;
     $encontrado = $encontrado + 1;
     if(intval($array_ttp[$encontrado]) >100)
     {
        $array_ttp[$encontrado] = '100';
     }
    }
   
   }
 }




 
$tamanho_array_ttp = count($array_ttp);
 for($i=0;$i<$tamanho_array_ttp;$i++)
 {
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("UPDATE ttp_entrada_a_saida SET ttp='$array_ttp[$i]' WHERE id_historico='$array_id[$i]'");
    
 echo $array_ttp[$i];
 echo ' - ';
 echo $array_id[$i];
 echo '</BR>';
 }

?>