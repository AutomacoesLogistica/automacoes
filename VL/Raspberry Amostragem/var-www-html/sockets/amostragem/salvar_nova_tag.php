<?php

$nova_epc = isset($_GET['nova_epc'])?$_GET['nova_epc']:'vazio';
$id = isset($_GET['id'])?$_GET['id']:'vazio';

echo "Tratando nova epc = " . $nova_epc;
echo "</BR>";

$array_epcs = [];
$tamanho = strlen($nova_epc);
$encontrado = 0;
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');

if(intval($tamanho)== 24)
{
 if($id != "vazio")
 {
  //Mudo a tag para tratada!0
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE validacoes_socket SET condicao='Tratado!',data_tratado='$data', hora_tratado='$hora' WHERE id='$id'");
 }

include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM lista_amostragem ORDER BY id DESC LIMIT 5");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $id = $dados['id'];
  $epc = $dados['epc'];
  $tratado = $dados['tratado'];
  array_push($array_epcs, $epc);
  $encontrado = intval($encontrado)+1;
 }
}// fecha o if

  echo "Encontrados = ". $encontrado;
  echo "</BR>";
  
  if(in_array($nova_epc,$array_epcs, true))
  {
    echo "nao_pode_salvar";

  }
  else
  {
    echo "pode_salvar";
    //Insiro a lista na tag para assim que iniciar as validacoes no node red comecar a valer!
    include_once 'conexao_amostragem.php';
    $sql = $dbcon->query("INSERT INTO lista_amostragem (epc,tratado)VALUES('$nova_epc','nao')");

    //Agora insiro os dados no banco do dashboard
    include_once 'conexao_amostragem.php';
    //pensando em inserir aqui!
    //$sql = $dbcon->query("INSERT INTO amostragem (epc,tratado)VALUES('$nova_epc','nao')");
  
  }
  //echo "</BR>";
  //echo "Tamanho = " . $tamanho;

} // Fecha if(intval($tamanho)== 24)
else
{
  echo "erro_tamanho_epc"  ;
}


http_response_code(200);
?>