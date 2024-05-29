<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Tela TTP 2</title>
</head>
<body>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_utmi.php?vezes=0'"/>

<?php
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
//atualizo dashboard
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE atualizacao SET data_atualizacao='$data',hora_atualizacao='$hora' WHERE ponto='Dashboard'");

date_default_timezone_set('America/Sao_Paulo');
$vv_hoje = date('d/m/Y');
$vv_hoje = explode('/',$vv_hoje);
$vv_hoje = $vv_hoje[0];
$v_data = isset($_GET['data'])?$_GET['data']:'vazio';






if($v_data == 'vazio')
{
 date_default_timezone_set('America/Sao_Paulo');
 $y_data = date('d/m/Y');
 $hora = date('H:i:s');
 $v_data = $y_data; // Caso nao passe, coloca a do momento da consulta!
}

$vdata = explode('/',$v_data);
$mes_a = $vdata[1];
$mes_s = $vdata[1];
$ano = $vdata[2];

$novo_dia_anterior = (intval($vdata[0])-1);
$novo_dia_superior = (intval($vdata[0])+1);




if(intval($novo_dia_anterior)<9)
{
  $novo_dia_anterior = '0'.$novo_dia_anterior;
}


if($novo_dia_anterior==00)
{
 //Volto um dia e um mes
 $novo_dia_anterior = 31; //Mesmo que o mes nao tenha, so voltar mais um dia
 $mes_a = intval($mes_a)-1;
 if(intval($mes_a)<9)
 {
  $mes_a = '0'.$mes_a; 
 }
}

if(intval($novo_dia_superior)==32)
{
 //Almento um dia e um mes
 $novo_dia_superior = 01; //Mesmo que o mes nao tenha, so voltar mais um dia
 $mes_s = intval($mes_s)+1;
 if(intval($mes_s)<9)
 {
  $mes_s = '0'.$mes_s; 
 }
}
if(intval($novo_dia_superior)<10)
{
 
    $novo_dia_superior = '0' . intval($novo_dia_superior);
  }



  ?>
  <script>
   console.log('Dia superior' + <?php print $novo_dia_superior ?>);
</script>
  <?php

$nova_data_consulta_anterior = $novo_dia_anterior.'/'.$mes_a.'/'.$ano;
$nova_data_consulta_superior = $novo_dia_superior.'/'.$mes_s.'/'.$ano;
?>
<script>console.log('<?php print $nova_data_consulta ?>');</script>


<script>
var media_entrada = 0;
var media_ca = 0;
var array_data_hora_entrada_a_saida = [];
var array_condicao_entrada_a_saida = [];
var array_condicao_entrada_a_saida_turno = [];
var array_data_hora_ca_a_saida = [];
var array_condicao_ca_a_saida = [];
var array_condicao_ca_a_saida_turno = [];
var encontrado_entrada_a_saida = 0;
var encontrado_ca_a_saida = 0;
var referencia_entrada = 0;
var referencia_ca = 0;

var total_encontrado_entrada_a_saida = 0;
var total_encontrado_ca_a_saida = 0;

for (var i = 0; i < 2000; i++) 
{
  array_data_hora_entrada_a_saida[i] = 0;  
  array_condicao_entrada_a_saida[i] = 0;
  array_condicao_entrada_a_saida_turno[i] = 0;
  array_data_hora_ca_a_saida[i] = 0;  
  array_condicao_ca_a_saida[i] = 0;
  array_condicao_ca_a_saida_turno[i] = 0;
}


</script>
<?php
$ttp_dia_entrada = 0;
$ttp_dia_ca = 0;

$vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
$nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
$tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
if($tempo == '-1'){$tempo = 30000;}
if($nvezes == '-1'){$nvezes = 5;}
if($vezes != '-1'){$vezes = intval($vezes)+1;}


if($vezes == -1)
{

}
else
{
 $vezes = intval($vezes)+1;   
}



$vdados = explode('/',$v_data);
$mes = $vdados[1];

?>
<script>console.log('<?php print $v_data ?>'); </script>
<?php

$v_turno1_entrada = 0;
$val_ttp_turno1_entrada = 0;
$v_turno2_entrada = 0;
$val_ttp_turno2_entrada = 0;
$v_turno3_entrada = 0;
$val_ttp_turno3_entrada = 0;
$v_turno1_ca = 0;
$val_ttp_turno1_ca = 0;
$v_turno2_ca = 0;
$val_ttp_turno2_ca = 0;
$v_turno3_ca = 0;
$val_ttp_turno3_ca = 0;

$encontrado_entrada_a_saidas = 0;
$encontrado_ca_a_saidas = 0;

$turno1_entrada = 'X';
$turno2_entrada = 'X';
$turno3_entrada = 'X';
$turno1_ca = 'X';
$turno2_ca = 'X';
$turno3_ca = 'X';

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_turno_dashboard_2024 WHERE data='$v_data'");
if(mysqli_num_rows($sql)>0)
{

 $dados = $sql->fetch_array();
 $turno1_entrada = $dados['turno1'];
 $turno1_ca = $dados['turno1'];
 $turno2_entrada = $dados['turno2'];
 $turno2_ca = $dados['turno2'];
 $turno3_entrada = $dados['turno3'];
 $turno3_ca = $dados['turno3'];
   
?>
<script>console.log('Turno 1 = <?php print $turno1_ca ?>'); </script>
<script>console.log('Turno 2 = <?php print $turno2_ca ?>'); </script>
<script>console.log('Turno 3 = <?php print $turno3_ca ?>'); </script>
<?php
}


