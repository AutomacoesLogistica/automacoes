<?php
include_once 'conexao_dashboard.php';
$i = 0;
$array_placa_cavalo_3mais = array();
$array_placa_carreta_3mais = array();

$array_placa_cavalo_3mais[$i] ='RGC7B23' ;

$array_placa_carreta_3mais[$i] ='PRU5945' ;



echo 'Placa cavalo = ' . $array_placa_cavalo_3mais[$i];

echo '</BR>';

echo 'Placa carreta = ' . $array_placa_carreta_3mais[$i];

echo '</BR>';
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM historico WHERE ( placa_cavalo = '$array_placa_cavalo_3mais[$i]' AND placa_carreta='$array_placa_carreta_3mais[$i]' AND v_status !='Saiu da Planta') ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id_historico= $dados['id'];
 $valor_ponto_historico = $dados['valor_ponto'];
 $turno_historico = $dados['turno'];
 $v_data_leitura1 = $dados['data_leitura1'];
}

echo $id_historico;
echo '</br>';
echo $valor_ponto_historico;
echo '</br>';
echo $turno_historico;
echo '</br>';
echo $v_data_leitura1;



echo '</br>';


if($id_historico !='')
{
 echo '</br>';
 echo '</br>';
 echo 'Dados para update no historico ***************************************************';
 echo '</br>';
 echo '</br>';
 $valor_ponto_historico = intval($valor_ponto_historico)+1;
 $ponto = 'ponto'. $valor_ponto_historico; 
 $data_leitura = 'data_leitura'.$valor_ponto_historico;
 $hora_leitura = 'hora_leitura'.$valor_ponto_historico;
 $status_historico = 'Saiu da Planta';
 $encerrado_historico = 'JOB';
 
 echo 'Valor ponto : '. $valor_ponto_historico;
 echo '</br>';
 echo 'Data Leitura : ' . $data_leitura;
 echo '</br>';
 echo 'Hora Leitura : ' . $hora_leitura;
 echo '</br>';
 
 
 //Faço UPDATE no historico
 include_once 'conexao_dashboard.php';
 $sql = $dbcon->query("UPDATE historico SET v_status='$status_historico', encerrado_por='$encerrado_historico', valor_ponto = '$valor_ponto_historico', $ponto='Saida CO', $data_leitura='-', $hora_leitura='-' WHERE id='$id_historico'");


 //Faço UPDATE nas movimentacoes
 if($v_data_leitura1 !='-')
 {
  $mensagem = explode('/',$v_data_leitura1);
  $dia_movimentacoes = $mensagem[0];
  $mes_movimentacoes = $mensagem[1];
  $ano_movimentacoes = $mensagem[2];
  echo'</BR>';
  echo 'Dados consulta ***********************';
  echo'</BR>';
  echo 'Dia : ' . $dia_movimentacoes;
  echo'</BR>';
  echo 'Mes : ' . $mes_movimentacoes;
  echo'</BR>';
  echo 'Ano : ' . $ano_movimentacoes;
  echo'</BR>';
  $dia = 'v_'. intval($dia_movimentacoes);
  echo 'Dia consulta : '. $dia;
  echo'</BR>';
  //Agora atualizo movimentações
  //Primeiro pego o valor que esta
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM movimentacoes_2022 WHERE mes='$mes_movimentacoes' ORDER BY id ASC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   echo 'entrou';
   $dados = $sql->fetch_array();
   $quantidade = $dados['quantidade'];
   $quantidade_v_dia = $dados[$dia];
  }
  $quantidade = intval($quantidade) + 1;
  $quantidade_v_dia = intval($quantidade_v_dia) + 1;
  echo'</BR>';
  echo'</BR>';
  echo 'Movimentacoes **********************************************************************';
  echo '</BR>';
  echo '</BR>';
  echo 'Quantidade : '.$quantidade;
  echo '</BR>';
  echo 'Quantidade dia : '. $quantidade_v_dia;
  echo '</BR>';
  //Agora atualizo as movimentacoes
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("UPDATE movimentacoes_2022 SET $dia='$quantidade_v_dia', quantidade='$quantidade' WHERE mes='$mes_movimentacoes'");
  //Agora atualizo lista_turno_dashboard
  $sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$v_data_leitura1' ORDER BY id ASC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $turno1 = $dados['turno1'];
   $turno2 = $dados['turno2'];
   $turno3 = $dados['turno3'];
   $v_turno1 = $dados['v_turno1'];
   $v_turno2 = $dados['v_turno2'];
   $v_turno3 = $dados['v_turno3'];
   if ($turno1 == $turno_historico)
   {
    $v_turno1 = intval($v_turno1) + 1;
   }
   else if ($turno2 == $turno_historico)
   {
    $v_turno2 = intval($v_turno2) + 1;
   }
   else if ($turno3 == $turno_historico)
   {
    $v_turno3 = intval($v_turno3) + 1;
   }
   include_once 'conexao_dashboard.php';
   $sql = $dbcon->query("UPDATE lista_turno_dashboard SET v_turno1='$v_turno1', v_turno2='$v_turno2', v_turno3='$v_turno3' WHERE data='$v_data_leitura1'");
  }
 } // Fecha if($v_data_leitura1 !='-')
} // Fecha if($id_historico !='')
else
{
    echo 'Nao existem dados!';
}







?>