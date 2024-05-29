<?php
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');  
 
 $nome_service = 'sincroniza_socket_poste_ent_bocaina.service';
 include_once "conexao_saida_automacoes.php";
 $sql = $dbcon->query("UPDATE atualizacao_services SET data_atualizacao='$data', hora_atualizacao='$hora'  WHERE nome_service='$nome_service'");


 ?>