include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM limites WHERE referencia='saidas'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $limite_entrada = $dados['limite_em_minutos'];
 ?>
 <script>console.log('Limite Entrada a saida= <?php print $limite_entrada ?>'); </script>
 <?php
}

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM limites WHERE referencia='controles'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $limite_ca = $dados['limite_em_minutos'];
 ?>
 <script>console.log('Limite CA a saida = <?php print $limite_ca ?>'); </script>
 <?php
}

?>
<script>

referencia_entrada = parseFloat('<?php print $limite_entrada ?>');
referencia_ca = parseFloat('<?php print $limite_ca ?>');

console.log(referencia_ca);    
</script>
<?php


include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM ttp_entrada_a_saida WHERE data_entrada ='$v_data' ORDER BY hora_saida DESC LIMIT 2000");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  
    $condicao = strval($dados['ttp']);
    $data_banco_entrada = $dados['data_entrada'];
    $data_hora = strval($dados['data_hora']);
    $turno = strval($dados['turno']);
    $id= $dados['id_historico'];
    if(strval($turno) == strval($turno1_entrada))
    {
     $v_turno1_entrada = intval($v_turno1_entrada) + 1;
     $val_ttp_turno1_entrada = floatval($val_ttp_turno1_entrada) + floatval($condicao);
    }
    else if (strval($turno) == strval($turno2_entrada))
    {
     $v_turno2_entrada = intval($v_turno2_entrada) + 1;
     $val_ttp_turno2_entrada = floatval($val_ttp_turno2_entrada) + floatval($condicao);
    }
    else if (strval($turno) == strval($turno3_entrada))
    {
      $v_turno3_entrada = intval($v_turno3_entrada) + 1;
      $val_ttp_turno3_entrada = floatval($val_ttp_turno3_entrada) + floatval($condicao);
    }
   
    if($v_data == $data_banco_entrada)
    {
    
    
    ?>
    <script>
     
    total_encontrado_entrada_a_saida = total_encontrado_entrada_a_saida + parseInt('<?php print $valor_condicao ?>');    
    encontrado_entrada_a_saida = '<?php print $encontrado_entrada_a_saidas ?>';
    condicao = '<?php print $condicao?>';
    data_hora = '<?php print $data_hora?>';
    turno = '<?php print $turno ?>';
  
    array_data_hora_entrada_a_saida[encontrado_entrada_a_saida] = data_hora;
    array_condicao_entrada_a_saida[encontrado_entrada_a_saida] = condicao;
    array_condicao_entrada_a_saida_turno[encontrado_entrada_a_saida] = turno;

    </script>
    <?php
    $encontrado_entrada_a_saidas = intval($encontrado_entrada_a_saidas) + 1;
  }   
  
 }
}


// Agora faço a media para os ttp dos turnos
if(intval($val_ttp_turno1_entrada)>0 && intval($v_turno1_entrada)>0)
{
  $val_ttp_turno1_entrada = number_format(($val_ttp_turno1_entrada/$v_turno1_entrada), 1, '.', '');
}
else
{
  $val_ttp_turno1_entrada = "0.0";
}

if(intval($val_ttp_turno2_entrada)>0 && intval($v_turno2_entrada)>0)
{
  $val_ttp_turno2_entrada = number_format(($val_ttp_turno2_entrada/$v_turno2_entrada), 1, '.', '');
}
else
{
  $val_ttp_turno2_entrada = "0.0";
}

if(intval($val_ttp_turno3_entrada)>0 && intval($v_turno3_entrada)>0)
{
  $val_ttp_turno3_entrada = number_format(($val_ttp_turno3_entrada/$v_turno3_entrada), 1, '.', '');
}
else
{
  $val_ttp_turno3_entrada = "0.0";
}

