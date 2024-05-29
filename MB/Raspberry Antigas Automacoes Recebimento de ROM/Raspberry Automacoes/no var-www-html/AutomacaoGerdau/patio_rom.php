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
 
  <label id="lb_num2">Obs: Máximo permitido é 20 veiculos</label>
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
  
 
 
  $v_baia1 = "";
  $v_baia2 = "";
  $v_baia3 = "";


 // BUSCO OS VALORES DOS PATIOS
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM baias");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
    $v_baia1 = $dados['baia1'];
    $v_baia2 = $dados['baia2'];
    $v_baia3 = $dados['baia3'];
    

   
 }
}// fecha o if
  ?>

<!-- BAIA 01 *************************************************************** -->
<label id="lb_baia1">BAIA 01</label>
<?php
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM materiais");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_baia1" id="sl_baia1">
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
 
<!-- BAIA 02 *************************************************************** -->
<label id="lb_baia2">BAIA 02</label>
<?php
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM materiais");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_baia2" id="sl_baia2">
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

<!-- BAIA 03 *************************************************************** -->
<label id="lb_baia3">BAIA 03</label>
<?php
include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM materiais");
if(mysqli_num_rows($sql)>0)
{
 ?>
 <select name="sl_baia3" id="sl_baia3">
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

var link_baia1 = window.document.getElementById("sl_baia1");
var valor_baia1 = '<?php echo $v_baia1 ?>';
link_baia1.value = valor_baia1;

var link_baia2 = window.document.getElementById("sl_baia2");
var valor_baia2 = '<?php echo $v_baia2 ?>';
link_baia2.value = valor_baia2;

var link_baia3 = window.document.getElementById("sl_baia3");
var valor_baia3 = '<?php echo $v_baia3 ?>';
link_baia3.value = valor_baia3;




</script>



<input type="button" id="salvar" name="salvar" value="Alterar Dados do Patio">

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

</fieldset>
<br/>




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
           }
       });
    });
});








</script>






<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<style>


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
    top: 5%;
    width: 60px;
    font: normal 16pt verdana;
    color:	#000000;
}

LABEL#mat{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 22%;
    font: bold 18pt verdana;
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

LABEL#lb_baia1{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 37%;
    font: normal 16pt verdana;
    color:	#000000;
}

SELECT#sl_baia1{
    margin-left: 0px;
    position: absolute;
    left: 12%;
    top: 37%;
    width: 300px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

LABEL#lb_baia2{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 52%;
    font: normal 16pt verdana;
    color:	#000000;
}

SELECT#sl_baia2{
    margin-left: 0px;
    position: absolute;
    left: 12%;
    top: 52%;
    width: 300px;
    height: 28px;
    font: normal 13pt verdana;
    color:	#000000;
}

LABEL#lb_baia3{
    margin-left: 0px;
    position: absolute;
    left: 2%;
    top: 67%;
    font: normal 16pt verdana;
    color:	#000000;
}

SELECT#sl_baia3{
    margin-left: 0px;
    position: absolute;
    left: 12%;
    top: 68%;
    width: 300px;
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
    left:52%;
    top: 30%;
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