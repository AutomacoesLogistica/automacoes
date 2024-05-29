<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">

<script>
function FormataCpf(evt)
{
 vr = (navigator.appName == 'Netscape') ? evt.target.value : evt.srcElement.value;
 if(vr.length == 3) vr = vr + ".";<!-- No terceiro digito acrescenta . -->
 if(vr.length == 7) vr = vr + ".";<!-- No terceiro digito acrescenta . -->
 if(vr.length == 11) vr = vr + "-";<!-- No terceiro digito acrescenta - -->
 return vr;
}

function validar()
{
 var cpf = form1.cpf.value;
 form1.cpf.value;
 if(cpf == "") 
 {
  alert('Favor preecher o CPF!');
  form1.cpf.focus();
  return false;
 }
 if(cpf.length != 14 && cpf != "") 
 {
  alert('Preecher o CPF corretamente!');
  form1.cpf.focus();
  return false;
 }
 if(cpf.length == 14) 
 {

 }
}
</script>




</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`menu_gestao_gagf.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.PNG" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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

<h2 id="lb_titulo">Consultando Cadastro dos Motoristas</h2>
<br/>



<fieldset id="formulario1"><legend>Pesquisando CPF</legend>
<form name="form1" method="post" action= "exibir_motorista_1.php">

Digite o CPF: <input style="padding-left: 10px;" id="cpf" name="cpf" type="text" maxlength="14" onkeypress="this.value = FormataCpf(event)" placeholder="000.000.000-00" />
<input id="btn_cpf" type="submit" onclick="return validar(cpf.value)" value="Pesquisar CPF"/><br/>
</form>
</fieldset>

<br/>


<fieldset id="formulario2"><legend>Buscar Lista de Dados</legend>
<input id="btn_lista_motorista" type="buttom"  value="Buscar Lista Completa Motoristas" onclick="javascript: location.href='buscar_lista_motoristas.php';"/>
<input id="btn_lista_transportadora" type="buttom"  value="Buscar Lista Completa Transportadoras" onclick="javascript: location.href='buscar_lista_transportadoras.php';"/>
<br/>
</fieldset>

</form>

<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<style>

#lb_titulo{
    margin-left: 0px;
    position: absolute;
    left: 70px;
    top: 40px;;
}


#formulario1{
    position: absolute;
    left:70px;
    top: 120px;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1190px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}
#formulario2{
    position: absolute;
    left:70px;
    top: 230px;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1190px;
    height: 60px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}


INPUT#btn_cpf
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left:320px;
    top: 30px;
    width:200px;
    height:30px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;
    

}

INPUT#btn_cpf:hover
{
 background-color: #555555; /* Preto */
 color: white;
 
}


INPUT#btn_cpf:active {
  background-color: #00008B;
  box-shadow: 0 4px #666;
  transform: translateY(2px);
}



INPUT#btn_lista_motorista
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left:20px;
    top: 35px;
    width:280px;
    height:25px;
    text-align:center;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;
    

}

INPUT#btn_lista_motorista:hover
{
 background-color: #555555; /* Preto */
 color: white;
 
}


INPUT#btn_lista_motorista:active {
  background-color: #00008B;
  box-shadow: 0 4px #666;
  transform: translateY(2px);
}



INPUT#btn_lista_transportadora
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    left:320px;
    top: 35px;
    width:280px;
    height:25px;
    text-align:center;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 3px #000000 solid!important;
    cursor: pointer;
    

}

INPUT#btn_lista_transportadora:hover
{
 background-color: #555555; /* Preto */
 color: white;
 
}


INPUT#btn_lista_transportadora:active {
  background-color: #00008B;
  box-shadow: 0 4px #666;
  transform: translateY(2px);
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
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3.1%;
    top: 0%;
    width:93%;
    height:4.2%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 5%;
    top: 12%;
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
    top: 12%;
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
    font: normal 12pt times;
}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>