if($val_ttp_turno1_entrada >0 && $val_ttp_turno2_entrada >0 && $val_ttp_turno3_entrada > 0)
{
 $ttp_dia_entrada = number_format((($val_ttp_turno1_entrada+$val_ttp_turno2_entrada+$val_ttp_turno3_entrada)/3), 1, '.', '');
}
else if($val_ttp_turno1_entrada >0 && $val_ttp_turno2_entrada >0 && $val_ttp_turno3_entrada == 0)
{
 $ttp_dia_entrada = number_format((($val_ttp_turno1_entrada+$val_ttp_turno2_entrada+$val_ttp_turno3_entrada)/2), 1, '.', '');
}
else if($val_ttp_turno1_entrada >0 && $val_ttp_turno2_entrada == 0 && $val_ttp_turno3_entrada == 0)
{
 $ttp_dia_entrada = number_format((($val_ttp_turno1_entrada+$val_ttp_turno2_entrada+$val_ttp_turno3_entrada)/1), 1, '.', '');
}
else if($val_ttp_turno1_entrada <=0 && $val_ttp_turno2_entrada > 0 && $val_ttp_turno3_entrada == 0)
{
 $ttp_dia_entrada = number_format((($val_ttp_turno1_entrada+$val_ttp_turno2_entrada+$val_ttp_turno3_entrada)/1), 1, '.', '');
}
else if($val_ttp_turno1_entrada <=0 && $val_ttp_turno2_entrada > 0 && $val_ttp_turno3_entrada > 0)
{
 $ttp_dia_entrada = number_format((($val_ttp_turno1_entrada+$val_ttp_turno2_entrada+$val_ttp_turno3_entrada)/2), 1, '.', '');
}
else if($val_ttp_turno1_entrada <=0 && $val_ttp_turno2_entrada <=0 && $val_ttp_turno3_entrada > 0)
{
 $ttp_dia_entrada = number_format((($val_ttp_turno1_entrada+$val_ttp_turno2_entrada+$val_ttp_turno3_entrada)/1), 1, '.', '');
}



include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM ttp_ca_a_saida  WHERE data_ca ='$v_data'  ORDER BY hora_saida DESC LIMIT 2000");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $condicao = strval($dados['ttp']);
  $data_banco_ca = $dados['data_ca'];
  $data_hora = strval($dados['data_hora']);
  $turno = strval($dados['turno']);
  if(strval($turno) == strval($turno1_ca))
  {
   $v_turno1_ca = intval($v_turno1_ca) + 1;
   $val_ttp_turno1_ca = floatval($val_ttp_turno1_ca) + floatval($condicao);
  }
  else if (strval($turno) == strval($turno2_ca))
  {
   $v_turno2_ca = intval($v_turno2_ca) + 1;
   $val_ttp_turno2_ca = floatval($val_ttp_turno2_ca) + floatval($condicao);
  }
  else if (strval($turno) == strval($turno3_ca))
  {
    $v_turno3_ca = intval($v_turno3_ca) + 1;
   $val_ttp_turno3_ca = floatval($val_ttp_turno3_ca) + floatval($condicao);
  }


  if($v_data == $data_banco_ca)
  {
    ?>
    <script>
    total_encontrado_ca_a_saida = total_encontrado_ca_a_saida + parseInt('<?php print $valor_condicao ?>');    
    encontrado_ca_a_saida = '<?php print $encontrado_ca_a_saidas ?>';
    condicao = '<?php print $condicao?>';
    data_hora = '<?php print $data_hora?>';
    turno = '<?php print $turno ?>';

    array_data_hora_ca_a_saida[encontrado_ca_a_saida] = data_hora;
    array_condicao_ca_a_saida[encontrado_ca_a_saida] = condicao;
    array_condicao_ca_a_saida_turno[encontrado_ca_a_saida] = turno;
    </script>
    <?php
    $encontrado_ca_a_saidas = intval($encontrado_ca_a_saidas) + 1;
  }
 }
}


// Agora faço a media para os ttp dos turnos
if(intval($val_ttp_turno1_ca)>0 && intval($v_turno1_ca)>0)
{
  $val_ttp_turno1_ca = number_format(($val_ttp_turno1_ca/$v_turno1_ca), 1, '.', '');
}
else
{
  $val_ttp_turno1_ca = "0.0";
}

if(intval($val_ttp_turno2_ca)>0 && intval($v_turno2_ca)>0)
{
  $val_ttp_turno2_ca = number_format(($val_ttp_turno2_ca/$v_turno2_ca), 1, '.', '');
}
else
{
  $val_ttp_turno2_ca = "0.0";
}
 

if(intval($val_ttp_turno3_ca)>0 && intval($v_turno3_ca)>0)
{
  $val_ttp_turno3_ca = number_format(($val_ttp_turno3_ca/$v_turno3_ca), 1, '.', '');
}
else
{
  $val_ttp_turno3_ca = "0.0";
}

