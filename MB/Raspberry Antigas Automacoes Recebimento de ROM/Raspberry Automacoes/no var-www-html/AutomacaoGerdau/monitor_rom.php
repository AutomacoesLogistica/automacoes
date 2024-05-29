<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<?php
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = date('d/m/Y');
$hora_agora = date('H:i:s');
$msg_info = $data_hoje . " - " . $hora_agora;
$sigla = '--';
$placa = '--';
$valor_semaforo_entrada = '';
$valor_semaforo_saida = '';
//Busco o turno
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s'); 
$turno1 = '';
$turno2 = '';
$turno3 = '';
$turno_atual = '';
$v_turno = 0;


//Busco se existe placa e sigla
include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM rom WHERE id='1'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $sigla = $dados['sigla'];
 $placa = $dados['placa'];
 $valor_semaforo_entrada = $dados['semaforo_entrada'];
 $valor_semaforo_saida = $dados['semaforo_saida'];
}

if($sigla == '' || $placa == '')
{
  $sigla = '--';
  $placa = '--';
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE rom SET sigla='$sigla',placa='$placa' WHERE id='1'");

}

//Busco o turno atual
include_once 'conexao2.php';
$sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
if(mysqli_num_rows($sql)>0)
{
while($dados = $sql->fetch_array())
{ 
 $turno1 = $dados['turno1'];
 $turno2 = $dados['turno2'];
 $turno3 = $dados['turno3'];
}
}

$valor_hora = explode(':',$hora);
$valor_hora = $valor_hora[0];
if(intval($valor_hora)>=0 && intval($valor_hora)<8)
{
  //Turno 1
  $turno_atual = $turno1;  
  $v_turno = 1;
}
else if(intval($valor_hora)>=8 && intval($valor_hora)<17)
{
  //Turno 2
  $turno_atual = $turno2;  
  $v_turno = 2;
}
else if(intval($valor_hora)>=17 && intval($valor_hora)<23)
{
  //Turno 3
  $turno_atual = $turno3;  
  $v_turno = 3;
}
else{
    //erro
    $turno_atual = '-';
}






//CODIGO PARA RECEBER OS DADOS VIA LORA DA PLACA DO ROM ID 04 E SALVA OS DADOS NO PHP PARA ATUALIZAR A TELA
// BANCO DE DADOS: bd_display_mb tabela rom
$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";
$id = isset($_GET['id'])?$_GET['id']:"vazio";

