<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>

<?php
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO

include_once 'conexao.php';
$id = 'DEFAULT';
$data = $_GET['data'];
$hora = $_GET['hora'];
$epc = $_GET['epc'];
$antena = $_GET['antena'];
$tipo = $_GET['tipo'];
$local_instalacao = "Varzea do Lopes";
$ca = "KA16005925";
$localidade = "XX";
$funcao = "Excesso VL";
$operador = "Nao definido";

$mes = (substr($data,3,2)); // extrai o mes atual
$ano = (substr($data,6,4)); // extrai o ano atual

$placa = '-';
$transportadora = '-';
$sigla = '-';


//BUSCO A PLACA CASO EXISTA
include_once 'conexao.php';
$sq5 = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc'");
if(mysqli_num_rows($sq5)>0)
{ 
 while($dados = $sq5->fetch_array())
 {
  //ENCONTRADA
  $placa = $dados['placa'];
  $localidade = $dados['estado'];
  $transportadora = $dados['nome'];
 } // Fecha while
} // Fecha if

if($placa == '-')
{
 $placa = 'Não encontrada!';
 $localidade = 'XX';
 $transportadora = 'Não identificada!';
 $sigla = 'Não identificada!';
}
else
{
 //BUSCO A SIGLA
 include_once 'conexao.php';
 $sq6 = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadora'");
 if(mysqli_num_rows($sq6)>0)
 { 
  while($dados = $sq6->fetch_array())
  {
   //ENCONTRADA
   $sigla = $dados['sigla'];
  } // Fecha while
 } // Fecha if
}// Fecha else

#Salvando os dados dentro do banco de dados ************************************************************************************************
$sql3 = $dbcon->query("INSERT INTO lista_leitura_tags_vl(ca,data,hora,epc,antena,funcao,placa,localidade,sigla,operador)VALUES('$ca','$data','$hora','$epc','$antena','$funcao','$placa','$localidade','$sigla', '$operador')");

if ($tipo == "Carreta")
{
 $resultado = intval(substr($hora,0,2)); // quebro o valor da hora para saber qual turno pertence e posteriormente buscar a letra no banco de dados
 if($resultado >= 0 && $resultado < 8) // Pertence ao primeiro turno
 {
  $valor_turno = "turno1"; // Busca na coluna 3 que equivale ao primeiro turno
 }
 if($resultado >= 8 && $resultado < 17) // Pertence ao segundo turno
 {
  $valor_turno = "turno2"; // Busca na coluna 4 que equivale ao segundo turno
 }
 if($resultado >= 17 && $resultado <=23 )
 {
  $valor_turno = "turno3"; // Busca na coluna 5 que equivale ao terceiro turno
 }
 // BUSCO O TURNO DE ACORDO COM A DATA E A HORA RECEBIDA DA LEITURA
 $sq6 = $dbcon->query("SELECT * FROM lista_turno WHERE data='$data'");
 if(mysqli_num_rows($sq6)>0)
 {
  while($dados = $sq6->fetch_array())
  {
   // Achou a data agora salva a o turno
   if($valor_turno == "turno1")
   {
    $turno = $dados['turno1']; // Busca a letra do turno
   }
   elseif($valor_turno == "turno2")
   {
    $turno = $dados['turno2']; // Busca a letra do turno
   }
   else
   {
    $turno = $dados['turno3']; // Busca a letra do turno
   }
  }// Fecha o while 
 } // Fecha o if mysqli_num_rows($sq6)>0
 $ID = 0;
 $result = 0;
 $result2 = 0;

 $sq4 = $dbcon->query("SELECT * FROM lista_excesso_vl WHERE epc='$epc' AND data='$data'");
 if(mysqli_num_rows($sq4)>0)
 { // Encontrou algum registro com tag e data igual, basta verificar se é a mais de 1 hora
  while($dados = $sq4->fetch_array())
  {
   $rest = intval(substr($dados['hora'],0,2));
   $rest_minutos = intval(substr($dados['hora'],3,2));
   $result = (intval(substr($hora,0,2)))-intval($rest);
   if($result>=1)
   {
    if($result>=2) // Garante que tem mais de 1 hora
    {
     $ID = 1;
    }
    else // Deu apenas numero 1, entra para tratar
    {
     if($result2 = (intval(substr($hora,3,2))) > (intval($rest_minutos)) ) // Trata minutos
     {
      $ID = 1; // Caso o minuto atual da leitura seja maior que o outro e a hora, dando invervalor de mais d 60min
     }
     else // Resultado não é maior que seu numero
     {
      $ID = 0;
     }
    } 
   } // fecha if result>1
   else 
   {
    $ID = 0; // Contem a mesma hora a coleta que chegou da ultima que foi salva
   }
  } //fecha while

  
  
  // Verifica se pode salvar
  if($ID == 1 )
  {
   $sql5 = $dbcon->query("INSERT INTO lista_excesso_vl(epc,placa,sigla,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$sigla','$data','$mes','$ano' ,'$hora','$localidade','$local_instalacao','$ca', '$turno','$operador')");
  }
 } // Fecha se encontrou registo e tratou para ver se tem mais de 60min
 else // Ja salva pois nao existe no banco de dados
 {
  $sql5 = $dbcon->query("INSERT INTO lista_excesso_vl(epc,placa,sigla,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$sigla','$data','$mes','$ano','$hora','$localidade','$local_instalacao', '$ca', '$turno','$operador')");
 } 
} // Fecha se é carreta e salva dentro do excesso


$veiculo ='';

$tag = substr($epc,0,6);

if($tag=='442002')
{
 $veiculo = 'carreta';
 $tag_carreta = $epc;
}
else if($tag=='442001')
{
 $veiculo = 'cavalo';
 $tag_cavalo = $epc;
}
else
{
 $veiculo = '';
}





$encontrados_dashboard = 0;
$encontrados_historico = 0;
$id_banco_dashboard = 0;
$id_banco_historico = 0;
$valor_ponto = 0;

if($veiculo != '')
{



 if($veiculo == 'carreta')
 {
  // Agora conecto no banco e busco os dados
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_carreta='$tag_carreta' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   { 
    $id_banco_dashboard = $dados['id'];
    $encontrados_dashboard = 1;
   }
  }
  // Agora conecto no banco historico e busco os dados
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$tag_carreta' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   { 
    $id_banco_historico = $dados['id'];
    $valor_ponto = intval($dados['valor_ponto']);
    $encontrados_historico = 1;
   }
  } // Fecho if do banco
 }//Fecha carreta
 else
 {
  // Agora conecto no banco e busco os dados
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_cavalo='$tag_cavalo' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   { 
    $id_banco_dashboard = $dados['id'];
    $encontrados_dashboard = 1;
   }
  } // Fecho if do banco
  // Agora conecto no banco historico e busco os dados
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM historico WHERE epc_cavalo='$tag_cavalo' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   { 
    $id_banco_historico = $dados['id'];
    $valor_ponto = intval($dados['valor_ponto']);
    $encontrados_historico = 1;
   }
  } // Fecho if do banco
 
 } // fecha cavalo



} // Fecha if geral
?>
</body>
</html>