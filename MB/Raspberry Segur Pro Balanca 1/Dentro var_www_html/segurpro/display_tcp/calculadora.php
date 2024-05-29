<?php
//CALCULANDO CRC
$buffer = array();
$buffer = ["A1","B4","C3"];
$mensagem = "";
$checksum = 0;
echo 'Buffer (hex)';
echo'</BR>';
for($i=0;$i<3;$i++)
{
   echo hexdec($buffer[$i]) ;echo'</BR>';
  $checksum +=hexdec($buffer[$i]) ;
  $mensagem = $mensagem . strval($buffer[$i]);
  if($checksum>255)
  {
   $checksum = $checksum-256;   
  }
}
echo 'O valor do checksum e : ';
echo $checksum;
echo ' para a mensagem : ';
echo $mensagem;
echo '</BR>';

//AGORA CALCULA O CRC

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
$crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem))));


echo 'O CRC e: ';
echo $crc_16_CCITT;

?>