<?php
//  primeira coisa limpo os duplicados em alerta no lidar_excesso
include_once 'conexao.php';
$sql = $dbcon->query("DELETE p1 FROM `lidar_excesso` AS p1, `lidar_excesso` AS p2 WHERE p1.`id`<p2.`id` AND p1.`epc_lidar`=p2.`epc_lidar`;");
$epc_carreta ='-';

$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';
$ponto = isset($_GET['ponto'])?$_GET['ponto']:'vazio';

echo "EPC = ".$epc;
echo "</BR>";

if ( $epc != "vazio")
{
 $epc_excesso = $epc;
 

  //Agora verifico se veio um id para fazer update
  
  
  echo  $epc;
  echo '</BR>';
  $encontrado = 0;
  $ponto = '';
  $encontrado_tratado = 0;
  $nome_completo = '';
  $valor = 'epc_';
  $v1_epc = substr($epc,0,6);
  echo 'v1_epc = '.$v1_epc;
  echo '</BR>';
  $tentativa = 0;
  
  
  
  if($epc != 'vazio')
  {
  
   echo '</BR>';
   echo  'Iniciando as tratativas!';
   echo '</BR>';
  
  
   //Salvo primeiro no banco de dados historico_recebido_python para saber se o python esta rodando corretamente
   if($v1_epc == '442002')
   {
    echo '</BR>';
    echo  'EPC = '. $epc;
    echo '</BR>';
     //Verifico a sigla transportadora
     $transportadora = '-';
     include_once 'conexao.php';
     $sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc' LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array(); 
      $transportadora = $dados['nome'];
     }
     echo $transportadora; echo '</BR>';
     if($transportadora=='FJX TRANSPORTES LTDA ' || $transportadora=='FJX TRANSPORTES LTDA' || $transportadora == 'TORA TRANSPORTES LTDA ' || $transportadora == 'TORA TRANSPORTES LTDA')
     {
      echo 'Salvando!';
      //Insiro a placa na pesquisa da tora/fjx
      include_once 'conexao.php';
      $sql = $dbcon->query("INSERT INTO validacoes_feitas_tora_fjx(placa_ou_tag,validado,data_validacao,hora_validacao)VALUES('$epc','pendente','-','-')");
     }
  
  
  
  
    echo '</BR>';
    echo  'Entrando para salvar os dados recebidos do python!';
    echo '</BR>';
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    include_once 'conexao.php';
    $sql = $dbcon->query("INSERT INTO historico_recebido_python(epc,data,hora)VALUES('$epc','$data','$hora')");
   } 
   
  
   if($v1_epc == '442002')
   {
    $valor = 'epc_carreta';
    $epc_carreta = $epc;
    //AGORA VERIFICO SE ESSA TAG ELA JA FOI TRATADA
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM historico_match WHERE epc_carreta='$epc' ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array(); 
     $encontrado_tratado = 1;
     $id_match = $dados['id'];
     $tradado = $dados['tratado'];
     if($tradado == 'sim')
     {
      $encontrado_tratado = 2;//Nao faz nada pois ja foi feito!
     }
     else
     {
      $encontrado_tratado = 1;//Ja existe, tenho que atualizar que foi tratado e colocar a mensagem na saida!
     }
    }
    else
    {
      if(strlen($epc_carreta)==24 )
      {
       //Salvo essa tag no banco para tratar la!
       date_default_timezone_set('America/Sao_Paulo');
       $data = date('d/m/Y');
       $v_data = $nome_reduzido = explode("/",$data);
       $dia = $v_data[0];
       $mes = $v_data[1];
       $ano = $v_data[2];    
       $hora = date('H:i:s');
       //Foi lido aqui e falta inserir totalmente os dados! Deixou de ser lido na MG030 ou na Balanca!
       include_once 'conexao.php';
       $sql = $dbcon->query("INSERT INTO saida_automacoes(epc_carreta,data_leitura,dia,mes,ano,hora_leitura,condicao)VALUES('$epc_carreta','$data','$dia','$mes','$ano','$hora','pendente')");
      }
    }
    echo "Valor do encontrado = " . $encontrado_tratado . "</BR>";
   }// Fecha elseif($v1_epc == '442002')
  
  
  
  
  
  
  
  
  
   if($encontrado_tratado == 2 || $encontrado_tratado == -2 || $encontrado_tratado == -1)
   {
    //Nao faz nada pois ja foi feito!
    echo 'Ja tratado!';
    echo '</BR>';
    exit();
   }
   elseif($encontrado_tratado==1)
   {
    //Ja existe, tenho que atualizar que foi tratado e colocar a mensagem na saida!
    echo  'Tenho que tratar!';
    echo '</BR>';
    
    //Atualizo que esta tratando!
    include_once 'conexao.php';
    $sql = $dbcon->query("UPDATE historico_display SET condicao1='Tratando!',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_match'");
        
    //Atualizo no sistema
    $sql = $dbcon->query("UPDATE historico_match SET tratado='sim' WHERE id='$id_match'");
    //Busco se ja esta Concluido ou Saindo da Planta, caso sim, ja faço tudo local,senao, consulto via gagf
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM historico_display WHERE $valor='$epc' ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array(); 
     $id_historico_display = $dados['id'];
     $condicao2 = $dados['condicao2'];
     $nome_completo = $dados['motorista'];
     $placa_cavalo = $dados['placa_cavalo'];
     $epc_cavalo = $dados['epc_cavalo'];
     $placa_carreta = $dados['placa_carreta'];
     $ponto = $dados['ponto'];
    }
    if($placa_cavalo !='')
    {
     $placa = $placa_cavalo;
    }
    else if($placa_carreta != '')
    {
     $placa = $placa_carreta; 
    }
    else
    {
     $placa = '--'; 
    }
    
    if($epc_cavalo == '' || $epc_cavalo == ' '){$epc_cavalo = '-';}
  
    if($condicao2 == 'Concluído' || $condicao2 == 'Saindo da Planta')
    {
     echo '</BR>';
     echo  'Esta em condicao concluido, porem agora verifico se esta com carga descentralizada!' ;
     echo '</BR>';
  
     //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE historico_display SET condicao1='Concluído',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
     
     //Atualizo os dados no display_balanca1 
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE display_balanca1 SET id_historico='$id_historico_display',epc_cavalo = '$epc_cavalo',placa_cavalo='$placa_cavalo' WHERE id='1'");
     
     //Atualiza display***********************************************************************************************************************
     $nome_reduzido = explode(" ",$nome_completo);
     $nome_reduzido = strtolower($nome_reduzido[0]); // Coloca o nome todo em minusculo
     $nome_reduzido = ucfirst($nome_reduzido); // Coloca a primeira letra em maiusculo
     $nome_reduzido = '__viagem_'.$nome_reduzido.'!';
     $tamanho_nome = 0;
     $tamanho_nome= strlen($nome_reduzido);
     if($tamanho_nome != 19)
     {
      $vezes = 19-intval($tamanho_nome);
      for ($i = 0; $i<$vezes;$i++) 
      {
       $nome_reduzido = $nome_reduzido. "_";//Nao retirar esse espaco!
      }
     }
     //PRIMEIRO VERIFICO SE NAO TEM CARGA DESCENTRALIZADA!
     include_once 'conexao.php';
     $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
     {
      $dados = $sql->fetch_array(); 
      $status_api_cheio_vazio = $dados['api_cheio_vazio'];
      $id_cheio_vazio = $dados['id_cheio_vazio'];
      $api_lidar = $dados['api_lidar'];
      $alerta = $dados['alerta'];
      $alert2 = $dados['alerta2'];
      $veiculo = $dados['veiculo'];
     }
     echo '</BR>';
     echo $status_api_cheio_vazio;
     echo '</BR>';
  
     if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' )
     {
      echo '</BR>';
      echo 'Esta tudo ok!';
      echo '</BR>';
  
      //Libera semáforo saída *****************************************************************************************************************
      include_once 'conexao.php';
      $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
      $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
      //Atualizo semaforo virtual
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
      
      //**************************************************************************************************************************************
      //CALCULO O CRC DISPLAY
      $mensagem = '   Tenha uma boa   ';
      $nome_reduzido = str_replace("_"," ",$nome_reduzido);
      $mensagem2 =$nome_reduzido; //aqui ja tem os dados do motorista
      $mensagem_tratada2 = "";
      $mensagem_tratada2_2 = "";
      $mensagem_CRC="";
      $mensagem_CRC_2="";
      $tamanho = 0;
      $tamanho2 = 0;
      $tamanho_mesagem1 = 0;
      $tamanho_mesagem1= strlen($mensagem);
      $tamanho_mesagem2 = 0;
      $tamanho_mesagem2= strlen($mensagem2);
      if($tamanho_mesagem1 != 19)
      {
       $vezes = 19-intval($tamanho_mesagem1);
       for ($i = 0; $i<$vezes;$i++) 
       {
        $mensagem = $mensagem. " ";//Nao retirar esse espaco!
       }
      }
      if($tamanho_mesagem2 != 19)
      {
       $vezes2 = 19-intval($tamanho_mesagem2);
       for ($i = 0; $i<$vezes2;$i++) 
       {
        $mensagem2 = $mensagem2. " ";//Nao retirar esse espaco!
       }
      }
      for ($i = 0; $i<strlen($mensagem);$i++) 
      {
       $tamanho = $tamanho + 1;
       $str = substr($mensagem,$i,1);
       $mensagem_tratada = dechex(ord($str));  
       $mensagem_tratada2 = $mensagem_tratada2 .$mensagem_tratada . " ";
       $mensagem_CRC = $mensagem_CRC . strval($mensagem_tratada);
      }
      for ($i = 0; $i<strlen($mensagem2);$i++) 
      {
       $tamanho2 = $tamanho2 + 1;
       $str = substr($mensagem2,$i,1);
       $mensagem_tratada_2 = dechex(ord($str));  
       $mensagem_tratada2_2 = $mensagem_tratada2_2 .$mensagem_tratada_2 . " ";
       $mensagem_CRC_2 = $mensagem_CRC_2 . strval($mensagem_tratada_2);
      }
      $tamanho = dechex(ord($tamanho));
      $protocolo = "01 02 50 01 01 AA 01 01 82 01 01 00 ";// NAO TERIAR O ESPACO NO FIM
      $tamanho_mensagem = "32 ";// NAO TERIAR O ESPACO NO FIM Equivale a 50 em HEX
      $funcoes = "AA 10 AA 70 AA 01 "; // NAO TERIAR O ESPACO NO FIM 
      $funcoes2 = "AA 10 AA 70 AA 02 "; // NAO TERIAR O ESPACO NO FIM 
      $mensagem_fim = '03';
      $mensagem_completa = $protocolo . $tamanho_mensagem. $funcoes . strtoupper($mensagem_tratada2). $funcoes2. strtoupper($mensagem_tratada2_2) . $mensagem_fim;
      $mensagem_completa2 = strval(str_replace(" ","",$mensagem_completa ));
      //AGORA TRATO E CALCULO O CRC
      define('CRC16POLYN', 0x1021);
      function CRC16Normal($buffer) 
      {
       $result = 0xFFFF;
       if (($length = strlen($buffer)) > 0) 
       {
        for ($offset = 0; $offset < $length; $offset++) 
        {
         $result ^= (ord($buffer[$offset]) << 8);
         for ($bitwise = 0; $bitwise < 8; $bitwise++) 
         {
          if (($result <<= 1) & 0x10000) $result ^= CRC16POLYN;
          $result &= 0xFFFF;
         }
        }
       }
       return $result;
      }
      //Calculando o crc e tratando para uppercase
      $crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem_completa2))));
      if(strlen($crc_16_CCITT)<4){$crc_16_CCITT = '0'.$crc_16_CCITT;}
      $mensagem_display = $mensagem_completa . ' '. substr($crc_16_CCITT,0,2). ' '. substr($crc_16_CCITT,2,2);
      $mensagem_display = str_replace(' ','',$mensagem_display);
      $crc_display = $mensagem_display;
      //**************************************************************************************************************************************
      //Atualizo o display
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
      
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE historico_display SET crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
     }
     else
     {
      echo '</BR>';
      echo 'Erro - Verifico se esta vazio!';
      echo '</BR>';
  
      if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
      {
       echo '</BR>';
       echo 'Veiculo saindo vazio, considero como ok';
       echo '</BR>'; 
  
       //Atualizo o status no historico_display
       include_once 'conexao.php';
       $sql = $dbcon->query("UPDATE historico_display SET condicao1='Concluido2' WHERE id='$id_historico_display'");
       
       //Libera semáforo saída *****************************************************************************************************************
       include_once 'conexao.php';
       $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
       $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
       //Atualizo semaforo virtual
       include_once 'conexao.php';
       $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
       
           //**************************************************************************************************************************************
      //CALCULO O CRC DISPLAY
      $mensagem = '   Tenha uma boa   ';
      $nome_reduzido = str_replace("_"," ",$nome_reduzido);
      $mensagem2 =$nome_reduzido; //aqui ja tem os dados do motorista
      $mensagem_tratada2 = "";
      $mensagem_tratada2_2 = "";
      $mensagem_CRC="";
      $mensagem_CRC_2="";
      $tamanho = 0;
      $tamanho2 = 0;
      $tamanho_mesagem1 = 0;
      $tamanho_mesagem1= strlen($mensagem);
      $tamanho_mesagem2 = 0;
      $tamanho_mesagem2= strlen($mensagem2);
      if($tamanho_mesagem1 != 19)
      {
       $vezes = 19-intval($tamanho_mesagem1);
       for ($i = 0; $i<$vezes;$i++) 
       {
        $mensagem = $mensagem. " ";//Nao retirar esse espaco!
       }
      }
      if($tamanho_mesagem2 != 19)
      {
       $vezes2 = 19-intval($tamanho_mesagem2);
       for ($i = 0; $i<$vezes2;$i++) 
       {
        $mensagem2 = $mensagem2. " ";//Nao retirar esse espaco!
       }
      }
      for ($i = 0; $i<strlen($mensagem);$i++) 
      {
       $tamanho = $tamanho + 1;
       $str = substr($mensagem,$i,1);
       $mensagem_tratada = dechex(ord($str));  
       $mensagem_tratada2 = $mensagem_tratada2 .$mensagem_tratada . " ";
       $mensagem_CRC = $mensagem_CRC . strval($mensagem_tratada);
      }
      for ($i = 0; $i<strlen($mensagem2);$i++) 
      {
       $tamanho2 = $tamanho2 + 1;
       $str = substr($mensagem2,$i,1);
       $mensagem_tratada_2 = dechex(ord($str));  
       $mensagem_tratada2_2 = $mensagem_tratada2_2 .$mensagem_tratada_2 . " ";
       $mensagem_CRC_2 = $mensagem_CRC_2 . strval($mensagem_tratada_2);
      }
      $tamanho = dechex(ord($tamanho));
      $protocolo = "01 02 50 01 01 AA 01 01 82 01 01 00 ";// NAO TERIAR O ESPACO NO FIM
      $tamanho_mensagem = "32 ";// NAO TERIAR O ESPACO NO FIM Equivale a 50 em HEX
      $funcoes = "AA 10 AA 70 AA 01 "; // NAO TERIAR O ESPACO NO FIM 
      $funcoes2 = "AA 10 AA 70 AA 02 "; // NAO TERIAR O ESPACO NO FIM 
      $mensagem_fim = '03';
      $mensagem_completa = $protocolo . $tamanho_mensagem. $funcoes . strtoupper($mensagem_tratada2). $funcoes2. strtoupper($mensagem_tratada2_2) . $mensagem_fim;
      $mensagem_completa2 = strval(str_replace(" ","",$mensagem_completa ));
      //AGORA TRATO E CALCULO O CRC
      define('CRC16POLYN', 0x1021);
      function CRC16Normal($buffer) 
      {
       $result = 0xFFFF;
       if (($length = strlen($buffer)) > 0) 
       {
        for ($offset = 0; $offset < $length; $offset++) 
        {
         $result ^= (ord($buffer[$offset]) << 8);
         for ($bitwise = 0; $bitwise < 8; $bitwise++) 
         {
          if (($result <<= 1) & 0x10000) $result ^= CRC16POLYN;
          $result &= 0xFFFF;
         }
        }
       }
       return $result;
      }
      //Calculando o crc e tratando para uppercase
      $crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem_completa2))));
      if(strlen($crc_16_CCITT)<4){$crc_16_CCITT = '0'.$crc_16_CCITT;}
      $mensagem_display = $mensagem_completa . ' '. substr($crc_16_CCITT,0,2). ' '. substr($crc_16_CCITT,2,2);
      $mensagem_display = str_replace(' ','',$mensagem_display);
      $crc_display = $mensagem_display;
      //**************************************************************************************************************************************
      //Atualizo o display
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
      
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE historico_display SET crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
      }
      else
      {
        echo '</BR>';
        echo 'Esta cheio, carga descentralizada!';
        echo '</BR>'; 
        //Existe carga descentralizada!
        echo '</BR>';
        echo 'Esta tudo ok e não tem carga descentralizada!';
        echo '</BR>'; 
        //Libera semáforo saída *****************************************************************************************************************
        include_once 'conexao.php';
        $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
        $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
        
        include_once 'conexao.php';
        $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Carga___',mensagem2='_descentralizada!__',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
     
        include_once 'conexao.php';
        $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Carga   ',mensagem2=' descentralizada!  ' WHERE id='$id_historico_display'");

        $condicao = "Carga Descentralizada!";
        if($epc_excesso != 'vazio' )
        {
         if(strlen($epc_excesso)==24)
         {
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $v_data = $nome_reduzido = explode("/",$data);
          $dia = $v_data[0];
          $mes = $v_data[1];
          $ano = $v_data[2];    
          $hora = date('H:i:s');
          /*
          echo $data;echo'</BR>';
          echo $dia;echo'</BR>';
          echo $mes;echo'</BR>';
          echo $ano;echo'</BR>';
          echo $hora;echo'</BR>';
          */  
          include_once 'conexao.php';
          $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_excesso','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$condicao','nao','-','-','nao','0','-')");
          //Agora limpa na tabela
          include_once 'conexao.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET epc_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_carreta='-',api_cheio_vazio='-',api_lidar='-',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',veiculo='-' WHERE id='1'");
         }
        } 
      }
     }
    
     }// Fecha if($condicao2 == 'Concluído' || $condicao2 == 'Saindo da Planta')
     else
     {
     echo '</BR>';
     echo 'Condicao diferente de Concluidou ou saindo da planta!';
     echo '</BR>';
     //Atualizo os dados no display_balanca1 
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE display_balanca1 SET id_historico='$id_historico_display',epc_cavalo = '$epc_cavalo',placa_cavalo='$placa_cavalo' WHERE id='1'");
    
     //Tem que analisar!
     //Agora verifico por onde o veiculo passou
     if($ponto =='mg')
     {
      //Possivel desvio de carga!
      echo '</BR>';
      echo 'Passou pela MG030';
      echo '</BR>';
     }
     else
     {
      if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
      {
       //Como afirmou que esta vazio vou considerar algum erro e vou dar como liberado!
       //Libera semáforo saída *****************************************************************************************************************
       include_once 'conexao.php';
       $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
       $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
       
       //Atualizo semaforo virtual
       include_once 'conexao.php';
       $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
       
           //**************************************************************************************************************************************
      //CALCULO O CRC DISPLAY
      $mensagem = '   Tenha uma boa   ';
      $nome_reduzido = str_replace("_"," ",$nome_reduzido);
      $mensagem2 =$nome_reduzido; //aqui ja tem os dados do motorista
      $mensagem_tratada2 = "";
      $mensagem_tratada2_2 = "";
      $mensagem_CRC="";
      $mensagem_CRC_2="";
      $tamanho = 0;
      $tamanho2 = 0;
      $tamanho_mesagem1 = 0;
      $tamanho_mesagem1= strlen($mensagem);
      $tamanho_mesagem2 = 0;
      $tamanho_mesagem2= strlen($mensagem2);
      if($tamanho_mesagem1 != 19)
      {
       $vezes = 19-intval($tamanho_mesagem1);
       for ($i = 0; $i<$vezes;$i++) 
       {
        $mensagem = $mensagem. " ";//Nao retirar esse espaco!
       }
      }
      if($tamanho_mesagem2 != 19)
      {
       $vezes2 = 19-intval($tamanho_mesagem2);
       for ($i = 0; $i<$vezes2;$i++) 
       {
        $mensagem2 = $mensagem2. " ";//Nao retirar esse espaco!
       }
      }
      for ($i = 0; $i<strlen($mensagem);$i++) 
      {
       $tamanho = $tamanho + 1;
       $str = substr($mensagem,$i,1);
       $mensagem_tratada = dechex(ord($str));  
       $mensagem_tratada2 = $mensagem_tratada2 .$mensagem_tratada . " ";
       $mensagem_CRC = $mensagem_CRC . strval($mensagem_tratada);
      }
      for ($i = 0; $i<strlen($mensagem2);$i++) 
      {
       $tamanho2 = $tamanho2 + 1;
       $str = substr($mensagem2,$i,1);
       $mensagem_tratada_2 = dechex(ord($str));  
       $mensagem_tratada2_2 = $mensagem_tratada2_2 .$mensagem_tratada_2 . " ";
       $mensagem_CRC_2 = $mensagem_CRC_2 . strval($mensagem_tratada_2);
      }
      $tamanho = dechex(ord($tamanho));
      $protocolo = "01 02 50 01 01 AA 01 01 82 01 01 00 ";// NAO TERIAR O ESPACO NO FIM
      $tamanho_mensagem = "32 ";// NAO TERIAR O ESPACO NO FIM Equivale a 50 em HEX
      $funcoes = "AA 10 AA 70 AA 01 "; // NAO TERIAR O ESPACO NO FIM 
      $funcoes2 = "AA 10 AA 70 AA 02 "; // NAO TERIAR O ESPACO NO FIM 
      $mensagem_fim = '03';
      $mensagem_completa = $protocolo . $tamanho_mensagem. $funcoes . strtoupper($mensagem_tratada2). $funcoes2. strtoupper($mensagem_tratada2_2) . $mensagem_fim;
      $mensagem_completa2 = strval(str_replace(" ","",$mensagem_completa ));
      //AGORA TRATO E CALCULO O CRC
      define('CRC16POLYN', 0x1021);
      function CRC16Normal($buffer) 
      {
       $result = 0xFFFF;
       if (($length = strlen($buffer)) > 0) 
       {
        for ($offset = 0; $offset < $length; $offset++) 
        {
         $result ^= (ord($buffer[$offset]) << 8);
         for ($bitwise = 0; $bitwise < 8; $bitwise++) 
         {
          if (($result <<= 1) & 0x10000) $result ^= CRC16POLYN;
          $result &= 0xFFFF;
         }
        }
       }
       return $result;
      }
      //Calculando o crc e tratando para uppercase
      $crc_16_CCITT = strtoupper(dechex(CRC16Normal(hex2bin($mensagem_completa2))));
      if(strlen($crc_16_CCITT)<4){$crc_16_CCITT = '0'.$crc_16_CCITT;}
      $mensagem_display = $mensagem_completa . ' '. substr($crc_16_CCITT,0,2). ' '. substr($crc_16_CCITT,2,2);
      $mensagem_display = str_replace(' ','',$mensagem_display);
      $crc_display = $mensagem_display;
      //**************************************************************************************************************************************
      //Atualizo o display
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
  
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE historico_display SET crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
      $v = str_replace('_',' ',$nome_reduzido);
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem='   Tenha uma boa   ',mensagem2='$v' WHERE id='$id_historico_display'");
     
      }
      else
      {
        echo '</BR>';
        echo 'Passou pela balanca, Possivel excesso';
        echo '</BR>'; 
        
        //Como veio da balança 1, ja sugiro ser um excesso! 
        include_once 'conexao.php';
        $statusProcesso = "Excesso/Falta";
        $sql = $dbcon->query("UPDATE historico_display SET condicao1='$statusProcesso',tratado_por_segurpro='Não necessário!',tratado_por_ccl='--',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',material='$material',destino='$destino',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora', sigla_transportadora = '$n_sigla',api_cheio_vazio='$api_cheio_vazio' WHERE id='$id_historico_display'");
        include_once 'conexao.php';
        
        //Atualizo o display
        include_once 'conexao.php';
        $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='_Dirija-se_para_o__',mensagem2='_patio_de_excessos!',mensagem_aux='xxxx',ponto='$ponto' WHERE id='1'");
        //Atualizo semaforo com erro pois deu excesso!
        include_once 'conexao.php';
        $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia!
        $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
        //Atualizo semaforo virtual
        include_once 'conexao.php';
        $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2' WHERE id='1'");

        $condicao = "Excesso/Falta";
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/Y');
        $v_data = $nome_reduzido = explode("/",$data);
        $dia = $v_data[0];
        $mes = $v_data[1];
        $ano = $v_data[2];    
        $hora = date('H:i:s');
          /*
          echo $data;echo'</BR>';
          echo $dia;echo'</BR>';
          echo $mes;echo'</BR>';
          echo $ano;echo'</BR>';
          echo $hora;echo'</BR>';
          */  
        include_once 'conexao.php';
        //$sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_excesso','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$condicao','nao','-','-','nao','0','-')");
        $sql = $dbcon->query("INSERT INTO lidar_excesso(epc_lidar)VALUES('123')");
          
          //Agora limpa na tabela
          //include_once 'conexao.php';
          //$sql = $dbcon->query("UPDATE display_balanca1 SET epc_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_carreta='-',api_cheio_vazio='-',api_lidar='-',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',veiculo='-' WHERE id='1'");

         
      }
    }
    }
   }
   else
   { 
    //Não encontrado, tenho que validar tudo, inserir tanto no match quanto no resto!
   }
  }//Fecha o if($epc != 'vazio')
  else
  {
    echo 'erro';  
  }
  exit();
  
}
else
{

echo " Sem tag valida!";
}

?>