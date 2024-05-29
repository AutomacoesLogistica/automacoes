<?php
$nome = '';
$sigla = '';
//Salva quem realizou o acionamento e qual deles! 
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

 //Verifico se foi uma tag RLR para entrada do tipo cavalo
 include_once 'conexao_dashboard.php';
 $sql = $dbcon->query("SELECT * FROM historico_leituras WHERE (tipo = 'cavalo' AND ( antena='1' OR antena='0') ) ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $epc = $dados['epc'];
 }
 
//Agora busco a placa e confiro se é RLR
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $placa_cavalo = $dados['placa'];
 $nome = $dados['nome'];
}






// Agora atualiza o status de tratado e insere as placas 
//Trato se for RLR ja finalizo pois eles tem apenas tag de parabrisa
if($nome == "RLR TRANSPORTES LTDA")
{
 include_once 'conexao_dashboard.php';
 $sql = $dbcon->query("UPDATE historico_match SET placa_cavalo='$placa_cavalo',placa_carreta='--',tratado='sim',data_atualizacao='$data',hora_atualizacao = '$hora' WHERE id='$id'");
 echo 'Entrou';

 //Agora com a placa da carreta eu busco a sigla que corresponde a transportadora
 mysqli_close();  
 $sigla = "RLR - Placa CAVALO!";
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET sigla='$sigla',placa='$placa_cavalo' WHERE id='1'");
 mysqli_close();  
}






/*
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("INSERT INTO dashboard SET epc_cavalo='$epc_cavalo', epc_carreta ='$epc_carreta', placa_cavalo='$placa_cavalo',placa_carreta='$placa_carreta',tipo='Entrada',ponto='Entrada CO',data_leitura='$data',hora_leitura='$hora'");
  









// Agora insiro no historico geral
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

$turno1 = '';
$turno2 = '';
$turno3 = '';
$turno_atual = '';
//Busco o turno atual
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$data'");
if(mysqli_num_rows($sql)>0)
{
while($dados = $sql->fetch_array())
{ 
 $turno1 = $dados['turno1'];
 $turno2 = $dados['turno2'];
 $turno3 = $dados['turno3'];
}
}

$valor_hora = explode(':',$hora);
$valor_hora = $valor_hora[0];
if(intval($valor_hora)>=0 && intval($valor_hora)<8)
{
  //Turno 1
  $turno_atual = $turno1;  
}
else if(intval($valor_hora)>=8 && intval($valor_hora)<17)
{
  //Turno 2
  $turno_atual = $turno2;  
}
else if(intval($valor_hora)>=17 && intval($valor_hora)<23)
{
  //Turno 3
  $turno_atual = $turno3;  
}
else{
    //erro
    $turno_atual = '-';
}

include_once 'conexao_dashboard.php';
$sql = $dbcon->query("INSERT INTO historico SET 
epc_cavalo='$epc_cavalo',
epc_carreta ='$epc_carreta',
placa_cavalo='$placa_cavalo',
placa_carreta='$placa_carreta',
turno='$turno_atual',
v_status='Entrando Mina',
encerrado_por='-',
valor_ponto='1',
ponto1='Entrada CO',
data_leitura1='$data',
hora_leitura1='$hora',
ponto2='',
data_leitura2='',
hora_leitura2='',
ponto3='',
data_leitura3='',
hora_leitura3='',
ponto4='',
data_leitura4='',
hora_leitura4='',
ponto5='',
data_leitura5='',
hora_leitura5='',
ponto6='',
data_leitura6='',
hora_leitura6='',
ponto7='',
data_leitura7='',
hora_leitura7='',
ponto8='',
data_leitura8='',
hora_leitura8='',
ponto9='',
data_leitura9='',
hora_leitura9='',
ponto10='',
data_leitura10='',
hora_leitura10='',
ponto11='',
data_leitura11='',
hora_leitura11='',
ponto12='',
data_leitura12='',
hora_leitura12='',
ponto13='',
data_leitura13='',
hora_leitura13='',
ponto14='',
data_leitura14='',
hora_leitura14='',
ponto15='',
data_leitura15='',
hora_leitura15=''
");




*/






?>
