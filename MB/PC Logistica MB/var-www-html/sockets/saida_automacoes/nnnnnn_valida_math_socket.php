<?php

$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";
$v_epc = isset($_GET['epc'])?$_GET['epc']:"vazio";
$v_id = isset($_GET['id'])?$_GET['id']:"vazio";



$condicao_betruck = ""; //Sera usada no fim do codigo para saber o que notifica na api betruck em eventos



if($v_epc != 'vazio')
{
    if($v_id != 'vazio')
    {
     echo "</BR></BR>Iniciando com tag de teste!</BR>";
     echo "TAG : " . $v_epc;
     echo "</BR>Com o ID = ".$v_id ." na tabela validacoes_socket!</BR>";
     echo "</BR>";
     echo "</BR></BR>Faço o UPDATE para tratando! </BR>";
     //Atualizo que esta tratando!
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("UPDATE validacoes_socket SET condicao='Tratado',data_tratado='$data',hora_tratado='$hora' WHERE id='$v_id'");
     
    }
    else
    {
     echo "</BR></BR>Iniciando com tag de teste!</BR>";
     echo "TAG : " . $v_epc;
     echo "</BR>";
    }

}



if( ($mensagem !="vazio" && strlen($mensagem)>30) )
{
    echo "</BR> Veio tratar por tag do reader</BR>";
    $mensagem = explode("#",$mensagem);
    $v_msg = explode(",",$mensagem[2]);
    $nomeReader = $v_msg[0];
    $nomeReader = explode(":",$nomeReader);
    $nomeReader = $nomeReader[1];
    $ca = $v_msg[1];
    $ca = explode(" = ",$ca);
    $ca = $ca[1];
    $hostname = explode(":",$mensagem[3]);
    $hostname = $hostname[1];
    $ip = explode(":",$mensagem[4]);
    $ip = $ip[1];
    $mac = explode(": ",$mensagem[7]);
    $mac = $mac[1];
    $mensagem1 = $mensagem[8];
    $mensagem2 = explode(" ",$mensagem1);
    $dados = $mensagem2[2];
    $dados = explode(",",$dados);
    $epc = $dados[0];
    $epc = explode("=",$epc);
    $epc = $epc[1];
    $antena = explode("=",$dados[1]);
    $antena = $antena[1];
    $ponto = "";
    
    if($antena =="0" || $antena == "1")
    {
     $ponto = "Saida Automações";
    }
    else
    {
     $ponto = "Erro";   
    }
    //Pode seguir o fluxo
    $pode_seguir_fluxo = "sim";

}// Fecha if($mensagem !="vazio" && strlen($mensagem)>30)
else if(($v_epc != 'vazio' &&  strlen($v_epc)==24 ))
{
 //Pode seguir o fluxo
 $pode_seguir_fluxo = "sim";
 echo "</BR> Veio tratar por tag do teste</BR>";
 
} 
else
{
 echo " Sem dados para tratar!"; 
 $pode_seguir_fluxo = "nao";  
}   
    
    
if ( $pode_seguir_fluxo == "sim")
{
    
    if ((strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  )  && $ponto == 'Saida Automações'  ) || (strlen($v_epc)==24 && (  substr($v_epc,0,6) =="442002" || substr($v_epc,0,6) =="442001"  ) )     )  // A segunda parte e para ter condicao de publicar manualmente para testar alguma tag
    {
     if($v_epc != 'vazio')
     {
        $v2_epc = substr($v_epc,0,6);
        $epc_betruck = $v_epc; //Para usar la embaixo na api BeTruck
     }
     else
     {
      $v1_epc = substr($epc,0,6);
      $epc_betruck = $epc; //Para usar la embaixo na api BeTruck
     }
     
     
     
     if($v1_epc == '442002' || $v2_epc == '442002')
     {
      // TAG veio a da carreta ******************************************************************************************************
      echo "</BR></BR>Veio TAG da carreta para tratar!</BR>";
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      $id_duplicado = 0;
      
      //PRIMEIRO VERIFICO SE JA NAO ESTA NA LISTA!
      if($v1_epc == '442002')
      {
        $tag = $v1_epc; // TAG lida pelo reader
      }
      else
      {
       $tag = $v_epc; // TAG inserida manualmente para testes 
      }



     

      echo "TAG = " . $tag . "</BR>";
      $pode_salvar = "nao";
      include_once 'conexao_saida_automacoes.php';
      $encontrado = 0;
      $sql = $dbcon->query("SELECT * FROM historico_display WHERE (epc_carreta='$tag') ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       while($dados = $sql->fetch_array())
       { 
        $encontrado = 1;
        $id = trim($dados['id']);
        $concluido = trim($dados['concluido']);
        $status_gagf = trim($dados['condicao2']);
        $epc_cavalo = trim($dados['epc_cavalo']);
        $epc_carreta = trim($dados['epc_carreta']);
        $placa_cavalo = trim($dados['placa_cavalo']);
        $placa_carreta = trim($dados['placa_carreta']);
        $nome_completo = $dados['motorista'];
        $telefone = $dados['telefone'];
        $transportadora = $dados['transportadora'];
        $destino = $dados['destino'];
        $saida = $dados['ponto'];

        echo "Achou!</BR>Com condicao = ".$concluido."</BR>";
        $pode_salvar = "sim"; // Mas vou verificar se ja nao esta concluido!
       }

       if($transportadora != '' && $transportadora != 'Não identificado!')
       {
        //Busco a sigla
        include_once 'conexao_saida_automacoes.php';
        $sql = $dbcon->query("SELECT * FROM transportadoras WHERE (nome='$transportadora') LIMIT 1");
        if(mysqli_num_rows($sql)>0)
        {
         $vencontrado = 0;
         $dados = $sql->fetch_array();
         $vencontrado = 1;
         $sigla = $dados['sigla'];
        }
        if($vencontrado == 1) 
        {
          $transportadora = $sigla;
        }
        else
        {
          $transportadora = "Não identificado!";
        }

       }
       else
       {
        $transportadora = "Não identificado!";
       }

       $nome_reduzido = explode(" ",$nome_completo);
       $nome_reduzido = strtolower($nome_reduzido[0]); // Coloca o nome todo em minusculo
       $nome_reduzido2 = ucfirst($nome_reduzido); // Coloca a primeira letra em maiusculo
       
      }
      if($encontrado == 0)
      {
       echo "Nao tem a tag na lista, tenho que fazer o fluxo todo!";  
       $pode_salvar = "nao";
       
      }
      if($pode_salvar == "sim")
      {
       //ENCONTROU A TAG POIS ELA PASSOU OU NA MG030 OU NA BALANÇA 01  
       //Primeiro verifico se ja nao esta concluido/tratado
       if($concluido == "sim" || $concluido == "Sim")
       {
        //Nao faz nada, ja foi tratado!
        echo "</BR> Não faço nada pois esse veiculo ja foi validado e encerrou o processo!";
       }
       else
       {
        //Tenho que tratar!
        echo "</BR></BR>Preciso tratar a tag de carreta!";
        echo "</BR>Status do GAGF = ".$status_gagf . "</BR>";
        
        //Atualizo que esta tratando!
        include_once 'conexao_saida_automacoes.php';
        $sql = $dbcon->query("UPDATE historico_display SET condicao1='Tratando!',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id'");
        // ATUALIZO AGORA NO BANCO PARA DIZER QUE ESTOU TRATANDO ESSE
        //Atualizo os dados no display_balanca1 
        include_once 'conexao_saida_automacoes.php';
        $sql = $dbcon->query("UPDATE display_balanca1 SET id_historico='$id',epc_carreta='$epc_carreta',epc_cavalo = '$epc_cavalo',placa_cavalo='$placa_cavalo' WHERE id='1'");
        
        $id_historico_display = $id;

        if($status_gagf == "Concluído" || $status_gagf == "Saindo da Planta" )
        {
         echo "Entrou para tratar como CONCLUIDO ou SAINDO DA PLANTA para carreta!</BR></BR>";
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
         include_once 'conexao_saida_automacoes.php';
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
         if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' ) // Verifica se nao tem alerta de carga descentralizada!
         {
          echo '</BR>';
          echo 'Esta tudo ok e LIBERO a saída!';
          echo '</BR>';
          
          // LIbera no BeTruck
          $condicao_betruck = "Liberado!";

          //Libera semáforo saída *****************************************************************************************************************
          
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          //Atualizo semaforo virtual
          include_once 'conexao_saida_automacoes.php';
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
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
              
          //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET condicao1='Concluído',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
          // checa_condicao_cheio_vazio($id,$status_gagf,$epc_carreta,$epc_cavalo,$placa_cavalo);
         
          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_concluidos';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }

          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
          $dados = $sql->fetch_array(); 
          $id = $dados['id'];
          $v_turno1 = $dados['v_turno1'];
          $v_turno2 = $dados['v_turno2'];
          $v_turno3 = $dados['v_turno3'];

          }
          if($v_turno == 'v_turno1')
          {
          $v_turno1 = intval($v_turno1)+1;
          $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
          $v_turno2 = intval($v_turno2)+1;
          $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
          $v_turno3 = intval($v_turno3)+1;
          $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }
        
        
        
         } // fecha if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' )
         else
         {
          //TEVE ALERTA DE CARGA DESCENTRALIZADA, AI VERIFICO SE ESTA VAZIO, SE SIM, FOI ERRO DA API, CASO CONTRARIO É CARGA DESCENTRALIZADA   
          echo '</BR>';
          echo 'Erro - Verifico se esta vazio pois pode ter sido ERRO da API do LIDAR!';
          echo '</BR>';
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
          {
           $dados = $sql->fetch_array(); 
           $status_api_cheio_vazio = $dados['api_cheio_vazio'];
           $id_cheio_vazio = $dados['id_cheio_vazio'];
           $api_lidar = $dados['api_lidar'];
           $alerta = $dados['alerta'];
           $alert2 = $dados['alerta2'];
           $veiculo = $dados['veiculo'];
           $condicao_veiculo = $dados['condicao_veiculo'];
          }
          if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          {
           echo '</BR>';
           echo 'Veiculo saindo vazio, considero como ok';
           echo '</BR>'; 
           
           // Libero tambem no BeTruck
           $condicao_betruck = "Liberado!";

           //Libera semáforo saída *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           //Atualizo semaforo virtual
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
           
           //**************************************************************************************************************************************
           
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
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
              
          //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET condicao1='Saindo Vazio',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }          
        
        
        
        
          } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          else
          {
           echo '</BR>';
           echo 'Esta cheio, carga descentralizada!';
           echo '</BR>'; 
           //Existe carga descentralizada!

           //Atualizo que esta com carga descentralizada no BeTruck  ****ATENÇÃO ****** >>> Nao notifica enviar email ainda e sim o primeiro push apenas
           $condicao_betruck = "Carga Descentralizada!";
           
           //Libera semáforo saída com alerta *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Carga___',mensagem2='_descentralizada!__',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
           //Atualizo o status no historico_display
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Carga   ',mensagem2=' descentralizada!  ',condicao1='Carga Descentralizada!',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Sim',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
           //VERIFICAR SE AQUI SERA O MOMENTO DE COLOCAR NO PATIO DE EXCESSO PARA AGUARDAR CONFIRMACAO DE IDA LA PARA AJUSTE DA CARGA

           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
           {
            $dados = $sql->fetch_array(); 
            $status_api_cheio_vazio = $dados['api_cheio_vazio']; // Retorna Cheio/Vazio...etc
            $id_historico = $dados['id_historico']; // ID do evento no historico_display
            $id_cheio_vazio = $dados['id_cheio_vazio']; // o ID do cheio/vazio
            $id_lidar = $dados['api_lidar']; // ID API lidar
            $alerta = $dados['alerta']; // dados
            $alert2 = $dados['alerta2']; // dados
            $veiculo = $dados['veiculo'];
            $condicao_veiculo = $dados['condicao_veiculo'];
            $epc_excesso = $dados['epc_carreta'];
           }
           $placa = $placa_carreta;
           $condicao = "Carga Descentralizada!";
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $v_data = $nome_reduzido = explode("/",$data);
           $dia = $v_data[0];
           $mes = $v_data[1];
           $ano = $v_data[2];    
           $hora = date('H:i:s');
 
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,motorista,telefone,transportadora,destino,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_excesso','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$condicao','$nome_reduzido2','$telefone','$transportadora','$destino','nao','-','-','nao','0','-')");
   
           include_once 'conexao_dashboard.php';
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           $v_hora = explode(':',$hora);
           $v_hora = intval($v_hora[0]);
           $ano = explode('/',$data);
           $ano = $ano[2];
           $tabela = 'lista_turno_dashboard_'.$ano.'_carga';
           if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
           {
             $v_turno = 'v_turno1';  
           }
           else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
           {
             $v_turno = 'v_turno2';  
           }
           else
           {
             $v_turno = 'v_turno3';      
           }
           
           include_once 'conexao_dashboard.php';
           $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
           {
            $dados = $sql->fetch_array(); 
            $id = $dados['id'];
            $v_turno1 = $dados['v_turno1'];
            $v_turno2 = $dados['v_turno2'];
            $v_turno3 = $dados['v_turno3'];
           
           }
           if($v_turno == 'v_turno1')
           {
            $v_turno1 = intval($v_turno1)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                   
           }
           else if ($v_turno == 'v_turno2')
           {
            $v_turno2 = intval($v_turno2)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
               
           }
           else
           {
            $v_turno3 = intval($v_turno3)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
           }          
          
          
          }// Fecha else do if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         } // Fecha o else do if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' )
        } // Fecha if($status_gagf == "Concluído" || $status_gagf == "Saindo da Planta")
        else if($status_gagf == "Cancelado" )
        {
         //VERIFICO SE ESTA VAZIO, SE SIM, FOI ERRO DA API, CASO CONTRARIO DIRECIONO PARA PATRIMONIAL TRATAR!  
         echo '</BR>';
         echo 'Erro - Verifico se esta vazio, senao, direciono para PATRIMONIAL tratar carreta!';
         echo '</BR>';
         include_once 'conexao_saida_automacoes.php';
         $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
         {
          $dados = $sql->fetch_array(); 
          $status_api_cheio_vazio = $dados['api_cheio_vazio'];
          $id_cheio_vazio = $dados['id_cheio_vazio'];
          $api_lidar = $dados['api_lidar'];
          $alerta = $dados['alerta'];
          $alert2 = $dados['alerta2'];
          $veiculo = $dados['veiculo'];
          $condicao_veiculo = $dados['condicao_veiculo'];
         }
         echo "status_api_cheio_vazio = " . $status_api_cheio_vazio."</BR>";
         echo "condicao_veiculo = " . $condicao_veiculo . "</BR>";

         if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         {
          echo '</BR>';
          echo 'Veiculo saindo vazio, considero como ok';
          echo '</BR>'; 


          // Notifico no BeTruck 
          $condicao_betruck = "Saindo Vazio da Mina!";

          //Libera semáforo saída *****************************************************************************************************************
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          //Atualizo semaforo virtual
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
           
          //**************************************************************************************************************************************
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
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
              
          //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET condicao1='Saindo Vazio',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
         

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }
          




          } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         else
         {
          // VEICULO ESTA CHEIO, DIRECIONO PARA A PATRIMONIAL TRATAR!
          echo '</BR>';
          echo 'Esta cheio, DIRECIONO PARA PATRIMONIAL VERIFICAR!';
          echo '</BR>'; 

          // Notifico tambem no BeTruck
          $condicao_betruck = "Patrimonial!";
          
          //Libera semáforo saída com alerta *****************************************************************************************************************
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Procure_',mensagem2='_a_Patrimonial!____',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
          //Atualizo o status no historico_display
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Procure ',mensagem2=' a Patrimonial!    ',condicao1='Patrimonial Validar!',tratado_por_segurpro='Não',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
          //VERIFICAR SE AQUI SERA O MOMENTO DE COLOCAR NO PATIO DE EXCESSO PARA AGUARDAR CONFIRMACAO DE IDA LA PARA AJUSTE DA CARGA

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_patrimonial';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }

         } // Fecha else if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
        }
        else
        {
         //Tenho que tratar pois é algo diferente
         echo "Verifico onde foi a saida pois pode ter havido um EXCESSO para carreta</BR>";
         include_once 'conexao_saida_automacoes.php';
         $sql = $dbcon->query("SELECT * FROM historico_display WHERE (epc_carreta='$tag') ORDER BY id DESC LIMIT 1");
         if(mysqli_num_rows($sql)>0)
         {
          $dados = $sql->fetch_array();
          $saida = $dados['ponto'];
         }
         echo "</BR>Saida foi pela " . $saida . "</BR>";
         if($saida =="mg")
         {
          echo "Saiu pela MG030, considero um possivel alerta de desvio!";
          echo "Primeiro vou verificar se esta cheio ou nao, se SIM, sinalizo possivel desvio, caso contrario libero a saida!";
          //VERIFICO SE ESTA VAZIO, SE SIM, Libero saida, CASO CONTRARIO DIRECIONO PARA PATRIMONIAL TRATAR!  
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
          {
           $dados = $sql->fetch_array(); 
           $status_api_cheio_vazio = $dados['api_cheio_vazio'];
           $id_cheio_vazio = $dados['id_cheio_vazio'];
           $api_lidar = $dados['api_lidar'];
           $alerta = $dados['alerta'];
           $alert2 = $dados['alerta2'];
           $veiculo = $dados['veiculo'];
           $condicao_veiculo = $dados['condicao_veiculo'];
          }
          echo "status_api_cheio_vazio = " . $status_api_cheio_vazio."</BR>";
          echo "condicao_veiculo = " . $condicao_veiculo . "</BR>";

          if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          {
           echo '</BR>';
           echo 'Veiculo saindo vazio, considero como ok';
           echo '</BR>'; 
           //Libera semáforo saída *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           //Atualizo semaforo virtual
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
            
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
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
               
           //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE historico_display SET condicao1='Saindo Vazio',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");

           include_once 'conexao_dashboard.php';
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           $v_hora = explode(':',$hora);
           $v_hora = intval($v_hora[0]);
           $ano = explode('/',$data);
           $ano = $ano[2];
           $tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
           if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
           {
             $v_turno = 'v_turno1';  
           }
           else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
           {
             $v_turno = 'v_turno2';  
           }
           else
           {
             $v_turno = 'v_turno3';      
           }
           
           include_once 'conexao_dashboard.php';
           $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
           {
            $dados = $sql->fetch_array(); 
            $id = $dados['id'];
            $v_turno1 = $dados['v_turno1'];
            $v_turno2 = $dados['v_turno2'];
            $v_turno3 = $dados['v_turno3'];
           
           }
           if($v_turno == 'v_turno1')
           {
            $v_turno1 = intval($v_turno1)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                   
           }
           else if ($v_turno == 'v_turno2')
           {
            $v_turno2 = intval($v_turno2)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
               
           }
           else
           {
            $v_turno3 = intval($v_turno3)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
           }
           
          } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          else
          {
           // VEICULO ESTA CHEIO, DIRECIONO PARA A PATRIMONIAL TRATAR!
           echo '</BR>';
           echo 'Esta cheio, DIRECIONO PARA PATRIMONIAL VERIFICAR!';
           echo '</BR>'; 
          
           //Libera semáforo saída com alerta *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           
           //Atualizo display
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Procure_',mensagem2='_a_Patrimonial!____',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
           
           //Atualizo o status no historico_display
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Procure ',mensagem2=' a Patrimonial!    ',condicao1='Patrimonial Validar!',tratado_por_segurpro='Não',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
           
           //VERIFICAR SE AQUI SERA O MOMENTO DE COLOCAR NO PATIO DE EXCESSO PARA AGUARDAR CONFIRMACAO DE IDA LA PARA AJUSTE DA CARGA

           include_once 'conexao_dashboard.php';
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           $v_hora = explode(':',$hora);
           $v_hora = intval($v_hora[0]);
           $ano = explode('/',$data);
           $ano = $ano[2];
           $tabela = 'lista_turno_dashboard_'.$ano.'_patrimonial';
           if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
           {
             $v_turno = 'v_turno1';  
           }
           else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
           {
             $v_turno = 'v_turno2';  
           }
           else
           {
             $v_turno = 'v_turno3';      
           }
           
           include_once 'conexao_dashboard.php';
           $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
           {
            $dados = $sql->fetch_array(); 
            $id = $dados['id'];
            $v_turno1 = $dados['v_turno1'];
            $v_turno2 = $dados['v_turno2'];
            $v_turno3 = $dados['v_turno3'];
           
           }
           if($v_turno == 'v_turno1')
           {
            $v_turno1 = intval($v_turno1)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                   
           }
           else if ($v_turno == 'v_turno2')
           {
            $v_turno2 = intval($v_turno2)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
               
           }
           else
           {
            $v_turno3 = intval($v_turno3)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
           }         
          } // Fecha else if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         } // Fecho if ($saida == "mg")
         else
         {
          //Saiu pela balança, considero um possivel excesso
          echo "Saiu pela BALANÇA 01, considero um possivel excesso!";  
          //Libera semáforo saída com alerta *****************************************************************************************************************
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          
          //Atualizo o status no historico_display
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Dirija-se para o  ',mensagem2=' patio de excessos!',condicao1='Excesso/Falta',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
          
          //Atualizo o Display
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='_Dirija-se_para_o__',mensagem2='_patio_de_excessos!',mensagem_aux='xxxx',ponto='$saida' WHERE id='1'");

          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
          {
           $dados = $sql->fetch_array(); 
           $status_api_cheio_vazio = $dados['api_cheio_vazio']; // Retorna Cheio/Vazio...etc
           $id_historico = $dados['id_historico']; // ID do evento no historico_display
           $id_cheio_vazio = $dados['id_cheio_vazio']; // o ID do cheio/vazio
           $id_lidar = $dados['api_lidar']; // ID API lidar
           $alerta = $dados['alerta']; // dados
           $alert2 = $dados['alerta2']; // dados
           $veiculo = $dados['veiculo'];
           $condicao_veiculo = $dados['condicao_veiculo'];
           $epc_excesso = $dados['epc_carreta'];
          }
          $placa = $placa_carreta;
          $condicao = "Excesso/Falta";
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $v_data = $nome_reduzido = explode("/",$data);
          $dia = $v_data[0];
          $mes = $v_data[1];
          $ano = $v_data[2];    
          $hora = date('H:i:s');

          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,motorista,telefone,transportadora,destino,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_excesso','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$condicao','$nome_reduzido2','$telefone','$transportadora','$destino','nao','-','-','nao','0','-')");





          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_excesso_falta';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }
         } // Fecho else saiu pela balanca 01

         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
        } // Fecho else de outra condicao sem ser CONCLUIDO, SAINDO DA PLANTA OU CANCELADO
       } // Fecha else if($concluido == "sim" || $concluido == "Sim")
      } // Fecha if($pode_salvar == "sim")
      else
      {
        //PRECISO FAZER O FLUXO COMPLETO, POIS POR ALGUM MOTIVO NAO FOI LIDA NEM NA BALANCA NEM NA MG030
        
        


      } // Fecha else if($pode_salvar == "sim")
     } // Fecha if($v1_epc == '442002' || $v_epc == '442002')
     else
     { 
      //TAG veio a do cavalo  ********************************************************************************************************
      echo "</BR></BR>Veio TAG de cavalo para tratar!</BR>";
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      $id_duplicado = 0;
      
      if($v1_epc == '442001')
      {
        $tag = $v1_epc; // TAG lida pelo reader
      }
      else
      {
       $tag = $v_epc; // TAG inserida manualmente para testes 
      }
      echo "TAG = " . $tag . "</BR>";
      $pode_salvar = "nao";
      include_once 'conexao_saida_automacoes.php';
      $encontrado = 0;
      $sql = $dbcon->query("SELECT * FROM historico_display WHERE epc_cavalo='$tag' ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       while($dados = $sql->fetch_array())
       { 
        $encontrado = 1;
        $id = trim($dados['id']);
        $concluido = trim($dados['concluido']);
        $status_gagf = trim($dados['condicao2']);
        $epc_cavalo = trim($dados['epc_cavalo']);
        $epc_carreta = trim($dados['epc_carreta']);
        $placa_cavalo = trim($dados['placa_cavalo']);
        $placa_carreta = trim($dados['placa_carreta']);
        $nome_completo = $dados['motorista'];
        
        echo "Achou!</BR>Com condicao = ".$concluido."</BR>";
        $pode_salvar = "sim"; // Mas vou verificar se ja nao esta concluido!
       }
      }
      if($encontrado == 0)
      {
       echo "Nao tem a tag na lista, tenho que fazer o fluxo todo!";  
       $pode_salvar = "nao";
      }
      if($pode_salvar == "sim")
      {
       //ENCONTROU A TAG POIS ELA PASSOU OU NA MG030 OU NA BALANÇA 01  
       //Primeiro verifico se ja nao esta concluido/tratado
       if($concluido == "sim" || $concluido == "Sim")
       {
        //Nao faz nada, ja foi tratado!
        echo "</BR> Não faço nada pois esse veiculo ja foi validado e encerrou o processo!";
       }
       else
       {
        //Tenho que tratar!
        echo "</BR></BR>Preciso tratar a tag de cavalo!";
        echo "</BR>Status do GAGF = ".$status_gagf . "</BR>";
        
        //Atualizo que esta tratando!
        include_once 'conexao_saida_automacoes.php';
        $sql = $dbcon->query("UPDATE historico_display SET condicao1='Tratando!',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id'");
        // ATUALIZO AGORA NO BANCO PARA DIZER QUE ESTOU TRATANDO ESSE
        //Atualizo os dados no display_balanca1 
        include_once 'conexao_saida_automacoes.php';
        $sql = $dbcon->query("UPDATE display_balanca1 SET id_historico='$id',epc_carreta='$epc_carreta',epc_cavalo = '$epc_cavalo',placa_cavalo='$placa_cavalo' WHERE id='1'");
        
        $id_historico_display = $id;

        if($status_gagf == "Concluído" || $status_gagf == "Saindo da Planta" )
        {
         echo "Entrou para tratar como CONCLUIDO ou SAINDO DA PLANTA para cavalo!</BR></BR>";
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
         include_once 'conexao_saida_automacoes.php';
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
         if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' ) // Verifica se nao tem alerta de carga descentralizada!
         {
          echo '</BR>';
          echo 'Esta tudo ok e LIBERO a saída!';
          echo '</BR>';
          
          // Notifico no BeTruck
          $condicao_betruck = "Liberado2!";
          //Libera semáforo saída *****************************************************************************************************************
          
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          //Atualizo semaforo virtual
          include_once 'conexao_saida_automacoes.php';
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
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
              
          //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET condicao1='Concluído',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");
          // checa_condicao_cheio_vazio($id,$status_gagf,$epc_carreta,$epc_cavalo,$placa_cavalo);

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_concluidos';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }         
         } // fecha if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' )
         else
         {
          //TEVE ALERTA DE CARGA DESCENTRALIZADA, AI VERIFICO SE ESTA VAZIO, SE SIM, FOI ERRO DA API, CASO CONTRARIO É CARGA DESCENTRALIZADA   
          echo '</BR>';
          echo 'Erro - Verifico se esta vazio pois pode ter sido ERRO da API do LIDAR!';
          echo '</BR>';
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
          {
           $dados = $sql->fetch_array(); 
           $status_api_cheio_vazio = $dados['api_cheio_vazio'];
           $id_cheio_vazio = $dados['id_cheio_vazio'];
           $api_lidar = $dados['api_lidar'];
           $alerta = $dados['alerta'];
           $alert2 = $dados['alerta2'];
           $veiculo = $dados['veiculo'];
           $condicao_veiculo = $dados['condicao_veiculo'];
          }          
          if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          {
           echo '</BR>';
           echo 'Veiculo saindo vazio, considero como ok';
           echo '</BR>'; 
           
           // Notifico no BeTruck
           $condicao_betruck = "Liberado2!";


           //Libera semáforo saída *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           //Atualizo semaforo virtual
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
           
           //**************************************************************************************************************************************
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
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
              
          //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET condicao1='Saindo Vazio',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }          
          } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          else
          {
           echo '</BR>';
           echo 'Esta cheio, carga descentralizada!';
           echo '</BR>'; 
           //Existe carga descentralizada!
           

           // Notifico no BeTruck
           $condicao_betruck = "Carga Descentralizada2!";

           //Libera semáforo saída com alerta *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Carga___',mensagem2='_descentralizada!__',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
           //Atualizo o status no historico_display
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Carga   ',mensagem2=' descentralizada!  ',condicao1='Carga Descentralizada!',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Sim',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
           //VERIFICAR SE AQUI SERA O MOMENTO DE COLOCAR NO PATIO DE EXCESSO PARA AGUARDAR CONFIRMACAO DE IDA LA PARA AJUSTE DA CARGA

           include_once 'conexao_dashboard.php';
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           $v_hora = explode(':',$hora);
           $v_hora = intval($v_hora[0]);
           $ano = explode('/',$data);
           $ano = $ano[2];
           $tabela = 'lista_turno_dashboard_'.$ano.'_carga';
           if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
           {
             $v_turno = 'v_turno1';  
           }
           else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
           {
             $v_turno = 'v_turno2';  
           }
           else
           {
             $v_turno = 'v_turno3';      
           }
           
           include_once 'conexao_dashboard.php';
           $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
           {
            $dados = $sql->fetch_array(); 
            $id = $dados['id'];
            $v_turno1 = $dados['v_turno1'];
            $v_turno2 = $dados['v_turno2'];
            $v_turno3 = $dados['v_turno3'];
           
           }
           if($v_turno == 'v_turno1')
           {
            $v_turno1 = intval($v_turno1)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                   
           }
           else if ($v_turno == 'v_turno2')
           {
            $v_turno2 = intval($v_turno2)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
               
           }
           else
           {
            $v_turno3 = intval($v_turno3)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
           }          
          }// Fecha else do if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         } // Fecha o else do if($alerta =='Erro' || $alerta =='-' || $alerta =='' || $alerta =='Tudo OK' )
        } // Fecha if($status_gagf == "Concluído" || $status_gagf == "Saindo da Planta")
        else if($status_gagf == "Cancelado" )
        {
         //VERIFICO SE ESTA VAZIO, SE SIM, FOI ERRO DA API, CASO CONTRARIO DIRECIONO PARA PATRIMONIAL TRATAR!  
         echo '</BR>';
         echo 'Erro - Verifico se esta vazio, senao, direciono para PATRIMONIAL tratar cavalo!';
         echo '</BR>';
         include_once 'conexao_saida_automacoes.php';
         $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
         {
          $dados = $sql->fetch_array(); 
          $status_api_cheio_vazio = $dados['api_cheio_vazio'];
          $id_cheio_vazio = $dados['id_cheio_vazio'];
          $api_lidar = $dados['api_lidar'];
          $alerta = $dados['alerta'];
          $alert2 = $dados['alerta2'];
          $veiculo = $dados['veiculo'];
          $condicao_veiculo = $dados['condicao_veiculo'];
         }         
         echo "status_api_cheio_vazio = " . $status_api_cheio_vazio."</BR>";
         echo "condicao_veiculo = " . $condicao_veiculo . "</BR>";

         if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         {
          echo '</BR>';
          echo 'Veiculo saindo vazio, considero como ok';
          echo '</BR>'; 

          // Notifico no BeTruck
          $condicao_betruck = "Saindo Vazio da Mina2!";

          //Libera semáforo saída *****************************************************************************************************************
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          //Atualizo semaforo virtual
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
           
          //**************************************************************************************************************************************
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
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
              
          //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET condicao1='Saindo Vazio',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }         
         } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         else
         {
          // VEICULO ESTA CHEIO, DIRECIONO PARA A PATRIMONIAL TRATAR!
          echo '</BR>';
          echo 'Esta cheio, DIRECIONO PARA PATRIMONIAL VERIFICAR!';
          echo '</BR>'; 

          // Notifico BeTruck
          $condicao_betruck = "Patrimonial2!"; 
          
          //Libera semáforo saída com alerta *****************************************************************************************************************
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Procure_',mensagem2='_a_Patrimonial!____',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
          //Atualizo o status no historico_display
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Procure ',mensagem2=' a Patrimonial!    ',condicao1='Patrimonial Validar!',tratado_por_segurpro='Não',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
          //VERIFICAR SE AQUI SERA O MOMENTO DE COLOCAR NO PATIO DE EXCESSO PARA AGUARDAR CONFIRMACAO DE IDA LA PARA AJUSTE DA CARGA

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_patrimonial';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }         
         } // Fecha else if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
        }
        else
        {
         //Tenho que tratar pois é algo diferente
         echo "Verifico onde foi a saida pois pode ter havido um EXCESSO para cavalo</BR>";
         include_once 'conexao_saida_automacoes.php';
         $sql = $dbcon->query("SELECT * FROM historico_display WHERE (epc_cavalo='$tag') ORDER BY id DESC LIMIT 1");
         if(mysqli_num_rows($sql)>0)
         {
          $dados = $sql->fetch_array();
          $saida = $dados['ponto'];
         }
         echo "</BR>Saida foi pela " . $saida . "</BR>";

         if($saida =="mg")
         {
          echo "Saiu pela MG030, considero um possivel alerta de desvio!";
          echo "Primeiro vou verificar se esta cheio ou nao, se SIM, sinalizo possivel desvio, caso contrario libero a saida!";
          //VERIFICO SE ESTA VAZIO, SE SIM, Libero saida, CASO CONTRARIO DIRECIONO PARA PATRIMONIAL TRATAR!  
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
          {
           $dados = $sql->fetch_array(); 
           $status_api_cheio_vazio = $dados['api_cheio_vazio'];
           $id_cheio_vazio = $dados['id_cheio_vazio'];
           $api_lidar = $dados['api_lidar'];
           $alerta = $dados['alerta'];
           $alert2 = $dados['alerta2'];
           $veiculo = $dados['veiculo'];
           $condicao_veiculo = $dados['condicao_veiculo'];
          }
          echo "status_api_cheio_vazio = " . $status_api_cheio_vazio."</BR>";
          echo "condicao_veiculo = " . $condicao_veiculo . "</BR>";

          if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          {
           echo '</BR>';
           echo 'Veiculo saindo vazio, considero como ok';
           echo '</BR>'; 

           // Notifico BeTruck
           $condicao_betruck = "Saindo Vazio da Mina!";

           //Libera semáforo saída *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,0<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           //Atualizo semaforo virtual
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='0' WHERE id='1'");
            
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
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET crc_display='$crc_display',mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto'  WHERE id='1'");
               
           //Ja pode finalizar a viagem e concluir tudo! ******************************************************************************************
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE historico_display SET condicao1='Saindo Vazio',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora',crc_display='$crc_display',mensagem='$mensagem',mensagem2='$mensagem2' WHERE id='$id_historico_display'");

           include_once 'conexao_dashboard.php';
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           $v_hora = explode(':',$hora);
           $v_hora = intval($v_hora[0]);
           $ano = explode('/',$data);
           $ano = $ano[2];
           $tabela = 'lista_turno_dashboard_'.$ano.'_cancelados';
           if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
           {
             $v_turno = 'v_turno1';  
           }
           else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
           {
             $v_turno = 'v_turno2';  
           }
           else
           {
             $v_turno = 'v_turno3';      
           }
           
           include_once 'conexao_dashboard.php';
           $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
           {
            $dados = $sql->fetch_array(); 
            $id = $dados['id'];
            $v_turno1 = $dados['v_turno1'];
            $v_turno2 = $dados['v_turno2'];
            $v_turno3 = $dados['v_turno3'];
           
           }
           if($v_turno == 'v_turno1')
           {
            $v_turno1 = intval($v_turno1)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                   
           }
           else if ($v_turno == 'v_turno2')
           {
            $v_turno2 = intval($v_turno2)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
               
           }
           else
           {
            $v_turno3 = intval($v_turno3)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
           }          
          } // Fecha if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
          else
          {
           // VEICULO ESTA CHEIO, DIRECIONO PARA A PATRIMONIAL TRATAR!
           echo '</BR>';
           echo 'Esta cheio, DIRECIONO PARA PATRIMONIAL VERIFICAR!';
           echo '</BR>'; 
          
           // Notifico BeTruck
           $condicao_betruck = "Patrimonial!";

           //Libera semáforo saída com alerta *****************************************************************************************************************
           include_once 'conexao_saida_automacoes.php';
           $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
           $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
           
           //Atualizo display
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE display_balanca1 SET semaforo_entrada='1',semaforo_saida='2',mensagem1='_Atencao:_Procure_',mensagem2='_a_Patrimonial!____',mensagem_aux='$placa',epc_carreta = '$epc_carreta',ponto='$ponto',opcao='-2'  WHERE id='1'");
           
           //Atualizo o status no historico_display
           include_once 'conexao_saida_automacoes.php';
           $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Atencao: Procure ',mensagem2=' a Patrimonial!    ',condicao1='Patrimonial Validar!',tratado_por_segurpro='Não',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
           
           //VERIFICAR SE AQUI SERA O MOMENTO DE COLOCAR NO PATIO DE EXCESSO PARA AGUARDAR CONFIRMACAO DE IDA LA PARA AJUSTE DA CARGA

           include_once 'conexao_dashboard.php';
           date_default_timezone_set('America/Sao_Paulo');
           $data = date('d/m/Y');
           $hora = date('H:i:s');
           $v_hora = explode(':',$hora);
           $v_hora = intval($v_hora[0]);
           $ano = explode('/',$data);
           $ano = $ano[2];
           $tabela = 'lista_turno_dashboard_'.$ano.'_patrimonial';
           if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
           {
             $v_turno = 'v_turno1';  
           }
           else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
           {
             $v_turno = 'v_turno2';  
           }
           else
           {
             $v_turno = 'v_turno3';      
           }
           
           include_once 'conexao_dashboard.php';
           $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
           {
            $dados = $sql->fetch_array(); 
            $id = $dados['id'];
            $v_turno1 = $dados['v_turno1'];
            $v_turno2 = $dados['v_turno2'];
            $v_turno3 = $dados['v_turno3'];
           
           }
           if($v_turno == 'v_turno1')
           {
            $v_turno1 = intval($v_turno1)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                   
           }
           else if ($v_turno == 'v_turno2')
           {
            $v_turno2 = intval($v_turno2)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
               
           }
           else
           {
            $v_turno3 = intval($v_turno3)+1;
            $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
           }         
          } // Fecha else if( ($status_api_cheio_vazio =='Saindo Vazio!' || $status_api_cheio_vazio =='' || $status_api_cheio_vazio=='-' ) && ( $condicao_veiculo=='Vazia' || $condicao_veiculo='' || $condicao_veiculo=='-' )  )
         } // Fecho if ($saida == "mg")
         else
         {
          //Saiu pela balança, considero um possivel excesso
          echo "Saiu pela BALANÇA 01, considero um possivel excesso!";  

          // Notifco BeTruck
          $condicao_betruck = "Excesso!";

          //Libera semáforo saída com alerta *****************************************************************************************************************
          include_once 'conexao_saida_automacoes.php';
          $mensagem_lora = ">1,2<"; // Envia para abrir o semáforo! Atenção: A >0,1< ele mesmo envia! > Vermelho entrada e verde piscando saida
          $sql = $dbcon->query("INSERT INTO mensagens_lora(mensagem)VALUES('$mensagem_lora')");
          
          //Atualizo o status no historico_display
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE historico_display SET crc_display='-',mensagem=' Dirija-se para o  ',mensagem2=' patio de excessos!',condicao1='Excesso ou Falta',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id_historico_display'");
          
          //Atualizo o Display
          include_once 'conexao_saida_automacoes.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='_Dirija-se_para_o__',mensagem2='_patio_de_excessos!',mensagem_aux='xxxx',ponto='$saida' WHERE id='1'");

          include_once 'conexao_dashboard.php';
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('d/m/Y');
          $hora = date('H:i:s');
          $v_hora = explode(':',$hora);
          $v_hora = intval($v_hora[0]);
          $ano = explode('/',$data);
          $ano = $ano[2];
          $tabela = 'lista_turno_dashboard_'.$ano.'_excesso_falta';
          if($v_hora == 0 || $v_hora == 1 || $v_hora == 2 || $v_hora == 3 || $v_hora == 4 || $v_hora == 5 || $v_hora == 6 || $v_hora == 7  )
          {
            $v_turno = 'v_turno1';  
          }
          else if($v_hora == 8 || $v_hora == 9 || $v_hora == 10 || $v_hora == 11 || $v_hora == 12 || $v_hora == 13 || $v_hora == 14 || $v_hora == 15  || $v_hora == 16  )
          {
            $v_turno = 'v_turno2';  
          }
          else
          {
            $v_turno = 'v_turno3';      
          }
          
          include_once 'conexao_dashboard.php';
          $sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data'");
          {
           $dados = $sql->fetch_array(); 
           $id = $dados['id'];
           $v_turno1 = $dados['v_turno1'];
           $v_turno2 = $dados['v_turno2'];
           $v_turno3 = $dados['v_turno3'];
          
          }
          if($v_turno == 'v_turno1')
          {
           $v_turno1 = intval($v_turno1)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno1='$v_turno1' WHERE id='$id'");
                  
          }
          else if ($v_turno == 'v_turno2')
          {
           $v_turno2 = intval($v_turno2)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno2='$v_turno2' WHERE id='$id'");
              
          }
          else
          {
           $v_turno3 = intval($v_turno3)+1;
           $sql = $dbcon->query("UPDATE $tabela SET v_turno3='$v_turno3' WHERE id='$id'");
          }         
         } // Fecho else saiu pela balanca 01

         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
         //FAZER MAIS TRATAVIVAS CASO NECESSARIO!
        } // Fecho else de outra condicao sem ser CONCLUIDO, SAINDO DA PLANTA OU CANCELADO
       }
      } // Fecha if($pode_salvar == "sim")
      else
      {
        //PRECISO FAZER O FLUXO COMPLETO, POIS POR ALGUM MOTIVO NAO FOI LIDA NEM NA BALANCA NEM NA MG030
        
        


      } // Fecha else if($pode_salvar == "sim")
     } // Fecha tag cavalo

    } // Fecha if(strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  )  && $ponto == 'Saida Automações'  )


} // fecha if ( $pode_seguir_fluxo == "sim")
else
{
 echo "FIM!"   ;
}






