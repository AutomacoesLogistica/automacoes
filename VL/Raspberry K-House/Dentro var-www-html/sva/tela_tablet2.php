<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="./video/video-js.css" rel="stylesheet">


<script src="./video/video.js"></script>
</head>
<body>
<img id="logo" src="./images/gerdau.png" />
<img id="atualizacao" src="./images/atualizacao.png" onclick='atualizar();'/>
<label id="lb_atualizacao">17:39:05 - 19/02/2022</label>

<script>
function clicou_foto(link_video)
{
    document.getElementById("cheio_vazio_player1").style.display = "block";   
  //alert('clicou');
  var player = videojs('vcheio_vazio_player1');
 player.src(
 {
   src: link_video,
   type: 'application/x-mpegURL',
 }
);
}

</script>

<?php 

error_reporting(0);

$ip = $_SERVER['REMOTE_ADDR'];

//BUSCO A DATA DE AGORA
date_default_timezone_set('America/Sao_Paulo');
$vdata = date('d/m/Y');
$vhora = date('H:i:s');

$vez = isset($_GET['vez'])?$_GET['vez']:'0';
$vez = intval($vez);
$vez = intval($vez)  + 1;
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  
     
$id_deteccao = '0';
$id = '0';
$encontrado = 0;
include_once 'conexao_sva.php';
$sql = $dbcon->query("SELECT * FROM deteccao_tablet WHERE (data_leitura='$data' AND status='XXX') ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  //Agora calculo se tem menos de 1 minuto esse evento  
  $data_banco = $dados['data_leitura'];
  $hora_banco = $dados['hora_leitura'];

  $url_do_arquivo = $dados['video_placa'];
  $ip = $_SERVER['REMOTE_ADDR'];
  if($ip == "192.168.30.1") // Entrei remoto
  {
   //echo('remoto');
   $url_do_arquivo = str_replace("/gerdau1.","/138.",$url_do_arquivo);
   $url_do_arquivo = str_replace(".svatech.",".0.",$url_do_arquivo);
   $url_do_arquivo = str_replace(".com.",".77.",$url_do_arquivo);
   $url_do_arquivo = str_replace(".br:",".80:",$url_do_arquivo);
   $url_do_arquivo2 = str_replace("/gerdau1.","/138.",$url_do_arquivo2);
   $url_do_arquivo2 = str_replace(".svatech.",".0.",$url_do_arquivo2);
   $url_do_arquivo2 = str_replace(".com.",".77.",$url_do_arquivo2);
   $url_do_arquivo2 = str_replace(".br:",".80:",$url_do_arquivo2);
  }
  else
  {
   // estou internamente
   $url_do_arquivo = str_replace("@gerdau1.","@192.",$url_do_arquivo);
   $url_do_arquivo = str_replace(".svatech.",".168.",$url_do_arquivo);
   $url_do_arquivo = str_replace(".com.",".30.",$url_do_arquivo);
   $url_do_arquivo = str_replace(".br:",".79:",$url_do_arquivo);
   $url_do_arquivo = str_replace(":3499",":8554",$url_do_arquivo);
  }

  $url_video = $url_do_arquivo;
  //Inverte o padrao da hora para efetuar o calculo
  $mensagem = explode('/',$data_banco);
  $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
  $horario_banco = $mensagem . ' ' . $hora_banco; 
   
  //Agora calculo a diferença
  $data_inicio = new DateTime($data_agora);
  $data_fim = new DateTime($hora_banco);
       
  // Resgata diferença entre as datas
  $dateInterval = $data_inicio->diff($data_fim);
  $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
  //echo $mensagem;
           
  $mensagem1 = explode(' ',$mensagem);
  $vmensagem1 = explode('/',$mensagem1[0]);
  $dia = $vmensagem1[0];
  $mes = $vmensagem1[1];
  $ano = $vmensagem1[2];
  $mensagem = explode(':',$mensagem1[1]);
  $hora = $mensagem[0];
  $minuto = $mensagem[1];
  $segundo = $mensagem[2];
  //echo('Diferenca é : '. $hora . ':' . $minuto . ':'. $segundo);
  if($dia==0 && $mes==0 && $ano==0)
  {
   // echo'</BR';
   // echo'OK1';
   if(intval($minuto)<20000)
   {
   // echo'</BR';
   // echo'OK2';
    $id_deteccao = $dados['id_deteccao'];
    $id = $dados['id'];
    $foto = $dados['imagem']; 
   } // Fecha if(intval($minuto)<2)
  } // Fecha if($dia>0 || $mes>0 || $ano>0)
 } // Fecha while
}//Fecha if
//$id = 0;

