<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>

</head>
<body>
<label id="mensagem"></label>
   
</body>


<script>
var utlima_mensagem = "-"; // Inicia com essa mensagem, nao mudar!
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
              console.log(valor_tela);
              if(msg_recebida != '')
              {
               document.getElementById("mensagem").innerHTML = msg_recebida;
              }
              else{
                document.getElementById("mensagem").innerHTML = 'Marcação sendo realizada nos controles da UTMI!';
              }
            }
            
           }
       });
  }, 3000);


}


//Roda a primeira vez para ja atualizar rapido a tela
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
              console.log(valor_tela);
              if(msg_recebida != '')
              {
               document.getElementById("mensagem").innerHTML = msg_recebida;
              }
              else{
                document.getElementById("mensagem").innerHTML = 'Marcação sendo realizada nos controles da UTMI!';
              }
            }
            
           }
       });

busca_mensagem() ;
</script>


<style>
LABEL#mensagem{
    position: absolute;
    text-align:center;
    font: bold 60pt verdana;
    color: #B22222;
    left: 4%;
    top: 30%;
    padding-top: 20px;
    padding-bottom: 0px;
    width:90%;
    height:38%;
    background-color: #ffffff;
    border-radius: 16px!important;
    border: 8px #B22222 solid!important;
}
body{

margin-top: 0px;
}
html{
background: url("./images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}
</style>
</html>