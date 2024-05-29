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
        <img id="fundo2" src="./images/iluminacao.png" alt="" />
        <img id="lamp1" src="./images/lampadasL.png" />
        <img id="lamp2" src="./images/lampadasL.png" />
        <img id="lamp3" src="./images/lampadasL.png" />
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

/* LAMPADA DA SALA DE ESTAR */ 
#fundo img#lamp1 {
    width: 75px;
    height: 80px;
    margin-top: 4.5%;
    margin-left: 2.4%;
    position: relative;
    cursor: pointer;
}

#fundo img#lamp2 {
    width: 75px;
    height: 80px;
    margin-top: 4.5%;
    margin-left: 1.8%;
    position: relative;
    cursor: pointer;
}

#fundo img#lamp3 {
    width: 75px;
    height: 80px;
    margin-top: 4.5%;
    margin-left: 1.8%;
    position: relative;
    cursor: pointer;
}

















p {
    margin-bottom: 1.5em;
}
</style>
