<?php
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='0',semaforo_saida='1',mensagem1='___________________',mensagem2='___________________',mensagem_aux='_______',epc_carreta='-',ultima_epc_carreta='-',ponto='-',api_cheio_vazio='-',api_lidar='-',ultima_api_lidar='-',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_lidar='-',veiculo='-',condicao_veiculo='-',id_historico='-',epc_cavalo='-',placa_cavalo='-',opcao='-' WHERE id='1'");

sleep(3);
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='0',semaforo_saida='1',mensagem1='Aguardando veiculo!',mensagem2='___________________',mensagem_aux='_______',epc_carreta='-',ultima_epc_carreta='-',ponto='-',api_cheio_vazio='-',api_lidar='-',ultima_api_lidar='-',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_lidar='-',veiculo='-',condicao_veiculo='-',id_historico='-',epc_cavalo='-',placa_cavalo='-',opcao='-',dlc='-',dtc='-' WHERE id='1'");

?>