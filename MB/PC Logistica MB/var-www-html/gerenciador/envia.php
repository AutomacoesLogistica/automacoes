<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistica</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
</head>
<body>


<?php
require_once("Zipar.class.php");
require_once("conexao.php");
//print_r($_FILES['arquivo']);
$nomedoArquivo = $_FILES['arquivo']['name'];
if(file_exists("arquivos/$nomedoArquivo.zip"))
{
  ?>  
   <div id="alerta" class="alert alert-success" role="alert">
    <h4  id='alerta2' class="alert-heading">ATENÇÃO!</h4>
    <p>O arquivo inserido já se encontra cadastrado no banco de dados!</p>
    <hr>
    <p id="alerta3" class="mb-0">Favor inserir um arquivo que não esteja salvo</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="javascript: location.href=`index.php`;">
    <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <?php
   
}
else
{
    $caminhoAtualArquivo = $_FILES['arquivo']['tmp_name'];
    //$caminhoSalvar = 'arquivos/'.$nomedoArquivo;
    $caminhoSalvar = 'arquivos/';
    if(move_uploaded_file($caminhoAtualArquivo,$caminhoSalvar.$nomedoArquivo)){
        $zip = new Zipar();
        $zip-> ziparArquivos($nomedoArquivo,$nomedoArquivo.".zip",$caminhoSalvar);
        unlink("arquivos/".$nomedoArquivo);
        $localidade = "VL";
        $nome_banco = $nomedoArquivo.".zip";
        $sql = $dbcon->query("INSERT INTO arquivos(nome,localidade)VALUES('$nome_banco','$localidade')");
        header("Location: index.php");
    }else{
        echo "Arquivo não encontrado!";
    }
}

?>


</body>

<style>
DIV#alerta{
    margin: 0px;
    padding-left: 5px;
    text-align: left;
    height: 170px;
    width: 700px;
}


</style>
</html>