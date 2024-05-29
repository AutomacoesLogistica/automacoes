<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Modelo PHP</title>
</head>
<body>





<?php
include_once 'conexao.php';
$placa = '';


$sql = $dbcon->query("SELECT * FROM historico_display ORDER BY id DESC LIMIT 1");
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
}
else if($placa_carreta != '')
{
 $placa = $placa_carreta;   
}
else
{
 $placa = '0000000';   
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


<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<script>
setTimeout("location.reload(true);",2000); // recarrega a pagina em 5 segundos
</script>



</body>




<style>
body{
    background-color: #708090;
    width:99%;
	height:99%;
}
DIV#placa2{
    position: absolute;
    top: 8%;
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
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 90%;
    font: normal 20pt verdana;
    color:#ffffff;
}


</style>









</html>