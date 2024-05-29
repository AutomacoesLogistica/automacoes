<?php
date_default_timezone_set('America/Sao_Paulo');
$data_consulta = date('d/m/Y');
$hora = date('H:i:s');
$consulta = "Carga Descentralizada!";
$publica = 1;
include_once 'conexao_poste.php';
$sql = $dbcon->query("SELECT * FROM lidar_excesso WHERE (condicao = '$consulta' AND  data_leitura='$data_consulta')ORDER BY id DESC LIMIT 6");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 {
  $encontrado = intval($encontrado)+1;  
  $ultimo_id = $dados['id']; //Guardo o ultimo id do banco para saber se tem dado novo e pode atualizar
   $data_banco = $dados['data_leitura'];
   $hora_banco = $dados['hora_leitura'];
   $condicao_banco = $dados['condicao'];
   $id = $dados['id'];
   $tamanho_data  = intval(strlen($data_banco));
   $tamanho_hora  = intval(strlen($hora_banco));
   echo "</BR></BR></BR>";
   echo $id;
   echo "</BR></BR></BR>";
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
    if($dia>0 || $mes>0 || $ano>0)
    {
     if($publica == 1)
     {
      echo '</br>';
      echo '</br>';
      echo 'Esta com erro!';
      echo'</BR>';
     } // Fecha if($publica == 1)
    }// fecha if($dia>0 || $mes>0 || $ano>0)
    else
    {
     //Pode comecar a tratar
     //Trato se for saida
     if((intval($minuto)>25 || intval($hora)>0 ) && $condicao_banco == 'Carga Descentralizada!')
     {
      if($publica == 1)
      {
       echo "Tem";echo"</BR>"; echo"ID : " ; echo $id; echo"</BR>"; echo"</BR>"; 
      } //Fecha $publica == 1
     } // Fecha if((intval($minuto)>25 || intval($hora)>0 ) && $condicao_banco == 'Carga Descentralizada!')
     else
     {
      if($publica == 1)
      {
       echo "Achou porem nao tem mais do que 25 minutos!"; 
      } // Fecha $publica == 1
     } // Fecha o else if((intval($minuto)>25 || intval($hora)>0 ) && $condicao_banco == 'Carga Descentralizada!')
    } // fecha else  ($dia>0 || $mes>0 || $ano>0)
   } //Fecha if($tamanho_data==10 && $tamanho_hora == 8)

 } // Fecha while($dados = $sql->fetch_array())
} // Fecha if(mysqli_num_rows($sql)>0)
echo "</BR>";
echo $encontrado;
?>