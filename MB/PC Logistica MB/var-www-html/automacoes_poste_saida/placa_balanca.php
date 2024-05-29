<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Placa Balanca</title>
</head>
<body>





<?php
include_once 'conexao.php';
$placa = '';
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$tipo  ='';

$sql = $dbcon->query("SELECT * FROM historico_display WHERE ponto='balanca' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $placa_cavalo =$dados['placa_cavalo'];
  $placa_carreta = $dados['placa_carreta'];
  
 }
} 

if($placa_cavalo != '')
{
 $placa = $placa_cavalo;   
 $tipo = 'Placa do cavalo!';
}
else if($placa_carreta != '')
{
 $placa = $placa_carreta;   
 $tipo = 'Placa da carreta!';
}
else
{
 $placa = '0000000';  
 $tipo = ''; 
}



$placa_1 = substr($placa,0,1);
$placa_2 = substr($placa,1,1);
$placa_3 = substr($placa,2,1);
$placa_4 = substr($placa,3,1);
$placa_5 = substr($placa,4,1);
$placa_6 = substr($placa,5,1);
$placa_7 = substr($placa,6,1);

$caminho = "./images/placas/";



?>
<div id="placa2">
<img id='placa_fundo' src='./images/placas/placa_fundo.png'/>


<img src=<?php print $caminho.$placa_1.".png"?> id="placa1"/>
<img src=<?php print $caminho.$placa_2.".png"?> id="placa2"/>
<img src=<?php print $caminho.$placa_3.".png"?> id="placa3"/>
<img src=<?php print $caminho.$placa_4.".png"?> id="placa4"/>
<img src=<?php print $caminho.$placa_5.".png"?> id="placa5"/>
<img src=<?php print $caminho.$placa_6.".png"?> id="placa6"/>
<img src=<?php print $caminho.$placa_7.".png"?> id="placa7"/>

</div>

<div id='tarjeta'></div>

<h3 id="lb_titulo">Saida Balança 01 - Balança </h3>
<h3 id="lb_hora"><?php print $data . ' ' . $hora ?> </h3>
<h3 id="lb_info"><?php print $tipo ?> </h3>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<script>
setTimeout("location.reload(true);",1000); // recarrega a pagina em 5 segundos
</script>



</body>




<style>
body{
    background-color: #C0C0C0;
    width:99%;
	height:99%;
}
DIV#placa2{
    position: absolute;
    top: 22%;
    left: 16%;
    background-color: transparent;
    width: 70%;
    height:60%;

}
IMG#placa_fundo{
    position: absolute;
    top: 0%;
    left: 0%;
    background-color: transparent;
    width: 100%;
    height:100%;

}
IMG#placa1{
    position: absolute;
    top: 41%;
    left: 7%;
    background-color: transparent;
    width: 13%;
    height:49%;

}
IMG#placa2{
    position: absolute;
    top: 41%;
    left: 21%;
    background-color: transparent;
    width: 13%;
    height:49%;

}
IMG#placa3{
    position: absolute;
    top: 41%;
    left: 35%;
    background-color: transparent;
    width: 13%;
    height:49%;

}
IMG#placa4{
    position: absolute;
    top: 41%;
    left: 48%;
    background-color: transparent;
    width: 13%;
    height:49%;

}
IMG#placa5{
    position: absolute;
    top: 41%;
    left: 60%;
    background-color: transparent;
    width: 13%;
    height:49%;

}
IMG#placa6{
    position: absolute;
    top: 41%;
    left: 71%;
    background-color: transparent;
    width: 13%;
    height:49%;

}
IMG#placa7{
    position: absolute;
    top: 41%;
    left: 82%;
    background-color: transparent;
    width: 13%;
    height:49%;

}
#lb_titulo{
    margin-left: 0px;
    position: absolute;
    left: 17%;
    top: -3%;
    font: bold 50pt verdana;
    color: #0000CD;
}
#lb_hora{
    margin-left: 0px;
    position: absolute;
    left: 34%;
    top: 10%;
    font: bold 30pt verdana;
    color:#FFFFFF;
}
DIV#tarjeta{
    position: absolute;
    top: 41%;
    left: 22%;
    background-color: #A9A9A9;
    width: 62%;
    height:8.2%;

}
#lb_info{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 38%;
    font: bold 27pt verdana;
    color:#000000;
}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 90%;
    font: normal 20pt verdana;
    color:rgba(0,0,0,0.3);
}

</style>









</html>