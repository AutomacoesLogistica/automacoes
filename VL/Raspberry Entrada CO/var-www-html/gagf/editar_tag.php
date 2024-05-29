<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`consultar_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${link_epc.value}`;"/>
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
<input id="epc" type="text" value="" hidden="hidden"/>
<img id="foto" src="./images/validado.png" hidden="hidden"/> 
<fieldset id="formulario_tag" ><legend>Dados TAG</legend>
 <label id="lbEPC_nova">Nova Tag :</label>
 <input id="tbEPC_nova" type="text" name="tbEPC_nova" value="" maxlength="24" pattern="([0-9]{24})"/>
 <label id="info_lbEPC_nova">Digitar os 24 digitos da TAG</label>
 <label id="lbEPC_atual">Tag atual :</label>
 <input id="tbEPC_atual" type="text" name="tbEPC_atual" value="" disabled="disabled"/>
 <label id="lbEPC_descartada">Tag descartada :</label>
 <input id="tbEPC_descartada" type="text" value="" hidden="hidden"/>
 <label id="tipo_atual">Tipo equipamento :</label>
 <input id="resposta_tipo_atual" type="text" value="" disabled="disabled"  />
 <input id="valor_id" type="text" value="" hidden="hidden"/>
 <label id="lbPlaca">Placa Associada :</label>
 <input id="tbPlaca" type="text" name="tbPlaca" value="" maxlength="8"/>
 <img id="foto_placa" src="./images/validado.png"/> 

 <?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_estados");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="localidade" id="localidade">
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



 <label id="tipo">Selecione o tipo equipamento:</label><br/>
 <?php
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tipo_carreta");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="equipamento" id="equipamento" onchange="alterar();">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
    $mensagem = $dados['tipo_carreta'];
    echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if

$sql = $dbcon->query("SELECT * FROM lista_tipo_cavalo");
if(mysqli_num_rows($sql)>0)
{
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
    $mensagem = $dados['tipo_cavalo'];
    echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
</select>


</fieldset>

<script>
function alterar()
{
 var nome = window.document.getElementById('equipamento');
 if((nome.value).match(/CAVALO/))
 {
    link_tipo_equipamento.value = "Cavalo";
 } 
 else
 {
    if(nome.value == "TESTES")
    {
        link_tipo_equipamento.value = "Testes";
    }
    else
    {
    link_tipo_equipamento.value = "Carreta";
    }
 }

}
</script>

</br>
<label id="lbInfoBloqueio" hidden="hidden">TAG/Equipamento Desativado!</label>
<input type="button" name="btnDesativar" id="btnDesativar" value="Desativar" onclick="validar()">

<script>

function validar()
{
 var x;
 if (link_desativada.value == "Desativar")
 {
  var r=confirm("Deseja realmente desativar a tag/equipamento?");
  if (r==true)
  {
   // Clicou em OK
   x="Você acabou de desativar a tag " + link_epc_atual.value + " ou equipamento com placa " + link_placa.value + "!";
   alert(x);
   // chama a pagina para alterar
   location.href=`salvar_bloqueio_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${tbEPC_atual.value}&acao=sim`;
  }
 }
 else // Ta para ativar
 {
  var r=confirm("Deseja realmente ativar esta tag/equipamento?");
  if (r==true)
  {
   // Clicou em OK
   x="Você acabou de ativar a tag " + link_epc_atual.value + " ou equipamento com placa " + link_placa.value + "!";
   alert(x);
   //Chama a pagina para alterar
   location.href=`salvar_bloqueio_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${tbEPC_atual.value}&acao=nao`;
  }
 }
} 
 </script>



<fieldset id="formulario_tra" ><legend>Dados Transportadora</legend>
<label id="lbTRA_nova">Nova Transportadora :</label>

<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$id = 1;

$sql = $dbcon->query("SELECT * FROM lista_transportadoras");

if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="select_transportadoras_nova" id="select_transportadoras_nova" onchange="alterou_transportadora();">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $encontrado = $encontrado +1;
  $mensagem = "a";
  $ultima_mensagem = "b";
  $mensagem = $dados['nome_transportadora'];
  if($ultima_mensagem != $mensagem )
  {
   #salva a mensagem
   $ultima_mensagem = $mensagem;
   echo"<option>$ultima_mensagem</option>";
  }
  else
  {
   #Nao salva
   $ultima_mensagem = $mensagem;
  }
 } // fecha whille
 $ultima_mensagem = "";
 echo"<option SELECTED>$ultima_mensagem</option>";
}
else
{
 echo "Nao encontrado";
}
?>
</select>
</br>
<label id="lbTRA_atual">Transportadora atual :</label>
<input id="tbTRA_atual" type="text" name="tbTRA_atual" value=""  disabled="disabled"/>

