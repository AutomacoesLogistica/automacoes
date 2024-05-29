<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Cancelas Mineração</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body onload="carragar_cancelas()">

<div >
<form method="post" action="consultar_cancela.php">
<input style="margin-left: 10px;" class="BotaoMenu" type="button" value="Voltar" onclick="javascript: location.href='consultar_cancelas1.php';" />
</form> 
</div>

<br/>
<br/>


<!-- Cancelas pat *******************************************************************************************-->
<div id="cancelas_pat" style="display:block">
<form method="post" action="consultar_cancela.php">
<fieldset id="formulario_pat" ><legend>Cancelas Mineração Miguel Burnier</legend>
<img class="foto" id="can1_pat"  alt="" onclick="clicou_cancela1_pat()"/>
<img class="foto" id="can2_pat"  alt="" onclick="clicou_cancela2_pat()"/>

<label id="lb_titulo_can1_pat"></label>
<label id="lb_titulo_status_can1_pat">Condição :</label>
<label id="lb_titulo_resp_status_can1_pat"></label>
<label id="lb_titulo_tag_can1_pat">TAG :</label>
<label id="lb_titulo_resp_tag_can1_pat"></label>
<label id="lb_titulo_info_can1_pat">Informações :</label>
<label id="lb_titulo_resp_info_can1_pat"></label>

<label id="lb_titulo_can2_pat"></label>
<label id="lb_titulo_status_can2_pat">Condição :</label>
<label id="lb_titulo_resp_status_can2_pat"></label>
<label id="lb_titulo_tag_can2_pat">TAG :</label>
<label id="lb_titulo_resp_tag_can2_pat"></label>
<label id="lb_titulo_info_can2_pat">Informações :</label>
<label id="lb_titulo_resp_info_can2_pat"></label>

</fieldset>
</form>

<style>
img#can1_pat{
    margin-left: 0px;
    position: absolute;
    left: 81px;
    top: 190px;
}
img#can2_pat{
    margin-left: 0px;
    position: absolute;
    left: 480px;
    top: 190px;
}


/*Labels da Cancela 1 pat  ***********************************************************************************/
label#lb_titulo_can1_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 220px;
    top: 190px;
}

label#lb_titulo_status_can1_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 225px;
}

label#lb_titulo_resp_status_can1_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 295px;
    top: 225px;
}

label#lb_titulo_tag_can1_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 250px;
}

label#lb_titulo_resp_tag_can1_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 265px;
    top: 250px;
}


label#lb_titulo_info_can1_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 275px;
}

label#lb_titulo_resp_info_can1_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 220px;
    top: 295px;
}





/*Labels da Cancela 2 pat  ***********************************************************************************/
label#lb_titulo_can2_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 14pt Times;
    color: #00008B;
    left: 619px;
    top: 190px;
}

label#lb_titulo_status_can2_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 225px;
}

label#lb_titulo_resp_status_can2_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 694px;
    top: 225px;
}

label#lb_titulo_tag_can2_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 250px;
}

label#lb_titulo_resp_tag_can2_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 664px;
    top: 250px;
}


label#lb_titulo_info_can2_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 275px;
}

label#lb_titulo_resp_info_can2_pat{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    left: 619px;
    top: 295px;
}

</style>
</div>




<script>
var valor = 0;


function carragar_cancelas()
{
  <?php
   include_once 'conexao2.php';
   $sq1 = $dbcon->query("SELECT * FROM id_cancelas WHERE local_instalacao ='Patrag'");
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
     // altera a foto tapatem da cancela
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


function clicou_cancela1_pat()
{
    alert("clicou_cancela1_pat")
 
}
function clicou_cancela2_pat()
{
    alert("clicou_cancela2_pat")
 
}

setTimeout("location.reload(true);",5000); // recarrega a pagina em 5 segundos
</script>


</body>


<style>
body{
    text-align: left;
    margin-top: 20px !important;
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

#formulario_pat{
    loat:top;
    
    margin-left:0px;
    margin-top:-10px;
    padding-top:-20px;
    padding-bottom:0px;
    padding-left:20px;
    width:1205px;
    height:300px;
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
</style>







</html>
