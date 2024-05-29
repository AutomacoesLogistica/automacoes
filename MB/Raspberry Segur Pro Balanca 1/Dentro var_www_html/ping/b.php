<?php
include_once 'conexao.php';
$sq1 = $dbcon->query("SELECT * FROM dados WHERE ativo='SIM' AND id=96 LIMIT 1");
if(mysqli_num_rows($sq1)>0)
{
 $encontrado = 0;   
 while($dados = $sq1->fetch_array())
 {
  $encontrado = $encontrado+1;
  $host = $dados['ip'];
  $condicao_no_banco = $dados['condicao'];
  $site = $dados['valor_site'];
 
 // Testa se esta online
 $host = '192.168.10.96';
 exec("ping -n 3 -w 1 $host", $output, $status);
 
 $valor1 = $output[7];
 echo $valor1;
 $valor = explode(',', $valor1);
 $valor3 = $valor[2];
 $valor = explode('(', $valor3);
 $valor3 = $valor[1];
 $valor = explode('%', $valor3);
 $valor3 = $valor[0];
 
 echo"</BR>";
 echo "IP: ". $host . " - ";
 if (intval($valor3)<80)
 {
  echo"Online";
  $condicao = "Online";
 }
 else
 {
  echo"Offline";
  $condicao = "Offline";
 }
 echo"</BR>";
 }

 echo"</BR>";
 echo"</BR>";
 echo $encontrado;
}

?>