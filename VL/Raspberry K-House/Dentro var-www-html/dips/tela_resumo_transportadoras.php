<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
    <title>Tela Resumo Motoristas</title>
</head>
<body>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_vl.php?vezes=0'"/>

<?php
$permite_echo = "0"; // Em 1 para debugar e em 0 corta os echos

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
if($permite_echo == "1")
{
 $hora = date('H:i:s');
}

$vdata = explode('/',$data);
$dia = intval($vdata[0]);
$mes = intval($vdata[1]);
$ano = intval($vdata[2]);
$numero_tabela = 0;
$pesquisa_mes = 'mes_'.intval($mes); //exemplo mes_8
$pesquisa_ano = 'ano_2022';
$encontrados = 0;
$pesquisa_dia = '';

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
$nome_transportadora = array();
$nome_transportadora_foto = array();
$quantidade_transportadora = array();

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

if($permite_echo =="1")
{
 echo "Pesquisa dia = " . $pesquisa_dia;
 echo "</BR>";
 echo "Nome tabela = trasnportadora" . $numero_tabela;
}





//AGORA BUSCO O RANKING DAS TRANSPORTADORAS NO DIA
$tabela = 'transportadoras'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_transportadoras1, senão busca no no cadastro_transportadoras2
$encontrados_transportadoras_dia  = 0;
//echo $tabela;
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM $tabela ORDER BY $pesquisa_dia DESC LIMIT 10");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrados_transportadoras_dia = intval($encontrados_transportadoras_dia)+1;
  $nome_transportadora[$encontrados_transportadoras_dia] = $dados['sigla'];
  $nome_transportadora_foto[$encontrados_transportadoras_dia] = './images/transportadoras/'.$dados['sigla'].'.png';
  $quantidade_transportadora[$encontrados_transportadoras_dia] = $dados[$pesquisa_dia];
 }
 
}

if($permite_echo =="1")
{
 echo '</BR>'; 
 echo '</BR>';
 echo '</BR>'; 
    for ($x = 1; $x <= intval($encontrados_transportadoras_dia); $x++) 
    {
    echo 'Transpotadora: ' . $nome_transportadora[$x];
    echo ' - Viajens: '. $quantidade_transportadora[$x];
    echo '</BR>';        
    }
}


//AGORA BUSCO O RANKING DAS TRANSPORTADORAS NO DIA
$encontrados = 0;

//echo $tabela;
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM transportadoras1 ORDER BY $pesquisa_mes DESC LIMIT 10");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrados_transportadoras_mes = intval($encontrados_transportadoras_mes)+1;
  $nome_transportadora_mes[$encontrados_transportadoras_mes] = $dados['sigla'];
  $nome_transportadora_foto_m[$encontrados_transportadoras_mes] = './images/transportadoras/'.$dados['sigla'].'.png';
  $quantidade_transportadora_mes[$encontrados_transportadoras_mes] = $dados[$pesquisa_mes];
 }
}

if($permite_echo =="1")
{
 echo '</BR>'; 
 echo '</BR>';
 echo '</BR>'; 
    for ($x = 1; $x <= intval($encontrados_transportadoras_mes); $x++) 
    {
     echo 'Transpotadora: ' . $nome_transportadora_mes[$x];
     echo ' - Viajens: '. $quantidade_transportadora_mes[$x];
     echo '</BR>';        
    }
}


?>







<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Motorista", "Numero Viajens",{ role: "style" }],
        ['<?php print $nome_transportadora[1]?>', <?php print $quantidade_transportadora[1] ?>, "#00008B" ],
        ['<?php print $nome_transportadora[2]?>', <?php print $quantidade_transportadora[2] ?>, "#00008B"],
        ['<?php print $nome_transportadora[3]?>', <?php print $quantidade_transportadora[3] ?>, "#00008B"],
        ['<?php print $nome_transportadora[4]?>', <?php print $quantidade_transportadora[4] ?>, "#00008B"],
        ['<?php print $nome_transportadora[5]?>', <?php print $quantidade_transportadora[5] ?>, "#00008B"],
        ['<?php print $nome_transportadora[6]?>', <?php print $quantidade_transportadora[6] ?>, "#00008B"],
        ['<?php print $nome_transportadora[7]?>', <?php print $quantidade_transportadora[7] ?>, "#00008B"],
        ['<?php print $nome_transportadora[8]?>', <?php print $quantidade_transportadora[8] ?>, "#00008B"],
        ['<?php print $nome_transportadora[9]?>', <?php print $quantidade_transportadora[9] ?>, "#00008B"],
        ['<?php print $nome_transportadora[10]?>', <?php print $quantidade_transportadora[10] ?>, "#00008B"]
        
      ]);
      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '92%', 'height': '50%',},
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
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos"));
      chart.draw(view, options);
  }

