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
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`menu_ttp_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.PNG" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>

<!-- AQUI ABAIXO ENTRA OS DADOS DA PAGINA  -->

<?php
include_once 'conexao_display_mb.php';
$msg_sva ="";
$msg_gscs = "";
$info = "";
$foto="0";

$sql = $aux_conexao_display->query("SELECT * FROM rom WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $msg_sva =$dados['msg_sva'];
  $msg_gscs = $dados['msg_gscs'];
  $info = $dados['info'];
  $foto = $dados['foto'];
 }
}   
if($msg_sva == "" && $msg_gscs == "")
{
 $msg_sva = "--";
 $msg_gscs = "--";
}
else
{
 if($msg_sva == "")
 {
  $msg_sva ="--";   
 }   
 if($msg_gscs == "")
 {
  $msg_gscs = "--";   
 }
 if($foto == "")
 {
  $foto = "0";   
 }   
}



$caminho = "./images/rom/foto_";
$complemento = ".png";

?>




<div>
<img  src='<?php print $caminho.$foto.$complemento?>' id="imagem"/>

</div>

<h3 id="lb_info_SVA">SVA: <?php print $msg_sva ?></h3>
<h3 id="lb_info_GSCS">GSCS:  <?php print $msg_gscs ?> </h3>
<h3 id="lb_info"> <?php print $info ?></h3>





<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



<script>
setTimeout("location.reload(true);",1000); // recarrega a pagina em 5 segundos
</script>

</body>

<style>


IMG#imagem{
    margin-left: 0px;
    position: absolute;
    left: 65px;
    top: 60px;
    width: 1380px;
    height: 750px;
    border-radius: 12px!important;
    border-color: black;
    border-style: solid!important;
    cursor: pointer;
}
#lb_info_SVA{
    margin-left: 0px;
    position: absolute;
    left: 90px;
    top: 70px;
}
#lb_info_GSCS{
    margin-left: 0px;
    position: absolute;
    left: 90px;
    top: 105px;
}

#lb_info{
    margin-left: 0px;
    position: absolute;
    left: 90px;
    top: 140px;
    color: white
    
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