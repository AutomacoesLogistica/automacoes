<?php
$id  = isset($_GET['tabela'])?$_GET['id']:"vazio";
$tabela  = isset($_GET['tabela'])?$_GET['tabela']:"vazio";

$encontrado= 0;
$comando_especial = "";

if($tabela != "vazio" && $id != "vazio")
{
    include_once 'conexao_portal_gestao.php';
    $sql = $dbcon->query("SELECT * FROM $tabela WHERE (id='$id') LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
    $dados = $sql->fetch_array();
    $comando_especial = $dados['comando_especial'];
    $ip = $dados['ip'];
    $radius = $dados['radius'];
    $encontrado = 1;
    }    
        
}

if($encontrado == 0)
{
 // Sem dados
 $mensagem_json = "vazio;vazio";
 echo json_encode($mensagem_json);
}
else
{
 $mensagem_json =  $comando_especial ;
}

 echo json_encode($mensagem_json.";".$ip.";".$radius);

?>
