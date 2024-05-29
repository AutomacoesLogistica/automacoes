<?php


// Testa se esta online
$host = "192.168.10.96";
exec("ping -c 5 $host", $output, $status);

var_dump($output);
echo $status;
?>
