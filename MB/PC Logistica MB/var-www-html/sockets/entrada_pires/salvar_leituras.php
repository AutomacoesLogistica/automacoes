<?php
$mensagem = isset($_GET['mensagem'])?$_GET['mensagem']:"vazio";

if($mensagem !="vazio" && strlen($mensagem)>30)
{
 
 /*
 padrao mensagem recebida pelo aliien
 #Alien RFID Reader Tag Stream
 #ReaderName: Alien RFID Reader
 #Hostname: SAIDABAL1
 #IPAddress: 192.168.10.94
 #IPAddress6: fdaa::aaaa
 #CommandPort: 23
 #MACAddress: 00:1B:5F:01:14:48
 #Time: 2022/12/15 13:22:12.721
 epc=442002000000000000001760,ant=0,host=SAIDABAL1,data=2022/12/15,hora=13:22:12.545

 */
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
 $ponto = "Entrada";
}
else
{
 $ponto = "Saida";   
}

 if(strlen($epc)==24 && (  substr($epc,0,6) =="442002" || substr($epc,0,6) =="442001"  ))
 {
  include_once 'conexao.php';
  date_default_timezone_set('America/Sao_Paulo');
  $data = date('d/m/Y');
  $hora = date('H:i:s');
  
  $v_hora1 = explode(":",$hora);
  $v_hora = $v_hora1;


  $sql = $dbcon->query("INSERT INTO historico_socket(epc,antena,ponto,ca,ip,mac,hostname,nomeReader,data_atualizacao,hora_atualizacao)VALUES('$epc','$antena','$ponto','$ca','$ip','$mac','$hostname','$nomeReader','$data','$hora')");
  //Agora ja trato para as automacoes da saida balanca 1
  //Verific se é carreta
  $v1_epc = substr($epc,0,6);
  if($v1_epc == '442002')
  {
    //Antes de salvar, verifico se ja não é igual a ultima inserida!
    include_once 'conexao.php';
    $lista_epc = [];
    $sql = $dbcon->query("SELECT * FROM validacoes_socket ORDER BY id DESC LIMIT 10");
    if(mysqli_num_rows($sql)>0)
    {
        while($dados = $sql->fetch_array())
        { 
            $v_epc = trim($dados['epc_carreta']);
            array_push($lista_epc,$v_epc);
        }
    }  
    //Agora verifico se tem a tag a inserir no array
    if (in_array($epc,$lista_epc)) 
    {
        echo "Tem a tag ja na lista!" ;
    }
    else
    {
        echo "Nao tem a tag na lista, pode inserir!";  
        //Salvo para o python publicar simulando uma leitura do reader localmente!
        include_once 'conexao.php';
        $sql = $dbcon->query("INSERT INTO validacoes_socket(epc_carreta,antena,ponto,data_leitura,hora_leitura,condicao,data_tratado,hora_tratado)VALUES('$epc','$antena','$ponto','$data','$hora','pendente','-','-')");

      //Agora salvo na lista para contagem de veiculos por hora
      date_default_timezone_set('America/Sao_Paulo');
      $data = date('d/m/Y');
      $hora = date('H:i:s');
      
      $v_hora1 = explode(":",$hora);
      $v_hora = 'v'.(intval($v_hora1[0]));
       
      echo $v_hora;
      
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM veiculos_dashboard_2024 WHERE data='$data'");
      if(mysqli_num_rows($sql)>0)
      {
       $dados = $sql->fetch_array();
       $v0 = trim($dados['v0']);
       $v1 = $dados['v1'];
       $v2 = $dados['v2'];
       $v3 = $dados['v3'];
       $v4 = $dados['v4'];
       $v5 = $dados['v5'];
       $v6 = $dados['v6'];
       $v7 = $dados['v7'];
       $v8 = $dados['v8'];
       $v9 = $dados['v9'];
       $v10 = $dados['v10'];
       $v11 = $dados['v11'];
       $v12 = $dados['v12'];
       $v13 = $dados['v13'];
       $v14 = $dados['v14'];
       $v15 = $dados['v15'];
       $v16 = $dados['v16'];
       $v17 = $dados['v17'];
       $v18 = $dados['v18'];
       $v19 = $dados['v19'];
       $v20 = $dados['v20'];
       $v21 = $dados['v21'];
       $v22 = $dados['v22'];
       $v23 = $dados['v23'];
      }  
    
      
      if($v_hora == 'v0')
      {
       $v0 = intval($v0)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v0='$v0' WHERE data='$data'");
      }
      else if($v_hora == 'v1')
      {
       $v1 = intval($v1)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v1='$v1' WHERE data='$data'");
      }
      else if($v_hora == 'v2')
      {
       $v2 = intval($v2)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v2='$v2' WHERE data='$data'");
      }  
      else if($v_hora == 'v3')
      {
       $v3 = intval($v3)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v3='$v3' WHERE data='$data'");
      }
      else if($v_hora == 'v4')
      {
       $v4 = intval($v4)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v4='$v4' WHERE data='$data'");
      }      
      else if($v_hora == 'v5')
      {
       $v5 = intval($v5)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v5='$v5' WHERE data='$data'");
      }
      else if($v_hora == 'v6')
      {
       $v6 = intval($v6)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v6='$v6' WHERE data='$data'");
      }
      else if($v_hora == 'v7')
      {
       $v7 = intval($v7)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v7='$v7' WHERE data='$data'");
      }
      else if($v_hora == 'v8')
      {
       $v8 = intval($v8)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v8='$v8' WHERE data='$data'");
      }
      else if($v_hora == 'v9')
      {
       $v9 = intval($v9)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v9='$v9' WHERE data='$data'");
      }
      else if($v_hora == 'v10')
      {
       $v10 = intval($v10)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v10='$v10' WHERE data='$data'");
      }
      else if($v_hora == 'v11')
      {
       $v11 = intval($v11)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v11='$v11' WHERE data='$data'");
      }
      else if($v_hora == 'v12')
      {
       $v12 = intval($v12)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v12='$v12' WHERE data='$data'");
      }
      else if($v_hora == 'v13')
      {
       $v13 = intval($v13)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v13='$v13' WHERE data='$data'");
      }
      else if($v_hora == "v14")
      {
       $v14 = (intval($v14))+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v14='$v14' WHERE data='$data'");
      }
      else if($v_hora == 'v15')
      {
       $v15 = intval($v15)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v15='$v15' WHERE data='$data'");
      }
      else if($v_hora == 'v16')
      {
       $v16 = intval($v16)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v16='$v16' WHERE data='$data'");
      }
      else if($v_hora == 'v17')
      {
       $v17 = intval($v17)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v17='$v17' WHERE data='$data'");
      }
      else if($v_hora == 'v18')
      {
       $v18 = intval($v18)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v18='$v18' WHERE data='$data'");
      }
      else if($v_hora == 'v19')
      {
       $v19 = intval($v19)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v19='$v19' WHERE data='$data'");
      }
      else if($v_hora == 'v20')
      {
       $v20 = intval($v20)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v20='$v20' WHERE data='$data'");
      }
      else if($v_hora == 'v21')
      {
       $v21 = intval($v21)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v21='$v21' WHERE data='$data'");
      }
      else if($v_hora == 'v22')
      {
       $v22 = intval($v22)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v22='$v22' WHERE data='$data'");
      }
      else if($v_hora == 'v23')
      {
       $v23 = intval($v23)+1;
       include_once 'conexao_dashboard.php';
       $sql = $dbcon->query("UPDATE veiculos_dashboard_2024 SET v23='$v23' WHERE data='$data'");
      }
      else
      {
        echo "Erro!";
      }


    }
  } //Fecho if($v1_epc == '442002')
 }
}
else
{
 echo "Favor inserir uma mensagem valida!";   
}

?>