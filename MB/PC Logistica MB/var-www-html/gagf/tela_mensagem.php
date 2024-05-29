<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<label id="mensagem">Marcação sendo realizada nos controles da UTMI!</label>
   
</body>


<script>
function pisca() {
  var f = document.getElementById('mensagem');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 1000);


}
</script>


<style>
LABEL#mensagem{
    position: absolute;
    text-align:center;
    font: bold 60pt verdana;
    color: #B22222;
    left: 4%;
    top: 30%;
    padding-top: 20px;
    padding-bottom: 0px;
    width:90%;
    height:38%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 8px #B22222 solid!important;
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