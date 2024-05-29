<?php
$placa = '';
      
      //Busco os dados
      include_once 'conexao.php';
      $sql = $dbcon->query("SELECT * FROM display_balanca1 WHERE id=1");
      {
       $dados = $sql->fetch_array(); 
       $status_api_cheio_vazio = $dados['api_cheio_vazio'];
       $id_cheio_vazio = $dados['id_cheio_vazio'];
       $id_lidar = $dados['api_lidar'];
       $alerta = $dados['alerta'];
       $id_historico = $dados['id_historico'];
       $epc_lidar = $dados['epc_lidar'];
       $alert2 = $dados['alerta2'];
       $veiculo = $dados['veiculo'];
      }    
      //******************************************************************************************* */ 
      echo $status_api_cheio_vazio;
      echo "</BR>";
      echo $id_cheio_vazio;
      echo "</BR>";
      echo $id_lidar;
      echo "</BR>";
      echo $alerta;
      echo "</BR>";
      echo $id_historico;
      echo "</BR>";
      echo $epc_lidar;
      echo "</BR>";
      echo $alert2;
      echo "</BR>";
      echo $veiculo;
      echo "</BR>";

      $epc_lidar = '442002000000000000001432';
      
      $condicao = "Excesso/Falta";
      if($epc_lidar != 'vazio' )
      {
       if(strlen($epc_lidar)==24)
       {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/Y');
        $v_data = $nome_reduzido = explode("/",$data);
        $dia = $v_data[0];
        $mes = $v_data[1];
        $ano = $v_data[2];    
        $hora = date('H:i:s');
        
        echo $data;echo'</BR>';
        echo $dia;echo'</BR>';
        echo $mes;echo'</BR>';
        echo $ano;echo'</BR>';
        echo $hora;echo'</BR>';
          
        //Agora limpa na tabela
        //include_once 'conexao.php';
        //$sql = $dbcon->query("UPDATE display_balanca1 SET epc_lidar='-',alerta='-',alerta2='-',data_alerta='-',hora_alerta='-',epc_carreta='-',api_cheio_vazio='-',api_lidar='-',id_cheio_vazio='-',data_math_lidar='-',hora_math_lidar='-',veiculo='-' WHERE id='1'");
        
        include_once 'conexao.php';
        $sql = $dbcon->query("INSERT INTO lidar_excesso(id_lidar,id_cheio_vazio,id_historico,epc_lidar,placa,veiculo,data_leitura,dia,mes,ano,hora_leitura,condicao,tratado,data_tratado,hora_tratado,confirmacao,tempo_confirmacao,motivo)VALUES('$id_lidar','$id_cheio_vazio','$id_historico','$epc_lidar','$placa','$veiculo','$data','$dia','$mes','$ano','$hora','$condicao','nao','-','-','nao','0','-')");
        }
       }
       else
       {
        echo "erro";
       }
    
      //******************************************************************************************* */

?>