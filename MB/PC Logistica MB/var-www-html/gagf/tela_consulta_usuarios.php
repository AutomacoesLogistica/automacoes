<?php
$encontrado = 0;
$ultimo_encontrado = 0;
$array_nome = array();
$array_perfil = array();
$array_situacao = array();

include_once 'conexao_radius.php';

$sql = $dbcon->query("SELECT * FROM radreply ORDER BY username ASC");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {   
  $id = $dados['id'];
  $nome = $dados['username'];
  $perfil = $dados['value'];
  $situacao = $dados['situacao'];

  //Agora salvo dentro dos arrays
  $array_id[$encontrado] = $id;
  $array_nome[$encontrado] = $nome;
  $array_perfil[$encontrado] = $perfil;
  $array_situacao[$encontrado] = $situacao;
  
  $encontrado = intval($encontrado)+1;
  $ultimo_encontrado = $encontrado; 
 }
}


//echo $encontrado;

if($encontrado == 0)
{
 // Sem dados
 $mensagem_json = "-99;vazio";
 echo json_encode($mensagem_json);
}
else
{
 //Encontrou equipamentos
 //Faço o for relacionado a quantidade encontrada
 for ($x = 0; $x < $encontrado; $x++) 
 {
   if($x == 0)
   {
    $mensagem_json = $encontrado . ';' . $array_id[$x] . ',' . $array_nome[$x] . ',' . $array_perfil[$x]. ',' . $array_situacao[$x] . ';'  ;
   }
   else
   {
    if( $x>0 && $x != ( $ultimo_encontrado -1 ))
    {
      $mensagem_json = $mensagem_json . $array_id[$x] . ',' . $array_nome[$x] . ',' . $array_perfil[$x]. ',' . $array_situacao[$x] . ';' ;
    }
    else if($x == ($ultimo_encontrado-1) )
    {
        $mensagem_json = $mensagem_json . $array_id[$x] . ',' . $array_nome[$x] . ',' . $array_perfil[$x]. ',' . $array_situacao[$x];  
    }
   }
 }

 echo json_encode($mensagem_json);
}
 ?>
