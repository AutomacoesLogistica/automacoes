<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>Tela Giro Detalhado</title>
</head>
<body>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_vl.php?vezes=0'"/>

<?php


$vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
$nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
$tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
if($tempo == '-1'){$tempo = 30000;}
if($nvezes == '-1'){$nvezes = 5;}
if($vezes != '-1'){$vezes = intval($vezes)+1;}

if($vezes == -1){}else{$vezes = intval($vezes)+1;}

date_default_timezone_set('America/Sao_Paulo');
$data1 = date('d/m/Y');
$data = isset($_GET['data'])?$_GET['data']:$data1;
$hora = date('H:i:s');
$vdata = explode('/',$data);
$dia = intval($vdata[0]);
$mes = intval($vdata[1]);
$ano = intval($vdata[2]);
$numero_tabela = 0;
$pesquisa_mes = 'mes_'.intval($mes); //exemplo mes_8
$pesquisa_ano = 'ano_2022';
$encontrados = 0;


if($valor_do_mes == '')
{
 //Busco a hora atual
 $mensagem = explode('/',$data);
 $mes = $mensagem[1];
}
else
{
 $mes = $valor_do_mes;  
}

//Converte o dado do mes passado ou adquirido pela data atual e converte no nome do mes
if($mes == '1'){$nome_mes = 'Janeiro';}
else if($mes == '2'){$nome_mes = 'Fevereiro';}
else if($mes == '3'){$nome_mes = 'Março';}
else if($mes == '4'){$nome_mes = 'Abril';}
else if($mes == '5'){$nome_mes = 'Maio';}
else if($mes == '6'){$nome_mes = 'Junho';}
else if($mes == '7'){$nome_mes = 'Julho';}
else if($mes == '8'){$nome_mes = 'Agosto';}
else if($mes == '9'){$nome_mes = 'Setembro';}
else if($mes == '10'){$nome_mes = 'Outubro';}
else if($mes == '11'){$nome_mes = 'Novembro';}
else{$nome_mes = 'Dezembro';}
//************************************************************************************

$encontrados_transportadoras_dia = 0;
$encontrados_transportadoras_motoristas_dia = 0;

$total_geral_dia = 0;
$total_geral_mes = 0;

$encontrados_transportadoras_motoristas_mes = 0;

$encontrado_total_dia = 0;
$encontrado_total_mes = 0;

$quantidade_total_dia = 0;
$quantidade_total_mes = 0;
$giro_total_dia = 0;
$giro_total_mes = 0;

$nome_transportadora = array();
$nome_transportadora_foto = array();
$quantidade_transportadora = array();
$quantidade_transportadora_motoristas = array();
$quantidade_transportadora_viagens = array();
$quantidade_transportadora_motoristas_mes = array();
$giro_transportadora = array();
$giro_transportadora_mes = array();

$encontrados_transportadoras_mes = 0;
$nome_transportadora_mes = array();
$nome_transportadora_foto_m = array();
$quantidade_transportadora_mes = array();

if(intval($mes)>6)
{
 $numero_tabela = 2;
 $pesquisa_dia = 'mes'.(intval($mes)-6).'_dia_'.$dia; //exemplo mes1_dia4
}   
else
{
 $numero_tabela = 1;
 $pesquisa_dia = 'mes'.intval($mes).'_dia_'.$dia; //exemplo mes1_dia4
}


$tabela = 'transportadoras'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_transportadoras1, senão busca no no cadastro_transportadoras2

////echo $tabela;

//AGORA BUSCO A QUANTIDADE DE TRANSPORTADORAS PRIMEIRO
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM $tabela ORDER BY $pesquisa_dia DESC LIMIT 10");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrados_transportadoras_dia = intval($encontrados_transportadoras_dia)+1;
  $nome_transportadora[$encontrados_transportadoras_dia] = $dados['sigla'];
  ?><script>console.log('<?php print $nome_transportadora[$encontrados_transportadoras_dia]?>')</script><?php
  $nome_transportadora_foto[$encontrados_transportadoras_dia] = './images/transportadoras/'.$dados['sigla'].'.png';
  $quantidade_transportadora[$encontrados_transportadoras_dia] = $dados[$pesquisa_dia] + 1;
  $quantidade_total_dia = intval($quantidade_total_dia) + intval($dados[$pesquisa_dia]);
 }
}

