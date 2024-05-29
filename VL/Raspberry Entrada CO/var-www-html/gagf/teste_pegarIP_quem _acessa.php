<html>
<head>
 <title>Identificar IP do usuário</title>
</head>
 
<body>
 
<?php

   $ip = $_SERVER['REMOTE_ADDR'];
   echo "Seu IP é: ".$ip;

  if($ip == "::1")
  {
    echo('local');
  }
  else{
      echo('remoto');
  }

   echo '<pre>';
var_dump($_SERVER);
echo '</pre>'; 


/*
$url_video = str_replace("138.0.77.80:5009", $url_video);
*/

?>
 
</body>
</html>