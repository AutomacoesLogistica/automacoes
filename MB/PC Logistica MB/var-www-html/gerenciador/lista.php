<?php


$pasta = "arquivos/";
$diretorio = dir($pasta);

while($arquivo = $diretorio->read()){
    if($arquivo != '.' && $arquivo != '..')
    {
        echo "<a href=''>" .$arquivo."</a></BR>"; 
      
    }    
}

?>