if(strval($val_ttp_turno1_ca) == 'nan')
 {
  $val_ttp_turno1_ca = 0;
 }
 if(strval($val_ttp_turno2_ca) == 'nan')
 {
  $val_ttp_turno2_ca = 0;
 }
 if(strval($val_ttp_turno3_ca) == 'nan')
 {
  $val_ttp_turno3_ca = 0;
 }


 if($val_ttp_turno1_ca >0 && $val_ttp_turno2_ca >0 && $val_ttp_turno3_ca > 0)
 {
  $ttp_dia_ca = number_format((($val_ttp_turno1_ca+$val_ttp_turno2_ca+$val_ttp_turno3_ca)/3), 1, '.', '');
 }
 else if($val_ttp_turno1_ca >0 && $val_ttp_turno2_ca >0 && $val_ttp_turno3_ca == 0)
 {
  $ttp_dia_ca = number_format((($val_ttp_turno1_ca+$val_ttp_turno2_ca+$val_ttp_turno3_ca)/2), 1, '.', '');
 }
 else if($val_ttp_turno1_ca >0 && $val_ttp_turno2_ca == 0 && $val_ttp_turno3_ca == 0)
 {
  $ttp_dia_ca = number_format((($val_ttp_turno1_ca+$val_ttp_turno2_ca+$val_ttp_turno3_ca)/1), 1, '.', '');
 }
 else if($val_ttp_turno1_ca <=0 && $val_ttp_turno2_ca > 0 && $val_ttp_turno3_ca == 0)
 {
  $ttp_dia_ca = number_format((($val_ttp_turno1_ca+$val_ttp_turno2_ca+$val_ttp_turno3_ca)/1), 1, '.', '');
 }
 else if($val_ttp_turno1_ca <=0 && $val_ttp_turno2_ca > 0 && $val_ttp_turno3_ca > 0)
 {
  $ttp_dia_ca = number_format((($val_ttp_turno1_ca+$val_ttp_turno2_ca+$val_ttp_turno3_ca)/2), 1, '.', '');
 }
 else if($val_ttp_turno1_ca <=0 && $val_ttp_turno2_ca <=0 && $val_ttp_turno3_ca > 0)
 {
  $ttp_dia_ca = number_format((($val_ttp_turno1_ca+$val_ttp_turno2_ca+$val_ttp_turno3_ca)/1), 1, '.', '');
 }
?>



<script>
console.log('TTP DIA CA =  '+ '<?php print $v_data ?>');
console.log('TTP dia entrada = ' + '<?php print $ttp_dia_entrada ?>');
</script>

<?php
//Agora atualizo os dados dentro do banco
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE lista_turno_dashboard_2024 SET ttp_dia='$ttp_dia_ca',ttp_dia_entrada='$ttp_dia_entrada',ttp_turno1='$val_ttp_turno1_ca',ttp_turno2='$val_ttp_turno2_ca',ttp_turno3='$val_ttp_turno3_ca' WHERE data='$v_data'");  


?>


<script type="text/javascript" src="./javascript/javascript_loader.js"></script>
<script type="text/javascript">

var encontrado_entrada_a_saida = <?php print $encontrado_entrada_a_saidas ?>;
var valor_turno1 = '<?php print $turno1_entrada ?>';
var valor_turno2 = '<?php print $turno2_entrada ?>';
var valor_turno3 = '<?php print $turno3_entrada ?>';


