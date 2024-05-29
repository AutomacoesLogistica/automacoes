<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerdau :: GAGF - Bruno Gonçalves</title>
    <link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">


<!-- script relogio -->

<script>
var hms1 = '02:22:42';   // your input string
var clockid=new Array()
var clockidoutside=new Array()
var i_clock=-1
var thistime= new Date()
var hours=thistime.getHours()
var minutes=thistime.getMinutes()
var seconds=thistime.getSeconds()
if (eval(hours) <10) {hours="0"+hours}
if (eval(minutes) < 10) {minutes="0"+minutes}
if (seconds < 10) {seconds="0"+seconds}
var thistime = hours+":"+minutes+":"+seconds


function ativa_cronometro()
{
    hms1 = '09:22:42'; // Altera a hora do cronometro
   

}

function clockon()
{
    
    thistime= new Date()
    hours=thistime.getHours()
    minutes=thistime.getMinutes()
    seconds=thistime.getSeconds()
    if (eval(hours) <10) {hours="0"+hours}
    if (eval(minutes) < 10) {minutes="0"+minutes}
    if (seconds < 10) {seconds="0"+seconds}
    thistime = hours+":"+minutes+":"+seconds
    document.getElementById('v_hora').innerHTML = thistime;
    
    var a1 = hms1.split(':'); // split it at the colons
  // minutes are worth 60 seconds. Hours are worth 60 minutes.
  var seconds1 = (+a1[0]) * 60 * 60 + (+a1[1]) * 60 + (+a1[2]); 

  var hms = thistime;   // your input string
  var a = hms.split(':'); // split it at the colons
  // minutes are worth 60 seconds. Hours are worth 60 minutes.
  var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 

  var diferenca = seconds-seconds1;

  var diferenca_h = parseInt(diferenca/3600);
  if(diferenca_h <10)
  {
   diferenca_h = '0'+diferenca_h.toString();   
  }
  var diferenca_m = parseInt((parseInt(diferenca)-parseInt(diferenca_h*3600))/60);
  if(diferenca_m <10)
  {
   diferenca_m = '0'+diferenca_m.toString();   
  }

  var diferenca_s = diferenca-(parseInt(diferenca_h*3600)+diferenca_m*60);
  if(diferenca_s <10)
  {
   diferenca_s = '0'+diferenca_s.toString();   
  }

 var diferenca_resultado = diferenca_h + ':'+diferenca_m + ':' + diferenca_s;
  //console.log(diferenca_resultado);
  document.getElementById('tempo_vale').innerHTML = diferenca_resultado;
  document.getElementById('tempo_gerdau').innerHTML = diferenca_resultado;

  var timer=setTimeout("clockon()",1000);
}
window.onload=clockon;
</script>

<!-- script relogio -->