if($mensagem != "" and ( $id == '04' || (($id=='05' or $id=='06'))) and ($mensagem=='saida'||$mensagem=='saida_ccl')) // ID = 04 por se tratar somente da cancela de entrada do ROM que tem a automa??o SVA x GSCS
{
 //echo $mensagem;
 if($mensagem == 'saida')
 {
  //Decrementa numero de veículos dentro do pátio
  if( ($id=='05' or $id=='06')and $mensagem=='saida') 
  {
   if($id=='05')
   {
    //Salva no banco que saiu alguem
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Saiu do ROM - Saida Normal',placa='--',data='$data',hora='$hora'");
    //Envia para o banco efetuar o acionamento
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='05', comando='pulso'");

  


   }
   if($id=='06')
   {
    //Salva no banco que saiu alguem
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Saiu do ROM - Saida Alternativa',placa='--',data='$data',hora='$hora'");
    //Envia para o banco efetuar o acionamento
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='06', comando='pulso'");

 

   }
  } // Fecha se mensagem = 'saida'
 } // Fecha se mensagem saida geral
 else if($mensagem == 'saida_ccl')
 {
  //Decrementa numero de veiculos dentro do pátio
  if( ($id=='05' or $id=='06')and $mensagem=='saida_ccl') 
  {
   if($id=='05')
   {
    //Salva no banco que saiu alguem
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Saiu do ROM - Saida Normal - MANUAL',placa='--',data='$data',hora='$hora'");
    //Envia para o banco efetuar o acionamento
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='05', comando='pulso'");
    
    //Agora atualizo no sistema a saida automatica
    //Busco o valor
     $man_saida = 0;
     $t_saida = 0;
     include_once 'conexao2.php';
     $sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $man_saida = intval($dados['man_saida'])+1;
      $t_saida = intval($dados['t_saida'])+1;
     }  
     include_once 'conexao2.php';
     $sql = $dbcon->query("UPDATE resumo_rom SET man_saida='$man_saida',t_saida='$t_saida' WHERE data='$data'");

   }
   if($id=='06')
   {
    //Salva no banco que saiu alguem
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Saiu do ROM - Saida Alternativa - MANUAL',placa='--',data='$data',hora='$hora'"); 
    //Envia para o banco efetuar o acionamento
    include_once 'conexao2.php';
    $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='06', comando='pulso'");
    //Agora atualizo no sistema a saida automatica
    //Busco o valor
     $man_saida_alt = 0;
     $t_saida = 0;
     include_once 'conexao2.php';
     $sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $man_saida_alt = intval($dados['man_saida_alt'])+1;
      $t_saida = intval($dados['t_saida'])+1;
     }  
     include_once 'conexao2.php';
     $sql = $dbcon->query("UPDATE resumo_rom SET man_saida_alt='$man_saida_alt',t_saida='$t_saida' WHERE data='$data'");

   }
  } // fecha if mensagem == 'saida_ccl'
 } // Fecha if mensagem saida ccl geral
 include_once 'conexao2.php';
 $sql = $dbcon->query("SELECT * FROM acessos WHERE id=1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $dentro = $dados['dentro']; // busco o valor que esta agora
  } // fecha o while
 }// fecha o if
 //Atualiza o valor
 $dentro = $dentro -1; // Tira um pois saiu um do patio
 if($dentro <0){$dentro = 0;}
 if ($dentro ==""){$dentro = 0;}
 $sql = $dbcon->query("UPDATE acessos SET dentro='$dentro' WHERE id=1"); // atualiza no banco o numero de veiculos
 //AGORA VERIFICA SE NAO TEM NGM AGUARDANDO PARA ENTRAR EM CASO DE PATIO CHEIO
 include_once 'conexao2.php';
 $sql = $dbcon->query("SELECT * FROM tela_acesso_rom WHERE id=1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $verifica = $dados['mensagem']; // busca se tem alguem aguardando para entrar no patio!
  } // fecha o while
 }// fecha o if
 if ($verifica == 'P_OK')
 {
  // Atualiza que pode entrar
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='OK' WHERE id=1"); 
  //Pode entrar pois tem espaço no patio
  $foto = 3;
  echo$msg_info."</BR>";
  echo"</BR>";
  $SVA = "--";
  $GSCS = "--";
  $info = $msg_info. "</BR>AUTORIZADO A ENTRADA!</BR>Aguardando o caminhão sair do sensor!";
  echo"SVA = ";
  echo $SVA;
  echo"</BR>";
  echo "GSCS = ";
  echo $GSCS;
  echo"</BR>";
  echo $info;
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='verde' WHERE id=1");
  //Envia para o banco efetuar o acionamento
  //include_once 'conexao2.php';
  //$sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='manter'");
  //Abre pra quem esta esperando entrar
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='manter'");
 
 
 } // Fecha mensagem $verifica == P_OK
} // Fecha if geral if mensagem != '' ........

if( ($id=='05' or $id=='06' or $id=='04')and $mensagem=='outro') //**********************************************************************************************************************
{
 if($id=='05')
 {
  //Salva no banco que saiu alguem
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Saiu do ROM - Saida Normal - MANUAL',placa='--',data='$data',hora='$hora'");
  //Envia para o banco efetuar o acionamento
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='05', comando='pulso'");
 }
 if($id=='06')
 {
  //Salva no banco que saiu alguem
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Saiu do ROM - Saida Alternativa - MANUAL',placa='--',data='$data',hora='$hora'");
  //Envia para o banco efetuar o acionamento
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='06', comando='pulso'");
 }
 if($id=='04')
 {
  //Salva no banco que saiu alguem
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Entrando no ROM - Entrada Principal - MANUAL',placa='--',data='$data',hora='$hora'");
  //Envia para o banco efetuar o acionamento
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='pulso'");
 }
} // Fecha se mensagem == outro ***************************************************************************************************************************


