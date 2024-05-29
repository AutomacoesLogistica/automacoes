<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->$_COOKIE
  <script src='./script/script_display.js'></script>
</head>
<body>
  
<input type="text" id="mensagem1" name="mensagem1" value="" maxlength="19"/>
<input type="text" id="mensagem2" name="mensagem2" value="" maxlength="19"/>
<input type="buttom" id="calcular" name="calcular" value="Enviar para Display" onclick="calcular_CRC()"/>
<input type="buttom" id="limpar" name="limpar" value="Limpar Display" onclick="Limpar()"/>
<input type="text" id="crc" name="crc" value=""/>





<script>

function calcular_CRC()
{
  //alert('entrou');
  var link_msg1 = document.getElementById('mensagem1');
  var link_msg2 = document.getElementById('mensagem2');
  var link_crc = document.getElementById('crc');
  
  

  
  $.ajax({
           url: 'calcula.php?mensagem='+link_msg1.value+'&mensagem2='+link_msg2.value,
           type: 'GET',
           dataType: 'html',
           success: function(resultado){
             //alert(resultado);
            link_crc.value = resultado;
           }
       });




}

function Limpar()
{
  //alert('entrou');
  var link_msg1 = document.getElementById('mensagem1');
  var link_msg2 = document.getElementById('mensagem2');
  var link_crc = document.getElementById('crc');
  link_msg1.value = '';
  link_msg2.value = '';
  

  
  $.ajax({
           url: 'calcula.php?mensagem='+link_msg1.value+'&mensagem2='+link_msg2.value,
           type: 'GET',
           dataType: 'html',
           success: function(resultado){
             //alert(resultado);
            link_crc.value = resultado;
           }
       });




}
</script>








<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

</body>
</html>

<style>

INPUT#mensagem1
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 18pt verdana;
    color:#000000;
    left: 10%;
    top: 5%;

}

INPUT#mensagem2
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 18pt verdana;
    color:#000000;
    left: 10%;
    top: 9.5%;

}
INPUT#crc
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 80%;
    height: 3%;
    font: normal 14pt verdana;
    color:#000000;
    left: 10%;
    top: 18.5%;

}

INPUT#calcular
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:32%;
    top: 5%;
    width:15%;
    height:7%;
    padding-left: 5px;
    text-align: center;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#calcular:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#calcular:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#limpar
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 12pt verdana;
    left:49%;
    top: 5%;
    width:17%;
    height:7%;
    padding-left: 5px;
    text-align: center;
    background-color: #29A1AB;
    border-radius: 16px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#calcular:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#calcular:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#home{
    margin-left: 0px;
    position: absolute;
    left: 38px;
    top:  2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}


#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 88%;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3%;
    top: 0%;
    width:92.9%;
    height:3%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 6%;
    top: -10%;
}
#funcao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 75%;
    top: 5%;
}

INPUT#criptografia
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 11pt verdana;
    color:#000000;
    left: 30%;
    top: 5%;

}
INPUT#criptografia2
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 100px;
    font: normal 11pt verdana;
    color:#000000;
    left: 55%;
    top: 5%;

}

body{

}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>
