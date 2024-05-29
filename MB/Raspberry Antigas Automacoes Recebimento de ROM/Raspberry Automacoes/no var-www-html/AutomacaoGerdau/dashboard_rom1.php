<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/index.js" type="text/javascript"></script>
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="GENERATOR" content="MAX's HTML Beauty++ ME">
    

    <!--Load the AJAX API-->
    <script type="text/javascript" src="./charts_pizza.js"></script>
    
      
    
    <title>Document</title>
</head>

<body onload="setInterval('tempo();',200)">
<form id="formulario" hidden='hidden'>
<input type="text" name="mensagem" id="mensagem" value='mensagem'/>
<input id='consulta' type=button name='consulta' value='Buscar'/>
</form>


<label name="resposta" id="resposta" ></label>


<script>
var ultima_mensagem = "--";
 
var dentro = 1;
var limite = 1;

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
 
 
function tempo()
 {
  document.getElementById("consulta").click();
  var link = document.getElementById("resposta");
  var valor = link.innerHTML;
  var mensagem = valor.split(',');
  var valor0 = mensagem[0];  
 var valor1 = mensagem[1]; 
 
 dentro = parseInt(valor0);
 limite = parseInt(valor1);
 
 drawChart();
} 
 
 



      
 function drawChart() 
 {

  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Topping');
  data.addColumn('number', 'Slices');
  data.addRows([
   ['Dentro do Pátio', limite],
   ['Limite do Pátio', dentro]
  ]);
  var options = {'title':'Recebimento ROM Miguel Burnier','width':1100,'height':700};
  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
  chart.draw(data, options);
 }

 

 $(document).ready(function (){
    $("#consulta").click(function (){
       var form = new FormData($("#formulario")[0]);
       $.ajax({
           url: 'dashboard_rom2.php',
           type: 'POST',
           dataType: 'html',
           cache: false,
           processData: false,
           contentType: false,
           data: form,
           timeout: 8000,
           success: function(resultado){
               $("#resposta").html(resultado);
           }
       });
    });
});



</script>


<div id="chart_div" style="width:1100; height:1000"></div>
</body>

<style>
DIV#relogio{
    background-color: red;
}

DIV#resposta{
    background-color: green;
    position: absolute;
    top:20%;
    left: 10%;
    width: 200px;
    height: 80px;

}
IFRAME#tela{
    margin-left: 0px;
    position: absolute;
    left: 0px;
    top: 0px;
    width: 99.7%;
    height: 99.4%;
    

}
</style>
</HTML>