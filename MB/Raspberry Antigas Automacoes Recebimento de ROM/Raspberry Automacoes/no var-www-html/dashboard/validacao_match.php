<?php

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM historico_match WHERE tratado='nao' LIMIT 1");
$encontrado = 0;
$placa_cavalo = '';
$placa_carreta = '';
$rodar = isset($_GET['rodar'])?$_GET['rodar']:"rodar"; // Para evitar erros!


if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $id = $dados['id'];
  $epc_cavalo = $dados['epc_cavalo'];
  $epc_carreta = $dados['epc_carreta'];
  $encontrado = $encontrado+1;
 }


}
 

 // Agora conecto no banco de placas e pelas tags consulto qual sao as placas
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc_cavalo' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $placa_cavalo = $dados['placa'];
 }
}


include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc_carreta' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $placa_carreta = $dados['placa'];
 }
}


print ("Resposta ****************************************");
print("</BR>");
print("ID encontrado: ");print($id);
print("</BR>");
print("Dados do Cavalo: EPC = ");print($epc_cavalo);print( " - Placa = ");print($placa_cavalo);
print("</BR>");
print("Dados do Carreta: EPC = ");print($epc_carreta);print( " - Placa = ");print($placa_carreta);
print("</BR>");
print("</BR>");
print("Finalizou");

//Salva quem realizou o acionamento e qual deles! 
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');


// Agora atualiza o status de tratado e insere as placas 
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE historico_match SET placa_cavalo='$placa_cavalo',placa_carreta='$placa_carreta',tratado='sim',data_atualizacao='$data',hora_atualizacao = '$hora' WHERE id='$id'");



echo"</BR>";









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



<script>
//Passa para tratar
  $.ajax({
           url: 'verifica_tempo.php',
           type: 'GET',
           dataType: 'json',
           data: {'msg': msg},
           success: function(resultado)
           {
             // alert( 'Removidos' + resultado);
           }
        });
  
</script>
<?php




?>