if($mensagem == "vmcnas")// validado porem n�o esta na frente do sensor, possivelmente uma falha dele
{
 //ACIONAR O CCL POIS EXISTE ALGUM ERRO NO SISTEMA ( ESGOTOU O TEMPO DE VALIDACAO SVA E GSCS N ATUOU! )
 $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='N_OK' WHERE id=1"); // Coloca a tela em erro
}

if($mensagem == "esgotou")// validado SVA mas GSCS nao, acionar o ccl
{
 //ACIONAR O CCL POIS EXISTE ALGUM ERRO NO SISTEMA ( ESGOTOU O TEMPO DE VALIDACAO SVA E GSCS N ATUOU! )
 $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='N_OK' WHERE id=1"); // Coloca a tela em erro
}

if($mensagem == "limpar")
{
 //VOLTAR PARA A MENSAGEM DE INICIO PARA RECEBER O PROXIMO MOTORISTA
 $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='INI' WHERE id=1");
 $foto = 0;
 $SVA = "--";
 $GSCS = "--";
 $info = "Aguardando chegar caminhão! - ".$msg_info;
 
 echo"SVA = ";
 echo $SVA;
 echo"</BR>";
 echo "GSCS = ";
 echo $GSCS;
 echo"</BR>";
 echo $info;
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS',placa = '--',sigla='--', info='$info', foto='$foto',semaforo_entrada='verde',semaforo_saida='vermelho' WHERE id=1");
} // Fecha mensagem == limpar

if($mensagem == "sva=ok")
{
 $foto = 1;
 $SVA = "OK";
 $GSCS = "--";
 $info = $msg_info."</BR>Aguardando validar GSCS!</BR>Mostre o cartão!";
 echo$msg_info."</BR>";
 echo"SVA = ";
 echo $SVA;
 echo"</BR>";
 echo "GSCS = ";
 echo $GSCS;
 echo"</BR>";
 echo $info;
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='vermelho' WHERE id=1");
 
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='ALE' WHERE id=1"); // Coloca a tela em mensagem mostrar o cartao
 
} // Fecha mensagem == sva=ok


if($mensagem == "1GSCS" && $valor_semaforo_entrada == "vermelho" && $valor_semaforo_saida == "vermelho") // Aciona erro pois acendeu o semaforo VERMELHO GSCS
{
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='NOK' WHERE id=1"); // Coloca a tela em erro
 $foto = 05;
 $SVA = "--";
 $GSCS = "NAO";
 $info = "ATENÇÃO!</BR>Existe algum erro no processo do GSCS!</BR>Descarga não autorizada!</BR></BR>Favor acionar o CCL!";
 echo$msg_info."</BR>";
 echo"SVA = ";
 echo $SVA;
 echo"</BR>";
 echo "GSCS = ";
 echo $GSCS;
 echo"</BR>";
 echo $info;
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='vermelho' WHERE id=1");
} // Fecha mensagem == GSCS

