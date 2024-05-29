<?php  
//error_reporting(0);
$valores_mes=["-","janeiro","fevereiro","marco","abril","maio","junho","julho","agosto","setembro","outubro","novembro","dezembro"];
$valores_bd_pbt_mb = ["-","conexao_pbt_mb_2020.php","conexao_pbt_mb_2021.php","conexao_pbt_mb_2022.php","conexao_pbt_mb_2023.php","conexao_pbt_mb_2024.php","conexao_pbt_mb_2025.php"];
$valor_mes_inteiro = "";
$valor_ano_inteiro = "";

$mes = 02;
$ano = 2020;

$valor_mes_inteiro = intval($mes); // Busca o mes da data do processo e converte para posicao do array
$valor_ano_inteiro = intval($ano)-2019; // Busca o mes da data do processo e converte para posicao do array
$conexao = $valores_bd_pbt_mb[$valor_ano_inteiro];
$tabela = $valores_mes[$valor_mes_inteiro];
  

include_once $conexao;
$sql = $dbcon->query("SELECT * FROM $tabela WHERE id_processo_gscs='123'"); // Busca se ja existe o n do processo gscs no banco
if(mysqli_num_rows($sql)>0)
{
 echo "Existe"; 
}
else // PODE SALVAR POIS NÃO EXISTE ESTE PROCESSO NO BANCO
{
 echo "nao existe";
    //$sql = $dbcon->query("INSERT INTO $tabela (data,mes,ano,hora,id_processo_gscs,placa,estado,tipo_veiculo,tara,peso_bruto,assertividade,transportadora) VALUES ('$data','$mes','$ano','$hora','$id_processo_gscs','$placa','$estado','$tipo_veiculo','$tara','$carregado','$assertividade','$transportadora')");
}



?>