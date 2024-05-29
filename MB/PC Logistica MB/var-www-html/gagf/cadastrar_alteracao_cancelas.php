<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body onload="limpar()">
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`consultar_cancelas_utmii.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
<br/>
<div >
<form method="post" action="consultar_cancela.php" autocomplete="off">
<fieldset id="formulario" ><legend>Justificando o Acionamento</legend>
<label>Selecione o motivo do acionamento da cancela da </label>
<label id="cancela"></label>
<?php
$local = $_GET['local'];#isset($_POST['funcao'])?$_POST['funcao']:0;
$cancelaa = $_GET['cancela'];#isset($_POST['funcao'])?$_POST['funcao']:0;
$tipo = $_GET['tipo'];

include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM id_cancelas_utmii WHERE cod='$cancelaa'"); // cod é o codigo cancelas
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
 $nome_cancela = $dados['nomecancela'];
 $sitio = $dados['local_instalacao'];
 $codigo_lora = $dados['codigo_lora'];
 
 }// fecha while
} // fecha if
?>

<script>
var cancela ="<?php print $nome_cancela ?>"
var cancelaa ="<?php print $cancelaa ?>"
var link_nome = window.document.getElementById("cancela")
link_nome.innerHTML = cancela;

var sitio ="<?php print $sitio ?>"

var codigo_lora = "<?php print $codigo_lora?>"

</script>

<?php
$sql = $dbcon->query("SELECT * FROM motivos_acionamentos WHERE tipo='$tipo' ORDER BY motivo ASC");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="motivos" id="motivos" onchange="limpar()">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['motivo'];
  echo"<option>$mensagem</option>";
 }// fecha while
} // fecha if
?>
<option SELECTED></option>
</select>
<label id="lbdescricao">Descreva a descrição do problema:</label>
<textarea id="descricao" name="descricao"value="" cols="100" rows="2"> </textarea>

<label id="lbregistro">Registro:</label>
<input id="tbregistro" type="text" value="" />
<label id="lbsenha">Senha:</label>
<input id="tbsenha" type="password" value="" />
<input id="carregar" style="margin-left: 10px;" class="BotaoMenu" type="button" value="Salvar" onclick="salvar_acionamento()" />

</fieldset>
</form> 
</br>
</div>

<script>

function limpar(){
  
}



function salvar_acionamento()
{
    var registro = window.document.getElementById("tbregistro")
    var senha = window.document.getElementById("tbsenha")
    var motivos = window.document.getElementById("motivos")
    var descricao = window.document.getElementById("descricao")
    //alert(String(descricao.value).length);
    if(registro.value != "" && senha.value !="" && motivos.value !="" && String(descricao.value).length >5)
    {
     
     window.location.href = `consultar_salvar_acionamento.php?complemento=${criptografia2.value}&check=${criptografia.value}&registro=${registro.value}&senha=${senha.value}&motivos=${motivos.value}&descricao=${descricao.value}&cancela=${cancela}&sitio=${sitio}&cod=${cancelaa}&codigo_lora=${codigo_lora}`;  
     
    }
    else
    {
       if(registro.value == "")
       {
         alert("Favor preencher o seu registro!"); 
         registro.focus();
       }
       else if(motivos.value == "")
       {
        alert("Favor preencher a justificativa para seu acionamento!");
         motivos.focus();
       }
       else if(String(descricao.value).length <2)
       {
        alert("Favor preencher/detalhar a descrição do motivo do erro!");
         descricao.focus();
       }
       else{
           alert("Favor preencher sua senha!");
         senha.focus();
       }


    }













  

}

</script>


















<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
</body>



<style>




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

#motivos {

     width: 940px;
     height: 26px;
     margin-left: 0px;
     position: absolute;
     left: 1.5%;
     top: 10%;
     font: normal 9pt verdana;
     color: black;
     background-color: White;
     border-color: #00008B;
     border-style: solid!important;
     cursor: pointer;

}

Label#lbdescricao{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 1.5%;
    top: 18%;
}
#descricao {

width: 74.8%;
height: 15%;
margin-left: 0px;
position: absolute;
left: 1.5%;
top: 23%;
font: normal 9pt verdana;
color: black;
background-color: White;
border-color: #00008B;
border-style: solid!important;
cursor: pointer;

}


Label#lbregistro{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 1.5%;
    top: 42%;
}
input#tbregistro{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 7%;
    top: 42%;
    width:140px;
    height:18px;
    padding-left: 5px;
    border-color: #191970;
    border-style: solid!important;
}    
Label#lbsenha{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 22%;
    top: 42%;

}
input#tbsenha{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 27%;
    top: 42%;
    width:140px;
    height:18px;
    padding-left: 5px;
    border-color: #00008B;
    border-style: solid!important;
}  





INPUT#carregar {
    margin-left: 0px;
    position: absolute;
    top: 42%;
    left: 45%;
     width: 160px;
     height: 30px;
     font-weight: bold;
     font-family: verdana;font-size: 12pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}


#formulario{
    position:absolute;
    left: 60px;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:80%;
    height: 50%;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
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
</style>



</html>