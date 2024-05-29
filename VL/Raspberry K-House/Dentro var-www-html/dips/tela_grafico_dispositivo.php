<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>Document</title>
</head>
<body>
  <?php
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
//atualizo dashboard
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("UPDATE atualizacao SET data_atualizacao='$data',hora_atualizacao='$hora' WHERE ponto='Dashboard'");

  ?>
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./tela_dispositivos.php?vezes=0'"/>
<script>

var array_data_hora = [];
var array_condicao = [];


var array_data_hora_antena0 = [];
var array_condicao_antena0 = [];
var array_data_hora_antena1 = [];
var array_condicao_antena1 = [];
var array_data_hora_antena2 = [];
var array_condicao_antena2 = [];
var array_data_hora_antena3 = [];
var array_condicao_antena3 = [];
var array_antena_encontrado01 = [];
var array_epc01 = [];
var array_epc23 = [];
var total_encontrado = 0;

for (var i = 0; i < 1500; i++) 
{
  array_data_hora[i] = 0;  
  array_condicao[i] = 0;
  
  array_data_hora_antena0[i] = 0;
  array_condicao_antena0[i] = 0;
  array_data_hora_antena1[i] = 0;
  array_condicao_antena1[i] = 0;
  array_data_hora_antena2[i] = 0;
  array_condicao_antena2[i] = 0;
  array_data_hora_antena3[i] = 0;
  array_condicao_antena3[i] = 0;
  array_epc01[i] = 'Não identificado!';
  array_epc23[i] = 'Não identificado!';



}

</script>
<?php
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

$v_data = isset($_GET['data'])?$_GET['data']:'vazio';
if($v_data == 'vazio')
{
$v_data = $data; // Caso nao passe, coloca a do momento da consulta!
}

$vdados = explode('/',$v_data);
$mes = $vdados[1];

?>
<script>console.log('<?php print $v_data ?>'); </script>
<?php

$ponto = $_GET['ponto'];
if($ponto == '')
{
    $ponto = 'Entrada_BH';
}

$ponto2 = str_replace('_',' ',$ponto);



include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM atualizacao WHERE ponto='$ponto2' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $numero_antenas = $dados['numero_antenas'];
 $status = $dados['condicao'];
}

if($status == 'OK')
{
 ?>
<img id="status" src="./images/online.png" />
 <?php
}
else
{
 ?>
<img id="status" src="./images/offline.png" />
 <?php
}


?><script>console.log('<?php print $ponto ?>'); </script><?php

$encontrados = 0;
include_once 'conexao_dashboard_dispositivos.php';
$sql = $dbcon->query("SELECT * FROM $ponto WHERE vdata = '$v_data' ORDER BY id DESC LIMIT 1500");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $condicao = strval($dados['condicao']);
  $data_hora = strval($dados['data_hora']);
  $valor_condicao = intval($condicao);
  ?>
  <script>
  total_encontrado = total_encontrado + parseInt('<?php print $valor_condicao ?>');    
  encontrado = '<?php print $encontrados ?>';
  condicao = '<?php print $condicao?>';
  data_hora = '<?php print $data_hora?>';

  array_data_hora[encontrado] = data_hora;
  array_condicao[encontrado] = condicao;
  </script>
  <?php
  $encontrados = intval($encontrados) + 1;
 }
}

$novo_ponto = $ponto.'_01';
$encontrado0 = 0;
$encontrado1 = 0;
$encontrado01 = 0;

