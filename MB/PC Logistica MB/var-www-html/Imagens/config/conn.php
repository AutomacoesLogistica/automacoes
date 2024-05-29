<?php

// Informações para conexão
$host = 'localhost';
$usuario = 'root';
$senha = '268300';
$banco = 'imagens_devmedia';
$dsn = "mysql:host={$host};port=3306;dbname={$banco}";

try 
{
    // Conectando
    $pdo = new PDO($dsn, $usuario, $senha);
} 
catch (PDOException $e) 
{
    // Se ocorrer algum erro na conexão
    die($e->getMessage());
}