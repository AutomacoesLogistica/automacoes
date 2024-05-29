<?php
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO

include_once 'conexao.php';
$id = 'DEFAULT';
$encontrado_lidar = 0;
//$data = $_GET['data'];
//$hora = $_GET['hora'];
$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';
$antena = isset($_GET['antena'])?$_GET['antena']:'0';
$tipo = isset($_GET['tipo'])?$_GET['tipo']:'Carreta';
$local_instalacao = "Miguel Burnier";
$ca = "KA16005925";
$localidade = "XX";
$funcao = "Excesso MB";
$operador = "Nao definido";
echo $epc;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');


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
  $transportadora = $dados['nome'];
  $localidade = $dados['estado'];
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
$sql3 = $dbcon->query("INSERT INTO lista_leitura_tags_mb(ca,data,hora,epc,antena,funcao,placa,localidade,sigla,operador)VALUES('$ca','$data','$hora','$epc','$antena','$funcao','$placa','$localidade','$sigla', '$operador')");

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
 }
  
 
  
  
  // Verifica se pode salvar
  if($ID == 1 )
  {
   $sql5 = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,sigla,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$sigla','$data','$mes','$ano' ,'$hora','$localidade','$local_instalacao','$ca', '$turno','$operador')");
   //Agora verifico se é um veiculo que precisa de confirmação para LIDAR/Carga Descentralizada!
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $hora = date('H:i:s');
   $mensagem2 = explode('/',$data);
   $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
   $data_agora = $mensagem2 . ' ' . $hora;  

   include_once 'conexao.php';
   $sql = $dbcon->query("SELECT * FROM lidar_excesso WHERE (epc_lidar='$epc' AND data_leitura='$data' AND confirmacao='nao') ORDER BY id DESC LIMIT 1");
   if(mysqli_num_rows($sql)>0)
   {
    $encontrado_lidar = 1;
    $dados = $sql->fetch_array();
    $id_lidar_excesso = $dados['id'];
    $data_banco = $dados['data_leitura'];
    $hora_banco = $dados['hora_leitura'];
    $epc_lidar = $dados['epc_lidar'];
    $id_lidar = $dados['id_lidar'];
    $id_cheio_vazio = $dados['id_cheio_vazio'];
    $id_historico = $dados['id_historico'];
    $placa = $dados['placa'];
    $veiculo = $dados['veiculo'];
    $dia = $dados['dia'];
    $mes = $dados['mes'];
    $ano = $dados['ano'];
    $condicao = $dados['condicao'];
    $tamanho_data  = intval(strlen($data_banco));
    $tamanho_hora  = intval(strlen($hora_banco));
    
   }
   if($encontrado_lidar == 1 && $tamanho_data==10 && $tamanho_hora == 8)
   {
    //Faço o calculo do tempo que demorou da leitura la no lidar ate a confirmacao aqui
    $mensagem = explode('/',$data_banco);
    $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
    $horario_banco = $mensagem . ' ' . $hora_banco; 
    //Agora calculo a diferença
    $data_inicio = new DateTime($data_agora);
    $data_fim = new DateTime($hora_banco);
    // Resgata diferença entre as datas
    $dateInterval = $data_inicio->diff($data_fim);
    $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
    $mensagem1 = explode(' ',$mensagem);
    $vmensagem1 = explode('/',$mensagem1[0]);
    $dia = $vmensagem1[0];
    $mes = $vmensagem1[1];
    $ano = $vmensagem1[2];
    $mensagem = explode(':',$mensagem1[1]);
    $hora = $mensagem[0];
    $minuto = $mensagem[1];
    $segundo = $mensagem[2];
    //Calculo a diferenca
    $tempo_gasto = (intval($hora)*60) + intval($minuto);
    

    if($tempo_gasto >60)
    {
     //Se for maior, se trata de um excesso e nao confirmação de retorno!
     //Faço UPDATE
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE lidar_excesso SET confirmacao='Sim2',tempo_confirmacao='-',data_tratado='$data',hora_tratado='$hora' WHERE id='$id_lidar_excesso'");
    
  
    }
    else
    {
     //Sendo menor que 60, se trata de uma confirmação de retorno!
     //Faço UPDATE
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE lidar_excesso SET confirmacao='Sim',tempo_confirmacao='$tempo_gasto',data_tratado='$data',hora_tratado='$hora' WHERE id='$id_lidar_excesso'"); 
    }
    
   }
  
  
 } // Fecha se encontrou registo e tratou para ver se tem mais de 60min
 else // Ja salva pois nao existe no banco de dados
 {
  $sql5 = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,sigla,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$sigla','$data','$mes','$ano','$hora','$localidade','$local_instalacao', '$ca', '$turno','$operador')");
  //Agora verifico se é um veiculo que precisa de confirmação para LIDAR/Carga Descentralizada!
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  $mensagem2 = explode('/',$data);
  $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
  $data_agora = $mensagem2 . ' ' . $hora;  

  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM lidar_excesso WHERE (epc_lidar='$epc' AND data_leitura='$data' AND confirmacao='nao') ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $encontrado_lidar = 1;
   $dados = $sql->fetch_array();
   $id_lidar_excesso = $dados['id'];
   $data_banco = $dados['data_leitura'];
   $hora_banco = $dados['hora_leitura'];
   $tamanho_data  = intval(strlen($data_banco));
   $tamanho_hora  = intval(strlen($hora_banco));
  }
  if($encontrado_lidar == 1 && $tamanho_data==10 && $tamanho_hora == 8)
  {
   //Faço o calculo do tempo que demorou da leitura la no lidar ate a confirmacao aqui
   $mensagem = explode('/',$data_banco);
   $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
   $horario_banco = $mensagem . ' ' . $hora_banco; 
   //Agora calculo a diferença
   $data_inicio = new DateTime($data_agora);
   $data_fim = new DateTime($hora_banco);
   // Resgata diferença entre as datas
   $dateInterval = $data_inicio->diff($data_fim);
   $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
   $mensagem1 = explode(' ',$mensagem);
   $vmensagem1 = explode('/',$mensagem1[0]);
   $dia = $vmensagem1[0];
   $mes = $vmensagem1[1];
   $ano = $vmensagem1[2];
   $mensagem = explode(':',$mensagem1[1]);
   $hora = $mensagem[0];
   $minuto = $mensagem[1];
   $segundo = $mensagem[2];
   //Calculo a diferenca
   $tempo_gasto = (intval($hora)*60) + intval($minuto);
   //Faço UPDATE
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $hora = date('H:i:s');
   include_once 'conexao.php';
   $sql = $dbcon->query("UPDATE lidar_excesso SET confirmacao='Sim',tempo_confirmacao='$tempo_gasto',data_tratado='$data',hora_tratado='$hora' WHERE id='$id_lidar_excesso'");
  } 
 } 
} // Fecha se é carreta e salva dentro do excesso

?>