if(parseInt(encontrado_entrada_a_saida)>0)
{
 //alert('Existem dados!');
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);
 //alert(total_encontrado_entrada_a_saida);
 function drawChart() 
 {
  var dataRows = [['Date Hora', 'Turno1','Turno2', 'Turno3', 'Referencia']];
  var x = 0;
  //console.log('Rodando');
  for (var i = 1; i < encontrado_entrada_a_saida ; i++) 
  {
    hora =  array_data_hora_entrada_a_saida[x].split(" "); 
   x = parseInt(encontrado_entrada_a_saida)-i;  
   //console.log(valor_turno1);
   if(valor_turno1 == array_condicao_entrada_a_saida_turno[x]) 
   {
    dataRows.push([ hora[1],parseFloat(array_condicao_entrada_a_saida[x]),0,0, referencia_entrada]);
   }
   else if (valor_turno2 == array_condicao_entrada_a_saida_turno[x]) 
   {
    dataRows.push([ hora[1],0,parseFloat(array_condicao_entrada_a_saida[x]),0, referencia_entrada]);
   }
   else
   {
    dataRows.push([ hora[1],0,0,parseFloat(array_condicao_entrada_a_saida[x]), referencia_entrada]);
   }
    // console.log(x+' - ' + i + ' Valor array :' + array_data_hora_entrada_a_saida[x]+ ' : ' + array_condicao_entrada_a_saida[x]);
    media_entrada = media_entrada + parseFloat(array_condicao_entrada_a_saida[x]);
  

  }
  media_entrada = media_entrada/ encontrado_entrada_a_saida;
  console.log(media_entrada.toFixed(1));
  var link_ttp_dia_entrada = document.getElementById('ttp_dia_entrada');
  var link_ttp_turno1_entrada = document.getElementById('ttp_turno1_entrada');
  var link_ttp_turno2_entrada = document.getElementById('ttp_turno2_entrada');
  var link_ttp_turno3_entrada = document.getElementById('ttp_turno3_entrada');
  
 var valor_ttp_turno1_entrada = '<?php print $val_ttp_turno1_entrada ?>';
 var valor_ttp_turno2_entrada = '<?php print $val_ttp_turno2_entrada ?>';
 var valor_ttp_turno3_entrada = '<?php print $val_ttp_turno3_entrada ?>';
 if(valor_ttp_turno1_entrada == 'nan')
 {
  valor_ttp_turno1_entrada = 0;
 }
 if(valor_ttp_turno2_entrada == 'nan')
 {
  valor_ttp_turno2_entrada = 0;
 }
 if(valor_ttp_turno3_entrada == 'nan')
 {
  valor_ttp_turno3_entrada = 0;
 }
 



 
 
 if (parseFloat(media_entrada.toFixed(1))< parseFloat(referencia_entrada))
  {
    link_ttp_dia_entrada.innerHTML = link_ttp_dia_entrada.innerHTML + ' ' +  '<font color="#008000">' + '<?php print $ttp_dia_entrada ?>' + ' MIN</font>'; 
  }
  else
  {
    link_ttp_dia_entrada.innerHTML = link_ttp_dia_entrada.innerHTML + ' ' +  '<font color="#F00000">' + '<?php print $ttp_dia_entrada ?>' + ' MIN</font>'; 
  }
 

 
  //Media ttp turno 1
  if (parseFloat(referencia_entrada.toFixed(1))> parseFloat(valor_ttp_turno1_entrada) )
  {
    link_ttp_turno1_entrada.innerHTML = link_ttp_turno1_entrada.innerHTML + ' ' +  '<font color="#008000">' + valor_ttp_turno1_entrada +' MIN</font>'; 
  }
  else
  {
    link_ttp_turno1_entrada.innerHTML = link_ttp_turno1_entrada.innerHTML + ' ' +  '<font color="#F00000">' + valor_ttp_turno1_entrada +' MIN</font>'; 
  }
  //Media ttp turno 2
  if (parseFloat(referencia_entrada.toFixed(1))> parseFloat(valor_ttp_turno2_entrada) )
  {
    link_ttp_turno2_entrada.innerHTML = link_ttp_turno2_entrada.innerHTML + ' ' +  '<font color="#008000">' + valor_ttp_turno2_entrada +' MIN</font>'; 
  }
  else
  {
    link_ttp_turno2_entrada.innerHTML = link_ttp_turno2_entrada.innerHTML + ' ' +  '<font color="#F00000">' + valor_ttp_turno2_entrada +' MIN</font>'; 
  }
  //Media ttp turno 3
  if (parseFloat(referencia_entrada.toFixed(1))> parseFloat(valor_ttp_turno3_entrada) )
  {
  link_ttp_turno3_entrada.innerHTML = link_ttp_turno3_entrada.innerHTML + ' ' +  '<font color="#008000">' + valor_ttp_turno3_entrada +' MIN</font>'; 
  }
  else
  {
  link_ttp_turno3_entrada.innerHTML = link_ttp_turno3_entrada.innerHTML + ' ' +  '<font color="#F00000">' + valor_ttp_turno3_entrada +' MIN</font>'; 
  }

  
  
  var line_data = google.visualization.arrayToDataTable(dataRows);
  var options = {
      title: '','chartArea': {'width': '85%', 'height': '65%'},
      legend: {position: 'none', textStyle: {color: '#000000', fontSize: 16}},
      backgroundColor: '#F8F8FF',
      vAxis: 
      {
       textStyle: {color: '#000000', fontSize: 16}
      },
      hAxis: 
      {
       slantedText: false, slantedTextAngle: 0, //Posicao do nome nas colunas
       textStyle: 
       {
        textPosition: 'none', 
        fontSize: 16,
        color: 'black' // Cor das legendas embaixo das colunas
       },
       ticks: ['00:00', '01:00', '02:00', '03:00', '04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'],
       maxAlternation: 1,
      },
      series: 
      {
       0: {type: 'area',lineWidth: 2.5,color: '#0000CD', visibleInLegend: false},
       1: {type: 'area',lineWidth: 2.5,color: '#008000', visibleInLegend: false},
       2: {type: 'area',lineWidth: 2.5,color: '#4F4F4F', visibleInLegend: false},       
       3: {type: 'line',lineWidth: 3,color: 'rgb(240,0,0)', visibleInLegend: false}
      },
      explorer: 
      {
       axis: 'horizontal',
       keepInBounds: true,
       maxZoomIn: 4.0
      },
  }; // fecha var options
  var chart = new google.visualization.ComboChart(document.getElementById('grafico_entrada_a_saida'));
  chart.draw(line_data, options);
 } // fecha draw function
} // fecha if(parseInt(encontrado_entrada_a_saida)>0)
else
{
  //Nao existem dados  
}



var encontrado_ca_a_saida = <?php print $encontrado_ca_a_saidas ?>;
var valor_turno1 = '<?php print $turno1_ca ?>';
var valor_turno2 = '<?php print $turno2_ca  ?>';
var valor_turno3 = '<?php print $turno3_ca  ?>';