include_once 'conexao_dashboard_dispositivos.php';
$sql = $dbcon->query("SELECT * FROM $novo_ponto WHERE vdata ='$v_data' ORDER BY id DESC LIMIT 1500");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $antena = $dados['ponto'];   
  $condicao = $dados['condicao'];
  $data_hora = $dados['data_hora'];
  $epc = $dados['epc'];
  if($epc == ''){$epc = 'Não identificado!';}
  ?>
  <script>
  antena = '<?php print $antena ?>';
  if(antena == 'antena0')
  {
   // antena0
   encontrado01 = '<?php print $encontrado01 ?>';
   condicao = '<?php print $condicao?>';
   data_hora = '<?php print $data_hora?>';
   array_data_hora_antena0[encontrado01] = data_hora;
   array_condicao_antena0[encontrado01] = condicao;
   array_condicao_antena1[encontrado01] = 0;
   array_epc01[encontrado01] = '<?php print $epc ?>';
  }
  else
  {
   //antena1
   encontrado01 = '<?php print $encontrado01 ?>';
   condicao = '<?php print $condicao?>';
   data_hora = '<?php print $data_hora?>';
   array_condicao_antena1[encontrado01] = condicao;
   array_data_hora_antena0[encontrado01] = data_hora;
   array_condicao_antena0[encontrado01] = 0;
   array_epc01[encontrado01] = '<?php print $epc ?>';

  }
  </script>
  <?php
  if($antena == 'antena0')
  {
   // antena0
   $encontrado0 = intval($encontrado0) + 1; 
  }
  else
  {
   //antena1   
   $encontrado1 = intval($encontrado1) + 1; 
  }
  $encontrado01 = intval($encontrado01) + 1;
 } // Fecha while antena 01
} // Fecha if antena 01



if(intval($numero_antenas)>2 )
{
    $novo_ponto = $ponto.'_01';
    $encontrado2 = 0;
    $encontrado3 = 0;
    $encontrado23 = 0;
    
    include_once 'conexao_dashboard_dispositivos.php';
    $sql = $dbcon->query("SELECT * FROM $novo_ponto WHERE vdata='$v_data'   ORDER BY id DESC LIMIT 1500");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      $antena = $dados['ponto'];   
      $condicao = $dados['condicao'];
      $data_hora = $dados['data_hora'];
      $epc = $dados['epc'];
      if($epc == ''){$epc = 'Não identificado!';}
      ?>
      <script>
      antena = '<?php print $antena ?>';
      if(antena == 'antena2')
      {
       // antena2
       encontrado23 = '<?php print $encontrado23 ?>';
       condicao = '<?php print $condicao?>';
       data_hora = '<?php print $data_hora?>';
       array_data_hora_antena2[encontrado23] = data_hora;
       array_condicao_antena2[encontrado23] = condicao;
       array_condicao_antena3[encontrado23] = 0;
       array_epc23[encontrado23] = '<?php print $epc ?>';
      }
      else
      {
       //antena3
       encontrado23 = '<?php print $encontrado23 ?>';
       condicao = '<?php print $condicao?>';
       data_hora = '<?php print $data_hora?>';
       array_condicao_antena3[encontrado23] = condicao;
       array_data_hora_antena2[encontrado23] = data_hora;
       array_condicao_antena2[encontrado23] = 0;
       array_epc23[encontrado23] = '<?php print $epc ?>';
    
      }
      </script>
      <?php
      if($antena == 'antena2')
      {
       // antena2
       $encontrado2 = intval($encontrado2) + 1; 
      }
      else
      {
       //antena3   
       $encontrado3 = intval($encontrado3) + 1; 
      }
      $encontrado23 = intval($encontrado23) + 1;
     } // Fecha while antena 01
    } // Fecha if antena 01
    
}
else
{
 //PLOTA O GRAFICO GERAL DAS LEITURAS
 $novo_ponto = $ponto.'_01';
$encontrado2 = 0;
$encontrado3 = 0;
$encontrado23 = 0;

include_once 'conexao_dashboard_dispositivos.php';
$sql = $dbcon->query("SELECT * FROM $novo_ponto WHERE vdata='$v_data' ORDER BY id DESC LIMIT 1500");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $antena = $dados['ponto'];   
  $condicao = $dados['condicao'];
  $data_hora = $dados['data_hora'];
  $epc = $dados['epc'];
  if($epc == ''){$epc = 'Não identificado!';}
  ?>
  <script>
  antena = '<?php print $antena ?>';
  if(antena == 'antena2')
  {
   // antena2
   encontrado23 = '<?php print $encontrado23 ?>';
   condicao = '<?php print $condicao?>';
   data_hora = '<?php print $data_hora?>';
   array_data_hora_antena2[encontrado23] = data_hora;
   array_condicao_antena2[encontrado23] = condicao;
   array_condicao_antena3[encontrado23] = 0;
   array_epc23[encontrado23] = '<?php print $epc ?>';
  }
  else
  {
   //antena3
   encontrado23 = '<?php print $encontrado23 ?>';
   condicao = '<?php print $condicao?>';
   data_hora = '<?php print $data_hora?>';
   array_condicao_antena3[encontrado23] = condicao;
   array_data_hora_antena2[encontrado23] = data_hora;
   array_condicao_antena2[encontrado23] = 0;
   array_epc23[encontrado23] = '<?php print $epc ?>';

  }
  </script>
  <?php
  if($antena == 'antena2')
  {
   // antena2
   $encontrado2 = intval($encontrado2) + 1; 
  }
  else
  {
   //antena3   
   $encontrado3 = intval($encontrado3) + 1; 
  }
  $encontrado23 = intval($encontrado23) + 1;
 } // Fecha while antena 01
} // Fecha if antena 01
   
}



