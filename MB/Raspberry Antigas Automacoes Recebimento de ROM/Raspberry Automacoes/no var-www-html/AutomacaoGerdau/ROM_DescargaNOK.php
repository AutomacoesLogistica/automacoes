<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="pisca();">
<label id="descarga_nok2">Erro processo GSCS! </br>Favor entrar em contato com o CCL!</label>
<label id="descarga_nok">Erro processo GSCS! </br>Favor entrar em contato com o CCL!</label>

   
</body>


<script>
function pisca() {
  var f = document.getElementById('descarga_nok');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 1200);


}
</script>


<style>
LABEL#descarga_nok{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 88pt verdana;
    color: #DC143C;
    left: 3%;
    top: 20%;
    padding: 20px;
    width:90%;
    height:50%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 12px #DC143C solid!important;
}
LABEL#descarga_nok2{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 88pt verdana;
    color: #ffffff;
    left: 3%;
    top: 20%;
    padding: 20px;
    width:90%;
    height:50%;
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