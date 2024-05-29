<?php
$publicar = 1; //Se em 1 permite publicar na tela, 0 bloqueia


$id_get = isset($_GET['id'])?$_GET['id']:"vazio";
$epc_carreta = isset($_GET['epc'])?$_GET['epc']:"vazio";

$encontrado = 0;
$pode_salvar = 'nao';
$epcs = array();
$ultima_epc = '';

if($epc_carreta != 'vazio')
{
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM historico_validacoes ORDER BY id DESC LIMIT 10");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   { 
    $encontrado = intval($encontrado)+1;
    $v_epc = trim($dados['placa_ou_tag']);
    if($encontrado == 1){$ultima_epc = trim($v_epc);}
    $epcs[$encontrado] = trim($v_epc);
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
    include_once 'conexao.php';
    $pode_salvar = "sim";
    }   
   }
   else
   {
     //echo 'Igual a ultima, nao podendo ser salvo!';
     $pode_salvar = "nao";
   }


  if($publicar == 1)
  {
    echo "Pode salvar = " . $pode_salvar;
    echo"</BR>";
  }

  if($pode_salvar == "sim")
  {
  //echo $epc_carreta;echo '</BR>';echo '</BR>';echo '</BR>';

  date_default_timezone_set('America/Sao_Paulo');
  $data_validacao = date('d/m/Y');
  $hora_validacao = date('H:i:s');  
  
  //Atualizo avisando que foi tratado!
  include_once 'conexao.php';
  $sql = $dbcon->query("INSERT INTO validacoes_feitas2 (placa_ou_tag,validado,data_validacao,hora_validacao) VALUES ('$epc_carreta','Sim','$data_validacao','$hora_validacao')");
  

  //Agora atualizo a lista das ultimas 5 tratadas no historico validacoes
  //Primeiro busco o primeiro ID encontrado, ele sera descartado
  //Consulto e busco a sigla da transportadora
  include_once 'conexao.php';
  $sql = $dbcon->query("SELECT * FROM historico_validacoes ORDER BY id ASC LIMIT 1");
  if(mysqli_num_rows($sql)>0)
  {
   $dados = $sql->fetch_array();
   $id_descartar = $dados['id'];
  }

  if($publicar == 1)
  {
    echo "ID a descartar = " . $id_descartar;
    echo "</BR>";
  }
  //Agora apago essa linha para sempre mantermos apenas 10 eventos e ao salvar ficar os 11, sendo na proxima filtar os 10 ultimos
  include_once 'conexao.php';
  $sql = $dbcon->query("DELETE FROM historico_validacoes WHERE id='$id_descartar'");


  //Agora insiro o dado na tabela a ultima epc, sendo a pesquisada no momento
  include_once 'conexao.php';
  $sql = $dbcon->query("INSERT INTO historico_validacoes (placa_ou_tag,validado,data_validacao,hora_validacao) VALUES ('$epc_carreta','Sim','$data_validacao','$hora_validacao')");
  


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
}
else
{
 //var_dump($response);echo "</BR>";echo "</BR>";echo "</BR>";

$encontrado = 1;
$jsonObj = json_decode($response);
$jsonObj2 = $jsonObj->scheduleDetail;

$statusProcesso = $jsonObj2->statusProcesso;if($statusProcesso== ""){$statusProcesso= "-";}
$celular = $jsonObj2->celular;
if($celular == ""){$celular = "-";}else{$vcelular = explode(' ',$celular);$celular = "+".$vcelular[0] ." (" . substr($vcelular[1],0,2) . ") " . substr($vcelular[1],2,5) .'-' . substr($vcelular[1],7,11);}
$cnh= $jsonObj2->cnh;if($cnh== ""){$cnh= "-";}
$cpf= $jsonObj2->cpf;if($cpf== ""){$cpf= "-";}
$email = '-';
$nome = $jsonObj2->nome;$nome_reduzido = explode(" ",$nome_completo);$nome_reduzido = $nome_reduzido[0];
$origem= $jsonObj2->origem;if($origem== ""){$origem= "-";}
$destino = $jsonObj2->destino;if($destino== ""){$destino= "-";}
$rota= $jsonObj2->rota;if($rota== ""){$rota= "-";}
$material = $jsonObj2->material;if($material== ""){$material= "-";}
$estoque= $jsonObj2->estoque;if($estoque== ""){$estoque= "-";}
$dataPrevisaoCarga= $jsonObj2->dataPrevisaoCarga;if($dataPrevisaoCarga== ""){$dataPrevisaoCarga= "-";}
$idProcessoGagf_pai = '-';
$idProcessoGscs_pai = '-';
$idProcessoGagf_filho= $jsonObj2->idProcessoGagf;if($idProcessoGagf_filho== ""){$idProcessoGagf_filho= "-";}
$idProcessoGscs_filho= $jsonObj2->idProcessoGscs;if($idProcessoGscs_filho== ""){$idProcessoGscs_filho= "-";}
$ticket= $jsonObj2->ticket;if($ticket =="" || $ticket=="-" || $ticket =='0'){$ticket = 'Não identificado!';}
$nomination= $jsonObj2->nomination;if($nomination== ""){$nomination= "-";}
$pesoBruto= $jsonObj2->pesoBruto;if($pesoBruto== ""){$pesoBruto= "-";}else{$pesoBruto = $pesoBruto;} // OBS: Nao colocar KG pois ira ser salvo em banco para realizar contar posteriormete
$pesoMaterialCarregado= $jsonObj2->pesoMaterialCarregado;if($pesoMaterialCarregado== ""){$pesoMaterialCarregado= "-";}else{$pesoMaterialCarregado = $pesoMaterialCarregado;}
$tara = '-';
$tempoDeslocamento= $jsonObj2->tempoDeslocamento;if($tempoDeslocamento== ""){$tempoDeslocamento= "-";}
$tipoConjunto=$jsonObj2->tipoConjunto;if($tipoConjunto== ""){$tipoConjunto= "-";}
$placaCavalo= $jsonObj2->placaCavalo;if($placaCavalo== ""){$placaCavalo= "-";}
$estadoCavalo= $jsonObj2->estadoCavalo;if($estadoCavalo== ""){$estadoCavalo= "-";}
$transportadoraCavalo= $jsonObj2->transportadoraCavalo;if($transportadoraCavalo== ""){$transportadoraCavalo= "-";}
$placaCarreta= $jsonObj2->placaCarreta;if($placaCarreta== ""){$placaCarreta= "-";}
$estadoCarreta= $jsonObj2->estadoCarreta;if($estadoCarreta== ""){$estadoCarreta= "-";}
$transportadoraCarreta= $jsonObj2->transportadoraCarreta;if($transportadoraCarreta== ""){$transportadoraCarreta= "-";}


//echo $response;
//echo ("</BR></BR></BR></BR>");
if($publicar == 1)
{
  echo('Status = ' .$statusProcesso);echo("</BR>");
  echo('Celular = ' .$celular);echo("</BR>");
  echo('CNH = ' .$cnh);echo("</BR>");
  echo('CPF = ' .$cpf);echo("</BR>");
  echo('Nome = ' .$nome);echo("</BR>");
  echo("Email = - ");echo("</BR>");
  echo('Origem = ' .$origem);echo("</BR>");
  echo('Destino = ' .$destino);echo("</BR>");
  echo('Rota = ' .$rota);echo("</BR>");
  echo('Material = ' .$material);echo("</BR>");
  echo('Estoque = ' .$estoque);echo("</BR>");
  echo('Data Previsao Carga = ' .$dataPrevisaoCarga);echo("</BR>");
  echo('Numero Processo GAGF Pai = ' .$idProcessoGagf_pai);echo("</BR>");
  echo('Numero Processo GSCS Pai = ' .$idProcessoGscs_pai);echo("</BR>");
  echo('Numero Processo GAGF Filho = ' .$idProcessoGagf_filho);echo("</BR>");
  echo('Numero Processo GSCS Filho = ' .$idProcessoGscs_filho);echo("</BR>");
  echo('Ticket = ' .$ticket);echo("</BR>");
  echo('Nomination = ' .$nomination);echo("</BR>");
  echo('Peso Bruto = ' .$pesoBruto);echo("</BR>");
  echo('Peso Liquido = ' .$pesoMaterialCarregado);echo("</BR>");
  echo('Peso Tara = ' .$tara);echo("</BR>");
  echo('Tempo Deslocamento = ' .$tempoDeslocamento);echo("</BR>");
  echo('Tipo Conjunto = ' .$tipoConjunto);echo("</BR>");
  echo('Placa Carreta = ' .$placaCarreta);echo("</BR>");
  echo('Estado Carreta = ' .$estadoCarreta);echo("</BR>");
  echo('Transportadora Carreta = ' .$transportadoraCarreta);echo("</BR>");
  echo('Placa Cavalo = ' .$placaCavalo);echo("</BR>");
  echo('Estado Cavalo = ' .$estadoCavalo);echo("</BR>");
  echo('Transportadora Cavalo = ' .$transportadoraCavalo);echo("</BR>");
  echo "</BR>";
}

} // Fecha o pode consultar no gagf