//AGORA BUSCO A QUANTIDADE DE TRANSPORTADORAS PRIMEIRO
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM transportadoras1 ORDER BY $pesquisa_mes DESC LIMIT 10");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrados_transportadoras_mes = intval($encontrados_transportadoras_mes)+1;
  $nome_transportadora_mes[$encontrados_transportadoras_mes] = $dados['sigla'];
  $nome_transportadora_foto_m[$encontrados_transportadoras_mes] = './images/transportadoras/'.$dados['sigla'].'.png';
  $quantidade_transportadora_mes[$encontrados_transportadoras_mes] = $dados[$pesquisa_mes]+1;
  $quantidade_total_mes = intval($quantidade_total_mes) + intval($dados[$pesquisa_mes]);
 }
}





$tabela = 'cadastro_motoristas'.$numero_tabela; 
//AGORA CONSULTO A QUANTIDADE DE MOTORISTAS/PLACAS PARA CADA TRANSPORTADORA
//AGORA BUSCO A QUANTIDADE DE TRANSPORTADORAS PRIMEIRO
//Exibo a lista das transportadoras encontradas
for ($x = 1; $x <= intval($encontrados_transportadoras_dia); $x++) 
{
 include_once 'conexao_dashboard.php';
 $sql = $dbcon->query("SELECT * FROM $tabela WHERE ($pesquisa_dia !='0' AND sigla_transportadora='$nome_transportadora[$x]')" );
 if(mysqli_num_rows($sql)>0)
 {
  $encontrados_transportadoras_motoristas_dia = 0;
  while($dados = $sql->fetch_array())
  {
   
   $encontrados_transportadoras_motoristas_dia = intval($encontrados_transportadoras_motoristas_dia)+1;
   $encontrado_total_dia = intval($encontrado_total_dia)+ intval($dados[$pesquisa_dia]);
   $quantidade_transportadora_viagens[$x] = intval($quantidade_transportadora_viagens[$x])+intval($dados[$pesquisa_dia]);
   $quantidade_transportadora_motoristas[$x] =  intval($quantidade_transportadora_motoristas[$x])+ 1;
   ?><script>console.log('<?php print $nome_transportadora[$x].' -  Motoristas = '.  $quantidade_transportadora_motoristas[$x] ?>')</script><?php
   $giro_transportadora[$x] = intval($quantidade_transportadora[$x]) / intval($quantidade_transportadora_motoristas[$x]);
   $giro_transportadora[$x] = number_format($giro_transportadora[$x],3,",",".");

   
   $giro_total_dia = intval($quantidade_total_dia)/intval($encontrado_total_dia);
   $giro_total_dia = number_format($giro_total_dia,3,",",".");


  }
 }
}



for ($x = 1; $x <= intval($encontrados_transportadoras_mes); $x++) 
{
 include_once 'conexao_dashboard.php';
 $sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 WHERE ($pesquisa_mes !='0' AND sigla_transportadora='$nome_transportadora_mes[$x]')" );
 if(mysqli_num_rows($sql)>0)
 {
  $encontrados_transportadoras_motoristas_dia = 0;
  while($dados = $sql->fetch_array())
  {
   
   $encontrados_transportadoras_motoristas_mes = intval($encontrados_transportadoras_motoristas_mes)+1;
   $encontrado_total_mes = intval($encontrado_total_mes)+ intval($dados[$pesquisa_mes]);
   $quantidade_transportadora_motoristas_mes[$x] =  intval($quantidade_transportadora_motoristas_mes[$x])+ 1;
   $giro_transportadora_mes[$x] = intval($quantidade_transportadora_mes[$x]) / intval($quantidade_transportadora_motoristas_mes[$x]);
   $giro_transportadora_mes[$x] = number_format($giro_transportadora_mes[$x],3,",",".");

   
   $giro_total_mes = intval($quantidade_total_mes)/intval($encontrado_total_mes);
   $giro_total_mes = number_format($giro_total_mes,3,",",".");
  }
 }
}










