<?php
$id  = $_GET['id'];
$tabela  = $_GET['tabela'];

/*
echo "Procurando da tabela " . $tabela;
echo "</BR>";
echo "O ID : " . $id;
echo "</BR>";echo "</BR>";
*/


include_once 'conexao_portal_gestao.php';
$encontrado = 0;
$ultimo_encontrado = 0;
$mensagem_json = "";
//Crio os arrays para receber os dados

$sql = $dbcon->query("SELECT * FROM $tabela WHERE id='$id'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
 $nome_rede = $dados['nome'];
 $ip = $dados['ip'];
 $gateway = $dados['gateway'];
 $mascara = $dados['mascara'];
 $modelo = $dados['modelo'];
 $tipo = $dados['tipo'];
 $informacao_adicional = $dados['informacao_adicional'];
 $ativo = $dados['ativo'];
 $status = $dados['status'];
 $usuario = $dados['usuario'];
 $senha = $dados['senha'];
 $disponivel = $dados['disponivel'];
 $editado_por = $dados['editado_por'];
 $data = $dados['data'];
 $hora = $dados['hora'];
 $encontrado = 1;
}



if($encontrado == 0)
{
 // Sem dados
 $mensagem_json = "-99;vazio";
 echo ($mensagem_json);
}
else
{
 //Encontrou equipamentos
 //Faço o for relacionado a quantidade encontrada
 $mensagem_json =$id . ',' . $nome_rede . ',' . $ip  . ',' . $gateway  . ',' . $mascara . ',' . $modelo .',' .$tipo . ',' . $informacao_adicional  . ',' . $ativo . ',' . $status  .','. $usuario  .','.  $senha  .','. $disponivel  .','.  $editado_por  .','. $data  .','. $hora;
 echo ($mensagem_json);
}


 ?>
