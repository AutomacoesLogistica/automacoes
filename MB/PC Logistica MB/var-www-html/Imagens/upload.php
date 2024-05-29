<?php
require("conecta.php");
$nomeEvento = $_POST['nome_evento'];
$descricaoEvento = $_POST['descricao_evento'];
$imagem = $_FILES['imagem']['tmp_name'];
$tamanho = $_FILES['imagem']['size'];
$tipo = $_FILES['imagem']['type'];
$nome = $_FILES['imagem']['name'];
  
if ( $imagem != "none" )
{
    $fp = fopen($imagem, "rb");
    $conteudo = fread($fp, $tamanho);
    $conteudo = addslashes($conteudo);
    fclose($fp);
  
    
    echo$nomeEvento;
    echo"</br>";
    echo$descricaoEvento;
    echo"</br>";
    echo$nome;
    echo"</br>";
    echo$tamanho;
    echo"</br>";
   // echo$conteudo;
    echo"</br>";
    
    //$sql = $dbcon->query("INSERT INTO tabela_imagens SET (evento='$nomeEvento' , descricao='$descricaoEvento' , nome_imagem='$nome' , tamanho_imagem='$tamanho', tipo_imagem='$tipo', imagem='$conteudo'");
}
?>