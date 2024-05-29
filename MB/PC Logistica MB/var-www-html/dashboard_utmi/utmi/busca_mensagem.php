<?php
$condicao = isset($_GET['condicao'])?$_GET['condicao']:"vazio";
$valor_passado = isset($_GET['valor'])?$_GET['valor']:"vazio";


if($condicao == "ccc")
{
 echo "Erro;Erro;-1";
}
else
{

include_once 'conexao_tela_pires.php';
$sql = $dbcon->query("SELECT * FROM mensagens_pires ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $limite_id = $dados['id'];
 
}// fecha o if

include_once 'conexao_tela_pires.php';
$sql = $dbcon->query("SELECT * FROM tela_pires LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id_mensagem_atual = $dados['id_mensagem'];
 $mensagem_atual = $dados['mensagem'];
}// fecha o if

/*
echo "ID Mensagem atual - " . $id_mensagem_atual;
echo "</BR>";
echo "Mensagem atual - " . $mensagem_atual;
echo "</BR>";
echo "Limite de ID = " . $limite_id;
echo "</BR>";
echo "Condicao = " . $condicao;
echo "</BR>";
echo "Valor passado = " . $valor_passado;
echo "</BR>";
echo "</BR>";
*/


if($condicao == 'cima')
{
 $valor_passado = intval($valor_passado)-1;
 if(intval($valor_passado)==0)
 {
  echo "Limite inferior!;cima;1;".$limite_id;
 }
 else
 {

  if( intval($valor_passado) < intval($limite_id) )
  {
   //echo "Novo valor de ID para consulta é = " . $valor_passado;
   //echo "</BR>";
   include_once 'conexao_tela_pires.php';
   $sql = $dbcon->query("SELECT * FROM mensagens_pires WHERE id='$valor_passado'");
   if(mysqli_num_rows($sql)>0)
   {
    $dados = $sql->fetch_array();
    $nova_mensagem = $dados['mensagem'];
    echo $nova_mensagem.";cima;".$valor_passado.';'.$limite_id;
   }// fecha o if
  }
  else
  {
   echo "Erro, numero superior as mensagens encontradas!;cima;".$limite_id.';'.$limite_id;
  }
 } 
} // Fecha o cima
else
{
 // Abre o baixo!
 $valor_passado = intval($valor_passado)+1;
 if(intval($valor_passado)>$limite_id)
 {
  echo "Limite superior!;baixo;".$limite_id.';'.$limite_id;
 }
 else
 {

  if( intval($valor_passado) <= intval($limite_id) )
  {
   //echo "Novo valor de ID para consulta é = " . $valor_passado;
   //echo "</BR>";
   include_once 'conexao_tela_pires.php';
   $sql = $dbcon->query("SELECT * FROM mensagens_pires WHERE id='$valor_passado'");
   if(mysqli_num_rows($sql)>0)
   {
    $dados = $sql->fetch_array();
    $nova_mensagem = $dados['mensagem'];
    echo $nova_mensagem.";baixo;".$valor_passado.';'.$limite_id;
   }// fecha o if
  }
  
 } 
}



}
?>

