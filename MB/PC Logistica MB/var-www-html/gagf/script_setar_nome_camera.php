<?php
$ip = isset($_GET['ip'])?$_GET['ip']:"vazio"; //Passar ip e porta juntos!
$nome = isset($_GET['nome'])?$_GET['nome']:"vazio";

if($ip != "vazio" && $nome != "vazio")
{
 
  $nome = str_replace(" ", "_", "$nome");

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://'.$ip.'/cgi-bin/configManager.cgi?action=setConfig&ChannelTitle[0].Name='.$nome,
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
  if($response == "OK")
  {
    echo "Nome da câmera alterado para " . $nome;
  }
  else
  {
    echo "Erro ao alterar nome da câmera!";
  }

  //$mensagem = explode("=",$response);
  //echo ($mensagem[1]);

}
else
{
 if($nome == "vazio")
 {
  echo "Favor inserir um nome valido!";
 }
 else
 { 
  echo "Erro!";  
 }
}
?>
