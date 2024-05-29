<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Consultando a Função</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<form name="myForm">
<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$funcao = $_POST['funcao'];#isset($_POST['funcao'])?$_POST['funcao']:0;

#BUSCA A FUNCAO ASSOCIANDO O CA DO READER A ANTENA LIDA E BUSCA NO BANCO QUAL A FUNCAO CADASTRADA ******************************************
$sql = $dbcon->query("SELECT * FROM lista_readers WHERE funcao='$funcao'");

if(mysqli_num_rows($sql)>0){

while($dados = $sql->fetch_array()){
$ca = $dados['ca'];
}
echo"O CA deste local é ".$ca;
echo"<br/>";echo"<br/>";
?>
<a href="#" onclick="abreLink();">Verificar Leituras no IoT</a>

<?php

echo"<br/>";echo"<br/>";


}else{

if($funcao==0){
echo "Digite um LOCAL válido!";
}else{
echo "Nao encontrado CA relacionado para este local!";
}
}

?>
<br/>
<br/>
<input type="button" class="BotaoMenu" value="Voltar" onclick="javascript: location.href='consultar_ca1.php';" />
</form>
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
     font-weight: bold
     font-family: verdana;font-size: 9pt;
     color: #FFFFFF;
     background-color: #00008B;
     border-radius: 6px!important;
     border-color: #191970;
     border-style: solid!important;
     cursor: pointer

}

</style>
<script>
function abreLink(){

window.open('https://flpnwc-da335bbb3.dispatcher.us2.hana.ondemand.com/sites/iot4decision#iot4decisionappsreading-Display');
}
</script>
<script>
function copyText(){
    
}
</script>



</html>