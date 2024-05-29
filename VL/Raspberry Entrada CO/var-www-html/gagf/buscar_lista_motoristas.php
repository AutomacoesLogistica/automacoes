<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Consultando CA</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body>
<h2>Consultando Motoristas</h2>
<br/>
<div>
<form method="post" action="lista_motoristas.php">

<fieldset id="formulario" ><legend>Motoristas</legend>
<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$id = 1;

$sql = $dbcon->query("SELECT * FROM lista_motoristas");

if(mysqli_num_rows($sql)>0){
?>
<select name="select_motoristas" id="select_motoristas" onchange="buscar()">
<?php
$encontrado = 0;
while($dados = $sql->fetch_array()){
$encontrado = $encontrado +1;
$mensagem = "a";
$ultima_mensagem = "b";
$mensagem = $dados['nome'];

if($ultima_mensagem != $mensagem ){
#salva a mensagem
$ultima_mensagem = $mensagem;
echo"<option>$ultima_mensagem</option>";

}else{
#Nao salva
$ultima_mensagem = $mensagem;
}

}

}else{
echo "Nao encontrado";
}

?>
</select>
<input id="btnBuscarCadastro" type="submit" class="BotaoMenu" value="Buscar Cadastro"/>
<br/><br/><br/>

<label id="lbTransportadora">Transportadora: </label>












</fieldset>
<br/>
<br/>
<input class="BotaoMenu" type="button" value="Voltar" onclick="javascript: location.href='consultar_motorista1.php';" />
</form>
</div>




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
background-size: auto,auto;
}



Select#select_motoristas {
     width: 940px;
     height: 26px;
     margin-left: 0px;
     position: absolute;
     left: 80px;
     top: 128px;
     font: normal 9pt verdana;
     color: black;
     background-color: White;
     border-color: #00008B;
     border-style: solid!important;
     cursor: pointer;
}


INPUT.BotaoMenu {
     width: 140px;
     height: 26px;
     font: bold 9pt verdana;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer;
}

fieldset#formulario{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    height: 70px; 
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

INPUT#btnBuscarCadastro{
    font: normal 9pt verdana;
    margin-left: 0px;
    position: absolute;
    left: 1100px;
    top: 128px;
    width:170px;
    height:25px;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer
}

</style>


<script>



var cpf="";

function buscar()
{
 var valor =  window.document.getElementById("select_motoristas");
 var nome = valor.value;
 var transportadora =  window.document.getElementById("lbTransportadora");
 transportadora.innerHTML = `Transportadora : ${nome}`;





 





}

</script>




</html>