if(parseInt(encontrado_ca_a_saida)>0)
{
 //alert('Existem dados!');
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);
 //alert(total_encontrado_entrada_a_saida);
 function drawChart() 
 {
  var dataRows = [['Date Hora', 'Turno1','Turno2', 'Turno3', 'Referencia']];
  var x = 0;

  //console.log('valor');
   
  for (var i = 1; i < encontrado_ca_a_saida ; i++) 
  {
   hora =  array_data_hora_ca_a_saida[x].split(" ");
   
   x = parseInt(encontrado_ca_a_saida)-i; 
   // console.log(x+' - ' + i + ' Valor array :' + array_data_hora_entrada_a_saida[x]+ ' : ' + array_condicao_entrada_a_saida[x]);
   //console.log(array_condicao_ca_a_saida_turno[x]);
   if(valor_turno1 == array_condicao_ca_a_saida_turno[x]) 
   {
    dataRows.push([ hora[1], parseFloat(array_condicao_ca_a_saida[x]),0,0, referencia_ca]);
   }
   else if(valor_turno2 == array_condicao_ca_a_saida_turno[x]) 
   {
    dataRows.push([ hora[1],0,parseFloat(array_condicao_ca_a_saida[x]),0, referencia_ca]);
   }
   else
   {
    dataRows.push([ hora[1],0,0,parseFloat(array_condicao_ca_a_saida[x]), referencia_ca]);
   }
   media_ca = media_ca + parseFloat(array_condicao_ca_a_saida[x]);
  
  
  
  
  }
  media_ca = media_ca/ encontrado_ca_a_saida;
  console.log(media_ca.toFixed(1));
  var link_ttp_dia_ca = document.getElementById('ttp_dia_ca');
  var link_ttp_turno1_ca = document.getElementById('ttp_turno1_ca');
  var link_ttp_turno2_ca = document.getElementById('ttp_turno2_ca');
  var link_ttp_turno3_ca = document.getElementById('ttp_turno3_ca');
  
 var valor_ttp_turno1_ca = '<?php print $val_ttp_turno1_ca ?>';
 var valor_ttp_turno2_ca = '<?php print $val_ttp_turno2_ca ?>';
 var valor_ttp_turno3_ca = '<?php print $val_ttp_turno3_ca ?>';
 if(valor_ttp_turno1_ca == 'nan')
 {
  valor_ttp_turno1_ca = 0;
 }
 if(valor_ttp_turno2_ca == 'nan')
 {
  valor_ttp_turno2_ca = 0;
 }
 if(valor_ttp_turno3_ca == 'nan')
 {
  valor_ttp_turno3_ca = 0;
 }
 
 
 if (parseFloat(media_ca.toFixed(1))< parseFloat(referencia_ca))
  {
    link_ttp_dia_ca.innerHTML = link_ttp_dia_ca.innerHTML + ' ' +  '<font color="#008000">' + '<?php print $ttp_dia_ca ?>' +' MIN</font>'; 
  }
  else
  {
    link_ttp_dia_ca.innerHTML = link_ttp_dia_ca.innerHTML + ' ' +  '<font color="#F00000">' + '<?php print $ttp_dia_ca ?>' +' MIN</font>'; 
  }
 

 
  //Media ttp turno 1
  if (parseFloat(referencia_ca.toFixed(1))> parseFloat(valor_ttp_turno1_ca) )
  {
    link_ttp_turno1_ca.innerHTML = link_ttp_turno1_ca.innerHTML + ' ' +  '<font color="#008000">' + valor_ttp_turno1_ca +' MIN</font>'; 
  }
  else
  {
    link_ttp_turno1_ca.innerHTML = link_ttp_turno1_ca.innerHTML + ' ' +  '<font color="#F00000">' + valor_ttp_turno1_ca +' MIN</font>'; 
  }
  //Media ttp turno 2
  if (parseFloat(referencia_ca.toFixed(1))> parseFloat(valor_ttp_turno2_ca) )
  {
    link_ttp_turno2_ca.innerHTML = link_ttp_turno2_ca.innerHTML + ' ' +  '<font color="#008000">' + valor_ttp_turno2_ca +' MIN</font>'; 
  }
  else
  {
    link_ttp_turno2_ca.innerHTML = link_ttp_turno2_ca.innerHTML + ' ' +  '<font color="#F00000">' + valor_ttp_turno2_ca +' MIN</font>'; 
  }
  //Media ttp turno 3
  if (parseFloat(referencia_ca.toFixed(1))> parseFloat(valor_ttp_turno3_ca) )
  {
  link_ttp_turno3_ca.innerHTML = link_ttp_turno3_ca.innerHTML + ' ' +  '<font color="#008000">' + valor_ttp_turno3_ca +' MIN</font>'; 
  }
  else
  {
  link_ttp_turno3_ca.innerHTML = link_ttp_turno3_ca.innerHTML + ' ' +  '<font color="#F00000">' + valor_ttp_turno3_ca +' MIN</font>'; 
  }



  
 
  var line_data = google.visualization.arrayToDataTable(dataRows);
  var options = {
      title: '','chartArea': {'width': '85%', 'height': '70%'},
      legend: {position: 'none', textStyle: {color: '#000000', fontSize: 16}},
      backgroundColor: '#F8F8FF',
      vAxis: 
      {
       textStyle: {color: '#000000', fontSize: 16}
      },
      hAxis: 
      {
       slantedText: false, slantedTextAngle: 0, //Posicao do nome nas colunas
       textStyle: 
       {
        textPosition: 'none', 
        fontSize: 16,
        color: 'black' // Cor das legendas embaixo das colunas
       },
       ticks: ['00:00', '01:00', '02:00', '03:00', '04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'],
       maxAlternation: 1,
      },
      
      series: 
      {
       0: {type: 'area',lineWidth: 2.5,color: '#0000CD', visibleInLegend: false},
       1: {type: 'area',lineWidth: 2.5,color: '#008000', visibleInLegend: false},
       2: {type: 'area',lineWidth: 2.5,color: '#4F4F4F', visibleInLegend: false},       
       3: {type: 'line',lineWidth: 3,color: 'rgb(240,0,0)', visibleInLegend: false}
      },
      explorer: 
      {
       axis: 'horizontal',
       keepInBounds: true,
       maxZoomIn: 4.0
      },
  }; // Fecha var options
  var chart = new google.visualization.AreaChart(document.getElementById('grafico_ca_a_saida'));
  chart.draw(line_data, options);
 } // fecha draw function
} // fecha if(parseInt(encontrado_ca_a_saida)>0)
else
{
//alert('Nao existem dados!');
}



