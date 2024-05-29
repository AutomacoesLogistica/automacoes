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
        <img id="fundo2" src="./images/canais2.png" alt="" />
        <img id="animais" src="./images/animais0.png" alt="" />
        <img id="diversos" src="./images/diversos0.png" alt="" />
        <img id="educacao" src="./images/educacao0.png" alt="" />
        <img id="esportes" src="./images/esportes0.png" alt="" />
        <img id="filmes" src="./images/filmes0.png" alt="" />
        <img id="jornalismo" src="./images/jornalismo0.png" alt="" />
        <img id="musica" src="./images/musica0.png" alt="" />

    </div>
</div>



</body>
</html>


<style>


/* para garantir que estes elementos ocuparão toda a tela */
body, html {
    margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
}

#fundo-externo {
    overflow: hidden; /* para que não tenha rolagem se a imagem de fundo for maior que a tela */
    width: 100%;
    height: 100%;
    position: relative; /* criamos um contexto para posicionamento */
}
#fundo img#fundo2 {
    width: 100%;
     height: 100%;
    position: absolute;
}


#fundo img#animais {
    background-image: url("./images/animais0.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 100px;
    margin-left: 0px;
    position: absolute; 
    display: block;  
}
#fundo img#animais:hover {
    background-image: url("./images/animais1.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 100px;
    margin-left: 0px;
    position: absolute;
    display: block; 
}
#fundo img#diversos {
    background-image: url("./images/diversos0.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 171px;
    margin-left: 0px;
    position: absolute;   
}
#fundo img#diversos:hover {
    background-image: url("./images/diversos1.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 171px;
    margin-left: 0px;
    position: absolute;   
}


#fundo img#educacao {
    background-image: url("./images/educacao0.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 242px;
    margin-left: 0px;
    position: absolute;   
}
#fundo img#educacao:hover {
    background-image: url("./images/educacao1.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 242px;
    margin-left: 0px;
    position: absolute;   
}



#fundo img#esportes {
    background-image: url("./images/esportes0.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 313px;
    margin-left: 0px;
    position: absolute;   
}
#fundo img#esportes:hover {
    background-image: url("./images/esportes1.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 313px;
    margin-left: 0px;
    position: absolute;   
}



#fundo img#filmes {
    background-image: url("./images/filmes0.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 384px;
    margin-left: 0px;
    position: absolute;   
}
#fundo img#filmes:hover {
    background-image: url("./images/filmes1.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 384px;
    margin-left: 0px;
    position: absolute;   
}

#fundo img#jornalismo {
    background-image: url("./images/jornalismo0.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 455px;
    margin-left: 0px;
    position: absolute;   
}
#fundo img#jornalismo:hover {
    background-image: url("./images/jornalismo1.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 455px;
    margin-left: 0px;
    position: absolute;   
}



#fundo img#musica {
    background-image: url("./images/musica0.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 526px;
    margin-left: 0px;
    position: absolute;   
}
#fundo img#musica:hover {
    background-image: url("./images/musica1.png");
    background-repeat: no-repeat;
    background-size: 395px 68px;
    width: 395px;
    height: 68px;
    margin-top: 526px;
    margin-left: 0px;
    position: absolute;   
}





p {
    margin-bottom: 1.5em;
}
</style>
