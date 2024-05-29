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
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`consultar_placa1.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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

<!-- AQUI ABAIXO ENTRA OS DADOS DA PAGINA  -->

<input id="tbEPC" type="text" value="" hidden="hidden"/>

<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$placa = $_GET['placa'];
$pesquisou = 1;
$encontrou = 0;
#BUSCA A FUNCAO ASSOCIANDO O CA DO READER A ANTENA LIDA E BUSCA NO BANCO QUAL A FUNCAO CADASTRADA ******************************************
$sql = $dbcon->query("SELECT * FROM lista_tags WHERE placa='$placa'");

if(mysqli_num_rows($sql)>0)
{
    $encontrou = 1;
 while($dados = $sql->fetch_array())
 {
  $epc = $dados['epc'];
  $epc_antiga = $dados['epc_antiga'];
  $transportadora_atual = $dados['transportadora_atual'];
  $transportadora_antiga = $dados['transportadora_antiga'];
  $localidade = $dados['localidade'];
  $tipo_parte = $dados['tipo_parte'];
  $tipo_equipamento = $dados['tipo_equipamento'];
  echo"<br/>";echo"<br/>";
  echo "<b><h3>Dados da TAG ************************************************************************</h3></b>";
  echo"As TAG's associadas a esta placa são: ";
  echo"<br/>";echo"<br/>";
  echo "Placa Atual :  ";echo $placa; echo "/"; echo $localidade;echo"<br/>";echo"<br/>";
  echo"TAG Atual :  ";echo $epc;echo"<br/>";echo"<br/>";
  echo"TAG Antiga :  ";
  if($epc_antiga==NULL OR $epc_antiga == " ")
  {
   echo"Esta placa ainda não necessitou de efetuar a troca da TAG!";
   echo"<br/>";echo"<br/>";
  }
  else
  {
   echo $epc_antiga;
   echo"<br/>";echo"<br/>";
  }
  echo "<b><h3>Dados de Transportadora ***************************************************************</h3></b>";
  echo "Transportadora Atual :  "; echo $transportadora_atual;echo"</br></br>";
  echo "Transportadora Antiga :  ";
  if($transportadora_antiga == "")
  {
   echo "Não foi realizado ainda a troca de transportadora!";
  }
  else
  {
   echo $transportadora_antiga;
  }
  echo "</br></br>";
  echo "<b><h3>Dados do Veiculo **********************************************************************</h3></b>";
  echo "Tipo do Equipamento :  ";echo $tipo_equipamento; echo"</br></br>";
  echo "Tipo da Parte :  ";echo $tipo_parte;echo "</br></br>";
  echo "</br>";
 }# Fecha o While
 ?>
 <input id="btnAlterar" type="button" value="Alterar TAG" onclick="exibir();"/>
 <?php
}
else
{
 if ($encontrou == 0)
 {
  echo "</br></br>";echo "</br>";
  echo "A placa " .$placa ." não foi encontrada no banco de dados do sistema!";
  }
}


?>


<script>

function exibir()
{
  var epc = "<?php print $epc ?>";
  var link_epc = window.document.getElementById('tbEPC');
  link_epc.value = epc;
    location.href=`editar_tag.php?complemento=${criptografia2.value}&check=${criptografia.value}&epc=${tbEPC.value}`;

}

</script>






<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>

<style>


INPUT#btnAlterar {
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
margin-top: -4px !important;
padding-left:70px;
background-size: 100%;
font: normal 12pt times;
}
</style>



</html>