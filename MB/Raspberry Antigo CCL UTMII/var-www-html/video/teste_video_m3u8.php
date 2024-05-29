<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- CSS  -->
<link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet">
<!-- HTML -->
<video id='hls-example'  class="video-js vjs-default-skin" width="400" height="300" controls>
<source type="application/x-mpegURL" src="http://138.0.77.80:5009/ms0742-cam01/e-01-20210813-144701.m3u8">
</video>
<!-- JS code -->
<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>
<script src="https://vjs.zencdn.net/7.2.3/video.js"></script>
<script>
var player = videojs('hls-example');
player.play();
</script>
</body>
</html>
   