?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">


if(parseInt(total_encontrado)>0)
{
 //alert('Existem dados!');
 
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      

var encontrado = <?php print $encontrados ?>;
//alert(total_encontrado);
      function drawChart() 
      {
       

       var dataRows = [['Date Hora', 'Ping ( ms )']];
       console.log('<?php print $encontrados?>'); 
       var x = 0;
       for (var i = 1; i < <?php print $encontrados ?>; i++) 
       {
        x = parseInt(<?php print $encontrados ?>)-i; 
       // console.log(x+' - ' + i + ' Valor array :' + array_data_hora[x]+ ' : ' + array_condicao[x]);
        dataRows.push([ array_data_hora[x], parseFloat(array_condicao[x])]);
       }

       var line_data = google.visualization.arrayToDataTable(dataRows);

    




       
        var options = {
          title: '','chartArea': {'width': '85%', 'height': '50%'},
          legend: {position: 'top', textStyle: {color: '#ffffff', fontSize: 16}},
          backgroundColor: 'rgb(0,0,0)',
          vAxis: 
          {
           textStyle: {color: '#ffffff', fontSize: 16}
          },
          hAxis: 
          {
           slantedText: true, slantedTextAngle: 45, //Posicao do nome nas colunas
           textStyle: 
           {
            textPosition: 'none', 
            fontSize: 8,
            color: 'none' // Cor das legendas embaixo das colunas
           },
          },
          explorer: 
          {
           axis: 'horizontal',
           keepInBounds: true,
           maxZoomIn: 14.0
          },
        };

        var chart = new google.visualization.AreaChart(document.getElementById('grafico_1'));
        chart.draw(line_data, options);
      }


}
else
{
 //alert('Nao existem dados!');



}




</script>









<!-- GRAFICO ANTENA 0 E 1 -->



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">


if(parseInt(total_encontrado)>0)
{
 //alert('Existem dados!');   
 google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      

var encontrado01 = <?php print $encontrado01 ?>;
//alert(encontrado01);


      function drawChart() 
      {
        // A column for custom tooltip content
       
           
       
        var dataRows = [['Date Hora', 'Antena 0',{type: 'string', role: 'tooltip', 'p': {'html': true}},'Antena 1',{type: 'string', role: 'tooltip', 'p': {'html': true}}]];
        
        
       var x = 0;

       for (var i = 1; i < <?php print $encontrado01 ?>; i++) 
       {
        x = parseInt(<?php print $encontrado01 ?>) -i; 
        dataRows.push([ array_data_hora_antena0[x],parseFloat(array_condicao_antena0[x]),'<B>Data/Hora: </B>' + array_data_hora_antena0[x] + '</BR><B>N° Leituras Ant 0: </B>' + parseFloat(array_condicao_antena0[x]) + '</BR><B>EPC: </B>' + array_epc01[x] ,parseFloat(array_condicao_antena1[x]),'<B>Data/Hora: </B>' + array_data_hora_antena0[x] + '</BR><B>N° Leituras Ant 1 : </B>' + parseFloat(array_condicao_antena1[x]) + '</BR><B>EPC: </B>' + array_epc01[x]]);

       }
      
      
    
     
      
       var line_data = google.visualization.arrayToDataTable(dataRows);

    




       
        var options = {
          title: '',
         
          'chartArea': {'width': '85%', 'height': '50%'},
          legend: {position: 'top', textStyle: {color: '#ffffff', fontSize: 16}},
          bar: {groupWidth: "90%"},
          
          backgroundColor: 'rgb(0,0,0)',
          explorer: {
            axis: 'horizontal',
            keepInBounds: true,
            maxZoomIn: 40.0
          },
          vAxis: {textStyle: {color: '#ffffff', fontSize: 16}},
          hAxis: {
      slantedText: true, slantedTextAngle: 45, //Posicao do nome nas colunas
      textStyle: {
        fontSize: 8,
        color: 'none' // Cor das legendas embaixo das colunas
      },
    },
       tooltip: 
       {
        isHtml: true
        
       },
  
  };
        
        


        var chart = new google.visualization.AreaChart(document.getElementById('grafico_antena_01'));
        
        chart.draw(line_data, options);
      }



}
else
{
 //alert('Não existem dados!');   
}

