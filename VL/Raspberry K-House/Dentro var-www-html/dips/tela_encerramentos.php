<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_vl.php?vezes=0'"/>
 
<?php

error_reporting(0);
$valor_do_mes = $_GET['mes'];
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
//atualizo dashboard
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("UPDATE atualizacao SET data_atualizacao='$data',hora_atualizacao='$hora' WHERE ponto='Dashboard'");




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
$array_dias = array();
$array_antena = array();
$array_job = array();
$array_total = array();


// Conecto no banco e busco os valores
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data like '%$vmes%' ORDER BY id ASC LIMIT 31");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {     
  $array_dias[$encontrados] = $dados['data'];
  $array_antena[$encontrados] = $dados['antena'];
  $array_job[$encontrados] = $dados['job'];
  $array_total[$encontrados] = intval($array_job[$encontrados]) + intval($array_antena[$encontrados]);
  
  
  $encontrados = intval($encontrados)+1;
 }
}

if($encontrados == 30) // Equivale a dia 31
{
  $array_job[30] = 0;
  $array_antena[30] = 0;
  $array_total[30] = 0;
}
else if($encontrados == 29) // Equivale a dia 30 e 31
{
  $array_job[29] = 0;
  $array_antena[29] = 0;
  $array_total[29] = 0;

  $array_job[30] = 0;
  $array_antena[30] = 0;
  $array_total[30] = 0;
}



