<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<script>

$.ajax({
           url: 'verifica_dispositivos.php',
           type: 'GET',
           dataType: 'html',
           
           success: function(resultado){
               console.log(resultado);
      
            }
          });
        </script>


</body>
</html>