</script>






<!-- GRAFICO ANTENA 2 E 3 -->



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

if(parseInt(total_encontrado)>0)
{
 //alert('Existem dados!');   
 google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
      





      function drawChart() 
      {
       

       var dataRows = [['Date Hora','Antena 0','Antena 1', 'Referência','Leituras',{type: 'string', role: 'tooltip', 'p': {'html': true}}]];
       var x = 0;
       for (var i = 1; i < <?php print $encontrado23 ?>; i++) 
       {
        x = parseInt(<?php print $encontrado23 ?>)-i;  
        dataRows.push([ array_data_hora_antena2[x],0,0,parseFloat(array_condicao_antena2[x]),parseFloat(array_condicao_antena3[x]),'<B>Data/Hora: </B>' + array_data_hora_antena2[x] + '</BR><B>N° Leituras : </B>' + parseFloat(array_condicao_antena3[x]) + '</BR><B>EPC: </B>' + array_epc23[x]]);

       }

       var line_data = google.visualization.arrayToDataTable(dataRows);

    


       var numero_antenas = '<?php print $numero_antenas ?>';
       if(parseInt(numero_antenas)>2)
       {
        var options = {
          title: '',
         
          'chartArea': {'width': '85%', 'height': '50%'},
          legend: { position: 'top' },
          bar: {groupWidth: "90%"},
          
          backgroundColor: 'rgb(0,0,0)',
          vAxis: {textStyle: {color: '#ffffff', fontSize: 16}},
    hAxis: {
      slantedText: true, slantedTextAngle: 45, //Posicao do nome nas colunas
      textStyle: {
        fontSize: 8,
        color: 'none' // Cor das legendas embaixo das colunas
      },
    },
      
    tooltip: 
       {
        isHtml: true
        
       },
       explorer: {
            axis: 'horizontal',
            keepInBounds: true,
            maxZoomIn: 40.0
          },
        };
       }
       else
       {
        var options = {
          title: '',
         
          'chartArea': {'width': '85%', 'height': '50%'},
          legend: {position: 'none'}, 
          bar: {groupWidth: "90%"},
          
          backgroundColor: 'rgb(0,0,0)',
          vAxis: {textStyle: {color: '#ffffff', fontSize: 16}},
         
         
    hAxis: {
      slantedText: true, slantedTextAngle: 45, //Posicao do nome nas colunas
      textStyle: {
        fontSize: 8,
        color: 'none' // Cor das legendas embaixo das colunas
      },
    },
    tooltip: 
       {
        isHtml: true
        
       },
       explorer: {
            axis: 'horizontal',
            keepInBounds: true,
            maxZoomIn: 40.0
          }, 
        
        };
       }
       
       

        var chart = new google.visualization.AreaChart(document.getElementById('grafico_antena_23'));
        chart.draw(line_data, options);
      }



}
else
{
  //alert('Não existem dados!);  
}

    </script>




<div id='fundo'></div>
<div id="grafico_1" ></div>
<div id="grafico_antena_01" ></div>
<div id="grafico_antena_23" ></div>
<label id='titulo1' name='titulo1' >Disponibilidade do ponto <?php print $ponto2 ?> - Dados do dia <?php print $v_data?></label>
<label id='titulo2' name='titulo2' >Disponibilidade das antenas 0 e 1 <?php print $ponto2 ?></label>

