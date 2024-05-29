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

<script>

var array_transportadora = [];
var array_quantidade = [];
for (i=0;i<20;i++)
{
 array_transportadora[i]=0;
 array_quantidade[i] = 0;
}

</script>

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

$lista_transportadora = array();
$quantidade_transportadora = array();
$quantidade_array_pizza = 0;

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


$lista_transportadora = array();
$quantidade_transportadora = array();

$encontrados_motoristas_dia = 0;
$nome_motorista = array();
$transportadora_motorista = array();
$quantidade_motorista = array();

$encontrados_motoristas_dia_mes = 0;
$nome_motorista_mes = array();
$transportadora_motorista_mes = array();
$quantidade_motorista_mes = array();


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
$tabela = 'cadastro_motoristas'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_motoristas1, senão busca no no cadastro_motoristas2

//echo $tabela;
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM $tabela ORDER BY $pesquisa_dia DESC LIMIT 10");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrados_motoristas_dia = intval($encontrados_motoristas_dia)+1;
  $nome_motorista[$encontrados_motoristas_dia] = $dados['nome'];
  $transportadora_motorista[$encontrados_motoristas_dia] = $dados['sigla_transportadora'];
  $quantidade_motorista[$encontrados_motoristas_dia] = $dados[$pesquisa_dia];
 }
}

if($permite_echo =="1")
{
  for ($x = 1; $x <= intval($encontrados_motoristas_dia); $x++) 
  {
  echo 'Motorista: ' . $nome_motorista[$x];
  echo ' - Viajens: '. $quantidade_motorista[$x];
  echo ' - Transpotadora: ' . $transportadora_motorista[$x];
  echo '</BR>';        
  }

  echo '</BR>'; 
  echo '</BR>'; 
  echo 'Dados referente ao mes';
  echo '</BR>'; 
  echo $pesquisa_mes;
  echo $tabela;
}

//DADOS PARA MOTORISTAS NO MES
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 ORDER BY $pesquisa_mes DESC LIMIT 10"); // para a contagem no mes sempre sera 1
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrados_motoristas_dia_mes = intval($encontrados_motoristas_dia_mes)+1;
  $nome_motorista_mes[$encontrados_motoristas_dia_mes] = $dados['nome'];
  $transportadora_motorista_mes[$encontrados_motoristas_dia_mes] = $dados['sigla_transportadora'];
  $quantidade_motorista_mes[$encontrados_motoristas_dia_mes] = $dados[$pesquisa_mes];
 }
}


for ($x = 1; $x <= intval($encontrados_motoristas_dia_mes); $x++) 
{
  //$lista_transportadora = ['Cootracargem','Cooperauto','Tora'];
  //$quantidade_transportadora = ['5','25','211'];
   
   //$transportadora_agora = 'BVC';
   $transportadora_agora = $transportadora_motorista_mes[$x];
   
   if (in_array($transportadora_agora, $lista_transportadora))
   { 
    //Procuro o index referente ao array
    $index = array_search($transportadora_agora, $lista_transportadora);
    $quantidade_salva = intval($quantidade_transportadora[$index]) + 1;
    $quantidade_transportadora[$index] = $quantidade_salva;
    //echo $index .' - Quantidade agora sera : ' . $quantidade_salva ;
   }
   else
   {
      array_push($lista_transportadora, $transportadora_agora); // adiociono no array das transportadoras
      array_push($quantidade_transportadora, 1); // adiociono no array de quantidade
   
   }   
   
 
}   
 

 $quantidade_array_pizza = count($lista_transportadora);
 //Agora passo os dados para o javascript
 
for ($x = 0; $x < intval($quantidade_array_pizza); $x++) 
{
  ?>
  <script>
  transportadora ="<?php print $lista_transportadora[$x]?>"
  quantidade ="<?php print $quantidade_transportadora[$x]?>"
  encontrado = '<?php print $x ?>';
  array_transportadora[encontrado] = transportadora;
  array_quantidade[encontrado] = quantidade;
  console.log(array_quantidade[encontrado]);
  </script>
  <?php

}





if($permite_echo =="1")
{
 echo '<BR>';echo '<BR>';
 print_r($lista_transportadora );
 echo '<BR>';
 print_r($quantidade_transportadora );
 echo 'Quantidade encontrados = ' . $quantidade_array_pizza;
 
 echo 'Motorista: ' . $nome_motorista_mes[$x];
 echo ' - Viajens: '. $quantidade_motorista_mes[$x];
 echo ' - Transpotadora: ' . $transportadora_motorista_mes[$x];
 echo '</BR>';        

 echo '</BR>'; 
 echo '</BR>';
 echo '</BR>'; 

}

