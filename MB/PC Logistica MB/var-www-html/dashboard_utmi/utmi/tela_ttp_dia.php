<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_utmi.php?vezes=0'"/>
<img id="aumentou" src="./images/aumentou.png"/>
<img id="diminuiu" src="./images/diminuiu.png"/>

<?php

error_reporting(0);
$valor_do_mes = $_GET['mes'];

$acima_ttp = 0;
$encontrados_maior_que_zero = 0;
$valor_ttp_mes_entrada = 0.0;


//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
//atualizo dashboard
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE atualizacao SET data_atualizacao='$data',hora_atualizacao='$hora' WHERE ponto='Dashboard'");


$limite_referencia_ttp = "";



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


if($valor_do_mes == '')
{
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem = explode('/',$data);

$mes = $mensagem[1];
}
else
{
  $mes = $valor_do_mes;  
}




if($mes == '01')
{
  $nome_mes = 'Janeiro';  
}
else if($mes == '02')
{
  $nome_mes = 'Fevereiro';  
}
else if($mes == '03')
{
  $nome_mes = 'Março';  
}
else if($mes == '04')
{
  $nome_mes = 'Abril';  
}
else if($mes == '05')
{
  $nome_mes = 'Maio';  
}
else if($mes == '06')
{
  $nome_mes = 'Junho';  
}
else if($mes == '07')
{
  $nome_mes = 'Julho';  
}
else if($mes == '08')
{
  $nome_mes = 'Agosto';  
}
else if($mes == '09')
{
  $nome_mes = 'Setembro';  
}
else if($mes == '10')
{
  $nome_mes = 'Outubro';  
}
else if($mes == '11')
{
  $nome_mes = 'Novembro';  
}
else
{
 $nome_mes = 'Dezembro';   
}







$vmes = '/'.$mes.'/';
$encontrados = 0;
$melhor = "";
$pior = "";
$dia_melhor = "";
$dia_pior = "";
$array_antena = array();
$array_ttp_desativado = array();
$array_total = array();
$array_v_dias = array();
$array_v_dias2 = array(); // Duplicado para nao dar erro entre max e min ja que adiciona o "nulo", se nao o max retorna o nulo como maximo


// Conecto no banco e busco os valores
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM limites WHERE referencia= 'valor_ttp_entrada_a_saida' LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $limite_referencia_ttp = $dados['limite_em_minutos'];  
}

// Conecto no banco e busco os valores
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_turno_dashboard_2024 WHERE data like '%$vmes%' ORDER BY id ASC LIMIT 31");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {     
  $array_dias[$encontrados] = $dados['data'];
   $array_ttp_entrada_a_saida[$encontrados] = $dados['ttp_dia_entrada'];
  $array_ttp_desativado[$encontrados] = $dados['ttp_dia_entrada'];
  $array_total[$encontrados] = intval(  $array_ttp_desativado[$encontrados]) + intval($array_antena[$encontrados]);
  if(intval($array_ttp_entrada_a_saida[$encontrados])>0)
  {
    $encontrados_maior_que_zero = intval($encontrados_maior_que_zero) + 1;
    $valor_ttp_mes_entrada = floatval($valor_ttp_mes_entrada) + floatval($array_ttp_entrada_a_saida[$encontrados]);
    array_push($array_v_dias,($array_ttp_entrada_a_saida[$encontrados]));
    array_push($array_v_dias2,($array_ttp_entrada_a_saida[$encontrados]));
  }
  else
  {
    array_push($array_v_dias,"nulo");
  }
  

  if(intval( $array_ttp_entrada_a_saida[$encontrados])> intval($limite_referencia_ttp))
  {
   $acima_ttp = intval($acima_ttp) + 1;
  }

  $encontrados = intval($encontrados)+1;
 }
}
?>
<script>
console.log("Encontrados = " + String(<?php print $encontrados ?>));


</script>
<?php

if($encontrados == 30) // Equivale a dia 31
{
    $array_ttp_desativado[30] = 0;
     $array_ttp_entrada_a_saida[30] = 0;
  $array_total[30] = 0;
}

else if($encontrados == 29) // Equivale a dia 30 e 31
{
    $array_ttp_desativado[29] = 0;
     $array_ttp_entrada_a_saida[29] = 0;
  $array_total[29] = 0;

    $array_ttp_desativado[30] = 0;
     $array_ttp_entrada_a_saida[30] = 0;
  $array_total[30] = 0;
}

