<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste 3D Plotly</title>
	<!-- Load plotly.js into the DOM -->
	<script src='https://cdn.plot.ly/plotly-2.16.1.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js'></script>
</head>

<body>
	<div id='garfico_2d'><!-- Plotly chart will be drawn inside this DIV --></div>



<script>

var surface_rows = 207;
var surface_cols = 62;
d3.csv('surface_LIDAR.csv', function(err, surface_rows){
function unpack(surface_rows, surface_cols) {
  return surface_rows.map(function(surface_rows) { return surface_rows[surface_cols]; });
}


var z_data=[ ]
for(i=0;i<surface_cols;i++)
{
  z_data.push(unpack(surface_rows,i));
}
//console.log(rows);

var data = [{
           z: z_data,
           type: 'contour',
           
        }];
//console.log(z_data);
var layout = {
  title: '',
  autosize: true,
  width: 700,
  height: 450,
  margin: {
    l: 95,
    r: 95,
    b: 95,
    t: 95,
  }
};







Plotly.newPlot('garfico_2d', data, layout);
});


//console.log(caminhao);






</script>





</body>

</html>