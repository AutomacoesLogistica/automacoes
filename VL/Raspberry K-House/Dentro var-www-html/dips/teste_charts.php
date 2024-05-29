<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<div class="box-body">
    <table class="columns">
        <tr>
            <td>
                <div class="col-md-6" id="piechart_div"></div>
            </td>
            <td>
                <div class="col-md-6" id="donutchart_div"></div>
            </td>
        </tr>
    </table>
</div>

<script>

google.charts.load('current', {packages:['corechart']}).then(function (){
  
      var result = [
        {name: 'defect 12', defects: '1'},
        {name: 'defect 2', defects: '2'},
        {name: 'defect 32', defects: '3'},
        {name: 'defect 4', defects: '4'},
        {name: 'defect 5', defects: '5'}
      ];

    drawChart(result);
  
  

  function drawChart(result) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('number', 'defects');

    var dataArray = [];

    $.each(result, function(i, obj) {
      dataArray.push([obj.name, parseInt(obj.defects)]);
    });

    data.addRows(dataArray);

    var piechart_options = {
      title : 'Defects Registered',
      width : 500,
      height: 300,
      is3D: true,
    };
    var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
    piechart.draw(data, piechart_options);
  }
});
</script>
</body>
</html>
