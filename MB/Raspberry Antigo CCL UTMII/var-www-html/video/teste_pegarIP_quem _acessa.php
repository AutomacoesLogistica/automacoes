<html>
<head>
 <title>Identificar IP do usuário</title>
</head>
 
<body>
 
<?php
   $ip = $_SERVER['REMOTE_ADDR'];
   echo "Seu IP é: ".$ip;
   echo("</BR>");
   $url_video = "http://192.168.20.117:8597/api/dasdasdsad/dasdasda.m3u";
   

  if($ip == "192.168.20.1")
  {
    echo('remoto');
	$url_video = str_replace("192","138",$url_video);
	$url_video = str_replace("168","0",$url_video);
	$url_video = str_replace("20","77",$url_video);
	$url_video = str_replace("117","80",$url_video);
	$url_video = str_replace("8597","5009",$url_video);
   
  }
  else{
      echo('local');
  }
  echo("</BR>");echo("</BR>");echo("</BR>");echo("</BR>");echo("</BR>");
  echo($url_video);
?>
 
</body>
</html>