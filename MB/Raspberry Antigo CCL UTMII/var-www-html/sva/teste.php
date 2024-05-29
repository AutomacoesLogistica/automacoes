<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>OLA</title>
</head>
<body>
    <?php

echo 'rodando';
$id = '123';
?>
<script>
var id = '<?php print $id ?>';

$.ajax({
           url: 'verifica_videos.php',
           type: 'GET',
           dataType: 'html',
           data: {'id': id},
           success: function(resultado){
            alert(resultado);
             if(resultado == "ok")
             {
              alert("Efetuado a alteração com sucesso!");
             }
             else
             {
              alert("Ocorreu um erro ao efetuar a edição!");
             }
             
           }
         });

</script>
</body>
</html>