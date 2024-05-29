<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<img id="caminhoes" src="./images/caminhoes.png" />
<img id="logo" src="./images/logo.png" hidden="hidden" />

<?php





?>
<center>
<div id="login">
<form method="post" action="menu.php" autocomplete="off">
<input type="text" name="registro" class="campos" id="registro" a rel="ajuda" placeholder ="Digite seu registro" autocomplete="off"/>
<br/><br/>
<input type="password" name="senha" class="campos" id="senha" a rel="ajuda" placeholder="Digite sua senha de acesso" autocomplete="off"  onmouseover="showMessage()" onmouseout="hideMessage()"/>
<br/><br/>
<input type="submit" value="Logar" class="BotaoMenu"/>
</BR></BR></BR></BR></BR></BR>
<input id='primeiro_acesso' type="buttom" value="Primeiro Acesso" class="BotaoMenu" onclick="javascript: location.href=`primeiro_acesso.php`;"/>


<div class="mensagem" >Para primeiro acesso usar o registro como sua senha!</div>

</div>
<script>
var link_registro = window.document.getElementById('registro');
link_registro.focus();
</script>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</form>


<script>
// Utilizando JQuery
jQuery('senha').attr('autocomplete','off');
// Ou Javascript padrão
senha.setAttribute('autocomplete','off');
</script>

<script>

let mensagem = document.querySelector(".mensagem") ;

// mostra a mensagem
function showMessage(){ 
    mensagem.style.display = "block";   
 }
// esconde a mensagem
function hideMessage(){
  mensagem.style.display = "none"; 
  
}



</script>

</body>



<style>


.mensagem{
  display:none;
  position:absolute;
  top: 40%; /* Usei % para que voce entenda que da para se adaptar com o tamanho do botão/container ou qualquer outra coisa a qual a mensagem esta relacionada*/
  left:250px;
  right:0;
  margin: auto;
  width:400px;
  height:20px;
  border:0px solid red;
}

#primeiro_acesso
{
 text-align: center;   
}

IMG#caminhoes{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 120px;
    width: 250px;
    height: 170px;
    cursor: pointer;

}
IMG#logo{
    margin-left: 0px;
    position: absolute;
    left: 43%;
    top: 20px;
    width: 130px;
    height: 45px;
    cursor: pointer;

}
INPUT.BotaoMenu {
     width: 250px;
     height: 35px;
     font-weight: bold
     font-family: verdana;font-size: 12pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 8px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

DIV#login{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 330px;
    
}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 88%;
}
body{

margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}

.campos{
    float:top;
    margin-left:0px;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:20px;
    font-family: verdana;font-size: 8pt;
    width:240px;
    height:10px;
    text-align:left;
    border-radius: 9px!important;
    border-color: #191970;
    border-style: solid!important;
}

















</style>



</html>