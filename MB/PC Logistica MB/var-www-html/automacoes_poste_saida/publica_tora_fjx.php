<?php

$publica = "sim"; // Mudar para sim caso queira que publique no sistema tora

//$end_point_tora ='http://186.235.193.170:1880/tora_fjx/'; 
//$end_point_tora ='http://168.138.250.157/ws_rest/public/api/viagem'; // Homologacao
$end_point_tora ='https://sistemas.hh2risk.com.br/ws_rest/public/api/viagem'; //Producao   

$epc = isset($_GET['epc'])?$_GET['epc']:'vazio';
$id = isset($_GET['id'])?$_GET['id']:'0';

echo "Pesquisando pelo ID = ".$id;
echo "</BR>";
echo "Pesquisando pela TAG = " .$epc;
echo "</BR>";
echo "</BR>";
echo "<************************************************************************8/BR>";

//Primeiro busco a ultima tag validade para saber se é diferente dessa
include_once 'conexao.php';
$encontrado = 0;
$ultima_epc = '';
$sql = $dbcon->query("SELECT * FROM validacoes_feitas_tora_fjx ORDER BY id DESC LIMIT 2");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  $encontrado = intval($encontrado)+1;
  if(intval($encontrado) == 2)    
  {
    $ultima_epc = $dados['placa_ou_tag'];
    $id_ultima_epc = $dados['id'];    
  }  
 }
}
echo "Penultima EPC = " . $ultima_epc . " com ID = " . $id_ultima_epc ;
echo "</BR>";
echo "</BR>";echo "</BR>";

