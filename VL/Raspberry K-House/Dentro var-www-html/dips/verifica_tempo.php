<?php
error_reporting(0);
$publica = 0; // Em 1 habilita echos na web para debugar, em 0 desativa
$bloqueia_update = 0; //Em 1 habilita bloqueio de updates para duplicar valores enquanto estiver debugando, em 0 desativa e permite os UPDATES


date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$mensagem2 = explode('/',$data);
$mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
$data_agora = $mensagem2 . ' ' . $hora;  
if($publica == 1)
{
 echo($data_agora);    
 echo'</BR>';
}
$array_id_com_erro = array();
$encontrados_erro = 0;   
$array_saida = array();
$encontrados_saida = 0;
$encontrado = 0;
$array_3mais = array();
$encontrados_3mais = 0;
$array_epc_carreta_3mais = array();
$array_epc_cavalo_3mais = array();
$array_epc_carreta_saida = array();
$array_epc_cavalo_saida = array();
// Conecto no banco e busco os valores
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM dashboard ORDER BY id DESC ");
if(mysqli_num_rows($sql)>0)
{
 $encontrado = 0;
 $encontrados_saida = 0;
 $encontrados_3mais = 0;
 while($dados = $sql->fetch_array())
 { 
  $id= $dados['id'];
  $data_banco = $dados['data_leitura'];
  $hora_banco = $dados['hora_leitura'];
	$tipo = $dados['tipo'];
  $epc_carreta = $dados['epc_carreta'];
  $epc_cavalo = $dados['epc_cavalo'];
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
   if($dia>0 || $mes>0 || $ano>0)
   {
    if($publica == 1)
    {
     echo '</br>';
     echo '</br>';
     echo 'Esta com erro!';
     echo'</BR>';
    }
   }
   else
   {
    //Pode comecar a tratar
    //Trato se for saida
    if((intval($minuto)>10 || intval($hora)>0 ) && $tipo == 'Saida')
    {
     $array_saida[$encontrados_saida] = $id;
     $array_epc_cavalo_saida[$encontrados_saida] = $epc_cavalo;
     $array_epc_carreta_saida[$encontrados_saida] = $epc_carreta;
     $encontrados_saida = intval($encontrados_saida) + 1;
     $encontrado = intval($encontrado) + 1;
    }
    else if (intval($hora)>3)
    {
     $array_3mais[$encontrados_3mais] = $id;
     $array_epc_cavalo_3mais[$encontrados_3mais] = $epc_cavalo;
     $array_epc_carreta_3mais[$encontrados_3mais] = $epc_carreta;
     $encontrado = intval($encontrado) + 1;
     $encontrados_3mais = intval($encontrados_3mais) + 1;
    }     
   } // fecha else  ($dia>0 || $mes>0 || $ano>0)
  } //Fecha se pode tratar
  else
  {
   //Erro com datas no dashboard
   $array_id_com_erro[$encontrados_erro] = $id;
   $encontrados_erro = intval($encontrados_erro) + 1;
  }
 } // Fecha while
} // fecha if(mysqli_num_rows($sql)>0)

//Agora trato os dados




