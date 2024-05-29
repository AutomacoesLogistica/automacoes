<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     date_default_timezone_set('America/Sao_Paulo');
     $valor_dia = date('Y/m/d h:i:s'); // BUSCA A DATA E HORA DE AGORA!
     //echo $valor_dia;
     // echo"</br>";
     
     $data_banco = "17/11/2021";
     $data_banco = explode('/',$data_banco);
     $data_banco = $data_banco[2].'/'.$data_banco[1].'/'.$data_banco[0];
     $hora_banco = "10:25:48";


     $data_agora = "17/11/2021";
     $data_agora = explode('/',$data_agora);
     $data_agora = $data_agora[2].'/'.$data_agora[1].'/'.$data_agora[0];
     $hora_agora = "10:26:06";

     $valor_inicial = date_create($data_banco.' '.$hora_banco);
     $valor_final = date_create($data_agora.' '.$hora_agora);
     $diferenca = date_diff($valor_final,$valor_inicial);
     //print_r($diferenca);
     
     $diferenca_anos = $diferenca->y;
     $diferenca_meses = $diferenca->m;
     $diferenca_dias = $diferenca->d;
     $diferenca_horas = $diferenca->h;
     $diferenca_minutos = $diferenca->i;
     $diferenca_segundos = $diferenca->s;
    
     echo "Anos: " .$diferenca_anos;
     echo"</br>";
     echo "Meses: ".$diferenca_meses;
     echo"</br>";
     echo "Dias: ".$diferenca_dias;
     echo"</br>";
     echo "Horas: ".$diferenca_horas;
     echo"</br>";
     echo "Minutos: ".$diferenca_minutos;
     echo"</br>";
     echo "Segundos: ".$diferenca_segundos;


    ?>
</body>
</html>