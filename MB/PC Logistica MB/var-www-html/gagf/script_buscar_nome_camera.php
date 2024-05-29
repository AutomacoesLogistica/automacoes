<?php
$ip = isset($_GET['ip'])?$_GET['ip']:"vazio"; //Passar ip e porta juntos!

if($ip != "vazio")
{
  if(strpos($ip,".11.") > 0)
  {
   //Faixa da eletrica, usar senha eletrica2023@@
   $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.$ip.'/cgi-bin/configManager.cgi?action=getConfig&name=ChannelTitle',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
  CURLOPT_USERPWD => 'admin' . ":" . 'eletrica2023@@',
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',
    'Accept-Language: pt-BR,pt;q=0.9',
    'Accept-Encoding: gzip, deflate',
    'Accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$mensagem = explode("=",$response);

if($response == "")
{
 echo "Erro dados!";
}
else
{
  echo ($mensagem[1]);
}

  }
  else
  {
    //Deixa rodar com senha logsitica2019@@
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://'.$ip.'/cgi-bin/configManager.cgi?action=getConfig&name=ChannelTitle',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
  CURLOPT_USERPWD => 'admin' . ":" . 'logistica2019@@',
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',
    'Accept-Language: pt-BR,pt;q=0.9',
    'Accept-Encoding: gzip, deflate',
    'Accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$mensagem = explode("=",$response);

if($response == "")
{
 echo "Erro dados!";
}
else
{
  echo ($mensagem[1]);
}

  }



}
else
{
  echo "Erro!";
}

?>