//echo 'Dados referentes ao dia ' . $data;
//echo '</BR>';        //echo '</BR>';        
//Exibo a lista das transportadoras encontradas
for ($x = 1; $x <= intval($encontrados_transportadoras_dia); $x++) 
{
 //echo 'Transpotadora: ' . $nome_transportadora[$x];
 //echo ' - Viajens: '. $quantidade_transportadora[$x];
 //echo ' - Placas: ' . $quantidade_transportadora_motoristas[$x];
 //echo ' - Giro: '. $giro_transportadora[$x];
 //echo '</BR>';        
}
//echo '</BR>';  
//echo 'Quantidade total viajens: '. $quantidade_total_dia . ' - Placas total dia: ' . $encontrado_total_dia . ' - Giro total dia: ' . $giro_total_dia;


//echo '</BR>';//echo '</BR>';//echo '</BR>';//echo '</BR>';
//echo ' Dados referente ao mes';
//echo '</BR>';

//Exibo a lista das transportadoras encontradas
for ($x = 1; $x <= intval($encontrados_transportadoras_mes); $x++) 
{
 //echo 'Transpotadora: ' . $nome_transportadora_mes[$x];
 //echo ' - Viajens: '. $quantidade_transportadora_mes[$x];
 //echo ' - Placas: ' . $quantidade_transportadora_motoristas_mes[$x];
 //echo ' - Giro: '. $giro_transportadora_mes[$x];
 //echo '</BR>';        
}

//echo '</BR>';  
//echo 'Quantidade total viajens: '. $quantidade_total_mes . ' - Placas total dia: ' . $encontrado_total_mes . ' - Giro total dia: ' . $giro_total_mes;








    ?>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([


          ['Transportadora', 'Número Viagens', 'Número Placas'],
          ['<?php print $nome_transportadora[1] ?>'+'/'+'<?php print $giro_transportadora[1]?>', parseInt('<?php print $quantidade_transportadora[1]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[1] ?>')],
          ['<?php print $nome_transportadora[2] ?>'+'/'+'<?php print $giro_transportadora[2]?>', parseInt('<?php print $quantidade_transportadora[2]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[2] ?>')],
          ['<?php print $nome_transportadora[3] ?>'+'/'+'<?php print $giro_transportadora[3]?>', parseInt('<?php print $quantidade_transportadora[3]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[3] ?>')],
          ['<?php print $nome_transportadora[4] ?>'+'/'+'<?php print $giro_transportadora[4]?>', parseInt('<?php print $quantidade_transportadora[4]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[4] ?>')],
          ['<?php print $nome_transportadora[5] ?>'+'/'+'<?php print $giro_transportadora[5]?>', parseInt('<?php print $quantidade_transportadora[5]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[5] ?>')],
          ['<?php print $nome_transportadora[6] ?>'+'/'+'<?php print $giro_transportadora[6]?>', parseInt('<?php print $quantidade_transportadora[6]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[6] ?>')],
          ['<?php print $nome_transportadora[7] ?>'+'/'+'<?php print $giro_transportadora[7]?>', parseInt('<?php print $quantidade_transportadora[7]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[7] ?>')],
          ['<?php print $nome_transportadora[8] ?>'+'/'+'<?php print $giro_transportadora[8]?>', parseInt('<?php print $quantidade_transportadora[8]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[8] ?>')],
          ['<?php print $nome_transportadora[9] ?>'+'/'+'<?php print $giro_transportadora[9]?>', parseInt('<?php print $quantidade_transportadora[9]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[9] ?>')],
          ['<?php print $nome_transportadora[10] ?>'+'/'+'<?php print $giro_transportadora[10]?>', parseInt('<?php print $quantidade_transportadora[10]?>'), parseInt('<?php print $quantidade_transportadora_motoristas[10] ?>')]
          
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2,{ calc: "stringify",sourceColumn: 2,type: "string",role: "annotation" },]);
        var options = {
        'chartArea': {'width': '92%', 'height': '35%',},
        vAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
        hAxis: 
        {
         title: '',viewWindow: {min: 0,},
         textStyle: 
         {
          textPosition: 'none', 
          fontSize: 10,
          color: 'white' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "80%"},
        isStacked: false,
        legend: { position: "top" },
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos"));
      chart.draw(view, options);
      }
    </script>




<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
   google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Transportadora', 'Número Viagens', 'Número Placas'],
      ['<?php print $nome_transportadora_mes[1] ?>'+'/'+'<?php print $giro_transportadora_mes[1]?>', parseInt('<?php print $quantidade_transportadora_mes[1]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[1] ?>')],
      ['<?php print $nome_transportadora_mes[2] ?>'+'/'+'<?php print $giro_transportadora_mes[2]?>', parseInt('<?php print $quantidade_transportadora_mes[2]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[2] ?>')],
      ['<?php print $nome_transportadora_mes[3] ?>'+'/'+'<?php print $giro_transportadora_mes[3]?>', parseInt('<?php print $quantidade_transportadora_mes[3]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[3] ?>')],
      ['<?php print $nome_transportadora_mes[4] ?>'+'/'+'<?php print $giro_transportadora_mes[4]?>', parseInt('<?php print $quantidade_transportadora_mes[4]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[4] ?>')],
      ['<?php print $nome_transportadora_mes[5] ?>'+'/'+'<?php print $giro_transportadora_mes[5]?>', parseInt('<?php print $quantidade_transportadora_mes[5]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[5] ?>')],
      ['<?php print $nome_transportadora_mes[6] ?>'+'/'+'<?php print $giro_transportadora_mes[6]?>', parseInt('<?php print $quantidade_transportadora_mes[6]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[6] ?>')],
      ['<?php print $nome_transportadora_mes[7] ?>'+'/'+'<?php print $giro_transportadora_mes[7]?>', parseInt('<?php print $quantidade_transportadora_mes[7]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[7] ?>')],
      ['<?php print $nome_transportadora_mes[8] ?>'+'/'+'<?php print $giro_transportadora_mes[8]?>', parseInt('<?php print $quantidade_transportadora_mes[8]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[8] ?>')],
      ['<?php print $nome_transportadora_mes[9] ?>'+'/'+'<?php print $giro_transportadora_mes[9]?>', parseInt('<?php print $quantidade_transportadora_mes[9]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[9] ?>')],
      ['<?php print $nome_transportadora_mes[10] ?>'+'/'+'<?php print $giro_transportadora_mes[10]?>', parseInt('<?php print $quantidade_transportadora_mes[10]?>'), parseInt('<?php print $quantidade_transportadora_motoristas_mes[10] ?>')]
      
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2,{ calc: "stringify",sourceColumn: 2,type: "string",role: "annotation" },]);
        var options = {
        'chartArea': {'width': '92%', 'height': '35%',},
        vAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
        hAxis: 
        {
         title: '',viewWindow: {min: 0,},
         textStyle: 
         {
          textPosition: 'none', 
          fontSize: 10,
          color: 'white' // Cor das legendas embaixo das colunas
         },
        },
        bar: {groupWidth: "80%"},
        isStacked: false,
        legend: { position: "top" },
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);
      
  }