<label id="lbTRA_descartada">Transp. descartada :</label>
<input id="tbTRA_descartada" type="text" name="tbTRA_descartada" value=""  disabled="disabled"/>

</fieldset>



<input id="salvar" value="Salvar Alterações" type="button" onclick="salvar()" hidden="hidden"/>




<script>
function alterou_transportadora()
{
    var nova_transportadora = window.document.getElementById('select_transportadoras_nova');
    var tamanho = window.document.getElementById('tbEPC_nova');
     
  if((nova_transportadora.value).length==0 && (tamanho.value).length == 0)
  {
    window.document.getElementById('salvar').style.display='none';  
  }
  else
  {
    window.document.getElementById('salvar').style.display='block'; 
  }

}



</script>






<?php

$epc = $_GET['epc'];

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE epc='$epc'");
$transportadora = "";
$transportadora_anterior = "";
$epc_antiga = "";
$tipo_parte ="";
$placa = "";
$localidade = "";
$desativada = "";
$valor_id  = "";

if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $transportadora = $dados['transportadora_atual'];
  $transportadora_anterior = $dados['transportadora_antiga'];
  $epc_antiga = $dados['epc_antiga'];
  $tipo_parte = $dados['tipo_parte'];
  $tipo_equipamento = $dados['tipo_equipamento'];
  $valor_id = $dados['id'];
  $placa = $dados['placa'];
  $localidade = $dados['localidade'];
  $desativada = $dados['desativada'];
 }
}
else
{
 //Nao encontrada   
}

?>
<script>

var link_epc = window.document.getElementById('epc');
link_epc.value = "<?php print $epc ?>";
var link_epc_antiga = window.document.getElementById('epc');
var link_tipo_equipamento = window.document.getElementById('resposta_tipo_atual');
link_tipo_equipamento.value = "<?php print $tipo_equipamento ?>";
var link_valor_id = window.document.getElementById('valor_id');
link_valor_id.value = "<?php print $valor_id ?>";

var link_placa = window.document.getElementById('tbPlaca');
link_placa.value = "<?php print $placa ?>";

var link_localidade = window.document.getElementById('localidade');
link_localidade.value = "<?php print $localidade ?>";

var link_epc_atual = window.document.getElementById('tbEPC_atual');
link_epc_atual.value = "<?php print $epc ?>";
var link_epc_antiga = window.document.getElementById('lbEPC_descartada');
var link_epc_antiga2 = window.document.getElementById('tbEPC_descartada');
var tag_antiga = "<?php print $epc_antiga ?>";
if(tag_antiga == "")
{
 link_epc_antiga.innerHTML = "Tag descartada : Não será descartado, pois ainda não foi necessário realizar trocas!"
 link_epc_antiga2.value = 'nao cadastrada';
}
else
{
    link_epc_antiga.innerHTML = "Tag descartada : "+ tag_antiga;
    link_epc_antiga2.value = tag_antiga;   
}

var link_transportadora_atual = window.document.getElementById('tbTRA_atual');
link_transportadora_atual.value = "<?php print $transportadora ?>";
var link_transportadora_descartada = window.document.getElementById('tbTRA_descartada');
var valor_transportadora_antiga = "<?php print $transportadora_anterior ?>";

if (valor_transportadora_antiga =="")
{
    link_transportadora_descartada.value = "Não trocou de transportadora!";
}
else
{
    link_transportadora_descartada.value = valor_transportadora_antiga;
}

var equipamento = window.document.getElementById("equipamento");
equipamento.value = "<?php print $tipo_parte ?>";

var link_desativada = window.document.getElementById('btnDesativar');

var desativada = "<?php print $desativada ?>";



