<?php

// Nome do Arquivo do Excel que será gerado
$arquivo = 'email.xls';

$tabela ='<table_border="1">';
$tabela .= '<tr>';
$tabela .= '<td colspan="2">Tabela de E-mails</td>';
$tabela .= '</tr>';
$tabela .= '<tr>';
$tabela .= '<td><b>Estado</b></td>';
$tabela .= '<td><b>Localidade</b></td>';
$tabela .= '</tr>';

// Criamos uma tabela HTML com o formato da planilha para excel
include 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_estados");
if(mysqli_num_rows($sql)>0)
{
 $encontrado =0;
 while($dados = $sql->fetch_array())
 {
  $encontrado++;   
  $estado = $dados['estado'];
  $localidade = $dados['localidade'];
  $tabela .= '<tr>';
  $tabela .= '<td>'.$estado.'</td>';
  $tabela .= '<td>'.$localidade.'</td>';
  $tabela .= '</tr>';
} // Fecha While
}// Fecha o if 
$tabela .= '</table>';

header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;

//for($i=1;$i<=$encontrado;$i++){  
//    echo $html[$i];
//    echo'</BR>';
//}
