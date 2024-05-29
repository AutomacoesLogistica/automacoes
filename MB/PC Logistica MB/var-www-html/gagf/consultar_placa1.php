<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> // Tratar as placas com jquery
</script> 
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_gestao_gagf.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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

echo"<br/>";echo"<br/>";
echo "<b><h3>Pesquisando em função da Placa</h3></b>";

?>

<fieldset id="formulario"><legend>PLACA</legend>
<label id="lbPlaca">Digite a PLACA:</label>
<input id="tbPlaca" type="Text" name="placa"  placeholder="xxx-0000" maxlength="8"/>
<img id="foto_placa" src="./images/validado.png" hidden='hidden'/> 
<input id="btnPesquisar" style="margin-left: 10px;" type="button" value="Pesquisar" onclick="pesquisar();"/>
</fieldset>
<br/>
<br/>
</form>
</div>




























<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>







<script>
// tratar limite de texto e aceitar somente numeros no textbox epc
$(document).ready(function() {
  $("#tbPlaca").keyup(function() {
    $(this).val($(this).val().toUpperCase());  
      var tamanho2 = window.document.getElementById('tbPlaca');
      
      
      if( (tamanho2.value).length == 8 )
      {
        window.document.getElementById('foto_placa').style.display='block';
      }
      else
      {
        window.document.getElementById('foto_placa').style.display='none';
        tamanho2.focus();
       
      }
    });
});
//***************************************************************8 */

function pesquisar()
{
    var tamanho2 = window.document.getElementById('tbPlaca');
    if( (tamanho2.value).length == 8 )
    {
        location.href=`consultar_placa.php?complemento=${criptografia2.value}&check=${criptografia.value}&placa=${tbPlaca.value}`;
    }
    else
    {
     alert("Favor preencher uma placa válida!");
     tamanho2.focus();
    }  
}

</script>


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

#formulario{
    position: absolute;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:40px;
    padding-left:20px;
    width:1205px;
    top: 100px;
    left: 80px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

LABEL#lbPlaca{
    position: absolute;
    left: 30px;
    top: 40px;  
}

INPUT#tbPlaca{
    position: absolute;
    left: 150px;
    top: 35px;  
    width: 100px;
    height: 20px; 
}

IMG#foto_placa
{
 position: absolute;
 left: 260px;
 top: 32px; 
 width: 25px;
 height: 25px;

}

INPUT#btnPesquisar {
     position: absolute;
     left: 300px;
     top: 32px; 
     width: 150px;
     height: 28px;
     font: verdana;font-size: 12pt;
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
padding-left:70px;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>