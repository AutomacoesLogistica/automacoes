<?php

$dlc = '47';
$dtc = '50';

$valor_dlc = '7';
$valor_dtc = '5';


$total_dlc_max = (50*($valor_dlc/100))+50 ; // Valor maximo DLC
$total_dlc_min = 50-(50*($valor_dlc/100)) ; // Valor minimo DLC

$total_dtc_max = (50*($valor_dtc/100))+50 ; // Valor maximo DTC
$total_dtc_min = 50-(50*($valor_dtc/100)) ; // Valor minimo DTC

$alerta_dlc = 0;
$alerta_dtc = 0;



echo 'Resumo ************************************';
echo'</BR>';
echo 'DLC = ' .$dlc . ' - Valor DLC = ' . $valor_dlc . ' - DLC MAX = ' . $total_dlc_max . ' - DLC MIN = ' . $total_dlc_min;
echo'</BR>';
echo 'DTC = ' .$dtc. ' - Valor DTC = ' . $valor_dtc. ' - DTC MIN = ' . $total_dtc_max . ' - DTC MIN = ' . $total_dtc_min;
echo'</BR>';
echo'</BR>';
echo'</BR>';

if( floatval($dlc) > floatval($total_dlc_min) && floatval($dlc) < floatval($total_dlc_max) )
{
 // Esta ok, dentro do valor aceito!
echo 'entrou1</BR>';
$alerta_dlc = 0;
}
else
{
  $alerta_dlc = 1;  
  echo 'entrou2</BR>';
}

if( floatval($dtc) > floatval($total_dtc_min) && floatval($dtc) < floatval($total_dtc_max) )
{
 // Esta ok, dentro do valor aceito!
 echo 'entrou3</BR>';
 $alerta_dtc = 0;
}
else
{
 $alerta_dtc = 1;
 echo 'entrou4</BR>';
}

$msg_alerta = '';
if($alerta_dlc == 1 || $alerta_dtc == 1)
{
   echo 'erro'; 
    if($alerta_dlc == 1 && $alerta_dtc == 0 )
    {
        $msg_alerta = 'Alerta DLC';   
    }
    else if($alerta_dlc == 0 && $alerta_dtc == 1 )
    {
        $msg_alerta = 'Alerta DTC';   
    }
    else
    {
        //Os dois sao 1
        $msg_alerta = 'Alerta DTC e DLC';    
    }
    
}
else
{
 echo 'Tudo OK';   
 $msg_alerta = 'Tudo OK';   
}
?>