</script>









<div id="grafico_encerramentos"></div> 

    
<div id="grafico_encerramentos2"></div> 

<label id='titulo1' name='titulo1' >Ranking das Transportadoras referente ao dia <?php print $data ?></label>
<label id='titulo1_1' name='titulo1_1' >Dados atualizados às <?php print $hora ?></label>
<label id='lb_total_dia' name='lb_total_dia' >Total Eventos :  <?php print $encontrado_total_dia ?></label>
<label id='titulo2' name='titulo2' >Ranking das Transportadoras referente ao mês de <?php print $nome_mes ?></label>
<label id='lb_total_mes' name='lb_total_mes' >Total Eventos :  <?php print $encontrado_total_mes ?></label>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



<label id='lb_transportadora1'>GIRO </BR> <?php print $giro_transportadora[1] ?></label>
<label id='lb_transportadora2'>GIRO </BR> <?php print $giro_transportadora[2] ?></label>
<label id='lb_transportadora3'>GIRO </BR> <?php print $giro_transportadora[3] ?></label>
<label id='lb_transportadora4'>GIRO </BR> <?php print $giro_transportadora[4] ?></label>
<label id='lb_transportadora5'>GIRO </BR> <?php print $giro_transportadora[5] ?></label>
<label id='lb_transportadora6'>GIRO </BR> <?php print $giro_transportadora[6] ?></label>
<label id='lb_transportadora7'>GIRO </BR> <?php print $giro_transportadora[7] ?></label>
<label id='lb_transportadora8'>GIRO </BR> <?php print $giro_transportadora[8] ?></label>
<label id='lb_transportadora9'>GIRO </BR> <?php print $giro_transportadora[9] ?></label>
<label id='lb_transportadora10'>GIRO </BR> <?php print $giro_transportadora[10] ?></label>