else if($encontrados == 28) // Equivale a dia  29, 30 e 31
{
    $array_ttp_desativado[28] = 0;
     $array_ttp_entrada_a_saida[28] = 0;
  $array_total[28] = 0;

    $array_ttp_desativado[29] = 0;
     $array_ttp_entrada_a_saida[29] = 0;
  $array_total[29] = 0;

    $array_ttp_desativado[30] = 0;
     $array_ttp_entrada_a_saida[30] = 0;
  $array_total[30] = 0;
}


//Agora verifico qual é o maior e o menor 
$tamanho = count($array_v_dias);
$tamanho_max = count($array_v_dias2);

if($tamanho != 0 && $tamanho_max != 0)
{
 $melhor = min($array_v_dias);
 $pior = max($array_v_dias2);

  for ($x = 0; $x <= $tamanho; $x++) 
  {
  if($array_v_dias[$x] == $melhor)
  {
    $dia_melhor = $array_dias[$x];
    break;
  }
  }

  for ($x = 0; $x <= $tamanho; $x++) 
  {
  if($array_v_dias2[$x] == $pior)
  {
    $dia_pior = $array_dias[$x];
    break;
  }
  }
  //Ajustando o valor_ttp_mes_entrada em função do tanto de valores encontrados
$valor_ttp_mes_entrada = $valor_ttp_mes_entrada/$encontrados_maior_que_zero;
$valor_ttp_mes_entrada = number_format($valor_ttp_mes_entrada,2,".",",");
}
else
{
  $melhor = 0;
  $pior = 0;
  $dia_melhor = '00/00/0000';
  $dia_pior = "00/00/00000";
  //Ajustando o valor_ttp_mes_entrada em função do tanto de valores encontrados
$valor_ttp_mes_entrada = 0;
$valor_ttp_mes_entrada = number_format($valor_ttp_mes_entrada,2,".",",");
}




//atualizo TTP MES na data referente
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$data = explode('/',$data);
$v_mes = intval($data[1]);
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE movimentacoes_2024 SET ttp_mes_entrada='$valor_ttp_mes_entrada' WHERE id='$v_mes'");


?>





