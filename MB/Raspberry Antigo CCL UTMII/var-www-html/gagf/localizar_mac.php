<?php
  //$mac_address = "FC:FB:FB:01:FA:21";
   $mac_address = $_GET['mac'];

  $url = "https://api.macvendors.com/" . urlencode($mac_address);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  if($response) {
    if (strstr($response,'"errors":{"detail"'))
        {
         echo "Encontrado mais erro ao decodificar o fabricante!";
        }else{
    echo "Fabricante: $response";}
  } else {
    echo "Not Found";
  }
?>