if(desativada == "sim")
{
link_desativada.value = "Ativar";
window.document.getElementById('lbInfoBloqueio').style.display="block"; 
window.document.getElementById('tbEPC_nova').disabled=true;
window.document.getElementById('equipamento').disabled=true;
window.document.getElementById('select_transportadoras_nova').disabled=true;
window.document.getElementById('tbPlaca').disabled=true;
window.document.getElementById('localidade').disabled=true;

}
else
{
    link_desativada.value = "Desativar";
    window.document.getElementById('lbInfoBloqueio').style.display="none";
    window.document.getElementById('tbEPC_nova').disabled=false;  
    window.document.getElementById('equipamento').disabled=false;
    window.document.getElementById('select_transportadoras_nova').disabled=false;
    window.document.getElementById('tbPlaca').disabled=false;
    window.document.getElementById('localidade').disabled=false;
}

</script>













<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>


<script>











// tratar limite de texto e aceitar somente numeros no textbox epc
$(document).ready(function() {
  $("#tbEPC_nova").keyup(function() {
      $("#tbEPC_nova").val(this.value.match(/[0-9]*/));
      var tamanho = window.document.getElementById('tbEPC_nova');
      
      if( (tamanho.value).length == 24 )
      {
       window.document.getElementById('info_lbEPC_nova').style.display="none";
       // Entra e verifica se a tag pode ser utilizada
       <?php
       include_once 'conexao.php';
       
       $sql = $dbcon->query("SELECT * FROM lista_tags");
       if(mysqli_num_rows($sql)>0)
       {
        while($dados = $sql->fetch_array())
        {      
        $tag = $dados['epc'];
        ?>
        var tag2 = "<?php print $tag ?>";
        if ( tag2 == tamanho.value)
        {
         encontrado = 1;   
        }
        <?php
        }
       }
       ?>
           
       if (encontrado == 1)
       {
           
           encontrado = 0;
           window.document.getElementById('foto').style.display='none';
           alert("A tag digitada ja está sendo utilizada por outra placa!");
           tamanho.value = "";
           tamanho.focus();
           
       }
       else
       {
         encontrado = 0; 
         window.document.getElementById('foto').style.display='block';
         window.document.getElementById('salvar').style.display='block';
       }
      }
      else
      {
        window.document.getElementById('info_lbEPC_nova').style.display="block";
        encontrado = 0; 
        window.document.getElementById('foto').style.display='none';
        var nova_transportadora = window.document.getElementById('select_transportadoras_nova');
        if((nova_transportadora.value).length == 0)
        {
        window.document.getElementById('salvar').style.display='none';   
        }
        
        
      }
    });
});
//***************************************************************8 */




// tratar limite de texto e aceitar somente numeros no textbox epc
$(document).ready(function() {
  $("#tbPlaca").keyup(function() {
     
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

function salvar()
{
  var tbPlaca = window.document.getElementById('tbPlaca');
  var epc_nova = window.document.getElementById('tbEPC_nova');
  var nova_transportadora = window.document.getElementById('select_transportadoras_nova');
  
  



  if ((tbPlaca.value).length == 8)
  {
   if (epc_nova.value == "")
   {
    epc_nova.value = "nao mudou";  
   }
   //chama a tela para salvar 
   location.href=`salvar_alteracao_tags.php?complemento=${criptografia2.value}&check=${criptografia.value}&id=${valor_id.value}&epc_nova=${tbEPC_nova.value}&epc=${tbEPC_atual.value}&epc_antiga=${tbEPC_descartada.value}&tipo_equipamento=${resposta_tipo_atual.value}&placa=${tbPlaca.value}&localidade=${localidade.value}&tipo_parte=${equipamento.value}&transportadora_nova=${select_transportadoras_nova.value}&transportadora_atual=${tbTRA_atual.value}&transportadora_antiga=${tbTRA_descartada.value}`;
  }
  else
  {
   alert("Favor preencher uma placa válida!");
   tbPlaca.focus();   
  }

}
  
















     






var encontrado = 0;












</script>




</body>

<style>


IMG#foto
{
 position: absolute;
 left: 450px;
 top: 85px; 
 width: 25px;
 height: 25px;

}

INPUT#salvar {
     position: absolute;
     left: 80px;
     top: 445px; 
     width: 215px;
     height: 35px;
     font: verdana;font-size: 12pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

Label#lbEPC_nova{
    position: absolute;
    margin-left: 0px;
    top: 30px;
    left: 20px;
    font: normal 13pt Times;
    color: black;
    background-color: none;

}

input#tbEPC_nova{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 110px;
    top: 30px;
    width:230px;
    height:18px;
    padding-left: 10px;
}



Label#info_lbEPC_nova{
    position: absolute;
    margin-left: 0px;
    top: 30px;
    left: 380px;
    font: normal 13pt Times;
    color: red;
    background-color: none;

}


Label#tipo{
    position: absolute;
    margin-left: 0px;
    top: 30px;
    left: 650px;
    font: normal 13pt Times;
    color: black;
    background-color: none;

}

