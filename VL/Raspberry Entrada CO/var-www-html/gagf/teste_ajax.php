<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<script src="js/index.js" type="text/javascript"></script>
<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
</head>

<script>
    var mensagem = 'manter';
    var id = '04';
    //alert(mensagem);
    //alert(id);
    var dados = "mensagem="+mensagem+"&id="+id;
    alert(dados);
    //PASSA VIA AJAX
    $.ajax({
      url:'http://192.168.20.66/AutomacaoGerdau/monitor_rom.php',
      type: "GET",
      data: dados,
      dataType: "html",
    });  
  </script>

</body>
</html>