<?php

//Para testar passar o parametro teste
$em_testes = isset($_GET['teste'])?$_GET['teste']:"nao";

//Para debugar passar o parametro echo=sim
$permitir_echo = isset($_GET['echo'])?$_GET['echo']:"nao";




$epc_carreta = isset($_GET['epc_carreta'])?$_GET['epc_carreta']:"vazio";
$epc_cavalo = isset($_GET['epc_cavalo'])?$_GET['epc_cavalo']:"vazio";
$origem = isset($_GET['origem'])?$_GET['origem']:"vazio";
$destino = isset($_GET['destino'])?$_GET['destino']:"vazio";
$estoque = isset($_GET['estoque'])?$_GET['estoque']:"vazio";
$nomination = isset($_GET['nomination'])?$_GET['nomination']:"vazio";
$material= isset($_GET['material'])?$_GET['material']:"vazio";
$pesoBruto = isset($_GET['pesoBruto'])?$_GET['pesoBruto']:"vazio";
$pesoMaterialCarregado = isset($_GET['pesoMaterialCarregado'])?$_GET['pesoMaterialCarregado']:"vazio";
$idProcessoGagf_pai = isset($_GET['idProcessoGagf_pai'])?$_GET['idProcessoGagf_pai']:"vazio";
$idProcessoGagf_filho = isset($_GET['idProcessoGagf_filho'])?$_GET['idProcessoGagf_filho']:"vazio";
$idProcessoGscs_pai = isset($_GET['idProcessoGscs_pai'])?$_GET['idProcessoGscs_pai']:"vazio";
$idProcessoGscs_filho = isset($_GET['idProcessoGscs_filho'])?$_GET['idProcessoGscs_filho']:"vazio";
$nome = isset($_GET['nome'])?$_GET['nome']:"vazio";
$cpf = isset($_GET['cpf'])?$_GET['cpf']:"vazio";
$cnh = isset($_GET['cnh'])?$_GET['cnh']:"vazio";
$celular = isset($_GET['celular'])?$_GET['celular']:"vazio";
$email = isset($_GET['email'])?$_GET['email']:"vazio";
$tara = isset($_GET['tara'])?$_GET['tara']:"vazio";
$tag_motorista = '-';
$placa_carreta = isset($_GET['placaCarreta'])?$_GET['placaCarreta']:"vazio";
$placa_cavalo = isset($_GET['placaCavalo'])?$_GET['placaCavalo']:"vazio";


$transportadoraCarreta  = isset($_GET['transportadoraCarreta'])?$_GET['transportadoraCarreta']:"vazio";
$sigla_transportadora = ''; // Tem que consultar e buscar




//Dados para simular teste
if($em_testes = "sim")
{
  echo "</BR>";
  echo "Rodando em simulação ***********************************************************************************";
  echo "</BR>";
  echo "</BR>";
$epc_carreta  = '442002000000000000001216';
$nome = 'BRUNO GONCALVES';
$cpf = '06987894400';
$celular = '+55 (31) 98369-1000';
$cnh = '11111111111';
$origem = 'VÁRZEA DO LOPES  MVL';
$destino = 'MIGUEL BURNIER MMB';
$material = 'MIN BRUTO (ROM) VARZEA DO LOPES';
$estoque = 'Estoques VL';
$idProcessoGscs_pai = "878787";
$idProcessoGagf_pai = "676767";
$idProcessoGagf_filho = '1212121';
$idProcessoGscs_filho = '0000000';
$nomination =   '345678909';
$pesoBruto = '41500';
$pesoMaterialCarregado = '24567';
$tara = '14350';
$placa_carreta = 'HLB1066';
$transportadoraCarreta = 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA';
}







//Consulto e busco a sigla da transportadora
$encontrado = 0;
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM transportadoras WHERE nome='$transportadoraCarreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $sigla_transportadora = $dados['sigla'];
 
}

if($permitir_echo =="sim")
{
  echo "Sigla da transportadora : ". $sigla_transportadora;
  echo "</BR>";
}


$encontrado = 0;
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$epc_carreta' ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $id = $dados['id'];
 $encontrado = 1;
}

if($permitir_echo =="sim")
{
 if($encontrado == 1)
 {
  echo 'o ID e: '.$id;
  echo '</BR>';
  echo "A placa e : ".$placa_carreta;
  echo '</BR>';
 }
 else
 {
  echo 'Não localizado a placa no historico!';
  echo '</BR>';
 } 
 
 
}