?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  
  <script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var tamanho_array = parseInt(<?php print intval($encontrados) ?>);

    console.log(tamanho_array);
     

    
    function drawChart() 
    {
        var data = google.visualization.arrayToDataTable([
       ['Data', 'Antena', 'JOB', { role: "annotation" } ],
       ['<?php print $array_dias[0] ?>', <?php print $array_antena[0] ?>, <?php print $array_job[0] ?>, ''],
       ['<?php print $array_dias[1] ?>', <?php print $array_antena[1] ?>,<?php print $array_job[1] ?>, ''],
       ['<?php print $array_dias[2] ?>', <?php print $array_antena[2] ?>,<?php print $array_job[2] ?>, ''],
       ['<?php print $array_dias[3] ?>', <?php print $array_antena[3] ?>,<?php print $array_job[3] ?>,  ''],
       ['<?php print $array_dias[4] ?>', <?php print $array_antena[4] ?>,<?php print $array_job[4] ?>,  ''],
       ['<?php print $array_dias[5] ?>', <?php print $array_antena[5] ?>,<?php print $array_job[5] ?>,  ''],
       ['<?php print $array_dias[6] ?>', <?php print $array_antena[6] ?>,<?php print $array_job[6] ?>,  ''],
       ['<?php print $array_dias[7] ?>', <?php print $array_antena[7] ?>,<?php print $array_job[7] ?>,  ''],
       ['<?php print $array_dias[8] ?>', <?php print $array_antena[8] ?>,<?php print $array_job[8] ?>,  ''],
       ['<?php print $array_dias[9] ?>', <?php print $array_antena[9] ?>,<?php print $array_job[9] ?>,  ''],
       ['<?php print $array_dias[10] ?>', <?php print $array_antena[10] ?>,<?php print $array_job[10] ?>,''],
       ['<?php print $array_dias[11] ?>', <?php print $array_antena[11] ?>,<?php print $array_job[11] ?>, ''],
       ['<?php print $array_dias[12] ?>', <?php print $array_antena[12] ?>,<?php print $array_job[12] ?>, ''],
       ['<?php print $array_dias[13] ?>', <?php print $array_antena[13] ?>,<?php print $array_job[13] ?>,''],
       ['<?php print $array_dias[14] ?>', <?php print $array_antena[14] ?>,<?php print $array_job[14] ?>,''],
       ['<?php print $array_dias[15] ?>', <?php print $array_antena[15] ?>,<?php print $array_job[15] ?>,''],
       ['<?php print $array_dias[16] ?>', <?php print $array_antena[16] ?>,<?php print $array_job[16] ?>,''],
       ['<?php print $array_dias[17] ?>', <?php print $array_antena[17] ?>,<?php print $array_job[17] ?>,''],
       ['<?php print $array_dias[18] ?>', <?php print $array_antena[18] ?>,<?php print $array_job[18] ?>,''],
       ['<?php print $array_dias[19] ?>', <?php print $array_antena[19] ?>,<?php print $array_job[19] ?>,''],
       ['<?php print $array_dias[20] ?>', <?php print $array_antena[20] ?>,<?php print $array_job[20] ?>,''],
       ['<?php print $array_dias[21] ?>', <?php print $array_antena[21] ?>,<?php print $array_job[21] ?>,''],
       ['<?php print $array_dias[22] ?>', <?php print $array_antena[22] ?>,<?php print $array_job[22] ?>,''],
       ['<?php print $array_dias[23] ?>', <?php print $array_antena[23] ?>,<?php print $array_job[23] ?>,''],
       ['<?php print $array_dias[24] ?>', <?php print $array_antena[24] ?>,<?php print $array_job[24] ?>,''],
       ['<?php print $array_dias[25] ?>', <?php print $array_antena[25] ?>,<?php print $array_job[25] ?>,''],
       ['<?php print $array_dias[26] ?>', <?php print $array_antena[26] ?>,<?php print $array_job[26] ?>,''],
       ['<?php print $array_dias[27] ?>', <?php print $array_antena[27] ?>,<?php print $array_job[27] ?>,''],
       ['<?php print $array_dias[28] ?>', <?php print $array_antena[28] ?>,<?php print $array_job[28] ?>,''],
       ['<?php print $array_dias[29] ?>', <?php print $array_antena[29] ?>,<?php print $array_job[29] ?>,''],
       ['<?php print $array_dias[30] ?>', <?php print $array_antena[30] ?>,<?php print $array_job[30] ?>,'']
     ]);
    
  
     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                      2,
                      { calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation" },
                   ]);

                      var options = {
    
       'chartArea': {'width': '90%', 'height': '50%'},
 
       legend: { position: 'top', maxLines: 3 },
       bar: {groupWidth: "60%"},
       isStacked: true,
       backgroundColor: '#F8F8FF',
       
       annotations: 
       {
        textStyle: 
        {
         fontName: 'Times-Roman',
         fontSize: 18,
         bold: false,
         italic: false,
         color: '#ffffff',
         auraColor: 'black',
         opacity: 0.8
        }
       },

       tooltip: {
      ignoreBounds: 'true',
    },
    hAxis: {
      slantedText: true, slantedTextAngle: 45, //Posicao do nome nas colunas
      textStyle: {
        fontSize: 12,
        color: 'black' // Cor das legendas embaixo das colunas
      },
    },
    vAxis: {
        textPosition: 'none',
        gridlines: {
            color: 'transparent' //cor das grades de fundo do gráfico
        }
    },
   



       
     };
    
     var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos"));
     chart.draw(view, options);
    }
 </script>
 
       
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var tamanho_array = parseInt(<?php print intval($encontrados) ?>);

    console.log(tamanho_array);
     

    
    function drawChart() 
    {
        var data = google.visualization.arrayToDataTable([
       ['Data', 'Total Movimentações no mês de <?php print $nome_mes ?>' , { role: "annotation" } ],
       ['<?php print $array_dias[0] ?>', <?php print $array_total[0] ?>, ''],
    ['<?php print $array_dias[1] ?>', <?php print $array_total[1] ?>, ''],
    ['<?php print $array_dias[2] ?>', <?php print $array_total[2] ?>, ''],
    ['<?php print $array_dias[3] ?>', <?php print $array_total[3] ?>,  ''],
    ['<?php print $array_dias[4] ?>', <?php print $array_total[4] ?>,  ''],
    ['<?php print $array_dias[5] ?>', <?php print $array_total[5] ?>,  ''],
    ['<?php print $array_dias[6] ?>', <?php print $array_total[6] ?>,  ''],
    ['<?php print $array_dias[7] ?>', <?php print $array_total[7] ?>,  ''],
    ['<?php print $array_dias[8] ?>', <?php print $array_total[8] ?>,  ''],
    ['<?php print $array_dias[9] ?>', <?php print $array_total[9] ?>,  ''],
    ['<?php print $array_dias[10] ?>', <?php print $array_total[10] ?>,''],
    ['<?php print $array_dias[11] ?>', <?php print $array_total[11] ?>, ''],
    ['<?php print $array_dias[12] ?>', <?php print $array_total[12] ?>, ''],
    ['<?php print $array_dias[13] ?>', <?php print $array_total[13] ?>,''],
    ['<?php print $array_dias[14] ?>', <?php print $array_total[14] ?>,''],
    ['<?php print $array_dias[15] ?>', <?php print $array_total[15] ?>,''],
    ['<?php print $array_dias[16] ?>', <?php print $array_total[16] ?>,''],
    ['<?php print $array_dias[17] ?>', <?php print $array_total[17] ?>,''],
    ['<?php print $array_dias[18] ?>', <?php print $array_total[18] ?>,''],
    ['<?php print $array_dias[19] ?>', <?php print $array_total[19] ?>,''],
    ['<?php print $array_dias[20] ?>', <?php print $array_total[20] ?>,''],
    ['<?php print $array_dias[21] ?>', <?php print $array_total[21] ?>,''],
    ['<?php print $array_dias[22] ?>', <?php print $array_total[22] ?>,''],
    ['<?php print $array_dias[23] ?>', <?php print $array_total[23] ?>,''],
    ['<?php print $array_dias[24] ?>', <?php print $array_total[24] ?>,''],
    ['<?php print $array_dias[25] ?>', <?php print $array_total[25] ?>,''],
    ['<?php print $array_dias[26] ?>', <?php print $array_total[26] ?>,''],
    ['<?php print $array_dias[27] ?>', <?php print $array_total[27] ?>,''],
    ['<?php print $array_dias[28] ?>', <?php print $array_total[28] ?>,''],
    ['<?php print $array_dias[29] ?>', <?php print $array_total[29] ?>,''],
    ['<?php print $array_dias[30] ?>', <?php print $array_total[30] ?>,'']
     ]);
    
  
     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                      2,
                      { calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation" },
                   ]);

       var options = {
        
       'chartArea': {'width': '94%', 'height': '50%'},
       vAxis: {
        textPosition: 'none',
        gridlines: {
            color: 'transparent' //cor das grades de fundo do gráfico
        }
    },
    hAxis: {
      slantedText: true, slantedTextAngle: 90, //Posicao do nome nas colunas
      textStyle: {
        fontSize: 12,
        color: 'black' // Cor das legendas embaixo das colunas
      },
    },
       legend: 'top',
       bar: {groupWidth: "50%"},
       isStacked: false,
       backgroundColor: '#F8F8FF',
       
       annotations: 
       {
        textStyle: 
        {
         fontName: 'Times-Roman',
         fontSize: 14,
         bold: false,
         italic: false,
         color: '#ffffff',
         auraColor: 'black',
         opacity: 0.8
        }
       },
       
     };
    
     var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
     chart.draw(view, options);
    }
 </script>









