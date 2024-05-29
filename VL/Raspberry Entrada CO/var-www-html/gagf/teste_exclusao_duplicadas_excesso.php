<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Modelo PHP</title>
</head>
<body>


<?php


// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
// CODIGO PARA EXCLUIR LINHAS DUPLICADAS *********************************************************************
$a_id = "";
$a_epc = "";
$a_placa = "";
$a_data = "";
$a_hora = "";
$u_epc = "";
$u_placa = "";
$u_data = "";
$u_hora = "";

include "conexao.php";
$sql = $dbcon->query("SELECT * FROM lista_excesso_mb ORDER BY id DESC");
if(mysqli_num_rows($sql)>0)
{
    $encontrado =0;
  while($dados = $sql->fetch_array())
  {
      if ($encontrado <=5 && $encontrado >0 )
      {
        $u_epc = $a_epc;
        $u_placa = $a_placa;
        $u_data = $a_data;
        $u_hora = $a_hora;
                
        $a_id = $dados['id'];
        $a_epc = $dados['epc'];
        $a_placa = $dados['placa'];
        $a_data = $dados['data'];
        $a_hora = $dados['hora'];
        
        if($u_epc == $a_epc && $u_placa == $a_placa && $u_data == $a_data && $u_hora == $a_hora)
        {
         //echo "igual";echo"</br>";
         $sq2 = $dbcon->query("DELETE FROM lista_excesso_mb WHERE id='$a_id'");
        }
        else
        {
         //echo "diferente";echo"</br>";  
        }
      }
      if ($encontrado == 0)
      {
        $a_id = $dados['id'];
        $a_epc = $dados['epc'];
        $a_placa = $dados['placa'];
        $a_data = $dados['data'];
        $a_hora = $dados['hora'];   
      }
      $encontrado++;      
  } 
}

// ***********************************************************************************************************



?>


</body>




<style>
body{
    background-color: #87CEEB;
}
</style>









</html>