if($id !='' AND $id != '0')
{
  if($permitir_echo =="sim")
  {
    echo "Entrou para fazer update no 'historico_complemento' ";
    echo "</BR>";
  }
  //Encontrou, então podemos fazer o update na tabela
  include_once 'conexao_dashboard.php';
  
  $sql = $dbcon->query("UPDATE historico_complemento SET  origem = '$origem',
  destino = '$destino',
  material = '$material',
  estoque = '$estoque',
  num_gagf = '$idProcessoGagf_pai',
  num_gscs = '$idProcessoGscs_pai',
  num_GAGF_filho = '$idProcessoGagf_filho',
  num_GSCS_Filho = '$idProcessoGscs_filho', 
  nomination = '$nomination',
  peso_bruto = '$pesoBruto',
  tara = '$tara',
  peso_liquido = '$pesoMaterialCarregado',
  nome = '$nome' 
  WHERE id_historico='$id'");
  




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

    $pesquisa_mes = 'mes_'.intval($mes); //exemplo mes_8
    $pesquisa_ano = 'ano_2022';

    if(intval($mes)>6)
    {
     $numero_tabela = 2;
     $pesquisa_dia = 'mes'.(intval($mes)-6).'_dia_'.$dia; //exemplo mes1_dia4
     
    }   
    else
    {
     $numero_tabela = 1;
     $pesquisa_dia = 'mes'.intval($mes).'_dia_'.$dia; //exemplo mes1_dia4
    }
    $tabela = 'cadastro_motoristas'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_motoristas1, senão busca no no cadastro_motoristas2
    
    if($permitir_echo =="sim")
    {
      echo '</BR>';
      echo '</BR>';
      echo 'Dados referentes para pesquisa a ser realizada ****************************************88';
      echo '</BR>';
      echo '</BR>'; 
      echo 'Tabela :'. $tabela . ' - Pesquisa dia: '. $pesquisa_dia . ' - Pesquisa mes: ' . $pesquisa_mes . ' - Pesquisa ano :' . $pesquisa_ano;
      echo '</BR>';
      echo '</BR>';
    }
    
    //Verficiso se ja existe cadastro dele
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 WHERE nome='$nome' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     //echo achou
    if($numero_tabela == 1)
    {
     include_once 'conexao_dashboard.php';
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
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM cadastro_motoristas1 WHERE nome='$nome' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela = $dados['id'];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
      include_once 'conexao_dashboard.php';
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
     
     if($permitir_echo =="sim")
     {
      echo "Dados referente a consulta em relação ao número de viagens para o motorista ******************************";
      echo "</BR>";
      echo 'Valor mes = ' . $v_mes . ' - Valor ano = ' . $v_ano . ' - Valor dia = ' . $v_dia;
      echo "</BR>";
      echo "</BR>";
     }

     //tenho que ler os valores existentes referente ao mes_xx   ano_2022  mes_xx_dia_xx para incrementa-los e voltar eles
     if($numero_tabela == 1)
     {
      // Faz tudo nessa
       //Atualiza ano_2022 e mes_xx na tabela1
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE cadastro_motoristas1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano',$pesquisa_dia = '$v_dia' WHERE id='$id_tabela'");
  
     }
     else
     {
      //Atualiza ano_2022 e mes_xx na tabela1
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE cadastro_motoristas1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano' WHERE id='$id_tabela'");
 
      //Atualiza mesXX_dia_XX na tabela 2
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE cadastro_motoristas2 SET $pesquisa_dia = '$v_dia' WHERE id='$id_tabela'");
     }

    }
    else
    {
      if($permitir_echo =="sim")
      {
       echo 'nao achou'; 
       //Não existe, então posso cadastralo tando no cadastro_motorista1 quanto no cadastro_motorista2
       echo $pesquisa_dia;
      }

     if($numero_tabela == 1)
     {
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas1 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora,$pesquisa_ano,$pesquisa_mes,$pesquisa_dia) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora','1','1','1')");
      
      //Salva tambem na segunda tabela
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas2 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora')");
     }
     else
     {
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas1 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora,$pesquisa_ano,$pesquisa_mes) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora','1','1')");
      
      //Salva tambem na segunda tabela
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("INSERT INTO cadastro_motoristas2 (nome,cpf,cnh,celular,email,tag_motorista,transportadora,sigla_transportadora,$pesquisa_dia) VALUES ('$nome','$cpf','$cnh','$celular','$email','$tag_motorista','$transportadoraCarreta','$sigla_transportadora','1')");
 
     }
     
    }

    


    //MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********
    //MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********
    //MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********
    //MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********
    //MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********
    //MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********MATERIAIS *********



    if($permitir_echo =="sim")
    {
      echo "</BR>";
      echo "Agora faço validações para Materiais *****************************************************************************************";
      echo "</BR>";
    }
    //Agora faco as validacoes para movimentacoes
    $v_dia = "0";
    $v_ano = "0";
    $v_mes = "0";
 
    $encontrado = 0;
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM materiais1 WHERE material='$material' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     //Existe o material, agora tenho que buscar os dados dele
     if($permitir_echo =="sim")
     {
      echo "Material encontrado!";
      echo "</BR>";
     }
     $encontrado = 1;
     if($numero_tabela == 1)
     {
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM materiais1 WHERE material='$material' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela_materiais = $dados['id'];
       if($permitir_echo =="sim")
       {
        echo "O ID desse material é : " . $id_tabela_materiais;
        echo "</BR>";
       }
       $v_dia = $dados[$pesquisa_dia];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
     }
    }
    else
    {
      //$numero_tabela==2 
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM materiais1 WHERE material='$material' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela_materiais = $dados['id'];
       if($permitir_echo =="sim")
       {
        echo "O ID desse material é : " . $id_tabela_materiais;
        echo "</BR>";
       }
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
      include_once 'conexao_dashboard.php';
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
    
    if($permitir_echo =="sim")
    {
     echo "</BR>Dados a atualizar > "; 
     echo 'Valor mes = ' . $v_mes . ' - Valor ano = ' . $v_ano . ' - Valor dia = ' . $v_dia;
     echo "</BR>";
    } 
    //tenho que ler os valores existentes referente ao mes_xx   ano_2022  mes_xx_dia_xx para incrementa-los e voltar eles
    if($numero_tabela == 1)
    {
     // Faz tudo nessa
     //Atualiza ano_2022 e mes_xx na tabela1
     if($permitir_echo == "sim")
     {
      echo "</BR>";
      echo "Entrou para atualizar os dados de materiais no id = " . $id_tabela_materiais;
      echo "</BR>";
     }
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("UPDATE materiais1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano',$pesquisa_dia = '$v_dia' WHERE id='$id_tabela_materiais'");
 
    }
    else
    {
     //Atualiza ano_2022 e mes_xx na tabela1
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("UPDATE materiais1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano' WHERE id='$id_tabela_materiais'");

     //Atualiza mesXX_dia_XX na tabela 2
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("UPDATE materiais2 SET $pesquisa_dia = '$v_dia' WHERE id='$id_tabela_materiais'");
    }
    


     



    //Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras
    //Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras
    //Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras
    //Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras
    //Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras
    //Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras ********Movimentações Transportadoras    
      
    if($permitir_echo == "sim")
    {
      echo "</BR>";
      echo "Agora inicio valizacoes para movimentações das transportadoras ************************************************************************";
      echo "</BR>";
      echo "</BR>";
      echo "</BR>";
    }
    
    // AGORA TRATO AS MOVIMENTACOES POR TRANSPORTADORAS
    //Agora faco as validacoes para transportadoras
    $v_dia = "0";
    $v_ano = "0";
    $v_mes = "0";
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM transportadoras1 WHERE nome='$transportadoraCarreta' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();
     //Existe o material, agora tenho que buscar os dados dele
     if($numero_tabela == 1)
     {
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM transportadoras1 WHERE nome='$transportadoraCarreta' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela_transportadoras = $dados['id'];
       if($permitir_echo == "sim")
       {
        echo "Transportadora existe !";
        echo "</BR>";
       }
       $v_dia = $dados[$pesquisa_dia];
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
     }
     else 
     {
      //$numero_tabela==2 
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM transportadoras1 WHERE nome='$transportadoraCarreta' LIMIT 1");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $id_tabela_transportadoras = $dados['id'];
       if($permitir_echo == "sim")
       {
        echo "Transportadora existe !";
        echo "</BR>";
       }
       $v_ano = $dados[$pesquisa_ano];
       $v_mes = $dados[$pesquisa_mes];
      }
      include_once 'conexao_dashboard.php';
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
     
     if($permitir_echo == "sim")
     {
      echo "</BR>";
      echo "Dados para atualizar referente a transportadora ***************************************************";
      echo "</BR>";
      echo 'Valor mes = ' . $v_mes . ' - Valor ano = ' . $v_ano . ' - Valor dia = ' . $v_dia;
      echo "</BR>";
      echo "</BR>";

     } 
     
     
     //tenho que ler os valores existentes referente ao mes_xx   ano_2022  mes_xx_dia_xx para incrementa-los e voltar eles
     if($numero_tabela == 1)  
     {
      // Faz tudo nessa
      //Atualiza ano_2022 e mes_xx na tabela1
      if($permitir_echo =="sim")
      {
        echo "Entrou para fazer UPDATE na tabela transportadoras". $numero_tabela;
        echo "</BR>";
      }
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE transportadoras1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano',$pesquisa_dia = '$v_dia' WHERE id='$id_tabela_transportadoras'");
     }
     else
     {
      if($permitir_echo =="sim")
      {
        echo "Entrou para fazer UPDATE na tabela transportadoras". $numero_tabela;
        echo "</BR>";
      }
      
      
      //Atualiza ano_2022 e mes_xx na tabela1
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE transportadoras1 SET $pesquisa_mes = '$v_mes', $pesquisa_ano = '$v_ano' WHERE id='$id_tabela_transportadoras'");
      
      //Atualiza mesXX_dia_XX na tabela 2
      include_once 'conexao_dashboard.php';

      $sql = $dbcon->query("UPDATE transportadoras2 SET $pesquisa_dia = '$v_dia' WHERE id='$id_tabela_transportadoras'"); 
     }
    } 
   }
   else
   {
    echo 'nao achou';
   }
  } // fecha  if($nome != '' && $nome !='vazio' && $nome != '0')
  
}
//Responde para o servidor de envio
//echo json_encode('ok');


 ?>
