<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_gestao_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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


<h2>Consultando TAG</h2>
<div>

<fieldset id="formulario"><legend>Tipo de Veiculo</legend>
<input type="radio" name="veic" id="car" value="Carreta" checked />
<label for="car">Carreta</label><br/>
<input type="radio" name="veic" id="cav" value="Cavalo"/>
<label for="cav">Cavalo</label><br/>
<input id="veic" type="text" value="" hidden="hidden"/> 
</fieldset><br/>
<br/>
<h3>Digite a TAG : </h3>
<input id="epc" type="number" name="epc"/>
<input id= "enviar" style="margin-left: 10px;" type="submit" class="BotaoMenu" value="Pesquisar" onclick="validar()"/>



</div>


<center>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



</body>

<script>

function validar()
{
    var link_epc = window.document.getElementById("epc"); 
    var radios = document.getElementsByName("veic");
    var tamanho = 0;
    tamanho = (link_epc.value).length;
    
    
   if (tamanho!=0)
   {
    if (radios[0].checked)
    {
        var link_veiculo = window.document.getElementById("veic");
        link_veiculo.value = "Carreta";
        //alert("Carreta"); 
    }
    if (radios[1].checked)
    {
        var link_veiculo = window.document.getElementById("veic");
        link_veiculo.value = "Cavalo";
        //alert("Cavalo");
    }

      // Pode ir para outra pagina
      location.href=`consultar_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&veic=${link_veiculo.value}&epc=${link_epc.value}`;
   }
   else
   {
     alert("Favor preencher o campo da TAG!")
     link_epc.focus();  
   }



}



</script>

<style>

#formulario{
    position: absolute;
    left: 65px;
    top: 100px;  
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1345px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

h2{
    position: absolute;
    left: 60px;
    top: 30px;  
}
h3{
    position: absolute;
    left: 55px;
    top: 220px;  
}

INPUT#epc{
    position: absolute;
    left: 185px;
    top: 235px;  
    width: 400px;
    height: 22px; 
}

INPUT#enviar {
     position: absolute;
     left: 595px;
     top: 235px; 
     width: 140px;
     height: 26px;
     font: verdana;font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

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

body{

}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>



</html>