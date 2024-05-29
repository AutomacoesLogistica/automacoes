<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Páginas Simultâneas</title>
<style>
    .iframe-container {
        float: left;
        width: 50%;
        height: 100vh; /* altura total da tela */
    }
    iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
</style>
</head>
<body>
<div class="iframe-container">
    <iframe src="http://138.0.77.80:7053/vnc.html?host=138.0.77.80&port=7053/"  title="Página 1"></iframe>
</div>
<div class="iframe-container">
    <iframe src="http://138.0.77.80:7052/vnc.html?host=138.0.77.80&port=7052/" title="Página 1"></iframe>
</div>
</body>
</html>