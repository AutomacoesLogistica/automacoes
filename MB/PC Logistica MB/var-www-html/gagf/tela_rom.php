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


var tempo = 1000;

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
?>
<!-- AQUI ABAIXO ENTRA OS DADOS DA PAGINA  -->
<?php
$limite = 0;
$dentro = 0;
$placa = '--';
$sigla = '--';
$condicao2 = "--";

include_once 'conexao_rom.php';
$sql = $dbcon->query("SELECT * FROM acessos WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $limite = $dados['limite'];
 $dentro = $dados['dentro'];
}
mysqli_close();

if($condicao2 == "vazio")
{
 $condicao2 = "vazio"; // por segurança  
}
else if($condicao2 == 'cheio')
{
 $condicao2 = "cheio"; //por segurança
}
else
{
 $condicao2 = "--";
}


include_once 'conexao_rom.php';
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
 $condicao2 = $dados['condicao2'];

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

<img id="mais_limite" src="./images/mais.png" onclick="clicou_mais_limite()"/>
<img id="menos_limite" src="./images/menos.png" onclick="clicou_menos_limite()"/>
<img id="mais_dentro" src="./images/mais.png" onclick="clicou_mais_dentro()"/>
<img id="menos_dentro" src="./images/menos.png" onclick="clicou_menos_dentro()"/>


<h3 id="lb_limite">Limite: <?php print $limite ?> </h3>
<h3 id="lb_dentro"> / &nbsp&nbspNo Pátio: <?php print $dentro ?> </h3>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<h3 id="lb_atualizacao"><?php print $data_hoje .' '. $hora_agora ?></h3>

<h3 id="Placa">Placa: <?php print $placa ?> </h3>
<h3 id="Transportadora">Transp.: <?php print $sigla ?> </h3>

<input type="button" id="normalizar" name="normalizar" value="Normalizar Semáforos" onclick="clicou_normalizar();">
<input type="button" id="cancelas" name="cancelas" value="Acionar Cancelas" onclick="clicou_cancelas();">
<input type="button" id="rom" name="rom" value="Ajustar Dados ROM" onclick="clicou_rom();">
<div id='saindo_cheio'>
<img id="alerta" src="./images/alerta.png"/>
<label id="lb_info1">--</label>
</div>


<script>
var link_condicao2 = '<?php print $condicao2 ?>';
//console.log(link_condicao2); 
if(link_condicao2 == 'vazio')
{
 document.getElementById('lb_info1').innerHTML = 'Veículo Saindo Vazio!';
 document.getElementById('saindo_cheio').style.display='block';
 
 //agora devo limpar no banco para que na proxima a notificacao suma!
 <?php
  include_once 'conexao_rom.php';
  $sql = $dbcon->query("UPDATE rom SET condicao2='--' WHERE id='1'");
 ?>
}
else if (link_condicao2 == 'cheio')
{
 //Deixa fixo ate abrir a cancela e limpar por la!
 
 document.getElementById('lb_info1').innerHTML = 'Veículo Saindo CHEIO!';
 document.getElementById('saindo_cheio').style.display='block';
}
else
{
 //Deixa apagado!
 document.getElementById('lb_info1').innerHTML = "--";
 document.getElementById('saindo_cheio').style.display='none';
}






function clicou_mais_limite()
{
 var limite = document.getElementById('lb_limite').innerHTML;
 limite = limite.split(":");
 limite = parseInt(limite[1])+1;
 //Passa para verificar se pode atualizar a tela para RLR
 $.ajax({
           url: './salva_dados_rom_limite.php',
           type: 'POST',
           dataType: 'html',
           data: {'limite': limite},
           success: function(resultado)
           {
             // alert( 'Removidos' + resultado);
           }
        });
 //alert(limite);   
}
function clicou_menos_limite()
{
 var limite = document.getElementById('lb_limite').innerHTML;
 limite = limite.split(":");
 limite = parseInt(limite[1])-1;
 if(limite < 0)
 {
  limite = 0;  
 }
 //Passa para verificar se pode atualizar a tela para RLR
 $.ajax({
           url: './salva_dados_rom_limite.php',
           type: 'POST',
           dataType: 'html',
           data: {'limite': limite},
           success: function(resultado)
           {
             // alert( 'Removidos' + resultado);
           }
        });
 //alert(limite);   
}





