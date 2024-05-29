<?php

$mensagem = "#Alien RFID Reader Tag Stream
#ReaderName: Saida Balanca 1, CA = KB16005363
#Hostname: SAIDABAL1
#IPAddress: 192.168.10.94
#IPAddress6: fdaa::aaaa
#CommandPort: 23
#MACAddress: 00:1B:5F:01:14:48
#Time: 2022/12/15 13:43:41.421
epc=442001000000000000003441,ant=1,host=SAIDABAL1,data=2022/12/15,hora=13:43:41.405
";



$mensagem = explode("#",$mensagem);
var_dump($mensagem);
echo "</BR>";
echo "</BR>";echo "</BR>";
//echo $mensagem[0];
//echo "</BR>";

/*
$v_msg = explode(",",$mensagem[1]);
$v_msg = $v_msg[1];
*/
//echo $mensagem[2];
$v_msg = explode(",",$mensagem[2]);
$nomeReader = $v_msg[0];
$nomeReader = explode(":",$nomeReader);
$nomeReader = $nomeReader[1];
$ca = $v_msg[1];
$ca = explode(" = ",$ca);
$ca = $ca[1];
echo $nomeReader;
echo "</BR>";
echo $ca;
echo "</BR>";
$hostname = explode(":",$mensagem[3]);
$hostname = $hostname[1];
echo $hostname;
echo "</BR>";
$ip = explode(":",$mensagem[4]);
$ip = $ip[1];
echo $ip;
echo "</BR>";
$mac = explode(": ",$mensagem[7]);
$mac = $mac[1];
echo $mac;
echo "</BR>";
$mensagem1 = $mensagem[8];
$mensagem2 = explode(" ",$mensagem1);
$dados = $mensagem2[2];
$dados = explode(",",$dados);
$epc = $dados[0];
$epc = explode("=",$epc);
$epc = $epc[1];
$antena = explode("=",$dados[1]);
$antena = $antena[1];
echo $epc;
echo "</BR>";
echo $antena;
echo "</BR>";



?>