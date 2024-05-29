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
<input type="text" id="data2" value="vazio" hidden="hidden"/>
<?php
//error_reporting(0);
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

<input type="text" name="registro"  id="registro" a rel="ajuda" placeholder ="Digite seu registro" required autofocus autocomplete="off"onmouseover="showMessage2()" onmouseout="hideMessage2()"/>
<br/><br/>
<input type="password" name="senha" id="senha" a rel="ajuda" placeholder="Digite sua senha de acesso" autocomplete="off"  onmouseover="showMessage()" onmouseout="hideMessage()"/>
<br/><br/>
<input id='acessar' type="button" value="Acessar" onclick="verificar_senha()"/>



<label id="titulo">Video Analítico</label>
<label id="titulo2">Cheio/Vazio - MB</label>
</div>


<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>
<div class="mensagem" >Para primeiro acesso usar o registro como sua senha!</BR></BR>Caso já tenha definido, insira sua senha atual!</div>
<div class="mensagem2" >Insira seu registro!</div>


<script>
// Utilizando JQuery
jQuery('senha').attr('autocomplete','off');
// Ou Javascript padrão
senha.setAttribute('autocomplete','off');
</script>

<script>

let mensagem = document.querySelector(".mensagem") ;
let mensagem2 = document.querySelector(".mensagem2") ;

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
        alert("primeiro acesso!");
      }
      else
      {
       //Pode acessar o programa
       //alert('Usuario:' + nome + ' Registro: ' + registro + ' Criptografia: '+ criptografia);
       complemento = String((parseInt(criptografia)+2021)*1.5);
       complemento2 = String((parseInt(registro)+22.5)*0.5);
       location.href=`tela_va_cheio_vazio_mb.php?complemento=`+complemento+`&check=`+ complemento2+ `&data=${data2.value}`+`&cameras=todas`+`&status=todos`;
       
      }
      
      
     }

    }
 });

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
    left: 44.5%;
    top: 35%;
    font: bold 16pt verdana;
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
</style>

</html>