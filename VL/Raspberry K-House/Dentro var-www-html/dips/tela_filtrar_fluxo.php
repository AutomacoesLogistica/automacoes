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
<img id="voltar" src="./images/btn_voltar.png"  onclick="javascript: location.href='./tela_dispositivos.php?vezes=0'"/>
<?php
//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
//atualizo dashboard
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("UPDATE atualizacao SET data_atualizacao='$data',hora_atualizacao='$hora' WHERE ponto='Dashboard'");

?>




<div id='fundo'></div>
<div id="filtros" ></div>
<div id="tela_dados" ></div>
<div id="grafico_antena_23" ></div>
<label id='titulo1' name='titulo1' >Selecione os dados para filtro </label>
<label id='titulo2' name='titulo2' >Disponibilidade das antenas 0 e 1</label>

<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>





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

DIV#filtros{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 5%;
    width: 92%;
    height: 24%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    background-color: #000000;

}


DIV#tela_dados{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 32%;
    width: 92%;
    height: 59%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 3px #000000 solid!important;
    background-color: #000000;

}




LABEL#titulo2
{
  position: absolute;
  left: 35%;
  top: 36%;
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





