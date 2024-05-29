<?php
$ponto  = $_GET['ponto'];


include_once 'conexao_portal_gestao.php';
$encontrado = 0;
$ultimo_encontrado = 0;
$mensagem_json = "";
//Crio os arrays para receber os dados
$array_id = array();
$array_nome_rede = array();
$array_ip = array();
$array_id_externo = array();
$array_caminho_backup = array();
$array_caminho_foto_equipamento = array();
$array_caminho_foto_instalacao = array();
$array_condicao = array();



$sql = $dbcon->query("SELECT * FROM tabela_equipamentos WHERE ponto='$ponto'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  
  $id = $dados['id'];
  $nome_rede = $dados['nome_rede'];
  $ip = $dados['ip'];
  $ip_externo = $dados['ip_externo'];
  $caminho_backup = $dados['caminho_backup'];
  $caminho_foto_equipamento = $dados['caminho_foto_equipamento'];
  $caminho_foto_instalacao = $dados['caminho_foto_instalacao'];
  $condicao = $dados['condicao'];



  //Agora salvo dentro dos arrays
  $array_id[$encontrado] = $id;
  $array_nome_rede[$encontrado] = $nome_rede;
  $array_ip[$encontrado] = $ip;
  $array_id_externo[$encontrado] = $ip_externo;
  $array_caminho_backup[$encontrado] = $caminho_backup;
  $array_caminho_foto_equipamento[$encontrado] = $caminho_foto_equipamento;
  $array_caminho_foto_instalacao[$encontrado] = $caminho_foto_instalacao;
  $array_condicao[$encontrado] = $condicao;

  //Agora atribuo 1 para pular a posicao de memoria no array e tambem informar quantos elementos foram encontrados
  $encontrado = intval($encontrado)+1; 
  $ultimo_encontrado = $encontrado; 
 } 
}



if($encontrado == 0)
{
 // Sem dados
 $mensagem_json = "-99;vazio";
 echo json_encode($mensagem_json);
}
else
{
 //Encontrou equipamentos
 //Faço o for relacionado a quantidade encontrada
 for ($x = 0; $x < $encontrado; $x++) 
 {
   if($x == 0)
   {
    $mensagem_json = $encontrado . ';' . $array_id[$x] . ',' . $array_nome_rede[$x] . ',' . $array_ip[$x] . ',' . $array_id_externo[$x] .',' .$array_caminho_backup[$x]  . ',' . $array_caminho_foto_equipamento[$x] . ',' . $array_caminho_foto_instalacao[$x]  .','. $array_condicao[$x]  .';';
   }
   else
   {
    if( $x>0 && $x != ( $ultimo_encontrado -1 ))
    {
      $mensagem_json = $mensagem_json . $array_id[$x] . ',' . $array_nome_rede[$x] . ',' . $array_ip[$x] . ',' . $array_id_externo[$x] .',' .$array_caminho_backup[$x]  . ',' . $array_caminho_foto_equipamento[$x] . ',' . $array_caminho_foto_instalacao[$x]  .','. $array_condicao[$x]  . ';';
    }
    else if($x == ($ultimo_encontrado-1) )
    {
        $mensagem_json = $mensagem_json . $array_id[$x] . ',' . $array_nome_rede[$x] . ',' . $array_ip[$x] . ',' . $array_id_externo[$x] .',' .$array_caminho_backup[$x]  . ',' . $array_caminho_foto_equipamento[$x] . ',' . $array_caminho_foto_instalacao[$x]  .','. $array_condicao[$x]       ;  
    }
   }
 }

 echo json_encode($mensagem_json);

}


 ?>