<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var tamanho_array = parseInt(<?php print intval($encontrados) ?>);

    console.log('<?php print $array_antena[3] ?>');
     

    
    function drawChart() 
    {
        var data = google.visualization.arrayToDataTable([
       ['Data', 'Limite Referência ( 10% do Total )','JOB' ,'ANTENA', { role: "annotation" }  ],
       ['<?php print $array_dias[0] ?>', (<?php print $array_total[0] ?>)*10/100,<?php print $array_job[0] ?>,<?php print $array_antena[0] ?>, ''],
    ['<?php print $array_dias[1] ?>', (<?php print $array_total[1] ?>)*10/100,<?php print $array_job[1] ?>,<?php print $array_antena[1] ?>, ''],
    ['<?php print $array_dias[2] ?>', (<?php print $array_total[2] ?>)*10/100,<?php print $array_job[2] ?>,<?php print $array_antena[2] ?>, ''],
    ['<?php print $array_dias[3] ?>', (<?php print $array_total[3] ?>)*10/100,<?php print $array_job[3] ?>,<?php print $array_antena[3] ?>, ''],
    ['<?php print $array_dias[4] ?>', (<?php print $array_total[4] ?>)*10/100,<?php print $array_job[4] ?>,<?php print $array_antena[4] ?>,  ''],
    ['<?php print $array_dias[5] ?>', (<?php print $array_total[5] ?>)*10/100,<?php print $array_job[5] ?>,<?php print $array_antena[5] ?>, ''],
    ['<?php print $array_dias[6] ?>', (<?php print $array_total[6] ?>)*10/100,<?php print $array_job[6] ?>,<?php print $array_antena[6] ?>,  ''],
    ['<?php print $array_dias[7] ?>', (<?php print $array_total[7] ?>)*10/100,<?php print $array_job[7] ?>,<?php print $array_antena[7] ?>,  ''],
    ['<?php print $array_dias[8] ?>', (<?php print $array_total[8] ?>)*10/100,<?php print $array_job[8] ?>,<?php print $array_antena[8] ?>,  ''],
    ['<?php print $array_dias[9] ?>', (<?php print $array_total[9] ?>)*10/100,<?php print $array_job[9] ?>,<?php print $array_antena[9] ?>,  ''],
    ['<?php print $array_dias[10] ?>', (<?php print $array_total[10] ?>)*10/100,<?php print $array_job[10] ?>,<?php print $array_antena[10] ?>,''],
    ['<?php print $array_dias[11] ?>', (<?php print $array_total[11] ?>)*10/100,<?php print $array_job[11] ?>,<?php print $array_antena[11] ?>, ''],
    ['<?php print $array_dias[12] ?>', (<?php print $array_total[12] ?>)*10/100,<?php print $array_job[12] ?>,<?php print $array_antena[12] ?>, ''],
    ['<?php print $array_dias[13] ?>', (<?php print $array_total[13] ?>)*10/100,<?php print $array_job[13] ?>,<?php print $array_antena[13] ?>,''],
    ['<?php print $array_dias[14] ?>', (<?php print $array_total[14] ?>)*10/100,<?php print $array_job[14] ?>,<?php print $array_antena[14] ?>,''],
    ['<?php print $array_dias[15] ?>', (<?php print $array_total[15] ?>)*10/100,<?php print $array_job[15] ?>,<?php print $array_antena[15] ?>,''],
    ['<?php print $array_dias[16] ?>', (<?php print $array_total[16] ?>)*10/100,<?php print $array_job[16] ?>,<?php print $array_antena[16] ?>,''],
    ['<?php print $array_dias[17] ?>', (<?php print $array_total[17] ?>)*10/100,<?php print $array_job[17] ?>,<?php print $array_antena[17] ?>,''],
    ['<?php print $array_dias[18] ?>', (<?php print $array_total[18] ?>)*10/100,<?php print $array_job[18] ?>,<?php print $array_antena[18] ?>,''],
    ['<?php print $array_dias[19] ?>', (<?php print $array_total[19] ?>)*10/100,<?php print $array_job[19] ?>,<?php print $array_antena[19] ?>,''],
    ['<?php print $array_dias[20] ?>', (<?php print $array_total[20] ?>)*10/100,<?php print $array_job[20] ?>,<?php print $array_antena[20] ?>,''],
    ['<?php print $array_dias[21] ?>', (<?php print $array_total[21] ?>)*10/100,<?php print $array_job[21] ?>,<?php print $array_antena[21] ?>,''],
    ['<?php print $array_dias[22] ?>', (<?php print $array_total[22] ?>)*10/100,<?php print $array_job[22] ?>,<?php print $array_antena[22] ?>,''],
    ['<?php print $array_dias[23] ?>', (<?php print $array_total[23] ?>)*10/100,<?php print $array_job[23] ?>,<?php print $array_antena[23] ?>,''],
    ['<?php print $array_dias[24] ?>', (<?php print $array_total[24] ?>)*10/100,<?php print $array_job[24] ?>,<?php print $array_antena[24] ?>,''],
    ['<?php print $array_dias[25] ?>', (<?php print $array_total[25] ?>)*10/100,<?php print $array_job[25] ?>,<?php print $array_antena[25] ?>,''],
    ['<?php print $array_dias[26] ?>', (<?php print $array_total[26] ?>)*10/100,<?php print $array_job[26] ?>,<?php print $array_antena[26] ?>,''],
    ['<?php print $array_dias[27] ?>', (<?php print $array_total[27] ?>)*10/100,<?php print $array_job[27] ?>,<?php print $array_antena[27] ?>,''],
    ['<?php print $array_dias[28] ?>', (<?php print $array_total[28] ?>)*10/100,<?php print $array_job[28] ?>,<?php print $array_antena[28] ?>,''],
    ['<?php print $array_dias[29] ?>', (<?php print $array_total[29] ?>)*10/100,<?php print $array_job[29] ?>,<?php print $array_antena[29] ?>,''],
    ['<?php print $array_dias[30] ?>', (<?php print $array_total[30] ?>)*10/100,<?php print $array_job[30] ?>,<?php print $array_antena[30] ?>,'']
     ]);
    
  
     var view = new google.visualization.DataView(data);
     view.setColumns([0, 3,
                      { calc: "stringify",
                        sourceColumn: 3,
                        type: "string",
                        role: "annotation" },
                      2,
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
        
       'chartArea': {'width': '94%', 'height': '50%'},
       tooltip: {
      ignoreBounds: 'true',
    },
    legend: { position: 'top', maxLines: 5 },
    hAxis: 
    {
     slantedText: true, slantedTextAngle: 90, //Posicao do nome nas colunas
     textStyle: 
     {
      fontSize: 10,
      color: 'black' // Cor das legendas embaixo das colunas
     },
    },
    series: 
    {
     0: {type: 'area',lineWidth: 2.5,color: '#0000CD', visibleInLegend: true},
     1: {type: 'area',lineWidth: 2.5,color: 'red', visibleInLegend: true},
     2: {type: 'line',lineWidth: 5,color: 'green', visibleInLegend: true}
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
      fontSize: 12,
      bold: false,
      italic: false,
      color: '#ffffff',
      auraColor: 'black',
      opacity: 0.8
     }
    },
   };
    
     var chart = new google.visualization.ComboChart(document.getElementById("grafico_encerramentos3"));
     chart.draw(view, options);
    }
 </script>

