<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var tamanho_array = parseInt(<?php print intval($encontrados) ?>);
    var limite_referencia_ttp = parseInt(<?php print intval($limite_referencia_ttp) ?>);
    console.log('<?php print    $array_ttp_entrada_a_saida[3] ?>');
     
    
    
    function drawChart() 
    {
        var data = google.visualization.arrayToDataTable([
       ['Data', 'Limite Referência = '+ limite_referencia_ttp +" minutos",'Valor TTP - ( min )', { role: "annotation" }  ],
       ['<?php print $array_dias[0] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[0] ?>, ''],
    ['<?php print $array_dias[1] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[1] ?>, ''],
    ['<?php print $array_dias[2] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[2] ?>, ''],
    ['<?php print $array_dias[3] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[3] ?>, ''],
    ['<?php print $array_dias[4] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[4] ?>,  ''],
    ['<?php print $array_dias[5] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[5] ?>, ''],
    ['<?php print $array_dias[6] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[6] ?>,  ''],
    ['<?php print $array_dias[7] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[7] ?>,  ''],
    ['<?php print $array_dias[8] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[8] ?>,  ''],
    ['<?php print $array_dias[9] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[9] ?>,  ''],
    ['<?php print $array_dias[10] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[10] ?>,''],
    ['<?php print $array_dias[11] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[11] ?>, ''],
    ['<?php print $array_dias[12] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[12] ?>, ''],
    ['<?php print $array_dias[13] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[13] ?>,''],
    ['<?php print $array_dias[14] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[14] ?>,''],
    ['<?php print $array_dias[15] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[15] ?>,''],
    ['<?php print $array_dias[16] ?>',limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[16] ?>,''],
    ['<?php print $array_dias[17] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[17] ?>,''],
    ['<?php print $array_dias[18] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[18] ?>,''],
    ['<?php print $array_dias[19] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[19] ?>,''],
    ['<?php print $array_dias[20] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[20] ?>,''],
    ['<?php print $array_dias[21] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[21] ?>,''],
    ['<?php print $array_dias[22] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[22] ?>,''],
    ['<?php print $array_dias[23] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[23] ?>,''],
    ['<?php print $array_dias[24] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[24] ?>,''],
    ['<?php print $array_dias[25] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[25] ?>,''],
    ['<?php print $array_dias[26] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[26] ?>,''],
    ['<?php print $array_dias[27] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[27] ?>,''],
    ['<?php print $array_dias[28] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[28] ?>,''],
    ['<?php print $array_dias[29] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[29] ?>,''],
    ['<?php print $array_dias[30] ?>', limite_referencia_ttp,<?php print    $array_ttp_entrada_a_saida[30] ?>,'']
     ]);
    
  
     var view = new google.visualization.DataView(data);
     view.setColumns([0,2,
                      { calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation" },
                      1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },  
                        
                   ]);

   var options = {
        
       'chartArea': {'width': '90%', 'height': '50%'},
       tooltip: {
      ignoreBounds: 'true',
    },
    legend: { position: 'top', maxLines: 5 },
    hAxis: 
    {
     slantedText: true, slantedTextAngle: 60, //Posicao do nome nas colunas
     textStyle: 
     {
      fontSize: 16,
      color: 'black' // Cor das legendas embaixo das colunas
     },
    },
    series: 
    {
     0: {type: 'area',lineWidth: 3.5,color: '#0000CD', visibleInLegend: true},
     1: {type: 'line',lineWidth: 4.5,color: 'red', visibleInLegend: true},
     
    },
    vAxis: 
    {
     textPosition: 'none',
     gridlines: 
     {
      color: 'transparent' //cor das grades de fundo do gráfico
     }
    },
    bar: {groupWidth: "40%"},
    isStacked: false,
    backgroundColor: '#F8F8FF',
    annotations: 
    {
     textStyle: 
     {
      fontName: 'Times-Roman',
      fontSize: 17,
      bold: false,
      italic: false,
      color: '#ffffff',
      auraColor: 'black',
      opacity: 0.9
     }
    },
   };
    
     var chart = new google.visualization.ComboChart(document.getElementById("grafico_encerramentos3"));
     chart.draw(view, options);
    }
 </script>




















    
<div id="grafico_encerramentos3"></div> 

<label id='titulo1' name='titulo1' >TTP Entrada à saída x dia</label>
<label id='titulo2' name='titulo2' >Número de dias acima do limite: <?php print $acima_ttp ?> </label>

<label id='titulo3' name='titulo3' >Melhor TTP : <?php print $melhor ?> minutos no dia <?php print $dia_melhor ?></label>
<label id='titulo4' name='titulo4' >Pior TTP : <?php print $pior ?> minutos no dia <?php print $dia_pior ?></label>
<label id='titulo5' name='titulo5' >TTP mês : <?php print $valor_ttp_mes_entrada ?></label>


</body>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



<script>


var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= 6)
{
  //location.href='./dashboard_utmi.php?vezes=0';
  location.href='./tela_veiculos_dashboard.php?vezes=0';
}
else
{
 if(link_vezes != '-1')
 {
    window.setTimeout( "location.href=`./tela_ttp_dia.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}
</script>
<style>

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
  left: 37%;
  top: 9%;
  font: bold 20pt verdana;
  color:	#000000;
}

LABEL#titulo2
{
  position: absolute;
  left: 64%;
  top: 18%;
  font: bold 15pt verdana;
  color:	#000000;
}

LABEL#titulo3
{
  position: absolute;
  left: 10%;
  top: 84%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#titulo4
{
  position: absolute;
  left: 55%;
  top: 84%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#titulo5
{
  position: absolute;
  left: 10%;
  top: 90%;
  font: bold 16pt verdana;
  color:	#000000;
}



IMG#diminuiu{
    margin-left: 0px;
    position: absolute;
    left: 7%;
    top: 84.5%;
    width: 22px;
    height: 22px;
    cursor: pointer;

}
IMG#aumentou{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    top: 84.5%;
    width: 22px;
    height: 22px;
    cursor: pointer;

}








DIV#grafico_encerramentos3{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 5%;
    width: 95%;
    height: 75%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;

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

body{

margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}


</style>
</html>