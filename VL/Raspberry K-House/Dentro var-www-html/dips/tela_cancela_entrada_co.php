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

<label id="descarga_ok">Entrada Liberada!</label>      
<label id="lb_epc_cavalo">Baia 01 - </label>      
<label id="lb_placa_cavalo">Baia 02 - </label>      
<label id="lb_epc_carreta">Baia 03 - </label>      
<label id="lb_placa_carreta">Baia 04 - </label>
<label id="lb_transportadora">Baia 05 - </label>      

 <label id="descarga_nova">Favor aguardar a validação!</label>
 

<?php
 

 $ultimo_epc_cavalo = isset($_GET['epc'])? $_GET['epc']:'0';
 $vezes = isset($_GET['vezes'])? $_GET['vezes']:0;

 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM historico_match ORDER BY id DESC LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {

   $v_lb_epc_cavalo = $dados['epc_cavalo']; 
   $v_lb_placa_cavalo = $dados['placa_cavalo']; 
   $v_lb_epc_carreta = $dados['epc_carreta']; 
   $v_lb_placa_carreta = $dados['placa_carreta']; 

  } // fecha o while
 }// fecha o if
 
 if ($v_lb_placa_cavalo == "")
 {
  $v_lb_placa_cavalo = "Não identificada!";
 }
 if ($v_lb_placa_carreta == "")
 {
  $v_lb_placa_carreta = "Não identificada!";
 }
 
 
 //Agora busco a transportadora
 include_once 'conexao.php';
 $sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$v_lb_placa_cavalo' LIMIT 1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $v_lb_transportadora = $dados['nome']; 
  }
 } 
  if ($v_lb_transportadora == "")
 {
  $v_lb_transportadora = "Não identificada!";
 }

 
 if($ultimo_epc_cavalo == $v_lb_epc_cavalo)
 {
  $vezes = intval($vezes);
  if($vezes == 3)
  {
   $vezes = "-1";
  }
  else if ($vezes == -1)
  {
   $vezes = -1;
  }
  else
  {
   $vezes = $vezes+1;
   $vezes = strval($vezes);
   
  }
 }
 else
 {
 $vezes = "0";
 }
 
 
?> 

<script>

var v_lb_epc_cavalo = document.getElementById('lb_epc_cavalo');
var v_lb_placa_cavalo = document.getElementById('lb_placa_cavalo');
var v_lb_epc_carreta = document.getElementById('lb_epc_carreta');
var v_lb_placa_carreta = document.getElementById('lb_placa_carreta');
var v_lb_transportadora = document.getElementById('lb_transportadora');
v_lb_epc_cavalo.innerHTML = 'TAG Cavalo - '+'<?php print $v_lb_epc_cavalo?>';
v_lb_placa_cavalo.innerHTML = 'Placa Cavalo - '+'<?php print $v_lb_placa_cavalo?>';
v_lb_epc_carreta.innerHTML = 'TAG Carreta - '+'<?php print $v_lb_epc_carreta?>';
v_lb_placa_carreta.innerHTML = 'Placa Carreta - '+'<?php print $v_lb_placa_carreta?>';
v_lb_transportadora.innerHTML = '<?php print $v_lb_transportadora?>';



link_vezes = '<?php print $vezes ?>';
if(link_vezes == "-1")
{
document.getElementById('descarga_nova').style.display = 'block';
//Invisivel
document.getElementById('lb_epc_cavalo').style.display = 'none';
document.getElementById('lb_placa_cavalo').style.display = 'none';
document.getElementById('lb_epc_carreta').style.display = 'none';
document.getElementById('lb_placa_carreta').style.display = 'none';
document.getElementById('lb_transportadora').style.display = 'none';
document.getElementById('descarga_ok').style.display = 'none';
}
else
{
//Visivel
document.getElementById('lb_epc_cavalo').style.display = 'block';
document.getElementById('lb_placa_cavalo').style.display = 'block';
document.getElementById('lb_epc_carreta').style.display = 'block';
document.getElementById('lb_placa_carreta').style.display = 'block';
document.getElementById('lb_transportadora').style.display = 'block';
document.getElementById('descarga_ok').style.display = 'block';
//Invisivel
document.getElementById('descarga_nova').style.display = 'none';
}
 

   
  




</script>

</body>


<script>
function pisca() {
  var f = document.getElementById('descarga_ok');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 1000);


}
window.setTimeout( "location.href=`tela_cancela_entrada_co.php?epc=${'<?php print $v_lb_epc_cavalo ?>'}&vezes=${'<?php print $vezes ?>'}`",5000);
</script>


<style>

LABEL#descarga_ok{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 50pt verdana;
    color:#ffffff;
    left: 4%;
    top: 5%;
    padding-top: 1%;
    width:90%;
    height:14%;
    background-color: #32CD32;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}

LABEL#lb_epc_cavalo{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 38pt verdana;
    color:#ffffff;
    left: 4%;
    top: 25%;
    padding-top: 1%;
    width:90%;
    height:8%;
    background-color: #00008B;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}
LABEL#lb_placa_cavalo{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 38pt verdana;
    color:#ffffff;
    left: 4%;
    top: 38%;
    padding-top: 1%;
    width:90%;
    height:8%;
    background-color: #00008B;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}
LABEL#lb_epc_carreta{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 38pt verdana;
    color:#ffffff;
    left: 4%;
    top: 51%;
    padding-top: 1%;
    width:90%;
    height:8%;
    background-color: #00008B;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}

LABEL#lb_placa_carreta{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 38pt verdana;
    color:#ffffff;
    left: 4%;
    top: 64%;
    padding-top: 1%;
    width:90%;
    height:8%;
    background-color: #00008B;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}
LABEL#lb_transportadora{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 30pt verdana;
    color:#ffffff;
    left: 4%;
    top: 78%;
    padding-top: 1%;
    width:90%;
    height:12%;
    background-color: rgb(20,25,35);
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}

LABEL#descarga_nok{
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