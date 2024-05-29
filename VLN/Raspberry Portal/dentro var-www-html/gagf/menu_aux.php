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
<img id="logo" src="./images/logo.png">
<img id="sair" src="./images/btn_sair.png" onclick="javascript: location.href='login.php';">
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss"hidden="hidden"/>
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



<input id="btn_automacao"  type="button" value="Automação Logística"  disable=disabled/>
<input id="btn_cco" type="button" value="Centro Controle Operacional" disable=disabled/>
<input id="btn_ccl" type="button" value="Centro Controle Logístico"  onclick="javascript: location.href=`menu_ccl_vln.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input id="btn_gestao_gagf" type="button" value="Gestão GAGF"  disable=disabled/>


<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<div id="links">
<a href="#" onclick="abreLink();">GAGF</a>
<a href="#" onclick="abreLink2();">IoT</a>
<a href="#" onclick="abreLink3();">Grafana</a>
<a href="#" onclick="abreLink4();">Automação Logistica</a>
</link>
</div>

<script>
function abreLink(){
window.open('https://ya7da335bbb3.us2.hana.ondemand.com/gagf/ui/index.html');
}
</script>

<script>
function abreLink2(){
window.open('https://flpnwc-da335bbb3.dispatcher.us2.hana.ondemand.com/sites/iot4decision#Shell-home');
}
</script>

<script>
function abreLink3(){
window.open('http://monitoracao.firstdecision.com.br:3000/login');
}
</script>

<script>
function abreLink4(){
window.open('http://138.0.77.81:8123/lovelace/default_view');
}
</script>






<script>
funcao = funcao.trim();
    
    console.log(funcao);
    
    if (funcao =="Desenvolvedor" || funcao =="Administrador")
    {
     console.log('entrou');
        window.document.getElementById('btn_automacao').disabled=false;
        window.document.getElementById('btn_ccl').disabled=false;
        window.document.getElementById('btn_cco').disabled=false;
        window.document.getElementById('btn_gestao_gagf').disabled=false;
    
    }
    else if(funcao=="Gestão GAGF")
    {
        console.log('entrou2');
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=true;
        window.document.getElementById('btn_cco').disabled=true;
        window.document.getElementById('btn_gestao_gagf').disabled=false;
    }
    
    else if(funcao=="Operador CCL MB" || funcao=="Gestão CCL MB" || funcao=="Operador CCL VL" || funcao=="Gestão CCL VL")
    {
        console.log('entrou3');
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=false;
        window.document.getElementById('btn_cco').disabled=true;
        window.document.getElementById('btn_gestao_gagf').disabled=true;
    }
    else if(funcao=="Operador CCO MB" || funcao=="Operador CCO VL" || funcao=="Gestão CCO")
    {
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=true;
        window.document.getElementById('btn_cco').disabled=false;
        window.document.getElementById('btn_gestao_gagf').disabled=true;
    }
    
    
    
    // Caso não seja algo definido bloqueia tudo
    else
    {
        window.document.getElementById('btn_automacao').disabled=true;
        window.document.getElementById('btn_ccl').disabled=true;
        window.document.getElementById('btn_cco').disabled=true;
        window.document.getElementById('btn_gestao_gagf').disabled=true; 
    }
</script>











</body>

<script>

</script>

<style>


IMG#logo{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 70px;
    width: 190px;
    height: 60px;
    cursor: pointer;

}

IMG#sair{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 15%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}



INPUT#btn_automacao
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
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_automacao:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_automacao:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_cco
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
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_cco:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_cco:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#btn_ccl
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:52%;
    top: 320px;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#btn_ccl:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_ccl:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_gestao_gagf
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
    background-color: #555555;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer
}
INPUT#btn_gestao_gagf:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#btn_gestao_gagf:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


IMG#logo{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 70px;
    width: 190px;
    height: 60px;
    cursor: pointer;

}





IMG#sair{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 15%;
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
div#links{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 95%;
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