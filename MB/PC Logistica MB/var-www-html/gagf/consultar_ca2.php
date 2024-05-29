<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Consultando a Função do CA</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$ca = $_POST['ca'];

#BUSCA A FUNCAO ASSOCIANDO O CA DO READER A ANTENA LIDA E BUSCA NO BANCO QUAL A FUNCAO CADASTRADA ******************************************
$sql = $dbcon->query("SELECT * FROM lista_readers WHERE ca='$ca'");

if(mysqli_num_rows($sql)>0){
$num = 0;
echo"A função deste CA é : ";
echo"<br/>";
echo"<br/>";
while($dados = $sql->fetch_array()){
$funcao = $dados['funcao'];
echo"> Ant ".$num. " - ".$funcao;
echo"<br/>Leitor de ".$dados['tipo_antena'];
echo"<br/>";echo"<br/>";
echo"**************************************";
echo"<br/>";echo"<br/>";
$num = $num+1;
}


}else{

if($ca==0){
echo "Digite um CA válido!";
}else{
echo "Nao encontrado função relacionada a este CA!";
}
}

?>
<br/>
<br/>
<input type="button" class="BotaoMenu" value="Voltar" onclick="javascript: location.href='consultar_ca1.php';" />
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


</html>