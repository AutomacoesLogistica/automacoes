<?php
    class Zipar{
        function ziparArquivos($arquivo, $nomeZip, $caminho){
            $zip = new ZipArchive();

            if($zip->open("arquivos/".$nomeZip, ZIPARCHIVE::CREATE)!= TRUE){
                return false;
            }
            $zip->addFile($caminho.$arquivo,$arquivo);
            $zip->close();
            return true;
        }
    }


?>