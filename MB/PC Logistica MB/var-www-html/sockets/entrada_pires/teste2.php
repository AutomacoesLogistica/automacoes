<?php 

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



      
?>