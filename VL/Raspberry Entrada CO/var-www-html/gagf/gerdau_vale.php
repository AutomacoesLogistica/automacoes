<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerdau :: GAGF - Bruno Gonçalves</title>
    <link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">

</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`menu_gestao_gagf.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<img id="home" src="./images/btn_home.PNG" onclick="javascript: location.href=`menu_aux.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
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
//window.location="login.php";
</script>
<?php
}
?>
<center>

<?php
$semaforo_vale = '';
$semaforo_gerdau = '';
$entrando = '';
$foto_patrag = '';
$hidden = '';

include_once 'conexao_vale_gerdau.php'; // Faz a conexao no banco

$sql = $dbcon->query("SELECT * FROM controle WHERE id=1");
if(mysqli_num_rows($sql)>0)
{
    while($dados = $sql->fetch_array())
    {
        $semaforo_vale = $dados['entrada_vale'];
        $semaforo_gerdau = $dados['entrada_gerdau'];
        $entrando = $dados['entrando'];
        $foto_patrag = $dados['foto_patrag'];
        $caminhao_vale = $dados['foto_vale'];
        $caminhao_gerdau = $dados['foto_gerdau'];
    }// Fecha o while 
} // Fecha o if mysqli_num_rows($sql)>0
?>
<div id='entrada'>
<img id='foto_rua' src="./images/rua3.png" alt=""/>
<img id='trilho' src="./images/trilho.png" alt=""/>
<img id='trilho2' src="./images/trilho.png" alt=""/>
 <?php
 if($semaforo_vale == 1)
 {
    $semaforo_vale = './images/ok.png';
 }
 else
 {
    $semaforo_vale = './images/pare.png';
 }

 if($semaforo_gerdau == 1)
 {
    $semaforo_gerdau = './images/ok.png';
 }
 else
 {
    $semaforo_gerdau = './images/pare.png';
 }

 if($foto_patrag == 1)
 {
    $foto_patrag = './images/patrag_ocupado.png';
 }
 else
 {
    $foto_patrag = './images/patrag_livre.png';
 }

 if($caminhao_vale == 1)
 {
    $caminhao_vale = './images/caminhao_2.png';
 }
 else
 {
    $caminhao_vale = './images/caminhao_0.png';
 }


 if($caminhao_gerdau == 1)
 {
    $caminhao_gerdau = './images/caminhao_1.png';
 }
 else
 {
    $caminhao_gerdau = './images/caminhao_0.png';
 }


 if($entrando == 0)
 {
    ?>
    <label id='numero' visibility='hidden' ><?php echo $entrando ?></label>
    <img id='trajeto' src="./images/ntrajeto.png" alt=""/>
    <script>
       document.getElementById('numero').style.visibility = "hidden";
       document.getElementById('trajeto').style.visibility = "hidden";
    </script>
    <?php
 }
 else
 {
    ?>
    <label id='numero' visibility='hidden' ><?php echo $entrando ?></label>
    <img id='trajeto' src="./images/ntrajeto.png" alt=""/>
    <script>
       document.getElementById('numero').style.visibility = "visible";
       document.getElementById('trajeto').style.visibility = "visible";
    </script>
    <?php
 }


 ?>




<img id='caminhao_vale' src='<?php echo $caminhao_vale ?>' alt=""/>
<img id='caminhao_gerdau' src='<?php echo $caminhao_gerdau ?>' alt=""/>
<img id='foto_patrag' src='<?php echo $foto_patrag ?>' alt=""/>
<img id='semaforo_vale' src='<?php echo $semaforo_vale ?>' alt=""/>
<img id='semaforo_gerdau' src='<?php echo $semaforo_gerdau ?>' alt=""/>
<label id='tempo_vale'>00:00:00</label>
<label id='tempo_gerdau'>00:00:00</label>
<img id='logo_vale' src="./images/vale.png" alt=""/>
<img id='logo_vale2' src="./images/vale.png" alt=""/>
<img id='logo_gerdau' src="./images/gerdau.png" alt=""/>
<img id='logo_gerdau2' src="./images/gerdau.png" alt=""/>
<img id='mastro_vale' src="./images/mastro.png" alt=""/>
<img id='mastro_gerdau' src="./images/mastro.png" alt=""/>