if($mensagem == "sva=nao,gscs=ok") // Ja aciona o erro pois validou apenas GSCS
{
 //ACIONAR O CCL POIS EXISTE ALGUM ERRO NO SISTEMA ( DEIXOU DE VALIDAR PELA SVA! )
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='NOK2' WHERE id=1"); // Coloca a tela em erro
 $foto = 06;
 $SVA = "--";
 $GSCS = "OK";
 $info = "ATENÇÃO!</BR>Validado apenas GSCS!</BR>Descarga não autorizada!</BR></BR>Favor acionar o CCl para verificar a câmera!";
 echo$msg_info."</BR>";
 echo"SVA = ";
 echo $SVA;
 echo"</BR>";
 echo "GSCS = ";
 echo $GSCS;
 echo"</BR>";
 echo $info;
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='vermelho' WHERE id=1");

 //Agora busca o ultimo evento nao tratado no banco do portal sva e cria um evento para indicar que falhou
 include_once 'conexao_sva.php';
 $sql = $dbcon->query("SELECT * FROM leituras_pendentes ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
 $placa = $dados['placa'];
 $resumo_transportadora = $dados['resumo_transportadora'];
 $data_banco = $dados['data_atualizacao'];
 $hora_banco = $dados['hora_atualizacao'];
 $tratado = $dados['tratado'];
 $epc = $dados['epc'];
 $gagf = $dados['gagf'];
 $gscs = $dados['gscs'];
 $nomination = $dados['nomination'];
 $material = $dados['material'];
 $liquido = $dados['liquido'];
}
if($tratado == 'nao')
{
 //Agora insiro uma nova leitura
 include_once 'conexao_sva.php';
 $sql = $dbcon->query("INSERT INTO cheio_vazio SET tipo_evento='2', media_server_id='ms0742',detected_at='-',data_leitura='$data_banco',hora='$hora_agora',text='Não validou Entrada SVA',camera_id='ms0742-cam00',caminho='-',caminho_video='-',justificado='SIM',registro='123456',nome='USUARIO ROBO',justificativa='Validado apenas GSCS!',placa='$placa',resumo_transportadora='$resumo_transportadora',tipo='Carreta',deteccao_falsa='',epc='$epc',gagf='$gagf',gscs='$gscs',nomination='$nomination',material='$material',liquido='$liquido'");
 //Agora faço um update para n usar ele mais
 include_once 'conexao_sva.php';
 $sql = $dbcon->query("UPDATE leituras_pendentes SET tratado='sim' WHERE id='$id'");
}
else
{
 //Ja foi tratado, nao faço nada! 
}

} // Fecha mensagem == sva=nao,gscs=ok





if($mensagem == "abrir" || $mensagem == "abrir1" || $mensagem == "abrir2") // VALIDOU SVA=OK e GSCS=OK E VERIFICA SE PODE ABRIR
{
 //Salva no banco que entrou alguem
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 include_once 'conexao2.php';
 $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Entrou no ROM - Entrada Principal',placa='--',data='$data',hora='$hora'");

 
 
 if($mensagem == 'abrir')
 {
  //validado os dois sem bypass atuado
 }
 else if ($mensagem == "abrir1")
 {
  //validado os dois porem com sva bypass atuado
 }
 else if ($mensagem == "abrir2")
 {
  //atuado os dois porem com gscs bypass atuado
 }
 // Atualiza que validou os dois, porem ainda n�o abre a cancela
 $foto = 2;
 $SVA = "OK";
 $GSCS = "OK";
 $info = "Descarga liberada!</BR>Validando a entrada no pátio!";
 echo$msg_info."</BR>";
 echo"SVA = ";
 echo $SVA;
 echo"</BR>";
 echo "GSCS = ";
 echo $GSCS;
 echo"</BR>";
 echo $info;
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='vermelho' WHERE id=1");
 $resultado = 0;
 //VERIFICA SE PODE ENTRAR PELO NUMERO DA OCUPAÇÃO!
 include_once 'conexao2.php';
 $sql = $dbcon->query("SELECT * FROM acessos WHERE id=1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $valor = $dados['limite']; 
   $dentro = $dados['dentro'];
  } // fecha o while
 }// fecha o if
 $resultado = ($valor  - $dentro);
 //echo $resultado;
 if($resultado >0 ) // PODE ACESSAR O PATIO **********************************************************************************************
 {
  //echo("Pode entrar");
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='OK' WHERE id=1");
  //Envia para o banco efetuar o acionamento
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='manter'");
  //Pode entrar pois tem espaço no patio
  $foto = 3;
  echo$msg_info."</BR>";
  echo"</BR>";
  $SVA = "--";
  $GSCS = "--";
  $info = $msg_info."</BR>AUTORIZADO A ENTRADA!</BR>Aguardando o caminhão sair do sensor!";
  echo"SVA = ";
  echo $SVA;
  echo"</BR>";
  echo "GSCS = ";
  echo $GSCS;
  echo"</BR>";
  echo $info;
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='verde' WHERE id=1");
 }
 else // VALIDOU MAS PRECISA ESPERAR TER VAGA NO PATIO ***************************************************************
 {
  //echo("Nao pode entrar mas validou, tem q aguardar a liberaço de espaco!");
  $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='P_OK' WHERE id=1");
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  //Pode entrar pois tem espaço no patio
  $foto = 2;
  echo$msg_info."</BR>";
  echo"</BR>";
  $SVA = "--";
  $GSCS = "--";
  $info = $msg_info."</BR>AGUARDANDO LIBERAR ESPAÇO NO PÁTIO!</BR>Aguarde por favor!";
  echo"SVA = ";
  echo $SVA;
  echo"</BR>";
  echo "GSCS = ";
  echo $GSCS;
  echo"</BR>";
  echo $info;
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='vermelho' WHERE id=1");
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
 }
} // fecha mensagem sva=0k,gscs=ok

