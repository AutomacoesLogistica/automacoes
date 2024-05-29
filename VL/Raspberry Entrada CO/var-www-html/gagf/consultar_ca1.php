<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8"/>
 <title>Consultando CA</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
 </head>
<body>
<h2>Consultando CA ou Função do Reader</h2>
<br/>
<div>
<form method="post" action="consultar_ca2.php">
<fieldset id="formulario" ><legend>Consultando o CA para descobrir a função</legend>
Digite o CA: <input type="Text" name="ca"/>
<input style="margin-left: 10px;" type="submit" class="BotaoMenu" value="Pesquisar Função"/>
</fieldset>
</form> 
</div>

<div>
<form method="post" action="consultar_ca.php">
<br/>
<br/><br/>
<fieldset id="formulario"><legend>Consultando pelo Local para descobrir o CA</legend>
Digite o nome do Local: 
<?php
include_once 'conexao.php';
$id = 'DEFAULT';
$id = 1;

$sql = $dbcon->query("SELECT * FROM lista_funcao_readers");

if(mysqli_num_rows($sql)>0){
?>
<select name="funcao" id="funcao">
<?php
$encontrado = 0;
while($dados = $sql->fetch_array()){
$encontrado = $encontrado +1;
$mensagem = "a";
$ultima_mensagem = "b";
$mensagem = $dados['funcao'];

if($ultima_mensagem != $mensagem ){
#salva a mensagem
$ultima_mensagem = $mensagem;
echo"<option>$ultima_mensagem</option>";

}else{
#Nao salva
$ultima_mensagem = $mensagem;
}

}

}else{
echo "Nao encontrado";
}

?>

</select>
<input style="margin-left: 10px;" type="submit" class="BotaoMenu" value="Pesquisar CA"/>













</fieldset>
<br/>
<br/>
<input class="BotaoMenu" type="button" value="Voltar ao menu" onclick="javascript: location.href='menu.php';" />
</form>
</div>




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

#formulario{
    loat:top;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1205px;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}



</style>







</html>