<label id='lb_transportadora1_mes'>GIRO </BR> <?php print $giro_transportadora_mes[1] ?></label>
<label id='lb_transportadora2_mes'>GIRO </BR> <?php print $giro_transportadora_mes[2] ?></label>
<label id='lb_transportadora3_mes'>GIRO </BR> <?php print $giro_transportadora_mes[3] ?></label>
<label id='lb_transportadora4_mes'>GIRO </BR> <?php print $giro_transportadora_mes[4] ?></label>
<label id='lb_transportadora5_mes'>GIRO </BR> <?php print $giro_transportadora_mes[5] ?></label>
<label id='lb_transportadora6_mes'>GIRO </BR> <?php print $giro_transportadora_mes[6] ?></label>
<label id='lb_transportadora7_mes'>GIRO </BR> <?php print $giro_transportadora_mes[7] ?></label>
<label id='lb_transportadora8_mes'>GIRO </BR> <?php print $giro_transportadora_mes[8] ?></label>
<label id='lb_transportadora9_mes'>GIRO </BR> <?php print $giro_transportadora_mes[9] ?></label>
<label id='lb_transportadora10_mes'>GIRO </BR> <?php print $giro_transportadora_mes[10] ?></label>

<img id="transportadora_1" src="<?php print $nome_transportadora_foto[1]?>"/>
<img id="transportadora_2" src="<?php print $nome_transportadora_foto[2]?>"/>
<img id="transportadora_3" src="<?php print $nome_transportadora_foto[3]?>"/>
<img id="transportadora_4" src="<?php print $nome_transportadora_foto[4]?>"/>
<img id="transportadora_5" src="<?php print $nome_transportadora_foto[5]?>"/>
<img id="transportadora_6" src="<?php print $nome_transportadora_foto[6]?>"/>
<img id="transportadora_7" src="<?php print $nome_transportadora_foto[7]?>"/>
<img id="transportadora_8" src="<?php print $nome_transportadora_foto[8]?>"/>
<img id="transportadora_9" src="<?php print $nome_transportadora_foto[9]?>"/>
<img id="transportadora_10" src="<?php print $nome_transportadora_foto[10]?>"/>

<img id="m_transportadora_1" src="<?php print $nome_transportadora_foto_m[1]?>"/>
<img id="m_transportadora_2" src="<?php print $nome_transportadora_foto_m[2]?>"/>
<img id="m_transportadora_3" src="<?php print $nome_transportadora_foto_m[3]?>"/>
<img id="m_transportadora_4" src="<?php print $nome_transportadora_foto_m[4]?>"/>
<img id="m_transportadora_5" src="<?php print $nome_transportadora_foto_m[5]?>"/>
<img id="m_transportadora_6" src="<?php print $nome_transportadora_foto_m[6]?>"/>
<img id="m_transportadora_7" src="<?php print $nome_transportadora_foto_m[7]?>"/>
<img id="m_transportadora_8" src="<?php print $nome_transportadora_foto_m[8]?>"/>
<img id="m_transportadora_9" src="<?php print $nome_transportadora_foto_m[9]?>"/>
<img id="m_transportadora_10" src="<?php print $nome_transportadora_foto_m[10]?>"/>




<script>

