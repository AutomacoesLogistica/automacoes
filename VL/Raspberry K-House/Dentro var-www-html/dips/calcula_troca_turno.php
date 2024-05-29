<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcula JOB</title>
</head>
<body>
    
<?php

$turno_anterior = 0;
$turno_agora = 0;
$trocou_turno = 0;
$valor_troca_turno1 = 0;
$valor_troca_turno2 = 0;
$valor_troca_turno3 = 0;
//TURNO 1 ******************************************
$id_troca1 = '';
$id_anterior_troca1 = '';
$data1_atual = '';
$hora1_atual = '';
$data1_anterior = '';
$hora1_aanterior = '';

//TURNO 2 ******************************************
$id_troca2 = '';
$id_anterior_troca2 = '';
$data2_atual = '';
$hora2_atual = '';
$data2_anterior = '';
$hora2_aanterior = '';

//TURNO 3 ******************************************
$id_troca3 = '';
$id_anterior_troca3 = '';
$data3_atual = '';
$hora3_atual = '';
$data3_anterior = '';
$hora3_aanterior = '';



$encontrado = 0;

$v_data = isset($_GET['data'])?$_GET['data']:'vazio';

if($v_data == 'vazio')
{
 date_default_timezone_set('America/Sao_Paulo');
 $hoje = date('d/m/Y');
 $hora = date('H:i:s');
 $v_data = $hoje;
}

include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM historico WHERE ( data_leitura1 = '$v_data' AND (ponto2 = 'Controle 1' OR ponto2 = 'Controle 2' OR ponto2 = 'Controle 3' )) ORDER BY data_leitura1 ASC");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrado = intval($encontrado)+1;  
  $turno_banco = $dados['turno']; // busco o valor do turno no banco
  $id = $dados['id'];
  $data_banco = $dados['data_leitura2'];
  $hora_banco = $dados['hora_leitura2'];


  if(intval($encontrado) == 1) // Primeiro que encontrou
  {
    $turno_anterior = $turno_banco;
    $turno_agora = $turno_banco;
    
  }
  else // Ja encontrou dois ou mais
  {
   //Agora trato as trocas
   if($turno_banco != $turno_anterior)
   {
    echo  'entrou';
    echo'</BR>';
    //Trato qual a vez que trocou o turno
    if(intval($trocou_turno)==0)
    {
     //Troca de turno de 00 para 08
     $id_troca1 = $id;
     $turno_anterior = $turno_banco;
     $data1_atual = $data_banco;
     $hora1_atual = $hora_banco;
    }
    else if(intval($trocou_turno)==1)
    {
     //Troca de turno de 08 para 16
     $turno_anterior = $turno_banco;
     $id_troca2 = $id;
     $data2_atual = $data_banco;
     $hora2_atual = $hora_banco;
    }
    else if(intval($trocou_turno)==2)
    {
     // Troca de turno de 16 para 0
     $turno_anterior = $turno_banco;
     $id_troca3 = $id;
     $data3_atual = $data_banco;
     $hora3_atual = $hora_banco;
    }

    $trocou_turno = intval($trocou_turno)+1;
   }
   else
   {
    //Pego os ultimos valores de id pesquisados para pode fazer conta depois
    if(intval($trocou_turno)==0)
    {
     $id_anterior_troca1 = $id;
     $data1_anterior = $data_banco;
     $hora1_aanterior = $hora_banco;
    }
    else if(intval($trocou_turno)==1)
    {
     $id_anterior_troca2 = $id;
     $data2_anterior = $data_banco;
     $hora2_aanterior = $hora_banco;
    }
    else if(intval($trocou_turno)==2)
    {
     $id_anterior_troca3 = $id;
     $data3_anterior = $data_banco;
     $hora3_aanterior = $hora_banco;
    }

   }



  }
 } // fecha o while


} // fecha o if

echo   'Encontrados = '. $encontrado;
echo '</BR>';echo '</BR>';
echo   'Troca 1 = ';
echo '</BR>';
echo 'ID Anterior: '. $id_anterior_troca1 . ' - ID da Troca: ' . $id_troca1;
echo '</BR>';
echo 'Hora Anterior: ' . $data1_anterior . ' ' . $hora1_aanterior . ' - ' . 'Hora Atual: ' . $data1_atual . ' ' . $hora1_atual; 

echo '</BR>';echo '</BR>';

echo   'Troca 2 = ';
echo '</BR>';
echo 'ID Anterior: '. $id_anterior_troca2 . ' - ID da Troca: ' . $id_troca2;
echo '</BR>';
echo 'Hora Anterior: ' . $data2_anterior . ' ' . $hora2_aanterior . ' - ' . 'Hora Atual: ' . $data2_atual . ' ' . $hora2_atual; 

echo '</BR>';echo '</BR>';

echo   'Troca 3 = ';
echo '</BR>';
echo 'ID Anterior: '. $id_anterior_troca3 . ' - ID da Troca: ' . $id_troca3;
echo '</BR>';
echo 'Hora Anterior: ' . $data3_anterior . ' ' . $hora3_aanterior . ' - ' . 'Hora Atual: ' . $data3_atual . ' ' . $hora3_atual; 


?>



</body>
</html>