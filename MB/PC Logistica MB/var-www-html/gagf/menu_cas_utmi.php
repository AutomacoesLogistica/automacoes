<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<div id="conexao">
<label id="colaborador" hidden="hidden"></label>
<label id="funcao" hidden="hidden"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_ccl_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_ccl_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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



<input id="btn_TV_ca_le"  type="button" value="TV Lado Esquerdo"  onclick="javascript: location.href=`vnc_tv_ca_utmi_le.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_reader_le" type="button" value="Reader Lado Esquerdo"  onclick="javascript: location.href=`acesso_reader_ca_utmi_le.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_TV_ca_ld" type="button" value="TV Lado Direito" onclick="javascript: location.href=`vnc_tv_ca_utmi_ld.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_reader_ld" type="button" value="Reader Lado Direito" onclick="javascript: location.href=`acesso_reader_ca_utmi_ld.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>


<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



</body>

<script>

function mensagem()
{
 alert("Desativado temporariamente!");   
}

funcao = trim(funcao);
if (funcao =="Desenvolvedor")
{
    window.document.getElementById('btn_TV_ca_le').disabled=false;
    window.document.getElementById('btn_reader_le').disabled=false;
    window.document.getElementById('btn_TV_ca_ld').disabled=false;
    window.document.getElementById('btn_reader_ld').disabled=false;

}
else if(funcao=="Administrador")
{
    window.document.getElementById('btn_TV_ca_le').disabled=false;
    window.document.getElementById('btn_reader_le').disabled=false;
    window.document.getElementById('btn_TV_ca_ld').disabled=true;
    window.document.getElementById('btn_reader_ld').disabled=true;
}
else if(funcao=="Gestão GAGF")
{
    window.document.getElementById('btn_TV_ca_le').disabled=true;
    window.document.getElementById('btn_reader_le').disabled=true;
    window.document.getElementById('btn_TV_ca_ld').disabled=true;
    window.document.getElementById('btn_reader_ld').disabled=true;
}
else if(funcao=="Operador CCL MB")
{
    window.document.getElementById('btn_TV_ca_le').disabled=false;
    window.document.getElementById('btn_reader_le').disabled=true;
    window.document.getElementById('btn_TV_ca_ld').disabled=true;
    window.document.getElementById('btn_reader_ld').disabled=true;
}
else if(funcao=="Operador CCL VL")
{
    window.document.getElementById('btn_TV_ca_le').disabled=true;
    window.document.getElementById('btn_reader_le').disabled=false;
    window.document.getElementById('btn_TV_ca_ld').disabled=true;
    window.document.getElementById('btn_reader_ld').disabled=true;
}
else if(funcao=="Gestão CCL MB")
{
    window.document.getElementById('btn_TV_ca_le').disabled=false;
    window.document.getElementById('btn_reader_le').disabled=true;
    window.document.getElementById('btn_TV_ca_ld').disabled=false;
    window.document.getElementById('btn_reader_ld').disabled=true;
}
else if(funcao=="Gestão CCL VL")
{
    window.document.getElementById('btn_TV_ca_le').disabled=true;
    window.document.getElementById('btn_reader_le').disabled=false;
    window.document.getElementById('btn_TV_ca_ld').disabled=true;
    window.document.getElementById('btn_reader_ld').disabled=false;
}


// Caso não seja algo definido bloqueia tudo
else
{
    window.document.getElementById('btn_TV_ca_le').disabled=true;
    window.document.getElementById('btn_reader_le').disabled=true;
    window.document.getElementById('btn_TV_ca_ld').disabled=true;
    window.document.getElementById('btn_reader_ld').disabled=true; 
}
</script>

<style>


INPUT#btn_TV_ca_le
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
INPUT#btn_TV_ca_le:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_TV_ca_le:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_reader_le
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
INPUT#btn_reader_le:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_reader_le:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_TV_ca_ld
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
INPUT#btn_TV_ca_ld:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_TV_ca_ld:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_reader_ld
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
INPUT#btn_reader_ld:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_reader_ld:active {
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