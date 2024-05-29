<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Imagem de Fundo Preenchendo Toda a Tela</title>
    <style>
        /* Estilos (em um site real colocar em arquivo externo) */
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script>
        // JavaScript (em um site real colocar em arquivo externo)
    </script>
</head>
<body>

<div id="fundo-externo">
    <div id="fundo">
        <img id="fundo2" src="./images/fundo.jpg" alt="" />
        <img id="cftv" src="./images/cftv.png" onclick="javascript: location.href='http://192.168.2.66:8091/Login.htm';" />
        <img id="settings" src="./images/settings.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="projetor" src="./images/projetor.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="cenario" src="./images/cenario.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="cortina" src="./images/cortina2.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="energia" src="./images/energia.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="persiana" src="./images/cortina.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="portao" src="./images/portao.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="tv" src="./images/tv.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="iluminacao" src="./images/lampadas.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="sky" src="./images/sky.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="som" src="./images/som.png" onclick="javascript: location.href='consultar_placa1.php';" />
        <img id="nome" src="./images/nome.png" onclick="javascript: location.href='consultar_placa1.php';" />
    </div>
</div>





</body>
</html>


<style>

* {
    margin: 0;
    padding:0;
}

/* para garantir que estes elementos ocuparão toda a tela */
body, html {
    width: 100%;
    height: 100%;
    font-family: Arial, Tahoma, sans-serif;

}

#fundo-externo {
    overflow: hidden; /* para que não tenha rolagem se a imagem de fundo for maior que a tela */
    width: 100%;
    height: 100%;
    position: relative; /* criamos um contexto para posicionamento */
}

#fundo {
    position: fixed;
    width: 100%;
    height: 100%;
}

#fundo img#fundo2 {
    width: 100%;
     height: 100%;
    position: absolute;
}

#fundo img#cftv {
    width: 12%;
    height: 14%;
    margin-top: 30px;
    margin-left: 45%;
    position: relative;
    cursor: pointer;
}

#fundo img#settings {
    width: 7%;
    height: 11%;
    margin-top: 31%;
    margin-left: 46%;
    position: relative;
    cursor: pointer;
}

#fundo img#projetor {
    width: 7%;
    height: 11%;
    margin-top: 12%;
    margin-left: -42%;
    position: absolute;
    cursor: pointer;
}


#fundo img#cenario {
    width: 7%;
    height: 11%;
    margin-top: 12%;
    margin-left: 28%;
    position: absolute;
    cursor: pointer;
}


#fundo img#cortina {
    width: 9%;
    height: 13%;
    margin-top: -3%;
    margin-left: -20%;
    position: absolute;
    cursor: pointer;
}

#fundo img#energia {
    width: 7%;
    height: 13%;
    margin-top: 28%;
    margin-left: -19%;
    position: absolute;
    cursor: pointer;
}

#fundo img#persiana {
    width: 9%;
    height: 13%;
    margin-top: -2%;
    margin-left: 6%;
    position: absolute;
    cursor: pointer;
}

#fundo img#portao {
    width: 9%;
    height: 13%;
    margin-top: 28%;
    margin-left: 5%;
    position: absolute;
    cursor: pointer;
}

#fundo img#tv {
    width: 9%;
    height: 13%;
    margin-top: 2%;
    margin-left: -33%;
    position: absolute;
    cursor: pointer;
}

#fundo img#iluminacao {
    width: 9%;
    height: 15%;
    margin-top: 2%;
    margin-left: 19%;
    position: absolute;
    cursor: pointer;
}


#fundo img#sky {
    width: 9%;
    height: 10%;
    margin-top: 24%;
    margin-left: -33%;
    position: absolute;
    cursor: pointer;
}

#fundo img#som {
    width: 9%;
    height: 15%;
    margin-top: 22%;
    margin-left: 19%;
    position: absolute;
    cursor: pointer;
}

#fundo img#nome{
    width: 35%;
    height: 20%;
    margin-top: 10%;
    margin-left: -22%;
    position: absolute;
    cursor: pointer;
}



#site {
    position: absolute;
    top: 40px;
    left: 50%;
    width: 560px;
    padding: 20px;
    margin-left: -300px; /* por causa do posicionamento absoluto temos que usar margem negativa para centralizar o site */
    background: #FFF; /* fundo branco para navegadores que não suportam rgba */
    background: rgba(255,255,255,0.8); /* fundo branco com um pouco de transparência */
}

p {
    margin-bottom: 1.5em;
}
</style>