</script>


<div id='fundo'></div>
<div id="grafico_entrada_a_saida" ></div>
<div id="grafico_ca_a_saida" ></div>

<label id='titulo1' name='titulo1' >Dados do TTP referente ao dia <?php print $v_data?> - Referência Entradas a Saídas</label>
<label id='titulo2' name='titulo2' >Dados do TTP referente ao dia <?php print $v_data?> - Referência Controles a Saídas</label>




<label id='cx_ttp_turno1_entrada' name='cx_ttp_turno1_entrada' ></label>
<label id='cx_ttp_turno2_entrada' name='cx_ttp_turno2_entrada' ></label>
<label id='cx_ttp_turno3_entrada' name='cx_ttp_turno3_entrada' ></label>
<label id='ttp_turno1_entrada' name='ttp_turno1_entrada' >Turno 1 ( <?php print $turno1_entrada ?> ) - TTP:</label>
<label id='ttp_turno2_entrada' name='ttp_turno2_entrada' >Turno 2 ( <?php print $turno2_entrada ?> ) - TTP:</label>
<label id='ttp_turno3_entrada' name='ttp_turno3_entrada' >Turno 3 ( <?php print $turno3_entrada ?> ) - TTP:</label>
<label id='ttp_dia_entrada' name='ttp_dia_entrada' >TTP dia:</label>


<label id='cx_ttp_turno1_ca' name='cx_ttp_turno1_ca' ></label>
<label id='cx_ttp_turno2_ca' name='cx_ttp_turno2_ca' ></label>
<label id='cx_ttp_turno3_ca' name='cx_ttp_turno3_ca' ></label>
<label id='ttp_turno1_ca' name='ttp_turno1_ca' >Turno 1 ( <?php print $turno1_ca ?> ) - TTP:</label>
<label id='ttp_turno2_ca' name='ttp_turno2_ca' >Turno 2 ( <?php print $turno2_ca ?> ) - TTP:</label>
<label id='ttp_turno3_ca' name='ttp_turno3_ca' >Turno 3 ( <?php print $turno3_ca ?> ) - TTP:</label>
<label id='ttp_dia_ca' name='ttp_dia_ca' >TTP dia:</label>


<script>

