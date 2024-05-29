<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Cancelas Mineração</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body onload="carragar_cancelas()">
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_ccl_vl.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
window.location="login.php";
</script>
<?php
}
?>


<div >
<form method="post" action="consultar_cancela.php">

</form> 
</div>

<br/>
<br/>


<!-- Cancelas vl *******************************************************************************************-->
<div id="cancelas_vl" style="display:block">
<form method="post" action="consultar_cancela.php">
<fieldset id="formulario_vl" ><legend>Cancelas Mineração Miguel Burnier</legend>
<img class="foto" id="can1_vl"  alt="" onclick="clicou_cancela1_vl()"/>
<img class="foto" id="can2_vl"  alt="" onclick="clicou_cancela2_vl()"/>
<img class="foto" id="can3_vl"  alt="" onclick="clicou_cancela3_vl()"/>
<img class="foto" id="can4_vl"  alt="" onclick="clicou_cancela4_vl()"/>
<img class="foto" id="can5_vl"  alt="" onclick="clicou_cancela5_vl()"/>

<label id="lb_titulo_can1_vl"></label>
<label id="lb_titulo_status_can1_vl">Condição :</label>
<label id="lb_titulo_resp_status_can1_vl"></label>
<label id="lb_titulo_tag_can1_vl">TAG :</label>
<label id="lb_titulo_resp_tag_can1_vl"></label>
<label id="lb_titulo_info_can1_vl">Informações :</label>
<label id="lb_titulo_resp_info_can1_vl"></label>

<label id="lb_titulo_can2_vl"></label>
<label id="lb_titulo_status_can2_vl">Condição :</label>
<label id="lb_titulo_resp_status_can2_vl"></label>
<label id="lb_titulo_tag_can2_vl">TAG :</label>
<label id="lb_titulo_resp_tag_can2_vl"></label>
<label id="lb_titulo_info_can2_vl">Informações :</label>
<label id="lb_titulo_resp_info_can2_vl"></label>

<label id="lb_titulo_can3_vl"></label>
<label id="lb_titulo_status_can3_vl">Condição :</label>
<label id="lb_titulo_resp_status_can3_vl"></label>
<label id="lb_titulo_tag_can3_vl">TAG :</label>
<label id="lb_titulo_resp_tag_can3_vl"></label>
<label id="lb_titulo_info_can3_vl">Informações :</label>
<label id="lb_titulo_resp_info_can3_vl"></label>

<label id="lb_titulo_can4_vl"></label>
<label id="lb_titulo_status_can4_vl">Condição :</label>
<label id="lb_titulo_resp_status_can4_vl"></label>
<label id="lb_titulo_tag_can4_vl">TAG :</label>
<label id="lb_titulo_resp_tag_can4_vl"></label>
<label id="lb_titulo_info_can4_vl">Informações :</label>
<label id="lb_titulo_resp_info_can4_vl"></label>

<label id="lb_titulo_can5_vl"></label>
<label id="lb_titulo_status_can5_vl">Condição :</label>
<label id="lb_titulo_resp_status_can5_vl"></label>
<label id="lb_titulo_tag_can5_vl">TAG :</label>
<label id="lb_titulo_resp_tag_can5_vl"></label>
<label id="lb_titulo_info_can5_vl">Informações :</label>
<label id="lb_titulo_resp_info_can5_vl"></label>

</fieldset>
</form>

<style>
img#can1_vl{
    margin-left: 0px;
    position: absolute;
    left: 81px;
    top: 80px;
}
img#can2_vl{
    margin-left: 0px;
    position: absolute;
    left: 480px;
    top: 80px;
}

img#can3_vl{
    margin-left: 0px;
    position: absolute;
    left: 879px;
    top: 80px;
}

img#can4_vl{
    margin-left: 0px;
    position: absolute;
    left: 81px;
    top: 260px;
}

img#can5_vl{
    margin-left: 0px;
    position: absolute;
    left: 480px;
    top: 260px;
}


/*Labels da Cancela 1 vl  ***********************************************************************************/
label#lb_titulo_can1_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 220px;
    top: 80px;
}

label#lb_titulo_status_can1_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 125px;
}

label#lb_titulo_resp_status_can1_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 295px;
    top: 125px;
}

label#lb_titulo_tag_can1_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 150px;
}

label#lb_titulo_resp_tag_can1_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 265px;
    top: 150px;
}


label#lb_titulo_info_can1_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 175px;
}

label#lb_titulo_resp_info_can1_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 295px;
}





/*Labels da Cancela 2 vl  ***********************************************************************************/
label#lb_titulo_can2_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 619px;
    top: 80px;
}

label#lb_titulo_status_can2_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 125px;
}

label#lb_titulo_resp_status_can2_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 694px;
    top: 125px;
}

label#lb_titulo_tag_can2_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 150px;
}

label#lb_titulo_resp_tag_can2_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 664px;
    top: 150px;
}


label#lb_titulo_info_can2_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 175px;
}

label#lb_titulo_resp_info_can2_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 295px;
}


/*Labels da Cancela 3 vl  ***********************************************************************************/
label#lb_titulo_can3_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 1018px;
    top: 80px;
}

label#lb_titulo_status_can3_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 1018px;
    top: 125px;
}

label#lb_titulo_resp_status_can3_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 1093px;
    top: 125px;
}

label#lb_titulo_tag_can3_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 1018px;
    top: 150px;
}

label#lb_titulo_resp_tag_can3_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 1063px;
    top: 150px;
}


