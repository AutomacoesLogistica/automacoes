<?php

$nome  = $_POST['nome'];
$idade = $_POST['idade'];

echo json_encode("Meu nome e: ".$nome."<br>"."Minha idade e: ".$idade);
        ?>