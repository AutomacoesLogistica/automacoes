<?php
$id = isset($_GET['id'])?$_GET['id']:"vazio";
$epc_carreta = isset($_GET['epc'])?$_GET['epc']:"vazio";

$encontrado = 0;
echo "Tratando o ID = ". $id . " e a TAG = ". $epc_carreta;
echo "</BR>";
echo "</BR>";echo "</BR>";echo "</BR>";

if($epc_carreta != 'vazio' && $id!= 'vazio')
{
 echo("Entrou para fazer validacao no GAGF!");
 echo "</BR>";
 echo "</BR>";

  //CONSULTA OS DADOS NO GAGF
 $curl = curl_init();
 curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate='.$epc_carreta,
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
  //echo "nao encontrado!";
  //echo $response;
  date_default_timezone_set('America/Sao_Paulo');
  $data3 = date('d/m/Y');
  $hora3 = date('H:i:s');
  //Faço Update
  echo "</BR>";
  echo "Faco, não é uma tag TORA ou FJX! ou nao cadastrada no GAGF! </BR>";
  include_once 'conexao_dashboard.php';
  $sql = $dbcon->query("UPDATE validacoes_tags_tora_fjx SET validado='Erro GAGF',data_validacao='$data3',hora_validacao='$hora3',sigla='Erro GAGF' WHERE id='$id'");
  exit();
 }
 else
 {
  //var_dump($response);echo "</BR>";echo "</BR>";echo "</BR>";
  $encontrado = 1;
  $jsonObj = json_decode($response);
  $jsonObj2 = $jsonObj->scheduleDetail;
  $placaCarreta =  $jsonObj2->placaCarreta;
  $placaCavalo= $jsonObj2->placaCavalo;if($placaCavalo== ""){$placaCavalo= "-";}
  $estadoCavalo= $jsonObj2->estadoCavalo;if($estadoCavalo== ""){$estadoCavalo= "-";}
  $transportadoraCavalo= $jsonObj2->transportadoraCavalo;if($transportadoraCavalo== ""){$transportadoraCavalo= "-";}

  //Corrigir erros de invertido no retorno da API do GAGF ***********************************************************************
  $tipoCarreta=$jsonObj2->tipoCarreta;if($tipoCarreta== ""){$tipoCarreta= "-";}
  $pesquisa   = 'Cavalo';
  $resposta = strpos( $tipoCarreta, $pesquisa );
  if ($resposta === false) 
  {
   echo 'Não encontrado';
  }
  else
  {
   //Esta invertido, preciso alterar
   $antes_placaCavalo = $placaCavalo;
   $antes_placaCarreta = $placaCarreta;
   $placaCavalo = $antes_placaCarreta;
   $placaCarreta = $antes_placaCavalo;
  }
    //**************************************************************************** */
 } // Fecha o pode consultar no gagf

 if($encontrado == 1)
 {
  echo $response;
  echo "</BR>";
  echo "Placa Cavalo = " . $placaCavalo . "</BR>";
  echo "</BR>";
  
  //aqui vai todo o codido
  if($placaCavalo != '-')
  {
   //Consulto e busco a sigla da transportadora
   include_once 'conexao_dashboard.php';
   $sql = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadoraCavalo' ORDER BY id DESC LIMIT 1");
   if(mysqli_num_rows($sql)>0)
   {
    $dados = $sql->fetch_array();
    $sigla_transportadora = $dados['sigla'];
   } 
   echo "</BR>";
   echo "Siga Transportadora = " . $sigla_transportadora . "</BR>";
   
   if($sigla_transportadora =='Tora' || $sigla_transportadora == 'FJX')
   {
    echo "</BR>";
    echo "E uma tag da tora ou FJX</BR>";
    //Faço update
    date_default_timezone_set('America/Sao_Paulo');
    $data2 = date('d/m/Y');
    $hora2 = date('H:i:s');
    if($sigla_transportadora == "")
    {
     $sigla_transportadora = "Nao localizado"; 
    }
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("UPDATE validacoes_tags_tora_fjx SET validado='Sim',data_validacao='$data2',hora_validacao='$hora2',sigla='$sigla_transportadora' WHERE id='$id'");
    
    
    
    //SCRIPT PARA EXCLUIR DUPLICIDADE DE DADOS NO HH2RISK ***************************************************************************
    //SCRIPT PARA EXCLUIR DUPLICIDADE DE DADOS NO HH2RISK ***************************************************************************
    //SCRIPT PARA EXCLUIR DUPLICIDADE DE DADOS NO HH2RISK ***************************************************************************
    //SCRIPT PARA EXCLUIR DUPLICIDADE DE DADOS NO HH2RISK ***************************************************************************
    date_default_timezone_set('America/Sao_Paulo');
    $data_agora = date('d/m/Y');
    $verificar = "nao";
    $faz_insert = "nao";
    //Verifico se existe essa placa no sistema com mais de 1 hora pelo menos
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM validacoes_tags_tora_fjx WHERE (placa_cavalo='$placaCavalo' AND data_insercao='$data_agora')ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     $vv_data = $dados['data_insercao'];
     $vv_hora = $dados['hora_insercao'];
     $verificar = 'sim';
    } 
    
    if($verificar == "sim")
    {
     //Encontrou a mesma placa ja para a data de hoje, agora verifico se tem pelo menos 1 hora, se sim pode publicar novamente
     date_default_timezone_set('America/Sao_Paulo');
     $data1 = date('d/m/Y');
     $hora1 = date('H:i:s');
     $mensagem2 = explode('/',$data1);
     $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
     $data_agora = $mensagem2 . ' ' . $hora1;   
     
     //Trato agora a hora do banco
     $tamanho_data  = intval(strlen($vv_data));
     $tamanho_hora  = intval(strlen($vv_hora));
     if($tamanho_data==10 && $tamanho_hora == 8)
     {
      //Inverte o padrao da hora para efetuar o calculo
      $mensagem = explode('/',$vv_data);
      $mensagem = $mensagem[2].'/'.$mensagem[1].'/'.$mensagem[0];
      $horario_banco = $mensagem . ' ' . $vv_hora; 
      
      //Agora calculo a diferença para ver se tem pelo menos 1 hora 
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
      $w_hora = $mensagem[0];
      $minuto = $mensagem[1];
      $segundo = $mensagem[2];

      if(intval($w_hora)>0)
      {
       //Tem mais de 1 hora da ultima leitura dessa placa, entao pode salvar!
       $faz_insert= "sim";
      }
      else
      {
       //Não tem mais de 1 hora, entao nao pode salvar na lista, pois ira duplicar no sistema do HH2RISK
        $faz_insert = "nao";
      }
     }
     else
     {
      //Tem algum erro com a data e hora salva no banco, entao deixo salvar!
      $faz_insert= "sim";
     }
    } //Fecha o if($verificar == "sim")
    else
    {
     //Não achou dados da placa para o dia, ja deixo fazer insert 
     $faz_insert = "sim"; 
    }

   
    if($faz_insert == "sim")
    {
     //Agora faco insert na outra para publicar
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("INSERT INTO validacoes_feitas_tora_fjx (placa_ou_tag,placa_cavalo,data_insercao,hora_insercao,validado,data_validacao,hora_validacao) VALUES ('$epc_carreta','$placaCavalo','$data2','$hora2','pendente','-','-')");
    }
    
    
   }
   else
   {
    //Faço Delete
    echo "</BR>";
    echo "Update, não é uma tag TORA ou FJX! </BR>";
    date_default_timezone_set('America/Sao_Paulo');
    $data1 = date('d/m/Y');
    $hora1 = date('H:i:s');
    if($sigla_transportadora == "")
    {
     $sigla_transportadora = "Nao localizado"; 
    }
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("UPDATE validacoes_tags_tora_fjx SET validado='Nao e FJX',data_validacao='$data1',hora_validacao='$hora1',sigla='$sigla_transportadora' WHERE id='$id'");
  
   }
   
   exit();
  } // Fecho   if($placaCavalo != '-')
 } // Fecho if($encontrado == 1)
} // Fecho if($epc_carreta != 'vazio' && $id!= 'vazio')
else
 {
  echo "Tag invalida!";   
  exit();
}














?>