<?php
if(intval($numero_antenas)>2)
{
 ?>   
<label id='titulo3' name='titulo3' >Disponibilidade das antenas 2 e 3 <?php print $ponto2 ?></label>
<?php
}
else
{
 ?>   
<label id='titulo3' name='titulo3' >Leituras das antenas do ponto <?php print $ponto2 ?></label>
<?php
}
?>
    


<?php
if($status == 'OK')
{
 ?>
<img id="status" src="./images/online.png" />
 <?php
}
else
{
 ?>
<img id="status" src="./images/offline.png" />
 <?php
}

?>

<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>


<?php
$vdata = explode('/',$v_data);
$mes_a = $vdata[1];
$mes_s = $vdata[1];
$ano = $vdata[2];

$novo_dia_anterior = (intval($vdata[0])-1);
$novo_dia_superior = (intval($vdata[0])+1);


if(intval($novo_dia_anterior)<9)
{
  $novo_dia_anterior = '0'.$novo_dia_anterior;
}
if($novo_dia_anterior==00)
{
  //Volto um dia e um mes
  $novo_dia_anterior = 31; //Mesmo que o mes nao tenha, so voltar mais um dia
  
  
  $mes_a = intval($mes_a)-1;
  if(intval($mes_a)<9)
  {
   $mes_a = '0'.$mes_a; 
  }

}

if($novo_dia_superior==32)
{
  //Almento um dia e um mes
  $novo_dia_superior = 01; //Mesmo que o mes nao tenha, so voltar mais um dia
  
  
  $mes_s = intval($mes_s)+1;
  if(intval($mes_s)<9)
  {
   $mes_s = '0'.$mes_s; 
  }

  if(intval($novo_dia_superior)<9)
  {
    $novo_dia_superior = '0' . intval($novo_dia_superior);
  }
  
}






$nova_data_consulta_anterior = $novo_dia_anterior.'/'.$mes_a.'/'.$ano;
$nova_data_consulta_superior = $novo_dia_superior.'/'.$mes_s.'/'.$ano;
?>
<script>console.log('<?php print $nova_data_consulta ?>');</script>
<img id="voltar_data" src="./images/voltar.png"  onclick="javascript: location.href='./teste_grafico_dispositivo.php?ponto=<?php print $ponto?>&data=<?php print $nova_data_consulta_anterior?>'"/>
<img id="avancar_data" src="./images/avancar.png"  onclick="javascript: location.href='./teste_grafico_dispositivo.php?ponto=<?php print $ponto?>&data=<?php print $nova_data_consulta_superior?>'"/>

<style>
DIV#fundo{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 2%;
    width: 95%;
    height: 91.5%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: 	'trasnparent';

}
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
  left: 28%;
  top: 7%;
  font: bold 16pt verdana;
  color:	#ffffff;
}

DIV#grafico_1{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 5%;
    width: 92%;
    height: 28%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    background-color: #F8F8FF;

}


DIV#grafico_antena_01{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 34%;
    width: 92%;
    height: 28%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    background-color: #F8F8FF;

}




LABEL#titulo2
{
  position: absolute;
  left: 35%;
  top: 36%;
  font: bold 16pt verdana;
  color:	#ffffff;
}


DIV#grafico_antena_23{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 63%;
    width: 92%;
    height: 28%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    background-color: #F8F8FF;

}
LABEL#titulo3
{
  position: absolute;
  left: 35%;
  top: 65%;
  font: bold 16pt verdana;
  color:	#ffffff;
}


IMG#voltar_data{
    margin-left: 0px;
    position: absolute;
    left: 80.5%;
    top: 7%;
    width: 40px;
    height: 30px;
    cursor: pointer;

}



IMG#avancar_data{
    margin-left: 0px;
    position: absolute;
    left: 83.5%;
    top: 7%;
    width: 40px;
    height: 30px;
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

IMG#status{
    margin-left: 0px;
    position: absolute;
    left: 91%;
    top: 6%;
    width: 90px;
    height: 40px;
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





.google-visualization-tooltip { 

width: 250px;
height: 45px;
padding: 12px;
padding-left: 20px;
border: none !important;
border-radius: 5px !important;
background-color: #B0C4DE;
position: absolute !important;
font-size:  16px !important;

}



</style>



</body>
</html>





