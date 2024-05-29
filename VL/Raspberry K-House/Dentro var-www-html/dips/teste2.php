<?php

include_once 'conexao_dashboard.php';
$sql = $dbcon->query("UPDATE lista_turno_dashboard SET ttp_dia='1' WHERE id='1'");  

?>