if($mensagem == "manter") // ABERTO PELO CCL
{
 echo"entrou";
 //Salva no banco que entrou alguem
 date_default_timezone_set('America/Sao_Paulo');
 $data = date('d/m/Y');
 $hora = date('H:i:s');
 include_once 'conexao2.php';
 $sql = $dbcon->query("INSERT INTO historico_rom SET acao='Entrou no ROM - Entrada Principal - MANUAL',placa='--',data='$data',hora='$hora'");
 
     //Agora atualizo no sistema a saida automatica
     //Busco o valor
     $man_entrada = 0;
     $t_entrada = 0;
     include_once 'conexao2.php';
     $sql = $dbcon->query("SELECT * FROM resumo_rom WHERE data='$data'");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $man_entrada = intval($dados['man_entrada'])+1;
      $t_entrada = intval($dados['t_entrada'])+1;
     }  
     include_once 'conexao2.php';
     $sql = $dbcon->query("UPDATE resumo_rom SET man_entrada='$man_entrada',t_entrada='$t_entrada' WHERE data='$data'");



 // Atualiza que validou os dois, porem ainda n�o abre a cancela
 $foto = 2;
 $SVA = "CCL";
 $GSCS = "CCL";
 $info = "Descarga liberada pelo CCL!</BR>Validando a entrada no pátio!";
 echo$msg_info."</BR>";
 echo"SVA = ";
 echo $SVA;
 echo"</BR>";
 echo "GSCS = ";
 echo $GSCS;
 echo"</BR>";
 echo $info;
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='vermelho' WHERE id=1");
 $resultado = 0;
 //VERIFICA SE PODE ENTRAR PELO NUMERO DA OCUPAÇÃO!
 include_once 'conexao2.php';
 $sql = $dbcon->query("SELECT * FROM acessos WHERE id=1");
 if(mysqli_num_rows($sql)>0)
 {
  while($dados = $sql->fetch_array())
  {
   $valor = $dados['limite']; 
   $dentro = $dados['dentro'];
  } // fecha o while
 }// fecha o if
 $resultado = ($valor  - $dentro);
 echo $resultado;
 if($resultado >0 ) // PODE ACESSAR O PATIO **********************************************************************************************
 {
  //echo("Pode entrar");
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='OK' WHERE id=1");
  //Envia para o banco efetuar o acionamento
  include_once 'conexao2.php';
  $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='manter'");
  //Pode entrar pois tem espa�o no patio
  $foto = 3;
  echo$msg_info."</BR>";
  echo"</BR>";
  $SVA = "--";
  $GSCS = "--";
  $info = $msg_info."</BR>AUTORIZADO A ENTRADA VIA CCL!</BR>Aguardando o caminhão sair do sensor!";
  echo"SVA = ";
  echo $SVA;
  echo"</BR>";
  echo "GSCS = ";
  echo $GSCS;
  echo"</BR>";
  echo $info;
  include_once 'conexao2.php';
  $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='vermelho',semaforo_saida='verde' WHERE id=1");
 }
 else // VALIDOU MAS PRECISA ESPERAR TER VAGA NO PATIO ***************************************************************
 {
  //echo("Nao pode entrar mas validou, tem q aguardar a liberaço de espaco!");
  $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='P_OK' WHERE id=1");
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
  // falta criar a imagem de liberado mas mantendo cancela fechada!
 }

