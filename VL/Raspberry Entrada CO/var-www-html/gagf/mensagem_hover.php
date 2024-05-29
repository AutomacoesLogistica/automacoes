<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button type="button" onmouseover="showMessage()" onmouseout="hideMessage()">
  Exemplo
  <div class="mensagem" >Para primeiro acesso usar o registro como sua senha!</div>
  </button>
</body>


<script>
let mensagem = document.querySelector(".mensagem") ;

// mostra a mensagem
function showMessage(){   
   mensagem.style.display = "block";   
 }
// esconde a mensagem
function hideMessage(){
  mensagem.style.display = "none"; 
}

</script>

<style>
body{
  position:absolute;
  width:100%;
  height:100%;
}

button{
  position:absolute;
  margin:auto;
  width:100px;
  height:30px;
  left:0;
  right:0;
  bottom:0;
  top:0;
}

/* Aqui a mensagem ja está com o display none para já começar escondida*/
.mensagem{
  display:none;
  position:absolute;
  top: -120%; /* Usei % para que voce entenda que da para se adaptar com o tamanho do botão/container ou qualquer outra coisa a qual a mensagem esta relacionada*/
  left:60px;
  right:0;
  margin: auto;
  width:400px;
  height:20px;
  border:0px solid red;
}

</style>
</html>