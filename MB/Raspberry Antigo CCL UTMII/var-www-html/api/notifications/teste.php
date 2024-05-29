<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

//Atualizo o resumo do rom
$local = "Saida Alternativa";
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');

if($local == "Entrada do ROM")
{
 //Agora atualizo no sistema
 //Busco o valor
 $aut_entrada = 0;
 $t_entrada = 0;
 include_once 'conexao_rom.php';
 $sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $aut_entrada = intval($dados['aut_entrada'])+1;
  $t_entrada = intval($dados['t_entrada'])+1;
 }  
 echo $aut_entrada;
 include_once 'conexao_rom.php';
 $sql = $dbcon->query("UPDATE resumo_rom SET aut_entrada='$aut_entrada',t_entrada='$t_entrada' WHERE data='$data'");
}
else if($local == "Saida ROM")
{
//Agora atualizo no sistema
 //Busco o valor
 $aut_saida = 0;
 $t_saida = 0;
 include_once 'conexao_rom.php';
 $sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $aut_saida = intval($dados['aut_saida'])+1;
  $t_saida = intval($dados['t_saida'])+1;
 }  
 echo $aut_saida;
 include_once 'conexao_rom.php';
 $sql = $dbcon->query("UPDATE resumo_rom SET aut_saida='$aut_saida',t_saida='$t_saida' WHERE data='$data'");
}
else if($local == "Saida Alternativa")
{
//Agora atualizo no sistema
 //Busco o valor
 $aut_saida_alt = 0;
 $t_saida_alt = 0;
 include_once 'conexao_rom.php';
 $sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $aut_saida_alt = intval($dados['aut_saida_alt'])+1;
  $t_saida_alt = intval($dados['t_saida_alt'])+1;
 }  
 echo $aut_saida_alt;
 include_once 'conexao_rom.php';
 $sql = $dbcon->query("UPDATE resumo_rom SET aut_saida_alt='$aut_saida_alt',t_saida_alt='$t_saida_alt' WHERE data='$data'");
}
?>
</body>
</html>