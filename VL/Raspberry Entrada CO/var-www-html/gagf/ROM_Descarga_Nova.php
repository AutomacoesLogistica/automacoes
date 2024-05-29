<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<label id="descarga_nova">Favor aguardar a validação!</label>
   
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
    font: bold 88pt verdana;
    color: #DC143C;
    left: 3%;
    top: 30%;
    padding: 20px;
    width:90%;
    height:38%;
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