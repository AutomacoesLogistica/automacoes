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
	

<div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>



<script>

var graphDiv = document.getElementById('myDiv');

var surface_rows = 207;
var surface_cols = 62;



d3.csv('surface_LIDAR.csv', function(err, surface_rows)
{

 function unpack(surface_rows, surface_cols) 
 {
  return surface_rows.map(function(surface_rows) 
  { 
   return surface_rows[surface_cols]; 
  });
 }


var z_data=[ ]
for(i=0;i<surface_cols;i++)
{
  z_data.push(unpack(surface_rows,i));
}
//console.log(rows);

var data = [{
           z: z_data,
           type: 'surface',
           showscale: true,
           
           
    
        }];
console.log(z_data);
var layout = {
  title: '',
  autosize: false,
  width: 500,
  height: 400,
  margin: {
    l: 50,
    r: 50,
    b: 50,
    t: 50,
  }
};



Plotly.newPlot(graphDiv, data, layout )
});


//Plotly.downloadImage(graphDiv, {format: 'png', width: 800, height: 600, filename: 'newplot'});

//console.log(caminhao);





</script>



</body>

</html>