if($encontrado == 1)
{
 //aqui vai todo o codido

 





//Consulto e busco a sigla da transportadora
include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadoraCarreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $sigla_transportadora = $dados['sigla'];
}

if($publicar == 1)
{
  echo "Sigla da transportadora = " . $sigla_transportadora;
  echo "</BR>";
}    

include_once 'conexao.php';
$sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$epc_carreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
}

if($publicar == 1)
{
  echo 'o ID e: '.$id;
  echo "</BR>";
  echo $placa_carreta;
  echo '</BR>';
}

include_once 'conexao.php';

$sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$epc_carreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id2 = trim(strval($dados['id']));
}

if($publicar == 1)
{
 echo 'o ID2 e: '.$id2;
 echo "</BR>";
}

if($id2 !='' AND $id2 != '0')
{
  //Encontrou, então podemos fazer o update na tabela
  
  if($publicar == 1)
  {
    echo "Entrou para fazer UPDATE no historio_complemento";
    echo "</BR>";
  }
  
  include_once 'conexao.php';
  $sql = $dbcon->query("UPDATE historico_complemento SET
  origem = '$origem',
  destino = '$destino'
 
  
  WHERE id_historico='$id2'");
  

  // Agora verifico o cadastro do motorista, caso nao tenha no sistema, cadastro ele no nosso banco de dados!
  if($nome != '' && $nome !='vazio' && $nome != '0')
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y');
    //$hora = date('H:i:s');
    
    $vdata = explode('/',$data);
    $dia = intval($vdata[0]);
    $mes = intval($vdata[1]);
    $ano = intval($vdata[2]);
    $numero_tabela = 0;

    $pesquisa_mes = 'mes_'.$mes; //exemplo mes_8
    $pesquisa_ano = 'ano_2022';
     

    if($publicar == 1)
    {
      echo "Pesquisando ***************************</BR>";
      echo "pesquisa_mes = " . $pesquisa_mes;
      echo "</BR>";
      echo "pesquisa_ano = " . $pesquisa_ano;
      echo "</BR>";
    }
    if(intval($mes)>6)
    {
     $numero_tabela = 2;
     $pesquisa_dia = 'mes'.(intval($mes)-6).'_dia_'.$dia; //exemplo mes1_dia4
     
    }   
    else
    {
     $numero_tabela = 1;
     $pesquisa_dia = 'mes'.$mes.'_dia_'.$dia; //exemplo mes1_dia4
    }
    $tabela = 'cadastro_motoristas'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_motoristas1, senão busca no no cadastro_motoristas2
    
    if($publicar == 1)
    {
     echo "pesquisa_dia = " . $pesquisa_dia;
     echo "</BR>";
     echo "tabela = " . $tabela;
     echo "</BR>";
    }

   
    //Verficiso se ja existe cadastro dele
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 WHERE nome='$nome' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     //echo achou
    if($numero_tabela == 1)
    {
     include_once 'conexao.php';
     $sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 WHERE nome='$nome' LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      $dados = $sql->fetch_array();
      $id_tabela = $dados['id'];
      $v_dia = $dados[$pesquisa_dia];
      $v_ano = $dados[$pesquisa_ano];
      $v_mes = $dados[$pesquisa_mes];
     }
    }
    else
    {
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 WHERE nome='$nome' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela = $dados['id'];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM cadastro_motoristas2 WHERE nome='$nome' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $v_dia = $dados[$pesquisa_dia];
      }
    } 


     if($v_dia == 'null' || $v_dia ==''){$v_dia = '1';}else{$v_dia = strval(intval($v_dia)+1);}
     if($v_ano == 'null' || $v_ano ==''){$v_ano = '1';}else{$v_ano = strval(intval($v_ano)+1);}
     if($v_mes == 'null' || $v_mes ==''){$v_mes = '1';}else{$v_mes = strval(intval($v_mes)+1);}
     
     //echo 'Valor mes = ' . $v_mes . ' - Valor ano = ' . $v_ano . ' - Valor dia = ' . $v_dia;

     //tenho que ler os valores existentes referente ao mes_xx   ano_2022  mes_xx_dia_xx para incrementa-los e voltar eles
     if($numero_tabela == 1)
     {
      // Faz tudo nessa
       //Atualiza ano_2022 e mes_xx na tabela1
       include_once 'conexao.php';
       $sql = $dbcon->query("UPDATE cadastro_motoristas1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano',$pesquisa_dia = '$v_dia' WHERE id='$id_tabela'");
  
     }
     else
     {
      //Atualiza ano_2022 e mes_xx na tabela1
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE cadastro_motoristas1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano' WHERE id='$id_tabela'");
 
      //Atualiza mesXX_dia_XX na tabela 2
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE cadastro_motoristas2 SET $pesquisa_dia = '$v_dia' WHERE id='$id_tabela'");
     }

    }
    else
    {
     //echo 'nao achou'; 
     //Não existe, então posso cadastralo tando no cadastro_motorista1 quanto no cadastro_motorista2
     //echo $pesquisa_dia;
     if($numero_tabela == 1)
     {
      include_once 'conexao.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas1 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora,$pesquisa_ano,$pesquisa_mes,$pesquisa_dia) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora','1','1','1')");
      
      //Salva tambem na segunda tabela
      include_once 'conexao.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas2 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora')");
     }
     else
     {
      include_once 'conexao.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas1 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora,$pesquisa_ano,$pesquisa_mes) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora','1','1')");
      
      //Salva tambem na segunda tabela
      include_once 'conexao.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas2 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora,$pesquisa_dia) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora','1')");
 
     }
     
    }

    
    //Agora faco as validacoes para movimentacoes
    $v_dia = "0";
    $v_ano = "0";
    $v_mes = "0";
 
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM materiais1 WHERE material='$material' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     //Existe o material, agora tenho que buscar os dados dele
     if($numero_tabela == 1)
     {
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM materiais1 WHERE material='$material' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela = $dados['id'];
       $v_dia = $dados[$pesquisa_dia];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
     }
    }
    else
    {
      //$numero_tabela==2 
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM materiais1 WHERE material='$material' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela_materiais = $dados['id'];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM materiais2 WHERE material='$material' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $v_dia = $dados[$pesquisa_dia];
      }
    }

    if($v_dia == 'null' || $v_dia ==''){$v_dia = '1';}else{$v_dia = strval(intval($v_dia)+1);}
    if($v_ano == 'null' || $v_ano ==''){$v_ano = '1';}else{$v_ano = strval(intval($v_ano)+1);}
    if($v_mes == 'null' || $v_mes ==''){$v_mes = '1';}else{$v_mes = strval(intval($v_mes)+1);}
    
    //echo 'Valor mes = ' . $v_mes . ' - Valor ano = ' . $v_ano . ' - Valor dia = ' . $v_dia;
    
    //tenho que ler os valores existentes referente ao mes_xx   ano_2022  mes_xx_dia_xx para incrementa-los e voltar eles
    if($numero_tabela == 1)
    {
     // Faz tudo nessa
     //Atualiza ano_2022 e mes_xx na tabela1
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE materiais1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano',$pesquisa_dia = '$v_dia' WHERE id='$id_tabela_materiais'");
 
    }
    else
    {
     //Atualiza ano_2022 e mes_xx na tabela1
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE materiais1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano' WHERE id='$id_tabela_materiais'");

     //Atualiza mesXX_dia_XX na tabela 2
     include_once 'conexao.php';
     $sql = $dbcon->query("UPDATE materiais2 SET $pesquisa_dia = '$v_dia' WHERE id='$id_tabela_materiais'");
    }
    


     


    // AGORA TRATO AS MOVIMENTACOES POR TRANSPORTADORAS
    //Agora faco as validacoes para transportadoras
    $v_dia = "0";
    $v_ano = "0";
    $v_mes = "0";
    include_once 'conexao.php';
    $sql = $dbcon->query("SELECT * FROM transportadoras1 WHERE nome='$transportadoraCarreta' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     //Existe o material, agora tenho que buscar os dados dele
     if($numero_tabela == 1)
     {
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM transportadoras1 WHERE nome='$transportadoraCarreta' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela = $dados['id'];
       $v_dia = $dados[$pesquisa_dia];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
     }
     else 
     {
      //$numero_tabela==2 
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM transportadoras1 WHERE nome='$transportadoraCarreta' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela_transportadoras = $dados['id'];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM transportadoras2 WHERE nome='$transportadoraCarreta' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {  
       $dados = $sql->fetch_array();
       $v_dia = $dados[$pesquisa_dia];
      }
     }
     if($v_dia == 'null' || $v_dia ==''){$v_dia = '1';}else{$v_dia = strval(intval($v_dia)+1);}
     if($v_ano == 'null' || $v_ano ==''){$v_ano = '1';}else{$v_ano = strval(intval($v_ano)+1);}
     if($v_mes == 'null' || $v_mes ==''){$v_mes = '1';}else{$v_mes = strval(intval($v_mes)+1);}
     
     //echo 'Valor mes = ' . $v_mes . ' - Valor ano = ' . $v_ano . ' - Valor dia = ' . $v_dia;
     
     //tenho que ler os valores existentes referente ao mes_xx   ano_2022  mes_xx_dia_xx para incrementa-los e voltar eles
     if($numero_tabela == 1)  
     {
      // Faz tudo nessa
      //Atualiza ano_2022 e mes_xx na tabela1
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE transportadoras1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano',$pesquisa_dia = '$v_dia' WHERE id='$id_tabela_transportadoras'");
     }
     else
     {
      //Atualiza ano_2022 e mes_xx na tabela1
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE transportadoras1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano' WHERE id='$id_tabela_transportadoras'");
      
      //Atualiza mesXX_dia_XX na tabela 2
      include_once 'conexao.php';
      $sql = $dbcon->query("UPDATE transportadoras2 SET $pesquisa_dia = '$v_dia' WHERE id='$id_tabela_transportadoras'"); 
     }
    } 

   //Atualizo agora para a API TORA/FJX
   //if($sigla_transportadora =='TORA' || $sigla_transportadora == 'FJX')
   //{
   // include_once 'conexao.php';
   // $sql = $dbcon->query("INSERT INTO validacoes_feitas_tora_fjx (placa_ou_tag,validado,data_validacao,hora_validacao) VALUES ('$epc_carreta','pendente','-','-')");
   //}

   }
   else
   {
    echo 'nao achou';
   }
  } // fecha  if($nome != '' && $nome !='vazio' && $nome != '0')
  
}









} // Fecha o encontrado == 1







 }  //Fecha o se pode salvar pois nao existe na tabela historico_validacoes
} //Fecha se if($epc_carreta != 'vazio')
else
{
 echo 'Faltam dados!';   
}


?>