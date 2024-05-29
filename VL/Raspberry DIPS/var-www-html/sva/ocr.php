<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
  
<img id="voltar" src="./images/btn_voltar.png" onclick="javascript: location.href=`http://192.168.20.21/gagf/login.php`;"/>
<input type="text" id="data2" value="vazio" hidden="hidden"/>
<?php
error_reporting(0);
date_default_timezone_set('America/Sao_Paulo');
$valor_dia = date('d/m/Y');
?>

<script>
var valor_dia = '<?php print $valor_dia ?>';
document.getElementById('data2').value = valor_dia;



</script>
<div id="login">
<div id='borda'></div>
<img id="logo2" src="./images/logo2.png"/>
<img id="carregando" src="./images/carregando.gif"/>
<script>
document.getElementById('carregando').style.display = 'none';
</script>

<input type="text" name="registro"  id="registro" a rel="ajuda" placeholder ="Digite seu registro" required autofocus autocomplete="off"onmouseover="showMessage2()" onmouseout="hideMessage2()"/>
<br/><br/>
<input type="password" name="senha" id="senha" a rel="ajuda" placeholder="Digite sua senha de acesso" autocomplete="off"  onmouseover="showMessage()" onmouseout="hideMessage()"/>
<br/><br/>
<input id='acessar' type="button" value="Acessar" onclick="verificar_senha()"/>



<label id="titulo">Video Analítico</label>
<label id="titulo2">Miguel Burnier - OCR + Cheio/Vazio</label>
</div>




<div id="alterar_senha">
<div id='borda'></div>
<img id="logo2" src="./images/logo2.png"/>

<input type="password" name="senha1"  id="senha1" a rel="ajuda" placeholder ="Digite sua senha" required autofocus autocomplete="off"onmouseover="showMessage3()" onmouseout="hideMessage3()"/>
<br/><br/>
<input type="password" name="senha2" id="senha2" a rel="ajuda" placeholder="Confirme sua senha" autocomplete="off"  onmouseover="showMessage4()" onmouseout="hideMessage4()"/>
<br/><br/>
<input id='salvar_acessar' type="button" value="Salvar/Acessar" onclick="validar_senha()"/>

<label id="titulo">Video Analítico</label>
<label id="titulo2">Miguel Burnier - OCR + Cheio/Vazio</label>
<label id="titulo3">Validando o cadastro</label>
</div>











<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<div class="mensagem" >Para primeiro acesso usar o registro como sua senha!</BR></BR>Caso já tenha definido, insira sua senha atual!</div>
<div class="mensagem2" >Insira seu registro!</div>

<!--Para salvar a senha-->
<div class="mensagem3" >Insira um valor para senha diferente de seu registro!</div>
<div class="mensagem4" >Confirme a senha digitada anteriormente!</div>

<script>
  document.getElementById('alterar_senha').style.visibility='hidden'; // inicia ocultando div alterar_senha
    
// Utilizando JQuery
jQuery('senha').attr('autocomplete','off');
// Ou Javascript padrão
senha.setAttribute('autocomplete','off');
</script>

<script>

let mensagem = document.querySelector(".mensagem") ;
let mensagem2 = document.querySelector(".mensagem2") ;
let mensagem3 = document.querySelector(".mensagem3") ;
let mensagem4 = document.querySelector(".mensagem4") ;

// mostra a mensagem
function showMessage(){ 
    mensagem.style.display = "block";   
 }
// esconde a mensagem
function hideMessage(){
  mensagem.style.display = "none"; 
  
}

// mostra a mensagem
function showMessage2(){ 
    mensagem2.style.display = "block";   
 }
// esconde a mensagem
function hideMessage2(){
  mensagem2.style.display = "none"; 
  
}

// mostra a mensagem
function showMessage3(){ 
    mensagem3.style.display = "block";   
 }
// esconde a mensagem
function hideMessage3(){
  mensagem3.style.display = "none"; 
  
}

// mostra a mensagem
function showMessage4(){ 
    mensagem4.style.display = "block";   
 }
// esconde a mensagem
function hideMessage4(){
  mensagem4.style.display = "none"; 
  
}



