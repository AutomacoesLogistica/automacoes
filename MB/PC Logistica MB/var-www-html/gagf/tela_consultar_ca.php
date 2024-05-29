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



<h2>Consultando CA ou Função do Reader</h2>
<br/>
<div>
<form method="post" action="tela_consultar_ca2.php?complemento=<?php print $criptografia ?>&check=<?php print $check ?>">
<fieldset id="formulario" ><legend>Consultando o CA para descobrir a função</legend>
Digite o CA: <input type="Text" name="ca"/>
<input style="margin-left: 10px;" type="submit" class="BotaoMenu" value="Pesquisar Função"/>
</fieldset>
</form> 
</div>

<div>
<form method="post" action="tela_consultar_ca2.php?complemento=<?php print $criptografia ?>&check=<?php print $check ?>">
<br/>
<br/><br/>
<fieldset id="formulario2"><legend>Consultando pelo Local para descobrir o CA</legend>
Selecione o local: 
<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$id = 1;

$sql = $dbcon->query("SELECT * FROM lista_funcao_readers");

if(mysqli_num_rows($sql)>0){
?>
<select name="funcao2" id="funcao2">
<?php
$encontrado = 0;
while($dados = $sql->fetch_array()){
$encontrado = $encontrado +1;
$mensagem = "a";
$ultima_mensagem = "b";
$mensagem = $dados['funcao'];

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
<input style="margin-left: 10px;" type="submit" id="pesquisar_ca" class="BotaoMenu" value="Pesquisar CA"/>













</fieldset>
<br/>
<br/>

</div>




<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



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
background-size: 100%;
}

INPUT.BotaoMenu {
     width: 140px;
     height: 26px;
     font-weight: bold;
     font-family: verdana;font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

#formulario{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}
#formulario2{
    float:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:40px;
    padding-left:20px;
    width:1205px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

#funcao2{
    position: absolute;
    margin-left:10px;
    padding-top:5px;
    padding-bottom:5px;
    padding-left:15px;
    width:400px;
    height: 30px;

    text-align:left;
    border-radius: 3px!important;
    border-color: #191970;
    border-style: solid!important;
}


#pesquisar_ca{
    margin-left: 0px;
    position: absolute;
    left: 45%;
    width: 120px;
    height: 30px;
    cursor: pointer;

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


html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}




</style>







</html>
