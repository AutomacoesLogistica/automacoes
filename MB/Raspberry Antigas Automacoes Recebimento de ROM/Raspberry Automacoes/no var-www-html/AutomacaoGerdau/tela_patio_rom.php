<!DOCTYPE html>
<html lang="pt-br">
<head>
    <script src="js/index.js" type="text/javascript"></script>
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="GENERATOR" content="MAX's HTML Beauty++ ME">
    <title>Document</title>
</head>

<body onload="setInterval('tempo();',200)">
<form id="formulario" hidden='hidden'>
<input type="text" name="mensagem" id="mensagem" value='mensagem'/>
<input id='consulta' type=button name='consulta' value='Buscar'/>
</form>


<label name="resposta" id="resposta" hidden='hidden'></label>
<iframe id='tela' src="ROM_Descarga_Nova.php" scrolling=no resize=no></iframe>

<script>
var ultima_mensagem = "--";
 function tempo()
 {
  document.getElementById("consulta").click();
  var link = document.getElementById("resposta");
  var valor = link.innerHTML;
  
  if(valor == "INI" && valor != ultima_mensagem)
  {
    ultima_mensagem = valor;
    document.getElementById("tela").src="ROM_Descarga_Nova.php";
  }
  else if (valor == "P_OK"  && valor != ultima_mensagem)
  {
    ultima_mensagem = valor;
    document.getElementById("tela").src="ROM_DescargaOK_PatioCheio.php";
  }
  else if (valor == "OK"  && valor != ultima_mensagem)
  {
    ultima_mensagem = valor;
    document.getElementById("tela").src="ROM_Descarga_OK.php";
  }
  else if (valor == "NOK"  && valor != ultima_mensagem)
  {
    ultima_mensagem = valor;
    document.getElementById("tela").src="ROM_DescargaNOK.php";
  }
  else if (valor == "NOK2"  && valor != ultima_mensagem)
  {
    ultima_mensagem = valor;
    document.getElementById("tela").src="ROM_DescargaNOK2.php";
  }
  else if (valor == "ALE"  && valor != ultima_mensagem)
  {
    ultima_mensagem = valor;
    document.getElementById("tela").src="ROM_DescargaALERTA.php";
  }
  
 }



 $(document).ready(function (){
    $("#consulta").click(function (){
       var form = new FormData($("#formulario")[0]);
       $.ajax({
           url: 'tela_patio_rom2.php',
           type: 'POST',
           dataType: 'html',
           cache: false,
           processData: false,
           contentType: false,
           data: form,
           timeout: 8000,
           success: function(resultado){
               $("#resposta").html(resultado);
           }
       });
    });
});



</script>



</body>

<style>
DIV#relogio{
    background-color: red;
}

DIV#resposta{
    background-color: green;
    position: absolute;
    top:20%;
    left: 10%;
    width: 200px;
    height: 80px;

}
IFRAME#tela{
    margin-left: 0px;
    position: absolute;
    left: 0px;
    top: 0px;
    width: 99.7%;
    height: 99.4%;
    

}
</style>
</HTML>