label#lb_titulo_info_can3_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 1018px;
    top: 175px;
}

label#lb_titulo_resp_info_can3_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 1018px;
    top: 295px;
}


/*Labels da Cancela 4 vl  ***********************************************************************************/
label#lb_titulo_can4_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 220px;
    top: 260px;
}

label#lb_titulo_status_can4_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 305px;
}

label#lb_titulo_resp_status_can4_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 295px;
    top: 305px;
}

label#lb_titulo_tag_can4_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 330px;
}

label#lb_titulo_resp_tag_can4_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 265px;
    top: 330px;
}


label#lb_titulo_info_can4_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 355px;
}

label#lb_titulo_resp_info_can4_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 370px;
}


/*Labels da Cancela 5 vl  ***********************************************************************************/
label#lb_titulo_can5_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 619px;
    top: 260px;
}

label#lb_titulo_status_can5_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 305px;
}

label#lb_titulo_resp_status_can5_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 694px;
    top: 305px;
}

label#lb_titulo_tag_can5_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 330px;
}

label#lb_titulo_resp_tag_can5_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 664px;
    top: 330px;
}


label#lb_titulo_info_can5_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 355px;
}

label#lb_titulo_resp_info_can5_vl{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 370px;
}

</style>
</div>




<script>
var valor = 0;


function carragar_cancelas()
{
  <?php
   include_once 'conexao2.php';
   $sq1 = $dbcon->query("SELECT * FROM id_cancelas_vl WHERE local_instalacao ='Várzea do Lopes'");
   if(mysqli_num_rows($sq1)>0)
   {
    while($dados = $sq1->fetch_array())
    {
     $Nome = $dados['nomecancela'];
     $Codigo = $dados['cod'];
     $Status = $dados['condicao'];
     $TAG = $dados['tag_lida'];
     $Info = $dados['info'];
     // Descarrega os dados
     ?>
     var nome = "<?php print $Nome ?>"
     var foto = "";
     var codigo = "<?php print $Codigo ?>"
     var status = "<?php print $Status ?>"

     if (status == "Aberta!"){status = "Aberta!";foto = "aberta";}
     else if (status == "Fechada!"){status = "Fechada!";foto = "fechada";}
     else if (status == "Defeito!"){status = "Defeito!";foto = "defeito";}
     else{status = "-----------";foto = "erro";}
    
     var tag = "<?php print $TAG ?>"
     if (tag !="0" && tag!="" ){tag = tag}else{tag = "-----------------";}
    
     var info = "<?php print $Info ?>"
     
     // TITULO DA CANCELA
     var titulo  = "lb_titulo_" + codigo;  
     var lbtitulo = document.getElementById(titulo)
     lbtitulo.innerHTML = nome;

     // CONDICAO DA CANCELA
     var condicao  = "lb_titulo_resp_status_" + codigo;  
     var lbcondicao = document.getElementById(condicao)
     lbcondicao.innerHTML = status;
     // altera a foto tavlem da cancela
     var imagem = document.getElementById(codigo)
     imagem.src="./images/cancela_"+foto+".png"

     // TAG DA CANCELA
     var vtag  = "lb_titulo_resp_tag_" + codigo;  
     var lbtag = document.getElementById(vtag)
     lbtag.innerHTML = tag;

     // INFO DA CANCELA
     var vinfo  = "lb_titulo_resp_info_" + codigo;  
     var lbinfo = document.getElementById(vinfo)
     lbinfo.innerHTML = info;

     <?php

    } // fecha while
   } // fecha o if
   ?>

    mysqli_close($dbcon); //fecha a conexao com o banco
}


function clicou_cancela1_vl()
{
    alert("clicou_cancela1_vl")
 
}
function clicou_cancela2_vl()
{
    alert("clicou_cancela2_vl")
 
}

setTimeout("location.reload(true);",5000); // recarrega a pagina em 5 segundos
</script>


</body>


<style>
body{
    text-align: left;
    margin-top: 10px !important;
    margin-left: 60px !important;
}

html{
margin-top: 0px !important;
margin-left: 0px !important;
background: url("./images/q.png");
background-size: 100%;
}

INPUT.BotaoMenu {
     width: 140px;
     height: 26px;
     font-weight: bold
     font-family: verdana;font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

#formulario_can1{
    margin-left:0px;
    padding-top:0px;
    padding-bottom:10px;
    padding-left:5px;
    width:270px;
    text-align:left;
    border-radius: 0px!important;
    border-color: transparent;
    border-style: solid!important;
}

#formulario{
    loat:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

#formulario_vl{
    loat:top;
    
    margin-left:0px;
    margin-top:-10px;
    padding-top:-20px;
    padding-bottom:0px;
    padding-left:20px;
    width:1205px;
    height:500px;
    text-align:left;
    color: transparent;
    border-radius: 6px!important;
    border-color: transparent;
    border-style: solid!important;
}





img.foto{
    loat:top;
    margin-left:0px;
    margin-right:10px;
    padding-top: 0px;
    padding-bottom:10px;
    padding-left:10px;
    padding-right:10px;
    background-color: #FFFFFF;
    width:100px;
    text-align:left;
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}
#text-can1{
    loat:top;
    margin-left:0px;
    margin-right:10px;
    padding-top: 0px;
    padding-bottom:5px;
    padding-left:5px;
    width:100px;
    text-align:left;
    border-color: #191970;
    border-style: inative!important;
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
    left: 6%;
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


</style>







</html>
