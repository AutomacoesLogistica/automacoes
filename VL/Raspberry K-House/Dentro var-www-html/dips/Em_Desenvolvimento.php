<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<label id="descarga_nova">Em Desenvolvimento!</label>
   
</body>


<script>
function pisca() {
  var f = document.getElementById('descarga_nova');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 1000);


}
</script>


<style>
LABEL#descarga_nova{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 70pt verdana;
    color: #DC143C;
    left: 5%;
    top: 30%;
    padding-top: 40px;
    width:90%;
    height:28%;
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