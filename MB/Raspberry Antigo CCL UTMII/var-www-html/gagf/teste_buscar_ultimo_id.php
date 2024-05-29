<?php
include "conexao.php";
$ultimo_id = 0;
$sql = $dbcon->query("SELECT * FROM pbt_mb ORDER BY id DESC");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $ultimo_id= ($dados['id']); // busco a ultimo id
}

echo $ultimo_id;



?>