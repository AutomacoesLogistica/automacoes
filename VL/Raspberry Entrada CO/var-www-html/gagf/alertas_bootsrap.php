<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
  


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="container">
<!--NAO APAGAR ESSA DIV NEM ALTERAR O NOME, ELA SERVE PARA HABILITAR O ALERTA COM BOOTSRAP -->
<!--
para aleta de ok    div class="alert alert-success... <i class="glyphicon glyphicon-exclamation-sign">
para aleta de erro    div class="alert alert-danger... <i class="glyphicon glyphicon-exclamation-sign">
para aleta de alerta    div class="alert alert-warning... <i class="glyphicon glyphicon-info-sign">

-->
</div>

<script>
//alerta_ok('Salvo com sucesso.');//Chama o alerta
alerta_erro('Ocorreu um erro ao salvar!');//Chama o alerta
//alerta_info('Atenção! </BR> Temperatura alta!');//Chama o alerta

function alerta_ok(msg) 
{
 var dom = '<div class="top-alert"><div class="alert alert-success alert-dismissible fade in " role="alert"><i class="glyphicon glyphicon-ok"></i> ' + msg +'</div></div>';
 var jdom = $(dom);
 jdom.hide();
 $("body").append(jdom);
 jdom.fadeIn();
 setTimeout(function() 
 {
  jdom.fadeOut(function() 
  {
   jdom.remove();
  });
 }, 2000);
}

function alerta_erro(msg) 
{
 var dom = '<div class="top-alert"><div class="alert alert-danger alert-dismissible fade in " role="alert"><i class="glyphicon glyphicon-exclamation-sign"></i> ' + msg +'</div></div>';
 var jdom = $(dom);
 jdom.hide();
 $("body").append(jdom);
 jdom.fadeIn();
 setTimeout(function() 
 {
  jdom.fadeOut(function() 
  {
   jdom.remove();
  });
 }, 2000);
}


function alerta_info(msg) 
{
 var dom = '<div class="top-alert"><div class="alert alert-warning alert-dismissible fade in " role="alert"><i class="glyphicon glyphicon-info-sign"></i> ' + msg +'</div></div>';
 var jdom = $(dom);
 jdom.hide();
 $("body").append(jdom);
 jdom.fadeIn();
 setTimeout(function() 
 {
  jdom.fadeOut(function() 
  {
   jdom.remove();
  });
 }, 2000);
}










</script>
</body>
</html>
<style>
.top-alert {
  position: absolute;
  top: 1%;
  width: 200px;
  height: 100px;
  left: 33%;
  padding: 10px;
  font: normal 12pt verdana;
  text-align: center;
}
.alert {
  width: 400px;
  height: 100%;
  
}


</style>