//AGORA NOTIFICACOES NO BETRUCK *************************************************************************************
//AGORA NOTIFICACOES NO BETRUCK *************************************************************************************
//AGORA NOTIFICACOES NO BETRUCK *************************************************************************************
//AGORA NOTIFICACOES NO BETRUCK *************************************************************************************
//AGORA NOTIFICACOES NO BETRUCK *************************************************************************************
//AGORA NOTIFICACOES NO BETRUCK *************************************************************************************

 //Busco os dados do ponto na tabela
 $vponto = "Saida Automações MB";
 include_once 'conexao_saida_automacoes.php';
 $sql = $dbcon->query("SELECT * FROM referencias_betruck WHERE ponto = '$vponto'");
 if(mysqli_num_rows($sql)>0)
 {
  $dados = $sql->fetch_array();
  $sn_reader = $dados['sn_reader'];
  $site = $dados['site'];
  $latitude = $dados['latitude'];
  $longitude = $dados['longitude'];
  $valor_ponto = "ok";
 }
 else
 {
  $valor_ponto = "erro";
 }





 if($valor_ponto != "erro")
 {
 
  
   //  Consulto API BETRUCK ************************************************************************************************************
   //  Consulto API BETRUCK ************************************************************************************************************
   //  Consulto API BETRUCK ************************************************************************************************************
   //  Consulto API BETRUCK ************************************************************************************************************
    $localEvento = "Miguel Burnier";
   
       $curl = curl_init();
       curl_setopt_array($curl, array(
       CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/atual?tagVeiculo='.$epc_betruck,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => '',
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => 'GET',
       CURLOPT_HTTPHEADER => array(
           'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
           'localEvento: '.$localEvento
       ),
       ));
   
       $response = curl_exec($curl);
   
       curl_close($curl);
       $valor = intval(strpos($response,"statusCode"));
       if($valor>0)
       {
           if($epc != "vazio")
           {
            //Preciso salvar a tag pois nao encontrada no sistema do BeTruck
            //include_once 'conexao_dashboard.php';
            //$sql = $dbcon->query("UPDATE dashboard SET tipo='Controle', ponto='Controle 3', data_leitura='$data', hora_leitura='$hora' WHERE id='$id_banco_dashboard'");
           }
       }
       else
       {
        $valor = "Encontrado";
       }
   
   
       //echo $response;
       $jsonObj = json_decode($response);
   
       //DADOS DO MOTORISTA ***********************************************************
       $dados_do_motorista = $jsonObj->motorista;
       $nome_do_motorista = $dados_do_motorista->nome;
       $data_validade_da_cnh = $dados_do_motorista->dataDeValidadeCNH;
       $data_validade_da_cnh = explode("T",$data_validade_da_cnh);
       $data_validade_da_cnh = $data_validade_da_cnh[0];
       $data_validade_da_cnh = explode("-",$data_validade_da_cnh);
       $data_validade_da_cnh = $data_validade_da_cnh[2].'/'. $data_validade_da_cnh[1] . '/' . $data_validade_da_cnh[0];
       $numero_da_cnh = $dados_do_motorista->cnh;
       $numero_do_cpf = $dados_do_motorista->cpf;
       $numero_do_telefone = $dados_do_motorista->telefone;
       $numero_da_tag_do_motorista = $dados_do_motorista->tag;
       $motorista_bloqueado = $dados_do_motorista->motoristaBloqueado;
   
       //DADOS DO VEICULO *************************************************************
       $dados_do_veiculo = $jsonObj->veiculo;
       $dados_cavalo = $dados_do_veiculo[0];
       $dados_carreta = $dados_do_veiculo[1];
       
       
           // TRATANDO DADOS DO CAVALO ****************************************************************
           $tipo_do_cavalo = $dados_cavalo->tipo;
           $rotulo_do_cavalo = $dados_cavalo->rotuloDoTipo;
           $marca_do_cavalo = $dados_cavalo->marca;
           $modelo_do_cavalo = $dados_cavalo->modelo;
           $renavam_do_cavalo = $dados_cavalo->renavam;
           $placa_do_cavalo = $dados_cavalo->placa;
           $chassi_do_cavalo = $dados_cavalo->chassi;
           $capacidade_do_cavalo = $dados_cavalo->capacidade;
           $tag_do_cavalo = $dados_cavalo->tag;
       
           // TRATANDO DADOS DA CARRETA ****************************************************************
           $tipo_da_carreta = $dados_carreta->tipo;
           $rotulo_da_carreta = $dados_carreta->rotuloDoTipo;
           $marca_da_carreta = $dados_carreta->marca;
           $modelo_da_carreta = $dados_carreta->modelo;
           $renavam_da_carreta = $dados_carreta->renavam;
           $placa_da_carreta = $dados_carreta->placa;
           $chassi_da_carreta = $dados_carreta->chassi;
           $capacidade_da_carreta = $dados_carreta->capacidade;
           $tag_da_carreta = $dados_carreta->tag;
       
       
       //DADOS DA viagem atual ********************************************************
       $dados_da_ultima_viagem = $jsonObj->viagem;
       //Dados
       $id_betruck_ultima_viagem = $dados_da_ultima_viagem->id;
       $id_gagf_ultima_viagem = $dados_da_ultima_viagem->idProgramacaoGaGf;
       $contratante_ultima_viagem = $dados_da_ultima_viagem->contratante;
       $fornecedor_ultima_viagem = $dados_da_ultima_viagem->fornecedor;
       $origem_ultima_viagem = $dados_da_ultima_viagem->origem;
       $destino_ultima_viagem = $dados_da_ultima_viagem->destino;
       $transportadora_ultima_viagem = $dados_da_ultima_viagem->transportadora;
       $material_ultima_viagem = $dados_da_ultima_viagem->material;
       $status_ultima_viagem = $dados_da_ultima_viagem->status;
       $peso_bruto_ultima_viagem = $dados_da_ultima_viagem->pesoBruto;
       $peso_liquido_ultima_viagem = $dados_da_ultima_viagem->pesoLiquido;
       $tara_veiculo_ultima_viagem = $dados_da_ultima_viagem->taraVeiculo;
       $veiculo_pesou_ultima_viagem = $dados_da_ultima_viagem->veiculoPesou;
       
       
       /*
       //Imprimindo os dados
       
       echo "Dados do motorista *************************************************</br>";
       echo "Nome do motorista = " . $nome_do_motorista ."</br>";
       echo "Data da validade da CNH = " . $data_validade_da_cnh ."</br>";
       echo "Numero da CNH = " . $numero_da_cnh ."</br>";
       echo "Numero do CPF = " . $numero_do_cpf ."</br>";
       echo "Numero do telefone = " . $numero_do_telefone ."</br>";
       echo "Numero da TAG do motorista = " . $numero_da_tag_do_motorista ."</br>";
       echo "Motorista bloqueado: " . $motorista_bloqueado . "</BR>";
       
       echo "</br></br>";
       
       echo "Dados do cavalo ****************************************************</br>";
       echo "Tipo do cavalo = " . $tipo_do_cavalo ." </br>";
       echo "Rotulo da cavalo = " . $rotulo_do_cavalo ." </br>";
       echo "Marca do cavalo = " . $marca_do_cavalo ." </br>";
       echo "Modelo do cavalo = " . $modelo_do_cavalo ." </br>";
       echo "Renavam do cavalo = " . $renavam_do_cavalo ." </br>";
       echo "Placa do cavalo = " . $placa_do_cavalo ." </br>";
       echo "Chassi do cavalo = " . $chassi_do_cavalo ." </br>";
       echo "Capacidade do cavalo = " . $capacidade_do_cavalo ." </br>";
       echo "EPC do cavalo = " . $tag_do_cavalo  . "</br>";
       
       echo "</br></br>";
       
       echo "Dados da carreta ****************************************************</br>";
       echo "Tipo da carreta = " . $tipo_da_carreta . "</br>";
       echo "Rotulo da carreta = " . $rotulo_da_carreta . "</br>";
       echo "Marca da carreta = " . $marca_da_carreta . "</br>";
       echo "Modelo da carreta = " . $modelo_da_carreta . "</br>";
       echo "Renavam da carreta = " . $renavam_da_carreta . "</br>";
       echo "Placa da carreta = " . $placa_da_carreta . "</br>";
       echo "Chassi da carreta = " . $chassi_da_carreta . "</br>";
       echo "Capacidade da carreta = " . $capacidade_da_carreta . "</br>";
       echo "EPC da carreta = " . $tag_da_carreta . "</br>";
       
       
       echo "</br></br>";
       
       echo "Dados da viagem atual ****************************************************</br>";
       echo "ID BeTruck da viagem atual = " . $id_betruck_ultima_viagem ."</br>";
       echo "ID GAGF da viagem atual = " . $id_gagf_ultima_viagem ."</br>";
       echo "Contratante da viagem atual = " . $contratante_ultima_viagem ."</br>";
       echo "Fornecedor da viagem atual = " . $fornecedor_ultima_viagem ."</br>";
       echo "Origem da viagem atual = " . $origem_ultima_viagem ."</br>";
       echo "Destino da viagem atual = " . $destino_ultima_viagem ."</br>";
       echo "Transportadora da viagem atual = " . $transportadora_ultima_viagem ."</br>";
       echo "Material da viagem atual = " . $material_ultima_viagem ."</br>";
       echo "Status da viagem atual = " . $status_ultima_viagem ."</br>";
       echo "Peso bruto da viagem atual = " . $peso_bruto_ultima_viagem ."</br>";
       echo "Peso liquido da viagem atual = " . $peso_liquido_ultima_viagem ."</br>";
       echo "Tara do veiculo na viagem atual = " . $tara_veiculo_ultima_viagem ."</br>";
       echo "Veiculo pesou na viagem atual = " . $veiculo_pesou_ultima_viagem ."</br>";
       
      */
   
   
   // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
   // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
   // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
   // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
   // FECHO CONSULTA BETRUCK ***************************************************************************************************************************************
   
 
 
 
 
   if($valor == "Encontrado")
   {
    //consulta
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('Y-m-d');
    $hora = date('H:i:s');
    $data_agora = $data . 'T' . $hora.'Z';  //Caso eu queira usar a data de agora PADRAO "2024-05-09T12:26:05Z
    echo "</BR></BR></BR>Entrou para o post no BeTruck";
    
   
   
    echo "Dados";
    echo "SN : " . $sn_reader . "</BR>";
    echo "site : " . $site . "</BR>";
    echo "latitude : " . $latitude . "</BR>";
    echo "longitude : " . $longitude . "</BR>";
    echo "ponto : " . $vponto . "</BR>";
    echo "ID : " . $id_betruck_ultima_viagem . "</BR>";
    echo "data_agora : " . $data_agora . "</BR>";
    echo "CONDICAO: " . $condicao_betruck."</BR>";
    echo "EPC_BETRUCK: " . $epc_betruck ."</BR>";
   
    echo "</BR></BR></BR></BR>";
   




     //AGORA VERIFICO QUAL TIPO DE NOTIFICACAO VOU FAZER ***********************************************************
     //AGORA VERIFICO QUAL TIPO DE NOTIFICACAO VOU FAZER ***********************************************************
     //AGORA VERIFICO QUAL TIPO DE NOTIFICACAO VOU FAZER ***********************************************************
     //AGORA VERIFICO QUAL TIPO DE NOTIFICACAO VOU FAZER ***********************************************************
     //AGORA VERIFICO QUAL TIPO DE NOTIFICACAO VOU FAZER ***********************************************************
     if ( $condicao_betruck == "Liberado!" )
     {
      echo "</BR></BR>Tratando condicao Liberado!";
      /*
      // Crio um evento no BeTruck notificando saida cheia e com processo concluido!, na justificativa coloco que foi acionada por uma tag de carreta
      $justificativa = "Veículo saindo cheio da mina com processo finalizado, ID: " .$id_gagf_ultima_viagem;
      $vponto = $vponto . " - (Carreta)";
      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "Enviar push!",
      "alerta2": "Processo ID:"'.$id_gagf_ultima_viagem.'" finalizado!",      
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
     ));

     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
     */
     if($condicao_betruck == ""){$condicao_betruck = "-";}
     if($epc_betruck == ""){$epc_betruck = "-";}

     date_default_timezone_set('America/Sao_Paulo');
     $vdata = date('d/m/Y');
     $vhora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$vdata','$vhora','pendente')");
     echo "</BR>Rodou</BR>";   

     } // Fecho  if ( $condicao_betruck == "Liberado!" )
     else if ( $condicao_betruck == "Liberado2!" )
     {
      echo "</BR></BR>Tratando condicao Liberado2!";
      /*
      // Crio um evento no BeTruck notificando saida cheia e com processo concluido!, na justificativa coloco que foi acionada por uma tag de cavalo
      $justificativa = "Veículo saindo cheio da mina com processo finalizado, ID: " .$id_gagf_ultima_viagem;
      $vponto = $vponto . " - (Cavalo)";
      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "Enviar push!",
      "alerta2": "Processo ID:"'.$id_gagf_ultima_viagem.'" finalizado!",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
     ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
      */
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      include_once 'conexao_saida_automacoes.php';
      $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");

     } // Fecho  else if ( $condicao_betruck == "Liberado2!" )
     else if ( $condicao_betruck == "Saindo Vazio da Mina!" )
     {
      echo "</BR></BR>Tratando condicao Saindo Vazio da Mina!";
      /*
      // Crio um evento no BeTruck notificando apenas uma saida, na justificativa coloco que foi acionada por uma tag de carreta e veiculo saiu vazio
      $justificativa = "Veículo saindo vazio da mina!";
      $vponto = $vponto . " - (Carreta)";
      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "",
      "alerta2": "",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
     ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
      */
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      include_once 'conexao_saida_automacoes.php';
      $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");

     }  // Fecho else if ( $condicao_betruck == "Saindo Vazio da Mina!" )
     else if ( $condicao_betruck == "Saindo Vazio da Mina2!" )
     {
      echo "</BR></BR>Tratando condicao Saindo Vazio da Mina2!";
      /*
      // Crio um evento no BeTruck notificando apenas uma saida, na justificativa coloco que foi acionada por uma tag de cavalo e veiculo saiu vazio
      $justificativa = "Veículo saindo vazio da mina!";
      $vponto = $vponto . " - (Cavalo)";
      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "",
      "alerta2": "",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
     ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
      */
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      include_once 'conexao_saida_automacoes.php';
      $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");

     } // Fecho else if ( $condicao_betruck == "Saindo Vazio da Mina2!" )    
     else if ( $condicao_betruck == "Carga Descentralizada!" )
     {
      echo "</BR></BR>Tratando condicao Carga Descentralizada!";
      /*
      // Crio um evento de carga descentralizada, solicito o envio do push, mas nao disparo envio do email ainda. Acionado via carreta
      $justificativa = "Veículo com carga descentralizada, necessário retornar ao pátio para ajuste da carga!";
      $vponto = $vponto . " - (Carreta)";
      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "Enviar push!",
      "alerta2": "",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "chave_integracao" : "carga_descentralizada",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
     ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
      */
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      include_once 'conexao_saida_automacoes.php';
      $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");

     } // Fecho else if ( $condicao_betruck == "Carga Descentralizada!" )
     else if ( $condicao_betruck == "Carga Descentralizada2!" )
     {
      echo "</BR></BR>Tratando condicao Carga Descentralizada2!";
      /*
      // Crio um evento de carga descentralizada, solicito o envio do push, mas nao disparo envio do email ainda. Acionado via cavalo
      $justificativa = "Veículo com carga descentralizada, necessário retornar ao pátio para ajuste da carga!";
      $vponto = $vponto . " - (Cavalo)";
      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "Enviar push!",
      "alerta2": "",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "chave_integracao" : "carga_descentralizada",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
     ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
      */
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      include_once 'conexao_saida_automacoes.php';
      $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");

     } // Fecho else if ( $condicao_betruck == "Carga Descentralizada2!" )
     else if ( $condicao_betruck == "Excesso!" )
     {
      echo "</BR></BR>Tratando condicao Excesso!";
      /*
      // Crio um evento de excesso
      $justificativa = "Necessário retornar ao pátio de excessos para completar ou retirar o excesso da carga!";

      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "Enviar push!",
      "alerta2": "Favor retornar ao pátio de excessos para complear ou retirar o excesso da carga!",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
    ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
             */
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d/m/Y');
            $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");
     } // Fecho  else if ( $condicao_betruck == "Excesso!" )
     else if ( $condicao_betruck == "Patrimonial!" )
     {
      echo "</BR></BR>Tratando condicao Patrimonial!";
      /*
      // Crio um evento de excesso
      $justificativa = "Veiculo com alerta de falta de ticket!";

      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "",
      "alerta2": "Favor retornar ao a patrimonial para verificações manuais!",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "chave_integracao" : "alerta_patrimonial",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
    ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
             */
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d/m/Y');
            $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");
     } // Fecho  else if ( $condicao_betruck == "Patrimonial!" )
     else if ( $condicao_betruck == "Patrimonial2!" )
     {
      echo "</BR></BR>Tratando condicao Patrimonial2!";
      /*
      // Crio um evento de excesso
      $justificativa = "Veiculo com alerta de falta de ticket!";

      //Agora faço envio para atualizar historico no BeTruck
      //Agora faço o POST para atualizar o evento do historico
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-public-layer.betruck.com.br/v1/viagem/eventos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
      "idAgendamento": "'.$id_betruck_ultima_viagem.'",
      "idStatus": "1",
      "descricaoStatus": "'.$vponto.'",
      "localEvento": "'.$site.'",
      "latitude": '.$latitude.',
      "longitude": '.$longitude.',
      "dataHoraEvento": "'.$data_agora.'",
      "codigoDocumentoVenda": "",
      "codigoDocumentoFiscal": "",
      "codigoDocumento": "",
      "localCarga": "",
      "localDescarga": "",
      "pesoBruto": "",
      "pesoLiquido": "",
      "taraVeiculo": "",
      "usuario": "",
      "camposDinamicos": 
      {
      "alerta1": "",
      "alerta2": "Favor retornar ao a patrimonial para verificações manuais!",
      "video_bascula": "",
      "video_placa": "",
      "imagem_bascula": "",
      "imagem_placa": "",
      "chave_integracao" : "alerta_patrimonial",
      "justificativa": "'.$justificativa.'",
      "sn_ponto": "'.$sn_reader.'"
      },
      "arquivoDocumento": ""
      }',
      CURLOPT_HTTPHEADER => array(
      'access_token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZFVzZXIiOiIyYTJmOGZhMi1mZDIwLTQ0YTMtYjQzMC01ZDg0MjNiNTY5Y2QiLCJpYXQiOjE3MDI0MTIxMzF9.bI8pYXHp7PTOYombapY-9FSWXZFfQvNsC7IylDDm2jM',
      'localEvento: Miguel Burnier',
      'Content-Type: application/json'
      ),
    ));
     //TRATA LOGS *********************************************************************************************************************************************************
     $response = curl_exec($curl);
     $valor = intval(strpos($response,"statusCode"));
     if($valor>0)
     {
      $condicao = "Erro!";
     }
     else
     {
      $condicao = "Sucesso!";
     }
     curl_close($curl);
     echo $response;
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$response')");
             */
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d/m/Y');
            $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO sincronismo_betruck(condicao,epc,data_executado,hora_executado,tratado)VALUES('$condicao_betruck','$epc_betruck','$data','$hora','pendente')");
     } // Fecho  else if ( $condicao_betruck == "Patrimonial2!" )




/*
     $msg = strval($response);

     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','$msg'");
     include_once 'conexao_saida_automacoes.php';
     $sql = $dbcon->query("INSERT INTO log_api_betruck(epc,data_executado,hora_executado,condicao,response)VALUES('$epc_betruck','$data','$hora','$condicao','-'");
   */
  echo "lllllllllllllll";
   }
   else
   {
     echo "Nao achou betruck";  
   }
 } // Fecha valor ponto != erro
 












?>