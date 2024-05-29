<?php
include_once 'conexao_display_mb.php';
$balanca = isset($_GET['balanca'])?$_GET['balanca']:"0";
$mensagem1 = isset($_GET['mensagem1'])?$_GET['mensagem1']:"                    ";// Deixar 20 espacos
$mensagem2 = isset($_GET['mensagem2'])?$_GET['mensagem2']:"                    ";// Deixar 20 espacos
$peso = isset($_GET['peso'])?$_GET['peso']:"      ";// Deixar 6 espacos
$semaforo_entrada = isset($_GET['semaforo_entrada'])?$_GET['semaforo_entrada']:"nao_definido"; 
$semaforo_saida = isset($_GET['semaforo_saida'])?$_GET['semaforo_saida']:"nao_definido"; 
$tabela = "balanca_".$balanca;



if (strlen($mensagem1)==20 && strlen($mensagem2)==20 && strlen($peso)==6 )
{
echo "entrou";
    $sql = $aux_conexao_display->query("UPDATE $tabela SET mensagem1='$mensagem1',mensagem2 ='$mensagem2',peso='$peso',semaforo_entrada='$semaforo_entrada',semaforo_saida='$semaforo_saida' WHERE id='1'");
}
?>
