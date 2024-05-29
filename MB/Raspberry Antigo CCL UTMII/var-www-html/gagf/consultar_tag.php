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
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`consultar_tag1.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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


<

<?php
}
?>


<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$epc = isset($_GET['epc'])?$_GET['epc']:"00000";
if($epc==NULL){
$epc="00000";
}
$veic = isset($_GET['veic'])?$_GET['veic']:"00000";
$tamanho_epc = 18 - strlen($epc); #busca o tamanho digitado para saber o tanto de zero a inteirar

if(strlen($epc)!=24){

if ($veic == "Carreta"){$epc_inicio = "442002";}else{$epc_inicio = "442001";}
$epc_meio = "";
for($i =0; $i < $tamanho_epc; $i++){
$epc_meio =  $epc_meio."0";
}
$epc = $epc_inicio.$epc_meio.$epc;

}


$placa = "-";
$localidade = "-";

$transportadora_anterior = "";
$transportadora = "";


#BUSCA A FUNCAO ASSOCIANDO O CA DO READER A ANTENA LIDA E BUSCA NO BANCO QUAL A FUNCAO CADASTRADA ******************************************
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE epc='$epc' OR epc_antiga='$epc'");

if(mysqli_num_rows($sql)>0){

while($dados = $sql->fetch_array()){
$placa = $dados['placa'];
$localidade = $dados['localidade'];

if($epc==$dados['epc']){
echo"</br>";echo"</br>";echo"<h3>Dados da TAG</h3>";

echo"Placa : ".$placa."/".$localidade;
echo"<br/>";echo"<br/>";
echo"TAG Atual : " .$dados['epc'];

echo"<br/>";
echo"<br/>";

if ($dados['epc_antiga']=="")
{
 echo"TAG Antiga : Tag ainda não necessitou de ser trocada!";
 
}
else
{
 $dado = $dados['epc_antiga'];
 echo"TAG Antiga : ".$dado;
}


echo"<br/>";
echo"<br/>";


}

if($epc==$dados['epc_antiga']){
echo"Referencia TAG : Antiga";
echo"<br/>";
echo"Placa : ".$placa."/".$localidade;
echo"<br/>";
echo"<br/>";
echo"TAG Atual : ".$dados['epc'];
echo"<br/>";
echo"<br/>";
echo"<br/>";

}

}


#ENTRA E BUSCA AGORA OS DADOS DE TRANSPORTADORA
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placa'");

if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $transportadora = $dados['transportadora_atual'];
  $transportadora_anterior = $dados['transportadora_antiga'];
  $tipo_parte = $dados['tipo_parte'];
 }

echo "Tipo da Parte : ";
echo $tipo_parte;
echo "</br>";

 echo "<h3>Dados da Transportadora</h3>";
 echo"Transportadora Atual : ".$transportadora;
 echo"</br>";

 if ($transportadora =="LOGISTICA")
 {
     echo "<h3>Atenção!</h3> Esta TAG está sendo utilizada para testes de automação internas da logistica de Miguel Burnier e Várzea do Lopes!";
 } 
 
 echo"<br/>";


 if($transportadora_anterior == "")
 {
  echo "</br>Transportadora Anterior = Não trocou de transportadora!";  
 }
 else
 {
 echo"</br>Transportaroda Anterior : ".$transportadora_anterior;
 }
}
else
{
echo"Transportadora ainda nao cadastrada para esta placa!";
}


echo"<br/>";

$achou = "sim";

}
else
{
 echo"<br/>";
 echo"<br/>";
 echo"<br/>";
 echo"<br/>";
 echo "Nao encontrado dados relacionados a esta TAG no banco de dados!";
 $achou = "nao";
}



?>


<br/>
<br/>















<input id="epc" type="text" value="" hidden="hidden"/>
<input type="button" id="btn_pesquisar" class="BotaoMenu" value="Alterar TAG" onclick="validar()"  />

<script>
var tagA ="<?php print $epc ?>"
var achou ="<?php print $achou ?>"

var link = window.document.getElementById('btn_pesquisar');

if(achou =="sim")
{
    window.document.getElementById('btn_pesquisar').style.display='visible';  
}
if(achou=="nao")
{
    window.document.getElementById('btn_pesquisar').style.display='none';
}

</script>





<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>








<script>
function validar()
{
    var epc = window.document.getElementById('epc');
    epc.value = tagA;
 location.href=`editar_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${epc.value}`;



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
    margin-left: 80px;
    margin-top:20px;
}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>