// EM TESTES PARA NORMALIZAR A CANCELA CASO SEJA DADO COMANDO VIA CCL
 // HABILITA UMA ESPERA DE 30 SEGUNDOS
 echo str_pad('',4096)."\n";    // Habilita delay na pagina
 ob_flush(); // Habilita delay na pagina
 flush();// Habilita delay na pagina
 sleep(30); // Delay de 30 segundos
 ob_end_flush(); // Finaliza o delay na pagina

//RODA O PADRAO PARA LIMPAR A TELA
 for ($i = 0; $i<2; $i++)
 {
  if ($i==0)
  {
   //VOLTAR PARA A MENSAGEM DE INICIO PARA RECEBER O PROXIMO MOTORISTA
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='INI' WHERE id=1"); 
   //Envia para o banco efetuar o acionamento
   include_once 'conexao2.php';
   $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='normalizar'");
   $foto = 4;
   $SVA = "--";
   $GSCS = "--";
   $info = "Normalizado a cancela!";
   echo$msg_info."</BR>";
   echo"SVA = ";
   echo $SVA;
   echo"</BR>";
   echo "GSCS = ";
   echo $GSCS;
   echo"</BR>";
   echo $info;
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='verde',semaforo_saida='vermelho', data_atualizacao='$data_hoje', hora_atualizacao='$hora_agora' WHERE id=1");

  }
  if ($i == 1)
  {
   
   echo"</BR>";
   $foto = 0;
   $SVA = "--";
   $GSCS = "--";
   $info = "Aguardando chegar caminhão! ".$msg_info;
   echo"SVA = ";
   echo $SVA;
   echo"</BR>";
   echo "GSCS = ";
   echo $GSCS;
   echo"</BR>";
   echo $info;
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info',placa = '--',sigla='--', foto='$foto',semaforo_entrada='verde',semaforo_saida='vermelho' WHERE id=1");
  }
  echo str_pad('',4096)."\n";    // Habilita delay na pagina
  ob_flush(); // Habilita delay na pagina
  flush();// Habilita delay na pagina
  sleep(30); // Delay de 30 segundos
 }
 ob_end_flush(); // Finaliza o delay na pagina





} // fecha mensagem manter



if($mensagem == "normalizado2")
{
 for ($i = 0; $i<2; $i++)
 {
  if ($i==0)
  {
   //VOLTAR PARA A MENSAGEM DE INICIO PARA RECEBER O PROXIMO MOTORISTA
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='INI' WHERE id=1"); 
   //Envia para o banco efetuar o acionamento
   include_once 'conexao2.php';
   $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='normalizar'");
   $foto = 4;
   $SVA = "--";
   $GSCS = "--";
   $info = "Normalizado a cancela!";
   echo$msg_info."</BR>";
   echo"SVA = ";
   echo $SVA;
   echo"</BR>";
   echo "GSCS = ";
   echo $GSCS;
   echo"</BR>";
   echo $info;
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='verde',semaforo_saida='vermelho', data_atualizacao='$data_hoje', hora_atualizacao='$hora_agora' WHERE id=1");

  }
  if ($i == 1)
  {
   
   echo"</BR>";
   $foto = 0;
   $SVA = "--";
   $GSCS = "--";
   $info = "Aguardando chegar caminhão! ".$msg_info;
   echo"SVA = ";
   echo $SVA;
   echo"</BR>";
   echo "GSCS = ";
   echo $GSCS;
   echo"</BR>";
   echo $info;
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',placa = '--',sigla='--',semaforo_entrada='verde',semaforo_saida='vermelho' WHERE id=1");
  }
  echo str_pad('',4096)."\n";    // Habilita delay na pagina
  ob_flush(); // Habilita delay na pagina
  flush();// Habilita delay na pagina
  sleep(2); // Delay de 2 segundos
 }
 ob_end_flush(); // Finaliza o delay na pagina
} // Fecha if se mensagem == normalizado2



