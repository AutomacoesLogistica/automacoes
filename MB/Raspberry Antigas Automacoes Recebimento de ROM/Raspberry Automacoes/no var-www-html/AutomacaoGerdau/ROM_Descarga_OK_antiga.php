<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload='pisca();'>
<!--  <label id="descarga_nok">Favor entrar em contato com o CCL!</label>      -->

<label id="descarga_ok">Descarga Liberada!</label>      
<label id="BAIA1">x</label>      
<label id="BAIA2">x</label>      
<label id="BAIA3">x</label>      

<?php
 include_once 'conexao2.php';
 $sql = $dbcon->query("SELECT * FROM baias WHERE id=1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   //DADOS DAS AREAS
   $v_area1 = $dados['v_area1'];
   $v_area2 = $dados['v_area2'];
   $v_area3 = $dados['v_area3']; 

   //DADOS DAS BAIAS
   $v_baia1 = $dados['v_baia1']; 
   $v_baia2 = $dados['v_baia2']; 
   $v_baia3 = $dados['v_baia3']; 
   
   //DADOS DOS MATERIAIS
   $material_baia1 = $dados['baia1']; 
   $material_baia2 = $dados['baia2']; 
   $material_baia3 = $dados['baia3']; 
  } // fecha o while
 }// fecha o if
?> 

<script>
var v_baia1 = document.getElementById('BAIA1');
var v_baia2 = document.getElementById('BAIA2');
var v_baia3 = document.getElementById('BAIA3');

v_baia1.innerHTML = '<?php print $v_area1?>'+' - '+ '<?php print $v_baia1?>'+ ' - ' +'<?php print $material_baia1?>';
v_baia2.innerHTML = '<?php print $v_area2?>'+' - '+ '<?php print $v_baia2?>'+ ' - ' +'<?php print $material_baia2?>';
v_baia3.innerHTML = '<?php print $v_area3?>'+' - '+ '<?php print $v_baia3?>'+ ' - ' +'<?php print $material_baia3?>';



function pisca(){
  var f = document.getElementById('descarga_ok');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 1000);


}
</script>




</body>

</html>

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

LABEL#BAIA1{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 50pt verdana;
    color:#ffffff;
    left: 4%;
    top: 40%;
    padding-top: 12px;
    width:90%;
    height:14%;
    background-color: #00008B;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}
LABEL#BAIA2{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 50pt verdana;
    color:#ffffff;
    left: 4%;
    top: 60%;
    padding-top: 12px;
    width:90%;
    height:14%;
    background-color: #00008B;
    border-radius: 16px!important;
    border: 12px #000000 solid!important;
}
LABEL#BAIA3{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 50pt verdana;
    color:#ffffff;
    left: 4%;
    top: 80%;
    padding-top: 12px;
    width:90%;
    height:14%;
    background-color: #00008B;
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
body{
margin-top: 0px;
}

html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 160%;
margin-left:-100px;
font: normal 12pt times;
}

</style>