function clicou_mais_dentro()
{
 var dentro = document.getElementById('lb_dentro').innerHTML;
 dentro = dentro.split(":");
 dentro = parseInt(dentro[1])+1;
 //Passa para verificar se pode atualizar a tela para RLR
 $.ajax({
           url: './salva_dados_rom_dentro.php',
           type: 'POST',
           dataType: 'html',
           data: {'dentro': dentro},
           success: function(resultado)
           {
             // alert( 'Removidos' + resultado);
           }
        });
 //alert(limite);   
}
function clicou_menos_dentro()
{
 var dentro = document.getElementById('lb_dentro').innerHTML;
 dentro = dentro.split(":");
 dentro = parseInt(dentro[1])-1;
 if(dentro < 0)
 {
  dentro = 0;  
 }
 //Passa para verificar se pode atualizar a tela para RLR
 $.ajax({
           url: './salva_dados_rom_dentro.php',
           type: 'POST',
           dataType: 'html',
           data: {'dentro': dentro},
           success: function(resultado)
           {
             // alert( 'Removidos' + resultado);
           }
        });
 //alert(limite);   
}








function clicou_cancelas()
{
    location.href=`consultar_cancelas_utmii.php?complemento=${criptografia2.value}&check=${criptografia.value}`;  
}
function clicou_rom()
{
    location.href=`patio_rom.php?complemento=${criptografia2.value}&check=${criptografia.value}`;  
}


function clicou_normalizar()
{
 <?php 
 $ip = $_SERVER['REMOTE_ADDR']; 
 if($ip == "192.168.20.1")
 {
 ?>
  //Faz o get para normalizar!
 const url = "http://138.0.77.80:5050/AutomacaoGerdau/monitor_rom.php?id=04&mensagem=normalizado2";//Sua URL
  fetch(url);
  <?php
 } // Fecha if para ip externo
 else
 {
 ?>
 //Faz o get para normalizar!
 const url = "http://192.168.20.66/AutomacaoGerdau/monitor_rom.php?id=04&mensagem=normalizado2";//Sua URL
 fetch(url);
 <?php
 } // Fecha else
 ?>
 
    //alert('Em desenvolvimento!'); 
 
}



setTimeout("location.reload(true);",tempo); // recarrega a pagina
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


INPUT#normalizar
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:78%;
    top: 55%;
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

INPUT#cancelas
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:78%;
    top: 61%;
    width:200px;
    height:45px;
    padding-left: 5px;
    background-color: #29A1AB;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#cancelas:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#cancelas:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#rom
{
    width: 190px;
    height: 30px;
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 10pt verdana;
    left:78%;
    top: 67%;
    width:200px;
    height:45px;
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



IMG#mais_limite{
    margin-left: 0px;
    position: absolute;
    left: 9%;
    top: 81%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#menos_limite{
    margin-left: 0px;
    position: absolute;
    left: 9%;
    top: 90%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}



IMG#mais_dentro{
    margin-left: 0px;
    position: absolute;
    left: 20%;
    top: 80.5%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#menos_dentro{
    margin-left: 0px;
    position: absolute;
    left: 20%;
    top: 90%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}







IMG#alerta{
    margin-left: 0px;
    position: absolute;
    left: 7%;
    top: 13%;
    width: 50px;
    height: 50px;
    cursor: pointer;

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
    left: 35%;
    top: 66%;
    font: normal 24pt verdana;
    color:#ffffff;
}
#Transportadora{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 72%;
    font: normal 24pt verdana;
    color:#ffffff;
}





#lb_limite{
    margin-left: 0px;
    position: absolute;
    left: 7%;
    top: 82%;
    font: normal 18pt verdana;
    color:#ffffff;
    
}
#lb_dentro{
    margin-left: 0px;
    position: absolute;
    left: 15%;
    top: 82%;
    font: normal 18pt verdana;
    color:#ffffff;
    
}






#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 35%;
    top: 83%;
    font: normal 18pt verdana;
    color:#ffffff;
    
}
#lb_atualizacao{
    margin-left: 0px;
    position: absolute;
    left: 77%;
    top: 74%;
    font: normal 28pt verdana;
    color:#ffffff;
    
}

DIV#saindo_cheio{
    position: absolute;
    left: 36%;
    top: 8%;
    width:30%;
    height:10%;
    background-color:#29A1AB;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}


#lb_info1{
    margin-left: 0px;
    position: absolute;
    left: 23%;
    top: 10%;
    font: normal 18pt verdana;
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