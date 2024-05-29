<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_rom.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
window.Notification="Senha Incorreta!";
window.location="login.php";
</script>

<?php
}


$dentro_do_patio = "";
?>

<!-- AQUI ABAIXO ENTRA OS DADOS DA PAGINA  -->


<fieldset id="formulario1"><legend>Configurações do Pátio</legend>

<form id="formulario">
  <label id="lb_num">Número de veiculos permitidos dentro do pátio</label>
  <label id="lb_nu3">Número de veiculos agora dentro do pátio</label>
 
  <label id="lb_num2">Obs: Máximo permitido é 20 veiculos</label>
  <label id="lb_num4">Obs: Ajuste com a realidade do pátio!</label>
  
  <label id='mat'>Definição de materiais nas baias</label>
  <?php
  include_once 'conexao_rom.php';
  $sql = $dbcon->query("SELECT * FROM acessos WHERE id=1");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   {
    $valor = $dados['limite']; 
    $dentro_do_patio = $dados['dentro'];
    ?>
    <input type="number" name="limite" id="limite"  min="1" max="20" maxlength="2"  autocomplete="off" value='<?php print $valor ?>'>
    <input type="number" name="dentro" id="dentro"  min="0" max="20" maxlength="2"  autocomplete="off" value='<?php print $dentro_do_patio ?>'>
    <?php
   } // fecha o while
  }// fecha o if
  if($dentro_do_patio <=0 )
  {
      $dentro_do_patio = 0;
  }
  if($dentro_do_patio == "")
  {
    $dentro_do_patio = 0;  
  }
  
  $v_area1 = "";
  $v_area2 = "";
  $v_area3 = "";
 
  $v_baia1 = "";
  $v_baia2 = "";
  $v_baia3 = "";
   
  $material_baia1 = "";
  $material_baia2 = "";
  $material_baia3 = "";

 // BUSCO OS VALORES DOS PATIOS
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM baias");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
    $v_area1 = $dados['v_area1'];
    $v_area2 = $dados['v_area2'];
    $v_area3 = $dados['v_area3'];
    
    $v_baia1 = $dados['v_baia1'];
    $v_baia2 = $dados['v_baia2'];
    $v_baia3 = $dados['v_baia3'];

    $material_baia1 = $dados['baia1'];
    $material_baia2 = $dados['baia2'];
    $material_baia3 = $dados['baia3'];
    

   
 }
}// fecha o if
  ?>


<label id="lb_info_area">AREA</label>
<label id="lb_info_baia">BAIA</label>
<label id="lb_info_material">MATERIAL</label>



 <!-- PRIMEIRO MATERIAL *************************************************************** -->
<label id="lb_primeiro_material">1° Material</label>
<?php

// BUSCA OS VALORES PARA BAIA
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM area");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_primeiro_area" id="sl_primeiro_area">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>
<?php

// BUSCA OS VALORES PARA BAIA
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM nome_baia");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_primeiro_baia" id="sl_primeiro_baia">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>
<?php

// BUSCA O PRIMEIRO MATERIAL
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM materiais");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_primeiro_material" id="sl_primeiro_material">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>


<!-- SEGUNDO MATERIAL *************************************************************** -->
<label id="lb_segundo_material">2° Material</label>
<?php

// BUSCA OS VALORES PARA BAIA
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM area");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_segundo_area" id="sl_segundo_area">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>
<?php

// BUSCA OS VALORES PARA BAIA
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM nome_baia");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_segundo_baia" id="sl_segundo_baia">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>
<?php

// BUSCA O SEGUNDO MATERIAL
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM materiais");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_segundo_material" id="sl_segundo_material">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>


<!-- TERCEIRO MATERIAL *************************************************************** -->
<label id="lb_terceiro_material">3° Material</label>
<?php

// BUSCA OS VALORES PARA BAIA
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM area");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_terceiro_area" id="sl_terceiro_area">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>
<?php

// BUSCA OS VALORES PARA BAIA
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM nome_baia");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_terceiro_baia" id="sl_terceiro_baia">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>
<?php

