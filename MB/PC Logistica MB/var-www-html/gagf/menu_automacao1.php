<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
$registro = ceil((floatval($complemento))/1.5);
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
<center>



<input id="btn_MB"  type="button" value="Miguel Burnier"  onclick="javascript: location.href=`menu_automacao11.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" />
<input id="btn_Patrag_Usina" type="button" value="Patrag / Usina" onclick="javascript: location.href=``;"/>
<input id="btn_VL" type="button" value="Várzea do Lopes" onclick="javascript: location.href=`menu_automacao22.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" />
<input id="btn_VLN" type="button" value="Várzea do Lopes Norte" />
<input id="btn_complementos"  type="button" value="Complementos Automação"  onclick="javascript: location.href=`menu_automacao2.php?complemento=${criptografia2.value}&check=${criptografia.value}`;" />


<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



</body>

<script>

window.document.getElementById('btn_MB').disabled=true;
window.document.getElementById('btn_Patrag_Usina').disabled=true;
window.document.getElementById('btn_VL').disabled=true;
window.document.getElementById('btn_VLN').disabled=true;
window.document.getElementById('btn_complementos').disabled=true;


 
if (funcao =="Desenvolvedor")
{
    console.log("Desenvolvedor");
    window.document.getElementById('btn_MB').disabled=false;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=false;
    window.document.getElementById('btn_VLN').disabled=true;
    window.document.getElementById('btn_complementos').disabled=false;

}
else if(funcao=="Administrador")
{
    console.log("Administrador");
    window.document.getElementById('btn_MB').disabled=false;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=false;
    window.document.getElementById('btn_VLN').disabled=true;
    window.document.getElementById('btn_complementos').disabled=false;
}
else if(funcao=="Gestão GAGF")
{
    console.log("Gestao");
    window.document.getElementById('btn_MB').disabled=true;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=true;
    window.document.getElementById('btn_VLN').disabled=true;
}
else if(funcao=="Operador CCL MB")
{
    console.log("Operador CCL MB");
    window.document.getElementById('btn_MB').disabled=true;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=true;
    window.document.getElementById('btn_VLN').disabled=true;
}
else if(funcao=="Operador CCL VL")
{
    window.document.getElementById('btn_MB').disabled=true;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=true;
    window.document.getElementById('btn_VLN').disabled=true;
}
else if(funcao=="Gestão CCL MB")
{
    window.document.getElementById('btn_MB').disabled=true;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=true;
    window.document.getElementById('btn_VLN').disabled=true;
}
else if(funcao=="Gestão CCL VL")
{
    window.document.getElementById('btn_MB').disabled=true;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=true;
    window.document.getElementById('btn_VLN').disabled=true;
}


// Caso não seja algo definido bloqueia tudo
else
{
    window.document.getElementById('btn_MB').disabled=true;
    window.document.getElementById('btn_Patrag_Usina').disabled=true;
    window.document.getElementById('btn_VL').disabled=true;
    window.document.getElementById('btn_VLN').disabled=true; 
}
</script>

<style>


INPUT#btn_MB
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:25%;
    top: 80px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_MB:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_MB:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_Patrag_Usina
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:52%;
    top: 80px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_Patrag_Usina:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_Patrag_Usina:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_VL
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:25%;
    top: 200px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_VL:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_VL:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_VLN
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:52%;
    top: 200px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_VLN:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_VLN:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_complementos
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:25%;
    top: 320px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_complementos:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_complementos:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
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