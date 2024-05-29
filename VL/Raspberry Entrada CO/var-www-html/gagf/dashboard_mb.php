<!DOCTYPE html>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="./charts_pizza.js"></script>
    <script type="text/javascript">

      
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


      var Reader = "Pires";
      var Quantidade = 0;
      



      function drawChart() 
      {
       var data = new google.visualization.DataTable();
       data.addColumn('string', 'Topping');
       data.addColumn('number', 'Slices');
       data.addRows([
        [Reader, Quantidade],
        ['Entrada UTMII', 1],
        ['Abertura 1', 1],
        ['Abertura 2', 3],
        ['Patio Produto', 1],
        ['Saida UTMII', 2]
      ]);
       var options = {'title':'Carregamento Miguel Burnier','width':1100,'height':700};
       var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
       chart.draw(data, options);
      }



// ********************************************************************************************************************


      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() 
      {
       var data2 = new google.visualization.DataTable();
       data2.addColumn('string', 'Topping2');
       data2.addColumn('number', 'Slices2');
       data2.addRows([
        ['Entrada Recebimento ROM', 1],
        ['Saida Recebimento ROM', 2]
       ]);
       var options2 = {'title':'Recebimento ROM Miguel Burnier','width':1100,'height':700};
       var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
       chart2.draw(data2, options2);
      }


    </script>
  </head>

  <body>
   
    <div id="chart_div0" style="width:1100; height:1000"></div>
    <div id="chart_div" style="width:1100; height:1000"></div>
    <div id="chart_div2" style="width:1100; height:1000"></div>
  </body>
</html>