var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= 6)
{
 location.href='./tela_ttp_dia.php?vezes=0$nvezes=2';//Por default passo 2 vezes apenas
 //location.href='./dashboard_utmi.php?vezes=0';//Por default passo 2 vezes apenas
}
else
{
 if(link_vezes != '-1')
 {
   window.setTimeout( "location.href=`./tela_ttp.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}

var link = '<?php print $nova_data_consulta_anterior ?>';
console.log('Anterior = ' + link);
</script>


<img id="voltar_data" src="./images/voltar.png"  onclick="javascript: location.href='./tela_ttp.php?data=<?php print $nova_data_consulta_anterior?>'"/>
<img id="avancar_data" src="./images/avancar.png"  onclick="javascript: location.href='./tela_ttp.php?data=<?php print $nova_data_consulta_superior?>'"/>

<script>
var link_dia_superior = window.document.getElementById('avancar_data');
var valor_dia_superior = '<?php print $nova_data_consulta_superior ?>';
var vv_dia = '<?php print $vv_hoje ?>';

valor_dia_superior = valor_dia_superior.split("/");
valor_dia_superior = valor_dia_superior[0];

console.log(parseInt(valor_dia_superior));
console.log('DIA: '+parseInt(vv_dia));
if( parseInt(valor_dia_superior) > parseInt(vv_dia) )
{
 console.log('maior');
 document.getElementById('avancar_data').style.display='none';
}
else
{
 console.log('menor');
 document.getElementById('avancar_data').style.display='block';
}
</script>















<style>
DIV#fundo{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 2%;
    width: 95%;
    height: 91.5%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: 	'trasnparent';

}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 95%;
    font: normal 12pt verdana;
    color: rgba(0,0,0,0.7);
}

LABEL#titulo1
{
  position: absolute;
  left: 21%;
  top: 7%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#cx_ttp_turno1_entrada
{
  position: absolute;
  left: 10.3%;
  top: 44.2%;
  width:12px;
  height: 12px;
  font: bold 12pt verdana;
  color:	#000000;
  border-radius: 3px!important;
  border: 3px #000000 solid!important;
  background-color:#0000CD;
}
LABEL#ttp_turno1_entrada
{
  position: absolute;
  left: 12%;
  top: 44.5%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#cx_ttp_turno2_entrada
{
  position: absolute;
  left: 31.3%;
  top: 44.2%;
  width:12px;
  height: 12px;
  font: bold 12pt verdana;
  color:	#000000;
  border-radius: 3px!important;
  border: 3px #000000 solid!important;
  background-color: #008000;
}
LABEL#ttp_turno2_entrada
{
  position: absolute;
  left: 33%;
  top: 44.5%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#cx_ttp_turno3_entrada
{
  position: absolute;
  left: 53.3%;
  top: 44.2%;
  width:12px;
  height: 12px;
  font: bold 12pt verdana;
  color:	#000000;
  border-radius: 3px!important;
  border: 3px #000000 solid!important;
  background-color: #4F4F4F;
}
LABEL#ttp_turno3_entrada
{
  position: absolute;
  left: 55%;
  top: 44.5%;
  font: bold 12pt verdana;
  color:	#000000;
}
LABEL#ttp_dia_entrada
{
  position: absolute;
  left: 79%;
  top: 44.5%;
  font: bold 12pt verdana;
  color:	#000000;
}
DIV#grafico_entrada_a_saida{
    margin-left: 0px;
    padding-top: 2%;
    padding-bottom: 0.5%;
    position: absolute;
    left: 5%;
    top: 5%;
    width: 92%;
    height: 38%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    background-color: #F8F8FF;

}


DIV#grafico_ca_a_saida{
    margin-left: 0px;
    padding-top: 2%;
    padding-bottom: 2%;
    position: absolute;
    left: 5%;
    top: 49%;
    width: 92%;
    height: 36%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    background-color: #F8F8FF;

}



LABEL#titulo2
{
  position: absolute;
  left: 21%;
  top: 51%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#cx_ttp_turno1_ca
{
  position: absolute;
  left: 10.3%;
  top: 87.5%;
  width:12px;
  height: 12px;
  font: bold 12pt verdana;
  color:	#000000;
  border-radius: 3px!important;
  border: 3px #000000 solid!important;
  background-color: #0000CD;
}
LABEL#ttp_turno1_ca
{
  position: absolute;
  left: 12%;
  top: 87.5%;
  font: bold 12pt verdana;
  color:	#000000;
}

LABEL#cx_ttp_turno2_ca
{
 position: absolute;
 left: 31.3%;
 top: 87.5%;
 width:12px;
 height: 12px;
 font: bold 12pt verdana;
 color:	#000000;
 border-radius: 3px!important;
 border: 3px #000000 solid!important;
 background-color: #008000;
}
LABEL#ttp_turno2_ca
{
  position: absolute;
  left: 33%;
  top: 87.5%;
  font: bold 12pt verdana;
  color:	#000000;
}

LABEL#cx_ttp_turno2_entrada
{
  position: absolute;
  left: 31.3%;
  top: 44.2%;
  width:12px;
  height: 12px;
  font: bold 12pt verdana;
  color:	#000000;
  border-radius: 3px!important;
  border: 3px #000000 solid!important;
  background-color: #008000;
}



LABEL#ttp_turno3_ca
{
  position: absolute;
  left: 55%;
  top: 87.5%;
  font: bold 12pt verdana;
  color:	#000000;
}

LABEL#cx_ttp_turno3_ca
{
  position: absolute;
  left: 53.3%;
  top: 87.5%;
  width:12px;
  height: 12px;
  font: bold 12pt verdana;
  color:	#000000;
  border-radius: 3px!important;
  border: 3px #000000 solid!important;
  background-color: #4F4F4F;
}

LABEL#ttp_dia_ca
{
  position: absolute;
  left: 79%;
  top: 87.5%;
  font: bold 12pt verdana;
  color:	#000000;
}



LABEL#titulo3
{
  position: absolute;
  left: 35%;
  top: 65%;
  font: bold 16pt verdana;
  color:	#ffffff;
}


IMG#voltar_data{
    margin-left: 0px;
    position: absolute;
    left: 80.5%;
    top: 7%;
    width: 40px;
    height: 30px;
    cursor: pointer;

}



IMG#avancar_data{
    margin-left: 0px;
    position: absolute;
    left: 83.5%;
    top: 7%;
    width: 40px;
    height: 30px;
    cursor: pointer;

}



IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 5px;
    width: 20px;
    height: 20px;
    cursor: pointer;

}

IMG#status{
    margin-left: 0px;
    position: absolute;
    left: 91%;
    top: 6%;
    width: 90px;
    height: 40px;
    cursor: pointer;

}
body{

margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}





.google-visualization-tooltip { 

width: 250px;
height: 45px;
padding: 12px;
padding-left: 20px;
border: none !important;
border-radius: 5px !important;
background-color: #B0C4DE;
position: absolute !important;
font-size:  16px !important;

}

IMG#voltar_data{
    margin-left: 0px;
    position: absolute;
    left: 80.5%;
    top: 7%;
    width: 40px;
    height: 30px;
    cursor: pointer;

}



IMG#avancar_data{
    margin-left: 0px;
    position: absolute;
    left: 83.5%;
    top: 7%;
    width: 40px;
    height: 30px;
    cursor: pointer;

}

#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 95%;
    font: normal 12pt verdana;
    color: rgba(0,0,0,0.7);
}

</style>



</body>
</html>





