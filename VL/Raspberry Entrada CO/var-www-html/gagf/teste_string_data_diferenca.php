<?php
$dia1 = 14;
$dia2 = 14;

$hora_entrada = "23:29:48";
$hora_pesagem = "02:16:35";
$data_pesagem = "15/02/2020";
$data_entrada = "14/02/2020";


if ( $dia1 == $dia2)
{
    $hora1 = DateTime::createFromFormat('d/m/Y H:i:s', $data_entrada." ".$hora_entrada);
    $hora2 = DateTime::createFromFormat('d/m/Y H:i:s', $data_pesagem." ".$hora_pesagem);
 echo $hora1->diff($hora2)->format('%H:%I:%S');
}
else
{
 $hora1 = DateTime::createFromFormat('H:i:s', '23:29:48');
 $hora_aux1 = DateTime::createFromFormat('H:i:s', '23:59:59');
 $resultado1 = $hora1->diff($hora_aux1)->format('%H horas %i minutos e %s segundos');
 $hora2 = DateTime::createFromFormat('H:i:s', '01:28:35');
 $hora_aux2 = DateTime::createFromFormat('H:i:s', '00:00:00');
 $resultado2 = $hora_aux2->diff($hora2)->format('%H horas %i minutos e %s segundos');
 
 echo $resultado2;
}






?>