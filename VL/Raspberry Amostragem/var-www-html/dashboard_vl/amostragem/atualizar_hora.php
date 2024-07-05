
<?php

$status = isset($_GET['status'])?$_GET['status']:'vazio';
$nome_service = isset($_GET['nome'])?$_GET['nome']:'vazio';
$encontrado = 0;



//Busco a hora atual
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');


if($nome_service == "vazio")
{
 echo "Favor inserir um nome do serviço válido!";
}
else
{
    // Conecto no banco e busco os valores
    include_once 'conexao_amostragem.php';
    $sql = $dbcon->query("SELECT * FROM atualizacao_services WHERE nome_service='$nome_service'");
    if(mysqli_num_rows($sql)>0)
    {
    $encontrado = 1;   
    $dados = $sql->fetch_array();
    $id = $dados['id'];
    }


    if($encontrado != 0)
    {
    echo "Encontrado o serviço!";
    echo "</BR>";
    echo "O mesmo está com status " . $status . " e atualizado as " . $data . " " . $hora;
    echo "</BR>";
    echo "</BR>";

    //Agora atualizo os dados
    include_once 'conexao_amostragem.php';
    $sql = $dbcon->query("UPDATE atualizacao_services SET data_atualizacao='$data', hora_atualizacao='$hora', condicao='$status' WHERE id='$id'");
    echo "Dados atualizados com sucesso!";
    }

}


?>