if($mensagem == "normalizou") // Saiu da frente do sensor e a cancela ja esta aberta!
{ 
 for ($i = 0; $i<2; $i++)
 {
  if ($i==0)
  {
   //VOLTAR PARA A MENSAGEM DE INICIO PARA RECEBER O PROXIMO MOTORISTA
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE tela_acesso_rom SET mensagem='INI' WHERE id=1"); 
   //ATUALIZA A LISTA SOMANDO UM QUE ENTROU
   include_once 'conexao2.php';
   $sql = $dbcon->query("SELECT * FROM acessos WHERE id=1");
   if(mysqli_num_rows($sql)>0)
   {
    while($dados = $sql->fetch_array())
    {
     $dentro = $dados['dentro']; // busco o valor que esta agora
    } // fecha o while
   }// fecha o if
   //Envia para o banco efetuar o acionamento
   include_once 'conexao2.php';
   $sql = $dbcon->query("INSERT INTO acionamentos_cancelas_rom SET id_cancela='04', comando='normalizar'");
   //Atualiza o valor
   $dentro = $dentro +1; // Soma um pois entrou um no patio
   if($dentro <0){$dentro = 0;}
   if($dentro >20){$dentro = 20;}
   if($dentro ==""){$dentro = 0;}
   $sql = $dbcon->query("UPDATE acessos SET dentro='$dentro' WHERE id=1"); // atualiza no banco o numero de veiculos
   $foto = 4;
   $SVA = "--";
   $GSCS = "--";
   $info = "Normalizado a cancela!";
   echo$msg_info."</BR>";
   echo"SVA = ";
   echo $SVA;
   echo"</BR>";
   echo "GSCS = ";
   echo $GSCS;
   echo"</BR>";
   echo $info;
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',semaforo_entrada='verde',semaforo_saida='vermelho', data_atualizacao='$data_hoje', hora_atualizacao='$hora_agora' WHERE id=1");

  }
  if ($i == 1)
  {
   echo$msg_info."</BR>";
   echo"</BR>";
   $foto = 0;
   $SVA = "--";
   $GSCS = "--";
   $info = "Aguardando chegar caminhão! ".$msg_info;
   echo"SVA = ";
   echo $SVA;
   echo"</BR>";
   echo "GSCS = ";
   echo $GSCS;
   echo"</BR>";
   echo $info;
   include_once 'conexao2.php';
   $sql = $dbcon->query("UPDATE rom SET msg_sva='$SVA', msg_gscs='$GSCS', info='$info', foto='$foto',placa = '--',sigla='--',semaforo_entrada='verde',semaforo_saida='vermelho' WHERE id=1");
  }
  echo str_pad('',4096)."\n";    // Habilita delay na pagina
  ob_flush(); // Habilita delay na pagina
  flush();// Habilita delay na pagina
  sleep(2); // Delay de 2 segundos
 }
 ob_end_flush(); // Finaliza o delay na pagina
} // Fecha if se mensagem == normalizou
else if($mensagem == "sensor_semaforo")
{
 echo 'ok';
 include_once 'conexao2.php';
 $sql = $dbcon->query("UPDATE rom SET semaforo_entrada='vermelho' WHERE id=1");
 mysqli_close();
 //Falta fazer validacoes para entrada
}
else
{
    echo 'vazio';
}
?>
</body>
</html>