if($encontrado != 0)
{
 include_once 'conexao_dashboard.php';
 $tamanho_array_saida = count($array_saida);  
 $tamanho_array_3mais = count($array_3mais);  
 if($publica==1)
 {
  echo '</BR></BR>Arrays saida : ';
 }
 if($tamanho_array_saida >0)
 {
  for($i=0;$i<$tamanho_array_saida;$i++)
  {
   if($publica==1) 
   {
    echo($array_saida[$i]);
    echo',';   
   }
   //Atualizo no banco!
   include_once 'conexao_dashboard.php';
   if($bloqueia_update == 0)
   {
    $sql = $dbcon->query("DELETE FROM dashboard WHERE id='$array_saida[$i]'"); // Deleto a linha para tirar o dado da tela do dashboard
   }
   // Tem q tratar o que faz alem disso como se trata de saida!
   //verificar alertas, etc!
  }
  if($publica==1)
  {
   echo'</br>'; 
  }
 }
 for($i=0;$i<$tamanho_array_saida;$i++)
 {  
  //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
  //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
  //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
  //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
  //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
  // Agora encerra a viagem
  // Conecto no banco e busco os valores
  if($array_epc_cavalo_saida[$i]==''){$array_epc_cavalo_saida[$i] = '-';}
  if($array_epc_carreta_saida[$i]==''){$array_epc_carreta_saida[$i] = '-';} 
  if($publica==1)
  {
   echo '</BR>';
   echo 'EPC Cavalo : ' . $array_epc_cavalo_saida[$i];
   echo '</BR>';
   echo 'EPC Carreta : ' . $array_epc_carreta_saida[$i];
   echo '</BR>';
   //Agora verifico se posso inserir na lista para contar viagem desse motorista
   $encontrado1 = 0;
   $pode_salvar = 'nao';
   $epc_carreta = $array_epc_carreta_saida[$i];
   $epcs = array();
   $ultima_epc = '';
   if($epc_carreta != 'vazio')
   {
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM historico_validacoes ORDER BY id DESC LIMIT 10");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $encontrado1 = intval($encontrado1)+1;
      $v_epc = trim($dados['placa_ou_tag']);
      if($encontrado1 == 1){$ultima_epc = trim($v_epc);}
      $epcs[$encontrado1] = trim($v_epc);
     } 
    }
    if(trim($epc_carreta) != trim($ultima_epc))
    {
     if (in_array($epc_carreta, $epcs))
     { 
      //echo "Tem a tag, nao pode salvar!";
      $pode_salvar = "nao";
     }
     else
     {
      //echo ' Nao tem a tag, pode salvar!';  
      include_once 'conexao_dashboard.php';
      $pode_salvar = "sim";
     }   
    }
    else
    {
     //echo 'Igual a ultima, nao podendo ser salvo!';
     $pode_salvar = "nao";
    }
    if($pode_salvar == "sim")
    {
     //echo $epc_carreta;echo '</BR>';echo '</BR>';echo '</BR>';
     date_default_timezone_set('America/Sao_Paulo');
     $data_validacao = date('d/m/Y');
     $hora_validacao = date('H:i:s');  
       
     //Atualizo avisando que foi tratado!
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("INSERT INTO tabela_validacoes (placa_ou_tag,validado,data_validacao,hora_validacao) VALUES ('$epc_carreta','0','$data_validacao','$hora_validacao')");
    }
   } // if($epc_carreta != 'vazio')
  } //  if($publica==1)

  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM historico WHERE ( epc_cavalo = '$array_epc_cavalo_saida[$i]' AND epc_carreta='$array_epc_carreta_saida[$i]' AND v_status ='Saiu da Planta') ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $id_historico= $dados['id'];
   $valor_ponto_historico = $dados['valor_ponto'];
   $turno_historico = $dados['turno'];
   $ponto1 = $dados['ponto1'];
   $ponto2 = $dados['ponto2'];
   $ponto3 = $dados['ponto3'];
   $ponto4 = $dados['ponto4'];
   $ponto5 = $dados['ponto5'];
   $ponto6 = $dados['ponto6'];
   $ponto7 = $dados['ponto7'];
   $ponto8 = $dados['ponto8'];
   $v_data_leitura1 = $dados['data_leitura1'];
   $v_hora_leitura1 = $dados['hora_leitura1'];
   $v_data_leitura2 = $dados['data_leitura2'];
   $v_hora_leitura2 = $dados['hora_leitura2'];
   $v_data_leitura3 = $dados['data_leitura3'];
   $v_hora_leitura3 = $dados['hora_leitura3'];
   $v_data_leitura4 = $dados['data_leitura4'];
   $v_hora_leitura4 = $dados['hora_leitura4'];
   $v_data_leitura5 = $dados['data_leitura5'];
   $v_hora_leitura5 = $dados['hora_leitura5'];
   $v_data_leitura6 = $dados['data_leitura6'];
   $v_hora_leitura6 = $dados['hora_leitura6'];
   $v_data_leitura7 = $dados['data_leitura7'];
   $v_hora_leitura7 = $dados['hora_leitura7'];
   $v_data_leitura8 = $dados['data_leitura8'];
   $v_hora_leitura8 = $dados['hora_leitura8'];
   if($publica==1)
   {
    echo 'Encontrado!'; 
    echo '</br>';
    echo $id_historico;
    echo '</br>';
    echo $valor_ponto_historico;
    echo '</br>';
    echo $turno_historico;
    echo '</br>';
    echo $v_data_leitura1;
    echo '</br>'; 
   }
   if(intval($valor_ponto_historico)==1 )
   {
    $v_data_saida = $v_data_leitura1;
    $v_hora_saida = $v_hora_leitura1;
   }
   else if(intval($valor_ponto_historico)==2 )
   {
    $v_data_saida = $v_data_leitura2;
    $v_hora_saida = $v_hora_leitura2;
   }
   else if(intval($valor_ponto_historico)==3 )
   {
    $v_data_saida = $v_data_leitura3;
    $v_hora_saida = $v_hora_leitura3;
   }
   else if(intval($valor_ponto_historico)==4 )
   {
    $v_data_saida = $v_data_leitura4;
    $v_hora_saida = $v_hora_leitura4;
   }
   else if(intval($valor_ponto_historico)==5 )
   {
    $v_data_saida = $v_data_leitura5;
    $v_hora_saida = $v_hora_leitura5;
   }
   else if(intval($valor_ponto_historico)==6 )
   {
    $v_data_saida = $v_data_leitura6;
    $v_hora_saida = $v_hora_leitura6;
   }      
   else if(intval($valor_ponto_historico)==7 )
   {
    $v_data_saida = $v_data_leitura7;
    $v_hora_saida = $v_hora_leitura7;
   }     
   else if(intval($valor_ponto_historico)==8 )
   {
    $v_data_saida = $v_data_leitura8;
    $v_hora_saida = $v_hora_leitura8;
   }      
   if($id_historico !='')
   {
    if($publica==1)
    {
     echo '</br>';
     echo '</br>';
     echo 'Dados para update no historico ***************************************************';
     echo '</br>';
     echo '</br>';
    }
    $valor_ponto_historico = intval($valor_ponto_historico)+1;
    $ponto = 'ponto'. $valor_ponto_historico; 
    $data_leitura = 'data_leitura'.$valor_ponto_historico;
    $hora_leitura = 'hora_leitura'.$valor_ponto_historico;
    if($publica==1)
    {
     echo 'Valor ponto : '. $valor_ponto_historico;
     echo '</br>';
     echo 'Data Leitura : ' . $data_leitura;
     echo '</br>';
     echo 'Hora Leitura : ' . $hora_leitura;
     echo '</br>';
    }  
    if($v_data_leitura1 =='-')
    {
     //Verifico se leitura2 tem data
     if($v_data_leitura2 == '-')
     {
      //Verifico se leitura3 tem data
      if($v_data_leitura3 == '-')
      {
       // Verifico se letiura 4 tem data
       if($v_data_leitura4=='-')
       {
        // Continuo se quiser verificar, mas parei por aqui
       }
       else
       {
        $v_data_leitura1 = $v_data_leitura4; // Coloca a data 4 na data 1
       }
      }
      else
      {
       $v_data_leitura1 = $v_data_leitura3; // Coloca a data 3 na data 1
      }
     }
     else
     {
      $v_data_leitura1 = $v_data_leitura2; // Coloca a data 2 na data 1
     }
    }
    //Salvo no banco para saber que foi tratado o id no historico
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("INSERT INTO id_saida(id_historico,v_data_leitura,data_leitura,hora_leitura)VALUES('$id_historico','$v_data_leitura1','$data','$hora')");
    //Faço UPDATE nas movimentacoes
    if($v_data_leitura1 !='-')
    {
     $mensagem = explode('/',$v_data_leitura1);
     $dia_movimentacoes = $mensagem[0];
     $mes_movimentacoes = $mensagem[1];
     $ano_movimentacoes = $mensagem[2];
     if($publica==1)
     {
      echo'</BR>';
      echo 'Dados consulta ***********************';
      echo'</BR>';
      echo 'Dia : ' . $dia_movimentacoes;
      echo'</BR>';
      echo 'Mes : ' . $mes_movimentacoes;
      echo'</BR>';
      echo 'Ano : ' . $ano_movimentacoes;
      echo'</BR>';
     }
     $dia = 'v_'. intval($dia_movimentacoes);
     if($publica==1)
     {
      echo'</BR>';
      echo 'Dia consulta : '. $dia;
      echo'</BR>';
     } 
     //Agora atualizo movimentações
     //Primeiro pego o valor que esta
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM movimentacoes_2022 WHERE mes='$mes_movimentacoes' ORDER BY id ASC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      ////echo 'entrou';
      $dados = $sql->fetch_array();
      $quantidade = $dados['quantidade'];
      $quantidade_v_dia = $dados[$dia];
     }
     $quantidade = intval($quantidade) + 1;
     $quantidade_v_dia = intval($quantidade_v_dia) + 1;
     if($publica==1)
     {
      echo'</BR>';
      echo'</BR>';
      echo 'Movimentacoes **********************************************************************';
      echo '</BR>';
      echo '</BR>';
      echo 'Quantidade : '. $quantidade;
      echo '</BR>';
      echo 'Quantidade dia : '. $quantidade_v_dia;
      echo '</BR>';
     } 
     //Agora atualizo as movimentacoes
     include_once 'conexao_dashboard.php';
     if($bloqueia_update == 0)
     {
      $sql = $dbcon->query("UPDATE movimentacoes_2022 SET $dia='$quantidade_v_dia', quantidade='$quantidade' WHERE mes='$mes_movimentacoes'");
     }
     if($publica == 1)
     {
      echo'Rodou atualizando movimentacoes_2022 ************************************';
     }
     $turno1 = 'X';
     $turno2 = 'X';
     $turno3 = 'X';
     $v_turno1 = 0;
     $v_turno2 = 0;
     $v_turno3 = 0;
     $ant_v_turno1 = 0;
     $ant_v_turno2 = 0;
     $ant_v_turno3 = 0;
     //Agora atualizo lista_turno_dashboard
     $sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$v_data_leitura1' ORDER BY id ASC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $turno1 = $dados['turno1'];
      $turno2 = $dados['turno2'];
      $turno3 = $dados['turno3'];
      $v_turno1 = $dados['v_turno1'];
      $v_turno2 = $dados['v_turno2'];
      $v_turno3 = $dados['v_turno3'];
      $ant_v_turno1 = $dados['ant_v_turno1'];
      $ant_v_turno2 = $dados['ant_v_turno2'];
      $ant_v_turno3 = $dados['ant_v_turno3'];
      $ant = $dados['antena'];
      $ttp_turno1 = $dados['ttp_turno1'];
      $ttp_turno2 = $dados['ttp_turno2'];
      $ttp_turno3 = $dados['ttp_turno3'];
      $ttp_dia_geral = $dados['ttp_dia'];
      if ($turno1 == $turno_historico) // turno de 0 hora
      {
       $v_turno1 = intval($v_turno1) + 1;
       $ant_v_turno1 = intval($ant_v_turno1) + 1;
       $ant = intval($ant) + 1;
      }
      else if ($turno2 == $turno_historico) // turno de 8 as 16
      {
       $v_turno2 = intval($v_turno2) + 1;
       $ant_v_turno2 = intval($ant_v_turno2) + 1;
       $ant = intval($ant) + 1;
      }
      else if ($turno3 == $turno_historico) // turno de  16 as 0
      {
       $v_turno3 = intval($v_turno3) + 1;
       $ant_v_turno3 = intval($ant_v_turno3) + 1;
       $ant = intval($ant) + 1;
      }
      include_once 'conexao_dashboard.php';
      if($bloqueia_update == 0)
      {
       $sql = $dbcon->query("UPDATE lista_turno_dashboard SET v_turno1='$v_turno1', v_turno2='$v_turno2', v_turno3='$v_turno3',ant_v_turno1='$ant_v_turno1',ant_v_turno2='$ant_v_turno2',ant_v_turno3='$ant_v_turno3',antena='$ant' WHERE data='$v_data_leitura1'");
      }
      if($publica==1)
      {
       echo ('</BR>Atualizou lista_turno_dashboard ******************************</BR>');
      }
      //Agora atualizao encerramentos
      $sql = $dbcon->query("SELECT * FROM encerramentos WHERE mes='$mes_movimentacoes' ORDER BY id ASC LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $quantidade_enc_antena = $dados['quantidade_antena'];
       $quantidade_enc_antena = intval($quantidade_enc_antena) + 1 ;
       include_once 'conexao_dashboard.php';
       if($bloqueia_update == 0)
       {
        $sql = $dbcon->query("UPDATE encerramentos SET quantidade_antena='$quantidade_enc_antena' WHERE mes='$mes_movimentacoes'");
       }
       if($publica==1)
       {
        echo '</BR>Rodou atualizando encerramentos *******************************</BR>';
       } 
      }
     }
    } // Fecha if($v_data_leitura1 !='-')
    $num_gagf = '123456'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $num_gscs = '654321'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $origem = 'Varzea do Lopes'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $destino = 'Algum Lugar'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $material = 'Algum material'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $estoque - 'Algum estoque'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $peso_bruto = '99999'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $tara = '11111'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $peso_liquido = '88888'; // Somente para ter dados, depois serao atualizados de acordo com os dados da API
    $ttp_entrada_a_saida = '0';
    $ttp_ca_a_saida = '0';
    //Pegando a data de agora para fazer a conta do ttp
    $mensagem2 = explode('/',$v_data_saida);
    $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
    $data_agora = $mensagem2 . ' ' . $v_hora_saida;  
    $v_dia_entradas_a_saidas = '0';
    $v_dia_controles_a_saidas = '0';
    //Busco os valores d v_dia
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='entradas_a_saidas'");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     $v_dia_entradas_a_saidas = $dados['v_dia'];
     $u_v_dia_entradas_a_saidas = $v_dia_entradas_a_saidas; 
    }
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='controles_a_saidas'");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     $v_dia_controles_a_saidas = $dados['v_dia'];
     $u_v_dia_controles_a_saidas = $v_dia_controles_a_saidas;
    }
    //Agora calcula os dados para o ttp
    if(($ponto1 == 'Entrada CO' || $ponto1 == 'Entrada BH')&& $v_data_leitura1 != '-' && $v_hora_leitura1 != '-')
    {
     if($publica==1)
     {
      echo '</BR>Entrou tratando ttp saida *****************************************</BR>';
     }
     //Pode fazer a conta do ttp_entrada_a_saida
     //Inverte o padrao da hora para efetuar o calculo
     $mensagem = explode('/',$v_data_leitura1); // data do ponto que passou na entrada co ou bh
     $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
     $horario_entrada = $mensagem . ' ' . $v_hora_leitura1;  
     //Agora calculo a diferença
     $data_inicio = new DateTime($data_agora);
     $data_fim_entrada = new DateTime($horario_entrada);
     // Resgata diferença entre as datas
     $dateInterval = $data_inicio->diff($data_fim_entrada);
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
     $v = explode('/',$v_data_leitura1);
     $dia_v = $v[0];
     $mes_v = $v[1];
     $ano_v = $v[2];
     $v = explode(':',$v_hora_leitura1);
     $hora_v = $v[0];
     $minuto_v = $v[1];
     $segundo_v = $v[2];
     $data_atualizacao = $dia_v . '/' . $mes_v . '/' . $ano_v;
     $hora_atualizacao = $hora_v . ':' . $minuto_v . ':' . $segundo_v;
     $data_hora = $data_atualizacao . ' ' . $hora_atualizacao;
     //Agora faço a conta
     if($dia == 0 && $mes == 0 && $ano == 0 && $hora <2)
     {
      $ttp_entrada_a_saida = (intval($hora)*60)+intval($minuto);
      // Agora atualizo os valores
      if ($turno1 == $turno_historico) // turno de 0 hora
      {
       $u_ttp_turno1 = $ttp_turno1;
       $ttp_turno1 = (floatval($ttp_turno1) + floatval($ttp_entrada_a_saida))/2;
       $ttp_turno1 = number_format($ttp_turno1, 1, '.', '');
       $ttp_dia = (floatval($v_dia_entradas_a_saidas) + floatval($ttp_entrada_a_saida))/2;
       $ttp_dia = number_format($ttp_dia, 1, '.', '');
       // Agora atualizo o TTP em relacao a entrada a saida
       if($turno1 == 'A')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_a='$ttp_turno1',u_v_turno_a='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else if ($turno1 == 'B')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_b='$ttp_turno1',u_v_turno_b='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas'  WHERE referencia='entradas_a_saidas'");
        }
       }
       else if ($turno1 == 'C')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_c='$ttp_turno1',u_v_turno_c='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else
       {
        //Turno D
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_d='$ttp_turno1',u_v_turno_d='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
      }
      else if ($turno2 == $turno_historico) // turno de 8 as 16
      {
       $u_ttp_turno2 = $ttp_turno2;
       $ttp_turno2 = (floatval($ttp_turno2) + floatval($ttp_entrada_a_saida))/2;
       $ttp_turno2 = number_format($ttp_turno2, 1, '.', '');
       $ttp_dia = (floatval($v_dia_entradas_a_saidas) + floatval($ttp_entrada_a_saida))/2;
       $ttp_dia = number_format($ttp_dia, 1, '.', '');
       // Agora atualizo o TTP em relacao a entrada a saida
       if($turno2 == 'A')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_a='$ttp_turno2',u_v_turno_a='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else if ($turno2 == 'B')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_b='$ttp_turno2',u_v_turno_b='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else if ($turno2 == 'C')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_c='$ttp_turno2',u_v_turno_c='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else
       {
        //Turno D
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_d='$ttp_turno2',u_v_turno_d='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }          
      }
      else if ($turno3 == $turno_historico) // turno de  16 as 0
      {
       $u_ttp_turno3 = $ttp_turno3; 
       $ttp_turno3 = (floatval($ttp_turno3) + floatval($ttp_entrada_a_saida))/2;
       $ttp_turno3 = number_format($ttp_turno3, 1, '.', '');
       $ttp_dia = (floatval($v_dia_entradas_a_saidas) + floatval($ttp_entrada_a_saida))/2;
       $ttp_dia = number_format($ttp_dia, 1, '.', '');
       // Agora atualizo o TTP em relacao a entrada a saida
       if($turno3 == 'A')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_a='$ttp_turno3',u_v_turno_a='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else if ($turno3 == 'B')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_b='$ttp_turno3',u_v_turno_b='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else if ($turno3 == 'C')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_c='$ttp_turno3',u_v_turno_c='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }
       else
       {
        //Turno D
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_d='$ttp_turno3',u_v_turno_d='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_entradas_a_saidas' WHERE referencia='entradas_a_saidas'");
        }
       }          
      } // fecha turno 3
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("INSERT INTO ttp_entrada_a_saida(id_historico,ttp,dia,mes,ano,data_entrada,hora_entrada,data_saida,hora_saida,data_hora,turno)VALUES('$id_historico','$ttp_entrada_a_saida','$dia_v','$mes_v','$ano_v','$data_atualizacao','$hora_atualizacao','$v_data_saida','$v_hora_saida','$data_hora','$turno_historico')");
     }
    } // Fecha if que trata ttp entradas

    if( ($ponto2 == 'Controle 1' || $ponto2 == 'Controle 2' || $ponto2 == 'Controle 3') && $v_data_leitura2 != '-'  && $v_hora_leitura2 != '-')
    {
     if($publica==1)
     {
      echo '</BR>Entrou tratando ttp entradas ***********************************</BR';
     }
     //Pode fazer a conta do ttp_ca_a_saida
     //Inverte o padrao da hora para efetuar o calculo
     $mensagem = explode('/',$v_data_leitura2); // data do ponto que passou na entrada co ou bh
     $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
     $horario_ca = $mensagem . ' ' . $v_hora_leitura2;  
     //Agora calculo a diferença
     $data_inicio = new DateTime($data_agora);
     $data_fim_ca = new DateTime($horario_ca);
     // Resgata diferença entre as datas
     $dateInterval = $data_inicio->diff($data_fim_ca);
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
     $v = explode('/',$v_data_leitura2);
     $dia_v = $v[0];
     $mes_v = $v[1];
     $ano_v = $v[2];
     $v = explode(':',$v_hora_leitura2);
     $hora_v = $v[0];
     $minuto_v = $v[1];
     $segundo_v = $v[2];
     $data_atualizacao = $dia_v . '/' . $mes_v . '/' . $ano_v;
     $hora_atualizacao = $hora_v . ':' . $minuto_v . ':' . $segundo_v;
     $data_hora = $data_atualizacao . ' ' . $hora_atualizacao;
     //Agora faço a conta
     if($dia == 0 && $mes == 0 && $ano == 0 && $hora <2 )
     {
      $ttp_ca_a_saida = (intval($hora)*60)+intval($minuto);
      // Agora atualizo os valores
      if ($turno1 == $turno_historico) // turno de 0 hora
      {
       $u_ttp_turno1 = $ttp_turno1; 
       $ttp_turno1 = (floatval($ttp_turno1) + floatval($ttp_ca_a_saida))/2;
       $ttp_turno1 = number_format($ttp_turno1, 1, '.', '');
       $ttp_dia = (floatval($v_dia_controles_a_saidas) + floatval($ttp_ca_a_saida))/2;
       $ttp_dia = number_format($ttp_dia, 1, '.', '');
       $ttp_dia_geral = (floatval($ttp_dia_geral) + floatval($ttp_ca_a_saida))/2;
       $ttp_dia_geral = number_format($ttp_dia_geral, 1, '.', '');
       // Agora atualizo o TTP em relacao a entrada a saida
       if($turno1 == 'A')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_a='$ttp_turno1',u_v_turno_a='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else if ($turno1 == 'B')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_b='$ttp_turno1',u_v_turno_b='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else if ($turno1 == 'C')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_c='$ttp_turno1',u_v_turno_c='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else
       {
        //Turno D
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_d='$ttp_turno1',u_v_turno_d='$u_ttp_turno1',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
      }
      else if ($turno2 == $turno_historico) // turno de 8 as 16
      {
       $u_ttp_turno2 = $ttp_turno2; 
       $ttp_turno2 = (floatval($ttp_turno2) + floatval($ttp_ca_a_saida))/2;
       $ttp_turno2 = number_format($ttp_turno2, 1, '.', '');
       $ttp_dia = (floatval($v_dia_controles_a_saidas) + floatval($ttp_ca_a_saida))/2;
       $ttp_dia = number_format($ttp_dia, 1, '.', '');
       $ttp_dia_geral = (floatval($ttp_dia_geral) + floatval($ttp_ca_a_saida))/2;
       $ttp_dia_geral = number_format($ttp_dia_geral, 1, '.', '');
       // Agora atualizo o TTP em relacao a entrada a saida
       if($turno2 == 'A')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_a='$ttp_turno2',u_v_turno_a='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else if ($turno2 == 'B')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_b='$ttp_turno2',u_v_turno_b='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else if ($turno2 == 'C')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_c='$ttp_turno2',u_v_turno_c='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else
       {
        //Turno D
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_d='$ttp_turno2',u_v_turno_d='$u_ttp_turno2',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }          
      }
      else if ($turno3 == $turno_historico) // turno de  16 as 0
      {
       $u_ttp_turno3 = $ttp_turno3;  
       $ttp_turno3 = (floatval($ttp_turno3) + floatval($ttp_ca_a_saida))/2;
       $ttp_turno3 = number_format($ttp_turno3, 1, '.', '');
       $ttp_dia = (floatval($v_dia_controles_a_saidas) + floatval($ttp_ca_a_saida))/2;
       $ttp_dia = number_format($ttp_dia, 1, '.', '');
       $ttp_dia_geral = (floatval($ttp_dia_geral) + floatval($ttp_ca_a_saida))/2;
       $ttp_dia_geral = number_format($ttp_dia_geral, 1, '.', '');
       // Agora atualizo o TTP em relacao a entrada a saida
       if($turno3 == 'A')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_a='$ttp_turno3',u_v_turno_a='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else if ($turno3 == 'B')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_b='$ttp_turno3',u_v_turno_b='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else if ($turno3 == 'C')
       {
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_c='$ttp_turno3',u_v_turno_c='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }
       else
       {
        //Turno D
        include_once 'conexao_dashboard.php';
        if($bloqueia_update==0)
        {
         $sql = $dbcon->query("UPDATE tempo_medio SET v_turno_d='$ttp_turno3',u_v_turno_d='$u_ttp_turno3',v_dia='$ttp_dia',u_v_dia='$u_v_dia_controles_a_saidas' WHERE referencia='controles_a_saidas'");
        }
       }          
      } // fecha turno 3
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("INSERT INTO ttp_ca_a_saida(id_historico,ttp,dia,mes,ano,data_ca,hora_ca,data_saida,hora_saida,data_hora,turno)VALUES('$id_historico','$ttp_ca_a_saida','$dia_v','$mes_v','$ano_v','$data_atualizacao','$hora_atualizacao','$v_data_saida','$v_hora_saida','$data_hora','$turno_historico')");
     }
    }  //Fecha if que trata ttp dos controles
    
    
    
    //Agora salvo os dados de complemento do historico
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("INSERT INTO historico_complemento(id_historico,num_gagf,num_gscs,origem,destino,material,estoque,peso_bruto,tara,peso_liquido,ttp_entrada_a_saida,ttp_ca_a_saida,turno)VALUES('$id_historico','$num_gagf','$num_gscs','$origem','$destino','$material','$estoque','$peso_bruto','$tara','$peso_liquido','$ttp_entrada_a_saida','$ttp_ca_a_saida','$turno_historico')");
    if($publica==1)
    {
     echo('</BR>Atualizou historico_complemento ***********************************</BR>');
    }
   } // Fecha if($id_historico !='')
  }
  else //Nao achou na pesquisa dentro do historico tratando saida!
  {
   if($publica==1)
   {
    echo('</BR>Não achou historico **********************************************</BR>');
   }
   $array_epc_cavalo_saida[$i];
   $array_epc_carreta_saida[$i];
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $hora = date('H:i:s');
   //Agora insiro no banco para tratar depois
   include_once 'conexao_dashboard.php';
   $sql = $dbcon->query("INSERT INTO erros_saida(epc_cavalo,epc_carreta,data_leitura,hora_leitura)VALUES('$array_epc_cavalo_saida[$i]','$array_epc_carreta_saida[$i]','$data','$hora')");
  }
 } // Fecho o  for($i=0;$i<$tamanho_array_saida;$i++)
 
 if($publica==1)
 {
  echo'</br>';
  echo 'Arrays 3Mais : </BR>';
  //LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   
  //LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   
  //LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   
  //LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   
  //LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   LIMPANDO DASHBOARD   
 }
 for($i=0;$i<$tamanho_array_3mais;$i++)
 {
  if($publica==1)
  {
   echo($array_3mais[$i]);
   echo',';
   echo'</br>';
  }
  //Atualizo no banco!
  $id_historico = ''; //Limpo por seguranca!
  include_once 'conexao_dashboard.php';
  if($bloqueia_update==0)
  {
   $sql = $dbcon->query("DELETE FROM dashboard WHERE id='$array_3mais[$i]'"); // Deleto a linha para tirar o dado da tela do dashboard
  }
 }
 //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
 //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
 //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
 //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
 //ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB    ENCERRANDO VIAGENS JOB
 if($publica==1)
 {
  echo'</BR>Agora encerra a viagem por JOB ************************************* </BR>';
 }
 // Conecto no banco e busco os valores
 for($i=0;$i<$tamanho_array_3mais;$i++)
 {  
  if($array_epc_cavalo_3mais[$i]==''){$array_epc_cavalo_3mais[$i] = '-';}
  if($array_epc_carreta_3mais[$i]==''){$array_epc_carreta_3mais[$i] = '-';} 
  if($publica==1)
  {
   echo 'EPC Cavalo : ' . $array_epc_cavalo_3mais[$i];
   echo '</BR>';
   echo 'EPC Carreta : ' . $array_epc_carreta_3mais[$i];
   echo '</BR>';
  }
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("SELECT * FROM historico WHERE ( epc_cavalo = '$array_epc_cavalo_3mais[$i]' AND epc_carreta='$array_epc_carreta_3mais[$i]' AND v_status !='Saiu da Planta') ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $id_historico= $dados['id'];
   $valor_ponto_historico = $dados['valor_ponto'];
   $turno_historico = $dados['turno'];
   $v_data_leitura1 = $dados['data_leitura1'];
   $v_data_leitura2 = $dados['data_leitura2'];
   $v_data_leitura3 = $dados['data_leitura3'];
   $v_data_leitura4 = $dados['data_leitura4'];
   if($publica==1)
   {
    echo 'Encontrado!'; 
    echo '</br>';
    echo $id_historico;
    echo '</br>';
    echo $valor_ponto_historico;
    echo '</br>';
    echo $turno_historico;
    echo '</br>';
    echo $v_data_leitura1;
    echo '</br>'; 
   }
   if($id_historico !='')
   {
    if($publica==1)
    { 
     echo '</br>';
     echo '</br>';
     echo 'Dados para update no historico ***************************************************';
     echo '</br>';
     echo '</br>';
    }
    $valor_ponto_historico = intval($valor_ponto_historico)+1;
    $ponto = 'ponto'. $valor_ponto_historico; 
    $data_leitura = 'data_leitura'.$valor_ponto_historico;
    $hora_leitura = 'hora_leitura'.$valor_ponto_historico;
    $status_historico = 'Saiu da Planta';
    $encerrado_historico = 'JOB';
    if($publica==1)
    {
     echo 'Valor ponto : '. $valor_ponto_historico;
     echo '</br>';
     echo 'Data Leitura : ' . $data_leitura;
     echo '</br>';
     echo 'Hora Leitura : ' . $hora_leitura;
     echo '</br>';
    }  
    //Faço UPDATE no historico
    include_once 'conexao_dashboard.php';
    if($bloqueia_update==0)
    {
     $sql = $dbcon->query("UPDATE historico SET v_status='$status_historico', encerrado_por='$encerrado_historico', valor_ponto = '$valor_ponto_historico', $ponto='Saida CO', $data_leitura='-', $hora_leitura='-' WHERE id='$id_historico'");
    }
    if($publica==1)
    {
     echo('</BR>Atualizou historico *************************************</BR>');
    }
    if($v_data_leitura1 =='-')
    {
     //Verifico se leitura2 tem data
     if($v_data_leitura2 == '-')
     {
      //Verifico se leitura3 tem data
      if($v_data_leitura3 == '-')
      {
       // Verifico se letiura 4 tem data
       if($v_data_leitura4=='-')
       {
        // Continuo se quiser verificar, mas parei por aqui
       }
       else
       {
        $v_data_leitura1 = $v_data_leitura4; // Coloca a data 4 na data 1
       }
      }
      else
      {
       $v_data_leitura1 = $v_data_leitura3; // Coloca a data 3 na data 1
      }
     }
     else
     {
      $v_data_leitura1 = $v_data_leitura2; // Coloca a data 2 na data 1
     }
    }
    //Salvo no banco para saber que foi tratado o id no historico
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("INSERT INTO id_3mais(id_historico,v_data_leitura,data_leitura,hora_leitura)VALUES('$id_historico','$v_data_leitura1','$data','$hora')");
    //Faço UPDATE nas movimentacoes
    if($v_data_leitura1 !='-')
    {
     $mensagem = explode('/',$v_data_leitura1);
     $dia_movimentacoes = $mensagem[0];
     $mes_movimentacoes = $mensagem[1];
     $ano_movimentacoes = $mensagem[2];
     if($publica==1)
     {
      echo'</BR>';
      echo 'Dados consulta ***********************';
      echo'</BR>';
      echo 'Dia : ' . $dia_movimentacoes;
      echo'</BR>';
      echo 'Mes : ' . $mes_movimentacoes;
      echo'</BR>';
      echo 'Ano : ' . $ano_movimentacoes;
      echo'</BR>';
     }
     $dia = 'v_'. intval($dia_movimentacoes);
     if($publica==1)
     {
      echo 'Dia consulta : '. $dia;
      echo'</BR>';
     }
     //Agora atualizo movimentações
     //Primeiro pego o valor que esta
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM movimentacoes_2022 WHERE mes='$mes_movimentacoes' ORDER BY id ASC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $quantidade = $dados['quantidade'];
      $quantidade_v_dia = $dados[$dia];
     }
     $quantidade = intval($quantidade) + 1;
     $quantidade_v_dia = intval($quantidade_v_dia) + 1;
     if($publica==1)
     {
      echo'</BR>';
      echo'</BR>';
      echo 'Movimentacoes **********************************************************************';
      echo '</BR>';
      echo '</BR>';
      echo 'Quantidade : '. $quantidade;
      echo '</BR>';
      echo 'Quantidade dia : '. $quantidade_v_dia;
      echo '</BR>';
     }
     //Agora atualizo as movimentacoes
     include_once 'conexao_dashboard.php';
     if($bloqueia_update==0)
     {
      $sql = $dbcon->query("UPDATE movimentacoes_2022 SET $dia='$quantidade_v_dia', quantidade='$quantidade' WHERE mes='$mes_movimentacoes'");
     }
     if($publica==1)
     {
      echo('Agora atualizo movimentacoes_2022');
     }
     //Agora atualizo lista_turno_dashboard
     $sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$v_data_leitura1' ORDER BY id ASC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $turno1 = $dados['turno1'];
      $turno2 = $dados['turno2'];
      $turno3 = $dados['turno3'];
      $v_turno1 = $dados['v_turno1'];
      $v_turno2 = $dados['v_turno2'];
      $v_turno3 = $dados['v_turno3'];
      $job_v_turno1 = $dados['job_v_turno1'];
      $job_v_turno2 = $dados['job_v_turno2'];
      $job_v_turno3 = $dados['job_v_turno3'];
      $job = $dados['job'];
      $antena = $dados['antena'];
      if ($turno1 == $turno_historico)
      {
       $v_turno1 = intval($v_turno1) + 1;
       $job_v_turno1 = intval($job_v_turno1) + 1;
       $job = intval($job) + 1;
      }
      else if ($turno2 == $turno_historico)
      {
       $v_turno2 = intval($v_turno2) + 1;
       $job_v_turno2 = intval($job_v_turno2) + 1;
       $job = intval($job) + 1;
      }
      else if ($turno3 == $turno_historico)
      {
       $v_turno3 = intval($v_turno3) + 1;
       $job_v_turno3 = intval($job_v_turno3) + 1;
       $job = intval($job) + 1;
      }
      include_once 'conexao_dashboard.php';
      if($bloqueia_update==0)
      {
       $sql = $dbcon->query("UPDATE lista_turno_dashboard SET v_turno1='$v_turno1', v_turno2='$v_turno2', v_turno3='$v_turno3',job_v_turno1='$job_v_turno1',job_v_turno2='$job_v_turno2',job_v_turno3='$job_v_turno3',job='$job' WHERE data='$v_data_leitura1'");
      }
      if($publica==1)
      {
      echo('Agora atualizo lista_turno_dashboard');
      }
      //Agora atualizao encerramentos
      $sql = $dbcon->query("SELECT * FROM encerramentos WHERE mes='$mes_movimentacoes' ORDER BY id ASC LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $quantidade_enc_job = $dados['quantidade_job'];
       $quantidade_enc_job = intval($quantidade_enc_job) + 1 ;
       include_once 'conexao_dashboard.php';
       if($bloqueia_update==0)
       {
        $sql = $dbcon->query("UPDATE encerramentos SET quantidade_job='$quantidade_enc_job' WHERE mes='$mes_movimentacoes'");
       }
       if($publica==1)
       {
        echo('Agora atualizo encerramentos');
       }
      }
     } // Fecha if mysql>0
    } // Fecha if($v_data_leitura1 !='-')
   } // Fecha if($id_historico !='')
  }//
  else //Nao achou no banco de dados do historico 3mais
  {  
   $array_epc_cavalo_3mais[$i];
   $array_epc_carreta_3mais[$i];
   date_default_timezone_set('America/Sao_Paulo');
   $data = date('d/m/Y');
   $hora = date('H:i:s');
   //Agora insiro no banco para tratar depois
   include_once 'conexao_dashboard.php';
   $sql = $dbcon->query("INSERT INTO erros_3mais(epc_cavalo,epc_carreta,data_leitura,hora_leitura)VALUES('$array_epc_cavalo_3mais[$i]','$array_epc_carreta_3mais[$i]','$data','$hora')");
  }
 } //Fecha o for
} // Fecha if($encontrado != 0)



if($encontrados_erro !=0)
{
 if($publica==1)
 {
  echo '</br>';
  echo 'Ids com erro na tabela dashboard';
  echo '</br>';
 }
 $tamanho_array_id_erro = count($array_id_com_erro);
 for($i=0;$i<$tamanho_array_id_erro;$i++)
 {
  if($publica==1)
  {
   echo($array_id_com_erro[$i]);
   echo',';
   echo'</br>';
  } 
  //Atualizo esses com a hora de agora
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("UPDATE dashboard SET data_leitura='$data', hora_leitura='$hora' WHERE id='$array_id_com_erro[$i]'");
 }
} // Fecha if($encontrados_erro !=0)
if($encontrado!=0)
{
 $msg_saida = '';
 for($i=0;$i<$encontrados_3mais;$i++)
 {
  $msg_saida = $msg_saida . $array_3mais[$i].',';
 }
 if($bloqueia_update==0)
 {
  echo json_encode($msg_saida);
 }
}
else
{
 if($bloqueia_update==0)
 { 
  echo json_encode($encontrado);
 }
}
?>