function verificar_senha()
{
 //alert('entrou');
 var registro = document.getElementById('registro').value;
 var senha = document.getElementById('senha').value;
//alert(senha);
 $.ajax({
    url: 'valida_acesso_ocr.php',
    type: 'GET',
    dataType: 'json',
    data: {'registro': registro,'senha': senha},
    success: function(resultado)
    {
     //alert(resultado);
     if(resultado == 'nao_cadastrado,nao_cadastrado,nao_cadastrado,nao_cadastrado')
     {
      alert('Atenção!</BR>Usuario ainda não cadastrado no sistema!');   
     }
     else if (resultado == 'igual,igual,igual,igual')
     {
      alert("<b>Atenção!</b></BR>O valor inserido para usuário e senha estão iguais e já foi alterado a senha para este usuário, favo acessar o sistema com a senha definida!");   
     }
     else if (resultado == 'negado,negado,negado,negado')
     {
      alert("<b>Atenção!</b></BR>Acesso negado, o valor inserido de usuário ou senha estão incorretos, favor verificar!");   
     }
     
     else
     {
      //Trata se é primeiro acesso   
      const myArr = resultado.split(",");
      var mensagem = myArr[0];
      var nome = myArr[1];
      var registro = myArr[2];
      var criptografia = myArr[3];
      
      if(mensagem == "primeiro_acesso")
      {
        // Primeiro acesso do usuario
        // Agora deve alterar a senha
        //alert("primeiro acesso!");
        document.getElementById('login').style.visibility='hidden'; // inicia ocultando div alterar_senha
        document.getElementById('alterar_senha').style.visibility='visible'; // inicia ocultando div alterar_senha
      }
      else
      {
       //Pode acessar o programa
       document.getElementById('carregando').style.display = 'block';
       //alert('Usuario:' + nome + ' Registro: ' + registro + ' Criptografia: '+ criptografia);
       complemento = String(((parseFloat(criptografia))+2021)*1.5);
       complemento2 = String((parseInt(registro)+22.5)*0.5);
       location.href=`tela_va_ocr_cheio_vazio.php?complemento=`+complemento+`&check=`+ complemento2+ `&data=${data2.value}`+`&cameras=todas`+`&status=todos`+`&parecer=todos`;
       
      }
      
      
     }

    }
 });

}

function validar_senha()
{
 var registro1 = document.getElementById('registro');
 registro1 = registro1.value; 
 var senha1 = document.getElementById('senha1');
 var senha2 = document.getElementById('senha2');
 
 senha1 = senha1.value;
 senha2 = senha2.value;

if(senha1 == senha2)
{
 if(senha1 && senha2 != registro1)
 {
  //alert('OK');
  $.ajax({
    url: 'validar_cadastro_ocr_cheio_vazio_mb.php',
    type: 'GET',
    dataType: 'json',
    data: {'registro': registro1,'senha': senha1},
    success: function(resultado)
    {
      alert(resultado);
      const myArr = resultado.split(",");
      var mensagem = myArr[0];
      var nome = myArr[1];
      var registro = myArr[2];
      var criptografia = myArr[3];

     if(mensagem == "ok")
     {
      //Ja realizou o cadastro e pode alterar para a pagina do software 
      complemento = String((parseInt(criptografia)+2021)*1.5);
      complemento2 = String((parseInt(registro)+22.5)*0.5);
      alert(complemento);
      location.href=`tela_va_ocr_cheio_vazio.php?complemento=`+complemento+`&check=`+ complemento2+ `&data=${data2.value}`+`&cameras=todas`+`&status=todos`;
       
     }
     else
     {
       //Ocorreu algum erro ao validar o cadastro
       alert('Atenção! Ocorreu algum erro ao validar o cadastro, tente novamente!');
     }
    }
  });
    
 }
 else
 {
  alert('A senha inserida não pode ser o seu registro!');
   var senha1 = document.getElementById('senha1');
   senha1.value = "";
   var senha2 = document.getElementById('senha2');
   senha2.value = "";
   document.getElementById('senha1').focus(); 
 }
}
else
{
  alert('As senhas inseridas não estão iguais!');
  var senha1 = document.getElementById('senha1');
   senha1.value = "";
   var senha2 = document.getElementById('senha2');
   senha2.value = "";
   document.getElementById('senha1').focus(); 
}


 


}


</script>

</body>
<style>

body{
    background-image: url( './images/fundo_ocr.jpg' );
    background-size: 100%;
    height: 63px;  
    width: 63px;
}
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 42%;
    top: 94%;
    font: normal 12pt verdana;
    color:#ffffff;
}


.mensagem{
  display:none;
  position:absolute;
  top: 51%; /* Usei % para que voce entenda que da para se adaptar com o tamanho do botão/container ou qualquer outra coisa a qual a mensagem esta relacionada*/
  left:52%;
  right:0;
  margin: auto;
  font: normal 12pt verdana;
  color:#ffffff;
  width:300px;
  height:50px;
  border:0px solid red;
}

.mensagem2{
  display:none;
  position:absolute;
  top: 45%; /* Usei % para que voce entenda que da para se adaptar com o tamanho do botão/container ou qualquer outra coisa a qual a mensagem esta relacionada*/
  left:52%;
  right:0;
  margin: auto;
  font: normal 12pt verdana;
  color:#ffffff;
  width:300px;
  height:20px;
  border:0px solid red;
}