if($id != '0')
{
 //Atualiza que o tablet puxou na tela o evento
 include_once 'conexao_sva.php';
 //$sql = $dbcon->query("UPDATE deteccao_tablet SET status = 'tratando' WHERE id='$id'");
 include_once 'conexao_sva.php';
 $sql = $dbcon->query("UPDATE atua_rele SET detectado='SIM',data_leitura='$vdata',hora_leitura='$vhora' WHERE id='1'");  //Para ascender o rele em campo
 
 
 
 ?>
 <div id='foto_cheio_vazio'>
 <audio id='myAudio' name='myAudio' src='./audios/beep.mp3' controls autoplay hidden='hidden'></audio>
 <h3 id="lb_atencao">ATENÇÃO! </h3>
  <img id='foto_cheio_vazio' src="data:image/jpeg;base64,<?php print $foto ?>" onclick='clicou_foto("<?php echo $url_do_arquivo ?>")'       />
  <img id='btnplay' src="./images/btnplay.png" onclick='clicou_foto("<?php echo $url_do_arquivo ?>")'       />
  <label id='lb_pergunta' name='lb_pergunta'>O evento foi detectado corretamente?</label>
<label id='lb_sim' name='lb_sim' onclick='clicou_sim();'>SIM</label>
<label id='lb_nao' name='lb_nao' onclick='clicou_nao();'>NAO</label>

<div id='cheio_vazio_player1'> 
 <video id='vcheio_vazio_player1'  class="video-js vjs-default-skin"  data-setup='{"fluid": true}' controls autoplay>
 <source type="application/x-mpegURL" src="<?php print $url_do_arquivo ?>">
 </video>
 <label id='lb_x' name='lb_x' onclick='clicou_x();'>X</label> 

</div>
 <script>
 document.getElementById("cheio_vazio_player1").style.display = "none";  
 //clicou_foto('<?php echo $url_do_arquivo ?>');
 //var player = videojs('vcheio_vazio_player1');
 //player.play();
 </script>
 

<?php
}
else
{
 //Não existem mais eventos
 ?>
 
 <label id="descarga_nova">Aguardando nova detecção!</label>
 


<?php
}
//echo $id_deteccao;


?>





</div>




<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<script>

var link_horario = window.document.getElementById('lb_atualizacao');
//alert(link_horario.innerHTML);
link_horario.innerHTML = '<?php print $vdata ?>'+ " - " + '<?php print $vhora ?>';



function clicou_x()
{
    document.getElementById("cheio_vazio_player1").style.display = "none";     
}

function atualizar()
{
    location.href=`tela_tablet.php`;
}
</script>

<script>
function clicou_sim()
{
 var id_deteccao = '<?php print $id_deteccao ?>'; 
  // alert('clicou em sim!');
    $.ajax({
           url: 'salvar_tablet.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': id_deteccao,'resposta': 'sim'},
           success: function(resultado){
           
            if(resultado == 'ok')
            {
             location.href=`tela_tablet.php`;
            }
            else
            {
              alert('Tente novamente, occoreu algum erro ao salvar!');  
            }
           }
        });

}
</script>

<script>
function clicou_nao()
{
 //alert('clicou em nao!'); 
 var id_deteccao = '<?php print $id_deteccao ?>';
 $.ajax({
           url: 'salvar_tablet.php',
           type: 'GET',
           dataType: 'json',
           data: {'id': id_deteccao,'resposta': 'nao'},
           success: function(resultado){
            if(resultado == 'ok')
            {
             location.href=`tela_tablet.php`;
            }
            else
            {
              alert('Tente novamente, occoreu algum erro ao salvar!');  
            }
           }
        });
}

</script>

<script>
var id = '<?php print $id ?>';