<div id="grafico_encerramentos"></div> 
    
<div id="grafico_encerramentos2"></div> 
    
<div id="grafico_encerramentos3"></div> 

<label id='titulo1' name='titulo1' >Encerramentos Antenas x JOB</label>
<label id='titulo2' name='titulo2' >Movimentações</label>
<label id='titulo3' name='titulo3' >Aderência Encerramentos</label>
</body>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>




<script>


var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= 6)
{
 location.href='./tela_ttp.php?vezes=0';
}
else
{
 if(link_vezes != '-1')
 {
    window.setTimeout( "location.href=`./tela_encerramentos.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
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
  left: 39%;
  top: 5%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#titulo2
{
  position: absolute;
  left: 20%;
  top: 53%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#titulo3
{
  position: absolute;
  left: 66%;
  top: 53%;
  font: bold 16pt verdana;
  color:	#000000;
}


DIV#grafico_encerramentos{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 2%;
    width: 95%;
    height: 45%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;

}

DIV#grafico_encerramentos2{
    padding-left: 20px;
    position: absolute;
    left: 3%;
    top: 50%;
    width: 46%;
    height: 45%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;
    

}

DIV#grafico_encerramentos3{
    padding-left: 20px;
    position: absolute;
    left: 52%;
    top: 50%;
    width: 44.6%;
    height: 45%;
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