SELECT#equipamento{
    position: absolute;
    left: 870px;
    top: 30px;
    width: 400px;
    height: 28px;   
}

Label#tipo_atual{
    position: absolute;
    margin-left: 0px;
    top: 70px;
    left: 650px;
    font: normal 13pt Times;
    color: black;
    background-color: none;

}

input#resposta_tipo_atual{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 800px;
    top: 70px;
    width:150px;
    height:18px;
    padding-left: 10px;
}

input#valor_id{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 1100px;
    top: 70px;
    width:50px;
    height:18px;
    padding-left: 10px;
}
Label#lbInfoBloqueio{
    margin-left: 0px;
    position: absolute;
    font: bold 14pt Times;
    color: red;
    background-color: none;
    left: 1070px;
    top: 130px;
}
input#btnDesativar{ 
    font: verdana;font-size: 12pt;
    color: #FFFFFF;
    background-color: #00008B;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
    cursor: pointer;
    position: absolute;
    left: 1180px;
    top: 166px;
    width:160px;
    height:28px;
    padding-left: 10px;
}



Label#lbPlaca{
    margin-left: 0px;
    position: absolute;
    font: normal 13pt Times;
    color: black;
    background-color: none;
    left: 650px;
    top: 108px;
}
input#tbPlaca{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 800px;
    top: 108px;
    width:120px;
    height:18px;
    padding-left: 10px;
}

IMG#foto_placa
{
 position: absolute;
 left: 940px;
 top: 108px; 
 width: 25px;
 height: 25px;

}

SELECT#localidade{
    position: absolute;
    left: 1005px;
    top: 108px;
    width: 60px;
    height: 25px;   
}


Label#lbEPC_atual{
    margin-left: 0px;
    position: absolute;
    font: normal 13pt Times;
    color: black;
    background-color: none;
    left: 20px;
    top: 65px;
}

input#tbEPC_atual{
    margin-left: 0px;
    position: absolute;
    font: normal 12pt Times;
    color: black;
    background-color: none;
    left: 110px;
    top: 65px;
    width:230px;
    height:18px;
    padding-left: 10px;
}
Label#lbEPC_descartada{
    margin-left: 0px;
    position: absolute;
    font: normal 13pt Times;
    color: black;
    background-color: none;
    left: 20px;
    top: 100px;
}
fieldset#formulario_tag{
    position: absolute;
    margin-left:0px;
    top: 60px;
    left:80px;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:20px;
    width:1350px;
    height: 120px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

Label#lbTRA_nova{
    margin-left: 0px;
    position: absolute;
    font: normal 13pt Times;
    color: black;
    background-color: none;
    left: 20px;
    top: 40px;
}

Select#select_transportadoras_nova {
     width: 640px;
     height: 26px;
     margin-left: 0px;
     position: absolute;
     left: 195px;
     top: 40px;
     font: normal 9pt verdana;
     color: black;
     background-color: White;
     border-color: #00008B;
     border-style: solid!important;
     cursor: pointer;
}
Label#lbTRA_atual{
    margin-left: 0px;
    position: absolute;
    font: normal 13pt Times;
    color: black;
    background-color: none;
    left: 20px;
    top: 80px;
}
input#tbTRA_atual{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    color: black;
    cursor: pointer;
    left: 195px;
    top: 80px;
    width:626px;
    height:23px;
    padding-left: 10px;
}

Label#lbTRA_descartada{
    margin-left: 0px;
    position: absolute;
    font: normal 13pt Times;
    color: black;
    background-color: none;
    left: 20px;
    top: 120px;
}
input#tbTRA_descartada{
    margin-left: 0px;
    position: absolute;
    font: normal 9pt verdana;
    color: black;
    cursor: pointer;
    left: 195px;
    top: 120px;
    width:626px;
    height:23px;
    padding-left: 10px;
}



fieldset#formulario_tra{
    position: absolute;
    top: 230px;
    left: 80px;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:30px;
    padding-left:20px;
    width:1350px;
    height: 140px;
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