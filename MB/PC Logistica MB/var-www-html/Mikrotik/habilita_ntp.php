<?php
require('./api/routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = false;

if ($API->connect('192.168.10.2', 'admin', 'logistica2019@@')) 
{
  $API->comm("/system/ntp/client/set", array(
    "enabled" => "yes",
    "servers" => "a.ntp.br",

  ));
  
  $API->disconnect();

}
  
?>

