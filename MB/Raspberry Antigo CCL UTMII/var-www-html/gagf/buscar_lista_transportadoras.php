<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Consultando CA</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body>
<h2>Consultando Lista das Transportadoras</h2>
<br/>
<div>
<form method="post" action="buscar_lista_motoristas_filtrado.php">
<fieldset id="formulario"><legend>Transportadoras</legend>
<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$id = 1;

$sql = $dbcon->query("SELECT * FROM lista_transportadoras");

if(mysqli_num_rows($sql)>0){
?>
<select name="select_transportadoras" id="select_transportadoras">
<?php
$encontrado = 0;
while($dados = $sql->fetch_array()){
$encontrado = $encontrado +1;
$mensagem = "a";
$ultima_mensagem = "b";
$mensagem = $dados['nome_transportadora'];

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
<input id="btnBuscarMotoristas" type="submit" class="BotaoMenu" value="Buscar Motoristas"/>













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

#formulario{
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    height: 65px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}


Select#select_transportadoras {
     width: 640px;
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
INPUT#btnBuscarMotoristas{
    font: normal 9pt verdana;
    margin-left: 0px;
    position: absolute;
    left: 730px;
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

function buscar()
{
 var valor =  window.document.getElementById("select_motoristas");
 var nome = valor.value;
 var transportadora =  window.document.getElementById("lbTransportadora");
 transportadora.innerHTML = `Transportadora : ${nome}`;

}




</script>



</html>