</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`menu_gestao_gagf.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.PNG" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>

<?php
// Busca o usuario passado e verifica no sistema
$usuario = "";
$tipo = "";
$criptografia = "";
$usuario_criptografado = "";
include_once 'conexao2.php';
$complemento = $_GET['complemento'];
$check = $_GET['check'];
$registro = (floatval($complemento))/1.5;
$nome = "";
// Desfazendo a criptografia
for ($i=0; $i < strlen($check)-1; $i+=2)
{
 $nome .= chr(hexdec($check[$i].$check[$i+1]));
}

$sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro' AND nome='$nome'");
if(mysqli_num_rows($sql)>0){
while($dados = $sql->fetch_array()){
$usuario = $dados['nome'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
$tipo = $dados['tipo_usuario'];
$criptografia = $dados['criptografia'];
}
// deixa rodar
?>
<script>
var usuario = window.document.getElementById('colaborador');
var colaborador = "<?php print $usuario ?>";
usuario.innerHTML = "Usuario : "  + colaborador;
var lfuncao = window.document.getElementById('funcao');
var funcao = "<?php print $tipo ?>";
lfuncao.innerHTML = "Perfil : " + funcao;
var lusuario_criptografado = "<?php print $check ?>";
var link_criptografia = window.document.getElementById('criptografia');
link_criptografia.value = lusuario_criptografado;
var lcriptografia = "<?php print $criptografia ?>";
var link_criptografia2 = window.document.getElementById('criptografia2');
link_criptografia2.value = lcriptografia;
</script>
<?php


}else{
?>
<script language="JavaScript">
//window.Notification="Senha Incorreta!";
//window.location="login.php";
</script>
<?php
}
?>
<center>


<div id='entrada'>
<img id='foto_rua' src="./images/rua3.png" alt="">
<img id='foto_patrag' src="./images/patrag_ocupado.png" alt="">
<img id='trilho' src="./images/trilho.png" alt="">
<img id='trilho2' src="./images/trilho.png" alt="">
<img id='trajeto' src="./images/trajeto.png" alt="">
<label id='numero'>2</label>
<img id='caminhao_vale' src="./images/caminhao_1.png" alt="">
<img id='logo_vale' src="./images/vale.png" alt="">
<img id='semaforo_vale' src="./images/ok.png" alt="">
<img id='mastro_vale' src="./images/mastro.png" alt="">
<label id='tempo_vale'>00:00:00</label>
<img id='logo_gerdau' src="./images/gerdau.png" alt="">
<img id='caminhao_gerdau' src="./images/caminhao_2.png" alt="">
<label id='tempo_gerdau'>00:00:00</label>
<img id='semaforo_gerdau' src="./images/pare.png" alt="">
<img id='mastro_gerdau' src="./images/mastro.png" alt="">
</div>


<div id='relogio'>
    <label id='v_hora'>00:00:00</label>
</div>

    
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>


</body>

<script>

</script>

<style>



DIV#entrada{
    width: 450px;
    height: 280px;
    background-color: #D3D3D3;
    position: absolute;
    top: 64%;
    left: 3.5%
}

IMG#foto_rua{
    margin-left: 0px;
    position: absolute;
    left: 335px;
    top: -202%;
    width: 700px;
    height: 843px;
    transform: rotate(0deg);
    
}
IMG#foto_patrag{
    margin-left: 0px;
    position: absolute;
    left: 760px;
    top: -249%;
    width: 670px;
    height: 830px;
    transform: rotate(0deg);
    
}
IMG#trilho{
    margin-left: 0px;
    position: absolute;
    left: 115px;
    top: -130%;
    width: 400px;
    height: 328px;
    transform: rotate(-3deg);
    
}
IMG#trilho2{
    margin-left: 0px;
    position: absolute;
    left: 462px;
    top: -46%;
    width: 400px;
    height: 328px;
    transform: rotate(-3deg);
    
}
IMG#trajeto{
    margin-left: 0px;
    position: absolute;
    left: 425px;
    top: -120%;
    width: 120px;
    height: 128px;
    
    
}
LABEL#numero{
    color: black;
    font: bold 100pt Times;
    position: absolute;
    top: -135%;
    left:340px;;
}
IMG#caminhao_vale{
    margin-left: 0px;
    position: relative;
    left: 37px;
    top: 27%;
    width: 130px;
    height: 160px;
    
    
}
IMG#logo_vale{
    margin-left: 0px;
    position: relative;
    left: -65px;
    top: -33%;
    width: 60px;
    height: 60px;
    
    
}
LABEL#tempo_vale{
    font: normal 18pt Times;
    position: relative;
    top: 38%;
    left:-218px;
    color: black;
    font: bold 20pt Times;
}
IMG#semaforo_vale{
    margin-left: 0px;
    position: relative;
    left: -215px;
    top: -2%;
    width: 50px;
    height: 90px;
    
    
}

IMG#mastro_vale{
    margin-left: 0px;
    position: relative;
    left: -255px;
    top: 44%;
    width: 15px;
    height: 143px;
    
    
}







IMG#caminhao_gerdau{
    margin-left: 0px;
    position: relative;
    left: 242px;
    top: -30%;
    width: 130px;
    height: 160px;
    
    
}

IMG#logo_gerdau{
    margin-left: 0px;
    position: relative;
    left: -32px;
    top: -34%;
    width: 50px;
    height: 50px;
    
    
}
LABEL#tempo_gerdau{
    font: normal 18pt Times;
    position: relative;
    top: -19%;
    left: 125px;
    color: black;
    font: bold 20pt Times;
}
IMG#semaforo_gerdau{
    margin-left: 0px;
    position: relative;
    left: -58px;
    top: -61%;
    width: 50px;
    height: 90px;
    
    
}

IMG#mastro_gerdau{
    margin-left: 0px;
    position: relative;
    left: -96px;
    top: -14%;
    width: 15px;
    height: 143px;
    
    
}





DIV#relogio{
    width: 100px;
    height: 30px;
    background-color: transparent;
    position: absolute;
    top: 7%;
    left: 89.2%
}

LABEL#v_hora{
    font: normal 18pt Times;
    position: relative;
    top: 2%;
}







IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#home{
    margin-left: 0px;
    position: absolute;
    left: 38px;
    top:  2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}


#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 88%;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3%;
    top: 0%;
    width:92.9%;
    height:3%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 5%;
    top: -10%;
}
#funcao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 75%;
    top: 5%;
}

INPUT#criptografia
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 11pt verdana;
    color:#000000;
    left: 30%;
    top: 5%;

}
INPUT#criptografia2
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 100px;
    font: normal 11pt verdana;
    color:#000000;
    left: 55%;
    top: 5%;

}

body{

}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>
</html>