var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= 6)
{
 location.href='./tela_resumo_motoristas.php?vezes=0$nvezes=2';//Por default passo 2 vezes apenas
}
else
{
 if(link_vezes != '-1')
 {
   window.setTimeout( "location.href=`./tela_resumo_giro_detalhado.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}
</script>
</body>
</html>
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
  left: 32%;
  top: 6%;
  font: bold 20pt verdana;
  color:	#000000;
}
LABEL#titulo1_1
{
  position: absolute;
  left: 42%;
  top: 9%;
  font: bold 17pt verdana;
  color:	#00008B;
}
LABEL#lb_total_dia
{
  position: absolute;
  left: 80%;
  top: 12%;
  font: bold 17pt verdana;
  color:	#000000;
}
LABEL#titulo2
{
  position: absolute;
  left: 32%;
  top: 54%;
  font: bold 20pt verdana;
  color:	#000000;
}
LABEL#lb_total_mes
{
  position: absolute;
  left: 80%;
  top: 60%;
  font: bold 17pt verdana;
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
    padding-left: 0px;
    position: absolute;
    left: 3%;
    top: 50%;
    width: 95%;
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

IMG#transportadora_1{
    margin-left: 0px;
    position: absolute;
    left: 8%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}

IMG#transportadora_2{
    margin-left: 0px;
    position: absolute;
    left: 16.7%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#transportadora_3{
    margin-left: 0px;
    position: absolute;
    left: 25.4%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#transportadora_4{
    margin-left: 0px;
    position: absolute;
    left: 34.1%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#transportadora_5{
    margin-left: 0px;
    position: absolute;
    left: 42.8%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#transportadora_6{
    margin-left: 0px;
    position: absolute;
    left: 51.5%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#transportadora_7{
    margin-left: 0px;
    position: absolute;
    left: 60.2%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#transportadora_8{
    margin-left: 0px;
    position: absolute;
    left: 68.9%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}

IMG#transportadora_9{
    margin-left: 0px;
    position: absolute;
    left: 77.6%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#transportadora_10{
    margin-left: 0px;
    position: absolute;
    left: 86.3%;
    top: 33.9%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}

IMG#m_transportadora_1{
    margin-left: 0px;
    position: absolute;
    left: 8%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_2{
    margin-left: 0px;
    position: absolute;
    left: 16.7%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_3{
    margin-left: 0px;
    position: absolute;
    left: 25.4%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_4{
    margin-left: 0px;
    position: absolute;
    left: 34.1%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_5{
    margin-left: 0px;
    position: absolute;
    left: 42.8%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_6{
    margin-left: 0px;
    position: absolute;
    left: 51.5%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_7{
    margin-left: 0px;
    position: absolute;
    left: 60.2%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_8{
    margin-left: 0px;
    position: absolute;
    left: 68.9%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}

IMG#m_transportadora_9{
    margin-left: 0px;
    position: absolute;
    left: 77.6%;
    top: 82%;
    width: 7%;
    height: 3.8%;
    cursor: pointer;

}
IMG#m_transportadora_10{
    margin-left: 0px;
    position: absolute;
    left: 86.3%;
    top: 82%;
    width: 7%;
    height: 3.8%;
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





LABEL#lb_transportadora1{
    position: absolute;
    left: 8.1%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}


LABEL#lb_transportadora2{
    position: absolute;
    left: 16.8%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora3{
    position: absolute;
    left: 25.5%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}
LABEL#lb_transportadora4{
    position: absolute;
    left: 34.2%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora5{
    position: absolute;
    left: 42.9%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora6{
    position: absolute;
    left: 51.6%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora7{
    position: absolute;
    left: 60.3%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora8{
    position: absolute;
    left: 69%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}


LABEL#lb_transportadora9{
    position: absolute;
    left: 77.7%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}


LABEL#lb_transportadora10{
    position: absolute;
    left: 86.4%;
    top: 38%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}



LABEL#lb_transportadora1_mes{
    position: absolute;
    left: 8.1%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}


LABEL#lb_transportadora2_mes{
    position: absolute;
    left: 16.8%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora3_mes{
    position: absolute;
    left: 25.5%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}
LABEL#lb_transportadora4_mes{
    position: absolute;
    left: 34.2%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora5_mes{
    position: absolute;
    left: 42.9%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora6_mes{
    position: absolute;
    left: 51.6%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora7_mes{
    position: absolute;
    left: 60.3%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}

LABEL#lb_transportadora8_mes{
    position: absolute;
    left: 69%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}


LABEL#lb_transportadora9_mes{
    position: absolute;
    left: 77.7%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
}


LABEL#lb_transportadora10_mes{
    position: absolute;
    left: 86.4%;
    top: 86.5%;
    width: 6.6%;
    height: 5%;
    font-style: normal;
	font-weight: bold;
	font-size: 16px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 5px!important;
    border: 2px #000000 solid!important;
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