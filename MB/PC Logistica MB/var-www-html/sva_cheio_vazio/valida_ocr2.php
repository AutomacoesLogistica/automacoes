<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      
      var data = google.visualization.arrayToDataTable([
        ['Dia', 'Turno1', 'Turno2', 'Turno3'n],
        ['2010', 5, 4, 2,'',9],
        ['2020', 6, 2, 5,'',3],
        ['2030', 8, 3, 4,'',3]
      ]);

      var options = {
        legend: { position: 'top', maxLines: 120 },
        bar: { groupWidth: '75%' },
        isStacked: true,
        
      };
      var view = new google.visualization.DataView(data);
      //view.setColumns([0, 1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2,{ calc: "stringify",sourceColumn: 2,type: "string",role: "annotation" },3,{ calc: "stringify",sourceColumn: 3,type: "string",role: "annotation" },2,{ calc: "stringify",sourceColumn: 4,type: "string",role: "annotation" }]);

     
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="columnchart_values"></div>
</body>
</html>
<style>

DIV#columnchart_values{
    margin-left: 0px;
    position: absolute;
    left: 20px;
    top: 20px;
    
    background-color: transparent;
    width: 800px;
    height: 500px;
    

}

</style>

