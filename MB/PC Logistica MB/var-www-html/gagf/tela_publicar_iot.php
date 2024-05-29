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
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_automacao2.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
<center>



<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>






<?php

$url_iot = 'https://ya7da335bbb3.us2.hana.ondemand.com/iot4decision/services/rfid/readings.xsjs'; // Producao
//$url_iot ='https://ya2d90aa8583.us2.hana.ondemand.com/iot4decision/services/rfid/readings.xsjs'; // Qualidade

// DADOS PARA PUBLICAÇÃO *************************************************

$ca = isset($_GET['ca'])?$_GET['ca']:'vazio';
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'-'.$mensagem2[1].'-'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  

$horario = $data_agora;
echo '</BR></BR></BR></BR></BR></BR>00000000000000000000000000000000000000000000000 '.$horario;

//$antena = '0';
$antena = isset($_GET['antena'])?$_GET['antena']:'vazio';

$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';

//$epc = '442002000000000000001216';
//$epc = '442001000000000000003037';
//$epc = '442002000000000000000255';
//$epc = '442002000000000000012553';

//***********************************************************************

if($epc != 'vazio' && $antena != 'vazio' && $ca != 'vazio')
{
    
 echo '</BR>';
 echo 'Publicado no Iot';
 echo '</BR>';
 
}
else
{
 echo 'erro';   
}




?>
<label id='lb_ca' name='lb_ca'>Insira o número do CA :</label>
<input type='text' id='txt_ca' name='txt_ca' value=''></input>
<label id='lb_epc' name='lb_epc'>Insira o valor da TAG desejada :</label>
<input type='text' id='txt_epc' name='txt_epc' value='' maxlength="24"></input>
<label id='lb_antena' name='lb_antena'>Insira o valor da antena desejada :</label>
<input type='text' id='txt_antena' name='txt_antena' value='0'></input>
<input type='button' id='btn_enviar' name='btn_enviar' value='Publicar'></input>

<div id='resposta' name='resposta'></div>
<script>
var link_resposta = document.getElementById('resposta');
link_resposta.value='<?php print $msg_resposta ?>';

</script>



</body>

<script>

</script>

<style>



LABEL#lb_ca
{
    margin-left: 0px;
    position: absolute;
    text-align:left;
    font: normal 11pt verdana;
    color:#000000;
    left: 5%;
    top: 7%;

}


INPUT#txt_ca
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 100px;
    font: normal 11pt verdana;
    color:#000000;
    left: 17%;
    top: 6.5%;

}



LABEL#lb_epc
{
    margin-left: 0px;
    position: absolute;
    text-align:left;
    font: normal 11pt verdana;
    color:#000000;
    left: 5%;
    top: 12%;

}
INPUT#txt_epc
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 250px;
    font: normal 11pt verdana;
    color:#000000;
    left: 21%;
    top: 11.5%;

}



LABEL#lb_antena
{
    margin-left: 0px;
    position: absolute;
    text-align:left;
    font: normal 11pt verdana;
    color:#000000;
    left: 5%;
    top: 17%;

}
INPUT#txt_antena
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 20px;
    font: normal 11pt verdana;
    color:#000000;
    left: 23%;
    top: 16.5%;

}





DIV#resposta{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 40%;
    width: 90%;
    height: 45%;
    cursor: pointer;
    background-color: red;

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