// BUSCA O TERCEIRO MATERIAL
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM materiais");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_terceiro_material" id="sl_terceiro_material">
 <?php
 $encontrado = 0;
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['nome'];
  echo"<option>$mensagem</option>";
 } // fecha o while
}// fecha o if
?>
 </select>



<script>


// valores das areas
var link_area_baia1 = window.document.getElementById("sl_primeiro_area");
var valor_area1 = '<?php echo $v_area1 ?>';
link_area_baia1.value = valor_area1;

var link_area_baia2 = window.document.getElementById("sl_segundo_area");
var valor_area2 = '<?php echo $v_area2 ?>';
link_area_baia2.value = valor_area2;

var link_area_baia3 = window.document.getElementById("sl_terceiro_area");
var valor_area3 = '<?php echo $v_area3 ?>';
link_area_baia3.value = valor_area3;


//valores das baias
var link_baia_baia1 = window.document.getElementById("sl_primeiro_baia");
var valor_baia1 = '<?php echo $v_baia1 ?>';
link_baia_baia1.value = valor_baia1;

var link_baia_baia2 = window.document.getElementById("sl_segundo_baia");
var valor_baia2 = '<?php echo $v_baia2 ?>';
link_baia_baia2.value = valor_baia2;


var link_baia_baia3 = window.document.getElementById("sl_terceiro_baia");
var valor_baia3 = '<?php echo $v_baia3 ?>';
link_baia_baia3.value = valor_baia3;




// valores dos materiais
var link_baia1 = window.document.getElementById("sl_primeiro_material");
var valor_baia1 = '<?php echo $material_baia1 ?>';
link_baia1.value = valor_baia1;

var link_baia2 = window.document.getElementById("sl_segundo_material");
var valor_baia2 = '<?php echo $material_baia2 ?>';
link_baia2.value = valor_baia2;

var link_baia3 = window.document.getElementById("sl_terceiro_material");
var valor_baia3 = '<?php echo $material_baia3 ?>';
link_baia3.value = valor_baia3;




</script>



<input type="button" id="salvar" name="salvar" value="Alterar Dados do Patio">

<label id='mat2'>Mensagem para motorista - Só será exibida a mensagem se todas as baias estiverem como FECHADA!</label>
<input type='text' id='mensagem_motorista' name='mensagem_motorista' value='' />

<?php
// BUSCA O TERCEIRO MATERIAL
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM baias_mensagem WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $mensagem = $dados['mensagem'];
 } // fecha o while
}// fecha o if
?>
<script>
var mensagem = window.document.getElementById('mensagem_motorista');
mensagem.value = '<?php print $mensagem ?>';
//console.log('<?php print $mensagem ?>');
</script>
</form>
</fieldset>
  



<fieldset id="formulario2"><legend>Informação do Pátio</legend>
<label id="lb_patio" >Número de caminhões dentro do pátio :</label>
<label id="lb_patio_n" >--</label>
<label id="lb_ocupacao" >Ocupação :</label>
<label id="lb_ocupacao_n" >--</label>
<label id="info" >Patio Cheio!</label> 

<script>
var link_n = window.document.getElementById("lb_patio_n");
var num = '<?php echo $dentro_do_patio ?>';
link_n.innerHTML = num;

var link_oc_n = window.document.getElementById("lb_ocupacao_n");
var limite = '<?php echo $valor ?>';
var valor  = (num/limite )*100 ;
valor = valor.toFixed(1);
link_oc_n.innerHTML = valor +"%";
if (valor== 100)
{
 pisca();
}
else
{
    window.document.getElementById("info").hidden=true;
}




function pisca() {
      
  var f = document.getElementById('info');
  setInterval(function() {
    f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
  }, 800);


}
</script>
<input type="button" id="zerar" name="zerar" value="Zerar Ocupação Patio" onclick="clicou_zerar();">
<input type="button" id="normalizar" name="normalizar" value="Normalizar Semáforos" onclick="clicou_normalizar();">
<input type="button" id="rom" name="rom" value="Voltar para Automações ROM" onclick="clicou_voltar_automacao_rom();">
</fieldset>
<br/>










<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>


