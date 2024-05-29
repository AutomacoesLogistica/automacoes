<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
</head>
<body>





<div id="div_tela">
<iframe id="tela_gagf" src="https://ya7da335bbb3.us2.hana.ondemand.com/gagf/ui/index.html"></iframe>
<div id="div_tela_alternativa">
    <iframe id="tela_alternativa" src="http://138.0.77.80:3062/tela_pires/tela_mensagem.php"></iframe>
</div>        
<img id="atualizacao" src="./images/atualizacao.png" onclick="clicou_atualizar();" hidden='hidden'/>




</div>
</body>

<script>
valor_tela = 0;
document.getElementById("tela_alternativa").style.display="none";
document.getElementById("tela_gagf").style.display="none";

function clicou_atualizar()
{
   var v_tela = valor_tela;
   if(v_tela == 1)
   {
    document.getElementById("tela_alternativa").style.display="block";
    document.getElementById("tela_gagf").style.display="none";
   }
   else
   {
    document.getElementById("tela_alternativa").style.display="none";
    document.getElementById("tela_gagf").style.display="block"; 
   }
}




var utlima_mensagem = "-"; // Inicia com essa mensagem
var msg_recebida = "";
function busca_mensagem() 
{
  setInterval(function() 
  {
    //Aqui vai o que deseja fazer
    $.ajax({
           url: 'busca_mensagem.php',
           type: 'GET',
           dataType: 'text',
           timeout: 8000,
           success: function(resultado){
            const myArray = resultado.split(";");
            
            msg_recebida = myArray[0];
            valor_tela = myArray[1];
            if(msg_recebida == utlima_mensagem)
            {
             console.log("Igual!");
            }
            else
            {
              utlima_mensagem = msg_recebida;
              console.log(msg_recebida);
              
              if(msg_recebida != '')
              {
               //tenho que atualizar a tela div
               $("#div_tela_alternativa").load(window.location.href + " #div_tela_alternativa"); 
              
               //document.getElementById("mensagem").innerHTML = msg_recebida;
              }
            }
            console.log(valor_tela);
            clicou_atualizar();
            
           }
       });
  }, 3000);


}

busca_mensagem() ;





</script>

<style>

IFRAME#tela_gagf{
    width: 100%;
    height: 100%;
    top:  0%;
    left: 0%;
}
IFRAME#tela_alternativa{
    width: 100%;
    height: 100%;
    top:  0%;
    left: 0%;
}
DIV#div_tela{
    margin-left: 0px;
    position: absolute;
    left: 0.5%;
    top: 1%;
    width: 99%;
    height: 98%;
    background-color: transparent;
    cursor: pointer;

}
DIV#div_tela_alternativa{
    margin-left: 0px;
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: transparent;
    cursor: pointer;

}
IMG#atualizacao{
    margin-left: 0px;
    position: absolute;
    left: 1%;
    top: 1%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}

body{

}
html{
background: url("./images/tela_fundo.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>



</html>