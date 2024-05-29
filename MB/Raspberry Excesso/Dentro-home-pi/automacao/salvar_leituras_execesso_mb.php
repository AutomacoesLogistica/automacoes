<?php
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO

include_once 'conexao.php';
$id = 'DEFAULT';
$data = $_GET['data'];
$hora = $_GET['hora'];
$epc = $_GET['epc'];
$antena = $_GET['antena'];
$tipo = $_GET['tipo'];
$local_instalacao = "Miguel Burnier";
$ca = "KA16005925";
$localidade = "MB";
$funcao = "Excesso MB";
$operador = "Nao definido";

$mes = (substr($data,3,2)); // extrai o mes atual
$ano = (substr($data,6,4)); // extrai o ano atual

#Salvando os dados dentro do banco de dados ************************************************************************************************
$sql3 = $dbcon->query("INSERT INTO lista_leitura_tags_mb(ca,data,hora,epc,antena,funcao,placa,localidade,operador)VALUES('$ca','$data','$hora','$epc','$antena','$funcao','-','$localidade', '$operador')");

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

 $sq4 = $dbcon->query("SELECT * FROM lista_excesso_mb WHERE epc='$epc' AND data='$data'");
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
   $sql5 = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','-','$data','$mes','$ano' ,'$hora','$localidade','$local_instalacao','$ca', '$turno','$operador')");
  }
 } // Fecha se encontrou registo e tratou para ver se tem mais de 60min
 else // Ja salva pois nao existe no banco de dados
 {
  $sql5 = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','-','$data','$mes','$ano','$hora','$localidade','$local_instalacao', '$ca', '$turno','$operador')");
 } 
} // Fecha se é carreta e salva dentro do excesso

?>
