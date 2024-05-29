<?php
error_reporting(0);
$publica = 0; // Em 1 habilita echos na web para debugar, em 0 desativa
$bloqueia_update = 0; //Em 1 habilita bloqueio de updates para duplicar valores enquanto estiver debugando, em 0 desativa e permite os UPDATES
$quantidade = 0;
$quantidade_ok = 0;
$quantidade_erro = 0;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$servico1 = 'verifica_servicos.service';
include_once 'conexao.php';
$sql = $dbcon->query("UPDATE atualizacao_services SET data_atualizacao='$data',hora_atualizacao='$hora',condicao='OK'  WHERE nome_service='$servico1'");



$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  
if($publica == 1)
{
 echo($data_agora);    
 echo'</BR>';
}
$array_id = array();
$array_condicao = array();
$encontrado = 0;

// Conecto no banco e busco os valores
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM atualizacao_services ORDER BY id ASC ");
if(mysqli_num_rows($sql)>0)
{
    echo "Iniciado" . "</BR>";  
 while($dados = $sql->fetch_array())
 { 
  $id= $dados['id'];
  $data_banco = $dados['data_atualizacao'];
  $hora_banco = $dados['hora_atualizacao'];
  $nome_servico = $dados['nome_service'];
  $tamanho_data  = intval(strlen($data_banco));
  $tamanho_hora  = intval(strlen($hora_banco));
  if($tamanho_data==10 && $tamanho_hora == 8)
  {
   //Inverte o padrao da hora para efetuar o calculo
   $mensagem = explode('/',$data_banco);
   $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
   $horario_banco = $mensagem . ' ' . $hora_banco; 
   //Agora calculo a diferença
   $data_inicio = new DateTime($data_agora);
   $data_fim = new DateTime($hora_banco);
   // Resgata diferença entre as datas
   $dateInterval = $data_inicio->diff($data_fim);
   $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
   if($publica==1)
   {
    echo $mensagem;
   }
   $mensagem1 = explode(' ',$mensagem);
   $vmensagem1 = explode('/',$mensagem1[0]);
   $dia = $vmensagem1[0];
   $mes = $vmensagem1[1];
   $ano = $vmensagem1[2];
   $mensagem = explode(':',$mensagem1[1]);
   $hora = $mensagem[0];
   $minuto = $mensagem[1];
   $segundo = $mensagem[2];
   if($publica==1)
   {
    echo("*********************************Resumo ****************************</BR>");
    echo('ID: '.$id);echo("</BR>");
    echo('Dia: '.$dia);echo("</BR>");
    echo('Mês: '.$mes);echo("</BR>");
    echo('Ano: '.$ano);echo("</BR>");
    echo('Hora: '.$hora);echo("</BR>");
    echo('Minuto: '.$minuto);echo("</BR>");
    echo('Segundo: '.$segundo);echo("</BR>");
   }
   if($minuto <10)
   {
    $array_condicao[$encontrado] = "OK";
    $quantidade_ok = intval($quantidade_ok) + 1;
   }
   else
   {
    $array_condicao[$encontrado] = "Falha";
    $quantidade_erro = intval($quantidade_erro) + 1;
   }
    $array_id[$encontrado] = $id;


  } // if($tamanho_data==10 && $tamanho_hora == 8)
  $encontrado = intval($encontrado) + 1;
 } // while($dados = $sql->fetch_array())
} // fecha if(mysqli_num_rows($sql)>0)


if($encontrado!=0)
{
 $quantidade = intval($encontrado);
 for($i=0;$i<$encontrado;$i++)
 {
  echo " ID =  " ;
  echo $array_id[$i];
  echo " - Condicao = ";
  echo $array_condicao[$i];
  echo "</BR>";
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE atualizacao_services SET condicao='$array_condicao[$i]'  WHERE id='$array_id[$i]'");
 
 }
 echo "</BR>";echo "</BR>";
 echo "Quantidade serviços = " . $quantidade;
 echo "</BR>";
 echo "Ativos = " . $quantidade_ok . " - Erros = " . $quantidade_erro;
 include_once 'conexao.php';
 $sql = $dbcon->query("UPDATE atualizacao SET quantidade_servicos='$quantidade',quantidade_ok='$quantidade_ok', quantidade_falha='$quantidade_erro'  WHERE id='1'");
}

exit(); // Fecha a pagina!
?>