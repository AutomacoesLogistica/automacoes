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
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`menu_gestao_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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


<h2>Cadastrando uma nova TAG</h2>

<fieldset id="formulario"><legend>Tipo de Veiculo</legend>
<input type="radio" name="veic" id="car" value="Carreta" checked  onclick="carrega_carreta()"/>
<label for="car">Carreta</label>
<input type="radio" name="veic" id="cav" value="Cavalo" onclick="carrega_cavalo()"/>
<label for="cav">Cavalo</label><br/>
<input id="vveiculo" type="text" name="vveiculo" hidden="hidden"/>
<label id="tipo">Selecione o tipo equipamento:</label><br/>
<?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tipo_carreta");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="equipamento" id="equipamento">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
    $mensagem = $dados['tipo_carreta'];
    echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
</select>

</fieldset>

<fieldset id="formulario2"><legend>Tag</legend>
<label id="tag">Digite a TAG:</label><br/>
<input id="epc" type="text" maxlength="6" pattern="([0-9]{6})"/>
<input id="epc2" type="text" name="epc2" hidden="hidden"/>
<label id="lb_tag2">Atenção: Máximo 6 digitos, insira apenas o codigo da tag!</label><br/>
</fieldset><br/>

<fieldset id="formulario3"><legend>Transportadora</legend>
<label id="transportadora">Selecione a transportadora:</label><br/>
<!-- colocar aqui o option    -->
<?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_transportadoras");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="nome_transportadora" id="nome_transportadora">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
    $mensagem = $dados['nome_transportadora'];
    echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
</select>
</fieldset><br/>


<fieldset id="formulario4"><legend>Placa do Veículo</legend>
<label id="placa">Digite a Placa:</label><br/>
<input id="v_placa" type="text" name="v_placa" maxlength="8"/>
<img id="foto_placa" src="./images/validado.png" hidden='hidden'/> 
<label id="localidade">Selecione o estado:</label><br/>
<?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_estados");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="v_estado" id="v_estado">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
    $mensagem = $dados['localidade'];
    echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
</select>
</fieldset><br/>



<input id= "enviar" style="margin-left: 10px;" type="submit" value="Cadastrar" onclick="validar()"/>

























<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

<script>


function carrega_carreta()
{
    var link_cavalo = document.getElementById("equipamento"); 
    // Limpando os dados
    while (link_cavalo.length) { 
        link_cavalo.remove(0);
    }
    var opt = document.createElement("option");
    var opt2 = document.createElement("option");
    var i = 0;
    var valores = ["0","1"];
    
    <?php
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM lista_tipo_carreta");
    $encontrado = 0;
    
    if(mysqli_num_rows($sql)>0)
    {
    while($dados = $sql->fetch_array())
    {
     $mensagem = $dados['tipo_carreta'];
     ?>
     valores[i] ="<?php print $mensagem ?>";
     i++; 
     <?php
     
 } // fecha o while
}// fecha o if
?>
var quantidade = 0;
quantidade = valores.length;
createOptions(quantidade);
function createOptions(quantidade) {
  let fieldSelect = document.getElementById('equipamento');
  for (let a = 0; a < quantidade; a++) {
    let option = document.createElement('option');
    option.text = valores[a];
    fieldSelect.append(option);
  }
}   
} // Fecha carregar carreta

function carrega_cavalo()
{
    var link_cavalo = document.getElementById("equipamento"); 
    // Limpando os dados
    while (link_cavalo.length) { 
        link_cavalo.remove(0);
    }
    var opt = document.createElement("option");
    var opt2 = document.createElement("option");
    var i = 0;
    var valores = ["0","1"];
    
    <?php
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM lista_tipo_cavalo");
    $encontrado = 0;
    
    if(mysqli_num_rows($sql)>0)
    {
    while($dados = $sql->fetch_array())
    {
     $mensagem = $dados['tipo_cavalo'];
     ?>
     valores[i] ="<?php print $mensagem ?>";
     i++; 
     <?php
     
 } // fecha o while
}// fecha o if
?>
var quantidade = 0;
quantidade = valores.length;
createOptions(quantidade);
function createOptions(quantidade) {
  let fieldSelect = document.getElementById('equipamento');
  for (let a = 0; a < quantidade; a++) {
    let option = document.createElement('option');
    option.text = valores[a];
    fieldSelect.append(option);
  }
}

} // Fecha carregar_cavalo








// tratar limite de texto e aceitar somente numeros no textbox epc
$(document).ready(function() {
  $("#epc").keyup(function() {
      $("#epc").val(this.value.match(/[0-9]*/));
  });
});
//***************************************************************8 */




// tratar limite de texto e aceitar somente numeros no textbox epc
$(document).ready(function() {
  $("#v_placa").keyup(function() {
     
      var tamanho2 = window.document.getElementById('v_placa');
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







function validar()
{
 var radios = document.getElementsByName("veic");
 var epc = window.document.getElementById("epc");
 var epc2 = window.document.getElementById("epc2");
 var transportadora = window.document.getElementById("nome_transportadora");
 var placa = window.document.getElementById("v_placa");
 var estado = window.document.getElementById("v_estado");
 var tag = "";
 var tag_ok = "";
 var vveiculo = window.document.getElementById("vveiculo");
 var veiculo = "";
 var validar_placa = (placa.value).length;
 
 if(epc.value!="" && placa.value!="" && validar_placa>=7 )
 {
  // Pode salvar
  if (radios[0].checked)
   {
   var tamanho = "";
   veiculo = "Carreta";
   tamanho = (epc.value).length;     
   var completar = 0;
   completar = (24-(tamanho+6));
   //alert(completar);
   tag = "442002";
   var a = 1;
   for(a=1;a<=completar;a++)
   {
    tag += "0";
   }
   tag = tag + epc.value;
   //alert(tag);
   }
   if (radios[1].checked)
   {
   //alert("Cavalo");
   var tamanho = "";
   veiculo = "Cavalo";
   tamanho = (epc.value).length;     
   var completar = 0;
   completar = (24-(tamanho+6));
   //alert(completar);
   tag = "442001";
   var a = 1;
   for(a=1;a<=completar;a++)
   {
    tag += "0";
   }
   tag = tag + epc.value;
   //alert(tag);
   }

   //alert (tag);
   vveiculo.value=(veiculo);
   epc2.value=(tag);
   location.href=`salvar_cadastro_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&veiculo=${vveiculo.value}&equipamento=${equipamento.value}&tag=${epc2.value}&transportadora=${nome_transportadora.value}&placa=${v_placa.value}&localidade=${v_estado.value}`;







 }
 else
 {
    if(epc.value=="")
   {
   alert("Favor Preencher o valor da TAG!")
   epc.focus();
   }
   if(placa.value=="")
   {
    alert("Favor preencher o valor da placa!");
    placa.focus();
   }
   if (validar_placa<7 && validar_placa!=0)
   {
    alert("Favor preencher uma placa válida!");
    placa.focus();   
   }
   
 }

   
  





}




</script>






</body>




<style>



#formulario{
    position: absolute;
    left: 65px;
    top: 100px;  
    margin-left:0px;
    padding-top:20px;
    padding-bottom:10px;
    padding-left:20px;
    width:1345px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

#formulario2{
    position: absolute;
    left: 65px;
    top: 195px;  
    margin-left:0px;
    padding-top:20px;
    padding-bottom:25px;
    padding-left:20px;
    width:1345px;
    height: 40px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}
#formulario3{
    position: absolute;
    left: 65px;
    top: 295px;  
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1345px;
    height: 40px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

#formulario4{
    position: absolute;
    left: 65px;
    top: 395px;  
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1345px;
    height: 40px;
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

LABEL#tipo{
    position: absolute;
    left: 205px;
    top: 40px;  
}

SELECT#equipamento{
    position: absolute;
    left: 415px;
    top: 40px;
    width: 400px;
    height: 28px;   
}

LABEL#tag{
    position: absolute;
    left: 25px;
    top: 30px;  
}
LABEL#lb_tag2{
    position: absolute;
    left: 205px;
    top: 30px;
    color: red;  
}


INPUT#epc{
    position: absolute;
    left: 130px;
    top: 27px;  
    width: 60px;
    height: 22px; 
}
INPUT#epc2{
    position: absolute;
    left: 235px;
    top: 30px;  
    width: 200px;
    height: 22px; 
}


LABEL#transportadora{
    position: absolute;
    left: 25px;
    top: 30px;  
}
SELECT#nome_transportadora{
    position: absolute;
    left: 215px;
    top: 30px;
    width: 800px;
    height: 28px;   
}

INPUT#placa{
    position: absolute;
    left: 135px;
    top: 30px;  
    width: 200px;
    height: 22px; 
}

INPUT#v_placa{
    position: absolute;
    left: 135px;
    top: 30px;  
    width: 70px;
    height: 22px; 
}

IMG#foto_placa
{
 position: absolute;
 left: 220px;
 top: 30px; 
 width: 25px;
 height: 25px;

}


LABEL#localidade{
    position: absolute;
    left: 290px;
    top: 35px;  
}

SELECT#v_estado{
    position: absolute;
    left: 425px;
    top: 30px;
    width: 60px;
    height: 28px;   
}







INPUT#enviar {
     position: absolute;
     left: 60px;
     top: 505px; 
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
margin-top: -25px !important;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>