?>
<script>
var vezes ='<?php print $quantidade_array_pizza?>';
console.log('Vezes: ' + vezes);
</script>
<?php



?>






<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Motorista", "Numero Viajens",{ role: "style" },{ role: "style" }],
        ['<?php print $nome_motorista[1]?>', <?php print $quantidade_motorista[1] ?>, "#00008B" ,'<?php print $transportadora_motorista[1]?>'],
        ['<?php print $nome_motorista[2]?>', <?php print $quantidade_motorista[2] ?>, "#00008B",'<?php print $transportadora_motorista[2]?>'],
        ['<?php print $nome_motorista[3]?>', <?php print $quantidade_motorista[3] ?>, "#00008B",'<?php print $transportadora_motorista[3]?>'],
        ['<?php print $nome_motorista[4]?>', <?php print $quantidade_motorista[4] ?>, "#00008B",'<?php print $transportadora_motorista[4]?>'],
        ['<?php print $nome_motorista[5]?>', <?php print $quantidade_motorista[5] ?>, "#00008B",'<?php print $transportadora_motorista[5]?>'],
        ['<?php print $nome_motorista[6]?>', <?php print $quantidade_motorista[6] ?>, "#00008B",'<?php print $transportadora_motorista[6]?>'],
        ['<?php print $nome_motorista[7]?>', <?php print $quantidade_motorista[7] ?>, "#00008B",'<?php print $transportadora_motorista[7]?>'],
        ['<?php print $nome_motorista[8]?>', <?php print $quantidade_motorista[8] ?>, "#00008B",'<?php print $transportadora_motorista[8]?>'],
        ['<?php print $nome_motorista[9]?>', <?php print $quantidade_motorista[9] ?>, "#00008B",'<?php print $transportadora_motorista[9]?>'],
        ['<?php print $nome_motorista[10]?>', <?php print $quantidade_motorista[10] ?>, "#00008B",'<?php print $transportadora_motorista[10]?>']
        
      ]);
      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,{ calc: "stringify",sourceColumn: 3,type: "string",role: "annotation" },1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2,3]);
      var options = {
        'chartArea': {'width': '92%', 'height': '50%'},
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
          color: 'black' // Cor das legendas embaixo das colunas
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
        ["Motorista", "Numero Viajens",{ role: "style" },{ role: "style" }],
        ['<?php print $nome_motorista_mes[1]?>', <?php print $quantidade_motorista_mes[1] ?>, "#00008B" ,'<?php print $transportadora_motorista_mes[1]?>'],
        ['<?php print $nome_motorista_mes[2]?>', <?php print $quantidade_motorista_mes[2] ?>, "#00008B",'<?php print $transportadora_motorista_mes[2]?>'],
        ['<?php print $nome_motorista_mes[3]?>', <?php print $quantidade_motorista_mes[3] ?>, "#00008B",'<?php print $transportadora_motorista_mes[3]?>'],
        ['<?php print $nome_motorista_mes[4]?>', <?php print $quantidade_motorista_mes[4] ?>, "#00008B",'<?php print $transportadora_motorista_mes[4]?>'],
        ['<?php print $nome_motorista_mes[5]?>', <?php print $quantidade_motorista_mes[5] ?>, "#00008B",'<?php print $transportadora_motorista_mes[5]?>'],
        ['<?php print $nome_motorista_mes[6]?>', <?php print $quantidade_motorista_mes[6] ?>, "#00008B",'<?php print $transportadora_motorista_mes[6]?>'],
        ['<?php print $nome_motorista_mes[7]?>', <?php print $quantidade_motorista_mes[7] ?>, "#00008B",'<?php print $transportadora_motorista_mes[7]?>'],
        ['<?php print $nome_motorista_mes[8]?>', <?php print $quantidade_motorista_mes[8] ?>, "#00008B",'<?php print $transportadora_motorista_mes[8]?>'],
        ['<?php print $nome_motorista_mes[9]?>', <?php print $quantidade_motorista_mes[9] ?>, "#00008B",'<?php print $transportadora_motorista_mes[9]?>'],
        ['<?php print $nome_motorista_mes[10]?>', <?php print $quantidade_motorista_mes[10] ?>, "#00008B",'<?php print $transportadora_motorista_mes[10]?>']
        
      ]);
      console.log();
      var view = new google.visualization.DataView(data);
      view.setColumns([0,{ calc: "stringify",sourceColumn: 3,type: "string",role: "annotation" },1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2,3]);
      var options = {
        'chartArea': {'width': '92%', 'height': '50%',},
        vAxis: 
        {
         title: '',viewWindow: {min: 0,},alwaysOutside: true,
        },
        hAxis: 
        {
         title: '',viewWindow: {min: 0,},
         slantedText: false, slantedTextAngle: 0, //Posicao do nome nas colunas
         alwaysOutside: true,
         textStyle: 
         {
          textPosition: 'none', 
          fontSize: 10,
          color: 'black' // Cor das legendas embaixo das colunas
         },
        },
        annotations: 
        {
         alwaysOutside: false,
         textStyle: 
         {
          fontSize: 10,
         },
        },
        bar: {groupWidth: "91%"},
        isStacked: false,
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_encerramentos2"));
      chart.draw(view, options);
  }

