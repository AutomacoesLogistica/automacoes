<?php
$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$pode_validar = 0;
if($epc == "vazio")
{
 echo "Faltando passar o parametro epc!";
}
else
{
  $encontrado = 0;
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM lidar_excesso WHERE ( epc_lidar='$epc' AND data_leitura='$data' AND condicao='Carga Descentralizada!' AND tratado ='nao'  ) ORDER BY id DESC LIMIT 1 ");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $id = $dados['id'];
   $data_banco = $dados['data_leitura'];
   $hora_banco = $dados['hora_leitura'];
   $encontrado = 1;
  }// fecha o if

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
   $mensagem1 = explode(' ',$mensagem);
   $vmensagem1 = explode('/',$mensagem1[0]);
   $dia = $vmensagem1[0];
   $mes = $vmensagem1[1];
   $ano = $vmensagem1[2];
   $mensagem = explode(':',$mensagem1[1]);
   $hora = $mensagem[0];
   $minuto = $mensagem[1];
   $segundo = $mensagem[2];
   /*
   echo("*********************************Resumo ****************************</BR>");
   echo('ID: '.$id);echo("</BR>");
   echo('Dia: '.$dia);echo("</BR>");
   echo('Mês: '.$mes);echo("</BR>");
   echo('Ano: '.$ano);echo("</BR>");
   echo('Hora: '.$hora);echo("</BR>");
   echo('Minuto: '.$minuto);echo("</BR>");
   echo('Segundo: '.$segundo);echo("</BR>");
   */
   if( intval($dia)==0 && intval($mes)==0 && intval($ano)==0 && intval($minuto)<25 && intval($hora)==0 )
   {
    $tempo_gasto = intval($minuto);
    //echo "Pode validar!";
    $pode_validar = 1;
   }
   else
   {
    //echo "Erro, nao deixo validar!";
    $pode_validar = 0;
   }
  }











  if($encontrado == 1) 
  {
   if($pode_validar == 1)
   {
    $motivo = "ROBÔ: Veiculo retornou ao pátio de excessos para validação/ajuste da carga!";
    echo "Encontrado ID = " . $id . ' e pode ser validado pois tem menos de 25 minutos!';
    date_default_timezone_set('America/Sao_Paulo');
    $v_data = date('d/m/Y');
    $v_hora = date('H:i:s');

    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE lidar_excesso SET tratado='Sim', data_tratado='$v_data',hora_tratado='$v_hora',confirmacao='Sim',tempo_confirmacao='$tempo_gasto',motivo='$motivo' WHERE ( epc_lidar='$epc' AND data_leitura='$data' AND condicao='Carga Descentralizada!' AND tratado ='nao'  ) ORDER BY id DESC LIMIT 1 ");
 
   } 
   else
   {
    echo "Encontrado ID = " . $id . ', porem não pode ser validado pois tem mais de 25 minutos!';
   }
   
  }
  else
  {
   echo "Nao localizado!"; 
  }
   

  
}
 ?>
