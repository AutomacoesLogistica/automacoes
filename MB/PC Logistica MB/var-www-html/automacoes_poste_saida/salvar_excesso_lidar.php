<?php


$epc_lidar = isset($_GET['epc_lidar'])?$_GET['epc_lidar']:'vazio';
$id_lidar = isset($_GET['id_lidar'])?$_GET['id_lidar']:'vazio';
$id_cheio_vazio = isset($_GET['id_cheio_vazio'])?$_GET['id_cheio_vazio']:'vazio';
$id_historico = isset($_GET['id_historico'])?$_GET['id_historico']:'vazio';
$alerta2 = isset($_GET['alerta2'])?$_GET['alerta2']:'vazio';
$veiculo = isset($_GET['veiculo'])?$_GET['veiculo']:'vazio';


echo $epc_lidar;
echo '</BR>';
$placa = '';
if($epc_lidar != 'vazio' )
{
 if(strlen($epc_lidar)==24)
 {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $v_data = $nome_reduzido = explode("/",$data);
    $dia = $v_data[0];
    $mes = $v_data[1];
    $ano = $v_data[2];    
    $hora = date('H:i:s');
    
    echo $data;echo'</BR>';
    echo $dia;echo'</BR>';
    echo $mes;echo'</BR>';
    echo $ano;echo'</BR>';
    echo $hora;echo'</BR>';
    
    //Agora limpa na tabela
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE display_balanca1 SET epc_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_carreta='-',api_cheio_vazio='-',api_lidar='-',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',veiculo='-' WHERE id='1'");

    include_once 'conexao_excesso.php';
    $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,data_tratado,hora_tratado,confirmacao,tempo_confirmacao)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_lidar','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$alerta2','','','nao','0')");
    
    echo 'ok';
    
 }
 else
 {
  echo'tag invalida';  
 }

}
else
{
 echo   'vazio';   
}
exit();
?>
