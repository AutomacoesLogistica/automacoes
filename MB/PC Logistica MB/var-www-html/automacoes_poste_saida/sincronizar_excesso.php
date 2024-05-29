<?php
$id = isset($_GET['id'])?$_GET['id']:'vazio';

if($id != 'vazio')
{
 include_once 'conexao.php';   
 $sql = $dbcon->query("SELECT * FROM lidar_excesso WHERE id='$id'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array(); 
  $id_lidar = $dados['id_lidar'];
  $id_cheio_vazio = $dados['id_cheio_vazio'];
  $id_historico = $dados['id_historico'];
  $epc_lidar = $dados['epc_lidar'];
  $placa = $dados['placa'];
  $veiculo = $dados['veiculo'];
  $data_leitura = $dados['data_leitura'];
  $dia = $dados['dia'];
  $mes = $dados['mes'];
  $ano = $dados['ano'];
  $hora_leitura = $dados['hora_leitura'];
  $condicao = $dados['condicao'];
  $motorista = $dados['motorista'];
  $telefone = $dados['telefone'];
  $transportadora = $dados['transportadora'];
  $destino = $dados['destino'];
  $motivo = $dados['motivo'];  
 }
 echo $motivo;
 //Agora atualizo o dado desse evento como foi tratado
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 include_once 'conexao.php'; 
 $sql = $dbcon->query("UPDATE lidar_excesso SET sincronizado='sim' WHERE id='$id'");

 //Agora atualizo os dados
 
 //Atualizo no banco do excesso
 include_once 'conexao_excesso.php';   
 $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,placa_cavalo,veiculo,nome,telefone,transportadora,destino,data_leitura,dia,mes,ano,hora_leitura,condicao,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_lidar','$placa','-','$veiculo','$motorista','$telefone','$transportadora','$destino','$data','$dia','$mes','$ano','$hora','$condicao','nao','','','nao','0','$motivo')");



}
else
{
 echo 'Favor informar o id!';   
}























?>