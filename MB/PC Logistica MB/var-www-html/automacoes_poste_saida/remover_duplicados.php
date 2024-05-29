<?php
include_once 'conexao.php';
$sql = $dbcon->query("DELETE p1 FROM `lidar_excesso` AS p1, `lidar_excesso` AS p2 WHERE p1.`id`<p2.`id` AND p1.`epc_lidar`=p2.`epc_lidar`;");


include_once 'conexao_excesso.php';
$sql = $dbcon->query("DELETE p1 FROM `lidar_excesso` AS p1, `lidar_excesso` AS p2 WHERE p1.`id`<p2.`id` AND p1.`epc_lidar`=p2.`epc_lidar`;");


?>