if( $ultima_epc != $epc)
{
 //Pode seguir   
 if($epc != 'vazio')
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
  //echo $response;
  if($response == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
  {
  //echo "nao encontrado!";
  exit();
  }
  else
  {
    //TRATO OS DADOS DO VEICULO
    $jsonObj = json_decode($response);
    $jsonObj2 = $jsonObj->scheduleDetail;

    $statusProcesso = $jsonObj2->statusProcesso;if($statusProcesso== ""){$statusProcesso= "-";}
    $celular = $jsonObj2->celular;
    if($celular == ""){$celular = "-";}else{$vcelular = explode(' ',$celular);$celular = "+".$vcelular[0] ." (" . substr($vcelular[1],0,2) . ") " . substr($vcelular[1],2,5) .'-' . substr($vcelular[1],7,11);}
    $cnh= $jsonObj2->cnh;if($cnh== ""){$cnh= "-";}
    $cpf= $jsonObj2->cpf;if($cpf== ""){$cpf= "-";}
    $email = '-';
    $nome = $jsonObj2->nome;
    $origem= $jsonObj2->origem;if($origem== ""){$origem= "-";}
    $destino = $jsonObj2->destino;if($destino== ""){$destino= "-";}
    $rota= $jsonObj2->rota;if($rota== ""){$rota= "-";}
    $material = $jsonObj2->material;if($material== ""){$material= "-";}
    $estoque= $jsonObj2->estoque;if($estoque== ""){$estoque= "-";}
    $idProcessoGagf = $jsonObj2->idProcessoGagf;
    $idProcessoGscs = $jsonObj2->idProcessoGscs;
    $ticket= $jsonObj2->ticket;if($ticket =="" || $ticket=="-" || $ticket =='0'){$ticket = 'Não identificado!';}
    $nomination= $jsonObj2->nomination;if($nomination== ""){$nomination= "-";}
    $pesoBruto= $jsonObj2->pesoBruto;if($pesoBruto== ""){$pesoBruto= "-";}else{$pesoBruto = $pesoBruto;} // OBS: Nao colocar KG pois ira ser salvo em banco para realizar contar posteriormete
    $pesoMaterialCarregado= $jsonObj2->pesoMaterialCarregado;if($pesoMaterialCarregado== ""){$pesoMaterialCarregado= "-";}else{$pesoMaterialCarregado = $pesoMaterialCarregado;}
    $tempoDeslocamento= $jsonObj2->tempoDeslocamento;if($tempoDeslocamento== ""){$tempoDeslocamento= "-";}
    $tipoConjunto=$jsonObj2->tipoConjunto;if($tipoConjunto== ""){$tipoConjunto= "-";}
    $placaCavalo= $jsonObj2->placaCavalo;if($placaCavalo== ""){$placaCavalo= "-";}
    $estadoCavalo= $jsonObj2->estadoCavalo;if($estadoCavalo== ""){$estadoCavalo= "-";}
    $transportadoraCavalo= $jsonObj2->transportadoraCavalo;if($transportadoraCavalo== ""){$transportadoraCavalo= "-";}
    $placaCarreta= $jsonObj2->placaCarreta;if($placaCarreta== ""){$placaCarreta= "-";}
    $estadoCarreta= $jsonObj2->estadoCarreta;if($estadoCarreta== ""){$estadoCarreta= "-";}
    $transportadoraCarreta= $jsonObj2->transportadoraCarreta;if($transportadoraCarreta== ""){$transportadoraCarreta= "-";}
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    $dataPrevisaoCarga = $data . ' ' . $hora; 
    $situacao = 'Saindo de Várzea do Lopes';


    echo ("</BR></BR></BR></BR>");
    echo ('Situacao = '.$situacao);echo('</BR>');
    echo('Status = ' .$statusProcesso);echo("</BR>");
    echo('Celular = ' .$celular);echo("</BR>");
    echo('CNH = ' .$cnh);echo("</BR>");
    echo('CPF = ' .$cpf);echo("</BR>");
    echo('Nome = ' .$nome);echo("</BR>");
    echo('Origem = ' .$origem);echo("</BR>");
    echo('Destino = ' .$destino);echo("</BR>");
    echo('Rota = ' .$rota);echo("</BR>");
    echo('Material = ' .$material);echo("</BR>");
    echo('Estoque = ' .$estoque);echo("</BR>");
    echo('Data Validacao = ' . $dataPrevisaoCarga);echo("</BR>");
    echo('Numero Processo GAGF = ' .$idProcessoGagf);echo("</BR>");
    echo('Numero Processo GSCS = ' .$idProcessoGscs);echo("</BR>");
    echo('Ticket = ' .$ticket);echo("</BR>");
    echo('Nomination = ' .$nomination);echo("</BR>");
    echo('Peso Bruto = ' .$pesoBruto);echo("</BR>");
    echo('Peso Liquido = ' .$pesoMaterialCarregado);echo("</BR>");
    echo('Tipo Conjunto = ' .$tipoConjunto);echo("</BR>");
    echo('Placa Carreta = ' .$placaCarreta);echo("</BR>");
    echo('Estado Carreta = ' .$estadoCarreta);echo("</BR>");
    echo('Transportadora Carreta = ' .$transportadoraCarreta);echo("</BR>");
    echo('Placa Cavalo = ' .$placaCavalo);echo("</BR>");
    echo('Estado Cavalo = ' .$estadoCavalo);echo("</BR>");
    echo('Transportadora Cavalo = ' .$transportadoraCavalo);echo("</BR>");
    echo "</BR>";echo "</BR>";echo "</BR>";

    echo "Agora vou verificar a condicao da placa no HH2RISK";
    echo "</BR>";

if($publica == "sim")
{

//   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK
//   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK
//   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK
//   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK
//   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK  *****   HH2RISK

    //    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****
    //    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****
    //    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****
    //    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****    PLACA *****
    $placa_hh2risk = "nok";
    //Agora verifico se a placa desejada se encontra cadastrada no hh2risk
    $curl = curl_init();
    curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://sistemas.hh2risk.com.br/ws_rest/public/api/veiculo/'.$placaCavalo,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'GET',
     CURLOPT_HTTPHEADER => array('Content-Type: application/json','User-Agent: cpprestsdk/2.9.0','Authorization: Basic aW50ZWdyYWNhby5nZXJkYXU6aW50ZTIwMjI='),));
    $response = curl_exec($curl);
    curl_close($curl);
    if($response =='{"veiculo":null}')
    {
     echo("Placa não encontrada no sistema!</BR>");
     //Cadastro ela no banco para posteriormente enviar para eles
     //Verifico se a placa ja nao esta na lista primeiro
     include_once 'conexao.php';
     $encontrado = 0;
     $sql = $dbcon->query("SELECT * FROM hh2risk_cadastro_placas WHERE placa='$placaCavalo' LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $encontrado = 1;  
     }
     if($encontrado == 0)
     {
      //Preciso cadastrar!
      include_once 'conexao.php';
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      $sql = $dbcon->query("INSERT INTO hh2risk_cadastro_placas(placa,data_validacao,hora_validacao)VALUES('$placaCavalo','$data','$hora')");
     }
    }
    else
    {
     //Esta castrastada e encontrou



     $placa_hh2risk = "ok";
     //echo($response);
     $jsonObj = json_decode($response,false);
     $jsonObj2 = $jsonObj->veiculo;
     $codigo = $jsonObj2->codigo;
     $placa = $jsonObj2->placa;
     $frota = $jsonObj2->frota;
     $tipo_veiculo = $jsonObj2->tipo_veiculo;
     $documento_proprietario = $jsonObj2->documento_proprietario;
     $modelo = $jsonObj2->modelo;
     $marca = $jsonObj2->marca;
     $ano_modelo = $jsonObj2->ano_modelo;
     $ano_fabricacao = $jsonObj2->ano_fabricacao;
     $cor = $jsonObj2->cor;
     $condicao = $jsonObj2->status;
     if($condicao =="1")
     {
      $condicao = "Ativo";     
     }
     else if($condicao =="0")
     {
      $condicao = "Desativado"; 
     }
     else
     {
      $condicao = '';   
     }
     $terminais = $jsonObj2->terminais;
     $numero = strval(json_encode($terminais));
     $tec = json_decode($numero);
     $tecc = $tec[0];
     $v = json_encode($tecc);
     $valor = $v;
     $b = json_decode($valor);
     $numero = $b->numero;
     $tecnologia = $b->tecnologia;
    
     echo ("Placa encontrada no sistema!</BR>");
     echo ("</BR>");
     echo "Numero = " . $numero;
     echo ("</BR>");
     echo "Tecnologia = " . $tecnologia;
     echo ("</BR>");
     //Agora verifico se o veiculo esta na lista de cadastro, se sim, tenho que apagar!
     include_once 'conexao.php';
     $encontrado = 0;
     $sql = $dbcon->query("SELECT * FROM hh2risk_cadastro_placas WHERE placa='$placaCavalo' LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $encontrado = 1;
      $dados = $sql->fetch_array(); 
      $id_placa = $dados['id'];
     }
     if($encontrado ==1)
     {
      //Preciso apagar, pois era um cadastro pendente e preciso retirar, pois a turma do hh2risk ja cadastrou ele!
      $sql = $dbcon->query("DELETE FROM hh2risk_cadastro_placas WHERE id='$id_placa'");
     }

     
    } // Fecha o else

    echo "</BR>";echo "</BR>";
    echo "Agora vou verificar a condicao do CPF no HH2RISK";
    echo "</BR>";
    //   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****
    //   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****
    //   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****
    //   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****
    //   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****   MOTORISTA  *****
    $motorista_hh2risk = "nok";
    $v_cpf = $cpf;
     
    if($v_cpf != "vazio")
    {
     echo 'Iniciando a pesquisa:</BR>';   
        $curl = curl_init();   
     curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sistemas.hh2risk.com.br/ws_rest/public/api/motorista?CPF='.$v_cpf,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array('Content-Type: application/json','User-Agent: cpprestsdk/2.9.0','Authorization: Basic aW50ZWdyYWNhby5nZXJkYXU6aW50ZTIwMjI='),));
     $response = curl_exec($curl);
     curl_close($curl);
     echo "</BR>"; 
     echo $response;
     echo "</BR>"; 

     if($response =='{"motorista":null}')
     {
      echo "cpf não encontrado no sistema HH2RISK!</BR>";
      //Verifico se nao ja esta na lista pendente!
      include_once 'conexao.php';
      $encontrado = 0;
      $sql = $dbcon->query("SELECT * FROM hh2risk_cadastro_motoristas WHERE motorista='$nome' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $encontrado = 1;
       $dados = $sql->fetch_array(); 
      }
      if($encontrado ==1)
      {
        //Nao faz nada, pois ja esta na lista!
      }
      else
      {
       //Preciso cadastrar!
       include_once 'conexao.php';
       date_default_timezone_set('America/Sao_Paulo');
       $data = date('d/m/Y');
       $hora = date('H:i:s');
       $sql = $dbcon->query("INSERT INTO hh2risk_cadastro_motoristas(motorista,data_validacao,hora_validacao)VALUES('$nome','$data','$hora')");
       $motorista_hh2risk = "nok";
      }
     } //Fecha if($response =='{"motorista":null}')
     else
     {
      echo "CPF encontrado no HH2RISK";
    echo "</BR>";
       
      $jsonObj = json_decode($response,false);
      $jsonObj3 = $jsonObj->motorista;
      $msg = $jsonObj3;
      $n = strval(json_encode($msg));
      $tec = json_decode($n);
      $tecc = $tec[0];
      $v = json_encode($tecc);
      $valor = $v;
      $jsonObj2 = json_decode($valor);
      $codigo = $jsonObj2->codigo;
      $cpf = $jsonObj2->cpf_motorista;
      $nome2 = $jsonObj2->nome;
      $trasnportador = $jsonObj2->transportador;
      $n = strval(json_encode($trasnportador));
      $tec = json_decode($n);
      $tecc = $tec[0];
      $v = json_encode($tecc);
      $valor = $v;
      $b = json_decode($valor);
      $documento_transportador = $b->documento_transportador;
      $vinculo_contratual = $b->vinculo_contratual;

      //Motorista encontrado no sistema HH2Risk
      $motorista_hh2risk = "ok";

      //Agora verifico se ele esta na lista de pendente de cadastro, se sim, preciso removê-lo pois ja foi cadastrado
      include_once 'conexao.php';
      $encontrado = 0;
      $sql = $dbcon->query("SELECT * FROM hh2risk_cadastro_motoristas WHERE motorista='$nome' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $encontrado = 1;
       $dados = $sql->fetch_array(); 
       $id_motorista = $dados['id'];

      }
      if($encontrado ==1)
      {
       //Preciso apagar, pois era um cadastro pendente e preciso retirar, pois a turma do hh2risk ja cadastrou ele!
       $sql = $dbcon->query("DELETE FROM hh2risk_cadastro_motoristas WHERE id='$id_motorista'");
      }
     }
    }
    else
    {
     echo "CPF não é válido!";   
     $motorista_hh2risk = "nok";
    }
    
    
    if($placa_hh2risk == "ok" && $motorista_hh2risk == "ok")
    {
     echo "</BR>";echo "</BR>";
     echo "Pode fazer a publicacao no sistema HH2RISK";   
     echo "</BR>";echo "</BR>";echo "</BR>";echo "</BR>";
     //Pode fazer publicacao da rota para o sistema HH2RISK
     //Conecto e busco os dados de latitude e longitude em funcao da rota
     $encontrado = 0;
     $origem_latitude = "";
     $origem_longitude = "";
     $destino_latitude = "";
     $destino_longitude = "";
     $cod_hh2risk = "";
     include_once 'conexao.php';
     $sql = $dbcon->query("SELECT * FROM rotas WHERE rota='$rota' LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $encontrado = 1; 
      $dados = $sql->fetch_array();
      $origem_latitude = $dados['origem_latitude'];
      $origem_longitude = $dados['origem_longitude'];
      $destino_latitude = $dados['destino_latitude'];
      $destino_longitude = $dados['destino_longitude'];
      $cod_hh2risk = $dados['cod_hh2risk'];
     }
     if($encontrado == 0)
     {
      //Cadastro rota default
      //para VL para evitar erros!
      $origem_latitude = "-20.2955510";
      $origem_longitude = "-43.9386160";
      $destino_latitude = "-20.2955540";
      $destino_longitude = "-43.9386190";
     }

     if($cod_hh2risk =="" || $cod_hh2risk == "-")
     {
        $cod_hh2risk = 'vazio';  
     }
        
     
     // ADEQUACAO PROVISORIA PARA BUSCAR DOCUMENTO TRANSPORTADOR *****************************************************************************************
     $documento_transportador = '' ; // LIMPO QUALQUER COISA QUE TIVER NESSE VINDA DE API E BUSCO A QUE ESTA NO BANCO
     //Agora verifico qual transportadora pertence e altero o valor na variavel $v_transportadora
     if($frota== "FJX")
     {
      $v_transportadora = "FJX TRANSPORTES LTDA";
     }
     else if ($frota == "TORA GD")
     {
      $v_transportadora = "TORA TRANSPORTES (OP GERDAU)";
     }

     include_once 'conexao.php';
     $sql = $dbcon->query("SELECT * FROM documentos_transportador WHERE transportadora='$v_transportadora' LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $documento_transportador = $dados['numero_documento'] ;
     }

     //********************************************************************************************************************************************************



     if($cod_hh2risk != 'vazio')
     {
     $curl = curl_init();
     curl_setopt_array($curl, array(
      CURLOPT_URL => $end_point_tora,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{ 
         "viagem": [
              {
                  "documento_transportador": "'.$documento_transportador.'",
                  "viag_ttra_codigo": 1,
                  "veiculos": [
                      {
                          "placa": "'.$placaCavalo.'"
                      }
                  ],
                  "motoristas": [
                      {
                          "cpf_moto": "'.$cpf.'"
                      }
                  ],
                  "viag_pgpg_codigo": "73",
                  "viag_peso_total": "'.$pesoMaterialCarregado.'",
                  "rota_codigo": "'.$cod_hh2risk.'",
                  "viag_numero_manifesto": "'.$idProcessoGagf.'"             
              }
          ]
      }',
      CURLOPT_HTTPHEADER => array('Content-Type: application/json','User-Agent: cpprestsdk/2.9.0','Authorization: Basic aW50ZWdyYWNhby5nZXJkYXU6aW50ZTIwMjI='),));
     $response3 = curl_exec($curl);
     curl_close($curl);
     echo "</BR>";
     echo "</BR>";
     echo "</BR>";
     echo "Resposta do HH2RISK apos tentativa de insercao da rota";
     echo "</BR>";     
     echo $response3;
     } // Fecha if $cod_hh2risk != 'vazio'
     else
     {
        $cod_hh2risk = 'verificar';  
     }

    } // Fecho if($placa_hh2risk == "ok" && $motorista_hh2risk == "ok")




 } // fecha publica == "sim" 
  
    if($id !='0')
    {
        echo "</BR>"; 
        echo "Entrou para validar o UPDATE!";
        echo "</BR>"; 
     //Atualizo a tag para tratado!
     date_default_timezone_set('America/Sao_Paulo');
     $data5 = date('d/m/Y');
     $hora5 = date('H:i:s');
     include_once 'conexao.php'; 
     $sql = $dbcon->query("UPDATE validacoes_feitas_tora_fjx SET  placa_cavalo='$placaCavalo',validado='Tratado',data_validacao='$data5',hora_validacao='$hora5',origem_latitude='$origem_latitude',origem_longitude='$origem_longitude',destino_latitude = '$destino_latitude',destino_longitude='$destino_longitude',peso_liquido='$pesoMaterialCarregado',cod_hh2risk='$cod_hh2risk',resposta_hh2risk = '$response3' WHERE id='$id'");
     echo "</BR>";
     echo 'Modificado o dado OK' ;
    }
   } //  Fecho o TRATO OS DADOS DO VEICULO

}// Fecho o if($epc != 'vazio')
else
{
 echo 'erro' ;
}

}
else
{
 //Mesma tag, nao faz nada!
 echo " É a mesma tag, ignoro!";
}
?>