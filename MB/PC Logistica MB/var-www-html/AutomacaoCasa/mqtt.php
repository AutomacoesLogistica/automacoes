<?php


/* Credenciais (usuario e senha) */
$client->setCredentials('bruno','268300');
 
/* Callback da conexao */
$client->onConnect(function($code, $message) use ($client){
    /* Topico */
    $client->subscribe('dev/test/php', 1);
});
 
/* Callback da mensagem */
$client->onMessage(function($message){
    /* exibe a mensagem e payload */
    echo $message->topic, "\n", $message->payload, "\n";
});
 
/* Connecta ao host remoto */
$client->connect('192.168.2.200', 1883);
 
/* Mantem-se em execucao */
$client->loopForever();