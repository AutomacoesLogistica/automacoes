<?php



$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';
echo  $epc;
echo '</BR>';
$encontrado = 0;
$ponto = '';

$tentativa = 0;

if($epc != 'vazio')
{
    $v_epc = substr($epc,0,6);
    //echo $v_epc;  
    if($v_epc == '442001')
    {
      //Procuro por tag de cavalo
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM historico_display WHERE (epc_cavalo='$epc' AND condicao1='Aguardando') ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $encontrado = 1;   
       $dados = $sql->fetch_array();
       $id = $dados['id'];
       $placa_cavalo = $dados['placa_cavalo'];
       $placa_carreta = $dados['placa_carreta'];
      }
      mysqli_close();
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
    }
    else
    {
     //Procuro por tag carreta
     include_once 'conexao.php';
     $sql = $dbcon->query("SELECT * FROM historico_display WHERE (epc_carreta='$epc' AND condicao1='Aguardando') ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $encontrado = 1;   
      $dados = $sql->fetch_array();
      $id = $dados['id'];
      $placa_cavalo = $dados['placa_cavalo'];
      $placa_carreta = $dados['placa_carreta'];
      $ponto = $dados['ponto'];
     }
     mysqli_close(); 
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
    }
    
    
    if($encontrado == 1)
    {
      //Pode continuar
      echo $id;
      //Faço update falando que estou tratando
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      
      //Atualizo que esta tratando!
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE historico_display SET condicao1='Tratando!',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id'");
      mysqli_close();
      //Consulto via API
      //######################################################################################################

      for ($x = 0; $x <= 2; $x++) 
      {
       $curl = curl_init();
       curl_setopt_array($curl, array(
         CURLOPT_URL => 'https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate='.$epc,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => '',
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => 'GET',
         CURLOPT_HTTPHEADER => array(
           'Authorization: Basic c2VydmljZV9hcGlfc2NoZWR1bGU6TWluQDMyMU1pbkA='
         ),
       ));
      $response = curl_exec($curl);
      curl_close($curl);
      if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
      {
       if( $tentativa >=2)
       {
        //echo "nao encontrado!";
        $tentativa = -1;
        include_once 'conexao.php';
        $sql = $dbcon->query("UPDATE historico_display SET condicao1='Erro API',motorista='$response',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id'");
        mysqli_close();
        exit();//Fecha pagina
       }
       else
       {
        //echo "Tentando novamente!";
       } 
       $tentativa = intval($tentativa)+1;
       
      
      }
      else
      {
        //achou e pode sair
        break;
        $tentativa = 0;
      }
     } // fecha o for


      if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
      {
       //Nao encontrado
       exit(); // Fecha a pagina!
      }
      else
      {
       //encontrou> salvo o retorno da API no processo
       include_once 'conexao.php';
       $sql = $dbcon->query("UPDATE historico_display SET retorno_api='$response' WHERE id='$id'");
       mysqli_close(); 
       
       $jsonObj = json_decode($response);
       $jsonObj2 = $jsonObj->scheduleDetail;
       $statusProcesso = $jsonObj2->statusProcesso;
       $material = $jsonObj2->material;
       $idProcessoGagf = $jsonObj2->idProcessoGagf;
       $idProcessoGscs = $jsonObj2->idProcessoGscs;
       $destino = $jsonObj2->destino;
       $nome_completo = $jsonObj2->nome;
       $nome_reduzido = explode(" ",$nome_completo);
       $nome_reduzido = $nome_reduzido[0];
      
       /*
      //echo $response;
      //echo ("</BR></BR></BR></BR>");
      echo($statusProcesso);
      echo("</BR>");
      echo($nome_completo);
      echo("</BR>");
      echo($nome_reduzido);
      echo("</BR>");
      echo($material);
      echo("</BR>");
      echo($idProcessoGagf);
      echo("</BR>");
      echo($idProcessoGagf);
      echo("</BR>");
      echo($destino);
      */
      
      }
      $nome_reduzido = strtolower($nome_reduzido); // Coloca o nome todo em minusculo
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
      //######################################################################################################



       if($statusProcesso == "Concluído")
       {
        //Verifico a condicao no cheio/vazio
        

        for ($i = 0; $i<2;$i++) //enviar 2 vezes
        {
         //Atualizo o display
         include_once 'conexao.php';
         $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',ponto='$ponto' WHERE id='1'");
         mysqli_close();
        }
        for ($i = 0; $i<3;$i++) //enviar 3 vezes
        {
         // Falta verifar carga descentralizada!
         include_once 'conexao.php';
         $sql = $dbcon->query("UPDATE historico_display SET condicao1='$statusProcesso',tratado_por_segurpro='Não necessário!',tratado_por_ccl='Não necessário!',gagf='$idProcessoGagf',gscs='$idProcessoGscs',motorista='$nome_completo',material='$material',destino='$destino',concluido='Sim',data_aqui1='$data',hora_aqui1='$hora' WHERE id='$id'");
         mysqli_close();
        }
        
       }
       else
       {
         //Processo não esta concluido, agora tenho que verificar se é um excesso ou possível desvio de carga!
        
        
        if ($ponto == 'balanca') //******************************************************************************************************************************************************************************* */
        {
        //Como veio da balança 1, ja sugiro ser um excesso! 
        //Enviar para a tela de excesso e aguardar confirmação!

        //Atualizo o display
        include_once 'conexao.php';
        $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',ponto='$ponto' WHERE id='1'");
        mysqli_close();

        //Limpar Display **********************
        sleep(4);
        include_once 'conexao.php';
        $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='Aguardando_veiculo!',mensagem2='___________________',mensagem_aux='_______',ponto='$ponto' WHERE id='1'");
        mysqli_close();

        

        }
        else
        { // MG030
        
          //Atualizo display       
          include_once 'conexao.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='___Tenha_uma_boa___',mensagem2='$nome_reduzido',mensagem_aux='$placa',ponto='$ponto' WHERE id='1'");
          mysqli_close();

          //Limpar Display **********************
          sleep(4);
          include_once 'conexao.php';
          $sql = $dbcon->query("UPDATE display_balanca1 SET mensagem1='Aguardando_veiculo!',mensagem2='___________________',mensagem_aux='_______',ponto='$ponto' WHERE id='1'");
          mysqli_close();

        }
      
      }
      
    
    
    
    
    } // fecha  if($encontrado == 1)




    else
    {
     //Existe uma tag porem nao detectada antes,somente nesse ponto, precisa salvar para ser tratada!
     //Primeiro so verifico se é diferente do ultimo evento salvo em status diferente de concluido!
     include_once 'conexao.php';
     $v_epc = substr($epc,0,6);
     $status = '';
     $encotnrado = 0;
     $pode_inserir = 0;

     if($v_epc == '442001')
     {
      $sql = $dbcon->query("SELECT * FROM historico_display WHERE  epc_cavalo='$epc' ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $status = $dados['condicao1'];
       $encontrado = 1;
      }
      mysqli_close();
     }
     else
     {
      $sql = $dbcon->query("SELECT * FROM historico_display WHERE  epc_carreta='$epc' ORDER BY id DESC LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $status = $dados['condicao1'];
       $encontrado = 1;
      }
      mysqli_close();
     }

     if($encontrado == 1)
     {
      if ($status == 'Tratando') // DEPOIS FILTRAR AS DEMAIS CONDICOES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
      {
        $pode_inserir = 0;
      }
     }
     else
     {
      $pode_inserir = 1; // Deixa salvar!
     }

     if($pode_inserir == 1)
     {
        //Agora verifico novamente se é cavalo ou carreta
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/Y');
        $hora = date('H:i:s');
        $placa = '--';
        //Busco na lista de tags qual a placa
        include_once 'conexao.php';
        $sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$epc' LIMIT 1");
        if(mysqli_num_rows($sql)>0)
        {
          $dados = $sql->fetch_array();
          $placa = $dados['placa'];
        }
        mysqli_close();
        if($placa == ' ')
        {
          //Nao encontrado, ai preciso buscar e inserir essa tag via API GAGF
          
          //Nao encontrado, ai preciso buscar e inserir essa tag via API GAGF
          
          //Nao encontrado, ai preciso buscar e inserir essa tag via API GAGF
          
          //Nao encontrado, ai preciso buscar e inserir essa tag via API GAGF
          
          //Nao encontrado, ai preciso buscar e inserir essa tag via API GAGF
          
          //Nao encontrado, ai preciso buscar e inserir essa tag via API GAGF

          //Nao encontrado, ai preciso buscar e inserir essa tag via API GAGF
          $placa = '--';//Por enquanto
        }
        

        $v_epc = substr($epc,0,6);
        //echo $v_epc;  
        if($v_epc == '442001')
        {
          //Tag de cavalo
          //Agora vefirico se foi realizado match
          include_once 'conexao.php';
          $encontrado = 0;
          $epc2 = '--';
          $placa2 = '--';
          $sql = $dbcon->query("SELECT * FROM historico_match WHERE epc_cavalo='$epc' ORDER BY id DESC LIMIT 1");
          if(mysqli_num_rows($sql)>0)
          {
          $encontrado = 1; 
          $dados = $sql->fetch_array();
          $epc2 = $dados['epc_carreta'];
          $placa2 = $dados['placa_carreta'];
          }
          mysqli_close();
          
          include_once 'conexao.php';
          $sql = $dbcon->query("INSERT INTO historico_display(epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,data_aqui1,hora_aqui1,condicao1)VALUES('$epc','$placa','$epc2','$placa2','Saida Automacao','$data','$hora','Tratando')");
        }
        else
        {
          //Tag de carreta
          //Agora vefirico se foi realizado match
          include_once 'conexao.php';
          $encontrado = 0;
          $epc2 = '--';
          $placa2 = '--';
          $sql = $dbcon->query("SELECT * FROM historico_match WHERE epc_carreta='$epc' ORDER BY id DESC LIMIT 1");
          if(mysqli_num_rows($sql)>0)
          {
          $encontrado = 1; 
          $dados = $sql->fetch_array();
          $epc2 = $dados['epc_cavalo'];
          $placa2 = $dados['placa_cavalo'];
          }
          mysqli_close();
          
          include_once 'conexao.php';
          $sql = $dbcon->query("INSERT INTO historico_display(epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,data_aqui1,hora_aqui1,condicao1)VALUES('$epc2','$placa2','$epc','$placa','Saida Automacao','$data','$hora','Tratando')");
        }

        //Agora continuar as validacoes aqui
          
        //Consulto via API

        //Atualizo os valores

        //Atualizo o display
      } // Fecha o pode_inserir == 1 
    }
}
else
{
  echo 'erro';  
}
exit();

?>