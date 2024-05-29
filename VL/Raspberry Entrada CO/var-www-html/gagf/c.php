<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Document</title>
</head>
<body>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart_transportadora);
    var array_transportadora = [];
    var array_quantidade = [];

    var transportadora = "";
    var encontrado = 0;
    for (i=0;i<20;i++)
    {
     array_trasnportadora[i]=0;
     array_quantidade[i] = 0;
    }
   
    
    

function drawChart_transportadora()
{   
    <?php
    include "conexao.php";
    $encontrado = 0;
    $sql = $dbcon->query("SELECT * FROM transportadoras");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      $transportadora = $dados['sigla'];
      $encontrado = $encontrado+1;
      ?>
      
      transportadora ="<?php print $transportadora ?>"
      encontrado ="<?php print $encontrado ?>"
      array_transportadora[encontrado] = transportadora;
      <?php
     }//Fecha while
    }//Fecha if
    ?> 
    //alert(array_transportadora[1]);
      var cor_azul = "#00008B";
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        [array_transportadora[1], array_quantidade[1],cor_azul],
        [array_transportadora[2], 5,cor_azul],
        [array_transportadora[3], 5,cor_azul],
        [array_transportadora[4], 5,cor_azul],
        [array_transportadora[5], 5,cor_azul],
        [array_transportadora[6], 5,cor_azul],
        [array_transportadora[7], 5,cor_azul],
        [array_transportadora[8], 5,cor_azul],
        [array_transportadora[9], 5,cor_azul],
        [array_transportadora[10], 5,cor_azul]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Lista Excesso Por Transportadora",
        width: 595,
        height: 430,
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
      };
      var chart_transportadora = new google.visualization.BarChart(document.getElementById("chart_div4"));
      chart_transportadora.draw(view, options);
  }
  </script>
<div id="chart_div4" style="width: 900px; height: 300px;"></div>
</body>
</html>