IMG#logo2{
    margin-left: 0px;
    position: absolute;
    left: 47%;
    top: 69%;
    width: 160px;
    height: 40px;
    cursor: pointer;

}
IMG#carregando{
    margin-left: 0px;
    position: absolute;
    left: 46.1%;
    top: 68%;
    width: 60px;
    height: 60px;
    background-color: transparent;
    cursor: pointer;

}
LABEL#titulo{
    position: absolute;
    left: 40%;
    top: 29.5%;
    font: bold 30pt verdana;
    color:	#ffffff;
    opacity: 0.8;
}
LABEL#titulo2{
    position: absolute;
    left: 38.5%;
    top: 35.5%;
    font: bold 14pt verdana;
    color:	#222;
}


DIV#borda {
    position: absolute;
    left: 37.5%;
    top: 26%;
    width: 400px;
    height: 420px;
    color: #FFFFFF;
    background-color: #4F4F4F;
    border-radius: 12px!important;
    border: 5px rgba(0,0,0,1) solid!important;
    cursor: pointer;
    opacity: 0.6;


}

INPUT#acessar {
    position: absolute;
    left: 41.7%;
    top: 58%;
    width: 300px;
    height: 50px;
    font: bold 14pt verdana;
    color: #FFFFFF;
    background-color: rgba(0,0,200,0.7);
    border-radius: 8px!important;
    border: 3px rgba(0,0,0,1) solid!important;
    cursor: pointer

}

INPUT#acessar:hover
{
 background-color: #D3D3D3; /* Preto */
 color: #000000;

}
INPUT#acessar:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#registro {
    position: absolute;
    left: 42%;
    top: 44%;
    margin-left:0px;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:20px;
    font: normal 12pt verdana;
    color: #000000;
    width:260px;
    height:16px;
    text-align:left;
    border: 3px #ffffff solid!important;
    background-color: #DCDCDC;
    border-radius: 8px!important;
    cursor: pointer;
    opacity: .8;

}
INPUT#senha {
    position: absolute;
    left: 42%;
    top: 51%;
    margin-left:0px;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:20px;
    font: normal 12pt verdana;
    color: #000000;
    width:260px;
    height:16px;
    text-align:left;
    border: 3px #ffffff solid!important;
    background-color: #DCDCDC;
    border-radius: 8px!important;
    cursor: pointer;
    opacity: .8;

}







LABEL#titulo3{
    position: absolute;
    left: 43.4%;
    top: 39%;
    font: bold 16pt verdana;
    color:	rgba(240,0,0,1);
}

INPUT#senha1 {
    position: absolute;
    left: 42%;
    top: 44%;
    margin-left:0px;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:20px;
    font: normal 12pt verdana;
    color: #000000;
    width:260px;
    height:16px;
    text-align:left;
    border: 3px #ffffff solid!important;
    background-color: #DCDCDC;
    border-radius: 8px!important;
    cursor: pointer;
    opacity: .8;

}





INPUT#senha2 {
    position: absolute;
    left: 42%;
    top: 51%;
    margin-left:0px;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:20px;
    font: normal 12pt verdana;
    color: #000000;
    width:260px;
    height:16px;
    text-align:left;
    border: 3px #ffffff solid!important;
    background-color: #DCDCDC;
    border-radius: 8px!important;
    cursor: pointer;
    opacity: .8;

}

.mensagem3{
  display:none;
  position:absolute;
  top: 45%; /* Usei % para que voce entenda que da para se adaptar com o tamanho do botão/container ou qualquer outra coisa a qual a mensagem esta relacionada*/
  left:52%;
  right:0;
  margin: auto;
  font: normal 12pt verdana;
  color:#ffffff;
  width:300px;
  height:50px;
  border:0px solid red;
}

.mensagem4{
  display:none;
  position:absolute;
  top: 51%; /* Usei % para que voce entenda que da para se adaptar com o tamanho do botão/container ou qualquer outra coisa a qual a mensagem esta relacionada*/
  left:52%;
  right:0;
  margin: auto;
  font: normal 12pt verdana;
  color:#ffffff;
  width:300px;
  height:20px;
  border:0px solid red;
}
INPUT#salvar_acessar {
    position: absolute;
    left: 41.7%;
    top: 58%;
    width: 300px;
    height: 50px;
    font: bold 14pt verdana;
    color: #FFFFFF;
    background-color: rgba(0,0,200,0.7);
    border-radius: 8px!important;
    border: 3px rgba(0,0,0,1) solid!important;
    cursor: pointer

}

INPUT#salvar_acessar:hover
{
 background-color: #00008B; /* Preto */
 color: #ffffff;

}
INPUT#salvar_acessar:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
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
</style>

</html>