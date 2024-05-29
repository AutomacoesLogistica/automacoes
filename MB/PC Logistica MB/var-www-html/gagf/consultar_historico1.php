<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Consultando Historico</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body>
<h2>Consultando Historico Motorista</h2>
<br/>
<div>
<form method="post" action="exibir_motorista_1.php">
<?php
    
    $cpf = mb_strtoupper($_GET['documentos'],'UTF8'); 


?>

<input id="cpf" type="text" name="cpf" value="" hidden="hidden">

<input id="enviar" type="submit" value="clique" hidden="hidden">


<br/>
<br/>
<input class="BotaoMenu" type="button" value="Voltar" onclick="clicou()" />
</form>
</div>

<script>
    var vcpf ="<?php print $cpf ?>"
var bcpf = window.document.getElementById('cpf'); 
bcpf.value = vcpf;

    function clicou(){

var clicar = window.document.getElementById('enviar').click();
    }





</script>



</body>


<style>
body{
    text-align: left;
    margin-top: 30px !important;
    margin-left: 60px !important;
}

html{
margin-top: 0px !important;
margin-left: 0px !important;
background: url("./images/q.png");
background-size: 100%;
}



Select#select_motoristas {
     width: 940px;
     height: 26px;
     margin-left: 0px;
     position: absolute;
     left: 80px;
     top: 128px;
     font: normal 9pt verdana;
     color: black;
     background-color: White;
     border-color: #00008B;
     border-style: solid!important;
     cursor: pointer;
}


INPUT.BotaoMenu {
    position: absolute;
     left: 420px;
     top: 30px;
     width: 140px;
     height: 26px;
     font: bold 9pt verdana;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer;
}

fieldset#formulario{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    height: 70px; 
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

INPUT#btnBuscarCadastro{
    font: normal 9pt verdana;
    margin-left: 0px;
    position: absolute;
    left: 1100px;
    top: 128px;
    width:170px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

</style>


<script>



var cpf="";

function buscar()
{
 var valor =  window.document.getElementById("select_motoristas");
 var nome = valor.value;
 var transportadora =  window.document.getElementById("lbTransportadora");
 transportadora.innerHTML = `Transportadora : ${nome}`;





 





}

</script>




</html>
