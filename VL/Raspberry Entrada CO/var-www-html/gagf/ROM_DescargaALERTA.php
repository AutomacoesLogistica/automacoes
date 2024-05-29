<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="pisca();">
<label id="descarga_alerta2">ATENÇÃO! </br>Mostre o Cartão!</label>
<label id="descarga_alerta">ATENÇÃO! </br>Mostre o Cartão!</label>

   
</body>


<script>
function pisca() {
  var f = document.getElementById('descarga_alerta');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 900);


}
</script>


<style>
LABEL#descarga_alerta{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 88pt verdana;
    color: #DC143C;
    left: 3%;
    top: 20%;
    padding-top: 40px;
    width:90%;
    height:45%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 12px #DC143C solid!important;
}
LABEL#descarga_alerta2{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 88pt verdana;
    color: #ffffff;
    left: 3%;
    top: 20%;
    padding-top: 40px;
    width:90%;
    height:45%;
    background-color: #DC143C;
    border-radius: 16px!important;
    border: 12px #ffffff solid!important;
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
</html>