<div id="info_zerar"  >
<label id='lb_info_zerar2'>ATENÇÃO!</label>
<label id='lb_info_zerar'>Deseja realmente zerar o numero de ocupação do pátio de rom?</label>
<input type="button" id="sim" name="sim" value="SIM" onclick="clicou_sim();">
<input type="button" id="nao" name="nao" value="NÃO" onclick="clicou_nao();">
</div>
<script>
    document.getElementById('info_zerar').style.visibility='hidden';
</script>



<script>
$(document).ready(function (){
    $("#salvar").click(function (){
       var form = new FormData($("#formulario")[0]);
       $.ajax({
           url: 'salva_dados_rom.php',
           type: 'POST',
           dataType: 'html',
           cache: false,
           processData: false,
           contentType: false,
           data: form,
           timeout: 8000,
           success: function(resultado){
           //$("#resposta").html(resultado);
           document.location.reload(true);
           }
       });
    });
});

</script>





<script>

function clicou_normalizar()
{
 <?php 
 $ip = $_SERVER['REMOTE_ADDR']; 
 if($ip == "192.168.20.1")
 {
 ?>
  //Faz o get para normalizar!
 const url = "http://138.0.77.80:5050/AutomacaoGerdau/monitor_rom.php?id=04&mensagem=normalizou";//Sua URL
  fetch(url);
  <?php
 } // Fecha if para ip externo
 else
 {
 ?>
 //Faz o get para normalizar!
 const url = "http://192.168.20.66/AutomacaoGerdau/monitor_rom.php?id=04&mensagem=normalizou";//Sua URL
 fetch(url);
 <?php
 } // Fecha else
 ?>
 
    //alert('Em desenvolvimento!'); 
 
}


function clicou_zerar()
{
 document.getElementById('info_zerar').style.visibility = 'visible';
 document.getElementById("formulario1").disabled = true;
 document.getElementById("formulario2").disabled = true;
}


function clicou_voltar_automacao_rom()
{
 location.href=`tela_rom.php?complemento=${criptografia2.value}&check=${criptografia.value}`;  
}


function clicou_sim()
{
 document.getElementById('info_zerar').style.visibility = 'hidden';
 
 //Faz o post para zerar o post
       $.ajax({
           url: 'salva_dados_rom2.php',
           type: 'POST',
           dataType: 'html',
           cache: false,
           processData: false,
           contentType: false,
           data: 'valor=sim',
           timeout: 8000,
           success: function(resultado){
           //$("#resposta").html(resultado);
           }
       });
    
 
 document.getElementById("formulario1").disabled = false;
 document.getElementById("formulario2").disabled = false;
 document.location.reload(true);
}







function clicou_nao()
{
 document.getElementById('info_zerar').style.visibility = 'hidden';
 document.getElementById("formulario1").disabled = false;
 document.getElementById("formulario2").disabled = false;
}


</script>


</body>

<style>

INPUT#rom
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:43.2%;
    top: -60%;
    width:280px;
    height: 45px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#rom:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#rom:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

DIV#info_zerar{
    position: absolute;
    left: 40%;
    top: 40%;
    background-color: #ADD8E6;
    width:300px;
    height: 180px;
    text-align:left;

    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}
LABEL#lb_info_zerar2{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 5%;
    font: bold 13pt verdana;
    color:	#000000;
}
LABEL#lb_info_zerar{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 19%;
    font: normal 14pt verdana;
    color:	#000000;
}


INPUT#sim
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #00FF7F;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sim:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sim:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#nao
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:55%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#nao:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#nao:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

















#formulario1{
    position: absolute;
    left: 8%;
    top: 10%;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1190px;
    height: 350px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}

LABEL#lb_num{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 5%;
    font: normal 16pt verdana;
    color:	#000000;
}
LABEL#lb_num2{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    top: 5%;
    font: normal 16pt verdana;
    color:	#000000;
}
INPUT#limite{
    margin-left: 0px;
    position: absolute;
    left: 45%;
    top: 4%;
    width: 60px;
    font: normal 16pt verdana;
    color:	#000000;
}
INPUT#dentro{
    margin-left: 0px;
    position: absolute;
    left: 45%;
    top: 13%;
    width: 60px;
    font: normal 16pt verdana;
    color:	#000000;
}