if(id==0)
{
 <?php
 
 if(intval($vez)>2)
 {
    include_once 'conexao_sva.php';
    $sql = $dbcon->query("UPDATE atua_rele SET detectado='NAO',data_leitura='$vdata',hora_leitura='$vhora' WHERE id='1'");  
    ?>
    console.log('zerou')
    <?php 
}
 
 ?>
 var link_vez = '<?php print $vez ?>';

 /*
 if(link_vez == 3)
 {
    window.setTimeout( "location.href=`tela_tablet.php?vez=0`",5000);   
 }
 else
 {
    window.setTimeout( "location.href=`tela_tablet.php?vez=${link_vez}`",3000);   
 }
 
*/
}




</script>
</body>
<style>

IMG#atualizacao{
    margin-left: 0px;
    position: absolute;
    left: 53%;
    top: 8.5%;
    width: 50px;
    height: 50px;
    cursor: pointer;

}
LABEL#lb_atualizacao{
    position: absolute;
    left: 61%;
    top: 10%;
    font-style: italic;
	font-weight: bold;
	font-size: 30px;
	font-family: arial, sans-serif;


}


IMG#logo{
    margin-left: 0px;
    position: absolute;
    left: 10%;
    top: 6%;
    width: 20%;
    height: 10%;
    cursor: pointer;

}

DIV#cheio_vazio_player1{
    margin-left: 0px;
    position: absolute;
    left: -4%;
    top: -4%;
    width:110%;
    height:80%;

}

LABEL#descarga_nova{
    margin-left: 0%;
    position: absolute;
    text-align:center;
    font: bold 70pt verdana;
    color: #DC143C;
    left: 6.5%;
    top: 25%;
    padding: 20px;
    padding-top: 5%;
    width:80%;
    height:45%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 12px #DC143C solid!important;
}


DIV#foto_cheio_vazio{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 22%;
    padding-top: 15px;
    width:  850px;
    height: 320px;
    background-color: rgb(255,255,250);
    margin-bottom: 10px;
    border-radius: 10px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
    border: 6px rgb(20,20,20) solid!important;
}
IMG#foto_cheio_vazio{
    margin-left: 0px;
    position: absolute;
    left: 3.5%;
    top: 12%;
    padding: 0px;
    width:  35%;
    height: 72%;
    border-radius: 10px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
    border: 2px rgb(10,10,10) solid!important;
    
}
IMG#btnplay{
    margin-left: 0px;
    position: absolute;
    left: 6%;
    top: 78%;
    padding: 0px;
    width:  50px;
    height: 50px;
    
}
#lb_atencao{
    margin-left: 0px;
    position: absolute;
    left: 55%;
    top: 9%;
    font: bold 30pt verdana;
    color: #00008B;
}
#lb_pergunta{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 38%;
    font: bold 20pt verdana;
    color: rgba(0,0,0,0.7);
}



#lb_sim{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 56%;
    width: 25%;
    height: 12%;
    border-radius: 6px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
    font: bold 26pt verdana;
    color: rgba(0,0,0,0.7);
    padding-top: 1%;
    padding-bottom: 1%;
    text-align: center;
    background-color: green;
}
#lb_sim:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
#lb_sim:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

#lb_nao{
    margin-left: 0px;
    position: absolute;
    left: 70%;
    top: 56%;
    width: 25%;
    height: 12%;
    border-radius: 6px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
    font: bold 26pt verdana;
    color: rgba(0,0,0,0.7);
    padding-top: 1%;
    padding-bottom: 1%;
    text-align: center;
    background-color: red;
}
#lb_nao:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
#lb_nao:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}





#lb_x{
    margin-left: 0px;
    position: absolute;
    left: 96.3%;
    top: 0%;
    width: 3%;
    height: 4%;
    border-radius: 1px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
    font: bold 12pt verdana;
    color: #ffffff;
    padding-top: 0.5%;
    padding-bottom: 1.6%;
    text-align: center;
    background-color: rgba(250,20,0,0.7);
}
#lb_x:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
#lb_x:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 30%;
    top: 88%;
    font: bold 18pt verdana;
    color: rgba(0,0,0,0.7);
}

body{
width: 98%;
height: 90%;
margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 180%;

}

</style>
</html>