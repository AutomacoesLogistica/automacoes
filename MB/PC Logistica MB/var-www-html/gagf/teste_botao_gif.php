<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Modelo PHP</title>
</head>
<body>
<input type="submit" name="teste" value="Visivel" onclick="teste_gif()"/>
<input type="submit" name="teste" value="Ocultar" onclick="teste_gif2()"/></br></br></br></br></br>
<div id="carregando">
<img id="gif_carregando" src="./images/carregando.gif" />
</div>
<script>
function teste_gif()
{
 window.document.getElementById('carregando').style.visibility = "visible";
 
}
function teste_gif2()
{
 window.document.getElementById('carregando').style.visibility = "hidden";
 
}
window.document.getElementById('carregando').style.visibility = "hidden";

setTimeout(teste_gif, 2000); // chama o function apos 2 segundos ja iniciado

</script>

<?php


?>


</body>




<style>
body{
    background-color: #87CEEB;
}
DIV#carregando{
    margin-left: 0px;
    position: absolute;
    left: 0%;
    top: 0px;
    width: 100%;
    height: 100%;
    background-color:rgba(192,192,192,.6);
}
IMG#gif_carregando{
    margin-left: 0px;
    position: absolute;
    left: 50%;
    top: 50%;
    width: 50px;
    height: 50px;
}
</style>









</html>