LABEL#lb_nu3{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 12%;
    font: normal 16pt verdana;
    color:	#000000;
}
LABEL#lb_num4{
    margin-left: 0px;
    position: absolute;
    left: 52%;
    top: 12%;
    font: normal 16pt verdana;
    color:	#000000;
}





LABEL#mat{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 22%;
    font: bold 16pt verdana;
    color:	#1C1C1C;
}



LABEL#mat2{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 77%;
    font: bold 15pt verdana;
    color:	#1C1C1C;
}

INPUT#mensagem_motorista{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 86%;
    width: 52%;
    height: 26px;
    font: bold 12pt verdana;
    color:	#1C1C1C;
}








LABEL#lb_info_area{
    margin-left: 0px;
    position: absolute;
    left: 19.3%;
    top: 33%;
    font: bold 14pt verdana;
    color:	#1C1C1C;
}

LABEL#lb_info_baia{
    margin-left: 0px;
    position: absolute;
    left: 33%;
    top: 33%;
    font: bold 14pt verdana;
    color:	#1C1C1C;
}


LABEL#lb_info_material{
    margin-left: 0px;
    position: absolute;
    left: 46%;
    top: 33%;
    font: bold 14pt verdana;
    color:	#1C1C1C;
}

DIV#resposta{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 37%;
    width: 200px;
    height: 100px;
    background-color: red;
    font: normal 16pt verdana;
    color:	#000000;
}

LABEL#lb_primeiro_material{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 41%;
    font: normal 16pt verdana;
    color:	#000000;
}

SELECT#sl_primeiro_area{
    margin-left: 0px;
    position: absolute;
    left: 18%;
    top: 41%;
    width: 100px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

SELECT#sl_primeiro_baia{
    margin-left: 0px;
    position: absolute;
    left: 29%;
    top: 41%;
    width: 140px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

SELECT#sl_primeiro_material{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 41%;
    width: 200px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}



LABEL#lb_segundo_material{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 52.5%;
    font: normal 16pt verdana;
    color:	#000000;
}

SELECT#sl_segundo_area{
    margin-left: 0px;
    position: absolute;
    left: 18%;
    top: 52.5%;
    width: 100px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

SELECT#sl_segundo_baia{
    margin-left: 0px;
    position: absolute;
    left: 29%;
    top: 52.5%;
    width: 140px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

SELECT#sl_segundo_material{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 52.5%;
    width: 200px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}



LABEL#lb_terceiro_material{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 64%;
    font: normal 16pt verdana;
    color:	#000000;
}

SELECT#sl_terceiro_area{
    margin-left: 0px;
    position: absolute;
    left: 18%;
    top: 64%;
    width: 100px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

SELECT#sl_terceiro_baia{
    margin-left: 0px;
    position: absolute;
    left: 29%;
    top: 64%;
    width: 140px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

SELECT#sl_terceiro_material{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 64%;
    width: 200px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}





LABEL#lb_patio{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 10%;
    font: normal 16pt verdana;
    color:	#000000;
}

LABEL#lb_patio_n{
    margin-left: 0px;
    position: absolute;
    left: 39%;
    top: 0%;
    font: bold 30pt verdana;
    color:	#000000;
}

LABEL#lb_ocupacao{
    margin-left: 0px;
    position: absolute;
    left: 45%;
    top: 10%;
    font: normal 16pt verdana;
    color:	#000000;
}
LABEL#lb_ocupacao_n{
    margin-left: 0px;
    position: absolute;
    left: 56%;
    top: 0%;
    font: bold 30pt verdana;
    color:	#000000;
}

LABEL#info{
    margin-left: 0px;
    position: absolute;
    left: 74%;
    top: 10%;
    font: bold 30pt verdana;
    color:	#000000;
    padding: 10px;
    background-color: #DC143C;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
}

INPUT#salvar
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:65%;
    top: 43%;
    width:320px;
    height:100px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#salvar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#salvar:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#zerar
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:83.8%;
    top: -60%;
    width:200px;
    height:45px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#zerar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#zerar:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


INPUT#normalizar
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:66.8%;
    top: -60%;
    width:200px;
    height:45px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#normalizar:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#normalizar:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}






#formulario2{
    position: absolute;
    left: 8%;
    top: 68%;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1190px;
    height: 80px;
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