<?php
 
 
// Conecta no banco de dados

include 'conexao.php';
$sql = $dbcon->query("SELECT * FROM lista_excesso_mb WHERE INTO OUTFILE '/var/lib/mysql-files/orders.csv' FIELDS TERMINATED BY ','ENCLOSED BY '"'LINES TERMINATED BY '\n' ");
 
?>