</script>


<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Motorista", "Numero Viajens",{ role: "style" }],
        ['<?php print $nome_transportadora_mes[1]?>', <?php print $quantidade_transportadora_mes[1] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[2]?>', <?php print $quantidade_transportadora_mes[2] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[3]?>', <?php print $quantidade_transportadora_mes[3] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[4]?>', <?php print $quantidade_transportadora_mes[4] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[5]?>', <?php print $quantidade_transportadora_mes[5] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[6]?>', <?php print $quantidade_transportadora_mes[6] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[7]?>', <?php print $quantidade_transportadora_mes[7] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[8]?>', <?php print $quantidade_transportadora_mes[8] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[9]?>', <?php print $quantidade_transportadora_mes[9] ?>, "#00008B"],
        ['<?php print $nome_transportadora_mes[10]?>', <?php print $quantidade_transportadora_mes[10] ?>, "#00008B"]
        
      ]);
      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
      var options = {
        'chartArea': {'width': '92%', 'height': '50%',},
        vAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
        hAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
        bar: {groupWidth: "80%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);
  }

</script>


<div id="grafico_encerramentos"></div> 

    
<div id="grafico_encerramentos2" ></div> 

<label id='titulo1' name='titulo1'>Ranking das Transportadoras referente ao dia <?php print $data ?></label>
<label id='titulo2' name='titulo2'>Ranking das Transportadoras referente ao mês de <?php print $nome_mes ?></label>

<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>




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
 location.href='./tela_encerramentos.php?vezes=0$nvezes=2';//Por default passo 2 vezes apenas
}
else
{
 if(link_vezes != '-1')
 {
   window.setTimeout( "location.href=`./tela_resumo_transportadoras.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   

}
</script>

</body>
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
  left: 27%;
  top: 6%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#titulo2
{
  position: absolute;
  left: 27%;
  top: 54%;
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
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}

IMG#transportadora_2{
    margin-left: 0px;
    position: absolute;
    left: 16.7%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#transportadora_3{
    margin-left: 0px;
    position: absolute;
    left: 25.4%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#transportadora_4{
    margin-left: 0px;
    position: absolute;
    left: 34.1%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#transportadora_5{
    margin-left: 0px;
    position: absolute;
    left: 42.8%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#transportadora_6{
    margin-left: 0px;
    position: absolute;
    left: 51.5%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#transportadora_7{
    margin-left: 0px;
    position: absolute;
    left: 60.2%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#transportadora_8{
    margin-left: 0px;
    position: absolute;
    left: 68.9%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}

IMG#transportadora_9{
    margin-left: 0px;
    position: absolute;
    left: 77.6%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#transportadora_10{
    margin-left: 0px;
    position: absolute;
    left: 86.3%;
    top: 37.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}

IMG#m_transportadora_1{
    margin-left: 0px;
    position: absolute;
    left: 8%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_2{
    margin-left: 0px;
    position: absolute;
    left: 16.7%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_3{
    margin-left: 0px;
    position: absolute;
    left: 25.4%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_4{
    margin-left: 0px;
    position: absolute;
    left: 34.1%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_5{
    margin-left: 0px;
    position: absolute;
    left: 42.8%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_6{
    margin-left: 0px;
    position: absolute;
    left: 51.5%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_7{
    margin-left: 0px;
    position: absolute;
    left: 60.2%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_8{
    margin-left: 0px;
    position: absolute;
    left: 68.9%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}

IMG#m_transportadora_9{
    margin-left: 0px;
    position: absolute;
    left: 77.6%;
    top: 85.5%;
    width: 99px;
    height: 27px;
    cursor: pointer;

}
IMG#m_transportadora_10{
    margin-left: 0px;
    position: absolute;
    left: 86.3%;
    top: 85.5%;
    width: 99px;
    height: 27px;
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