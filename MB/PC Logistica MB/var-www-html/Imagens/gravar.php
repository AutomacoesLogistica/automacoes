<?php
 
$imagem = $_FILES["imagem"];
echo$imagem;
$host = "localhost";
$username = "root";
$password = "268300";
$db = "imagens_devmedia";
 
if($imagem != NULL) { 
    $nomeFinal = time().'.jpg';
    if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
        $tamanhoImg = filesize($nomeFinal); 
 
        $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); 
        
        $fp = fopen($imagem, "rb");
        $conteudo = fread($fp, $tamanhoImg);
        $conteudo = addslashes($conteudo);
        fclose($fp);


        $dbcon = new MySQLi("$host","$username","$password","$bd");
        if ($dbcon->connect_error){
        echo "conexao_erro";
        }else{
            echo "conectado!";
        }

        $sql = $dbcon->query("INSERT INTO pessoa (PES_ID, PES_IMG) VALUES ('1', '$conteudo')"); 
     
 
        unlink($nomeFinal);
         
        header("location:exibir.php");
    }
} 
else { 
    echo"Você não realizou o upload de forma satisfatória."; 
} 
 
?>