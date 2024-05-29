<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>




<link rel="stylesheet" href="//releases.flowplayer.org/7.0.4/commercial/skin/skin.css">
    <style>

   </style>
   <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//releases.flowplayer.org/7.0.4/commercial/flowplayer.min.js"></script>
  <script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.min.js"></script> 
  <script>
  flowplayer(function (api) {
    api.on("load", function (e, api, video) {
      $("#vinfo").text(api.engine.engineName + " engine playing " + video.type);
    }); });
  </script>

<div class="flowplayer fixed-controls no-toggle no-time play-button obj"
      style="    width: 85.5%;
    height: 80%;
    margin-left: 7.2%;
    margin-top: 6%;
    z-index: 1000;" data-key="$812975748999788" data-live="true" data-share="false" data-ratio="0.5625"  data-logo="">
      <video autoplay="true" stretch="true">

         <source type="application/x-mpegurl" src="http://192.168.20.117:8597/ms0742-cam00/e-00-20210813-114730.m3u8">
      </video>   
   </div>











</body>
</html>