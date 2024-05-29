<!DOCTYPE html>
<html>
  
<head>
    <title>
        Audio autoplay property
    </title>
</head>
  
<body style="text-align: center">
  
    <h1 style="color: green">
      GeeksforGeeks
    </h1>
    <h2 style="font-family: Impact">
      Audio autoplay Property
    </h2>
    <br>
  
    <audio id="Test_Audio"
           controls autoplay>
        <source src="./audios/beep.mp3" type="audio/ogg">
        <source src="./audios/beep.mp3" type="audio/mpeg">
    </audio>
  
    <p>To know whether autoplay is enabled or not,
      double click the "Return Autoplay Status" button.
    </p>
    <br>
  
    <button ondblclick="My_Audio()">
      Return Autoplay Status
    </button>
  
    <p id="test"></p>
  
    <script>
        function My_Audio() {
            var a = 
               document.getElementById("Test_Audio").autoplay;
               document.getElementById("test").innerHTML = a;
        }
    </script>
  
</body>
  
</html>