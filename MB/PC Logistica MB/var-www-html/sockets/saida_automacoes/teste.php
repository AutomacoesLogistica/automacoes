
<?php

include_once 'conexao_dashboard.php';
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$v_hora = explode(':',$hora);
$v_hora = intval($v_hora[0]);
$ano = explode('/',$data);
$ano = $ano[2];
$tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
{
  $v_turno = 'v_turno1';  
}
else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
{
  $v_turno = 'v_turno2';  
}
else
{
  $v_turno = 'v_turno3';      
}

include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
{
 $dados = $sql->fetch_array(); 
 $id = $dados['id'];
 $v_turno1 = $dados['v_turno1'];
 $v_turno2 = $dados['v_turno2'];
 $v_turno3 = $dados['v_turno3'];

}
if($v_turno == 'v_turno1')
{
 $v_turno1 = intval($v_turno1)+1;
 $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
        
}
else if ($v_turno == 'v_turno2')
{
 $v_turno2 = intval($v_turno2)+1;
 $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
    
}
else
{
 $v_turno3 = intval($v_turno3)+1;
 $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
}
?>