</script>



<script type="text/javascript" src="./charts_pizza.js"></script>
    <script type="text/javascript">

      
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

     
      

      

      function drawChart() 
      {
       var data = new google.visualization.DataTable();
        
      

       data.addColumn('string', 'Topping');
       data.addColumn('number', 'Slices');
       
      for (let i = 0; i < vezes; i++) 
      {
        data.addRows([[ array_transportadora[i], parseInt(array_quantidade[i]) ]]);
      }
      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
   { calc: "stringify",
   sourceColumn: 1,
   type: "string",
   role: "annotation" }]);
       
      var options = {
        title: "",
        legend: { position: "right" },
        'chartArea': {'width': '85%', 'height': '75%'},
        pieSliceText: 'percentage',
        'is3D':true
      };
       var chart = new google.visualization.PieChart(document.getElementById('grafico_encerramentos3'));
       chart.draw(data, options);
      }



// ********************************************************************************************************************
</script>






<div id="grafico_encerramentos" ></div> 

    
<div id="grafico_encerramentos2"></div> 

<div id="grafico_encerramentos3"></div> 

<label id='titulo1' name='titulo1' >Ranking dos Motoristas referente ao dia <?php print $data ?></label>
<label id='titulo1_1' name='titulo1_1' >Dados atualizados às <?php print $hora ?></label>
<label id='titulo2' name='titulo2' >Ranking dos Motoristas referente ao mês de <?php print $nome_mes ?></label>
<label id='titulo3' name='titulo3' >Transportadoras/Mês</label>
</body>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



<script>

var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= 6)
{
 location.href='./tela_resumo_transportadoras.php?vezes=0$nvezes=2';//Por default passo 2 vezes apenas
}
else
{
 if(link_vezes != '-1')
 {
   window.setTimeout( "location.href=`./tela_resumo_motoristas.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
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
  left: 29%;
  top: 5%;
  font: bold 16pt verdana;
  color:	#000000;
}
LABEL#titulo1_1
{
  position: absolute;
  left: 38%;
  top: 9%;
  font: bold 14pt verdana;
  color:	#00008B;
}
LABEL#titulo2
{
  position: absolute;
  left: 15%;
  top: 54%;
  font: bold 16pt verdana;
  color:	#000000;
}

LABEL#titulo3
{
  position: absolute;
  left: 75%;
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
    width: 65%;
    height: 45%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;
    

}

DIV#grafico_encerramentos3{
    padding-top:20px;
    padding-left: 20px;
    position: absolute;
    left: 69.5%;
    top: 50%;
    width: 27%;
    height: 42.5%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: #F8F8FF;
    

}
IMG#rank1{
    margin-left: 0px;
    position: absolute;
    left: 11%;
    top: 3%;
    width: 160px;
    height: 90px;
    transform: rotate(-4deg);
    cursor: pointer;

}
IMG#rank2{
    margin-left: 0px;
    position: absolute;
    left: 80%;
    top: 3%;
    width: 180px;
    height: 80px;
    cursor: pointer;

}

IMG#rank1_1{
    margin-left: 0px;
    position: absolute;
    left: 11%;
    top: 53%;
    width: 100px;
    height: 30px;
    transform: rotate(-4deg);
    cursor: pointer;

}
IMG#rank2_1{
    margin-left: 0px;
    position: absolute;
    left: 80%;
    top: 53%;
    width: 180px;
    height: 80px;
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