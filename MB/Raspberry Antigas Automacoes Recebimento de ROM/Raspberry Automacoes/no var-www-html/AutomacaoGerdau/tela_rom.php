<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`menu_ttp_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.png" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>

<!-- AQUI ABAIXO ENTRA OS DADOS DA PAGINA  -->
<?php
$limite = 0;
$dentro = 0;
$placa = '--';
$sigla = '--';

include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM acessos WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $limite = $dados['limite'];
 $dentro = $dados['dentro'];

}
mysqli_close();




include_once 'conexao2.php';
$msg_sva ="";
$msg_gscs = "";
$info = "";
$foto="0";
$cor_semaforo_entrada = '';
$url_foto_semaforo_entrada = '';
$sql = $dbcon->query("SELECT * FROM rom WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $msg_sva =$dados['msg_sva'];
 $msg_gscs = $dados['msg_gscs'];
 $info = $dados['info'];
 $foto = $dados['foto'];
 $cor_semaforo_entrada = $dados['semaforo_entrada'];
 $placa = $dados['placa'];
 $sigla = $dados['sigla'];

}   

if($cor_semaforo_entrada == 'verde')
{
 $url_foto_semaforo_entrada = './images/sem_verde.png';
}
else if($cor_semaforo_entrada == 'vermelho')
{
 $url_foto_semaforo_entrada = './images/sem_vermelho.png';
}
else
{
 //Erro   
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
$complemento = ".webp";

?>




<div>
<img  src='<?php print $caminho.$foto.$complemento?>' id="imagem"/>

</div>

<img  src='<?php print $url_foto_semaforo_entrada?>' id="semaforo_entrada"/>

<h3 id="lb_info_SVA">SVA: <?php print $msg_sva ?></h3>
<h3 id="lb_info_GSCS">GSCS:  <?php print $msg_gscs ?> </h3>
<h3 id="lb_info"> <?php print $info ?></h3>


<?php
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = date('d/m/Y');
$hora_agora = date('H:i:s');
if($foto==1)
{
 sleep(2);   
 ?>
<script>
//Passa para verificar se pode atualizar a tela para RLR
  $.ajax({
           url: './validacao_match_rlr.php',
           type: 'GET',
           dataType: 'html',
           data: {'msg': '1'},
           success: function(resultado)
           {
             // alert( 'Removidos' + resultado);
           }
        });
</script>
 <?php
}

?>

<h3 id="lb_limite">Limite: <?php print $limite ?> </h3>
<h3 id="lb_dentro"> / &nbsp&nbspNo Pátio: <?php print $dentro ?> </h3>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<h3 id="lb_atualizacao"><?php print $data_hoje .' '. $hora_agora ?></h3>

<h3 id="Placa">Placa: <?php print $placa ?> </h3>
<h3 id="Transportadora">Transp.: <?php print $sigla ?> </h3>

<script>
setTimeout("location.reload(true);",1000); // recarrega a pagina em 5 segundos
</script>

</body>

<style>
IMG#semaforo_entrada{
    margin-left: 0px;
    position: absolute;
    left: 84%;
    top: 8%;
    width: 43px;
    height: 113px;
  
}


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




#Placa{
    margin-left: 0px;
    position: absolute;
    left: 38%;
    top: 70%;
    font: normal 24pt verdana;
    color:#ffffff;
}
#Transportadora{
    margin-left: 0px;
    position: absolute;
    left: 38%;
    top: 76%;
    font: normal 24pt verdana;
    color:#ffffff;
}





#lb_limite{
    margin-left: 0px;
    position: absolute;
    left: 8%;
    top: 90%;
    font: normal 22pt verdana;
    color:#ffffff;
    
}
#lb_dentro{
    margin-left: 0px;
    position: absolute;
    left: 17%;
    top: 90%;
    font: normal 22pt verdana;
    color:#ffffff;
    
}






#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 91%;
    font: normal 18pt verdana;
    color:#ffffff;
    
}
#lb_atualizacao{
    margin-left: 0px;
    position: absolute;
    left: 80%;
    top: 80%;
    font: normal 28pt verdana;
    color:#ffffff;
    
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