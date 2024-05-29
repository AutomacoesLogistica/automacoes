<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Cancelas Mineração</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body>

<div >
<form method="post" action="consultar_cancela.php">
<fieldset id="formulario" ><legend>Selecione o sitio desejado</legend>
<input type="radio" name="cancelas" id="mb" value="Miguel Burnier" checked />
<label for="mb">Miguel Burnier</label>
<input type="radio" name="cancelas" id="vl" value="Várzea do Lopes"/>
<label for="vl">Várzea do Lopes</label>
<input type="radio" name="cancelas" id="pat" value="Patrag"/>
<label for="pat">Patrag</label>
<input style="margin-left: 10px;" class="BotaoMenu" type="button" value="Carregar" onclick="carragar_cancelas()" />

</fieldset>
</form> 
</br>
<input style="margin-left: 10px;" class="BotaoMenu" type="button" value="Voltar ao menu" onclick="javascript: location.href='menu.php';" />
</div>

<script>
var radios = document.getElementsByName('cancelas');




function carragar_cancelas()
{

var selecionado;
   for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            selecionado = radios[i].value;
        }
    }

if (selecionado == "Miguel Burnier")
{
  window.location.href = "consultar_cancelas_mb.php";
}
if(selecionado == "Várzea do Lopes")
{
  window.location.href = "consultar_cancelas_vl.php";
}

if(selecionado == "Patrag")
{
  window.location.href = "consultar_cancelas_patrag.php";
}

}

</script>
</body>


<style>
body{
    text-align: left;
    margin-top: 30px !important;
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