</div>


<script>
setTimeout("location.reload(false);",500); // recarrega a pagina em 5 segundos
</script>

    
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



</body>

<script>

</script>

<style>



DIV#entrada{
    width: 450px;
    height: 280px;
    background-color: white;
    position: absolute;
    top: 523px;
    left: 55px;
}

IMG#foto_rua{
    margin-left: 0px;
    position: absolute;
    left: 335px;
    top: -197%;
    width: 700px;
    height: 833px;
    transform: rotate(0deg);
    
}
IMG#foto_patrag{
    margin-left: 0px;
    position: absolute;
    left: 900px;
    top: -229%;
    width: 500px;
    height: 720px;
    transform: rotate(-1deg);
    
}
IMG#trilho{
    margin-left: 0px;
    position: absolute;
    left: 103px;
    top: -390px;
    width: 400px;
    height: 328px;
    transform: rotate(-3deg);
    
}
IMG#trilho2{
    margin-left: 0px;
    position: absolute;
    left: 462px;
    top: -140px;
    width: 400px;
    height: 328px;
    transform: rotate(-3deg);
    
}
IMG#trajeto{
    margin-left: 0px;
    position: absolute;
    left: 405px;
    top: -320px;
    width: 100px;
    height: 108px;
    
    
}
LABEL#numero{
    color: white;
    font: bold 30pt arial;
    position: absolute;
    top: -320px;
    left: 350px;
    text-align: center;
    width: 60px;
    height: 40px;
    padding-bottom: 8px;
    background-color: black;
    border-radius: 16px!important;
    border: 4px red solid!important;
}
IMG#caminhao_vale{
    margin-left: 0px;
    position: absolute;
    left: 70px;
    top: 75px;
    width: 130px;
    height: 160px;
    
    
}
IMG#logo_vale{
    margin-left: 0px;
    position: absolute;
    left: 105px;
    top: 2px;
    width: 60px;
    height: 60px;
    
    
}
IMG#logo_vale2{
    margin-left: 0px;
    position: absolute;
    left: 700px;
    top: -390px;
    width: 60px;
    height: 60px;
    
    
}
LABEL#tempo_vale{
    font: normal 18pt Times;
    position: absolute;
    top: 238px;
    left: 85px;
    color: black;
    font: bold 20pt Times;
}
IMG#semaforo_vale{
    margin-left: 0px;
    position: absolute;
    left: 1px;
    top: 64px;
    width: 50px;
    height: 90px;
    
    
}

IMG#mastro_vale{
    margin-left: 0px;
    position: absolute;
    left: 15px;
    top: 147px;
    width: 15px;
    height: 135px;
    
    
}







IMG#caminhao_gerdau{
    margin-left: 0px;
    position: absolute;
    left: 315px;
    top: 75px;
    width: 130px;
    height: 160px;
    
    
}

IMG#logo_gerdau{
    margin-left: 0px;
    position: absolute;
    left: 355px;
    top: 10px;
    width: 50px;
    height: 50px;
    
    
}
IMG#logo_gerdau2{
    margin-left: 0px;
    position: absolute;
    left: 800px;
    top: -180px;
    width: 50px;
    height: 50px;
    
    
}
LABEL#tempo_gerdau{
    font: normal 18pt Times;
    position: absolute;
    top: 238px;
    left:330px;
    color: black;
    font: bold 20pt Times;
}
IMG#semaforo_gerdau{
    margin-left: 0px;
    position: absolute;
    left: 250px;
    top: 64px;
    width: 50px;
    height: 90px;
    
    
}

IMG#mastro_gerdau{
    margin-left: 0px;
    position: absolute;
    left: 265px;
    top: 147px;
    width: 15px;
    height: 135px;
    
    
}





DIV#relogio{
    width: 100px;
    height: 30px;
    background-color: transparent;
    position: absolute;
    top: 7%;
    left: 89.2%
}

LABEL#v_hora{
    font: normal 18pt Times;
    position: relative;
    top: 2%;
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
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3%;
    top: 0%;
    width:92.9%;
    height:3%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 5%;
    top: -10%;
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
    top: 5%;
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

}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>
</html>