<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="pisca();">
<!--  <label id="descarga_nok">Favor entrar em contato com o CCL!</label>      -->

<label id="descarga_ok">Descarga Liberada!</label>      
<label id="info">Pátio cheio, </br> favor aguardar!</label>      
   
</body>


<script>
function pisca() {
  var f = document.getElementById('descarga_ok');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 1000);


}
</script>


<style>

LABEL#descarga_ok{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 88pt verdana;
    color:#ffffff;
    left: 4%;
    top: 5%;
    padding-top: 30px;
    width:90%;
    height:24%;
    background-color: #32CD32;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}

LABEL#info{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 100pt verdana;
    color:#DC143C;
    left: 4%;
    top: 40%;
    padding-top: 20px;
    width:90%;
    height:50%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 12px #DC143C solid!important;
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