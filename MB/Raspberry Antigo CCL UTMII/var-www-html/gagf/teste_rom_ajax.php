<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Goncalves</title>
<script src="js/index.js" type="text/javascript"></script>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>
<body>
<?php
$mensagem = $_GET['mensagem'];
$id = $_GET['id'];
//echo $mensagem;
//echo $id;

?>
<script>
mensagem = '<?php print $mensagem ?>';
id = '<?php print $id ?>';

dados = 'mensagem='+mensagem+'&id='+id;

 //PASSA VIA AJAX
    $.ajax({
      url: 'http://192.168.20.66/AutomacaoGerdau/monitor_rom.php?'+dados,
      type: 'GET',
      dataType: 'html',
      success: function(resultado)
      {
       alert(resultado);
      }
 
    });
</script>

</body>
</html>