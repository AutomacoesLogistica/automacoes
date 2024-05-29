<?php

$mensagem = $_GET['mensagem'];
$mensagem2 = $_GET['mensagem2'];

$mensagem_tratada2 = "";
$mensagem_tratada2_2 = "";
$mensagem_CRC="";
$mensagem_CRC_2="";
$tamanho = 0;
$tamanho2 = 0;

$tamanho_mesagem1 = 0;
$tamanho_mesagem1= strlen($mensagem);

$tamanho_mesagem2 = 0;
$tamanho_mesagem2= strlen($mensagem2);

if($tamanho_mesagem1 != 19)
{
  ////echo 'menor';
  $vezes = 19-intval($tamanho_mesagem1);
  for ($i = 0; $i<$vezes;$i++) 
  {
   $mensagem = $mensagem. " ";//Nao retirar esse espaco!
  }
}
else
{
  ////echo 'esta correto!';
}

if($tamanho_mesagem2 != 19)
{
  ////echo 'menor';
  $vezes2 = 19-intval($tamanho_mesagem2);
  for ($i = 0; $i<$vezes2;$i++) 
  {
   $mensagem2 = $mensagem2. " ";//Nao retirar esse espaco!
  }
}
else
{
  ////echo 'esta correto!';
}


for ($i = 0; $i<strlen($mensagem);$i++) 
{
  $tamanho = $tamanho + 1;
  $str = substr($mensagem,$i,1);
  $mensagem_tratada = dechex(ord($str));  
  
  ////echo substr($mensagem,$i,1) . ' = ' . $mensagem_tratada;
  ////echo '</BR>';

  $mensagem_tratada2 = $mensagem_tratada2 .$mensagem_tratada . " ";
  $mensagem_CRC = $mensagem_CRC . strval($mensagem_tratada);
  
}


for ($i = 0; $i<strlen($mensagem2);$i++) 
{
  $tamanho2 = $tamanho2 + 1;
  $str = substr($mensagem2,$i,1);
  $mensagem_tratada_2 = dechex(ord($str));  
  
  ////echo substr($mensagem,$i,1) . ' = ' . $mensagem_tratada;
  ////echo '</BR>';

  $mensagem_tratada2_2 = $mensagem_tratada2_2 .$mensagem_tratada_2 . " ";
  $mensagem_CRC_2 = $mensagem_CRC_2 . strval($mensagem_tratada_2);
  
}





//echo 'Mensagem tratada1 : ' . $mensagem;
//echo '</BR>';
//echo '</BR>';
//echo 'Mensagem1  HEX: ';
//echo strtoupper($mensagem_tratada2);
//echo ' ----> Tamanho : ';
//echo $tamanho;
//echo '</BR>';
//echo '</BR>';
//echo 'Mensagem tratada2 : ' . $mensagem2;
//echo '</BR>';
//echo '</BR>';
//echo 'Mensagem2 HEX: ';
//echo strtoupper($mensagem_tratada2_2);
//echo ' ----> Tamanho : ';
//echo $tamanho2;
//echo '</BR>';
//echo '</BR>';

$tamanho = dechex(ord($tamanho));
$protocolo = "01 02 50 01 01 AA 01 01 82 01 01 00 ";// NAO TERIAR O ESPACO NO FIM
$tamanho_mensagem = "32 ";// NAO TERIAR O ESPACO NO FIM Equivale a 50 em HEX

$funcoes = "AA 10 AA 70 AA 01 "; // NAO TERIAR O ESPACO NO FIM 
$funcoes2 = "AA 10 AA 70 AA 02 "; // NAO TERIAR O ESPACO NO FIM 
$mensagem_fim = '03';

$mensagem_completa = $protocolo . $tamanho_mensagem. $funcoes . strtoupper($mensagem_tratada2). $funcoes2. strtoupper($mensagem_tratada2_2) . $mensagem_fim;
echo $mensagem_completa;
//echo '</BR>';
//echo '</BR>';

$mensagem_completa2 = strval(str_replace(" ","",$mensagem_completa ));

//AGORA TRATO E CALCULO O CRC

define('CRC16POLYN', 0x1021);

function CRC16Normal($buffer) {
    $result = 0xFFFF;
    if (($length = strlen($buffer)) > 0) {
        for ($offset = 0; $offset < $length; $offset++) {
            $result ^= (ord($buffer[$offset]) << 8);
            for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                if (($result <<= 1) & 0x10000) $result ^= CRC16POLYN;
                $result &= 0xFFFF;
            }
        }
    }
    return $result;
}

//Calculando o crc e tratando para uppercase
$crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem_completa2))));
if(strlen($crc_16_CCITT)<4)
{
  $crc_16_CCITT = '0'.$crc_16_CCITT;
}


$mensagem_display = $mensagem_completa . ' '. substr($crc_16_CCITT,0,2). ' '. substr($crc_16_CCITT,2,2);
$mensagem_display = str_replace(' ','',$mensagem_display);


//echo 'O CRC e : ';
//echo $crc_16_CCITT;
//echo '</BR>';
//echo '</BR>';
//echo 'Mensagem a ser enviada para o display: ';
//echo $mensagem_display;

//echo '</BR>';

//ABAIXO HABILITA ENVIAR PARA O DISPLAY

$mensagem_a_enviar =  hex2bin($mensagem_display);
$ip ="192.168.10.100";
$port="2101";
//$ip = "138.0.77.80";
//$port = "3575";

$sock=socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create socket");
$con=socket_connect($sock,$ip,$port) or die("Cannot connect to socket");

socket_write($sock,$mensagem_a_enviar); // Envia o socket
socket_close($sock); // Fecha a conexao com o IP


?>