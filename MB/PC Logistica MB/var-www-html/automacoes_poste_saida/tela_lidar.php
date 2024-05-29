<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Lidar</title>
    <script src='https://cdn.plot.ly/plotly-2.16.1.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js'></script>

</head>
<body>

<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./dashboard_vl.php?vezes=0'"/>

<script>

var surface_rows = 207;
var surface_cols = 62;

<?php
$id = isset($_GET['id'])?$_GET['id']:'vazio';

if($id != 'vazio')
{
?>
var id = '<?php print $id ?>';

var caminho = '/home/pi/Donwloads/'+id+'_export.csv';

//GRAFICO 2D *************************************************************************************
d3.csv('caminho', function(err, surface_rows){function unpack(surface_rows, surface_cols) {return surface_rows.map(function(surface_rows) { return surface_rows[surface_cols]; });}
var z_data=[ ];
for(i=0;i<surface_cols;i++){z_data.push(unpack(surface_rows,i));}
var data = [{
           z: z_data,
           type: 'contour',
           autocontour: false,
           contours: 
           {
            start: 0,
            end: 3300,
            size: 110
           },
           title: '',
           autosize: true,
           colorbar:
            {
             autotick: false,
             nticks: 30,
             range: [0, 4000],
             
            }
  
 
}];
 var layout = {
  title: '',
  plot_bgcolor:"rgb(53,50,60)",
  paper_bgcolor:"rgb(53,50,60)",
  margin: {
    l: 50,
    r: 50,
    b: 50,
    t: 50,
  },
  font: 
  {
   size: 14,
   color: '#ffffff'
  },
  scene:{
	 aspectmode: "manual",
   aspectratio: {
     x: 5, y: 1.8, z: 1.8,
    },
   xaxis: {
   nticks: 1,
   range: [0, 400],
   backgroundcolor: "rgb(53,50,60)",
     gridcolor: "rgb(53,50,60)",
     showbackground: true,
     zerolinecolor: "rgb(53,50,60)"
   },
   yaxis: {
   nticks: 1,
   range: [0, 60],
   backgroundcolor: "rgb(53,50,60)",
     gridcolor: "rgb(53,50,60)",
     showbackground: true,
     zerolinecolor: "rgb(53,50,60)"
   },
   zaxis: {
   nticks: 1,
   range: [0, 4000],
   backgroundcolor: "rgb(53,50,60)",
     gridcolor: "rgb(53,50,60)",
     showbackground: true,
     zerolinecolor: "rgb(53,50,60)"
  }},
};
var config = {
  toImageButtonOptions: {
    format: 'png', // one of png, svg, jpeg, webp
    filename: 'custom_image',
    height: 500,
    width: 700,
    scale: 1 // Multiply title/legend/axis/canvas sizes by this factor
  }
};
Plotly.newPlot('grafico_encerramentos', data, layout,config,{responsive: true} );
});
//**************************************************************************************************** */
//GRAFIDO 3D

d3.csv('caminho', function(err, surface_rows){function unpack(surface_rows, surface_cols){return surface_rows.map(function(surface_rows){return surface_rows[surface_cols];});}
var z_data=[ ];
for(i=0;i<surface_cols;i++){z_data.push(unpack(surface_rows,i));}
var data = [{

            z: z_data,
            type: 'surface',
            showscale: true,
            colorbar:
            {
             autotick: false,
             nticks: 30,
             range: [0, 4000],
            }
          }];
var layout = {
  title: '',
  font: 
  {
   size: 14,
   color: '#ffffff'
  },
  autosize: true,
  plot_bgcolor:"rgb(53,50,60)",
  paper_bgcolor:"rgb(53,50,60)",
  margin: {
    l: 50,
    r: 50,
    b: 50,
    t: 50,
  },
  scene:{
	 aspectmode: "manual",
   aspectratio: {
     x: 5, y: 1.8, z: 1.8,
    },
   xaxis: {
   nticks: 1,
   range: [0, 400],
   backgroundcolor: "rgb(53,50,60)",
     gridcolor: "rgb(53,50,60)",
     showbackground: true,
     zerolinecolor: "rgb(53,50,60)"
   },
   yaxis: {
   nticks: 1,
   range: [0, 60],
   backgroundcolor: "rgb(53,50,60)",
     gridcolor: "rgb(53,50,60)",
     showbackground: true,
     zerolinecolor: "rgb(53,50,60)"
   },
   zaxis: {
   nticks: 1,
   range: [0, 4000],
   backgroundcolor: "rgb(53,50,60)",
     gridcolor: "rgb(53,50,60)",
     showbackground: true,
     zerolinecolor: "rgb(53,50,60)"
  }},

};
 var config = {
  toImageButtonOptions: {
    format: 'png', // one of png, svg, jpeg, webp
    filename: 'custom_image',
    height: 500,
    width: 700,
    scale: 1 // Multiply title/legend/axis/canvas sizes by this factor
  },
  
};
Plotly.newPlot('grafico_encerramentos2', data, layout,config,{responsive: true} )
});


</script>

<label id='titulo1' name='titulo1' >Representação Tridimensional LIDAR</label>
<div id="grafico_encerramentos" ></div> 

    
<div id="grafico_encerramentos2"></div> 
<div id="grafico_encerramentos3"></div> 


<?php
}
else
{
  echo 'erro';
}
?>


</body>
</html>
<style>

LABEL#titulo1
{
  position: absolute;
  left: 21%;
  top: 2%;
  font: bold 30pt verdana;
  color:	#000080;
}

DIV#grafico_encerramentos{
    margin-left: 0px;
    position: absolute;
    left: 1%;
    top: 32%;
    width: 49%;
    height: 60%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: rgb(53,50,60);

}
DIV#grafico_encerramentos2{
    padding-left: 0px;
    position: absolute;
    left: 51.5%;
    top: 32%;
    width: 46.5%;
    height: 60%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: rgb(53,50,60);
    

}
DIV#grafico_encerramentos3{
    padding-left: 0px;
    position: absolute;
    left: 1%;
    top: 12.3%;
    width: 97%;
    height: 17%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: rgb(53,50,60);
    

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