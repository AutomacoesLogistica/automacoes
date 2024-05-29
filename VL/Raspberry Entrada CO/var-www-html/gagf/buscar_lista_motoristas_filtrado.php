<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Buscando Motoristas</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body>
<h1>Consultando Lista dos Motoristas da Transportadora :</h1>
<label id="titulo">Consultando Lista dos Motoristas da Transportadora</label>
<br/>
<div>
<form method="post" action="lista_motoristas_nome.php">
<fieldset id="formulario"><legend>Motoristas Listados</legend>
<select name="select_transportadoras" id="select_transportadoras">

<script>
var tit = window.document.getElementById("titulo");
<?php
$transp = $_POST['select_transportadoras'];
?>


tit.innerHTML = "<?php print $transp ?>"
</script>


    <?php
    include_once 'conexao.php';
    $transportadora = $_POST['select_transportadoras'];
    
  
    $sql = $dbcon->query("SELECT * FROM lista_motoristas WHERE nome_transportadora_a='$transportadora'");
    if(mysqli_num_rows($sql)>0)
    {
    while($dados = $sql->fetch_array())
    {
    $motoristas = $dados['nome'];
    echo"<option>$motoristas</option>";
    ?>
    <?php
    }

    }
    ?>

</select>

<input id="btnBuscarMotoristas" type="submit" class="BotaoMenu" value="Buscar Dados"/>













</fieldset>
<br/>
<br/>
<input class="BotaoMenu" type="button" value="Voltar" onclick="javascript: location.href='buscar_lista_transportadoras.php';" />
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

LABEL#titulo{
    margin-left: 0px;
    position: absolute;
    left: 63px;
    top: 70px;
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
    margin-top: 5px;
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
     top: 148px;
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
    top: 148px;
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
