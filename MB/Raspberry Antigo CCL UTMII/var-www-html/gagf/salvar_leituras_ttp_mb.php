<?php

// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 

// >>>>> TELA NAO ESTA PRONTA, FOI COPIA DA LISTA DE EXCESSO, USAR COMO REFERENCIA APENAS PARA CRAIR A TTP

// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
// ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO 
 // ATENÇÃO ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  ATENÇÃO  









// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO MB OU VL 
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO MB OU VL 
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO MB OU VL 
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO MB OU VL 
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO MB OU VL 
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO MB OU VL 
// CODIGO PARA SALVAR LEITURAS DE TAGS VINDAS POR MQTT NO TABLET DE EXCESSO MB OU VL 

include_once 'conexao.php';
$id = 'DEFAULT';
$ca = $_POST['ca'];
$data = $_POST['data'];
$mes = ""; // Inicia vazio
$ano = ""; // inicia vazio
$hora = $_POST['hora'];
$epc = $_POST['epc'];
$antena = $_POST['antena'];
$funcao = "-";
$placa = "-";
$local_instalacao = ""; // inicia vazio
$localidade = ""; //Inicia vazio
$excesso = ""; // Inicia vazio
$operador = ""; // Inicio vazio


$mes = (substr($data,3,2)); // extrai o mes atual
$ano = (substr($data,6,4)); // extrai o ano atual



#BUSCA A FUNCAO ASSOCIANDO O CA DO READER A ANTENA LIDA E BUSCA NO BANCO QUAL A FUNCAO CADASTRADA ******************************************
$sql = $dbcon->query("SELECT * FROM lista_readers WHERE ca='$ca' AND antena='$antena'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $funcao = $dados['funcao']; // Busca o Nome quando encontrar e coloca dentro do array, neste caso achar� apenas 1
  $local_instalacao = $dados['local_instalacao']; // Busca se é Miguel Burnier, VL , etc
  $excesso = $dados['excesso']; // Busca se o CA deste reader é de excesso
  $operador = $dados['operador'];
 }
}
else
{
 $funcao = "-";
 $local_instalacao = "-"; // Nada no banco e deixa o traço para nao por campos vazios no banco de dados
 $excesso = "nao"; // caso esteja no banco diferente de sim, ja marca como nao para nao salvar dentro da lista de excesso por engano
 $operador = "Nao definido"; // Ainda não cadastrado no banco ou o operador nao bateu o cartao!
}

if($operador == ""){ $operador = "Nao definido"; } // Somente para garantir caso não tenha encontrado salve para nao deixa dados em branco no banco de dados





if ($funcao != "-")
{
 #BUSCANDO A PLACA - BUSCA A PLACA DENTRO DO CADASTRO ASSOCIANDO AO NUMERO DA TAG ***********************************************************
 $sq2 = $dbcon->query("SELECT * FROM lista_tags WHERE epc='$epc'");
 if(mysqli_num_rows($sq2)>0)
 {
  while($dados = $sq2->fetch_array())
  {
   $placa = $dados['placa'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achar� apenas 1
   $localidade = $dados['localidade'];
  } // Fecha while
 }
 else
 {
  $placa = "-"; // Não encontrou a placa
  $localidade = "-"; // Não encontrou a placa nem a localidade
 }

 if ($placa !="-") // Somente se tiver encontrado a placa
 {
  #Salvando os dados dentro do banco de dados ************************************************************************************************
  $sql3 = $dbcon->query("INSERT INTO lista_leitura_tags(ca,data,hora,epc,antena,funcao,placa,localidade,operador)VALUES('$ca','$data','$hora','$epc','$antena','$funcao','$placa','$localidade', '$operador')");
 }
} // Fecha if $funcao != "-"

// AGORA FAZ A FUNCAO DA TELA SALVAR_LISTA_EXCESSO se o CA contem ' sim '  na aba excesso
if ($excesso == "sim")
{
 if($local_instalacao == "Miguel Burnier")
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
 // BUSCO O OPERADOR DA MAQUINA E O TURNO DE ACORDO COM A DATA E A HORA RECEBIDA DA LEITURA
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
}

$ID = 0;
$result = 0;
$result2 = 0;

if ($placa !="-")
{
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
   $sql5 = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$data','$mes','$ano' ,'$hora','$localidade','$local_instalacao','$ca', '$turno','$operador')");
  }
 } // Fecha se encontrou registo e tratou para ver se tem mais de 60min
 
 else // Ja salva pois nao existe no banco de dados
 {
  $sql5 = $dbcon->query("INSERT INTO lista_excesso_mb(epc,placa,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$data','$mes','$ano','$hora','$localidade','$local_instalacao', '$ca', '$turno','$operador')");
 } 
} // Fecha if de if ($placa != "-")

 }
 elseif($local_instalacao == "Várzea do Lopes")
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
 // BUSCO O OPERADOR DA MAQUINA E O TURNO DE ACORDO COM A DATA E A HORA RECEBIDA DA LEITURA
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
}

$ID = 0;
$result = 0;
$result2 = 0;

if ($placa !="-")
{
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
   $sql5 = $dbcon->query("INSERT INTO ttp_mb(epc,placa,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$data','$mes','$ano' ,'$hora','$localidade','$local_instalacao','$ca', '$turno','$operador')");
  }
 } // Fecha se encontrou registo e tratou para ver se tem mais de 60min
 
 else // Ja salva pois nao existe no banco de dados
 {
  $sql5 = $dbcon->query("INSERT INTO lista_excesso_vl(epc,placa,data,mes,ano,hora,uf,local_instalacao,ca,turno,operador)VALUES('$epc','$placa','$data','$mes','$ano','$hora','$localidade','$local_instalacao', '$ca', '$turno','$operador')");
 } 
} // Fecha if de if ($placa != "-")
 
 }


} // Fecha o if se $excesso == sim

?>
