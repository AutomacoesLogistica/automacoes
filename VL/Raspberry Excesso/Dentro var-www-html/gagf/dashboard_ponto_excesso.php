<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>
 
    <?php
    error_reporting(0);
     $tag_carreta = '';
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     $mensagem2 = explode('/',$data);
     $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
     $data_agora = $mensagem2 . ' ' . $hora;  
     echo($data_agora);    
     echo'</BR>';
     $tag_carreta = isset($_GET['epc'])?$_GET['epc']:'vazio';

     $encontrados_dashboard = 0;
     $encontrados_historico = 0;
     $id_banco_dashboard = 0;
     $id_banco_historico = 0;
     $valor_ponto = 0;

    if($tag_carreta != 'vazio') // Ja busco pela tag da carreta
    {
     print('</BR>');
     print('Buscando por tag de carreta! - Tag: ' .$tag_carreta);
     print('</BR>');
     
     // Agora conecto no banco e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_carreta='$tag_carreta' AND tipo!='Excesso' ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_dashboard = $dados['id'];
       $encontrados_dashboard = 1;
      }
      echo $id_banco_dashboard;
      echo '</BR>';
     } // Fecho if do banco
     // Agora conecto no banco historico e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$tag_carreta' tipo!='Excesso' ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_historico = $dados['id'];
       $valor_ponto = intval($dados['valor_ponto']);
       $encontrados_historico = 1;
      }
     } // Fecho if do banco
    } // Fecha if carreta
    else
    {
      //Nao busca
      print('Sem tag!');
    }







     echo($id_banco_historico);

     if($encontrados_dashboard == 1) //Posso atualizar 
     {
      //Vou atualizar que teve leitura na antena
      $valor_leitura = rand(5,15);
      $vdata = explode('/',$data);
      $dia = $vdata[0];
      $mes = $vdata[1];
      $ano = $vdata[2];
      $data_hora = $data . ' ' . $hora;
      
      include_once 'conexao_dashboard.php';
      $sq2 = $dbcon->query("UPDATE dashboard SET tipo='Excesso', ponto='Excesso', data_leitura='$data', hora_leitura='$hora' WHERE id='$id_banco_dashboard'");
     
    }
     if($encontrados_historico == 1) // Posso atualizar
     {
      $valor_ponto = intval($valor_ponto + 1);
      $ponto = 'ponto'.$valor_ponto; 
      $data_leitura = 'data_leitura'.$valor_ponto;
      $hora_leitura = 'hora_leitura'.$valor_ponto;

      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE historico SET v_status='Patio Excesso',valor_ponto='$valor_ponto', $ponto='Excesso', $data_leitura='$data', $hora_leitura='$hora' WHERE id='$id_banco_historico'");
     }

     if($encontrados_dashboard == 1) //Posso atualizar 
     {
     include_once 'conexao_dashboard_dispositivo.php';
     $sql = $dbcon->query("INSERT INTO Excesso_01(ponto,condicao,dia,mes,ano,vdata,vhora,data_hora,epc)VALUES('antena1','$valor_leitura','$dia','$mes','$ano','$data','$hora','$data_hora','$tag_carreta')");
     }
    
    ?>
</body>
</html>